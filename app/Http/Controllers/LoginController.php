<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        // dd(auth()->user()); //para ver si tenesmo creado el ususar, se comporta igual a un session en php

        return view('auth.login');
    }

    public function store(Request $request){
         //validar (como un especie de required)
        // dd($request->remember); //del checkbox

         $this->validate($request,[
            //El dato      //Cuale son sus reglas que va a tener el campo del from
               'email' =>  'required|email',
               'password' =>  'required' //larave automaticamnete nos valida si password es igual al otro campo password

            ]);
                      //lo que esta dentro de if simpre me devuelve true o false
              //lo que hacemos es una negacion
              //en caso de que el usuario no se pueda autenticar
            if(!auth()->attempt($request->only('email','password'),'remember')){
                //(back) quiere decir que regresara a la pagina donde mande los datos
                  return back()->with('mensaje','Credenciales Incorrectas');
            }

            //Me redirecciona a la pagina inicial del ususario
            return redirect()->route('index.post', auth()->user()->username);
                                                //con este auth estamos mandando el  parametro del nombre de usuario  a la url de quien se autentico
    }
}
