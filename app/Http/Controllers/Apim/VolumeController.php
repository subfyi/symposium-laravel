<?php

namespace App\Http\Controllers\Apim;

use App\Facades\FileProcessing;
use App\Http\Controllers\Controller;
use App\Models\ArticleInfo;
use App\Models\ArticleToArticleType;
use App\Models\ArticleToAuthor;
use App\Models\ArticleToCitation;
use App\Models\ArticleTypes;
use App\Models\Citations;
use App\Models\ArticleToFiles;
use App\Models\ArticleToKeyword;
use App\Models\Dosyalar;
use App\Models\Files;
use App\Models\JournalInfo;
use App\Models\Journals;
use App\Models\JournalToArticleType;
use App\Models\JournalToSubject;
use App\Models\Languages;
use App\Models\Subjects;
use App\Models\ArticleToSubject;
use App\Models\Types;
use App\Models\Keywords;
use App\Models\Volumes;
use App\Models\VolumeToFiles;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Articles;
use App\Models\Authors;
use Illuminate\Support\Facades\Storage;
use Vedmant\FeedReader\Facades\FeedReader;

class VolumeController extends Controller
{
    public function index()
    {
        $itemPerPage = request()->query('itemPerPage');
        $query       = request()->query('query');

        $data = Volumes::with([
            'articles', 'journalto',
        ]);

        $journal_id = request()->query('journal_id');
        if ($journal_id) {
            $data = $data->whereHas('journalto', function ($query) use ($journal_id) {
                $query->where('id', $journal_id);
            });
        }

        $volume = request()->query('volume');
        if ($volume) {
            $data = $data->where('volume', '=', $volume);
        }

        $issue = request()->query('issue');
        if ($issue) {
            $data = $data->where('issue', '=', $issue);
        }


        $sort = request()->query('sort');
        if ($sort) {
            $data = $data->orderBy($sort, request()->query('desc') == "true" ? 'desc' : 'ASC');
        }

        if ($query) {
            $data = $data->where(function ($query2) use ($query) {
                $query2
                    ->where('en_title', 'LIKE', '%'.$query.'%');
            });
        }

        if ($itemPerPage == -1) {
            $ret = [
                "data"      => $data->get(),
                "last_page" => 1
            ];
        } else {
            $ret = $data->paginate($itemPerPage);
        }

        return $ret;
    }

