<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function store(Request $request, User $user, Post $post){

        //validar
       $this->validate($request,[
        //El dato      //Cuale son sus reglas que va a tener el campo del from
           'comentario' =>  'required|max:255',
       ]);

        //Almacenar el resultado
//agregando los datos a la base de datos
Comentario::create([
    'user_id' => auth()->user()->id, //el usuario autenticado puede comentar
    'post_id' => $post->id,
    'comentario' => $request->comentario
]);
        //imprimir un mensaje
        // back()->with quiere decir que regrese a la pagina anterior y que eme envie estos datos
        return back()->with('mensaje','Comentario realizado Correctamente'); //with se imprime como sessiones

    }
}
