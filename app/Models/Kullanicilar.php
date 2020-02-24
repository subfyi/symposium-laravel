<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kullanicilar extends Model
{
    protected $table='users';
    protected $guarded = array('password');

    public function utitle()
    {
        return $this->belongsTo('App\Models\Parameters', 'u_title', 'id');
    }

    public function utype()
    {
        return $this->belongsTo('App\Models\Parameters', 'u_type', 'id');
    }

    public function genderdata()
    {
        return $this->belongsTo('App\Models\Parameters', 'gender', 'id');
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
