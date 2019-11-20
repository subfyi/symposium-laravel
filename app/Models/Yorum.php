<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Yorum extends Model
{
    protected $table = 'yorumlar';
    protected $fillable = ['isim', 'mail', 'icerik', 'blog', 'ust_yorum', 'kullanici_id'];


    public function user()
    {
        return $this->belongsTo('App\Models\Kategori', 'kategori', 'id');
    }

    public function yorumlar()
    {
        return $this->hasMany('App\Models\Yorum', 'blog', 'slug');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Kategori', 'ust_kategori');
    }

    public function children()
    {
        return $this->hasMany('App\Models\Yorum', 'ust_yorum');
    }
}
