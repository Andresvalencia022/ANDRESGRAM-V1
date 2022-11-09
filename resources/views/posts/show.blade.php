@extends('layouts.app')

@section('titulos')
{{ $post->titulo }}
@endsection

@section('contenido')
<div class="container mx-autor md:flex">
    <div class="md:w-1/2">
        <img src="{{ asset('Uploads').'/'. $post->imagen}}" alt="Imagenes de POST {{ $post->titulo }}">
        <div class="p-3 flex items-center gap-2">
           @auth <!--Autenticar si esta registrado-->


           {{-- @livewire('like-post') --}}
        <!--por medio del $post accedo al metodo checklike que se encuentra en modelo Post -->
           @if ($post->checklike(auth()->user()))<!-- esta condicion se utiliza para detectar si el usuario dio o no dio like-->
          {{-- En esta condicion va aliminar el like, ya que este usuario ya le habia dado. entonce lo va a eliminar--}}
           <form action="{{ route('PostLikesDestroy', $post) }}" method="POST">
            @method('DELETE')<!--para poder haceder al metodo delete y poder eliminar-->
            @csrf
            <div class="my-4">
              <button type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="red" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
               <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
               </svg>
              </button>
            </div>
          </form>

           @else <!--esta condicion solo le va aparecer a los que no le han dado likes post-->
             {{-- En esta condicion le va dar like ya que este no lo tenia--}}
            <form action="{{ route('PostLikes', $post) }}" method="POST">
             @csrf
             <div class="my-4">
                 <button type="submit">
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="White" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                         <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                     </svg>
                 </button>
             </div>
         </form>
           @endif
        @endauth
              {{-- va contar los likes que tenga el post --}}

            <p class="font-bold">{{ $post->likes->count() }} <span class="font-bold">likes</span> </p>
        </div>

        <div> {{-- accedo a la relacion inversa user --}}
            <p class="font-bold">{{ $post->user->username }}</p>
            {{-- (created_at) es el campo de la bd, la fecha en la que se creo el post --}}
            <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
            <!--diffForHumans()  es una libreria de la api Carbon que viene integrado con laravel-->
            <p>{{ $post->descripcion }}</p>
        </div>
        @auth <!--para auntenticar los que son usuario-->
         @if ($post->user_id === auth()->user()->id) <!--para autenticar // esta opcion de eliminar solo la puede ver la persona que pueblico el post -->
        <form  method="POST" action="{{ route('destry_post', $post ) }}">
            @csrf
            {{-- El navegador solo soporta POST Y GET pero el Method spoofi nos deja agregar otro tipo de peticiones como DELETE --}}
            @method('DELETE')
            <input type="submit" value="Eliminar Post"
                class="bg-red-600 hover:bg-red-700 p-2  text-center rounded w-32 text-white font-bold mt-4 cursor-pointer">
        </form>
        @endif
        @endauth
    </div>
    <div class="md:w-1/2 p-5">
        <div class="shadow bg-white p-5 mb-5">
            {{-- este helper te deja ver el parrafo y el from para comentar, si esta autenticado con un usuario--}}
            @auth

            <p class="text-xl font-bold text-center md-4 p-3">Agrega un nuevo comentario</p>

            @if(session('mensaje'))
            <!--si la sesion existe, muentrame este mensaje-->
            <div class=" bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                {{ session('mensaje') }}
                <!--Alerta de que si se guardo el comentario-->
            </div>
            @endif

            <form action="{{  route('comentariosStore',['user'=>$user, 'post'=>$post] ) }}" method="POST">
                @csrf
                <label class="md-2 block uppercase text-gray-500 font-bold" for="comentario">Comentario</label>
                <textarea id="comentario" name="comentario" type="text" placeholder="COMENTARIO"
                    class="appearance-none block w-full bg-gray-50  border border-green-500 rounded  py-3 px-4 mb-3
               leading-tight focus:outline-none focus:bg-white @error('comentario') border-red-600  @enderror"></textarea>
                @error('comentario')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror

                <input type="submit" value="Crea cuenta"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-whit  rounded-lg">

            </form>
            @endauth
            <div class=" bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">
                {{-- la relacion (funcion comentarios en la clases post ) --}}
                @if($post->comentarios->count())
                <!--me cuenta que si hay mas de 1 me muestra los comentarios si no, muestra otro-->
                @foreach ($post->comentarios as $comentarios)
                <div class="p-5 border-gray-300   border-b ">
                    {{-- alguien le da click al no,bre de usu y lo lleva as su muro --}}
                    <a href="{{ route('index.post', $comentarios->user) }}" class="font-bold">
                        {{ $comentarios->user->username }}
                        <!--user es de la relacion inversa para despues acceder a username de la bd-->
                    </a>
                    <p>{{ $comentarios->comentario}}</p>
                    <!--Comentarios-->
                    <p class="text-sm text-gray-500">{{ $comentarios->created_at->diffForHumans() }}</p>
                    <!--Fecha, cuando se comento-->
                </div>
                @endforeach
                @else
                <p class="p-10 text-center">No hay comentarios aun</p>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
