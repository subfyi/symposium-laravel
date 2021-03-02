<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleToCitation extends Model
{
    protected $with = ['citation'];
    protected $table = 'article_to_citation';
    protected $fillable = [
        'article_id' ,'citation_id'
    ];

    public function citation()
    {
        return $this->belongsTo('App\Models\Citations', 'citation_id', 'id');
    }
}
