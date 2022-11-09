<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View as ViewView;

class PostController extends Controller
{
   //autenticar que el usuario, esta autenticado
   //no nos deja haceder a las paginas si no es el usuario original
   public function __construct()
   {
    //lo protegemos con un middleware y le pasamos la autenticacion (auth)
    $this->middleware('auth')->except(['show','index' ]); //todas las paginas estan protegidas excepto show, index ->(metodos o funciones)
   }

                        //creamos el parametro que llega de modelo User y que se llama $user
    public function index(User $user){
        // dd(auth()->user()); //para ver si tenesmo creado el ususar, se comporta igual a un session en php
                    //me hace una consulta en la bd (que donde el user_id  es igual a user->id que le estamos mandando a la pagina)

         $post = Post::where('user_id',$user->id)
         ->latest()
         ->paginate(12); //paginar (filtrar los post)
        // ->get()//get es para hacer las consultas
        // ->simplePaginate(4); //esta es otra forma de paginar


        return view('dashboard',[
            'user'=> $user,  //le pasamos un arreglo a la vista deshboard
            'post'=> $post //le mandamos la variable a la vista
        ]);

    }

    public function create(){
       return View('posts.create');
    }

    public function store(Request $request){
//validar (como un especie de required)
$this->validate($request,[
    //El dato      //Cuale son sus reglas que va a tener el campo del from
       'titulo' =>  'required|max:255',
       'descripcion' =>  'required',
       'imagen' =>  'required',
    ]);
//agregar datos
//agregando los datos a la base de datos
// Post::create([
//     'titulo' => $request->titulo,
//     'descripcion' => $request->descripcion,
//     'imagen' => $request->imagen,
//     'user_id' =>auth()->user()->id,
// ]);

//agregar datos
//otra forma de agregar datos a  la base de datos
// $post = new Post;
// $post->titulo = $request->titulo;
// $post->descripcion = $request->descripcion;
// $post->imagen = $request->imagen;
// $post->user_id = auth()->user()->id;
// $post->save(); //guardar

//Otra forma de guardar
//rectifica el usuario, hacede al la clase user donde esta la funcion posts y crea los datos
$request->user()-> posts()->create([
    'titulo' => $request->titulo,
    'descripcion' => $request->descripcion,
    'imagen' => $request->imagen,
    'user_id' =>auth()->user()->id,
]);


return redirect()->route('index.post',auth()->user()->username);

}
                      //se pasa el parameto  de la ruta al funcion show y este Post se asosia al modelo Post
public function show ( User $user, Post $post){

    return View('posts/show',[
       'post' => $post,
       'user' =>$user
    ]);
}

public function destroy(Post $post){
    //mejorar este codigo hacemos un policy en consola
     //nos retorna en caso de que sea true o false
    $this->authorize('delete', $post);
    $post->delete(); //esto elimina el post de la bd (imagen)

    //Eliminar la imagen de la carpeta Uploads, es decir, elimina  la img del servidor
     $Imagen_path = public_path('Uploads/' .  $post->imagen);

     if (File::exists($Imagen_path)) {
        unlink($Imagen_path); //unlink es una funcion de php  que sirve para eliminar un archivo
     }

                                            //le mandamos el nombre de usuario para que me lo coloque en la url
    return redirect()->route('index.post', auth()->user()->username);
}
}
