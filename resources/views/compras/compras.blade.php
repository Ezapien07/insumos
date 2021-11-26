<?php

use Illuminate\Support\Facades\Auth;
?>
@extends('layout.layout')

@section('contenido')

<div class="card">
    <div class="card-body">
        <h2 class="card-title">Ctrl. de Compras</h2>
        <p class="card-text"> ¡Hola Jessi! En esta pantalla podrás gestionar las compras de insumos que nesesites. </p>
        <hr>
        <?= $compras ?>
        <div class="table-responsive m-t-40">
            <table id="tbCompras" class="table table-striped table-bordered table-condensed table-hover text-left" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Clave</th>
                        <th>Fecha</th>
                        <th>Insumo</th>
                        <th>Cantidad Solicitada</th>
                        <th>Opciones de Compra</th>
                        <th>Estatus</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Clave</th>
                        <th>Fecha</th>
                        <th>Insumo</th>
                        <th>Cantidad Solicitada</th>
                        <th>Opciones de Compra</th>
                        <th>Estatus</th>
                        <th class="text-center">Acciones</th>
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
                            @switch($compra->estatus)
                            @case('Pendiente Directivo')
                            <i class="fas fa-user-circle" aria-hidden="true"></i> {{$compra->estatus}}
                            @break
                            @case('Pendiente Contador')
                            <i class="fas fa-hand-holding-usd" aria-hidden="true"></i> {{$compra->estatus}}
                            @break
                            @endswitch
                        </td>
                        <td class="text-center">
                            <form action="" method="POST">
                                @csrf
                                @switch(Auth::user()->rol)
                                @case('Administrador')
                                <button class="btn btn-warning waves-effect btn-circle waves-light" type="button" onclick="detalleComprasView(<?= $compra->id_compra ?>)">
                                    <i class="fa fa-eye"></i></button>
                                @break
                                @case('Gerente')
                                <button class="btn btn-warning waves-effect btn-circle waves-light" type="button" onclick="detalleComprasView(<?= $compra->id_compra ?>)">
                                    <i class="fa fa-eye"></i></button>
                                @break
                                @case('Contador')
                                <button class="btn btn-warning waves-effect btn-circle waves-light" type="button" onclick="detalleComprasView(<?= $compra->id_compra ?>)">
                                    <i class="fa fa-eye"></i></button>
                                @break
                                @case('Almacen')
                                @if($compra->estatus == 'Pendiente Directivo')
                                <button class="btn btn-warning waves-effect btn-circle waves-light" type="button" onclick="detalleCompras(<?= $compra->id_compra ?>)">
                                    <i class="fa fa-edit"></i></button>

                                <button class="btn btn-danger waves-effect btn-circle waves-light" type="button" onclick="eliminarCompra(<?= $compra->id_compra ?>)">
                                    <i class="fa fa-trash"></i></button>
                                @else
                                <button class="btn btn-warning waves-effect btn-circle waves-light" type="button" onclick="detalleComprasView(<?= $compra->id_compra ?>)">
                                    <i class="fa fa-eye"></i></button>
                                @endif
                                @break
                                @endswitch
                        </td>
                        </form>
                    </tr>
                    @empty

                    @endforelse
                </tbody>
            </table>
            @if(Auth::user()->rol == 'Almacen')
            <button id="btnNuevo" class="right-side-toggle waves-effect waves-light btn-success btn btn-circle btn-sm pull-right m-l-10" data-toggle="modal" data-target="#dlgCompras"><i class="fa fa-plus text-white"></i></button>
            @endif
        </div>
    </div>
</div>
<!-- sample modal content -->
<div id="dlgCompras" class="modal fade bs-example-modal-lg " tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="vcenter">Formulario para la compra de Insumos</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="limpiarCompras()">×</button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    @csrf
                    <div class="row">
                        <h3 class="card-header col-md-12 text-center">Datos de la compra</h3>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txtClaveCompra">Clave de Compra</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-barcode"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="txtClaveCompra" id="txtClaveCompra" placeholder="Clave de la compra" disabled>
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

                                        <select class="selectpicker form-control" data-live-search="true" name="cmbInsumosCompra" searchPlaceholder="Insumo a comprar" id="cmbInsumosCompra" style="width: 100%">
                                            <option value="0">Seleccione una opción</option>
                                            @forelse($insumos as $insumo)

                                            <option value="{{$insumo->id}}">{{$insumo->nombre}}</option>
                                            @empty
                                            @endforelse
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
                                <label for="txtPrecioInsumo1">Precio del producto Tienda 1</label>
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
                                <label for="txtPrecioInsumo2">Precio del producto Tienda 2</label>
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
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal" onclick="limpiarCompras()"> <i class="fa fa-times" aria-hidden="true"></i> &nbsp; Cancelar</button>
                    <button type="button" class="btn btn-success waves-effect" onclick="insertarCompra()"> <i class="fa fa-save" aria-hidden="true"></i> &nbsp; Guardar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
