<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ayarlar extends Model
{
    protected $table='users';
    protected $fillable=['name','surname','email','password','yetki','remember_token',  'logo','iletisim','address','slug','yetki_alani','u_title','u_type','gender','status','institution','faculty','department'];
}

