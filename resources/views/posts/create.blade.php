@extends('layouts.app')

@section('titulos','Crear nueva publicacion')


@push('styles')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('contenido')

<div class="md:flex md:items-center">
    <div class="md:w-1/2 px-10">
        {{-- agregando dropzone , se le puede colocar esto al form(action="/IMAGEN") pero lo vamos hacer desde un controlador--}}

        <form action="{{ route('img')}}"  method="POST" id="dropzone" enctype="multipart/form-data"
         class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
         @csrf
        </form>

    </div>
    <div class="md:w-1/2 p-10 bg-white rounded-lg shadow-xl">
     <form action="{{ route('postStore') }}" method="POST" novalidate>
        @csrf{{-- {{ csrf_field() }}<!--Proteccion contra ataques csrf por eso es inportante colocarlos en los fromularios--> --}}

        @if(session('mensaje'))
        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ session('mensaje') }}</p>
        @endif

      <div class="md-5">
        <label class="md-2 block uppercase text-gray-500 font-bold" for="titulo">Titulo</label>
        <input id="titulo" name="titulo" placeholder="TITULO DE LA PUBLICACIÓN"
         class="appearance-none block w-full bg-gray-50  border border-green-500 rounded  py-3 px-4 mb-3
          leading-tight focus:outline-none focus:bg-white @error('titulo') border-red-600  @enderror" value="{{ old('titulo') }}">
         @error('titulo')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
         @enderror
        </div>
        <div class="md-5">
            <label class="md-2 block uppercase text-gray-500 font-bold" for="descripcion">DESCRIPCION</label>
            <textarea id="descripcion" name="descripcion" type="text" placeholder="DESCRIPCION DE LA PUBLICACIÓN"
             class="appearance-none block w-full bg-gray-50  border border-green-500 rounded  py-3 px-4 mb-3
              leading-tight focus:outline-none focus:bg-white @error('descripcion') border-red-600  @enderror">{{ old('descripcion') }}</textarea>
             @error('descripcion')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
             @enderror
            </div>

            <div class="md-5">
            <input  name="imagen" type="hidden" value="{{ old('imagen') }}">
            @error('imagen')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
            @enderror
            </div>

            <input type="submit" value="Crea cuenta"image.pngimage.png
            class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-whit  rounded-lg">

        </form>
    </div>
</div>
@endsection
