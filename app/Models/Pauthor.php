<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pauthor extends Model
{
    protected $table = 'p_authors';
    protected $fillable = ['p_id', 'p_user', 'name', 'surname', 'p_mail', 'correspond', 'presenter'];

}
