<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Hakkimizda;
use App\Models\Kategori;
use App\Models\Yorum;
use Illuminate\Support\Facades\Auth;

class HomeGetController extends HomeController
{
    Public function get_login()
    {
        return redirect('https://portal.iseser.com/');
    }
    Public function get_403()
    {
        return redirect('https://portal.iseser.com/');
    }
    Public function get_logout()
    {
        return redirect('https://portal.iseser.com/');
    }
    Public function get_index()
    {
        return view('frontend.index');
    }
    Public function get_honorary_committee()
    {
        return view('frontend.honorary-committee');
    }
    Public function get_organization_committee()
    {
        return view('frontend.organization-committee');
    }
    Public function get_science_commission()
    {
        return view('frontend.science-commission');
    }
    Public function get_adviser_commission()
    {
        return view('frontend.adviser-commission');;
    }
    Public function get_invitation()
    {
        return view('frontend.invitation');
    }
    Public function get_threads()
    {
        return view('frontend.threads');
    }
    Public function get_important_dates()
    {
        return view('frontend.important-dates');
    }
    Public function get_conference_fee()
    {
        return view('frontend.conference-fee');
    }
    Public function get_sponsors()
    {
        return view('frontend.sponsors');
    }
    Public function get_contact()
    {
        return view('frontend.contact');
    }

    Public function get_documents()
    {
        return view('frontend.documents');
    }
    Public function get_documents_all()
    {
        return view('frontend.documents_all');
    }

    Public function get_documents_2019()
    {
        return view('frontend.documents_2019');
    }
    Public function get_documents_2018()
    {
        return view('frontend.documents_2018');
    }

    Public function get_documents_2017()
    {
        return view('frontend.documents_2017');
    }

    Public function get_documents_2016()
    {
        return view('frontend.documents_2016');
    }

    Public function get_iseser_annon()
    {
        return view('frontend.iseser-annon6');
    }

    public function get_hakkimizda(){
        $hakkimizda = Hakkimizda::where('id', 1)->select('hakkimizda.*')->first();
        $bloglar = Blog::orderBy('id','desc')->take(3)->get();
        return view('frontend.index')->with('hakkimizda' , $hakkimizda)->with('bloglar' , $bloglar);
    }


    public function get_blog(){
        $kategoriler = Kategori::where('ust_kategori', '0')->get();
        $bloglar = Blog::orderBy('id','desc')->get();
        return view('frontend.blog')->with('bloglar', $bloglar)->with('kategoriler' , $kategoriler);
    }

    public function get_blog_icerik($slug){

        $kategori = explode('/',$slug);

        $kategoriler = Kategori::where('ust_kategori', '0')->get();
        $blog = Blog::where('slug',$kategori[count($kategori)-1])->first();

        if(isset($blog)){
            return view('frontend.blog-detay')->with('blog', $blog)->with('kategoriler' , $kategoriler)->with('blog-kategori', $kategoriler);
        }else{
            $s=$kategori[count($kategori)-1];
            $b=Kategori::where('slug',$s)->get();
            $bloglar = $b[0]->bloglar;
            return view('frontend.blog')->with('bloglar', $bloglar)->with('kategoriler' , $kategoriler);

        }
    }

    public function get_blog_yazar($yazar){
        $y = explode('-',$yazar);
        $kategoriler = Kategori::where('ust_kategori', '0')->get();
        $bloglar = Blog::where('yazar', $y[count($y)])->orderBy('id','desc')->get();
        return view('frontend.blog')->with('bloglar', $bloglar)->with('kategoriler' , $kategoriler);
    }

    public function get_icerik(){
        $hakkimizda = Yorum::where('id', 1)->select('hakkimizda.*')->first();
        $bloglar = Blog::orderBy('id','desc')->take(3)->get();
        return view('frontend.blog_detay')->with('hakkimizda' , $hakkimizda)->with('bloglar' , $bloglar);
    }

    public function get_index_yonlendir(){
        return redirect('/');
    }

}
