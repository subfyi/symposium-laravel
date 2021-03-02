<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Citations extends Model
{
    protected $table = 'citations';
    protected $fillable = [
        'article_id' , 'd_id', 'raw', 'type','order'
    ];

}
