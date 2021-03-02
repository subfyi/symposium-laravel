<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleToArticleType extends Model
{
    protected $table = 'article_to_article_type';
    protected $fillable = [
        'article_id' ,'article_type_id'
    ];

}
