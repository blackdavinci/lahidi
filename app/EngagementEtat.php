<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EngagementEtat extends Model
{
     protected $table = 'engagement_etat';

      /**
      * The relationship.
      *
      * @var array
      */

      public function commentaires(){

         return $this->hasMany('App\Commentaire');
     }

       public function etat(){

         return $this->belongsTo('App\Etat');
     }

      public function engagement(){

         return $this->belongsTo('App\Engagement');
     }
}
