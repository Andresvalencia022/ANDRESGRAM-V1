<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use HasFactory;

    //$fillable es la informacion que se va a llenar en la base de datos (es una  forma de porteger la BD)
    //es lo que prosesa antes de mandarlo a la bd
    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];
   //relacion inversa de uno a muchos
    public function user()
    {                        //Model
        return $this->belongsTo(User::class)->select(['name','username']);
    }

    //Relacion de uno a muschos
    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

   //Relacion de uno a muschos
    public function likes(){ //un post puede tener muchos likes
        return $this->hasMany(Like::class);
    }

    //para validar si el usuario ya le dio likes al post
    public function checklike(User $user){
                 //este funcion likes es el de aribita de checklike
               //accede
       return $this->likes->contains('user_id', $user->id);// comprueba si contiene cierto valor dado o no
    }
}
