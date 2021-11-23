@extends('layout.layout')

@section('contenido')

<div class="card">
    <div class="card-body">
        <h2 class="card-title">Ctrl. de Compras</h2>
        <p class="card-text"> ¡Hola Jessi! En esta pantalla podrás gestionar las compras de insumos que nesesites. </p>
        <hr>
        <div class="table-responsive m-t-40">
            <table id="tbCompras" class="display nowrap table table-hover table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Código</th>
                        <th>Cantidad</th>
                        <th>Cantidad Minima Stock</th>
                        <th>Tipo Producto</th>
                        <th>Estatus</th>
                        <th class="text-center">Modificar</th>
                        <th class="text-center">Eliminar</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Código</th>
                        <th>Cantidad</th>
                        <th>Cantidad Minima Stock</th>
                        <th>Tipo Producto</th>
                        <th>Estatus</th>
                        <th class="text-center">Modificar</th>
                        <th class="text-center">Eliminar</th>
                    </tr>
                </tfoot>
                <tbody>
                    @forelse($insumos as $insumo)
                    <tr>
                        <td>{{$insumo->nombre}}</td>
                        <td>{{$insumo->descripcion}}</td>
                        <td>{{$insumo->codigo}}</td>
                        <td>{{$insumo->cantidad}}</td>
                        <td>{{$insumo->cantidad_minima}}</td>
                        <td>{{$insumo->tipo_producto}}</td>

                        @if($insumo->estatus == 'Activo')
                        <td> <i class="fa fa-check-circle" aria-hidden="true"></i> &nbsp; {{$insumo->estatus}} </td>
                        @else
                        <td> <i class="fa fa-times-circle" aria-hidden="true"></i> &nbsp;{{$insumo->estatus}}</td>
                        @endif
                    </tr>
                    @empty

                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection