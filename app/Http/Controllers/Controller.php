<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;



    /**
     * get video post
     */

     protected function getEmbed($link){

        if(str_contains($link,'youtube')){

            return str_replace('watch?v=','embed/',$link);

        }elseif(str_contains($link,'vimeo')){

            return str_replace('vimeo.com','player.vimeo.com/video',$link);

        }else{

            return "Invalid Video";

        }


     }

     /**
      *  get slug
      */

      protected function getSlug($slug_data){

        return str_replace(' ','-',$slug_data);
      }
}
