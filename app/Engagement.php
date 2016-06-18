<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Engagement extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = true;
    
     protected $fillable = ['intitule','description','etat','source','note','localite','prefecture','sous_prefecture',
                    'district','date_debut','date_fin','valider','secteur_id','categorie_id','user_id'];

     /**
     * The relationship.
     *
     * @var array
     */

     public function secteur(){

        return $this->belongsTo('App\Secteur');
    }

    public function categorie(){

        return $this->belongsTo('App\Categorie');
    }

    public function user(){

        return $this->belongsTo('App\User');
    }

    public function etats(){
        return $this->belongsToMany('App\Etat')->withPivot('titre_commentaire', 'commentaire','etat','id')->withTimestamps();

    }
    
    public function commentaires(){
        return $this->hasMany('App\Commentaire');
    }

    public function engagementetats(){
        return $this->hasMany('App\EngagementEtat');
    }

}
