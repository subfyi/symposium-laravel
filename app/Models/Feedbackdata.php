<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedbackdata extends Model
{
    protected $table = 'feedbackdata';
    protected $fillable = ['isicerik', 'slug', 'ust_icerik', 'grv_icerik_olusturan','dosyaisimleri','gdosyaisimleri','r_dosyaisimleri','r_gdosyaisimleri'];


    public function user()
    {
        return $this->belongsTo('App\User', 'grv_icerik_olusturan', 'id');
    }

    public function yorumlar()
    {
        return $this->hasMany('App\Models\Gorev', 'slug', 'slug');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Kategori', 'ust_icerik');
    }

    public function children()
    {
        return $this->hasMany('App\Models\Gorevicerik', 'ust_icerik');
    }

    public function feeddatalastuser()
    {
        return $this->belongsTo('App\Models\Kullanicilar', 'id', 'id');
    }
}
