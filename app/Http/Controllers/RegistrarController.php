<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegistrarController extends Controller
{

 public function registrar () {
     return view('auth.registrar');
    }

    public function store (Request $request) {
        // dd($request);
        // dd($request->get('nombre')); //me muestra el nombre

         //modificar el request
         $request->request->add(['username' => Str::slug($request->username) ]);

        //validar (como un especie de required)
        $this->validate($request,[
        //El dato      //Cuale son sus reglas que va a tener el campo del from
           'nom' =>  'required|min:5',
           'username' =>  'required|unique:users|min:3|max:20',
           'email' =>  'required|unique:users|email|max:60',
           'password' =>  'required|confirmed|min:7' //larave automaticamnete nos valida si password es igual al otro campo password

        ]);

//(Models->user)
            // Create equivale al innser into para añadir
        User::create([

            'name' => $request->nom,  //(nom) hace referencia a los datos que estoy mandando por el form
            'username'=> Str::lower($request->username), //Str::lower convierte la cadena dada a minúsculas
            'email'=>$request->email,
            'password'=> Hash::make($request->password)
            // Puede codificar una contraseña llamando al make método en la Hash fachada (incripta)
        ]);


    // auth()->autenticar usuario
    // attempt()->esto quiere decir intentar, intentar autenticar un usuario, en este caso email y password

    // auth()->attempt([ //lo que hace es extraer email, password y lo guarda en una memoria aparte como lo hace $_SESSIOM EN PHP
        //     'email' => $request->email,
        //     'password' =>$request->password
        // ]);

        //Otra forma de autenticar el usuario}
        // auth()->attempt-lo que hace es extraer email, password y lo guarda en una memoria aparte
        auth()->attempt($request->only('email','password'));

        //  Redireccionar
        return redirect()->route('login');

       }
}
