<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); //para ver si el usuario este autenticado
        //si no esta autenticado no me mostrara el home
    }



    public function __invoke()
    {
        //obtenemos a quienes seguimos
        // pluck('id') queire decir que, solo me va a traer los id de la tabla
        //toArray()me los convierte en un arreglo
        $id = auth()->user()->following->pluck('id')->toArray();

        $post = Post::whereIn('user_id', $id)->latest()->paginate(20);//->latest ordena d
        /*whereIn() se usa para verificar si la columna contiene
        un valor de la matriz o lista. Básicamente, se utiliza para
        hacer coincidir la columna con la lista de valores*/

     return View('index',[
        'post' => $post
     ]);
    }
}
