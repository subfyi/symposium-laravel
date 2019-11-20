<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Kategori;

class Blog extends Model
{
    protected $table = 'bloglar';
    protected $fillable = ['baslik', 'kullanici_id', 'icerik', 'yazar', 'etiketler', 'kategori', 'resimler[]', 'slug'];

    public function parent()
    {
        return $this->belongsTo('App\Models\Kategori', 'kategori', 'id');
    }

    public function yorumlar()
    {
        return $this->hasMany('App\Models\Yorum', 'blog', 'slug');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'yazar');
    }

    public function idsor($slug){
        return $this->where('slug', $slug)->select('bloglar.id')->first();
    }

}
