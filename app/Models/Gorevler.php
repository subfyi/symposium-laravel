<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gorevler extends Model
{
    protected $table='gorevler';
    protected $fillable=['pap_title','pap_topic','pap_creater','pap_type','pre_type','slug','pap_status','pap_payment',
        'pap_abstract','pap_keyword','pap_topic_p','mes_congress', 'abstract_dosya_id', 'full_paper_dosya_id', 'poster_presentation_id', 'video_id', 'video_presentation_url'];

    public function user()
    {
        return $this->belongsTo('App\User', 'pap_creater', 'id');
    }

    public function parampap()
    {
        return $this->belongsTo('App\Models\Parameters', 'pap_type', 'id');
    }

    public function icerikler()
    {
        return $this->hasMany('App\Models\Gorevicerik', 'slug', 'slug');
    }
    
    public function parampre()
    {
        return $this->belongsTo('App\Models\Parameters', 'pre_type', 'id');
    }

    public function topic()
    {
        return $this->belongsTo('App\Models\Parameters', 'pap_topic_p', 'id');
    }

    public function authors()
    {
        return $this->hasMany('App\Models\Pauthor', 'p_id', 'id');
    }

    public function dosyalar()
    {
        return $this->hasMany('App\Models\Gorevfiles', 'slug', 'slug');
    }

    public function abstract_dosya()
    {
        return $this->belongsTo('App\Models\Dosyalar', 'abstract_dosya_id', 'id');
    }

    public function full_paper_dosya()
    {
        return $this->belongsTo('App\Models\Dosyalar', 'full_paper_dosya_id', 'id');
    }

    public function poster_presentation_dosya()
    {
        return $this->belongsTo('App\Models\Dosyalar', 'poster_presentation_id', 'id');
    }

    public function video()
    {
        return $this->belongsTo('App\Models\Dosyalar', 'video_id', 'id');
    }

    protected $dates = [
        'updated_at',
        'created_at',
    ];
}
