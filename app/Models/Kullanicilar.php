<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kullanicilar extends Model
{
    protected $table='users';

    public function utitle()
    {
        return $this->belongsTo('App\Models\Parameters', 'u_title', 'item_num')->where('type','=','titlecon');
    }



    protected $fillable = [
        'name',
        'surname',
        'email',
        'address',
        'password',
        'u_title',
        'u_type',
        'gender',
        'status',
        'institution',
        'faculty',
        'department',
        'slug',
        'iletisim'
    ];
}
