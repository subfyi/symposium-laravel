<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sss extends Model
{
    protected $table = 'sss';
    protected $fillable = ['baslik', 'icerik', 'yazar', 'istek_birimi', 'islem', 'slug'];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'yazar');
    }




}
