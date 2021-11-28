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
                        <th>Datos de Autorización</th>
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
                            {{$compra->datos_autoriza}}<br>
                            @if($compra->estatus == 'Rechazado')
                            <h4 class="card-title text-center">Motivo Rechazo</h4>
                            <br>
                            {{$compra->motivo_rechazo}}
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
                            @case('Rechazad0')
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
                                    <i class="fa fa-edit"></i> &nbsp;&nbsp;&nbsp;&nbsp;</button>
                                <button class="btn btn-danger waves-effect btn-circle waves-light" type="button" onclick="eliminarCompra(<?= $compra->id_compra ?>)">
                                    <i class="fa fa-trash"></i></button>
                                @else
                                <button class="btn btn-warning waves-effect btn-circle waves-light" type="button" onclick="detalleComprasViewAlmacen(<?= $compra->id_compra ?>)">
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
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="limpiarComprasDetail()">×</button>
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
                    @break
                    @case('Contador')
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal" onclick="limpiarComprasDetail()"> <i class="fa fa-times" aria-hidden="true"></i> &nbsp; Cancelar</button>
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal" onclick="mostrarModalRechazo()"> <i class="fa fa-times-circle" aria-hidden="true"></i> &nbsp; Rechazar</button>
                    <button type="button" id="btnAutorizarContador" class="btn btn-success waves-effect" onclick=" MostrarProductoAceptar()"> <i class="fas fa-check-circle" aria-hidden="true"></i> &nbsp; Autorizar</button>
                    @break
                    @case('Gerente')
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal" onclick="limpiarComprasDetail()"> <i class="fa fa-times" aria-hidden="true"></i> &nbsp; Cancelar</button>
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal" onclick="mostrarModalRechazoDirectivo()"> <i class="fa fa-times-circle" aria-hidden="true"></i> &nbsp; Rechazar</button>
                    <button type="button" id="btnAutorizarDirectivo" class="btn btn-success waves-effect" onclick="aceptarCompraDirectivo()"> <i class="fas fa-check-circle" aria-hidden="true"></i> &nbsp; Autorizar</button>
                    @break
                    @endswitch
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>

<div id="dlgComprasDetailAlmacen" class="modal fade bs-example-modal-lg " tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="vcenter">Formulario para la compra de Insumos</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="limpiarComprasDetailAlmacen()">×</button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    @csrf
                    <div class="row">
                        <h3 class="card-header col-md-12 text-center">Datos de la compra</h3>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txtClaveCompraDetailAlmacen">Clave de Compra</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-barcode"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="txtClaveCompraDetailAlmacen" id="txtClaveCompraDetailAlmacen" placeholder="Clave de la compra" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txtFechaCompraDetailAlmacen">Fecha de compra</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-calendar-alt" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="txtFechaCompraDetailAlmacen" id="txtFechaCompraDetailAlmacen" placeholder="Fecha de la compra en la que se registra" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txtInsumosCompraDetailAlmacen">Insumo</label>
                                <div class="input-group">
                                    <div class="input-group-prepend col-12">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-cube" aria-hidden="true"></i>
                                        </span>
                                        <input type="text" class="form-control" name="txtInsumosCompraDetailAlmacen" id="txtInsumosCompraDetailAlmacen" placeholder="Insumo a comprar">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txtCantidadProductosDetailAlmacen">Cantidad de Productos a comprar</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-boxes" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="number" min='3' class="form-control" name="txtCantidadProductosDetailAlmacen" id="txtCantidadProductosDetailAlmacen" placeholder="Cantidad de Insumos">
                                </div>
                            </div>
                        </div>
                        <h3 class="card-header col-md-12 text-center">Datos del Insumo</h3>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txtLinkInsumo1DetailAlmacen">Link del producto Tienda 1</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-link" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <textarea type="text" min='3' class="form-control" name="txtLinkInsumo1DetailAlmacen" id="txtLinkInsumo1DetailAlmacen" placeholder="Link de la paguina del producto"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="txtPrecioInsumo1Almacen">Precio del producto Tienda 1</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="far fa-money-bill-alt" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="number" min='3' class="form-control" name="txtPrecioInsumo1DetailAlmacen" id="txtPrecioInsumo1DetailAlmacen" placeholder="precio del Insumo">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txtLinkInsumo2DetailAlmacen">Link del producto Tienda 2</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-link" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <textarea type="text" min='3' class="form-control" name="txtLinkInsumo2DetailAlmacen" id="txtLinkInsumo2DetailAlmacen" placeholder="Link de la paguina del producto"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="txtPrecioInsumo2DetailAlmacen">Precio del producto Tienda 2</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="far fa-money-bill-alt" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="number" min='3' class="form-control" name="txtPrecioInsumo2DetailAlmacen" id="txtPrecioInsumo2DetailAlmacen" placeholder="precio del Insumo">
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="txtIdCompraDetailAlmacen" class="form-control" placeholder="Id">

                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal" onclick="limpiarComprasDetailAlmacen()"> <i class="fa fa-times" aria-hidden="true"></i> &nbsp; Cancelar</button>
                    <button type="button" id="btnSuministrar" class="btn btn-success waves-effect" onclick="suministrar()"> <i class="fas fa-cart-plus" aria-hidden="true"></i> &nbsp; Solicitar Compra</button>
                    <button type="button" id="btnRecepcion" class="btn btn-success waves-effect" onclick="recibir()"> <i class="fas fa-people-carry" aria-hidden="true"></i> &nbsp; Registrar Recepción</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>

