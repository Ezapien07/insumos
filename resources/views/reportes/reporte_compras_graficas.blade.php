@extends('layout.layout')

@section('contenido')

<div class="card">
    <div class="card-body">
        <h2 class="card-title">Reporte de compras</h2> 
        <p class="card-text"> ¡Hola {{Auth::user()->name}}! En esta pantalla podrás visualizar un reporte de las órdenes de compra realizadas.</p>
        <hr>
        <br/>
        <h4 class="card-subtitle"><b>Reporte de órdenes de compras realizadas por insumos</b></h4>
         <!-- Nav tabs -->
         <ul class="nav nav-tabs customtab" role="tablist">
            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#tablaOrdenesCompraInsumo" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down"> <i class="mdi mdi-table-large"></i> Tabla</span></a> </li>
            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#graBarraOrdenesCompraInsumo" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down"> <i class="mdi mdi-chart-bar"></i> Gráfica de barras</span></a> </li>
            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#graCirOrdenesCompraInsumo" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down"> <i class="mdi mdi-chart-pie"></i> Gráfica de pastel</span></a> </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active" id="tablaOrdenesCompraInsumo" role="tabpanel">
                <div class="table-responsive m-t-40">
                    <table id="tbOrdenesCompraInsumos" class="display nowrap table table-hover table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Cantidad</th>                  
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Cantidad</th>     
                            </tr>
                        </tfoot>
                        <tbody>
                        @forelse($insumos_compras as $insumo_compra)
                            <tr>
                                <td>{{$insumo_compra->codigo}}</td>
                                <td>{{$insumo_compra->nombre}}</td>
                                <td>{{$insumo_compra->descripcion}}</td>
                                <td>{{$insumo_compra->cantidad}}</td>
                            </tr>
                        @empty

                        @endforelse
                        </tbody>
                    </table>
                    <br/>
                </div>
            </div>
            <div class="tab-pane  p-20" id="graBarraOrdenesCompraInsumo" role="tabpanel">
                <figure class="highcharts-figure">
                    <div id="containerOrdenesCompraInsumoBarra"></div>
                </figure>
            </div>
            <div class="tab-pane p-20" id="graCirOrdenesCompraInsumo" role="tabpanel">
                <figure class="highcharts-figure">
                    <div id="containerOrdenesCompraInsumoPastel"></div>
                </figure>
            </div>
        </div>
        <br/>
        <br/>
        <h4 class="card-subtitle"><b>Reporte de insumos por cantidad solicitada</b></h4>
         <!-- Nav tabs -->
         <ul class="nav nav-tabs customtab" role="tablist">
            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#tablaCantidadSolicitadaInsumos" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down"> <i class="mdi mdi-table-large"></i> Tabla</span></a> </li>
            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#graBarraCantidadSolicitadaInsumos" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down"> <i class="mdi mdi-chart-bar"></i> Gráfica de barras</span></a> </li>
            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#graCirCantidadSolicitadaInsumos" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down"> <i class="mdi mdi-chart-pie"></i> Gráfica de pastel</span></a> </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active" id="tablaCantidadSolicitadaInsumos" role="tabpanel">
                <div class="table-responsive m-t-40">
                    <table id="tbCantidadSolicitadaInsumos" class="display nowrap table table-hover table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Cantidad</th>                  
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Cantidad</th>     
                            </tr>
                        </tfoot>
                        <tbody>
                        @forelse($insumos_solicitados as $insumo_solicitados)
                            <tr>
                                <td>{{$insumo_solicitados->codigo}}</td>
                                <td>{{$insumo_solicitados->nombre}}</td>
                                <td>{{$insumo_solicitados->descripcion}}</td>
                                <td>{{$insumo_solicitados->cantidad}}</td>
                            </tr>
                        @empty

                        @endforelse
                        </tbody>
                    </table>
                    <br/>
                </div>
            </div>
            <div class="tab-pane  p-20" id="graBarraCantidadSolicitadaInsumos" role="tabpanel">
                <figure class="highcharts-figure">
                    <div id="containerCantidadSolicitadaInsumosBarra"></div>
                </figure>
            </div>
            <div class="tab-pane p-20" id="graCirCantidadSolicitadaInsumos" role="tabpanel">
                <figure class="highcharts-figure">
                    <div id="containerCantidadSolicitadaInsumosPastel"></div>
                </figure>
            </div>
        </div>
        <br/>
        <br/>
        <h4 class="card-subtitle"><b>Reporte de insumos por costo</b></h4>
         <!-- Nav tabs -->
         <ul class="nav nav-tabs customtab" role="tablist">
            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#tablaTotalInsumos" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down"> <i class="mdi mdi-table-large"></i> Tabla</span></a> </li>
            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#graBarraTotalInsumos" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down"> <i class="mdi mdi-chart-bar"></i> Gráfica de barras</span></a> </li>
            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#graCirTotalInsumos" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down"> <i class="mdi mdi-chart-pie"></i> Gráfica de pastel</span></a> </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active" id="tablaTotalInsumos" role="tabpanel">
                <div class="table-responsive m-t-40">
                    <table id="tbTotalInsumos" class="display nowrap table table-hover table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Cantidad</th>                  
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Cantidad</th>     
                            </tr>
                        </tfoot>
                        <tbody>
                        @forelse($insumos_total as $insumo_total)
                            <tr>
                                <td>{{$insumo_total->codigo}}</td>
                                <td>{{$insumo_total->nombre}}</td>
                                <td>{{$insumo_total->descripcion}}</td>
                                <td>{{$insumo_total->cantidad}}</td>
                            </tr>
                        @empty

                        @endforelse
                        </tbody>
                    </table>
                    <br/>
                </div>
            </div>
            <div class="tab-pane  p-20" id="graBarraTotalInsumos" role="tabpanel">
                <figure class="highcharts-figure">
                    <div id="containerTotalInsumosBarra"></div>
                </figure>
            </div>
            <div class="tab-pane p-20" id="graCirTotalInsumos" role="tabpanel">
                <figure class="highcharts-figure">
                    <div id="containerTotalInsumosPastel"></div>
                </figure>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/plugins/highcharts/highstock.js')}}"></script>
<script src="{{asset('assets/plugins/highcharts/exporting.js')}}"></script>
<script src="{{asset('assets/plugins/jspdf/jspdf.min.js')}}"></script>
<script src="{{asset('js_aplicacion/reporte__compras.js')}}"></script>
@endsection