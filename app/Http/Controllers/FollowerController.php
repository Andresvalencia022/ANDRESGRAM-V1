<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    //Guardar los seguidores (Es decir seguir)
    public function store(Request $request,User $user){

    //la relacion attach sirve para guardar pero se utiliza mucho en relacion de muchos a muchos
    $user->followers()->attach( auth()->user()->id );
    //que quiere decir esto?(el usuario del perfil va guardar el usuario que le dio seguir, es decir, el usuario autenticado que entro a nuestro perfil y le dio seguir, lo guarda )

    return back();
    }

    //Eliminar los seguidores (Es decir, dejar de seguir)
    public function destroy(Request $request, User $user){
        //la relacion detach sirve para eliminar, pero se utiliza mucho en relacion de muchos a muchos
        $user->followers()->detach( auth()->user()->id );
        //que quiere decir esto?(el usuario del perfil va guardar el usuario que le dio seguir, es decir, el usuario autenticado que entro a nuestro perfil y le dio seguir, lo guarda )

        return back();
        }



}
