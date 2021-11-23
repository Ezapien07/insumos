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
                        <form action="" method="POST">
                            @csrf
                            <td class="text-center"><button class="btn btn-warning waves-effect btn-circle waves-light" type="button" onclick="detalleInsumos(<?= $insumo->id ?>)">
                                    <i class="fa fa-edit"></i></button></td>
                            <td class="text-center"><button class="btn btn-danger waves-effect btn-circle waves-light" type="button" onclick="eliminarInsumos(<?= $insumo->id ?>)">
                                    <i class="fa fa-trash"></i></button></td>
                        </form>
                    </tr>
                    @empty

                    @endforelse
                </tbody>
            </table>
            <button class="right-side-toggle waves-effect waves-light btn-success btn btn-circle btn-sm pull-right m-l-10" data-toggle="modal" data-target="#dlgCompras"><i class="fa fa-plus text-white"></i></button>
        </div>
    </div>
</div>
<!-- sample modal content -->
<div id="dlgCompras" class="modal fade bs-example-modal-lg " tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="vcenter">Formulario para la compra de Insumos</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="limpiarInsumos()">×</button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    @csrf
                    <div class="row">
                        <h3 class="card-header col-md-12 text-center">Datos de la compra</h3>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txtClaveClompra">Clave de Compra</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-barcode"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="txtClaveClompra" id="txtClaveClompra" placeholder="Clave de la compra" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txtFechaCompra">Fecha de compra</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-calendar-alt" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="txtFechaCompra" id="txtFechaCompra" placeholder="Fecha de la compra en la que se registra" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txtCodigoInsumo">Insumo</label>
                                <div class="input-group">
                                    <div class="input-group-prepend col-12">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-cube" aria-hidden="true"></i>
                                        </span>

                                        <select class="select2 form-control" multiple  name="slcInsumos" placeholder="Insumo a comprar" id="slcInsumos" style="width: 100%">
                                            <option>Select</option>
                                            <option>jessi</option>
                                            <option>Uba</option>
                                            <option>Zapien</option>
                                            <option>Cruz</option>
                                            <option>Jesus</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                                <label for="txtCantidadProductos">Cantidad de Productos a comprar</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-boxes" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="number" min='3' class="form-control" name="txtCantidadProductos" id="txtCantidadProductos" placeholder="Cantidad de Insumos">
                                </div>
                            </div>
                        </div>
                        <h3 class="card-header col-md-12 text-center">Datos del Insumo</h3>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txtLinkInsumo1">Link del producto Tienda 1</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-link" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <textarea type="text" min='3' class="form-control" name="txtLinkInsumo1" id="txtLinkInsumo1" placeholder="Link de la paguina del producto"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="txtPrecioInsumo1">Precio  del producto Tienda 1</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="far fa-money-bill-alt" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="number" min='3' class="form-control" name="txtPrecioInsumo1" id="txtPrecioInsumo1" placeholder="precio del Insumo">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txtLinkInsumo2">Link del producto Tienda 2</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-link" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <textarea type="text" min='3' class="form-control" name="txtLinkInsumo2" id="txtLinkInsumo2" placeholder="Link de la paguina del producto"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="txtPrecioInsumo2">Precio  del producto Tienda 2</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="far fa-money-bill-alt" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="number" min='3' class="form-control" name="txtPrecioInsumo2" id="txtPrecioInsumo2" placeholder="precio del Insumo">
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="txtIdCompra" class="form-control" placeholder="Id">

                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal" onclick="limpiarInsumos()"> <i class="fa fa-times" aria-hidden="true"></i> &nbsp; Cancelar</button>
                    <button type="button" class="btn btn-success waves-effect" onclick="decidirInsumos()"> <i class="fa fa-save" aria-hidden="true"></i> &nbsp; Guardar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
<!-- /.modal -->
@endsection