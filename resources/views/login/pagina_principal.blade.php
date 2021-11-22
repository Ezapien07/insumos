@extends('layout.layout')

@section('contenido')
<div class="card">        
    <img class="card-img" src="{{asset('assets/images/p.jpg')}}" alt="Card image cap"  height="290">
    <div class="card-body">
    </br>
        <h1 class="card-title text-center">Bienvenido a Pastelería "La Luz"</h1></br>
        <h3 class="card-text mb-2 text-center">“Son tres las cosas que le diría a un equipo para ayudarlo a mantenerse unido: Cuando algo resulta mal: yo lo hice. Cuando algo resulta más o menos bien: nosotros lo hicimos. Cuando algo resulta realmente bien: ustedes lo hicieron.”</h3>
        </br>
        <div class="row">
            <div class="col-md-4">
                <div class="card card-outline-success">
                    <div class="card-header">
                        <h2 class="m-b-0 text-white text-center">Misión</h2>
                    </div>
                    <div class="card-body">
                        <h5 class="card-subtitle text-justify">Deleitar los sentidos de nuestros clientes a través de diversos productos de primera calidad en Panadería y Pastelería. Logrando un balance armónico entre nuestros productos en relación a sus precios, plazas, promociones, personal y la pasión por el servicio, motivados por una mejora continua.</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-outline-success">
                    <div class="card-header">
                        <h2 class="m-b-0 text-white text-center">Visión</h2>
                    </div>
                    <div class="card-body">
                        <h5 class="card-subtitle text-justify">Mantener el liderazgo en la elaboración de pan y pasteles artesanales, hechos al momento, en México.</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-outline-success">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white text-center">Valores</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="card-subtitle text-justify">Nuestros valores definen como son nuestros productos.</h5>
                        <ul>
                            <li type="circle">Esperanza.</li>
                            <li type="circle">Honestidad.</li>
                            <li type="circle">Respeto.</li>
                            <li type="circle">Calidad óptima.</li>
                            <li type="circle">Compromiso social.</li>
                            <li type="circle">Liderazgo.</li>
                            <li type="circle">Justicia.</li>
                            <li type="circle">Libertad.</li>
                            <li type="circle">Tolerancia.</li>
                            <li type="circle">Trabajo en equipo.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection