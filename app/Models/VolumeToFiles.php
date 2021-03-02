<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VolumeToFiles extends Model
{
    protected $table = 'volume_to_files';
    protected $fillable = [
        'volume_id', 'd_id', 'lang_id', 'title', "description", 'file_id', "type"
    ];

    public function yearto()
    {
        return $this->belongsTo('App\Models\Volumes', 'volume_num', 'volume');
    }

}
