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
        $val = Kullanicilar::with([])->findOrFail($id);

        return $val;
    }

    public function store(Request $request)
    {
        $update = [
            'name'        => $request->name,
            'surname'     => $request->surname,
            'email'       => $request->email,
            'address'     => $request->address,
            'u_title'     => isset($request->utitle) ? $request->utitle["id"] : null,
            'u_type'     => isset($request->utype) ? $request->utype["id"] : null,
            'gender'      => $request->gender,
            'institution' => $request->institution,
            'faculty'     => $request->faculty,
            'department'  => $request->department,
            'iletisim'    => $request->iletisim
        ];

        if(!empty($request->password)) {
            $update["password"] = Hash::make($request->password);
        }

        $id = Kullanicilar::create($update);
        return $this->show($id->id);
    }

    public function update(Request $request, $id)
    {
        $update = [
            'name'        => $request->name,
            'surname'     => $request->surname,
            'email'       => $request->email,
            'address'     => $request->address,
            'u_title'     => isset($request->utitle) ? $request->utitle["id"] : null,
            'u_type'     => isset($request->utype) ? $request->utype["id"] : null,
            'gender'      => $request->gender,
            'institution' => $request->institution,
            'faculty'     => $request->faculty,
            'department'  => $request->department,
            'iletisim'    => $request->iletisim
        ];

        if(!empty($request->password)) {
            $update["password"] = Hash::make($request->password);
        }

        Kullanicilar::where('id', $id)->update($update);
        return $this->show($id);
    }

    public function destroy($id)
    {
        $category = Kullanicilar::findOrFail($id);
        $category->delete();

        return response(null, 204);
    }
}
