<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gorevfiles extends Model
{
    protected $table = 'gorev_files';
    protected $fillable = ['f_icerik_id','f_icerik_olusturan','f_dosyayeri','r_dosyaisimi','f_dosyaisimi','f_malzeme_turu','f_baski_olcusu','f_urun_olcusu','f_uygulama','f_adet','slug','f_dosya_uzanti','f_dosya_boyut','f_urun_olcusu_b'];

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
