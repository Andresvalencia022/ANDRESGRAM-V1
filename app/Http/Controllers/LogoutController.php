<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function logout(){
// -> auth() es un helper que revisa si estan auntenticado el usuario, esto se comporta como un $_Session['sesion']
        auth()->logout(); //el logout(); sirve para cerrar sesion
        return redirect()->route('login');
    }
}
