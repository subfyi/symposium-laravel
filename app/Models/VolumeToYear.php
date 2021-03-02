<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VolumeToYear extends Model
{
    protected $table = 'volume_to_year';
    protected $fillable = [
        'volume_num', 'year', "short_year"
    ];

    public function yearto()
    {
        return $this->belongsTo('App\Models\Volumes', 'volume_num', 'volume');
    }

}
