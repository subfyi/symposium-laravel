<?php

namespace App\Http\Controllers\Apim;

use App\Models\Kullanicilar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        $itemPerPage = request()->query('itemPerPage');
        $query = request()->query('query');
        $data = Kullanicilar::with([]);

        if (request()->query('sort')) {
            $data = $data->orderBy(request()->query('sort'), request()->query('desc') == "true" ? 'desc' : 'ASC');
        }

        if ($query) {
            $data = $data->where(function ($query2) use ($query) {
                $query2
                    ->where('user_name', 'LIKE', '%' . $query . '%');
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
        $kurum = Kullanicilar::with([])->findOrFail($id);

        return $kurum;
    }

    public function store(Request $request)
    {
        $update = [
            "name" => $request->name,
            "email" => $request->email,
            "role" => $request->role["id"],
            "unvan" => $request->unvan,
            "iletisim" => $request->iletisim,
            "aciklama" => $request->aciklama
        ];

        if(!empty($request->password)) {
            $update["password"] = Hash::make($request->password);
        }

        Kullanicilar::create($update);
    }

    public function update(Request $request, $id)
    {
        $update = [
            "name" => $request->name,
            "email" => $request->email,
            "role" => 8,
            "unvan" => $request->unvan,
            "iletisim" => $request->iletisim,
            "aciklama" => $request->aciklama
        ];

        if(!empty($request->password)) {
            $update["password"] = Hash::make($request->password);
        }

        Kullanicilar::where('id', $id)->update($update);
    }

    public function destroy($id)
    {
        $category = Kullanicilar::findOrFail($id);
        $category->delete();

        return response(null, 204);
    }
}
