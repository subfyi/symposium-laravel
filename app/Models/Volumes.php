<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Volumes extends Model
{
    use SoftDeletes;

    protected $table = 'volumes';
    protected $fillable = [
        'journal_id', 'd_id', 'volume', 'issue', 'special', 'year', 'long_year', 'short_year', 'json_id', 'created_by', 'date_published', 'season', 'supplement',
    ];

    public function articles()
    {
        return $this->hasMany('App\Models\Articles', 'v_id', 'id');
    }

    public function journalto()
    {
        return $this->belongsTo('App\Models\Journals', 'journal_id', 'id');
    }

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
