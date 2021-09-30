<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded=[];



    //one to one relation with post model

    public function user(){

        return $this->belongsTo('App\Models\User');
    }

    //many to many relation with category model

        public function categories(){

            return $this->belongsToMany('App\Models\Category');
        }

        //many to many relation with post model

        public function tags(){

            return $this->belongsToMany('App\Models\Tag');
        }


        /**
         * relation with comment model
         *
         */

         public function comments(){

            return $this->hasMany('App\Models\Comment');
         }

}
