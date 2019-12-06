<?php

namespace App\Http\Controllers;

use App\Models\Announce;
use App\Models\Ayarlar;
use App\Models\Feedback;
use App\Models\Feedbackdata;
use App\Models\Gorevfiles;
use App\Models\Gorevicerik;
use App\Models\Gorevler;
use App\Models\Gorevonizfile;
use App\Models\Kurumlar;
use App\Mail\PaperMail;
use App\Mail\WelcomeMail;
use App\Models\Musteriler;
use App\Models\Parameters;
use App\Models\Pauthor;
use App\Models\Sss;
use App\Models\Blog;
use App\Models\Hakkimizda;
use App\Models\Kategori;
use App\Models\Kullanicilar;
use App\User;
use Auth;
use Faker\Provider\File;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;


class AdminPostController extends AdminController
{

    public function post_profile(Request $request)
    {
        $tarih = str_slug(Carbon::now());
        $file = $request->all();
        if (isset($file['logo'])) {
            $validator = Validator::make($file, [
                'logo' => 'mimes:jpg,JPG,jpeg,JPEG,png,PNG,gif,GIF',
            ]);

            if ($validator->fails()) {
                return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'Geçersiz dosya formatı']);
            }

            $logo = Input::file('logo');
            $logo_uzanti = Input::file('logo')->getClientOriginalExtension();
            $logo_isim = str_slug($request->name) . '-' . $tarih . '.' . $logo_uzanti;

