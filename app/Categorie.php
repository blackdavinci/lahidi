<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     protected $fillable = ['designation','description','etat'];

     /**
     * The relationship.
     *
     * @var array
     */

     public function engagements(){

        return $this->hasMany('App\Engagement');
    }
}
