<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Musteriler extends Model
{
    protected $table='musteriler';
    protected $fillable=['logo','slug','type','order_num','mus_bilgisi','mus_is_adi','mus_tel','mus_eposta','mus_adres','mus_kesif','mus_tes_adres','kurumadi'];


    public function kurum()
    {
        return $this->belongsTo('App\Models\Kurumlar', 'kurumadi', 'id');
    }

}
