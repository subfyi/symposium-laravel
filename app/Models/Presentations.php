<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presentations extends Model
{
    protected $table = 'presentations';
    protected $fillable = [
        'active', 'type', 'name', 'created_by', 'updated_by',
    ];

    public function lang()
    {
        return $this->belongsTo('App\Models\Languages', 'type', 'id');
    }

    protected $dates = [
        'updated_at',
        'created_at',
    ];
}
