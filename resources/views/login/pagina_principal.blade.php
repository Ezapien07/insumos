@extends('layout.layout')

@section('contenido')
<div class="card">        
    <div class="card-body">
        <h1 class="card-header text-center">Bienvenido a GPS RASTREO POR SATELITE</h1></br>
        <!--<h3 class="card-text mb-2 text-center"><code>Tenemos configurados más de 3500 dispositivos GPS, es por eso que tenemos una mejora continua con nuestros clientes comprometiéndonos a tener actualizaciones constantes sobre nuestros productos y servicios permitiéndonos estar a la vanguardia en tecnología ofreciendo un SERVICIO PREMIUM</code></h3>-->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <video src="{{asset('assets/images/gps.mp4')}}" autoplay="" muted="" loop="" width="100%"></video>
                <!--<img src="{{asset('assets/images/background/rastreo.jpg')}}" alt="homepage" class="d-block img-fluid" />-->
            </div>
        </div>
    </div>
</div>
@endsection