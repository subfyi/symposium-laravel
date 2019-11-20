<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parameters extends Model
{
    protected $table='parameters';
    protected $fillable=['type','value','item_num'];
}