    public function getarticles(Request $request)
    {

        $volume  = Volumes::where('id', $request->row['id'])->first();
        $journal = Journals::where('id', $volume->journal_id)->first();

        //https://dergipark.org.tr/tr/journal/2937/export/issue/57223/json
        $url = "https://dergipark.org.tr/tr/journal/".$journal->d_id."/export/issue/".$volume->d_id."/json";

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
        curl_setopt($curl, CURLOPT_URL, $url);
        $rawData = curl_exec($curl);

        $jsonValue = json_decode($rawData, true);

        if ($journal && $volume && $jsonValue) {

            //https://dergipark.org.tr/media/cache/issue_cover_medium/1f1a/9d38/945d/5f44047a9e823.png
            $cover = isset($jsonValue['cover']) ? FileProcessing::download("https://dergipark.org.tr/media/cache/issue_cover_medium/".strip_tags($jsonValue['cover'])) : null;

            // Volumes & Issues
            $volume->update([
                'volume'         => isset($jsonValue['volume']) ? (int) $jsonValue['volume'] : null,
                'issue'          => isset($jsonValue['number']) ? (int) $jsonValue['number'] : null,
                'special'        => $jsonValue['special'] ? 1 : 0,
                "cover_id"       => $cover ? $cover->id : null,
                'year'           => isset($jsonValue['year']) ? $jsonValue['year'] : null,
                'date_published' => Carbon::parse($jsonValue['date_published']),
                'season'         => isset($jsonValue['season']) ? $jsonValue['season'] : null,
                'supplement'     => $jsonValue['supplement'] ? 1 : 0,
                'created_by'     => auth('api')->user()->id,
            ]);

            // issue_files
            foreach ($jsonValue['issue_files'] as $value) {
                foreach ($value['translations'] as $val) {
                    $vinfo_ids = [];
                    $lang      = $this->findLang($val['locale']);

                    $file = isset($value['file']) ? FileProcessing::download($value['file']) : null;

                    $data = [
                        'd_id'        => $val['id'],
                        'lang_id'     => $lang->id,
                        'volume_id'   => $volume->id,
                        'title'       => $val['title'],
                        'description' => $val['description'],
                        'file_id'     => $file->id,
                        'type'        => $value['type'],
                    ];

                    $ji = VolumeToFiles::where('d_id', $val['id'])->where('lang_id', $lang->id);

                    if ($ji->first()) {
                        $ji->update($data);
                        $vinfo_ids[] = $ji->first()->id;
                    } else {
                        $vinfo_ids[] = VolumeToFiles::create($data)->id;
                    }
                    VolumeToFiles::where('d_id', $val['id'])->whereNotIn('id', $vinfo_ids)->delete();
                }
            }


            foreach ($jsonValue['articles'] as $value) {

                $lang_prim = isset($value['primary_language']) ? $this->findLang($value['primary_language'])->id : 1;
                $data      = [
                    'd_id'             => $value['id'],
                    'v_id'             => $volume->id,
                    'status'           => isset($value['status']) ? $value['status'] : 0,
                    'anonymous'        => $value['anonymous'] ? 1 : 0,
                    'submission_date'  => isset($value['submission_date']) ? $value['submission_date'] : null,
                    'acceptance_date'  => isset($value['acceptance_date']) ? $value['acceptance_date'] : null,
                    'pubdate'          => isset($value['pubdate']) ? $value['pubdate'] : null,
                    'first_page'       => isset($value['first_page']) ? $value['first_page'] : null,
                    'last_page'        => isset($value['last_page']) ? $value['last_page'] : null,
                    'primary_language' => $lang_prim,
                    'order_num'        => isset($value['order_num']) ? $value['order_num'] : null,
                    'volume'           => $volume->volume,
                    'issue'            => $volume->issue,
                    'created_by'       => auth('api')->user()->id
                ];


                $_article = Articles::where('d_id', $value['id']);
                if ($_article->first()) {
                    $_article->update($data);
                    $article = $_article->first();
                } else {
                    $article = Articles::create($data);
                }


                foreach ($value['translations'] as $valu) {
                    $lang = $this->findLang($valu['locale']);

                    $data = [
                        'd_id'       => $valu['id'],
                        'v_id'       => $volume->id,
                        'article_id' => $article->id,
                        'lang_id'    => $lang->id,
                        'title'      => isset($valu['title']) ? $valu['title'] : null,
                        'abstract'   => isset($valu['abstract']) ? $valu['abstract'] : null,
                    ];

                    $ArticleInfo = ArticleInfo::where('v_id', $volume->id)->where('article_id', $article->id)->where('lang_id', $lang->id);
                    if ($ArticleInfo->first()) {
                        $ArticleInfo->update($data);
                    } else {
                        ArticleInfo::create($data)->id;
                    }

                    // Keywords
                    if (isset($valu['title'])) {
                        $keyword_ids = [];
                        $keywords    = explode(",", $valu['keywords']);
                        foreach ($keywords as $val) {
                            $keyword = Keywords::where('name', $val)->first();
                            if ( ! $keyword) {
                                $keyword = Keywords::create([
                                    'lang_id' => $lang->id,
                                    'name'    => $val,
                                ]);
                            }
                            $data = [
                                'article_id' => $article->id,
                                'keyword_id' => $keyword->id,
                            ];

                            if ( ! ArticleToKeyword::where($data)->first()) {
                                ArticleToKeyword::insert($data);
                            }

                            $keyword_ids[] = $keyword->id;

                        }
                        ArticleToKeyword::where('article_id', $article->id)->whereNotIn('keyword_id', $keyword_ids)->delete();
                    }
                }

                if (isset($value['article_type'])) {
                    // ArticleTypes
                    $ArticleType_ids = [];
                    foreach ($value['article_type']['translations'] as $val) {
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
                            'article_id'      => $article->id,
                            'article_type_id' => $ArticleType->id,
                        ];

                        if ( ! ArticleToArticleType::where($data)->first()) {
                            ArticleToArticleType::insert($data);
                        }

                        $ArticleType_ids[] = $ArticleType->id;
                    }
                    ArticleToArticleType::where('article_id', $article->id)->whereNotIn('article_type_id', $ArticleType_ids)->delete();

                }

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
                            'article_id' => $article->id,
                            'subject_id' => $subject->id,
                        ];

                        if ( ! ArticleToSubject::where($data)->first()) {
                            ArticleToSubject::insert($data);
                        }

                        $subject_ids[] = $subject->id;
                    }
                }
                ArticleToSubject::where('article_id', $article->id)->whereNotIn('subject_id', $subject_ids)->delete();


                // ArticleCitations
                $y            = 0;
                $citation_ids = [];
                foreach ($value['citations'] as $val) {
                    $citation = Citations::where('d_id', $val['id'])->first();
                    if ( ! $citation) {
                        $citation = Citations::create([
                            'article_id' => $article->id,
                            'd_id'       => $val['id'],
                            'raw'        => preg_replace('(\\[\\d+\\] ?)', '', $val['raw']),
                            'type'       => $val['type'],
                            'order'      => ++$y, // sor ??
                        ]);
                    }

                    $data = [
                        'article_id'  => $article->id,
                        'citation_id' => $citation->id,
                    ];

                    if ( ! ArticleToCitation::where($data)->first()) {
                        ArticleToCitation::insert($data);
                    }
                    $citation_ids[] = $citation->id;
                }
                ArticleToCitation::where('article_id', $article->id)->whereNotIn('citation_id', $citation_ids)->delete();

                // ArticleAuthors
                $author_ids = [];
                foreach ($value['article_authors'] as $author) {
                    $_author = Authors::where('d_id', $author['author']['id'])->first();

                    if ( ! $_author) {
                        $_author = Authors::create([
                            'd_id'        => isset($author['author']['id']) ? $author['author']['id'] : null,
                            'email'       => isset($author['author']['email']) ? $author['author']['email'] : null,
                            'first_name'  => isset($author['author']['first_name']) ? $author['author']['first_name'] : null,
                            'middle_name' => isset($author['author']['middle_name']) ? $author['author']['middle_name'] : null,
                            'last_name'   => isset($author['author']['last_name']) ? $author['author']['last_name'] : null,
                            'adress'      => isset($author['author']['adress']) ? $author['author']['adress'] : null,
                            'orcid'       => isset($author['author']['orcid']) ? $author['author']['orcid'] : null,
                        ]);
                    }

                    $data = [
                        'article_id' => $article->id,
                        'author_id'  => $_author->id,
                        'order'      => $author['author_order'],
                    ];

                    if ( ! ArticleToAuthor::where($data)->first()) {
                        ArticleToAuthor::insert($data);
                    }
                    $author_ids[] = $_author->id;
                }
                ArticleToAuthor::where('article_id', $article->id)->whereNotIn('author_id', $author_ids)->delete();


                // ArticleFiles
                $_file_ids = [];
                foreach ($value['article_files'] as $files) {
                    if (array_key_exists('file', $files)) {
                        $_file = Files::where('url', $files['file'])->first();
                        if ( ! $_file) {
                            $_file = isset($files['file']) ? FileProcessing::download($files['file']) : null;
                        }

                        $data = [
                            'article_id' => $article->id,
                            'file_id'    => $_file->id,
                        ];

                        if ( ! ArticleToFiles::where($data)->first()) {
                            ArticleToFiles::insert($data);
                        }
                        $_file_ids[] = $_file->id;
                    }
                    ArticleToFiles::where('article_id', $article->id)->whereNotIn('file_id', $_file_ids)->delete();
                }

            }

            return response($url, 200);
        } else {
            return response("else=".$url, 200);
        }

        return response(null, 204);
    }

    public function store(Request $request)
    {

        return $request;
    }

    public function destroy($id)
    {
        Articles::where('id', $id)->update(['pap_status' => '3']);

        return response(null, 204);
    }

    private function findLang($code, $name = null, $rtl = null)
    {
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
