<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kurumlar extends Model
{
    protected $table='kurumlar';
    protected $fillable=['ad','ust_kategori','slug'];


    public function parent(){
        return $this->belongsTo('App\Models\Kurumlar','ust_kategori');
    }

    public function children(){
        return  $this->hasMany('App\Models\Kurumlar','ust_kategori');
    }

    public function musteriler(){
        return  $this->hasMany('App\Models\Musteriler','kurumadi', 'id');
    }
}
