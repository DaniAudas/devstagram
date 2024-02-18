@extends('layouts.app')

@section('titulo')
    Editar Perfil: {{auth()->user()->username}}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            @if (isset($mensaje))
                <div class="p-3 background-red-200">{{$mensaje}}</div>
            @endif
            <form action="{{route('perfil.store')}}" enctype="multipart/form-data" class="mt-10 md:mt-0" method="POST">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Username</label>
                    <input type="text" id="username" name="username" placeholder="Tu nombre de usuario" class="border p-3 w-full rounded-lg @error('username')
                        border border-red-500
                    @enderror"
                    value="{{auth()->user()->username}}">
                    @error('username')
                        <p class="bg-red-700 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Correo</label>
                    <input type="email" id="email" name="email" placeholder="Tu correo" class="border p-3 w-full rounded-lg @error('email')
                        border border-red-500
                    @enderror"
                    value="{{auth()->user()->email}}">
                    @error('email')
                        <p class="bg-red-700 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Password Actuál</label>
                    <input type="password" id="password" name="password" placeholder="Tu password actuál" class="border p-3 w-full rounded-lg @error('password')
                        border border-red-500
                    @enderror"
                    @error('password')
                        <p class="bg-red-700 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password_nuevo" class="mb-2 block uppercase text-gray-500 font-bold">Password nuevo</label>
                    <input type="password" id="password_nuevo" name="password_nuevo" placeholder="Ingresa tu nuevo password" class="border p-3 w-full rounded-lg @error('password_nuevo')
                        border border-red-500
                    @enderror"
                    @error('password_nuevo')
                        <p class="bg-red-700 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">Imagen Perfil</label>
                    <input type="file" id="imagen" name="imagen" accept=".jpg, .png, .jpeg" class="border p-3 w-full rounded-lg">
                </div>
                <input type="submit" value="Guardar cambios" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection