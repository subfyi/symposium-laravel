<?php

namespace App\Http\Controllers\Apim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gorevler;
use App\Models\Parameters;
use App\Models\Pauthor;

class AuthorController extends Controller
{
    public function index()
    {
        $itemPerPage = request()->query('itemPerPage');
        $query = request()->query('query');
        $data = Pauthor::with([]);

        $sort = request()->query('sort');
        if ($sort) {
            $data = $data->orderBy($sort, request()->query('desc') == "true" ? 'desc' : 'ASC');
        }

        if ($query) {
            $data = $data->where(function ($query2) use ($query) {
                $query2
                    ->where('name', 'LIKE', '%' . $query . '%')
                    ->orWhere('surname', 'LIKE', '%' . $query . '%')
                    ->orWhere('p_mail', 'LIKE', '%' . $query . '%');
            });
        }

        $data = $data->select('p_mail', 'name', 'adress', 'surname')->distinct();

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
        $all = Pauthor::findOrFail($id);

        return $all;
    }
}
