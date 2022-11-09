@extends('layouts.app')

@section('titulos')
Editar perfil: {{ auth()->user()->username }}
@endsection

@section('contenido')
<div class="md:flex md:justify-center">
<div class="md:w-1/2 bg-white shadow p-6 ">
<form action="{{ route('EditarPefil') }}" method="POST" enctype="multipart/form-data" class="mt-10 md:mt-0">
@csrf
<div class="md-5">
    <label class="md-2 block uppercase text-gray-500 font-bold" for="username">Nombre de usuario</label>
    <input id="username" name="username" type="text" placeholder="TU NOMBRE DE USUARIO"
     class="appearance-none block w-full bg-gray-50  border border-green-500 rounded py-3 px-4 mb-3
     leading-tight focus:outline-none focus:bg-white @error('nomusu') border-red-600  @enderror"  value="{{ auth()->user()->username}}">
    @error('username')
        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
    @enderror
</div>

<div class="md-5">
    <label class="md-2 block uppercase text-gray-500 font-bold" for="imagen">Imagen de perfil</label>
    <input id="imagen" name="imagen" type="file" accept=".jpg, png, jpeg"
     class="appearance-none block w-full bg-gray-50  border border-green-500 rounded py-3 px-4 mb-3
     leading-tight focus:outline-none focus:bg-white ">
</div>


<input type="submit" value="Crea cuenta"
class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-whit  rounded-lg">


</form>
</div>
</div>
@endsection

