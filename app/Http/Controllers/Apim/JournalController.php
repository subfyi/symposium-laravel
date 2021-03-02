<?php

namespace App\Http\Controllers\Apim;

use App\Facades\FileProcessing;
use App\Http\Controllers\Controller;
use App\Models\ArticleTypes;
use App\Models\Countries;
use App\Models\Dosyalar;
use App\Models\JournalInfo;
use App\Models\Journals;
use App\Models\JournalToArticleType;
use App\Models\JournalToCountrie;
use App\Models\JournalToPublisher;
use App\Models\JournalToSubject;
use App\Models\Languages;
use App\Models\Publishers;
use App\Models\Subjects;
use App\Models\Volumes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class JournalController extends Controller
{
    public function index()
    {
        $data = Journals::with([
            'journal_info', 'volumes'
        ]);

        $sort = request()->query('sort');
        if ($sort) {
            $data = $data->orderBy($sort, request()->query('desc') == "true" ? 'desc' : 'ASC');
        }

        $journal_id = request()->query('journal_id');
        if ($journal_id) {
            $data = $data->where('id', '=', $journal_id);
        }

        $query        = request()->query('query');
        if ($query) {
            $data = $data->where(function ($query2) use ($query) {
                $query2
                    ->where('slug', 'LIKE', '%'.$query.'%');
            });
        }

        $valuePerPage = request()->query('itemPerPage');
        if ($valuePerPage == -1) {
            $ret = [
                "data"      => $data->get(),
                "last_page" => 1
            ];
        } else {
            $ret = $data->paginate($valuePerPage);
        }

        return $ret;
    }

    public function show($id) {
        return Journals::with(['journal_info', 'volumes', 'volumes.articles'])->where('id', $id)->first();
    }

    public function getname(Request $request)
    {
        $i           = 0;
        $matches_all = [];
        do {
            $i++;
            $url = "https://dergipark.org.tr/tr/pub/explore/journals/$i";

            if (curl_init($url) == false) {
                echo "break";
                break;
            }
            URL::signedRoute();
            //CURL'yi başlat.
            $curl = curl_init();

            // Herhangi bir HTTPS hatası almak istemiyoruz.
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($curl, CURLOPT_URL, $url);

            $html = curl_exec($curl);

            preg_match_all("/\<a href=\"\/tr\/pub\/(.*)\">/", $html, $matches);

            //$matches_all[] = $matches[1];
            $matches_all = array_merge($matches_all, $matches[1]);

        } while ($i <= 25);

        $matches_uniq = array_unique($matches_all, SORT_STRING);

        //$matches_uniq_json = json_encode($matches_uniq);

        foreach ($matches_uniq as $value) {
            $journal = Journals::where('slug', $value)->first();
            if ($journal == null) {
                Journals::create([
                    'slug' => isset($value) ? $value : null,
                ]);
            }
        }
    }

    public function getid(Request $request)
    {

        $matches_uniq = Journals::all();


        foreach ($matches_uniq as $item) {

            if ($item->d_id == null) {
                //CURL'yi başlat.
                $curl = curl_init();

                // Herhangi bir HTTPS hatası almak istemiyoruz.
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);


                $url = "https://dergipark.org.tr/tr/pub/".$item->slug;


                curl_setopt($curl, CURLOPT_URL, $url);

                $html = curl_exec($curl);

                preg_match("/\/journal\/(.*)\/submission/", $html, $matches);
                if ( ! empty($matches[1])) {

                    $journal = Journals::where('slug', $item->slug)->first();
                    if ($journal) {
                        $journal->update([
                            'd_id' => $matches[1],
                        ]);
                    }

                }
            }
        }
    }

    public function getinfo(Request $request)
    {

        $journal = Journals::where('id', $request->row['id'])->first();


        //Hesabınızın kullanıcı adı (email de olabilir)
        define('USERNAME', 'akinayturan@gmail.com');

        //Hesabınızın giriş şifresi
        define('PASSWORD', '782150');

        //Bir user agent oluşturalım ki tarayıcı kızmasın.
        define('USER_AGENT', 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.2309.372 Safari/537.36');

        //Çerez bilgimizin nerede depolanacağı (kimlik doğrulama için gerekli).
        define('COOKIE_FILE', 'cookie.txt');

        //Login formu hangi url'den çağırıyor?
        define('LOGIN_FORM_URL', 'https://dergipark.org.tr/tr/login');

        //Login formu hangi url'yi çağırıyor? Bu bazen aynı url'dir.
        define('LOGIN_ACTION_URL', 'https://dergipark.org.tr/tr/login_check');


        // Gerekli form alanlarını temsil eden ilişkisel bir dizi.
        // Formun adıyla eşleşmesi için key/ array adlarını değiştirmeniz gerekebilir.

        $postValues = array(
            '_username' => USERNAME,
            '_password' => PASSWORD,
        );

        //CURL'yi başlat.
        $curl = curl_init();

        // Herhangi bir HTTPS hatası almak istemiyoruz.
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        // Çerez ayrıntılarımızın nerede saklandığı bilgisi. Bu genellikle gerekli
        // kimlik doğrulaması için, oturum kimliği genellikle çerez dosyasına kaydedilir.
        curl_setopt($curl, CURLOPT_COOKIEJAR, COOKIE_FILE);

        curl_setopt($curl, CURLOPT_USERAGENT, USER_AGENT);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($curl, CURLOPT_URL, LOGIN_FORM_URL);

        $html = curl_exec($curl);

        if (preg_match("/\<input type=\"hidden\" name=\"_csrf_token\" value=\"(.*)\" \/\>/", $html, $matches)) {
            $postValues["_csrf_token"] = $matches[1];
        }

        curl_setopt($curl, CURLOPT_URL, LOGIN_ACTION_URL);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postValues));
        curl_setopt($curl, CURLOPT_REFERER, LOGIN_FORM_URL);
        // Herhangi bir yönlendirmeyi takip etmek ister miyiz?
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);
        //Giriş istediğini çalıştıralım.
        curl_exec($curl);
        //Hata kontrolü
        if (curl_errno($curl)) {
            throw new Exception(curl_error($curl));
        }

        $store = curl_exec($curl);
        $url   = "https://dergipark.org.tr/en/journal/".$journal->d_id."/export/journal/json";
        curl_setopt($curl, CURLOPT_URL, $url);
        $rawData = curl_exec($curl);

        $value = json_decode($rawData, true);

        //https://dergipark.org.tr/media/cache/journal_header/00a6/a43d/712c/5ebc5971c2087.png
        $image = isset($value['image']) ? FileProcessing::download("https://dergipark.org.tr/media/cache/journal_croped/".strip_tags($value['image'])) : null;

        $image_header = isset($value['header']) ? FileProcessing::download("https://dergipark.org.tr/media/cache/journal_header/".strip_tags($value['header'])) : null;

        if ($journal) {
            $journal->update([
                'founded'         => isset($value['founded']) ? $value['founded'] : null,
                'url'             => isset($value['url']) ? $value['url'] : null,
                'address'         => isset($value['address']) ? $value['address'] : null,
                'phone'           => isset($value['phone']) ? $value['phone'] : null,
                'email'           => isset($value['email']) ? $value['email'] : null,
                'eissn'           => isset($value['eissn']) ? $value['eissn'] : null,
                'pissn'           => isset($value['issn']) ? $value['issn'] : null,
                'slug'            => isset($value['slug']) ? $value['slug'] : null,
                'printed'         => $value['printed'] ? 1 : 0,
                "image_id"        => $image ? $image->id : null,
                "image_header_id" => $image_header ? $image_header->id : null,
                'view_count'      => $value['view_count'],
                'download_count'  => $value['download_count'],
            ]);

            foreach ($value['languages'] as $val) {
                $this->findLang($val['code'], $val['name'], $val['rtl']);
            }

            // JournalInfo
            $jinfo_ids = [];
            foreach ($value['translations'] as $val) {
                $lang = $this->findLang($val['locale']);

                $data = [
                    'journal_id'     => $journal->id,
                    'd_id'           => $val['id'],
                    'lang_id'        => $lang->id,
                    'title'          => isset($val['title']) ? $val['title'] : null,
                    'subtitle'       => isset($val['subtitle']) ? $val['subtitle'] : null,
                    'description'    => isset($val['description']) ? strip_tags($val['description']) : null,
                    'title_abbr'     => isset($val['title_abbr']) ? $val['title_abbr'] : null,
                    'footer_text'    => isset($val['footer_text']) ? $val['footer_text'] : null,
                    'mail_signature' => isset($val['mail_signature']) ? $val['mail_signature'] : null,
                    'aim'            => isset($val['aim']) ? $val['aim'] : null,
                    'scope'          => isset($val['scope']) ? $val['scope'] : null,
                    'writing_rules'  => isset($val['writing_rules']) ? $val['writing_rules'] : null,
                    'policy'         => isset($val['policy']) ? $val['policy'] : null,
                ];

                $ji = JournalInfo::where('journal_id', $journal->id)->where('lang_id', $lang->id);

                if ($ji->first()) {
                    $ji->update($data);
                    $jionfo_ids[] = $ji->first()->id;
                } else {
                    $jinfo_ids[] = JournalInfo::create($data)->id;
                }
            }
            JournalInfo::where('journal_id', $journal->id)->whereNotIn('id', $jinfo_ids)->delete();

            // ArticleTypes
            $ArticleType_ids = [];
            foreach ($value['article_types'] as $valu) {
                foreach ($valu['translations'] as $val) {
                    $ArticleType = ArticleTypes::where('d_id', $val['id'])->first();
                    $lang        = $this->findLang($val['locale']);
                    if ( ! $ArticleType) {
                        $ArticleType = ArticleTypes::create([
                            'd_id'    => $val['id'],
                            'lang_id' => $lang->id,
                            'name'    => $val['name'],
                        ]);
                    }

                    $data = [
                        'journal_id'      => $journal->id,
                        'article_type_id' => $ArticleType->id,
                    ];

                    if ( ! JournalToArticleType::where($data)->first()) {
                        JournalToArticleType::insert($data);
                    }

                    $ArticleType_ids[] = $ArticleType->id;
                }
            }
            JournalToArticleType::where('journal_id', $journal->id)->whereNotIn('article_type_id', $ArticleType_ids)->delete();


            // Subjects
            $subject_ids = [];
            foreach ($value['subjects'] as $valu) {
                foreach ($valu['translations'] as $val) {
                    $subject = Subjects::where('d_id', $val['id'])->first();
                    $lang    = $this->findLang($val['locale']);
                    if ( ! $subject) {
                        $subject = Subjects::create([ // Subject
                            'd_id'    => $val['id'],
                            'lang_id' => $lang->id,
                            'name'    => $val['subject'],
                        ]);
                    }

                    $data = [
                        'journal_id' => $journal->id,
                        'subject_id' => $subject->id,
                    ];

                    if ( ! JournalToSubject::where($data)->first()) {
                        JournalToSubject::insert($data);
                    }

                    $subject_ids[] = $subject->id;
                }
            }
            JournalToSubject::where('journal_id', $journal->id)->whereNotIn('subject_id', $subject_ids)->delete();


            // Publishers
            $publisher_ids = [];
            foreach ($value['publisher']['translations'] as $val) {
                $publisher = Publishers::where('d_id', $val['id'])->first();
                $lang      = $this->findLang($val['locale']);
                if ( ! $publisher) {
                    $publisher = Publishers::create([
                        'd_id'         => $val['id'],
                        'lang_id'      => $lang->id,
                        'name'         => $value['publisher']['translations'][''.$lang->code.'']['name'],
                        'email'        => isset($value['publisher']['email']) ? $value['publisher']['email'] : null,
                        'lft'          => $value['publisher']['lft'] ? 1 : 0,
                        'address_lat'  => isset($value['publisher']['address_lat']) ? $value['publisher']['address_lat'] : null,
                        'address_long' => isset($value['publisher']['address_long']) ? $value['publisher']['address_long'] : null,
                    ]);
                } else {
                    $publisher->update([
                        'lang_id'      => $lang->id,
                        'name'         => $value['publisher']['translations'][''.$lang->code.'']['name'],
                        'email'        => isset($value['publisher']['email']) ? $value['publisher']['email'] : null,
                        'lft'          => $value['publisher']['lft'] ? 1 : 0,
                        'address_lat'  => isset($value['publisher']['address_lat']) ? $value['publisher']['address_lat'] : null,
                        'address_long' => isset($value['publisher']['address_long']) ? $value['publisher']['address_long'] : null,
                    ]);
                }

                $data = [
                    'journal_id'   => $journal->id,
                    'publisher_id' => $publisher->id,
                ];

                if ( ! JournalToPublisher::where($data)->first()) {
                    JournalToPublisher::insert($data);
                }

                $publisher_ids[] = $publisher->id;
            }
            JournalToPublisher::where('journal_id', $journal->id)->whereNotIn('publisher_id', $publisher_ids)->delete();


            // Countries
            $Countries_ids = [];
            $Countries     = Countries::where('d_id', $value['country']['id'])->first();
            if ( ! $Countries) {
                $Countries = Countries::create([
                    'd_id' => $value['country']['id'],
                    'name' => $value['country']['name'],
                ]);
            } else {
                $Countries->update([
                    'name' => $value['country']['name'],
                ]);
            }

            $data = [
                'journal_id'  => $journal->id,
                'countrie_id' => $Countries->id,
            ];

            if ( ! JournalToCountrie::where($data)->first()) {
                JournalToCountrie::insert($data);
            }

            $Countries_ids[] = $Countries->id;

            JournalToCountrie::where('journal_id', $journal->id)->whereNotIn('countrie_id', $Countries_ids)->delete();

        }

        return response($value, 200);
    }

    public function getissues(Request $request)
    {
        $journal = Journals::where('id', $request->row['id'])->first();

        //Bir user agent oluşturalım ki tarayıcı kızmasın.
        define('USER_AGENT', 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.2309.372 Safari/537.36');

        //Çerez bilgimizin nerede depolanacağı (kimlik doğrulama için gerekli).
        define('COOKIE_FILE', 'cookie.txt');

        //CURL'yi başlat.
        $curl = curl_init();

        // Herhangi bir HTTPS hatası almak istemiyoruz.
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        // Çerez ayrıntılarımızın nerede saklandığı bilgisi. Bu genellikle gerekli
        // kimlik doğrulaması için, oturum kimliği genellikle çerez dosyasına kaydedilir.
        curl_setopt($curl, CURLOPT_COOKIEJAR, COOKIE_FILE);

        curl_setopt($curl, CURLOPT_USERAGENT, USER_AGENT);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $url = "https://dergipark.org.tr/tr/pub/".$journal->slug."/archive";

        curl_setopt($curl, CURLOPT_URL, $url);

        $html = curl_exec($curl);

        $re = '/pub\/'.$journal->slug.'\/issue\/(.*)/';
        preg_match_all($re, $html, $matches);

        if ( ! empty($matches[1])) {
            foreach ($matches[1] as $item) {
                $volume = Volumes::where('d_id', $item)->first();
                if ( ! $volume) {
                    Volumes::create([
                        'journal_id' => $journal->id,
                        'd_id'       => $item,
                    ]);
                }
            }

        }

        return response($journal->slug, 200);

    }


    public function store(Request $request)
    {
        if ($request->json_file["id"] == null) {
            return [];
        }

        $dosya   = Dosyalar::where('id', $request->json_file["id"])->first();
        $rawData = Storage::cloud()->get($dosya["g_dosyaismi"]);

        $value = json_decode($rawData, true);

        $journal = Journals::where('d_id', $value['id'])->first();

        //https://dergipark.org.tr/media/cache/journal_header/00a6/a43d/712c/5ebc5971c2087.png
        $image = isset($value['image']) ? FileProcessing::download("https://dergipark.org.tr/media/cache/journal_header/".$value['image']) : null;

        //https://dergipark.org.tr/media/cache/journal_croped/98f7/cd8a/3506/5ebc58347e102.png
        $image_header = isset($value['header']) ? FileProcessing::download("https://dergipark.org.tr/media/cache/journal_croped/".$value['header']) : null;

        if ( ! $journal) {
            $journal = Journals::create([
                'd_id'            => $value['id'],
                'json_id'         => $dosya['id'],
                'founded'         => isset($value['founded']) ? $value['founded'] : null,
                'url'             => isset($value['url']) ? $value['url'] : null,
                'address'         => isset($value['address']) ? $value['address'] : null,
                'phone'           => isset($value['phone']) ? $value['phone'] : null,
                'email'           => isset($value['email']) ? $value['email'] : null,
                'eissn'           => isset($value['eissn']) ? $value['eissn'] : null,
                'pissn'           => isset($value['pissn']) ? $value['pissn'] : null,
                'slug'            => isset($value['slug']) ? $value['slug'] : null,
                'printed'         => $value['printed'] ? 1 : 0,
                "image_id"        => $image ? $image->id : null,
                "image_header_id" => $image_header ? $image_header->id : null,
                'view_count'      => $value['view_count'],
                'download_count'  => $value['download_count'],
            ]);

            foreach ($value['languages'] as $val) {
                $this->findLang($val['code'], $val['name'], $val['rtl']);
            }

            foreach ($value['translations'] as $val) {
                $lang = $this->findLang($val['locale']);
                JournalInfo::create([
                    'journal_id'     => $journal->id,
                    'd_id'           => $val['id'],
                    'lang_id'        => $lang->id,
                    'title'          => isset($val['title']) ? $val['title'] : null,
                    'subtitle'       => isset($val['subtitle']) ? $val['subtitle'] : null,
                    'description'    => isset($val['description']) ? strip_tags($val['description']) : null,
                    'title_abbr'     => isset($val['title_abbr']) ? $val['title_abbr'] : null,
                    'footer_text'    => isset($val['footer_text']) ? $val['footer_text'] : null,
                    'mail_signature' => isset($val['mail_signature']) ? $val['mail_signature'] : null,
                    'aim'            => isset($val['aim']) ? $val['aim'] : null,
                    'scope'          => isset($val['scope']) ? $val['scope'] : null,
                    'writing_rules'  => isset($val['writing_rules']) ? $val['writing_rules'] : null,
                    'policy'         => isset($val['policy']) ? $val['policy'] : null,
                ]);


            }


            foreach ($value['article_types'] as $valu) {
                foreach ($valu['translations'] as $val) {
                    $ArticleType = ArticleTypes::where('d_id', $val['id'])->first();
                    $lang        = $this->findLang($val['locale']);
                    if ( ! $ArticleType) {
                        $ArticleType = ArticleTypes::create([
                            'd_id'    => $val['id'],
                            'lang_id' => $lang->id,
                            'name'    => $val['name'],
                        ]);
                    }

                    JournalToArticleType::insert([
                        'journal_id'      => $journal->id,
                        'article_type_id' => $ArticleType->id,
                    ]);
                }
            }


            foreach ($value['subjects'] as $valu) {
                foreach ($valu['translations'] as $val) {
                    $subject = Subjects::where('d_id', $val['id'])->first();
                    $lang    = $this->findLang($val['locale']);
                    if ( ! $subject) {
                        $subject = Subjects::create([ // Subject
                            'd_id'    => $val['id'],
                            'lang_id' => $lang->id,
                            'name'    => $val['subject'],
                        ]);
                    }

                    JournalToSubject::insert([
                        'journal_id' => $journal->id,
                        'subject_id' => $subject->id,
                    ]);
                }
            }

            foreach ($value['publisher']['translations'] as $val) {
                $publisher = Publishers::where('d_id', $val['id'])->first();
                $lang      = $this->findLang($val['locale']);
                if ( ! $publisher) {
                    $publisher = Publishers::create([
                        'd_id'         => $val['id'],
                        'lang_id'      => $lang->id,
                        'name'         => $value['publisher']['translations'][''.$lang->code.'']['name'],
                        'email'        => isset($value['publisher']['email']) ? $value['publisher']['email'] : null,
                        'lft'          => $value['publisher']['lft'] ? 1 : 0,
                        'address_lat'  => isset($value['publisher']['address_lat']) ? $value['publisher']['address_lat'] : null,
                        'address_long' => isset($value['publisher']['address_long']) ? $value['publisher']['address_long'] : null,
                    ]);
                } else {
                    $publisher->update([
                        'lang_id'      => $lang->id,
                        'name'         => $value['publisher']['translations'][''.$lang->code.'']['name'],
                        'email'        => isset($value['publisher']['email']) ? $value['publisher']['email'] : null,
                        'lft'          => $value['publisher']['lft'] ? 1 : 0,
                        'address_lat'  => isset($value['publisher']['address_lat']) ? $value['publisher']['address_lat'] : null,
                        'address_long' => isset($value['publisher']['address_long']) ? $value['publisher']['address_long'] : null,
                    ]);
                }

                JournalToPublisher::insert([
                    'journal_id'   => $journal->id,
                    'publisher_id' => $publisher->id,
                ]);
            }

            $Countries = Countries::where('d_id', $value['country']['id'])->first();
            if ( ! $Countries) {
                $Countries = Countries::create([
                    'd_id' => $value['country']['id'],
                    'name' => $value['country']['name'],
                ]);
            } else {
                $Countries->update([
                    'name' => $value['country']['name'],
                ]);
            }

            JournalToCountrie::insert([
                'journal_id'  => $journal->id,
                'countrie_id' => $Countries->id,
            ]);

        } else {
            $journal->update([
                'json_id'         => $dosya['id'],
                'founded'         => isset($value['founded']) ? $value['founded'] : null,
                'url'             => isset($value['url']) ? $value['url'] : null,
                'address'         => isset($value['address']) ? $value['address'] : null,
                'phone'           => isset($value['phone']) ? $value['phone'] : null,
                'email'           => isset($value['email']) ? $value['email'] : null,
                'eissn'           => isset($value['eissn']) ? $value['eissn'] : null,
                'pissn'           => isset($value['pissn']) ? $value['pissn'] : null,
                'slug'            => isset($value['slug']) ? $value['slug'] : null,
                'printed'         => $value['printed'] ? 1 : 0,
                "image_id"        => $image ? $image->id : null,
                "image_header_id" => $image_header ? $image_header->id : null,
                'view_count'      => $value['view_count'],
                'download_count'  => $value['download_count'],
            ]);
        }

        return response(null, 200);
    }

    public
    function update(
        Request $request,
        $id
    ) {
    }

    public
    function destroy(
        $id
    ) {
        Journals::findOrFail($id)->delete();

        return response(null, 204);
    }


    private function findLang(
        $code,
        $name = null,
        $rtl = null
    ) {
        $Language = Languages::where('code', $code)->first();
        if ( ! $Language) {
            $Language = Languages::create([
                'code' => $code,
                'name' => $name,
                'rtl'  => $rtl ? 1 : 0,
            ]);
        }

        return $Language;
    }
}
