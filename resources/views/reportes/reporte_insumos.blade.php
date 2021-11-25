@extends('layout.layout')

@section('contenido')

<div class="card">
    <style>
        .btn-export-graph{
            background-color: #000F9F;
            color: white;
            margin-right: 5px;
            text-decoration: none;
            box-shadow: 0 2px 5px rgba(0,0,0,0.16), 0 2px 10px rgba(0,0,0,0.12);
            border-radius: 2px;
            border: none;
            font-size: 13px;
            line-height: 30px
        }        
    </style>
    <div class="card-body">
        <h2 class="card-title">Reporte de insumos</h2> 
        <p class="card-text"> ¡Hola {{Auth::user()->name}}! En esta pantalla podrás visualizar un reporte de los insumos con los que cuenta la organización.</p>
        <hr>
        <br/>
        <h4 class="card-subtitle"><b>Reporte de insumos por cantidad</b></h4>
         <!-- Nav tabs -->
         <ul class="nav nav-tabs customtab" role="tablist">
            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#tablaCantidadInsumos" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down"> <i class="mdi mdi-table-large"></i> Tabla</span></a> </li>
            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#graBarraCantidadInsumos" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down"> <i class="mdi mdi-chart-bar"></i> Gráfica de barras</span></a> </li>
            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#graCirCantidadInsumos" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down"> <i class="mdi mdi-chart-pie"></i> Gráfica de pastel</span></a> </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active" id="tablaCantidadInsumos" role="tabpanel">
                <div class="table-responsive m-t-40">
                    <table id="tbCantidadInsumos" class="display nowrap table table-hover table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nombre del producto</th>
                                <th>Descripción</th>
                                <th>Uds inventario actual</th>                  
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Código</th>
                                <th>Nombre del producto</th>
                                <th>Descripción</th>
                                <th>Uds inventario actual</th>    
                            </tr>
                        </tfoot>
                        <tbody>
                        @forelse($insumos as $insumo)
                            <tr>
                                <td>{{$insumo->codigo}}</td>
                                <td>{{$insumo->nombre}}</td>
                                <td>{{$insumo->descripcion}}</td>
                                <td>{{$insumo->cantidad}}</td>
                            </tr>
                        @empty

                        @endforelse
                        </tbody>
                    </table>
                    <br/>
                </div>
            </div>
            <div class="tab-pane  p-20" id="graBarraCantidadInsumos" role="tabpanel">
                <figure class="highcharts-figure">
                    <div id="containerCantidadInsumosBarra"></div>
                </figure>
            </div>
            <div class="tab-pane p-20" id="graCirCantidadInsumos" role="tabpanel">
                <figure class="highcharts-figure">
                    <div id="containerCantidadInsumosPastel"></div>
                </figure>
            </div>
        </div>
        <br/>
        <br/>
        <h4 class="card-subtitle"><b>Reporte de insumos por tipo de producto</b></h4>
         <!-- Nav tabs -->
         <ul class="nav nav-tabs customtab" role="tablist">
            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#tablaTipoInsumos" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down"> <i class="mdi mdi-table-large"></i> Tabla</span></a> </li>
            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#graBarraTipoInsumos" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down"> <i class="mdi mdi-chart-bar"></i> Gráfica de barras</span></a> </li>
            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#graCirTipoInsumos" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down"> <i class="mdi mdi-chart-pie"></i> Gráfica de pastel</span></a> </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active" id="tablaTipoInsumos" role="tabpanel">
                <div class="table-responsive m-t-40">
                    <table id="tbTipoInsumos" class="display nowrap table table-hover table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Tipo producto</th>
                                <th>Cantidad</th>              
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Tipo producto</th>
                                <th>Cantidad</th>    
                            </tr>
                        </tfoot>
                        <tbody>
                        @forelse($tipos as $tipo)
                            <tr>
                                <td>{{$tipo->tipo_producto}}</td>
                                <td>{{$tipo->cantidad}}</td>
                            </tr>
                        @empty

                        @endforelse
                        </tbody>
                    </table>
                    <br/>
                </div>
            </div>
            <div class="tab-pane  p-20" id="graBarraTipoInsumos" role="tabpanel">
                <figure class="highcharts-figure">
                    <div id="containerTipoInsumosBarra"></div>
                </figure>
            </div>
            <div class="tab-pane p-20" id="graCirTipoInsumos" role="tabpanel">
                <figure class="highcharts-figure">
                    <div id="containerTipoInsumosPastel"></div>
                </figure>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/plugins/highcharts/highstock.js')}}"></script>
<script src="{{asset('assets/plugins/highcharts/exporting.js')}}"></script>
<script src="{{asset('assets/plugins/jspdf/jspdf.min.js')}}"></script>
<script src="{{asset('js_aplicacion/reporte_insumos.js')}}"></script>
@endsection