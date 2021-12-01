@extends('layout.layout')

@section('contenido')

<div class="card">
    <div class="card-body">
        <h2 class="card-title">Reporte de préstamos</h2> 
        <p class="card-text"> ¡Hola {{Auth::user()->name}}! En esta pantalla podrás visualizar un reporte de préstamos general. </p>
        <hr>
        <div class="table-responsive m-t-40">
            <table id="tbreportePrestamos" class="display nowrap table table-hover table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Nombre insumo</th>
                        <th>Descripción insumo</th>
                        <th>Tipo de insumo</th>
                        <th>Cantidad solicitada</th>
                        <th>Empleado</thF>
                        <th>Fecha de solicitud</th>                          
                        <th>Estatus</th>                            
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Nombre insumo</th>
                        <th>Descripción insumo</th>
                        <th>Tipo de insumo</th>
                        <th>Cantidad solicitada</th>
                        <th>Empleado</thF>
                        <th>Fecha de solicitud</th>                          
                        <th>Estatus</th> 
                    </tr>
                </tfoot>
                <tbody>
                @forelse($prestamos as $prestamo)
                    <tr>
                        <td>{{$prestamo->nombre}}</td>
                        <td>{{$prestamo->descripcion}}</td>
                        <td>{{$prestamo->tipo_producto}}</td>
                        <td>{{$prestamo->cantidad}}</td>
                        <td>{{$prestamo->empleado}}</td>
                        <td>{{$prestamo->fechaSolicitud}}</td>
                        <td>{{$prestamo->estatus}}</td>
                    </tr>
                @empty

                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection