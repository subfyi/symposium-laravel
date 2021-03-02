<?php

namespace App\Http\Controllers\Apim;

use App\Http\Controllers\Controller;
use App\Models\BlogCategories;
use App\Models\BlogTags;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $itemPerPage = request()->query('itemPerPage');
        $query = request()->query('query');
        $data = BlogCategories::with([]);

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

        if (!auth('api')->check()) {
            $data = $data->whereHas('blogs', function($query) {
                $query->whereHas('post', function($query) {
                    $query->where('aktiv', 1);
                });
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
        return BlogCategories::findOrFail($id);
    }

    public function showBySlug($slug)
    {
        return BlogCategories::where('slug', $slug)->first();
    }

    public function store(Request $request)
    {
        $post = BlogCategories::where('name', $request->name)->first();
        if ($post) {
            return $post;
        }

        $post = BlogCategories::create([
            "name" => $request->name,
            "slug" => Str::slug($request->name),
        ]);

        return $this->show($post->id);
    }

    public function update(Request $request, $id)
    {
        BlogCategories::where('id', $id)->update([
            "name" => $request->name,
            "slug" => $request->slug
        ]);

        return $this->show($id);
    }

    public function destroy($id)
    {
        $category = BlogCategories::findOrFail($id);
        $category->delete();

        return response(null, 204);
    }
}
