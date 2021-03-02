<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    protected $appends = ['name', 'size', 'access_url'];

    protected $with=['childs'];
    protected $hidden=['created_at', 'updated_at', 'f_dosyayeri', 'f_sira', 'f_icerik_olusturan', 'g_dosyaismi', 'g_klasorismi', 'f_dosya_uzanti'];

    protected $table='files';
    protected $fillable=['f_icerik_olusturan', 'f_dosyayeri', 'r_dosyaisimi', 'f_dosyaisimi', 'g_dosyaismi', 'f_klasorismi', 'g_klasorismi', 'f_dosya_uzanti', 'f_dosya_boyut', 'width', 'height', 'f_sira', 'parent_id', 'url', 'last_modified', 'content_type'];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    function childs() {
        return $this->hasMany('App\Models\Files', 'parent_id', 'id');
    }


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
