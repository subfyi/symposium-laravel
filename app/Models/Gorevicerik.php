<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gorevicerik extends Model
{
    protected $table = 'gorev_icerik';
    protected $fillable = ['isicerik', 'slug', 'ust_icerik', 'grv_icerik_olusturan','dosyaisimleri','gdosyaisimleri','r_dosyaisimleri','r_gdosyaisimleri'];


    public function user()
    {
        return $this->belongsTo('App\User', 'grv_icerik_olusturan', 'id');
    }


    public function malzeme()
    {
        return $this->belongsTo('App\Articles', 'slug', 'slug');
    }

    public function yorumlar()
    {
        return $this->hasMany('App\Gorev', 'slug', 'slug');
    }

    public function dosyalar()
    {
        return $this->hasMany('App\Gorevfiles', 'f_icerik_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Kategori', 'ust_icerik');
    }

    public function children()
    {
        return $this->hasMany('App\Gorevicerik', 'ust_icerik');
    }
}
