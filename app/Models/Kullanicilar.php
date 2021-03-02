<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kullanicilar extends Model
{
    protected $table='users';
    protected $guarded = array('password');
    protected $with = ['utitle','utype','ugender'];

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
        'iletisim',
        'yetki'
    ];

    function utitle() {
        return $this->belongsTo('App\Models\Parameters', 'u_title', 'id')->where('type', 'titlecon');
    }
    function utype() {
        return $this->belongsTo('App\Models\Parameters', 'u_type', 'id')->where('type', 'materialcon');
    }
    function ugender() {
        return $this->belongsTo('App\Models\Parameters', 'gender', 'id')->where('type', 'gender');
    }

    protected $hidden = ['password'];

}
