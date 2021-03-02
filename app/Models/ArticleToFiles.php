<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleToFiles extends Model
{
    protected $with = ['file'];
    protected $table = 'article_to_files';
    protected $fillable = [
        'article_id', 'file_id'
    ];

    public function file()
    {
        return $this->belongsTo('App\Models\Files', 'file_id', 'id');
    }

}