<!-- /.modal -->

<div id="dlgComprasDetail" class="modal fade bs-example-modal-lg " tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="vcenter">Formulario para la compra de Insumos</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="limpiarCompras()">×</button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    @csrf
                    <div class="row">
                        <h3 class="card-header col-md-12 text-center">Datos de la compra</h3>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txtClaveCompraDetail">Clave de Compra</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-barcode"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="txtClaveCompraDetail" id="txtClaveCompraDetail" placeholder="Clave de la compra" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txtFechaCompraDetail">Fecha de compra</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-calendar-alt" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="txtFechaCompraDetail" id="txtFechaCompraDetail" placeholder="Fecha de la compra en la que se registra" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txtInsumosCompraDetail">Insumo</label>
                                <div class="input-group">
                                    <div class="input-group-prepend col-12">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-cube" aria-hidden="true"></i>
                                        </span>
                                        <input type="text" class="form-control" name="txtInsumosCompraDetail" id="txtInsumosCompraDetail" placeholder="Insumo a comprar">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txtCantidadProductosDetail">Cantidad de Productos a comprar</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-boxes" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="number" min='3' class="form-control" name="txtCantidadProductosDetail" id="txtCantidadProductosDetail" placeholder="Cantidad de Insumos">
                                </div>
                            </div>
                        </div>
                        <h3 class="card-header col-md-12 text-center">Datos del Insumo</h3>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txtLinkInsumo1Detail">Link del producto Tienda 1</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-link" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <textarea type="text" min='3' class="form-control" name="txtLinkInsumo1Detail" id="txtLinkInsumo1Detail" placeholder="Link de la paguina del producto"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="txtPrecioInsumo1">Precio del producto Tienda 1</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="far fa-money-bill-alt" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="number" min='3' class="form-control" name="txtPrecioInsumo1Detail" id="txtPrecioInsumo1Detail" placeholder="precio del Insumo">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txtLinkInsumo2Detail">Link del producto Tienda 2</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-link" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <textarea type="text" min='3' class="form-control" name="txtLinkInsumo2Detail" id="txtLinkInsumo2Detail" placeholder="Link de la paguina del producto"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="txtPrecioInsumo2Detail">Precio del producto Tienda 2</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="far fa-money-bill-alt" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="number" min='3' class="form-control" name="txtPrecioInsumo2Detail" id="txtPrecioInsumo2Detail" placeholder="precio del Insumo">
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="txtIdCompraDetail" class="form-control" placeholder="Id">

                </form>
                <div class="modal-footer">
                    @switch(Auth::user()->rol)
                    @case('Administrador')
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal" onclick="limpiarComprasDetail()"> <i class="fa fa-times" aria-hidden="true"></i> &nbsp; Cancelar</button>
                    @break
                    @case('Almacen')
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal" onclick="limpiarComprasDetail()"> <i class="fa fa-times" aria-hidden="true"></i> &nbsp; Cancelar</button>
                    <button type="button" class="btn btn-success waves-effect" onclick="modificarCompra()"> <i class="fa fa-save" aria-hidden="true"></i> &nbsp; Guardar</button>
                    <button type="button" id="btnSuministrar" class="btn btn-success waves-effect" onclick="decideCompras()"> <i class="fas fa-cart-arr" aria-hidden="true"></i> &nbsp; Solicitar Compra</button>
                    <button type="button" id="btnRecepcion" class="btn btn-success waves-effect" onclick="ready()"> <i class="fas fa-people-carry" aria-hidden="true"></i> &nbsp; Registrar Recepción</button>
                    @break
                    @case('Contador')
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal" onclick="limpiarComprasDetail()"> <i class="fa fa-times" aria-hidden="true"></i> &nbsp; Cancelar</button>
                    <button type="button" id="btnAutorizarContador" class="btn btn-success waves-effect" onclick="ready()"> <i class="fas fa-check-circle" aria-hidden="true"></i> &nbsp; Autorizar</button>
                    @break
                    @case('Gerente')
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal" onclick="limpiarComprasDetail()"> <i class="fa fa-times" aria-hidden="true"></i> &nbsp; Cancelar</button>
                    <button type="button" id="btnAutorizarDirectivo" class="btn btn-success waves-effect" onclick="ready()"> <i class="fas fa-check-circle" aria-hidden="true"></i> &nbsp; Autorizar</button>
                    @break
                    @endswitch
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
@endsection