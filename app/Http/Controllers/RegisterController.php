<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth/register');
    }

    public function store(Request $request)
    {
        //dd($request->get('name')); #Para obtener un valor en especifico del formulario

        //dd($request->request); #Para mandar todo el formulario

        #Modificar el request
        $request->request->add(['username' => Str::slug($request->username)]);

        # Validacion
        $request->validate([
            'name' => 'required|min:5',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6'
        ]);

        //dd('Creando usuario');

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        #Metodo 1 autenticar usuario
        /* auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ]); */

        #Metodo 2 autenticar usuario
        auth()->attempt($request->only('email', 'password'));

        #Redireccionar los datos
        return redirect()->route('post.index');
    }
}
