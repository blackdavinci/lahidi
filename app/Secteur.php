<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Secteur extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     protected $fillable = ['nom','description','etat'];

     /**
     * The relationship.
     *
     * @var array
     */

     public function engagements(){

        return $this->hasMany('App\Engagement');
    }
}
