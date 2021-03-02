<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Publishers extends Model
{
    use SoftDeletes;

    protected $with = ['language'];
    protected $table = 'publishers';
    protected $fillable = [
        'd_id' ,'lang_id' ,'name','email','lft','address_lat','address_long'
    ];
    public function language()
    {
        return $this->belongsTo('App\Models\Languages', 'lang_id', 'id');
    }


    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
