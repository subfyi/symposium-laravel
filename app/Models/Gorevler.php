<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gorevler extends Model
{
    protected $table='gorevler';
    protected $fillable=['pap_title','pap_topic','pap_creater','pap_type','pre_type','slug','pap_status','pap_payment',
        'pap_abstract','pap_keyword','pap_topic_p','mes_congress'];

    public function user()
    {
        return $this->belongsTo('App\User', 'pap_creater', 'id');
    }

    public function parampap()
    {
        return $this->belongsTo('App\Models\Parameters', 'pap_type', 'item_num')->where('type','=','birimcon');
    }

    public function parampre()
    {
        return $this->belongsTo('App\Models\Parameters', 'pre_type', 'item_num')->where('type','=','uygulamacon');
    }

    public function dosyalar()
    {
        return $this->belongsTo('App\Models\Gorevfiles', 'slug', 'slug');
    }

    protected $dates = [
        'updated_at',
        'created_at',
    ];


}
