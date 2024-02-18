@extends('layouts.app')

@section('titulo')
    Codigo QR
@endsection

@section('contenido')
    <div class="bg-color">
        <!--{{QrCode::size(200)->color(38, 131, 95)->backgroundColor(255,255,0)->margin(2)->generate(url('https://verbumdeipuebla.org/inscripciones'));}}-->
        
        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->merge('img/logo.png', .4, true)->size(200)->color(71, 85, 105)->margin(2)->errorCorrection('H')->generate('https://verbumdeipuebla.org/inscripciones')) !!} ">
    </div>
@endsection