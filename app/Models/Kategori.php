<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table='kategoriler';
    protected $fillable=['ad','ust_kategori','slug'];

    public function parent(){
        return $this->belongsTo('App\Models\Kategori','ust_kategori');
    }

    public function children(){
        return  $this->hasMany('App\Models\Kategori','ust_kategori');
    }

    public function bloglar(){
        return  $this->hasMany('App\Models\Blog','ust_kategori', 'id');
    }
}
