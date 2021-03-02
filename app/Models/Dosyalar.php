<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dosyalar extends Model
{

    protected $table = 'dosyalar';
    protected $fillable = [
        'f_icerik_olusturan', 'f_dosyayeri', 'r_dosyaisimi', 'f_dosyaisimi', 'g_dosyaismi', 'f_klasorismi', 'g_klasorismi', 'f_dosya_uzanti', 'f_dosya_boyut', 'width', 'height', 'f_sira'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
