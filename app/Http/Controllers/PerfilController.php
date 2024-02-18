<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PerfilController extends Controller
{
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        $request->request->add(['username' => Str::slug($request->username)]);
        $this->validate($request, [
            # A partir de 3 reglas de validación se recomienda poner en un arreglo
            'username' => ['required','unique:users,username,'.auth()->user()->id,'min:3','max:20','not_in:twitter,editar-perfil'],
            'email' => ['email','required','unique:users,email,'.auth()->user()->id, 'min:6', 'max:15'],
            'password' => 'min:6'
        ]);

        if($request->imagen){
            $imagen = $request->file('imagen');

            $nombreImagen = Str::uuid().".".$imagen->extension();

            $imagenServidor = Image::make($imagen);

            $imagenServidor->fit(1000,1000);

            $imagenPath = public_path('perfiles').'/'.$nombreImagen;

            $imagenServidor->save($imagenPath);
        }

        //if($request->password)
        
        if(!auth()->attempt($request->only('email','password'))){
            dd("Error de autenticación");
            return back()->with('mensaje', 'Credenciales Incorrectas');
        }

        # Guardar cambios
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? NULL;
        $usuario->password = Hash::make($request->password_nuevo);
        $usuario->save();

        # Redireccionar
        return redirect()->route('post.index', $usuario->username);
    }

    public function QRcode()
    {
        // Configura el contenido del código QR
        $content = 'https://verbumdeipuebla.org/inscripciones';

        // Generar el código QR
        $qrCode = QRcode::size(200)->generate($content);

        // Devuelve la vista del QR
        return view('qr_code', compact('qrCode'));
    }
}
