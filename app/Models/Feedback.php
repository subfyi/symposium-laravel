<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedbacks';
    protected $fillable = ['grv_icerik_yonetici', 'grv_bitis_tarih', 'grv_onemi', 'slug'];

    public function user()
    {
        return $this->belongsTo('App\User', 'grv_icerik_yonetici', 'id');
    }

    public function feeddata()
    {
        return $this->hasMany('App\Models\Feedbackdata', 'slug', 'slug');
    }

    public function feeddatalast()
    {
        return $this->hasOne('App\Models\Feedbackdata', 'slug', 'slug')->latest();
    }

    public function feeddatalastuser()
    {
        return $this->belongsTo('App\Models\Kullanicilar', 'id', 'id');
    }

    public function feeddatalastuid()
    {
        return $this->hasOne('App\User', 'id', 'grv_icerik_yonetici');
    }

    protected $dates = [
        'created_at',
        'updated_at',
        'grv_bitis_tarih',
    ];


}
