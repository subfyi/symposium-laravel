<?php

namespace App\Http\Controllers\Apim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gorevler;
use App\Models\Gorevicerik;
use App\Models\Parameters;
use App\Models\Pauthor;
use Exception;

class SubmissionController extends Controller
{
    public function index()
    {
        $itemPerPage = request()->query('itemPerPage');
        $query = request()->query('query');
        $data = Gorevler::with(['user', 'authors', 'dosyalar', 'dosyalar.user', 'topic', 'parampre', 'parampap', 'abstract_dosya', 'full_paper_dosya', 'poster_presentation_dosya', 'video'])
            ->where('pap_status', '!=', 3);

        if(auth('api')->user()->yetki != 9) {
            $data = $data->where('pap_creater', auth('api')->user()->id);
        }

        $presentation = request()->query('presentation');
        if ($presentation) {
            $data = $data->where('video_approved', 1);
        }

        $sort = request()->query('sort');
        if ($sort) {
            $data = $data->orderBy($sort, request()->query('desc') == "true" ? 'desc' : 'ASC');
        }

        if ($query) {
            $data = $data->where(function ($query2) use ($query) {
                $query2
                    ->where('pap_title', 'LIKE', '%' . $query . '%');
            });
        }

        if ($itemPerPage == -1) {
            return [
                "data" => $data->get(),
                "last_page" => 1
            ];
        } else {
            return $data->paginate($itemPerPage);
        }
    }

    public function show($id)
    {
        $all = Gorevler::with('user', 'authors', 'dosyalar', 'dosyalar.user', 'topic', 'parampre', 'parampap', 'abstract_dosya', 'full_paper_dosya', 'poster_presentation_dosya', 'icerikler', 'icerikler.user', 'video')->findOrFail($id);

        if(auth('api')->user()->yetki != 9 && $all->user->id !== auth('api')->user()->id) {
            throw new Exception("Yetkiniz yok");
        }

        return $all;
    }

    public function store(Request $request)
    {
        $pap_keywords = $request->pap_keyword;

        $keywords = explode("|",$request->pap_keyword);
        foreach ($keywords as $val) {
            if(!Parameters::where('type', 'tagcon')->where('value', $val)->exists()) {
                Parameters::create([
                    'type' => 'tagcon',
                    'value' => $val,
                    'item_num' => 1
                ]);
            }
        }

        $id = Gorevler::create([
            'pap_title' => $request->pap_title,
            'pap_abstract' => $request->pap_abstract,
            'pap_keyword' => $pap_keywords,
            'pap_topic_p' => $request->pap_topic_p,
            'pre_type' => $request->pre_type,
            'pap_type' => $request->pap_type,
            'mes_congress' => $request->mes_congress,
            'pap_creater' => auth('api')->user()->id,
            'slug' => str_slug($request->pap_title),
            'abstract_dosya_id' => isset($request->abstract_dosya) ? $request->abstract_dosya['id'] : NULL,
            'full_paper_dosya_id' => isset($request->full_paper_dosya) ? $request->full_paper_dosya['id'] : NULL,
            'poster_presentation_id' => isset($request->poster_presentation_dosya) ? $request->poster_presentation_dosya['id'] : NULL,
            'video_id' => isset($request->video) ? $request->video["id"] : NULL,
            'video_approved' => $request->video_approved
        ])->id;

        if(isset($request->authors)) {
            foreach($request->authors as $author) {
                Pauthor::create([
                    'p_id' => $id,
                    'p_user' => auth('api')->user()->id,
                    'p_mail' => $author['p_mail'],
                    'name' => $author['name'],
                    'surname' => $author['surname'],
                    'correspond' => isset($author['correspond']) ? $author['correspond'] : false,
                    'presenter' => isset($author['correspond']) ? $author['presenter'] : false
                ]);
            }
        }

        return $id;
    }

    public function update(Request $request, $id)
    {
        $all = Gorevler::with('user')->findOrFail($id);

        if(auth('api')->user()->yetki != 9 && $all->user->id !== auth('api')->user()->id) {
            throw new Exception("Yetkiniz yok");
        }

        $pap_keywords = $request->pap_keyword;

        $keywords = explode("|",$request->pap_keyword);
        foreach ($keywords as $val) {
            if(!Parameters::where('type', 'tagcon')->where('value', $val)->exists()) {
                Parameters::create([
                    'type' => 'tagcon',
                    'value' => $val,
                    'item_num' => 1
                ]);
            }
        }

        Gorevler::where('id', $id)->update([
            'pap_title' => $request->pap_title,
            'pap_abstract' => $request->pap_abstract,
            'pap_keyword' => $pap_keywords,
            'pap_topic_p' => $request->pap_topic_p,
            'pre_type' => $request->pre_type,
            'pap_type' => $request->pap_type,
            'mes_congress' => $request->mes_congress,
            'slug' => str_slug($request->pap_title),
            'abstract_dosya_id' => isset($request->abstract_dosya) ? $request->abstract_dosya['id'] : NULL,
            'full_paper_dosya_id' => isset($request->full_paper_dosya) ? $request->full_paper_dosya['id'] : NULL,
            'poster_presentation_id' => isset($request->poster_presentation_dosya) ? $request->poster_presentation_dosya['id'] : NULL,
            'video_id' => isset($request->video) ? $request->video["id"] : NULL,
            'video_approved' => $request->video_approved
        ]);

        if(isset($request->authors)) {
            $varolanlar = Pauthor::where('p_id', $id)->get();
            $ids = array_map(function($kull) {
                return empty($kull['id']) ? 0 : $kull['id'];
            }, $request->authors);

            foreach($varolanlar as $varolan) {
                if(!in_array($varolan->id, $ids)) {
                    Pauthor::destroy($varolan->id);
                }
            }

            foreach($request->authors as $author) {
                $data = [
                    'p_id' => $id,
                    'p_user' => auth('api')->user()->id,
                    'p_mail' => $author['p_mail'],
                    'name' => $author['name'],
                    'surname' => $author['surname'],
                    'correspond' => isset($author['correspond']) ? $author['correspond'] : false,
                    'presenter' => isset($author['correspond']) ? $author['presenter'] : false
                ];

                if(empty($author['id'])) {
                    $dest_id = Pauthor::create($data)->id;
                } else {
                    $dest_id = $author['id'];
                    Pauthor::where('id', $dest_id)->update($data);
                }
            }
        }
        
        if(isset($request->icerikler)) {
            $ids = [];

            foreach($request->icerikler as $icerik) {
                $data = [
                    'slug' => $all->slug,
                    'isicerik' => $icerik['isicerik']
                ];

                if(isset($icerik['id'])) {
                    Gorevicerik::where('id', $icerik['id'])->update($data);
                    $ids[] = $icerik['id'];
                } else {
                    $data['grv_icerik_olusturan'] = auth('api')->id();
                    $ids[] = Gorevicerik::create($data)->id;
                }
            }

            Gorevicerik::where('slug', $all->slug)->whereNotIn('id', $ids)->delete();
        }

        return $id;
    }

    public function destroy($id)
    {
        Gorevler::where('id', $id)->update([ 'pap_status' => '3' ]);

        return response(null, 204);
    }
}
