<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleToKeyword extends Model
{
    protected $with = ['keyword'];
    protected $table = 'article_to_keyword';
    protected $fillable = [
        'article_id' ,'keyword_id'
    ];

    public function keyword()
    {
        return $this->belongsTo('App\Models\Keywords', 'keyword_id', 'id');
    }
}
