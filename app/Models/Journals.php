<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Journals extends Model
{
    use SoftDeletes;

    protected $with = ['image_header', 'image'];
    protected $table = 'journals';
    protected $fillable = [
        'json_id', 'd_id', 'image_id', 'image_header_id', 'founded', 'url', 'address', 'phone', 'email', 'eissn',
        'pissn', 'slug', 'printed', 'mandatory_lang', 'mandatory_rtl', 'view_count', 'download_count',
        'created_by', 'updated_by'
    ];

    public function image_header()
    {
        return $this->belongsTo('App\Models\Files', 'image_header_id', 'id');
    }


    public function image()
    {
        return $this->belongsTo('App\Models\Files', 'image_id', 'id');
    }

    public function journal_info()
    {
        return $this->hasMany('App\Models\JournalInfo', 'journal_id', 'id');
    }

    public function volumes()
    {
        return $this->hasMany('App\Models\Volumes', 'journal_id', 'id');
    }
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
