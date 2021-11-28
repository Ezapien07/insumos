@extends('layout.layout')

@section('contenido')

<div class="card">
    <div class="card-body">
        <h2 class="card-title">Ctrl. de Compras</h2>
        <p class="card-text"> ¡Hola Jessi! En esta pantalla podrás gestionar las compras de insumos que nesesites. </p>
        <hr>
        <div class="table-responsive m-t-40">
            <table id="tbCompras" class="table table-striped table-bordered table-condensed table-hover text-left" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Clave</th>
                        <th>Fecha</th>
                        <th>Insumo</th>
                        <th>Cantidad Solicitada</th>
                        <th>Opciones de Compra</th>
                        <th>Datos de Autorización / Rechazo</th>
                        <th>Estatus</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Clave</th>
                        <th>Fecha</th>
                        <th>Insumo</th>
                        <th>Cantidad Solicitada</th>
                        <th>Opciones de Compra</th>
                        <th>Datos de Autorización</th>
                        <th>Estatus</th>
                    </tr>
                </tfoot>
                <tbody>

                    @forelse($compras as $compra)
                    <tr>
                        <td>{{$compra->clave}}</td>
                        <td>{{$compra->fecha_compra}}</td>
                        <td>{{$compra->insumo}}</td>
                        <td>{{$compra->cantidad_solicitada}}</td>
                        <td>
                            <h4 class="card-title text-center"> Opción 1</h4>
                            <b>Link: </b>{{$compra->link_op1}}<br>
                            <b>Precio : </b>{{$compra->precio_op1}}<br>
                            <b>Total : </b>$ {{$compra->precio_op1 * $compra->cantidad_solicitada}}<br>
                            <br>
                            <h4 class="card-title text-center"> Opción 2</h4>
                            <b>Link: </b>{{$compra->link_op2}}<br>
                            <b>Precio : </b>{{$compra->precio_op2}}<br>
                            <b>Total : </b>$ {{$compra->precio_op2 * $compra->cantidad_solicitada}}<br>
                        </td>
                        <td>
                            {{$compra->datos_autoriza}}<br>
                            <br>
                            @if($compra->estatus == 'Rechazado')
                            <h4 class="card-title text-center">Motivo Rechazo</h4>
                            
                            {{$compra->motivo_rechazo}}
                            <br>
                            @else
                            @endif
                        </td>
                        <td>
                            @switch($compra->estatus)
                            @case('Pendiente Directivo')
                            <i class="fas fa-user-circle" aria-hidden="true"></i> {{$compra->estatus}}
                            @break
                            @case('Pendiente Contador')
                            <i class="fas fa-hand-holding-usd" aria-hidden="true"></i> {{$compra->estatus}}
                            @break
                            @case('Pendiente Contador')
                            <i class="fas fa-hand-holding-usd" aria-hidden="true"></i> {{$compra->estatus}}
                            @break
                            @case('Autorizado')
                            <i class="fa fa-check-circle" aria-hidden="true"></i> {{$compra->estatus}}
                            @break
                            @case('Rechazado')
                            <i class="fa fa-times-circle" aria-hidden="true"></i> {{$compra->estatus}}
                            @break
                            @case('Solicitado')
                            <i class="fas fa-cart-plus" aria-hidden="true"></i> {{$compra->estatus}}
                            @break
                            @case('Recibido')
                            <i class="fas fa-people-carry" aria-hidden="true"></i> {{$compra->estatus}}
                            @break
                            @endswitch
                        </td>
                    </tr>
                    @empty

                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection