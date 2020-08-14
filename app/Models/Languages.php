<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Languages extends Model
{
    protected $table = 'languages';
    protected $fillable = [
        'active', 'name','created_by', 'updated_by',
    ];

    protected $dates = [
        'updated_at',
        'created_at',
    ];
}
