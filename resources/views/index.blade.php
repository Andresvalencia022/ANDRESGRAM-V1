@extends('layouts.app')

@section('titulos','Pagina principal')

@section('contenido')

@if ($post->count())
<dir class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
    @foreach ($post as $posts )
     <div>                            {{--  (automaticamente me coje el id por defecto de la variable $posts) --}}
                 {{-- //estamos mandando multiples valores o datos en un arreglo--}}
        <a href="{{ route('post_show', ['user' => $posts->user, 'post' =>$posts]) }}">
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
   <p class="text-center">No hay posts, sigue a alguien para poder mostrar los post</p>
   @endif
@endsection