            Storage::disk('uploads')->makeDirectory('img');
            Image::make($logo->getRealPath())->resize(100, 100)->save('uploads/img/' . $logo_isim);
        }

        try {
            unset($file['_token']);
            if (isset($file['logo'])) {
                $file['logo'] = $logo_isim;
                unset($file['eski_logo']);
            } else {
                $file['logo'] = $file['eski_logo'];
                unset($file['eski_logo']);
            }
            if ($file['password'] != NULL) {
                $current_password = Auth::User()->password;
                if (Hash::check($file['current-password'], $current_password)) {
                    Ayarlar::where('id', Auth::user()->id)->update([
                        'name' => $request->name,
                        'surname' => $request->surname,
                        'u_title' => $request->u_title,
                        'u_type' => $request->u_type,
                        'institution' => $request->institution,
                        'faculty' => $request->faculty,
                        'department' => $request->department,
                        'iletisim' => $request->iletisim,
                        'address' => $request->address,
                        'email' => $request->email,
                        'logo' => $file['logo'],
                        'password' => Hash::make($file['password'])
                    ]);
                } else {
                    return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'Kayıt yapılamadı', 'hata' => 'Mevcut şifre uyuşmadı']);
                }
            } else {
                Ayarlar::where('id', Auth::user()->id)->update([
                    'name' => $request->name,
                    'surname' => $request->surname,
                    'u_title' => $request->u_title,
                    'u_type' => $request->u_type,
                    'institution' => $request->institution,
                    'faculty' => $request->faculty,
                    'department' => $request->department,
                    'iletisim' => $request->iletisim,
                    'address' => $request->address,
                    'email' => $request->email,
                    'logo' => $file['logo']
                ]);
            }

            return response(['durum' => 'success', 'baslik' => 'Başarılı', 'icerik' => 'Kayıt başarı ile yapıldı']);
        } catch (\Exception $e) {
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'Kayıt yapılamadı', 'hata' => $e]);
        }
    }


    public function post_users(Request $request)
    {
        try {
            Kullanicilar::where('id', $request->id)->delete();
            Storage::disk('uploads')->deleteDirectory('img/user/' . $request->slug);

            return response(['durum' => 'success', 'baslik' => 'Başarılı', 'icerik' => 'Kayıt başarı ile yapıldı']);
        } catch (\Exception $e) {
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'silme yapılamadı', 'hata' => $e]);
        }
    }

    public function post_user_edit($slug, Request $request)
    {
        unset($request['_token']);
        $tarih = str_slug(Carbon::now());
        $file = $request->all();
        if (isset($file['logo'])) {
            $validator = Validator::make($file, [
                'logo' => 'mimes:jpg,JPG,jpeg,JPEG,png,PNG,gif,GIF',
            ]);

            if ($validator->fails()) {
                return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'Geçersiz dosya formatı']);
            }

            $logo = Input::file('logo');
            $logo_uzanti = Input::file('logo')->getClientOriginalExtension();
            $logo_isim = str_slug($request->name) . '-' . $tarih . '.' . $logo_uzanti;

            Storage::disk('uploads')->makeDirectory('img');
            Image::make($logo->getRealPath())->resize(100, 100)->save('uploads/img/' . $logo_isim);
        }

        unset($file['_token']);
        if (isset($file['logo'])) {
            $file['logo'] = $logo_isim;
            unset($file['eski_logo']);
        } else {
            $file['logo'] = $file['eski_logo'];
            unset($file['eski_logo']);
        }


        if (isset($request->password)) {
            $file['password'] = Hash::make($file['password']);
            Kullanicilar::where('slug', $slug)->update([
                'name' => $request->name,
                'surname' => $request->surname,
                'u_title' => $request->u_title,
                'u_type' => $request->u_type,
                'institution' => $request->institution,
                'faculty' => $request->faculty,
                'department' => $request->department,
                'iletisim' => $request->iletisim,
                'address' => $request->address,
                'email' => $request->email,
                'logo' => $file['logo'],
                'password' => $file['password']

            ]);

        } else {
            Kullanicilar::where('slug', $slug)->update([

                'name' => $request->name,
                'surname' => $request->surname,
                'u_title' => $request->u_title,
                'u_type' => $request->u_type,
                'institution' => $request->institution,
                'faculty' => $request->faculty,
                'department' => $request->department,
                'iletisim' => $request->iletisim,
                'address' => $request->address,
                'email' => $request->email,
                'logo' => $file['logo']

            ]);

        }
        try {

            return response(['durum' => 'success', 'baslik' => 'Başarılı', 'icerik' => 'Kayıt başarı ile yapıldı']);
        } catch (\Exception $e) {
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'Kayıt yapılamadı', 'hata' => $e]);
        }
    }

    public function post_user_add(Request $request)
    {
        unset($request['_token']);
        $tarih = str_slug(Carbon::now());
        $file = $request->all();
        if (isset($file['logo'])) {
            $validator = Validator::make($file, [
                'logo' => 'mimes:jpg,JPG,jpeg,JPEG,png,PNG,gif,GIF',
            ]);

            if ($validator->fails()) {
                return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'Geçersiz dosya formatı']);
            }

            $logo = Input::file('logo');
            $logo_uzanti = Input::file('logo')->getClientOriginalExtension();
            $logo_isim = str_slug($request->name) . '-' . $tarih . '.' . $logo_uzanti;

            Storage::disk('uploads')->makeDirectory('img');
            Image::make($logo->getRealPath())->resize(100, 100)->save('uploads/img/' . $logo_isim);
        }

        try {
            unset($file['_token']);
            if (isset($file['logo'])) {
                $file['logo'] = $logo_isim;
                unset($file['eski_logo']);
            }
            $slug = str_slug($request->name) . "-" . $tarih;

            $file['password'] = Hash::make($file['password']);

            Kullanicilar::create(['slug' => $slug, 'password' => $file['password'], 'logo' => $file['logo'], 'name' => $request->name, 'surname' => $request->surname, 'email' => $request->email, 'yetki' => $request->yetki, 'iletisim' => $request->iletisim, 'address' => $request->address, 'u_title' => $request->u_title, 'u_type' => $request->u_type, 'gender' => $request->gender, 'institution' => $request->institution, 'faculty' => $request->faculty, 'department' => $request->department,]);
            return response(['durum' => 'success', 'baslik' => 'Başarılı', 'icerik' => 'Kayıt başarı ile yapıldı']);
        } catch (\Exception $e) {
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'Kayıt yapılamadı', 'hata' => $e]);
        }
    }

    public function post_about_us(Request $request)
    {
        try {
            unset($request['_token']);
            Hakkimizda::where('id', 1)->update($request->all());
            //Hakkimizda::create($request->all());
            return response(['durum' => 'success', 'baslik' => 'Başarılı', 'icerik' => 'Kayıt başarı ile yapıldı']);
        } catch (\Exception $e) {
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'Kayıt yapılamadı']);
        }
    }

    public function post_announce_add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'baslik' => 'required|max:250',
        ]);

        if ($validator->fails()) {
            $mesaj = $validator->messages();
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'eksik alan ' . $mesaj]);
        }

        unset($request['_token']);
        $tarih = str_slug(Carbon::now());
        $slug = str_slug($request->baslik) . "-" . $tarih;

        $request->merge(['slug' => $slug, 'yazar' => Auth::user()->id]);

        Announce::create($request->all());
        return response(['durum' => 'success', 'baslik' => 'Başarılı', 'icerik' => 'Kayıt başarı ile yapıldı']);
    }


    public function post_announce_sil(Request $request)
    {
        try {
            Announce::where('id', $request->id)->delete();
            Storage::disk('uploads')->deleteDirectory('img/blog/' . $request->slug);

            return response(['durum' => 'success', 'baslik' => 'Başarılı', 'icerik' => 'Kayıt başarı ile yapıldı']);
        } catch (\Exception $e) {
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'silme yapılamadı', 'hata' => $e]);
        }
    }


    public function post_announce_edit($slug, Request $request)
    {
        $validator = Validator::make($request->all(), [
        ]);

        if ($validator->fails()) {
            $mesaj = $validator->messages();
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'eksik alan ' . $mesaj]);
        }

        unset($request['_token']);
        try {
            Announce::where('slug', $slug)->update($request->all());
            return response(['durum' => 'success', 'baslik' => 'Başarılı', 'icerik' => 'Kayıt başarı ile güncellendi']);
        } catch (\Exception $e) {
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'Kayıt güncellenemedi.', 'hata' => $e]);
        }

    }


    public function post_faq_add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'baslik' => 'required|max:250',
        ]);

        if ($validator->fails()) {
            $mesaj = $validator->messages();
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'eksik alan ' . $mesaj]);
        }

        unset($request['_token']);
        $tarih = str_slug(Carbon::now());
        $slug = str_slug($request->baslik) . "-" . $tarih;

        $request->merge(['slug' => $slug, 'yazar' => Auth::user()->id]);

        Sss::create($request->all());
        return response(['durum' => 'success', 'baslik' => 'Başarılı', 'icerik' => 'Kayıt başarı ile yapıldı']);
    }

    public function post_sss_sil(Request $request)
    {
        try {
            Sss::where('id', $request->id)->delete();
            Storage::disk('uploads')->deleteDirectory('img/blog/' . $request->slug);

            return response(['durum' => 'success', 'baslik' => 'Başarılı', 'icerik' => 'Kayıt başarı ile yapıldı']);
        } catch (\Exception $e) {
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'silme yapılamadı', 'hata' => $e]);
        }
    }

    public function get_faq_edit($slug, Request $request)
    {
        $validator = Validator::make($request->all(), [
        ]);

        if ($validator->fails()) {
            $mesaj = $validator->messages();
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'eksik alan ' . $mesaj]);
        }

        unset($request['_token']);
        try {
            Sss::where('slug', $slug)->update($request->all());
            return response(['durum' => 'success', 'baslik' => 'Başarılı', 'icerik' => 'Kayıt başarı ile güncellendi']);
        } catch (\Exception $e) {
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'Kayıt güncellenemedi.', 'hata' => $e]);
        }

    }

    public function post_blog_add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            //'resimler[]' => 'required|mimes:jpg,JPG,jpeg,JPEG,png,PNG,gif,GIF',
            'baslik' => 'required|max:250',
            'etiketler' => 'required|max:250',
        ]);

        if ($validator->fails()) {
            $mesaj = $validator->messages();
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'eksik alan ' . $mesaj]);
        }

        try {
            unset($request['_token']);
            $tarih = str_slug(Carbon::now());
            $slug = str_slug($request->baslik) . "-" . $tarih;
            $resimler = $request->file('resimler');
            if (!empty($resimler)) {
                $i = 0;
                foreach ($resimler as $resim) {
                    $resim_uzanti = $resim->getClientOriginalExtension();
                    $resim_isim = $i . '.' . $resim_uzanti;
                    Storage::disk('uploads')->makeDirectory('img/blog/' . $slug);
                    Storage::disk('uploads')->put('img/blog/' . $slug . '/' . $resim_isim, file_get_contents($resim));
                    $i++;
                }
            }
            $request->merge(['slug' => $slug, 'kullanici_id' => Auth::user()->id, 'yazar' => Auth::user()->id]);
            Blog::create($request->all());

            return response(['durum' => 'success', 'baslik' => 'Başarılı', 'icerik' => 'Kayıt başarı ile yapıldı']);
        } catch (\Exception $e) {
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'Kayıt yapılamadı', 'hata' => $e]);
        }
    }


    public function post_blog_sil(Request $request)
    {
        try {
            Blog::where('id', $request->id)->delete();
            Storage::disk('uploads')->deleteDirectory('img/blog/' . $request->slug);

            return response(['durum' => 'success', 'baslik' => 'Başarılı', 'icerik' => 'Kayıt başarı ile yapıldı']);
        } catch (\Exception $e) {
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'silme yapılamadı', 'hata' => $e]);
        }
    }

    public function post_blog_edit($slug, Request $request)
    {
        $validator = Validator::make($request->all(), [
            //'resimler[]' => 'required|mimes:jpg,JPG,jpeg,JPEG,png,PNG,gif,GIF',
        ]);

        if ($validator->fails()) {
            $mesaj = $validator->messages();
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'eksik alan ' . $mesaj]);
        }

        if (isset($request->resim)) {
            try {
                Storage::disk('uploads')->delete($request->resim);
                return response(['durum' => 'success', 'baslik' => 'Başarılı', 'icerik' => 'resim başarı ile silindi']);
            } catch (\Exception $e) {
                return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'resim silinemedi', 'hata' => $e]);
            }
        } else {
            $resimler = $request->file('resimler');
            if (!empty($resimler)) {
                $i = $request->sayi;
                $i++;
                foreach ($resimler as $resim) {
                    $resim_uzanti = $resim->getClientOriginalExtension();
                    $resim_isim = $i . '.' . $resim_uzanti;
                    Storage::disk('uploads')->makeDirectory('img/blog/' . $slug);
                    Storage::disk('uploads')->put('img/blog/' . $slug . '/' . $resim_isim, file_get_contents($resim));
                    $i++;
                }
            }
            try {
                Blog::where('slug', $slug)->update(['baslik' => $request->baslik, 'etiketler' => $request->etiketler, 'icerik' => $request->icerik]);
                return response(['durum' => 'success', 'baslik' => 'Başarılı', 'icerik' => 'Kayıt başarı ile güncellendi']);
            } catch (\Exception $e) {
                return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'Kayıt güncellenemedi.', 'hata' => $e]);
            }
        }
    }


    public function post_feedback_add(Request $request)
    {
        $validator = Validator::make($request->all(), [
        ]);

        if ($validator->fails()) {
            $mesaj = $validator->messages();
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'eksik alan ' . $mesaj]);
        }

        $tarih = str_slug(Carbon::now());
        $slug = str_slug(Auth::user()->name) . "-" . $tarih;
        $arrayimsi = "";
        $arrayimsi_r = "";

        unset($request['_token']);

        try {
            $resimler = $request->file('dosyalar');
            if (!empty($resimler)) {
                $i = 0;
                foreach ($resimler as $resim) {
                    $resim_uzanti = $resim->getClientOriginalExtension();
                    $resim_isim = $tarih . '_' . $i . "_" . str_slug(pathinfo($resim->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $resim_uzanti;
                    $resim_isim_r = pathinfo($resim->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $resim_uzanti;


                    Storage::disk('uploads')->makeDirectory('feedback/' . $slug);
                    Storage::disk('uploads')->put('feedback/' . $slug . '/' . $resim_isim, file_get_contents($resim));

                    if ($arrayimsi == "") {
                        $arrayimsi = $resim_isim;
                        $arrayimsi_r = $resim_isim_r;
                    } else {
                        $arrayimsi = $arrayimsi . '|' . $resim_isim;
                        $arrayimsi_r = $arrayimsi_r . '|' . $resim_isim_r;
                    }
                    $i++;
                }
            }

            $request->merge(['slug' => $slug, 'grv_icerik_yonetici' => Auth::user()->id]);

            Feedback::create($request->all());

            if ($request->grv_onemi == 8) {
                Feedback::where('slug', $slug)->update(['grv_onemi' => $request->grv_onemi, 'grv_teslim_tarih' => date('Y-m-d H:i:s', strtotime(Carbon::now())), 'grv_bitis_tarih' => date('Y-m-d H:i:s', strtotime($request['reservation-time']))]);
            } else {
                Feedback::where('slug', $slug)->update(['grv_onemi' => 0, 'grv_bitis_tarih' => date('Y-m-d H:i:s', strtotime($request['reservation-time']))]);
            }

            if ($request->isicerik != "<p>&nbsp;</p>" || $arrayimsi != "") {
                if ($arrayimsi == "") {
                    Feedbackdata::create([
                        'isicerik' => $request->isicerik,
                        'slug' => $slug,
                        'grv_icerik_olusturan' => Auth::user()->id
                    ]);
                } else {
                    if ($request->gondercloud == 1) {
                        Feedbackdata::create([
                            'isicerik' => $request->isicerik,
                            'slug' => $slug,
                            'gdosyaisimleri' => $arrayimsi,
                            'r_gdosyaisimleri' => $arrayimsi_r,
                            'grv_icerik_olusturan' => Auth::user()->id
                        ]);
                    } else {
                        Feedbackdata::create([
                            'isicerik' => $request->isicerik,
                            'slug' => $slug,
                            'dosyaisimleri' => $arrayimsi,
                            'r_dosyaisimleri' => $arrayimsi_r,
                            'grv_icerik_olusturan' => Auth::user()->id
                        ]);
                    }
                }
            }

            return response(['durum' => 'success', 'baslik' => 'Başarılı', 'icerik' => 'Kayıt başarı ile yapıldı']);
        } catch (\Exception $e) {
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'Görev  Eklenemedi', 'hata' => $e]);
        }

    }

    public function post_feedback_edit($slug, Request $request)
    {
        $validator = Validator::make($request->all(), [
        ]);

        if ($validator->fails()) {
            $mesaj = $validator->messages();
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'eksik alan ' . $mesaj]);
        }

        $tarih = str_slug(Carbon::now());
        $arrayimsi = "";
        $arrayimsi_r = "";
        unset($request['_token']);
        try {
            $resimler = $request->file('dosyalar');
            if (!empty($resimler)) {
                $i = $request->sayi;
                foreach ($resimler as $resim) {
                    $resim_uzanti = $resim->getClientOriginalExtension();
                    $resim_isim = $tarih . '_' . $i . "_" . str_slug(pathinfo($resim->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $resim_uzanti;
                    $resim_isim_r = pathinfo($resim->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $resim_uzanti;


                    Storage::disk('uploads')->makeDirectory('feedback/' . $slug);
                    Storage::disk('uploads')->put('feedback/' . $slug . '/' . $resim_isim, file_get_contents($resim));

                    if ($arrayimsi == "") {
                        $arrayimsi = $resim_isim;
                        $arrayimsi_r = $resim_isim_r;
                    } else {
                        $arrayimsi = $arrayimsi . '|' . $resim_isim;
                        $arrayimsi_r = $arrayimsi_r . '|' . $resim_isim_r;
                    }
                    $i++;
                }
            }

            if ($request->grv_onemi == 8) {
                Feedback::where('slug', $slug)->update(['grv_onemi' => $request->grv_onemi, 'grv_teslim_tarih' => date('Y-m-d H:i:s', strtotime(Carbon::now())), 'grv_bitis_tarih' => date('Y-m-d H:i:s', strtotime($request['reservation-time']))]);
            } else {
                Feedback::where('slug', $slug)->update(['grv_onemi' => 0, 'grv_bitis_tarih' => date('Y-m-d H:i:s', strtotime($request['reservation-time']))]);
            }

            if ($request->isicerik != "<p>&nbsp;</p>" || $arrayimsi != "") {
                if ($request->yorumid == "") {
                    if ($arrayimsi == "") {
                        Feedbackdata::create([
                            'isicerik' => $request->isicerik,
                            'slug' => $request->slug,
                            'grv_icerik_olusturan' => Auth::user()->id
                        ]);
                    } else {
                        if ($request->gondercloud == 1) {
                            Feedbackdata::create([
                                'isicerik' => $request->isicerik,
                                'slug' => $request->slug,
                                'gdosyaisimleri' => $arrayimsi,
                                'r_gdosyaisimleri' => $arrayimsi_r,
                                'grv_icerik_olusturan' => Auth::user()->id
                            ]);
                        } else {
                            Feedbackdata::create([
                                'isicerik' => $request->isicerik,
                                'slug' => $request->slug,
                                'dosyaisimleri' => $arrayimsi,
                                'r_dosyaisimleri' => $arrayimsi_r,
                                'grv_icerik_olusturan' => Auth::user()->id
                            ]);
                        }
                    }
                } else {
                    $arrayimsi2 = Feedbackdata::where('id', $request->yorumid)->value('dosyaisimleri');
                    $arrayimsi2_r = Feedbackdata::where('id', $request->yorumid)->value('r_dosyaisimleri');
                    if ($arrayimsi2 == NULL) {
                        if ($request->gondercloud == 1) {
                            Feedbackdata::where('id', $request->yorumid)->update([
                                'isicerik' => $request->isicerik,
                                'gdosyaisimleri' => $arrayimsi,
                                'r_gdosyaisimleri' => $arrayimsi_r,
                                'grv_icerik_olusturan' => Auth::user()->id
                            ]);
                        } else {
                            Feedbackdata::create([
                                'isicerik' => $request->isicerik,
                                'slug' => $request->slug,
                                'dosyaisimleri' => $arrayimsi,
                                'r_dosyaisimleri' => $arrayimsi_r,
                                'grv_icerik_olusturan' => Auth::user()->id
                            ]);
                        }
                    } else {
                        if ($arrayimsi == "") {
                            $arrayimsi = $arrayimsi2;
                            $arrayimsi_r = $arrayimsi2_r;
                        } else {
                            $arrayimsi = $arrayimsi2 . '|' . $arrayimsi;
                            $arrayimsi_r = $arrayimsi2_r . '|' . $arrayimsi_r;
                        }
                        if ($request->gondercloud == 1) {
                            Feedbackdata::where('id', $request->yorumid)->update([
                                'isicerik' => $request->isicerik,
                                'gdosyaisimleri' => $arrayimsi,
                                'r_gdosyaisimleri' => $arrayimsi_r,
                                'grv_icerik_olusturan' => Auth::user()->id
                            ]);
                        } else {
                            Feedbackdata::create([
                                'isicerik' => $request->isicerik,
                                'slug' => $request->slug,
                                'dosyaisimleri' => $arrayimsi,
                                'r_dosyaisimleri' => $arrayimsi_r,
                                'grv_icerik_olusturan' => Auth::user()->id
                            ]);
                        }
                    }
                }
            }

            return response(['durum' => 'success', 'baslik' => 'Başarılı', 'icerik' => 'Kayıt başarı ile güncellendi']);
        } catch (\Exception $e) {
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'Kayıt güncellenemedi.', 'hata' => $e]);
        }
    }


    public function post_categories(Request $request)
    {
        try {
            Kategori::where('id', $request->id)->delete();
            return response(['durum' => 'success', 'baslik' => 'Başarılı', 'icerik' => 'Kayıt başarı ile yapıldı']);
        } catch (\Exception $e) {
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'Kayıt yapılamadı', 'hata' => $e]);
        }
    }

    public function post_categorie_add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ad' => 'required|max:250',
        ]);

        if ($validator->fails()) {
            $mesaj = $validator->messages();
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'eksik alan ' . $mesaj]);
        }

        try {
            $slug = str_slug($request->ad);
            $request->merge(['slug' => $slug]);
            Kategori::create($request->all());
            return response(['durum' => 'success', 'baslik' => 'Başarılı', 'icerik' => 'Kayıt başarı ile yapıldı']);

        } catch (\Exception $e) {
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'Kayıt yapılamadı', 'hata' => $e]);
        }
    }

    public function post_gorev_sil(Request $request)
    {
        try {
            Gorevler::where('id', $request->id)->update([
                'pap_status' => 3,
            ]);
            return response(['durum' => 'success', 'baslik' => 'success', 'icerik' => 'Deleted']);
        } catch (\Exception $e) {
            return response(['durum' => 'error', 'baslik' => 'error', 'icerik' => 'Not Deleted.', 'hata' => $e]);
        }
    }



    public function post_upload(Request $request)
    {
        $resim = $request->file('dosya');//Input::file('dosya');

        $tarih = str_slug(Carbon::now());

        $resim_uzanti = $resim->getClientOriginalExtension();
        $resim_boyutu = $resim->getSize();
        $resim_isim = $tarih . '_' . str_slug(pathinfo($resim->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $resim_uzanti;
        $resim_isim_r = pathinfo($resim->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $resim_uzanti;

        Storage::disk('uploads')->makeDirectory('dosya/user/' . Auth::user()->slug);
        Storage::disk('uploads')->put('dosya/gecici/' . $resim_isim, file_get_contents($resim->getRealPath()));

        return [
            "id" => $resim_isim,
            "name" => $resim_isim_r,
            "size" => $resim_boyutu,
            "acess_url" => ""
        ];
    }

    public function post_paper_add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pap_title' => 'required|max:250',
        ]);

        if ($validator->fails()) {
            $mesaj = $validator->messages();
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'eksik alan ' . $mesaj]);
        } else {

            $tarih = str_slug(Carbon::now());
            $slug = str_slug($request->pap_title) . "-" . $tarih;
            unset($request['_token']);

            $pap_keywords = "";
            foreach ($request->pap_keyword as $val) {
                $pap_keywords = $val . '|' . $pap_keywords;

                if(!Parameters::where('type', 'tagcon')->where('value', $val)->exists()) {
                    Parameters::create([
                        'type' => 'tagcon',
                        'value' => $val,
                        'item_num' => 0
                    ]);
                }
            }

            $gorevid = Gorevler::create([
                'pap_title' => $request->pap_title,
                'pap_abstract' => $request->pap_abstract,
                'pap_keyword' => $pap_keywords,
                'pap_topic_p' => $request->pap_topic_p,
                'pre_type' => $request->pre_type,
                'pap_type' => $request->pap_type,
                'mes_congress' => $request->mes_congress,
                'pap_creater' => Auth::user()->id,
                'slug' => $slug
            ]);


            $allEmails = $request->a_email;
            $allNames = $request->a_name;
            $allSurnames = $request->a_surname;
            $allCorrespond = $request->correspond;
            $allPresenter = $request->presenter;

            for ($i = 1; isset($allEmails[$i]); ++$i) {
                if ($allCorrespond == $i) $corre = 1;
                else $corre = 0;
                if ($allPresenter == $i) $prre = 1;
                else $prre = 0;

                Pauthor::create([
                    'p_id' => $gorevid->id,
                    'p_user' => Auth::user()->id,
                    'p_mail' => $allEmails[$i],
                    'name' => $allNames[$i],
                    'surname' => $allSurnames[$i],
                    'correspond' => $corre,
                    'presenter' => $prre,
                ]);
            }

            $d_slug = Kullanicilar::where('id', '=', Auth::user()->id)->first()->slug;

            $dosyalar = $request->dosyalar; //$request->file('dosyalar');
            $fdosyalar = $request->fdosyalar; //$request->file('fdosyalar');
            $pdosyalar = $request->pdosyalar; //$request->file('pdosyalar');
            if (!empty($dosyalar)) {
                $resim = $dosyalar;
                $resim_uzanti = pathinfo($dosyalar, PATHINFO_EXTENSION);
                $resim_boyutu = Storage::disk('uploads')->size('dosya/gecici/'.$dosyalar);
                $resim_isim = $tarih . '_' . str_slug(pathinfo($dosyalar, PATHINFO_FILENAME)) . '.' . $resim_uzanti;
                $resim_isim_r = pathinfo($dosyalar, PATHINFO_FILENAME) . '.' . $resim_uzanti;

                Storage::disk('uploads')->makeDirectory('dosya/' . $d_slug);
                Storage::disk('uploads')->put('dosya/' . $d_slug . '/' . $resim_isim, Storage::disk('uploads')->get("dosya/gecici/".$resim));

                Gorevfiles::create([
                    'slug' => $slug,
                    'f_dosyayeri' => 1,
                    'f_dosyaisimi' => $resim_isim,
                    'r_dosyaisimi' => $resim_isim_r,
                    'f_dosya_uzanti' => $resim_uzanti,
                    'f_dosya_boyut' => $resim_boyutu,
                    'f_icerik_olusturan' => Auth::user()->id,
                ]);
            }

            if (!empty($fdosyalar)) {
                $resim = $fdosyalar;
                $resim_uzanti = pathinfo($resim, PATHINFO_EXTENSION);
                $resim_boyutu = Storage::disk('uploads')->size('dosya/gecici/'.$resim);
                $resim_isim = $tarih . '_' . str_slug(pathinfo($resim, PATHINFO_FILENAME)) . '.' . $resim_uzanti;
                $resim_isim_r = pathinfo($resim, PATHINFO_FILENAME) . '.' . $resim_uzanti;

                Storage::disk('uploads')->makeDirectory('dosya/' . $d_slug);
                Storage::disk('uploads')->put('dosya/' . $d_slug . '/' . $resim_isim, Storage::disk('uploads')->get("dosya/gecici/".$resim));

                Gorevfiles::create([
                    'slug' => $slug,
                    'f_dosyayeri' => 1,
                    'f_dosyaisimi' => $resim_isim,
                    'r_dosyaisimi' => $resim_isim_r,
                    'f_dosya_uzanti' => $resim_uzanti,
                    'f_dosya_boyut' => $resim_boyutu,
                    'f_icerik_olusturan' => Auth::user()->id,
                ]);

            }
            if (!empty($pdosyalar)) {
                $resim = $pdosyalar;
                $resim_uzanti = pathinfo($resim, PATHINFO_EXTENSION);
                $resim_boyutu = Storage::disk('uploads')->size('dosya/gecici/'.$resim);
                $resim_isim = $tarih . '_' . str_slug(pathinfo($resim, PATHINFO_FILENAME)) . '.' . $resim_uzanti;
                $resim_isim_r = pathinfo($resim, PATHINFO_FILENAME) . '.' . $resim_uzanti;
                
                Storage::disk('uploads')->makeDirectory('dosya/' . $d_slug);
                Storage::disk('uploads')->put('dosya/' . $d_slug . '/' . $resim_isim, Storage::disk('uploads')->get("dosya/gecici/".$resim));

                Gorevfiles::create([
                    'slug' => $slug,
                    'f_dosyayeri' => 1,
                    'f_dosyaisimi' => $resim_isim,
                    'r_dosyaisimi' => $resim_isim_r,
                    'f_dosya_uzanti' => $resim_uzanti,
                    'f_dosya_boyut' => $resim_boyutu,
                    'f_icerik_olusturan' => Auth::user()->id,
                ]);

            }


            //Mail::to(Auth::user()->email)->send(new PaperMail(Auth::user()));

            try {
                return response(['durum' => 'success', 'baslik' => 'Successful', 'icerik' => 'Registration successfully updated', 'slugurl' => '/admin/gorev-duzenle/' . $slug]);

            } catch (\Exception $e) {
                return response(['durum' => 'error', 'baslik' => 'Incorrect', 'icerik' => 'Failed to update record.', 'hata' => $e]);
            }
        }

    }

    public function post_papers_add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pap_title' => 'required|max:250',
            'dosyalar[]' => 'mimes:doc,docx,DOC,DOCX',
        ]);

        if ($validator->fails()) {
            $mesaj = $validator->messages();
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'eksik alan ' . $mesaj]);
        }
        $uid = $request->pap_whos;
        $tarih = str_slug(Carbon::now());
        $slug = str_slug($request->pap_title) . "-" . $tarih;

        unset($request['_token']);
        $dosyalar = $request->file('dosyalar');
        try {

            $request->merge(['slug' => $slug, 'pap_creater' => $request->pap_whos]);
            Gorevler::create($request->all());
            $d_slug = Kullanicilar::where('id', '=', $uid)->first()->slug;

            if (!empty($dosyalar)) {
                $i = $request->sayi;
                foreach ($dosyalar as $resim) {
                    $resim_uzanti = $resim->getClientOriginalExtension();
                    $resim_boyutu = $resim->getSize();
                    $resim_isim = $tarih . '_' . $i . "_" . str_slug(pathinfo($resim->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $resim_uzanti;
                    $resim_isim_r = pathinfo($resim->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $resim_uzanti;

                    Storage::disk('uploads')->makeDirectory('dosya/' . $d_slug);
                    Storage::disk('uploads')->put('dosya/' . $d_slug . '/' . $resim_isim, file_get_contents($resim));

                    Gorevfiles::create([
                        'slug' => $slug,
                        'f_dosyayeri' => 1,
                        'f_dosyaisimi' => $resim_isim,
                        'r_dosyaisimi' => $resim_isim_r,
                        'f_dosya_uzanti' => $resim_uzanti,
                        'f_dosya_boyut' => $resim_boyutu,
                        'f_icerik_olusturan' => $request->pap_whos,
                    ]);
                    $i++;
                }
            }
            return response(['durum' => 'success', 'baslik' => 'Başarılı', 'icerik' => 'Kayıt başarı ile güncellendi', 'slugurl' => '/admin/gorev-duzenle/' . $slug]);

        } catch (\Exception $e) {
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'Kayıt güncellenemedi.', 'hata' => $e]);
        }
    }


    public function post_is_turu(Request $request)
    {
        try {
            Parameters::where('id', $request->id)->delete();
            return response(['durum' => 'success', 'baslik' => 'Başarılı', 'icerik' => 'Kayıt başarı ile yapıldı']);
        } catch (\Exception $e) {
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'Kayıt yapılamadı', 'hata' => $e]);
        }
    }

    public function post_is_turu_ekle(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'value' => 'required|max:250',
        ]);

        if ($validator->fails()) {
            $mesaj = $validator->messages();
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'eksik alan ' . $mesaj]);
        }
        try {
            $lastParameter = DB::select('SELECT MAX(item_num) as item_num FROM parameters WHERE type="titlecon" GROUP BY type ');


            $data = array(
                'type' => 'titlecon',
                'item_num' => $lastParameter[0]->item_num + 1,
                'value' => $request->value,
            );

            Parameters::create($data);
            return response(['durum' => 'success', 'baslik' => 'Başarılı', 'icerik' => 'Kayıt başarı ile yapıldı']);

        } catch (\Exception $e) {
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'Kayıt yapılamadı', 'hata' => $e]);
        }
    }

    public function post_uygulama_turu(Request $request)
    {
        try {
            Parameters::where('id', $request->id)->delete();
            return response(['durum' => 'success', 'baslik' => 'Başarılı', 'icerik' => 'Kayıt başarı ile yapıldı']);
        } catch (\Exception $e) {
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'Kayıt yapılamadı', 'hata' => $e]);
        }
    }

    public function post_uygulama_turu_ekle(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'value' => 'required|max:250',
        ]);

        if ($validator->fails()) {
            $mesaj = $validator->messages();
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'eksik alan ' . $mesaj]);
        }
        try {
            $lastParameter = DB::select('SELECT MAX(item_num) as item_num FROM parameters WHERE type="uygulamacon" GROUP BY type ');

            if ($lastParameter == NULL) {
                $data = array(
                    'type' => 'uygulamacon',
                    'item_num' => 1,
                    'value' => $request->value,

                );
            } else {
                $data = array(
                    'type' => 'uygulamacon',
                    'item_num' => $lastParameter[0]->item_num + 1,
                    'value' => $request->value,

                );
            }

            Parameters::create($data);
            return response(['durum' => 'success', 'baslik' => 'Başarılı', 'icerik' => 'Kayıt başarı ile yapıldı']);

        } catch (\Exception $e) {
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'Kayıt yapılamadı', 'hata' => $e]);
        }
    }

    public function post_malzeme_turu(Request $request)
    {
        try {
            Parameters::where('id', $request->id)->delete();
            return response(['durum' => 'success', 'baslik' => 'Başarılı', 'icerik' => 'Kayıt başarı ile yapıldı']);
        } catch (\Exception $e) {
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'Kayıt yapılamadı', 'hata' => $e]);
        }
    }

    public function post_malzeme_turu_ekle(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'value' => 'required|max:250',
        ]);

        if ($validator->fails()) {
            $mesaj = $validator->messages();
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'eksik alan ' . $mesaj]);
        }
        try {
            $lastParameter = DB::select('SELECT MAX(item_num) as item_num FROM parameters WHERE type="materialcon" GROUP BY type ');


            if ($lastParameter == NULL) {
                $data = array(
                    'type' => 'materialcon',
                    'item_num' => 1,
                    'value' => $request->value,

                );
            } else {
                $data = array(
                    'type' => 'materialcon',
                    'item_num' => $lastParameter[0]->item_num + 1,
                    'value' => $request->value,

                );
            }

            Parameters::create($data);
            return response(['durum' => 'success', 'baslik' => 'Başarılı', 'icerik' => 'Kayıt başarı ile yapıldı']);

        } catch (\Exception $e) {
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'Kayıt yapılamadı', 'hata' => $e]);
        }
    }

    public function post_birim_turu(Request $request)
    {
        try {
            Parameters::where('id', $request->id)->delete();
            return response(['durum' => 'success', 'baslik' => 'Başarılı', 'icerik' => 'Kayıt başarı ile yapıldı']);
        } catch (\Exception $e) {
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'Kayıt yapılamadı', 'hata' => $e]);
        }
    }

    public function post_birim_turu_ekle(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'value' => 'required|max:250',
        ]);

        if ($validator->fails()) {
            $mesaj = $validator->messages();
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'eksik alan ' . $mesaj]);
        }
        try {
            $lastParameter = DB::select('SELECT MAX(item_num) as item_num FROM parameters WHERE type="birimcon" GROUP BY type ');

            if ($lastParameter == NULL) {
                $data = array(
                    'type' => 'birimcon',
                    'item_num' => 1,
                    'value' => $request->value,

                );
            } else {
                $data = array(
                    'type' => 'birimcon',
                    'item_num' => $lastParameter[0]->item_num + 1,
                    'value' => $request->value,

                );
            }

            Parameters::create($data);
            return response(['durum' => 'success', 'baslik' => 'Başarılı', 'icerik' => 'Kayıt başarı ile yapıldı']);

        } catch (\Exception $e) {
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'Kayıt yapılamadı', 'hata' => $e]);
        }
    }

    public function post_yetki_turu(Request $request)
    {
        try {
            Parameters::where('id', $request->id)->delete();
            return response(['durum' => 'success', 'baslik' => 'Başarılı', 'icerik' => 'Kayıt başarı ile yapıldı']);
        } catch (\Exception $e) {
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'Kayıt yapılamadı', 'hata' => $e]);
        }
    }

    public function post_yetki_turu_ekle(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'value' => 'required|max:250',
        ]);

        if ($validator->fails()) {
            $mesaj = $validator->messages();
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'eksik alan ' . $mesaj]);
        }
        try {
            $data = array(
                'type' => 'yetkicon',
                'item_num' => $request->item_num,
                'value' => $request->value,
            );
            Parameters::create($data);
            return response(['durum' => 'success', 'baslik' => 'Başarılı', 'icerik' => 'Kayıt başarı ile yapıldı']);

        } catch (\Exception $e) {
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'Kayıt yapılamadı', 'hata' => $e]);
        }
    }


    public function post_dosya_sil(Request $request)
    {
        $data = $request->all();
        try {
            $resim = explode('|', $data['file']);
            $resimid = $resim[count($resim) - 4];
            $resimurl = $resim[count($resim) - 3];
            $resimurl_r = $resim[count($resim) - 2];
            $resimuzanti = $resim[count($resim) - 1];

            $arrayimsi2 = Gorevicerik::where('id', $resimid)->value('dosyaisimleri');
            $arrayimsi2_r = Gorevicerik::where('id', $resimid)->value('r_dosyaisimleri');

            if (strpos($arrayimsi2, '|') == false) { //tek dosya
                $arrayimsi = NULL;
                $arrayimsi_r = NULL;
            } else {
                $arrayimsi = str_replace($resimurl, "", $arrayimsi2);
                $arrayimsi_r = str_replace($resimurl_r, "", $arrayimsi2_r);

                if (substr($arrayimsi, -1) == "|") {//ilk dosya
                    $arrayimsi = rtrim($arrayimsi, "|");
                    $arrayimsi_r = rtrim($arrayimsi_r, "|");
                }
                if (substr($arrayimsi, 0, 1) == "|") {//son dosya
                    $arrayimsi = ltrim($arrayimsi, '|');
                    $arrayimsi_r = ltrim($arrayimsi_r, '|');
                }
                if (strpos($arrayimsi, '||')) {// aradan silinirse
                    $arrayimsi = str_replace('||', "|", $arrayimsi);
                    $arrayimsi_r = str_replace('||', "|", $arrayimsi_r);
                }
            }

            Storage::disk('uploads')->delete("/dosya/" . $resimuzanti . "/" . $resimurl);

            Gorevicerik::where('id', $resimid)->update([
                'dosyaisimleri' => $arrayimsi,
                'r_dosyaisimleri' => $arrayimsi_r,
            ]);

            return response(['durum' => 'success', 'baslik' => 'Başarılı', 'icerik' => 'dosya başarı ile silindi']);
        } catch (\Exception $e) {
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'dosya silinemedi', 'hata' => $e]);
        }
    }

    public function post_f_delete(Request $request)
    {
        try {
            $dosyabilgi = Gorevfiles::where('id', $request->fileid)->select('gorev_files.*')->first();

            $ffileid = $request->fileid;
            $fileloc = $dosyabilgi->f_dosyayeri;
            $filename = $dosyabilgi->f_dosyaisimi;
            $filename_r = $dosyabilgi->r_dosyaisimi;
            $slug = $dosyabilgi->slug;

            if ($fileloc == 1) {
                Storage::disk('uploads')->delete("/dosya/" . $slug . "/" . $filename);
                Gorevfiles::where('id', $ffileid)->delete();
            } else {
                /*
                // Get file listing...
                $dir = '/';
                $recursive = false; // Get subdirectories also?
                $dir = collect(Storage::cloud()->listContents($dir, $recursive))
                    ->where('type', '=', 'dir')
                    ->where('filename', '=', $slug)
                    ->first(); // There could be duplicate directory names!

                $file = collect(Storage::cloud()->listContents($dir['path'], $recursive))
                    ->where('type', '=', 'file')
                    ->where('filename', '=', pathinfo($filename, PATHINFO_FILENAME))
                    ->where('extension', '=', pathinfo($filename, PATHINFO_EXTENSION))
                    ->first(); // there can be duplicate file names!

                $silindimi = Storage::cloud()->delete($dir['path'] . '/' . $file['path']);

                if($silindimi != True){
                    $file = collect(Storage::cloud()->listContents($dir['path'], $recursive))
                        ->where('type', '=', 'file')
                        ->where('filename', '=', pathinfo($filename_r, PATHINFO_FILENAME))
                        ->where('extension', '=', pathinfo($filename_r, PATHINFO_EXTENSION))
                        ->first(); // there can be duplicate file names!

                    Storage::cloud()->delete($dir['path'] . '/' . $file['path']);
                }
                */
                Gorevfiles::where('id', $ffileid)->delete();
            }
            return response(['durum' => 'success', 'baslik' => 'Başarılı', 'icerik' => 'dosya başarı ile drivedan silindi']);
        } catch (\Exception $e) {
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'dosya drivedan silinemedi', 'hata' => $e]);
        }
    }

    public function post_sf_attribute_update(Request $request)
    {
        try {
            Gorevfiles::where('id', $request->id)->update([
                $request->attr => $request->value
            ]);

            return response(['durum' => 'success', 'baslik' => 'Başarılı', 'icerik' => 'İşlem yapıldı.']);
        } catch (\Exception $e) {
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'İşlem yapılamadı.', 'hata' => $e]);
        }
    }


    public function post_isf_attribute_update(Request $request)
    {
        try {
            $ayrac = $request->ayrac;
            $fattr = $request->attr;
            $edeger = Gorevfiles::where('id', $request->id)->first();
            $gdeger = $edeger->$fattr;
            if ($gdeger == NULL) {
                if ($ayrac == 'w') {
                    $f_olcusu_w = $request->value;
                    $f_olcusu_h = '';
                    var_dump($f_olcusu_w . '/1/');
                } elseif ($ayrac == 'h') {
                    $f_olcusu_w = '';
                    $f_olcusu_h = $request->value;;
                }
            } else {
                if ($ayrac == 'w') {
                    $f_olcusu_w = $request->value;
                    $f_olcusu_h = explode(' x ', $gdeger)[1];
                } elseif ($ayrac == 'h') {
                    $f_olcusu_w = explode(' x ', $gdeger)[0];
                    $f_olcusu_h = $request->value;;
                }
            }

            Gorevfiles::where('id', $request->id)->update([
                $request->attr => $f_olcusu_w . ' x ' . $f_olcusu_h
            ]);

            return response(['durum' => 'success', 'baslik' => 'Başarılı', 'icerik' => 'İşlem yapıldı.']);
        } catch (\Exception $e) {
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'İşlem yapılamadı.', 'hata' => $e]);
        }
    }


    public function post_sfc_attribute_update(Request $request)
    {
        $ffid = $request->fid;
        $fvid = $request->vid;
        $fattr = $request->attr;
        $fchd = $request->chd;

        $arrayimsi = "";
        $arrayimsi2 = Gorevfiles::where('id', $ffid)->value($fattr);

        if ($fchd == 1) {
            if ($arrayimsi2 == NULL) {
                $arrayimsi = $fvid;
            } else {
                $arrayimsi = $arrayimsi2 . '|' . $fvid;
            }
        } elseif ($fchd == 2) {
            $arrayimsi = $arrayimsi2;
            if (strpos($arrayimsi, '|') == false) { //tek dosya
                $arrayimsi = NULL;
            } else {
                $arrayimsi = str_replace($fvid, "", $arrayimsi2);

                if (substr($arrayimsi, -1) == "|") {//ilk dosya
                    $arrayimsi = rtrim($arrayimsi, "|");
                }
                if (substr($arrayimsi, 0, 1) == "|") {//son dosya
                    $arrayimsi = ltrim($arrayimsi, '|');
                }
                if (strpos($arrayimsi, '||')) {// aradan silinirse
                    $arrayimsi = str_replace('||', "|", $arrayimsi);
                }
            }
        }

        try {
            Gorevfiles::where('id', $ffid)->update([
                $fattr => $arrayimsi,
            ]);

            return response(['durum' => 'success', 'baslik' => 'Başarılı', 'icerik' => 'İşlem yapıldı.']);
        } catch (\Exception $e) {
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'İşlem yapılamadı.', 'hata' => $e]);
        }
    }


}
