<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';
    protected $fillable = ['grv_id','grv_durum','f_icerik_olusturan','f_dosyayeri','r_dosyaisimi','f_dosyaisimi','f_dosya_uzanti','f_dosya_boyut','slug'];

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
        return $this->belongsTo('App\Models\Gorevicerik', 'f_icerik_id', 'id');
    }

}
