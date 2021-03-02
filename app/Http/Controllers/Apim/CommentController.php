<?php

namespace App\Http\Controllers\Apim;

use App\Http\Controllers\Controller;
use App\Models\Ncomment;
use Illuminate\Http\Request;
use App\Mail\CommentMail;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    public function index($product_id = NULL, $tarife_id = NULL, $angebote_id = NULL, $post_id = NULL)
    {
        $itemPerPage = request()->query('itemPerPage');
        $query = request()->query('query');
        $data = Ncomment::with(['artikel', 'tarife', 'tarife.anbiater', 'angebote']);

        if (request()->query('sort')) {
            $data = $data->orderBy(request()->query('sort'), request()->query('desc') == "true" ? 'desc' : 'ASC');
        }

        if ($query) {
            $data = $data->where(function ($query2) use ($query) {
                $query2
                    ->where('ad', 'LIKE', '%' . $query . '%');
            });
        }

        if($product_id) {
            $data = $data->whereHas('artikel', function($query) use ($product_id) {
                $query->whereRaw('artikel.hersteller = (select hersteller from artikel where artikel_id = ' . $product_id . ')');
                $query->whereRaw('artikel.bezeichnung = (select bezeichnung from artikel where artikel_id = ' . $product_id . ')');
            });
        }

        if($tarife_id) {
            $data = $data->where('tarife_id', $tarife_id);
        }

        if($angebote_id) {
            $data = $data->where('angebote_id', $angebote_id);
        }

        if($post_id) {
            $data = $data->where('post_id', $post_id);
        }

        if(!auth('api')->check()) {
            $data = $data->where('aktiv', 1);
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

    public function tarife($tarif_id) {
        return $this->index(NULL, $tarif_id);
    }

    public function angebote($angebote_id) {
        return $this->index(NULL, NULL, $angebote_id);
    }

    public function blog($post_id) {
        return $this->index(NULL, NULL, NULL, $post_id);
    }

    public function post_comment(Request $request, $artikel_id = NULL, $tarife_id = NULL, $angebote_id = NULL, $post_id = NULL) {
        $val = Ncomment::create([
            'tarife_id' => $tarife_id,
            'artikel_id' => $artikel_id,
            'angebote_id' => $angebote_id,
            'post_id' => $post_id,
            'name' => $request->name,
            'email' => $request->mail,
            'comment' => $request->message,
            'star' => $request->rating,
            'aktiv' => 0,
            'error_mail_sent' => 1,
            'ip' => $request->ip(),
        ]);

        Mail::to('buraktamturk@gmail.com')->send(new CommentMail($val));

        return response(null, 204);
    }

    public function post_artikel_comment(Request $request, $artikel_id) {
        return $this->post_comment($request, $artikel_id);
    }

    public function post_tarife_comment(Request $request, $tarif_id) {
        return $this->post_comment($request, NULL, $tarif_id);
    }

    public function post_angebote_comment(Request $request, $angebote_id) {
        return $this->post_comment($request, NULL, NULL, $angebote_id);
    }

    public function post_blog_comment(Request $request, $post_id) {
        return $this->post_comment($request, NULL, NULL, NULL, $post_id);
    }

    public function show($id)
    {
        $kurum = Ncomment::with(['artikel', 'tarife', 'tarife.anbiater', 'angebote'])->findOrFail($id);

        return $kurum;
    }

    public function store(Request $request)
    {
        $hepsi = $request->all();
        $hepsi["ust_kategori"] = 0;
        $hepsi["slug"] = str_slug($hepsi["ad"]);

        $kurum = Ncomment::create($hepsi);

        return $kurum;
    }

    public function update(Request $request, $id)
    {
        $kurum = Ncomment::findOrFail($id);

        $hepsi = $request->all();
        $hepsi["ust_kategori"] = 0;

        $kurum->update($hepsi);

        return $kurum;
    }

    public function destroy($id)
    {
        $category = Ncomment::findOrFail($id);
        $category->delete();

        return response(null, 204);
    }
}
