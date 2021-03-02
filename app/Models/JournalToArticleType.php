<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JournalToArticleType extends Model
{
    protected $table = 'journal_to_article_type';
    protected $fillable = [
        'journal_id' ,'article_type_id'
    ];

}
