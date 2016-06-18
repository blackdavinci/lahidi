<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     protected $fillable = ['titre','contenu','etat','user_id','engagement_etat_id'];

     /**
     * The relationship.
     *
     * @var array
     */

     public function engagementetat(){

        return $this->belongsTo('App\EngagementEtat');
    }
}
