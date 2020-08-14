<?php

namespace App\Http\Controllers\Apim;

use App\Http\Controllers\Controller;
use App\Models\Publishs;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TypePublishController extends Controller
{
    public function index()
    {
        $itemPerPage = request()->query('itemPerPage');
        $query       = request()->query('query');
        $data        = Publishs::with(['lang'])->whereNull('deleted_at');

        $sort = request()->query('sort');
        if ($sort) {
            $data = $data->orderBy($sort, request()->query('desc') == "true" ? 'desc' : 'ASC');
        }

        if ($query) {
            $data = $data->where(function ($query2) use ($query) {
                $query2
                    ->where('name', 'LIKE', '%'.$query.'%');
            });
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

    public function show($id)
    {
        $value = Publishs::with(['lang'])->findOrFail($id);

        return $value;
    }

    public function store(Request $request)
    {
        $value = Publishs::create([
            "active"     => ! isset($request['active']) ? 0 : $request['active'],
            "name"       => $request->name,
            "created_by" => auth('api')->user()->id,
            "updated_by" => auth('api')->user()->id,
        ]);

        if (isset($request->lang)) {
            Publishs::where('id', $value->id)->update([
                "type" => $request->lang['id']
            ]);
        }

        return $value;
    }

    public function update(Request $request, $id)
    {
        Publishs::where('id', $id)->update([
            "active"     => ! isset($request['active']) ? 0 : $request['active'],
            "name"       => $request->name,
            "updated_by" => auth('api')->user()->id,
        ]);

        if (isset($request->lang['id'])) {
            Publishs::where('id', $id)->update([
                "type" => $request->lang['id']
            ]);
        }


        return $this->show($id);
    }

    public function destroy($id)
    {
        Publishs::where('id', $id)->update([
            'deleted_at' => Carbon::now()
        ]);

        return response(null, 204);
    }
}
