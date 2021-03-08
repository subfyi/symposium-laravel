<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dosyalar extends Model
{
    protected $appends = ['name', 'size', 'access_url'];

    protected $table = 'dosyalar';
    protected $fillable = [
        'f_icerik_olusturan', 'f_dosyayeri', 'r_dosyaisimi', 'f_dosyaisimi', 'g_dosyaismi', 'f_klasorismi', 'g_klasorismi', 'f_dosya_uzanti', 'f_dosya_boyut', 'width', 'height', 'f_sira'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function getNameAttribute()
    {
        return $this->attributes['r_dosyaisimi'];
    }

    public function getSizeAttribute()
    {
        return $this->attributes['f_dosya_boyut'];
    }

    public function getAccessUrlAttribute()
    {
        return request()->getSchemeAndHttpHost() . '/uploads/' . $this->attributes['f_klasorismi'] . '/' . $this->attributes['f_dosyaisimi'];
    }
}
