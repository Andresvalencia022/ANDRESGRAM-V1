<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{

    public function __construct()
    {
     //lo protegemos con un middleware y le pasamos la autenticacion (auth)
     $this->middleware('auth');
    }

    public function index(){

        return View('auth.editarperfil');
    }
    public function store(Request $request){

        //modificar el request
        $request->request->add(['username' => Str::slug($request->username) ]);
          //validar (como un especie de required)
          $this->validate($request,[
            //El dato      //Cuale son sus reglas que va a tener el campo del from
            // (unique:users,username)-> quiere decir que si uno quiere validar y enviar el usuaro que tenia (el mismo username con el mismo id)
               'username' =>  ['required', 'unique:users,username,'.auth()->user()->id, 'min:3', 'max:20'],
            ]);


// //estamos validando la imagen
      if($request->imagen){
        $imagen =$request->file('imagen');
        //(Str::uuid()) lo que hace es generar un id unico a las imagenes
        $nombreImagen = Str::uuid() . "." . $imagen->extension();
                        //este nos deja crear una imagen de intervencion image (abrir un archivo de imagen)
        $imagenservidor = Image::make($imagen);
        $imagenservidor->fit(1000, 1000);//que la imagen va ser 1000x1000 la va a cortar a ese tamaño

        $imagenPath = public_path('FotoPerfil') . '/' .  $nombreImagen;// esto va a apuntar a una carpeta public donde vamos a guardar la imagen
        $imagenservidor->save($imagenPath); //para guardar  con la ruta
      }
      //guardar cambios
          //esto va buscar el usuario id actual que va modificar la informacion
      $usuario = User::find(auth()->user()->id);
      $usuario->username = $request->username;
                         //en lombre de la imagen o vacio
      $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? ''; //quiere decir que si no hay una imagen entonces aplicale vacio o null
      $usuario->save(); //guarda en la base de datos

      //redirecciona
      return redirect()->route('index.post', $usuario->username);
    }
}
