<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JournalToPublisher extends Model
{
    protected $table = 'journal_to_publisher';
    protected $fillable = [
        'journal_id' ,'publisher_id'
    ];

}
