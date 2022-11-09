@extends('layouts.app')

@section('titulos')
PERFIL: {{ $user->username }}
@endsection

@section('contenido')
 <div class="flex justify-center">
    <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row ">
       <div class=" w-8/12 lg:w-6/12 px-5  ">
                      {{-- Estoy haciendo una condicion ternaria --}}
         <img class="rounded-full" src="{{ $user->imagen ? asset('FotoPerfil'.'/'.$user->imagen) : asset('img/usu3.png') }}" alt="img-usuario">
       </div>
       <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10 ">
       <div class="flex items-center gap-2">
        <p class="text-gray-700 text-4xl">{{ $user->username }}</p>
        @auth
          {{-- si este usuario es igual al usuario que esta autenticado --}}
            @if ($user->id === auth()->user()->id)
                <a href="{{ route('indexPerfil') }}" class="text-gray-700 hover:text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                      </svg>
                </a>
            @endif
        @endauth
      </div>
        <hr>
        <p class="text-gray-800 text-sm mb-3 font-bold mt-5">
           {{ $user->followers->count() }}
            <span class="font-normal">  @choice('Seguidor|Seguidores', $user->followers->count()) </span>
            {{-- @choice es un diccionario  qque quiere decir que en base a la cantidad que haya elige
              Seguidor|Seguidores segun sea necesario, laravel detecta automanticamente--}}
        </p>
        <p class="text-gray-800 text-sm mb-3 font-bold">
            {{ $user->following->count() }}
            <span class="font-normal">Seguido </span>
         </p>
         <p class="text-gray-800 text-sm mb-3 font-bold">
            {{-- Entra al metodo posts del modelo user --}}
            {{ $user->posts->count() }}
             <span class="font-normal">Post</span>
         </p>
         @auth
         @if ($user->id !== auth()->user()->id)



         {{-- @if($user->comprobando( auth()->user() )) <!--comprueva si el usuario autenticado ya excite--> --}}

         {{-- lo que estamos haciendo es negar esta condicion --}}
         @if (!$user->comprobando( auth()->user() )) <!--esta persona no es seguidor, entonces mutrame esto-->
         <form  method="POST" action="{{ route('follow', $user )}}" >
            @csrf
            <input type="submit" value="Seguir" class="bg-blue-600 text-white uppercase
            rounded-lg  px-3 py-1 text-xs font-bold cursor-pointer">
        </form>
         @else <!--esta persona es seguidor, entonces mutrame esto-->
         <form method="POST" action="{{ route('Unfollower', $user )}}">
            @method('DELETE')
            @csrf
            <input type="submit" value="Dejar de seguir" class="bg-red-600 text-white uppercase
            rounded-lg  px-3 py-1 text-xs font-bold cursor-pointer">
         </form>
         @endif
         @endif
         @endauth
       </div>
    </div>
 </div>
 <section class="container mx-auto mt-10">
 <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>
    {{-- el user se lo pasamos como un arreglo desde PostController --}}
           {{-- (posts) es la funcion que estan en la modelo  --}}
   {{-- {{ dd( $user->posts ) }} <!--//para filtrar los post con la paginacion--> --}}

 @if($post->count())<!--Para contar los post(en caso de que sea mayor a 0, me va a mostrar que no hay post )-->
      <dir class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 ">
     @foreach ($post as $posts )


      <div>                            {{--  (automaticamente me coje el id por defecto de la variable $posts) --}}
                  {{-- //estamos mandando multiples valores o datos en un arreglo--}}
         <a href="{{ route('post_show', ['user' => $user, 'post' =>$posts]) }}">
             <!--accede a la carpeta y llamamos el nombre de la imagen para que me la saque de la carpeta-->
             <img src="{{ asset('Uploads').'/'. $posts->imagen}}" alt="Imagenes de POST {{ $posts->titulo }}">
        </a>
        </div>
        @endforeach
    </dir>

    <div class="my-10">
        {{ $post->links('pagination::tailwind') }} <!--para hacer la paginacion-->
    </div>
  @else
    <p class="text-gray-600 uppercase text-sm text-center">No hay Post</p>
  @endif
 </section>

@endsection
