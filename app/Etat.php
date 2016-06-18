<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etat extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     protected $fillable = ['designation','description','img','etat'];

     /**
     * The relationship.
     *
     * @var array
     */

    public function engagements()
    {
        return $this->belongsToMany('App\Engagement');
    }

    public function engagementetat(){
        return $this->hasMany('App\EngagementEtat');
    }
}
