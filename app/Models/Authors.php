<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Authors extends Model
{
    protected $table = 'authors';
    protected $fillable = [
       'd_id', 'email', 'first_name', 'middle_name', 'last_name', 'adress', 'orcid'
    ];

}
