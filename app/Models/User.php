<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'username',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relacion de uno a muchos
    public function posts()
    {                        //Model
        return $this->hasMany(Post::class);
    }

    // Relacion de uno a muchos
    public function likes(){
        return $this->hasMany(Like::class);
    }

 //almacenar los seguidores del usuario
 public function followers()
 {
                  //Va a guardar en la tabla followers
  return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id'); //el usuario 1 puede seguir a multiples usuario como 2 ,3, 4, 5, 6, 7
 }
 //almacenar los que seguimos
 public function following()
 {
                  //Va a guardar en la tabla followers
  return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id'); //el usuario 1 puede seguir a multiples usuario como 2 ,3, 4, 5, 6, 7
 }

  //Comprobar si un usuario esta siguiendo al usuario del perfil
  public function comprobando(User $user)
  {
   return $this->followers->contains( $user->id );
  }


}
