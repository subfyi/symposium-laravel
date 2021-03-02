<?php

namespace App\Http\Controllers\Apim;

use App\Http\Controllers\Controller;
use App\Models\Roles;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function index()
    {
        $itemPerPage = request()->query('itemPerPage');
        $query = request()->query('query');
        $data = Roles::with([]);

        if (request()->query('sort')) {
            $data = $data->orderBy(request()->query('sort'), request()->query('desc') == "true" ? 'desc' : 'ASC');
        }

        if ($query) {
            $data = $data->where(function ($query2) use ($query) {
                $query2
                    ->where('name', 'LIKE', '%' . $query . '%');
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
        return Roles::with([])->findOrFail($id);
    }

    public function store(Request $request)
    {
        return Roles::create([
            "name" => $request->name
        ]);
    }

    public function update(Request $request, $id)
    {
        Roles::where('id', $id)->update([
            "name" => $request->name
        ]);
    }

    public function destroy($id)
    {
        $category = Roles::findOrFail($id);
        $category->delete();

        return response(null, 204);
    }
}
