<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gorevonizfile extends Model
{
    protected $table = 'gorev_onizfile';
    protected $fillable = ['f_icerik_olusturan','f_dosyayeri','r_dosyaisimi','f_dosyaisimi','slug','f_dosya_uzanti','f_dosya_boyut'];

    public function user()
    {
        return $this->belongsTo('App\User', 'grv_icerik_olusturan', 'id');
    }


    public function parent()
    {
        return $this->belongsTo('App\Models\Gorevicerik', 'f_icerik_id', 'id');
    }
}
