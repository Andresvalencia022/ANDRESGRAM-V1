<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegistrarController;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/',HomeController::class)->name('home'); //lo utilizo asi porque solo vamos a tener un solo metodo en el controlador Home

Route::get('/crear_cuenta', [ RegistrarController::class, 'registrar']  );
Route::post('/crear_cuenta', [RegistrarController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

//Rutas para el perfil
Route::get('/editar_perfil', [PerfilController::class, 'index'])->name('indexPerfil');
Route::post('/editar_perfil', [PerfilController::class, 'store'])->name('EditarPefil'); //Mandar los datos


//Para crear una foto
Route::get('/post/create',[PostController::class, 'create'])->name('post.create');//para mandar a la pagina publicacion
Route::post('/posts',[PostController::class, 'store'])->name('postStore'); //para guardar los datos
Route::get('/{user:username}/posts/{post}',[PostController::class, 'show'])->name('post_show');

//ruta de los comentarios para enviar
Route::post('/{user:username}/posts/{post}',[ComentarioController::class, 'store'])->name('comentariosStore');
//Eliminar post
Route::delete('/post/{post}',[PostController::class, 'destroy'])->name('destry_post');

Route::post('/imagenes',[ImagenController::class, 'store'])->name('img'); //para almacenar la imagen

//Dar likes a las fotos
Route::post('/posts/{post}/likes',[LikeController::class, 'store'])->name('PostLikes');
//Quitar like (Eliminar like)
Route::delete('/posts/{post}/likes',[LikeController::class, 'destroy'])->name('PostLikesDestroy');

    //para colocar el nombre del perfil en la url
    // la class user y hacedemos al nombre
Route::get('/{user:username}', [PostController::class, 'index'])->name('index.post');


// seguiendo a usuario (Follower)
Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('follow');
// dejar de seguir a usuario
Route::delete('/{user:username}/Unfollower', [FollowerController::class, 'destroy'])->name('Unfollower');

