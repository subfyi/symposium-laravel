<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleToSubject extends Model
{
    protected $with = ['subject'];
    protected $table = 'article_to_subject';
    protected $fillable = [
        'article_id' ,'subject_id'
    ];

    public function subject()
    {
        return $this->belongsTo('App\Models\Subjects', 'subject_id', 'id');
    }
}
