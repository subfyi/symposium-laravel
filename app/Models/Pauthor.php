<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pauthor extends Model
{
    protected $table = 'p_authors';
    protected $fillable = ['p_id', 'p_user', 'name', 'surname',  'adress', 'p_mail', 'correspond', 'presenter'];

}
