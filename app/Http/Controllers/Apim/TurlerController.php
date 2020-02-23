<?php

namespace App\Http\Controllers\Apim;

use App\Http\Controllers\Controller;
use App\Models\Parameters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TurlerController extends Controller
{
    // Narusta
    public function ndel($type, $id)
    {
        Parameters::where('id', $id)->delete();
    }

    public function nlist($type)
    {
        $itemPerPage = request()->query('itemPerPage');
        $query       = request()->query('query');

        $paramcons = Parameters::with([])->where('type', $type);

        if (request()->query('sort')) {
            $paramcons = $paramcons->orderBy(request()->query('sort'), request()->query('desc') == "true" ? 'desc' : 'ASC');
        }

        if ($query) {
            $paramcons = $paramcons->where(function ($query2) use ($query) {
                $query2
                    ->orWhere('value', 'LIKE', '%' . $query . '%');
            });
        }

        return $paramcons->paginate($itemPerPage);
    }

    public function nget($type, $id)
    {
        $paramcons = Parameters::with([])->where('type', $type);

        return $paramcons->where('item_num', $id)->first();
    }

    public function npost($type, Request $request)
    {
        $all         = $request->all();
        $all["type"] = $type;

        $lastParameter = DB::select('SELECT IFNULL(MAX(item_num), 0) as item_num FROM parameters WHERE `type`="'.$type.'"');

        $all["item_num"] = $lastParameter[0]->item_num + 1;

        $mparameter = Parameters::create($all);

        return $mparameter->id;
    }

    public function npatch($type, $id, Request $request)
    {
        $all         = $request->all();
        $all["type"] = $type;

        Parameters::where('id', $id)->update($all);

        return $id;
    }
}
