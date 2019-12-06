<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Feedbackdata;
use App\Models\Gorevfiles;
use App\Models\Gorevicerik;
use App\Models\Gorevonizfile;
use App\Models\Kurumlar;
use App\Models\Musteriler;
use App\Models\Parameters;
use App\Models\Sss;
use App\Models\Announce;
use App\Models\Ayarlar;
use App\Models\Blog;
use App\Models\Gorevler;
use App\Models\Hakkimizda;
use App\Models\Kategori;
use App\Models\Kullanicilar;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminGetController extends AdminController
{
    public function get_profile()
    {
        $titlecons = Parameters::where('type', 'titlecon')->get();
        $materialcon = Parameters::where('type', 'materialcon')->get();
        $kullanicilar = Ayarlar::where('id', Auth::user()->id)->select('users.*')->first();
        return view("backend.ayarlar")
            ->with('titlecons', $titlecons)
            ->with('materialcon', $materialcon)
            ->with('kullanicilar', $kullanicilar);
    }
    public function get_preparing()
    {
        return view("backend.preparing");
    }

    Public function get_about_us()
    {
        $hakkimizda = Hakkimizda::where('id', 1)->select('hakkimizda.*')->first();
        return view("backend.hakkimizda")->with('hakkimizda', $hakkimizda);
    }

    Public function get_announce()
    {
        $announce = Announce::all();
        return view("backend.announce")->with('announce', $announce);
    }


    Public function get_user_mail(Request $request)
    {
        if (strlen($request->q) < 3)
            return [];

        $kullanicilar = DB::select('
        SELECT name, surname, email FROM (
            SELECT created_at, name, surname, email
            FROM users
            UNION SELECT created_at, name, surname, p_mail
            FROM p_authors
						ORDER BY created_at DESC
        ) AS a
        WHERE email like \'%'.$request->q.'%\'
        GROUP BY email, name, surname

        ');

        foreach ($kullanicilar as $kullanici) {
            if ($kullanici->email == $request->q) {
                return ["items" => $kullanicilar];
            }
        }

        $yeni = [["email" => $request->q]];

        return ["items" => array_merge($yeni, $kullanicilar)];
    }

    Public function get_tags(Request $request)
    {
        if (strlen($request->q) < 1)
            return [];

        $tagler = Parameters::where('type', 'tagcon')
                ->where('value', 'like', '%' . $request->q . '%')
                ->select('value AS tag')
                ->get()
                ->toArray();

        foreach ($tagler as $tag) {
            if ($tag['tag'] == $request->q) {
                return ["items" => []];
            }
        }

        $yeni = [["tag" => $request->q]];

        return ["items" => $tagler];//array_merge($yeni, $tagler)];
    }

    Public function get_announce_add()
    {
        return view("backend.announce_ekle");
    }


    Public function get_announce_edit($slug)
    {
        $announce = Announce::where('slug', $slug)->select('announcement.*')->first();
        return view("backend.announce_duzenle")->with('announce', $announce);
    }


    Public function get_faq()
    {
        $sss = Sss::all();
        return view("backend.sss")->with('sss', $sss);
    }

    Public function get_faq_add()
    {
        return view("backend.sss_ekle");
    }


    Public function get_faq_edit($slug)
    {
        $sss = Sss::where('slug', $slug)->select('sss.*')->first();
        return view("backend.sss_duzenle")->with('sss', $sss);
    }


    Public function get_blog()
    {
        $bloglar = Blog::all();
        return view("backend.blog")->with('bloglar', $bloglar);
    }

    Public function get_blog_add()
    {
        return view("backend.blog_ekle");
    }

    Public function get_blog_edit($id)
    {
        $bloglar = Blog::where('id', $id)->select('bloglar.*')->first();
        return view("backend.blog_duzenle")->with('bloglar', $bloglar);
    }

    Public function get_categories()
    {
        $kategoriler = Kategori::where('ust_kategori', 0)->get();
        return view("backend.kategoriler")->with('kategoriler', $kategoriler);
    }

    Public function get_categorie_add()
    {
        $kategoriler = Kategori::where('ust_kategori', 0)->get();
        return view("backend.kategori_ekle")->with('kategoriler', $kategoriler);
    }

    Public function get_is_turu()
    {
        $is_turu = Parameters::where('type', 'titlecon')->select('*')->get();
        return view("backend.is_turu")->with('type', $is_turu);
    }

    Public function get_is_turu_ekle()
    {
        $is_turu = Parameters::where('type', 'titlecon')->select('*')->get();
        return view("backend.is_turu_ekle")->with('type', $is_turu);
    }

    Public function get_malzeme_turu()
    {
        $malzeme_turu = Parameters::where('type', 'materialcon')->select('*')->get();
        return view("backend.malzeme_turu")->with('type', $malzeme_turu);
    }

    Public function get_malzeme_turu_ekle()
    {
        $malzeme_turu = Parameters::where('type', 'materialcon')->select('*')->get();
        return view("backend.malzeme_turu_ekle")->with('type', $malzeme_turu);
    }

    Public function get_birim_turu()
    {
        $birimcon = Parameters::where('type', 'birimcon')->select('*')->get();
        return view("backend.birim_turu")->with('type', $birimcon);
    }

    Public function get_birim_turu_ekle()
    {
        $birimcon = Parameters::where('type', 'birimcon')->select('*')->get();
        return view("backend.birim_turu_ekle")->with('type', $birimcon);
    }

    Public function get_uygulama_turu()
    {
        $uygulama_turu = Parameters::where('type', 'uygulamacon')->select('*')->get();
        return view("backend.uygulama_turu")->with('type', $uygulama_turu);
    }

    Public function get_uygulama_turu_ekle()
    {
        $uygulama_turu = Parameters::where('type', 'uygulamacon')->select('*')->get();
        return view("backend.uygulama_turu_ekle")->with('type', $uygulama_turu);
    }

    Public function get_yetki_turu()
    {
        $yetki_turu = Parameters::where('type', 'yetkicon')->select('*')->get();
        return view("backend.yetki_turu")->with('type', $yetki_turu);
    }

    Public function get_yetki_turu_ekle()
    {
        $yetki_turu = Parameters::where('type', 'yetkicon')->select('*')->get();
        return view("backend.yetki_turu_ekle")->with('type', $yetki_turu);
    }

    Public function get_paper_all()
    {
        $tumgorevler = Gorevler::where('pap_status', '!=', '3')->where('pap_type', '!=', '1')->where('pap_creater', '=', Auth::user()->id)->select('*')->get();
        $uygulamacon = Parameters::select('*')->Where('parameters.type', '=', 'uygulamacon')->get();
        $birimcon = Parameters::select('*')->Where('parameters.type', '=', 'birimcon')->get();
        $titlecons = Parameters::where('type', 'titlecon')->get();
        $materialcon = Parameters::where('type', 'materialcon')->get();

        return view("backend.paper_all")
            ->with('materialcon', $materialcon)
            ->with('uygulamacon', $uygulamacon)
            ->with('birimcon', $birimcon)
            ->with('titlecons', $titlecons)
            ->with('tumgorevler', $tumgorevler);
    }

    Public function get_papers_all()
    {
        $tumgorevler = Gorevler::where('pap_status', '!=', '3')->where('pap_type', '!=', '1')->select('*')->get();
        $uygulamacon = Parameters::select('*')->Where('parameters.type', '=', 'uygulamacon')->get();
        $birimcon = Parameters::select('*')->Where('parameters.type', '=', 'birimcon')->get();
        $titlecons = Parameters::where('type', 'titlecon')->get();
        $materialcon = Parameters::where('type', 'materialcon')->get();

        return view("backend.papers_all")
            ->with('materialcon', $materialcon)
            ->with('uygulamacon', $uygulamacon)
            ->with('birimcon', $birimcon)
            ->with('titlecons', $titlecons)
            ->with('tumgorevler', $tumgorevler);
    }

    public function get_paper_add()
    {
        $kullanicilar = Kullanicilar::where('id', Auth::id())->select('users.*')->first();
        $titlecons = Parameters::where('type', 'titlecon')->get();
        $materialcon = Parameters::where('type', 'materialcon')->get();
        $musteriler = Musteriler::where('kurumadi', '!=', '17')->where('kurumadi', '=', '30')->get();
        $kurumlar = Kurumlar::where('id', '!=', '17')->where('ust_kategori', 0)->orderBy('ad', 'asc')->get();
        $uygulamacon = Parameters::select('*')->Where('parameters.type', '=', 'uygulamacon')->get();
        $birimcon = Parameters::select('*')->Where('parameters.type', '=', 'birimcon')->get();


        return view("backend.paper_add")
            ->with('kullanicilar', $kullanicilar)
            ->with('materialcon', $materialcon)
            ->with('musteriler', $musteriler)
            ->with('kurumlar', $kurumlar)
            ->with('uygulamacon', $uygulamacon)
            ->with('birimcon', $birimcon)
            ->with('titlecons', $titlecons);
    }

    public function get_papers_add()
    {
        $kullanicilar = Kullanicilar::orderBy('name', 'asc')->get();
        $titlecons = Parameters::where('type', 'titlecon')->get();
        $materialcon = Parameters::where('type', 'materialcon')->get();
        $musteriler = Musteriler::where('kurumadi', '!=', '17')->where('kurumadi', '=', '30')->get();
        $kurumlar = Kurumlar::where('id', '!=', '17')->where('ust_kategori', 0)->orderBy('ad', 'asc')->get();
        $uygulamacon = Parameters::select('*')->Where('parameters.type', '=', 'uygulamacon')->get();
        $birimcon = Parameters::select('*')->Where('parameters.type', '=', 'birimcon')->get();

        return view("backend.papers_add")
            ->with('kullanicilar', $kullanicilar)
            ->with('materialcon', $materialcon)
            ->with('musteriler', $musteriler)
            ->with('kurumlar', $kurumlar)
            ->with('uygulamacon', $uygulamacon)
            ->with('birimcon', $birimcon)
            ->with('titlecons', $titlecons);
    }

    Public function get_gorev_duzenle($slug)
    {
        $gorevonizfile = Gorevonizfile::where('slug', $slug)->first();
        $gorevler = Gorevler::where('slug', $slug)->select('gorevler.*')->first();
        $gorevicerik = Gorevicerik::where('slug', $slug)->select('gorev_icerik.*')->get();
        $gorevfiles = Gorevfiles::where('slug', $slug)->select('gorev_files.*')->get();
        $musteriler = Musteriler::orderBy('id', 'desc')->get();
        $titlecons = Parameters::select('*')->Where('parameters.type', '=', 'titlecon')->get();
        $materialcon = Parameters::select('*')->Where('parameters.type', '=', 'materialcon')->get();
        $uygulamacon = Parameters::select('*')->Where('parameters.type', '=', 'uygulamacon')->get();
        $birimcon = Parameters::select('*')->Where('parameters.type', '=', 'birimcon')->get();
        $kullanicilar = Kullanicilar::where('id', Auth::id())->select('users.*')->first();
        $kurumlar = Kurumlar::where('ust_kategori', 0)->orderBy('ad', 'asc')->get();

        return view("backend.gorev_duzenle")
            ->with('gorevonizfile', $gorevonizfile)
            ->with('kullanicilar', $kullanicilar)
            ->with('kurumlar', $kurumlar)
            ->with('gorevfiles', $gorevfiles)
            ->with('gorevicerik', $gorevicerik)
            ->with('gorevler', $gorevler)
            ->with('musteriler', $musteriler)
            ->with('materialcon', $materialcon)
            ->with('uygulamacon', $uygulamacon)
            ->with('birimcon', $birimcon)
            ->with('titlecons', $titlecons);
    }

    Public function get_feedback()
    {
        $feedback = Feedback::all();
        $feedbackdata = Feedbackdata::all();
        return view("backend.feedback")
            ->with('feedbackdata', $feedbackdata)
            ->with('feedback', $feedback);
    }

    Public function get_feedback_add()
    {
        return view("backend.feedback_ekle");
    }

    Public function get_feedback_edit($slug)
    {
        $feedbacks = Feedback::where('slug', $slug)->select('*')->first();
        $feedbackdata = Feedbackdata::where('slug', $slug)->select('*')->get();

        return view("backend.feedback_duzenle")
            ->with('gorevicerik', $feedbackdata)
            ->with('gorevler', $feedbacks);
    }

    Public function get_users()
    {
        $kullanicilar = Kullanicilar::all();
        $yetkicons = Parameters::where('type', 'yetkicon')->get();
        $titlecons = Parameters::where('type', 'titlecon')->get();
        return view("backend.kullanicilar")
            ->with('kullanicilar', $kullanicilar)
            ->with('titlecons', $titlecons)
            ->with('yetkicons', $yetkicons);
    }


    Public function get_user_edit($slug)
    {
        $titlecons = Parameters::where('type', 'titlecon')->get();
        $materialcon = Parameters::where('type', 'materialcon')->get();
        $yetkicons = Parameters::where('type', 'yetkicon')->get();
        $titlecons = Parameters::where('type', 'titlecon')->get();
        $kullanicilar = Kullanicilar::where('slug', $slug)->first();
        return view("backend.kullanici_duzenle")
            ->with('titlecons', $titlecons)
            ->with('materialcon', $materialcon)
            ->with('kullanicilar', $kullanicilar)
            ->with('titlecons', $titlecons)
            ->with('yetkicons', $yetkicons);
    }

    Public function get_user_add()
    {

        $yetkicons = Parameters::where('type', 'yetkicon')->get();
        $titlecons = Parameters::where('type', 'titlecon')->get();
        $materialcon = Parameters::where('type', 'materialcon')->get();
        $gendercon = Parameters::where('type', 'gender')->get();
        return view("backend.kullanici_ekle")
            ->with('yetkicons', $yetkicons)
            ->with('titlecons', $titlecons)
            ->with('gendercon', $gendercon)
            ->with('materialcon', $materialcon);

    }
}
