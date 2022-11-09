<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;



class ImagenController extends Controller
{
    public function store(Request $request){

        $imagen =$request->file('file');
        //(Str::uuid()) lo que hace es generar un id unico a las imagenes
        $nombreImagen = Str::uuid() . "." . $imagen->extension();
                        //este nos deja crear una imagen de intervencion image (abrir un archivo de imagen)
        $imagenservidor = Image::make($imagen);
        $imagenservidor->fit(1000, 1000);//que la imagen va ser 1000x1000 la va a cortar a ese tamaño

        $imagenPath = public_path('Uploads') . '/' .  $nombreImagen;// esto va a apuntar a una carpeta public donde vamos a guardar la imagen
        $imagenservidor->save($imagenPath); //para guardar  con la ruta
                     //json es un metodo para trasportar
                                     //me muestra la extension,(el tipo de archivo)
        return response()->json(['imagen'=> $nombreImagen ]);
    }
}
