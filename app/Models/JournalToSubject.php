<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JournalToSubject extends Model
{
    protected $table = 'journal_to_subject';
    protected $fillable = [
        'journal_id' ,'subject_id'
    ];

}
