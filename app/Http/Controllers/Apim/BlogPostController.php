<?php

namespace App\Http\Controllers\Apim;

use App\Http\Controllers\Controller;
use App\Models\BlogCategories;
use App\Models\BlogPost;
use App\Models\BlogTags;
use App\Models\BlogToCategorie;
use App\Models\BlogToTag;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class BlogPostController extends Controller
{
    public function index()
    {
        $itemPerPage = request()->query('itemPerPage');
        $query       = request()->query('query');
        $data        = BlogPost::with([]);

        $sort = request()->query('sort');
        if ($sort) {
            $data = $data->orderBy($sort, request()->query('desc') == "true" ? 'desc' : 'ASC');
        }

        $keyword_tag = request()->query('keyword_tag');
        if ($keyword_tag) {
            $data = $data->whereHas('tags', function ($query) use ($keyword_tag) {
                $query->where('tag_id', $keyword_tag);
            });
        }

        if ($query) {
            $data = $data->where(function ($query2) use ($query) {
                $query2
                    ->where('name', 'LIKE', '%'.$query.'%');
            });
        }

        $ids = request()->query('ids');
        if ($ids) {
            $ids = explode("|", $ids);

            $data = $data->where(function ($query2) use ($ids) {
                $query2->where('id', $ids[0]);

                for ($i = 1; $i < count($ids); ++$i) {
                    $query2->orWhere('id', $ids[$i]);
                }
            });
        }

        if ( ! auth('api')->check()) {
            $data = $data->where('aktiv', 1);
        }

        if ($itemPerPage == -1) {
            return [
                "data"      => $data->get(),
                "last_page" => 1
            ];
        } else {
            return $data->paginate($itemPerPage);
        }
    }

    public function search($term)
    {
        $found = BlogPost::where('name', 'LIKE', '%'.$term.'%')
                         ->where('aktiv', 1)
                         ->orWhere(function ($query) use ($term) {
                             $query->orWhereHas('tags', function ($query) use ($term) {
                                 $query->whereHas('tag', function ($query) use ($term) {
                                     $query->where('name', 'LIKE', '%'.$term.'%');
                                 });
                             })->orWhereHas('categories', function ($query) use ($term) {
                                 $query->whereHas('category', function ($query) use ($term) {
                                     $query->where('name', 'LIKE', '%'.$term.'%');
                                 });
                             });
                         })
                         ->take(10)
                         ->get();

        return $found;
    }

    public function show($id)
    {
        return BlogPost::findOrFail($id);
    }

    public function showBySlug($slug)
    {
        return BlogPost::where('slug', $slug)->where('aktiv', 1)->first();
    }

    public function store(Request $request)
    {
        $post = BlogPost::create([
            "name"             => $request->name,
            "user_id"          => isset($request->user) ? $request->user["id"] : auth('api')->user()->id,
            "slug"             => $request->slug,
            "aktiv"            => $request->aktiv ? 1 : 0,
            "featured_file_id" => isset($request->featured_file) ? $request->featured_file["id"] : null,
            "meta_title"       => $request->meta_title,
            "meta_description" => $request->meta_description,
            "meta_keywords"    => $request->meta_keywords,
            "abstract"         => $request->abstract,
            "content_value"    => $request->content_value,
            "focused"          => $request->focused,
            'published_at'     => isset($request->published_at) ? $request->published_at : ($request->aktiv ? Carbon::now() : null)
        ]);

        // Tags
        if ($request->tags) {
            foreach ($request->tags as $tag) {
                BlogToTag::insert([
                    "blog_id" => $post->id,
                    "tag_id"  => $tag['tag']['id']
                ]);
            }
        }

        // Categories
        if ($request->categories) {
            foreach ($request->categories as $tag) {
                BlogToCategorie::insert([
                    "blog_id"     => $post->id,
                    "category_id" => $tag['category']['id']
                ]);
            }
        }

        return $post;
    }

    public function update(Request $request, $id)
    {
        $post = BlogPost::where('id', $id)->first();

        BlogPost::where('id', $id)->update([
            "name"             => $request->name,
            "user_id"          => isset($request->user) ? $request->user["id"] : auth('api')->user()->id,
            "slug"             => $request->slug,
            "aktiv"            => $request->aktiv ? 1 : 0,
            "featured_file_id" => isset($request->featured_file) ? $request->featured_file["id"] : null,
            "meta_title"       => $request->meta_title,
            "meta_description" => $request->meta_description,
            "meta_keywords"    => $request->meta_keywords,
            "abstract"         => $request->abstract,
            "content_value"    => $request->content_value,
            "focused"          => $request->focused,
            "published_at"     => $request->published_at ? $request->published_at : ($post->aktiv == 0 && $request->aktiv ? Carbon::now() : $post->published_at)
        ]);

        // Tags
        if ($request->tags) {
            $ids = [];

            foreach ($request->tags as $tag) {
                array_push($ids, $tag['tag']['id']);

                $blogToTag = BlogToTag::where('blog_id', $id)->where('tag_id', $tag['tag']['id'])->first();
                if ( ! $blogToTag) {
                    BlogToTag::insert([
                        "blog_id" => $id,
                        "tag_id"  => $tag['tag']['id']
                    ]);
                }
            }

            BlogToTag::where('blog_id', $id)->whereNotIn('tag_id', $ids)->delete();
        }

        // Categories
        if ($request->categories) {
            $ids = [];

            foreach ($request->categories as $tag) {
                array_push($ids, $tag['category']['id']);

                $blogToTag = BlogToCategorie::where('blog_id', $id)->where('category_id', $tag['category']['id'])->first();
                if ( ! $blogToTag) {
                    BlogToCategorie::insert([
                        "blog_id"     => $id,
                        "category_id" => $tag['category']['id']
                    ]);
                }
            }

            BlogToCategorie::where('blog_id', $id)->whereNotIn('category_id', $ids)->delete();
        }

        return $this->show($id);
    }

    public function destroy($id)
    {
        $category = BlogPost::findOrFail($id);
        $category->delete();

        return response(null, 204);
    }
}
