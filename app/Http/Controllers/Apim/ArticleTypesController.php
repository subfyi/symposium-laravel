<?php

namespace App\Http\Controllers\Apim;

use App\Http\Controllers\Controller;
use App\Models\ArticleTypes;
use App\Models\Keywords;
use Illuminate\Http\Request;

class ArticleTypesController extends Controller
{
    public function index()
    {
        $itemPerPage = request()->query('itemPerPage');
        $query = request()->query('query');
        $data = ArticleTypes::with([]);

        $sort = request()->query('sort');
        if ($sort) {
            $data = $data->orderBy($sort, request()->query('desc') == "true" ? 'desc' : 'ASC');
        }

        if ($query) {
            $data = $data->where(function ($query2) use ($query) {
                $query2
                    ->where('name', 'LIKE', '%' . $query . '%');
            });
        }

        if (request()->query('language')) {
            $data = $data->where(function ($query2) use ($query) {
                $query2
                    ->where('lang_id', request()->query('language'));
            });
        }

        $ids = request()->query('ids');
        if($ids) {
            $ids = explode("|", $ids);

            $data = $data->where(function ($query2) use ($ids) {
                $query2->where('id', $ids[0]);

                for($i = 1; $i < count($ids); ++$i) {
                    $query2->orWhere('id', $ids[$i]);
                }
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
        return ArticleTypes::findOrFail($id);
    }

    public function store(Request $request)
    {
        $post = ArticleTypes::where('name', $request->name)->first();
        if ($post) {
            return $post;
        }

        $post = ArticleTypes::create([
            "name" => $request->name
        ]);

        return $this->show($post->id);
    }

    public function update(Request $request, $id)
    {
        ArticleTypes::where('id', $id)->update([
            "name" => $request->name
        ]);

        return $this->show($id);
    }

    public function destroy($id)
    {
        $category = ArticleTypes::findOrFail($id);
        $category->delete();

        return response(null, 204);
    }
}
