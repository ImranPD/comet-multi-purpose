<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded=[];

    /**
     * relation with post model
     *
     */

     public function post(){

        return $this->belongsTo('App\Models\Post');
     }

     /**
      * relation with user model
      */

      public function user(){

        return $this->belongsTo('App\Models\User');
      }
}
