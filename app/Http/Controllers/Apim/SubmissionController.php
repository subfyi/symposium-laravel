<?php

namespace App\Http\Controllers\Apim;

use App\Http\Controllers\Controller;
use App\Mail\PaperApprovedMail;
use App\Mail\PaperCommentMail;
use App\Mail\PaperMail;
use Illuminate\Http\Request;
use App\Models\Articles;
use App\Models\Gorevicerik;
use App\Models\Kullanicilar;
use App\Models\Parameters;
use App\Models\Authors;
use Illuminate\Support\Facades\Mail;
use Exception;
use Illuminate\Support\Str;

class SubmissionController extends Controller
{
    public function index()
    {
        $itemPerPage = request()->query('itemPerPage');
        $query       = request()->query('query');

        $data = Articles::with([
            'user', 'authors', 'dosyalar', 'dosyalar.user', 'topic', 'parampre',
            'parampap', 'abstract_dosya', 'full_paper_dosya',
            'poster_presentation_dosya', 'video'
        ]);

        $pap_status = request()->query('pap_status');
        if ($pap_status) {
            $data = $data->where('pap_status', $pap_status);
        }else{
            $data = $data->where('pap_status', '!=', 3);
        }


        $presentation = request()->query('presentation');
        if ($presentation) {
            $data = $data->where('video_approved', 1);
        }

        if ((auth('api')->check() && auth('api')->user()->role != 9) && ! $presentation) {
            $data = $data->where('pap_creater', auth('api')->user()->id);
        }


        $year = request()->query('year');
        if ($year) {
            $data = $data->where('title_year', $year);
        }

        $posters = request()->query('posters');
        if ($posters) {
            $data = $data->where('pre_type', 98);
        }

        $orals = request()->query('orals');
        if ($orals) {
            $data = $data
                ->whereIn('pre_type', [463, 116, 97]);
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

        if ( ! auth('api')->check()) {
            foreach ($ret['data'] as $row) {
                foreach ($row["authors"] as $author) {
                    $author["email"] = null;
                }
            }
        }

        return $ret;
    }

    public function show($id)
    {
        $all = Articles::with('user', 'authors', 'dosyalar', 'dosyalar.user', 'topic',
            'parampre', 'parampap', 'abstract_dosya', 'full_paper_dosya',
            'poster_presentation_dosya', 'icerikler', 'icerikler.user', 'video')->findOrFail($id);

        if ((auth('api')->check() && auth('api')->user()->role != 9 && $all->user->id !== auth('api')->user()->id) && ! $all->video_approved) {
            throw new Exception("Yetkiniz yok");
        }

        return $all;
    }

    public function store(Request $request)
    {
        $pap_keywords = $request->pap_keyword;

        $keywords = explode("|", $request->pap_keyword);
        foreach ($keywords as $val) {
            if ( ! Parameters::where('type', 'tagcon')->where('value', $val)->exists()) {
                Parameters::create([
                    'type'     => 'tagcon',
                    'value'    => $val,
                    'item_num' => 1
                ]);
            }
        }

        $gorev = Articles::create([
            'en_title'               => $request->en_title,
            'en_abstract'            => $request->en_abstract,
            'pap_keyword'            => $pap_keywords,
            'pap_topic_p'            => isset($request->topic) ? $request->topic["id"] : null,
            'pre_type'               => isset($request->parampre) ? $request->parampre["id"] : null,
            'pap_type'               => isset($request->parampap) ? $request->parampap["id"] : null,
            'mes_congress'           => $request->mes_congress,
            'pap_creater'            => auth('api')->user()->id,
            'slug'                   => Str::slug($request->en_title),
            'abstract_dosya_id'      => isset($request->abstract_dosya) ? $request->abstract_dosya['id'] : null,
            'full_paper_dosya_id'    => isset($request->full_paper_dosya) ? $request->full_paper_dosya['id'] : null,
            'poster_presentation_id' => isset($request->poster_presentation_dosya) ? $request->poster_presentation_dosya['id'] : null,
            'video_id'               => isset($request->video) ? $request->video["id"] : null,
            'video_approved'         => $request->video_approved,
            'title_year'             => isset($request->title_year) ? $request->title_year : "2023",
            'paper_approved'         => isset($request->paper_approved) ? $request->paper_approved : 0
        ]);

        $id = $gorev->id;

        if (isset($request->authors)) {
            foreach ($request->authors as $author) {
                Authors::create([
                    'p_id'       => $id,
                    'p_user'     => auth('api')->user()->id,
                    'email'      => $author['email'],
                    'first_name' => $author['first_name'],
                    'last_name'  => $author['last_name'],
                    'adress'     => $author['adress'],
                    'correspond' => isset($author['correspond']) ? $author['correspond'] : false,
                    'presenter'  => isset($author['correspond']) ? $author['presenter'] : false
                ]);
            }
        }


        return $this->show($id);
    }

    public function update(Request $request, $id)
    {
        $all = Articles::with('user')->findOrFail($id);

        if (auth('api')->user()->role != 9 && $all->user->id !== auth('api')->user()->id) {
            throw new Exception("Yetkiniz yok");
        }

        $pap_keywords = $request->pap_keyword;

        $keywords = explode("|", $request->pap_keyword);
        foreach ($keywords as $val) {
            if ( ! Parameters::where('type', 'tagcon')->where('value', $val)->exists()) {
                Parameters::create([
                    'type'     => 'tagcon',
                    'value'    => $val,
                    'item_num' => 1
                ]);
            }
        }

        $old_gorev = Articles::where('id', $id)->first();

        Articles::where('id', $id)->update([
            'en_title'               => $request->en_title,
            'en_abstract'            => $request->en_abstract,
            'pap_keyword'            => $pap_keywords,
            'pap_topic_p'            => isset($request->topic) ? $request->topic["id"] : null,
            'pre_type'               => isset($request->parampre) ? $request->parampre["id"] : null,
            'pap_type'               => isset($request->parampap) ? $request->parampap["id"] : null,
            'mes_congress'           => $request->mes_congress,
            'slug'                   => Str::slug($request->en_title),
            'abstract_dosya_id'      => isset($request->abstract_dosya) ? $request->abstract_dosya['id'] : null,
            'full_paper_dosya_id'    => isset($request->full_paper_dosya) ? $request->full_paper_dosya['id'] : null,
            'poster_presentation_id' => isset($request->poster_presentation_dosya) ? $request->poster_presentation_dosya['id'] : null,
            'video_id'               => isset($request->video) ? $request->video["id"] : null,
            'video_approved'         => $request->video_approved,
            'title_year'             => isset($request->title_year) ? $request->title_year : "2023",
            'paper_approved'         => isset($request->paper_approved) ? $request->paper_approved : 0
        ]);

        if (isset($request->authors)) {
            $varolanlar = Authors::where('p_id', $id)->get();
            $ids        = array_map(function ($kull) {
                return empty($kull['id']) ? 0 : $kull['id'];
            }, $request->authors);

            foreach ($varolanlar as $varolan) {
                if ( ! in_array($varolan->id, $ids)) {
                    Authors::destroy($varolan->id);
                }
            }

            foreach ($request->authors as $author) {
                $data = [
                    'p_id'       => $id,
                    'p_user'     => auth('api')->user()->id,
                    'email'      => $author['email'],
                    'first_name' => $author['first_name'],
                    'last_name'  => $author['last_name'],
                    'adress'     => $author['adress'],
                    'correspond' => isset($author['correspond']) ? $author['correspond'] : false,
                    'presenter'  => isset($author['correspond']) ? $author['presenter'] : false
                ];

                if (empty($author['id'])) {
                    $dest_id = Authors::create($data)->id;
                } else {
                    $dest_id = $author['id'];
                    Authors::where('id', $dest_id)->update($data);
                }
            }
        }

        $gorev = Articles::where('id', $id)->first();
        $user  = Authors::where('p_id', $gorev->id)->where('correspond', 1)->first();

        if ($old_gorev->paper_approved != $request->paper_approved && $request->paper_approved) {
            Mail::send(new PaperApprovedMail($user, $gorev));
        }

        if (isset($request->icerikler)) {
            $ids = [];

            foreach ($request->icerikler as $icerik) {
                $data = [
                    'slug'     => $all->slug,
                    'isicerik' => $icerik['isicerik']
                ];

                if (isset($icerik['id'])) {
                    Gorevicerik::where('id', $icerik['id'])->update($data);
                    $ids[] = $icerik['id'];
                } else {
                    $data['grv_icerik_olusturan'] = auth('api')->id();
                    $ids[]                        = Gorevicerik::create($data)->id;

                    Mail::send(new PaperCommentMail($user, $gorev));
                }
            }

            Gorevicerik::where('slug', $all->slug)->whereNotIn('id', $ids)->delete();
        }


        return $this->show($id);
    }


    public function restore($id)
    {
        Articles::where('id', $id)->update(['pap_status' => '0']);

        return response(null, 204);
    }

    public function destroy($id)
    {
        Articles::where('id', $id)->update(['pap_status' => '3']);

        return response(null, 204);
    }
}
