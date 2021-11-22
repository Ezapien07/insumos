@extends('layouts.layout')

@section('contenido')

<div class="card">
    <div class="card-body">
        <h2 class="card-title">Ctrl. de Insumos</h2>
        <p class="card-text"> ¡Hola Jessi! En esta pantalla podrás gestionar los insumos existentes </p>
        <hr>
        <div class="table-responsive m-t-40">
            <table id="tbCategoria" class="display nowrap table table-hover table-bordered" cellspacing="0" width="100%">
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
            <button class="right-side-toggle waves-effect waves-light btn-success btn btn-circle btn-sm pull-right m-l-10" data-toggle="modal" data-target="#dlginsumos"><i class="fa fa-plus text-white"></i></button>
        </div>
    </div>
</div>

<!-- sample modal content -->
<div id="dlginsumos" class="modal fade bs-example-modal-lg " tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="vcenter">Formulario para el control de Insumos</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="limpiarInsumos()">×</button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txtNombreInsumo">Nombre</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="ti-user"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="txtNombreInsumo" id="txtNombreInsumo" placeholder="Nombre Insumo">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txtDescripcionInsumo">Descripción</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-comment-alt" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <textarea type="text" class="form-control" name="txtDescripcionInsumo" id="txtDescripcionInsumo" placeholder="Descripción"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txtCodigoInsumo">Codigo</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-cube" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="txtCodigoInsumo" id="txtCodigoInsumo" placeholder="Codigo del Producto">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txtCantidadMinInsumo">Minimo Stock</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-cube" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="number" min='3' class="form-control" name="txtCantidadMinInsumo" id="txtCantidadMinInsumo" placeholder="Insumos minimos en stock">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6 text-center">
                            <br>
                            <div class="form-group">
                                <div class="checkbox checkbox-success">
                                    <input id="chechInsumoConsumible" name="chechInsumoConsumible" type="checkbox">
                                    <label for="chechInsumoConsumible"> Consumible </label>
                                    <span class="text-danger">*</span>
                                    <div class="form-control-feedback text-success "> <span class="text-danger">*</span> Este producto se no se puede regresar al amacen porque se consume.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                    <input type="hidden" id="txtIdInsumos" class="form-control" placeholder="Id">

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