<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Article extends Model
{
	use Sluggable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titre', 'contenu', 'lien','image','video','audio','doc','user_id','etat','slug'
    ];

    /**
         * Return the sluggable configuration array for this model.
         *
         * @return array
         */
        public function sluggable()
        {
            return [
                'slug' => [
                    'source' => 'titre'
                ]
            ];
        }

}
