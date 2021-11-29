@extends('layout.layout')

@section('contenido')

<div class="card">
    <div class="card-body">
        <h2 class="card-title">Reporte de compras</h2> 
        <p class="card-text"> ¡Hola {{Auth::user()->name}}! En esta pantalla podrás visualizar un reporte de compras general. </p>
        <hr>
        <div class="table-responsive m-t-40">
            <table id="tbReporteCompras" class="display nowrap table table-hover table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Clave de compra</th>
                        <th>Nombre insumo</th>
                        <th>Descripción insumo</th>
                        <th>Cantidad solicitada</th>
                        <th>Información registro</th>
                        <th>Información directivo/gerente</th>  
                        <th>Información contador</th>
                        <th>Opción elegida</th>
                        <th>Precio unitario</th>
                        <th>Total</th>
                        <th>Estatus</th>                                
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Clave de compra</th>
                        <th>Nombre insumo</th>
                        <th>Descripción insumo</th>
                        <th>Cantidad solicitada</th>
                        <th>Información registro</th>
                        <th>Información directivo/gerente</th>  
                        <th>Información contador</th>
                        <th>Opción elegida</th>
                        <th>Precio unitario</th>
                        <th>Total</th>
                        <th>Estatus</th>
                    </tr>
                </tfoot>
                <tbody>
                @forelse($compras as $compra)
                    <tr>
                        <td>{{$compra->clave}}</td>
                        <td>{{$compra->nombre_insumo}}</td>
                        <td>{{$compra->descripcion_insumo}}</td>
                        <td>{{$compra->cantidad_solicitada}}</td>
                        <td>{{$compra->descripcion_registro}}</td>
                        <td>{{$compra->descripcion_directivo}}</td>
                        <td>{{$compra->descripcion_contador}}</td>
                        <td>{{$compra->producto_comprar}}</td>
                        <td>{{$compra->precio_producto}}</td>
                        <td>{{$compra->total_pagar}}</td>
                        <td>{{$compra->estatus_orden_compra}}</td>
                    </tr>
                @empty

                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection