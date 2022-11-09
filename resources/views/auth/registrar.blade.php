@extends('layouts.app')

@section('titulos','Registrar')

@section('contenido')
 <div class="md:flex md:justify-center md:gap-10 md:items-center">
    <div class="md:w-6/12 p-3">
        <img src="{{ asset('img/registrar.jpg') }}" alt="Registrate">
    </div>
    <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">

     <form action="/crear_cuenta" method="POST">
        @csrf{{-- {{ csrf_field() }}<!--Proteccion contra ataques csrf por eso es inportante colocarlos en los fromularios--> --}}
      <div class="md-5">
        <label class="md-2 block uppercase text-gray-500 font-bold" for="nom">Nombre</label>
        <input id="nom" name="nom" type="text" placeholder="TU NOMBRE"
         class="appearance-none block w-full bg-gray-50  border border-green-500 rounded py-3 px-4 mb-3
         leading-tight focus:outline-none focus:bg-white @error('nom') border-red-600  @enderror"  value="{{ old('nom') }}">
        @error('nom')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
        @enderror
    </div>

      <div class="md-5">
        <label class="md-2 block uppercase text-gray-500 font-bold" for="Username">Nombre de ususario</label>
        <input id="Username" name="username" type="text" placeholder="NOMBRE DE USUARIO"
         class="appearance-none block w-full bg-gray-50  border border-green-500 rounded  py-3 px-4 mb-3
          leading-tight focus:outline-none focus:bg-white @error('username') border-red-600  @enderror" value="{{ old('username') }}">
         @error('username')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
         @enderror
        </div>

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
        <input id="Password" name="password" type="password" placeholder="PASSWORD"
         class="appearance-none block w-full bg-gray-50  border border-green-500 rounded  py-3 px-4 mb-3
         leading-tight focus:outline-none focus:bg-white @error('password') border-red-600  @enderror" value="{{ old('password') }}">
         @error('password')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
         @enderror
        </div>
      <div class="md-5">
        <label class="md-2 block uppercase text-gray-500 font-bold" for="password_confirmation">Repetir Password</label>
        <input id="password_confirmation" name="password_confirmation" type="password" placeholder="REPETIR PASSWORD"
         class="appearance-none block w-full bg-gray-50  border border-green-500 rounded  py-3 px-4 mb-3
         leading-tight focus:outline-none focus:bg-white">
      </div>

      <input type="submit" value="Guardar cambios"
      class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-whit  rounded-lg">

     </form>
    </div>
 </div>
@endsection
