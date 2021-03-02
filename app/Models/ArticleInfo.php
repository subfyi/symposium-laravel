<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleInfo extends Model
{
    use SoftDeletes;

    protected $table = 'article_info';
    protected $fillable = [
        'd_id', 'v_id', 'article_id', 'lang_id', 'title', 'abstract', 'created_by'
    ];
    public function language()
    {
        return $this->belongsTo('App\Models\Languages', 'lang_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'pap_creater', 'id');
    }

    public function volumes()
    {
        return $this->belongsTo('App\Models\Volumes', 'v_id', 'id');
    }


    public function authors()
    {
        return $this->hasMany('App\Models\ArticleToAuthor', 'article_id', 'id');
    }

    public function citations()
    {
        return $this->hasMany('App\Models\Citations', 'article_id', 'id');
    }

    public function keywords()
    {
        return $this->hasMany('App\Models\ArticleToKeyword', 'article_id', 'id');
    }

    public function subjets()
    {
        return $this->hasMany('App\Models\ArticleToSubject', 'article_id', 'id');
    }

    public function types()
    {
        return $this->belongsTo('App\Models\Types', 'type_id', 'id');
    }

    public function files()
    {
        return $this->hasMany('App\Models\ArticleToFiles', 'article_id', 'id');
    }

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
