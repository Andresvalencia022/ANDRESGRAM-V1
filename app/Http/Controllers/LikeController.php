<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store (Request $request, Post $post){
         //(likes() es la funcion del modelo en entra a la bd )
        $post->likes()->create([
            'user_id'=> $request->user()->id
        ]);
             //El back nos regresa donde le enviamos la peticion (nos regresa donde estabamos)
        return back();
    }

    public function destroy(Request $request,Post $post){

         //va a tener el usuario actual y despues hacede al metodo likes del modelo User
      $request->user()->likes()->where('post_id', $post->id)->delete(); //lo eliminamos

      return back(); //El back nos regresa donde le enviamos la peticion (nos regresa donde estabamos)
    }
}
