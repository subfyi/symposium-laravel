<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JournalInfo extends Model
{
    use SoftDeletes;

    protected $table = 'journal_info';
    protected $fillable = [
        'id', 'journal_id', 'd_id', 'lang_id', 'title', 'subtitle', 'description', 'title_abbr', 'footer_text', 'mail_signature', 'aim', 'scope', 'writing_rules', 'policy'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
