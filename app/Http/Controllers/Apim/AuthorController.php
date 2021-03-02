<?php

namespace App\Http\Controllers\Apim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Articles;
use App\Models\Parameters;
use App\Models\Authors;
use Illuminate\Support\Facades\DB;

class AuthorController extends Controller
{
    public function index()
    {
        $itemPerPage = request()->query('itemPerPage');
        $query = request()->query('query');
        $data = Authors::with([]);

        $sort = request()->query('sort');
        if ($sort) {
            $data = $data->orderBy($sort, request()->query('desc') == "true" ? 'desc' : 'ASC');
        }

        if ($query) {
            $data = $data->where(function ($query2) use ($query) {
                $query2
                    ->where('first_name', 'LIKE', '%' . $query . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $query . '%')
                    ->orWhere('email', 'LIKE', '%' . $query . '%');
            });
        }

        $data = $data->select('email',
            DB::raw('MIN(first_name) as first_name'),
            DB::raw('MIN(adress) as adress'),
            DB::raw('MIN(last_name) as last_name'))->groupBy('email');

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
        $all = Authors::findOrFail($id);

        return $all;
    }


    public function store(Request $request)
    {
        $post = Authors::where('name', $request->name)->first();
        if ($post) {
            return $post;
        }

        $post = Authors::create([
            "name" => $request->name
        ]);

        return $this->show($post->id);
    }

    public function update(Request $request, $id)
    {
        Authors::where('id', $id)->update([
            "name" => $request->name
        ]);

        return $this->show($id);
    }

    public function destroy($id)
    {
        $category = Authors::findOrFail($id);
        $category->delete();

        return response(null, 204);
    }
}