<div id="dlgRechazoContador" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="vcenter">Formulario de Rechazo de Compra de Insumos</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="limpiarCamposRechazo()">×</button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="txtMotivoRechazo">Motivo del Rechazo</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-list-alt"></i>
                                </span>
                            </div>
                            <textarea type="text" class="form-control" name="txtMotivoRechazo" id="txtMotivoRechazo" placeholder="Motivo del Rechazo"></textarea>
                        </div>
                    </div>
                    <input type="hidden" id="txtIdCompraRechazo" class="form-control" placeholder="Id">
            </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal" onclick="limpiarCamposComprasRechazo()"> <i class="fa fa-times" aria-hidden="true"></i> &nbsp;Cancelar</button>
                <button type="button" class="btn btn-success waves-effect" onclick="guardarRechazoContador()"> <i class="fa fa-save" aria-hidden="true"></i> &nbsp; Guardar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div id="dlgRechazoDirectivo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="vcenter">Formulario de Rechazo de Compra de Insumos</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="limpiarCamposRechazo()">×</button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="txtMotivoRechazoDirectivo">Motivo del Rechazo</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-list-alt"></i>
                                </span>
                            </div>
                            <textarea type="text" class="form-control" name="txtMotivoRechazoDirectivo" id="txtMotivoRechazoDirectivo" placeholder="Motivo del Rechazo"></textarea>
                        </div>
                    </div>
                    <input type="hidden" id="txtIdCompraRechazoDirectivo" class="form-control" placeholder="Id">
            </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal" onclick="limpiarCamposComprasRechazoDirectivo()"> <i class="fa fa-times" aria-hidden="true"></i> &nbsp;Cancelar</button>
                <button type="button" class="btn btn-success waves-effect" onclick="guardarRechazoDirectivo()"> <i class="fa fa-save" aria-hidden="true"></i> &nbsp;Guardar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div id="dlgAcepacionInsumo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="vcenter">Formulario de Aceptación de Producto</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="limpiarCamposAceptacion()">×</button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="txtInsumosSolicitado">Insumo Solicitado</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-list-alt"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" name="txtInsumosSolicitado" id="txtInsumosSolicitado" placeholder="Insumo Solicitado"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="card-header"> Opción 1</h4>
                            <div class="form-group">
                                <label for="txtLinkOpc1">Link opción 1</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="far fa-list-alt"></i>
                                        </span>
                                    </div>
                                    <textarea type="text" class="form-control" name="txtLinkOpc1" id="txtLinkOpc1" placeholder="Link del insumo 1"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="txtprecioOpc1">Precio Producto 1</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="far fa-list-alt"></i>
                                        </span>
                                    </div>
                                    <input type="number" class="form-control" name="txtprecioOpc1" id="txtprecioOpc1" placeholder="Precio del insumo 1"></textarea>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <div class="checkbox checkbox-success">
                                    <input id="checkOpcion1" name="checkOpcion1" type="checkbox">
                                    <label for="checkOpcion1"> Aceptar opción 1 </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4 class="card-header"> Opción 2</h4>
                            <div class="form-group">
                                <label for="txtLinkOpc2">Link opción 2</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="far fa-list-alt"></i>
                                        </span>
                                    </div>
                                    <textarea type="text" class="form-control" name="txtLinkOpc2" id="txtLinkOpc2" placeholder="Link del insumo 2"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="txtprecioOpc2">Precio Producto 2</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="far fa-list-alt"></i>
                                        </span>
                                    </div>
                                    <input type="number" class="form-control" name="txtprecioOpc2" id="txtprecioOpc2" placeholder="Precio del insumo 2"></textarea>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <div class="checkbox checkbox-success">
                                    <input id="checkOpcion2" name="checkOpcion2" type="checkbox">
                                    <label for="checkOpcion2"> Aceptar opción 2 </label>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="txtIdCompraInsumoAceptar" class="form-control" placeholder="Id">
                        <input type="hidden" id="txtTotalProductos" class="form-control" placeholder="Id">
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal" onclick="limpiarCamposAceptacion()"> <i class="fa fa-times" aria-hidden="true"></i> &nbsp;Cancelar</button>
                <button type="button" class="btn btn-success waves-effect" onclick="aceptarCompraContador()"> <i class="fa fa-save" aria-hidden="true"></i> &nbsp;Guardar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection