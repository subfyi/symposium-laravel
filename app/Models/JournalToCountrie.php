<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JournalToCountrie extends Model
{
    protected $table = 'journal_to_countrie';
    protected $fillable = [
        'journal_id' ,'countrie_id'
    ];

}
