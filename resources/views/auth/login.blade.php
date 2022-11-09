@extends('layouts.app')

@section('titulos','Iniciar Sesion')

@section('contenido')
<div class="md:flex md:justify-center md:gap-10 md:items-center">
    <div class="md:w-6/12 p-3">
        <img src="{{ asset('img/login.jpg') }}" alt="Registrate">
    </div>
    <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">

     <form action="{{ route('login') }}" method="POST" novalidate>
        @csrf{{-- {{ csrf_field() }}<!--Proteccion contra ataques csrf por eso es inportante colocarlos en los fromularios--> --}}

        @if(session('mensaje'))
        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ session('mensaje') }}</p>
        @endif


      <div class="md-5">
        <label class="md-2 block uppercase text-gray-500 font-bold" for="email">Correo</label>
        <input id="email" name="email" type="email" placeholder="CORREO"
         class="appearance-none block w-full bg-gray-50  border border-green-500 rounded  py-3 px-4 mb-3
          leading-tight focus:outline-none focus:bg-white @error('email') border-red-600  @enderror" value="{{ old('email') }}">
         @error('email')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
         @enderror
        </div>
      <div class="md-5">
        <label class="md-2 block uppercase text-gray-500 font-bold" for="Password">Password</label>
        <input id="Password" name="password" type="Password" placeholder="PASSWORD"
         class="appearance-none block w-full bg-gray-50  border border-green-500 rounded  py-3 px-4 mb-3
         leading-tight focus:outline-none focus:bg-white @error('password') border-red-600  @enderror" value="{{ old('password') }}">
         @error('password')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
         @enderror
        </div>
        <div class="mb-5">
            <!--para mantener la sesion abierta-->
          <input  type="checkbox" name="remember"> <label class=" text-gray-500 text-sm">Mantener mi sesión abierta</label>
        </div>


      <input type="submit" value="Crea cuenta"image.pngimage.png
      class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-whit  rounded-lg">
     </form>
    </div>
 </div>
@endsection
