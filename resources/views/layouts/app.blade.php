<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- lo que hace es reservar para agregar hojas de estilo que sean diferentes y que se requiera entodas las vistas --}}
     @stack('styles')
     @livewireStyles()
     @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>ANDRESGRAM - @yield('titulos')</title>
</head>
<body class="bg-gray-200">
    <header class="p-5 border-b bg-white shadow">
        <div class="container mx-auto flex justify-between items-center" >
            <a href="{{ route('home') }}">
            <h1 class="text-3xl font-black">ANDRESGRAM</h1>
            </a>
            {{-- para saber si tenemos iniciado sesion de usu (Autenticar el usuario)--}}
            {{-- @if(auth()->user())
                <p>Autenticado</p>
            @else
                <p>No Autenticado</p>
            @endif --}}
            {{-- otra forma de autenticar en laravel --}}
            @auth {{-- Si esta autenticado --}}
            <nav class=" flex gap-2 items-center " >
                <a  class=" flex items-center gap-2 bg-white border p-2 text-gray-600 rounded text-sm
                 uppercase font-bold cursor-poiter" href="{{ route('post.create') }}">
                 <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4 5a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V7a2 2 0 00-2-2h-1.586a1 1 0 01-.707-.293l-1.121-1.121A2 2 0 0011.172 3H8.828a2 2 0 00-1.414.586L6.293 4.707A1 1 0 015.586 5H4zm6 9a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                  </svg>
                 Crear</a>

                <a class="font-bold  text-gray-600 text-sm" href="{{ route('index.post', auth()->user()->username ) }}">
                    Hola: <span>{{ auth()->user()->username }}</span>
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf <!--para evitar cualquier tipo de ataques-->
                <button type="submit" class="font-bold uppercase text-gray-600 text-sm">Cerrar Cuenta</button>
                </form>
            </nav>
            @endauth
            @guest {{-- No esta autenticado --}}
            <nav class=" flex gap-2 items-center " >
                <a class="font-bold uppercase text-gray-600 text-sm" href="{{ asset('login') }}">Login</a>
                <a class="font-bold uppercase text-gray-600 text-sm" href="{{ asset('crear_cuenta') }}">Crear Cuenta</a>
            </nav>
            @endguest

        </div>
    </header>
    <main  class="container mx-auto mt-10">
        <h2 class="font-black text-center text-3xl mb-10"> @yield('titulos') </h2>
        @yield('contenido')
   </main>

   <footer class="text-center p-5 text-gray-500 font-bold ">
    ANDRESGRAM - Todos los derechos reservados {{ now()->year }}
   </footer>

</body>
@livewireScripts()

</html>
