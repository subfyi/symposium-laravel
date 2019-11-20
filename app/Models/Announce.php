<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announce extends Model
{
    protected $table = 'announcement';
    protected $fillable = ['baslik', 'icerik', 'yazar', 'istek_birimi', 'islem', 'slug'];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'yazar');
    }




}
