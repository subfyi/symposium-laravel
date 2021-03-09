<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Authors extends Model
{
    protected $table = 'authors';
    protected $fillable = ['p_id', 'p_user', 'name', 'surname',  'adress', 'p_mail', 'correspond', 'presenter'];

}
