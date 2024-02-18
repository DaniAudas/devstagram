@extends('layouts.app')

@section('titulo')
    Inicia sesión en DevStagram
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-10">
        <div class="md:w-6/12">
            <img src="{{asset('img/login.jpg')}}" alt="Imagen Registrate">
        </div>
        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <form method="post" action="{{route('login')}}">
                @csrf
                @if (session('mensaje'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{session('mensaje')}}
                    </p>
                @endif
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
                    <input type="email" id="email" name="email" placeholder="Tu email aqui" class="border p-3 w-full rounded-lg @error('email')
                        border border-red-500
                    @enderror"
                    value="{{old('email')}}">
                    @error('email')
                        <p class="bg-red-700 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="pass" class="mb-2 block uppercase text-gray-500 font-bold">Password</label>
                    <input type="password" id="password" name="password" placeholder="Tu password aqui" class="border p-3 w-full rounded-lg @error('password')
                        border border-red-500
                    @enderror">
                    @error('password')
                        <p class="bg-red-700 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <input type="checkbox" name="remember"> <label for="" class="text-gray-500 text-sm">Mantener mi sessión abierta</label> 
                </div>
                <input type="submit" value="Inisiar sesión" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection