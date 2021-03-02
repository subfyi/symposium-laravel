<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleToAuthor extends Model
{
    protected $with = ['author'];
    protected $table = 'article_to_author';
    protected $fillable = [
        'article_id' ,'author_id','order'
    ];

    public function author()
    {
        return $this->belongsTo('App\Models\Authors', 'author_id', 'id');
    }
}
