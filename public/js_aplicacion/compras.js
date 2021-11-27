$(document).ready(function () {
    $(document).on("click", "#btnNuevo", function () {
        let fecha = new Date();
        $("#txtFechaCompra").val(
            fecha.getDate() +
                "/" +
                (parseInt(fecha.getUTCMonth()) + 1) +
                "/" +
                fecha.getFullYear()
        );

        let clave =
            "Compra_" +
            fecha.getDate() +
            "_" +
            fecha.getUTCMonth() +
            "_" +
            fecha.getFullYear() +
            "_" +
            fecha.getTime();
        $("#txtClaveCompra").val(clave);
    });
});

const limpiarCompras = () => {
    $("#txtClaveCompra").val("");
    $("#txtFechaCompra").val("");
    $("#txtCantidadProductos").val("");
    $("#txtLinkInsumo1").val("");
    $("#txtPrecioInsumo1").val("");
    $("#txtLinkInsumo2").val("");
    $("#txtPrecioInsumo2").val("");
    $("#txtIdCompra").val("");
};

const limpiarComprasDetail = () => {
    $("#txtClaveCompraDetail").val("");
    $("#txtFechaCompraDetail").val("");
    $("#txtCantidadProductosDetail").val("");
    $("#txtLinkInsumo1Detail").val("");
    $("#txtPrecioInsumo1Detail").val("");
    $("#txtLinkInsumo2Detail").val("");
    $("#txtPrecioInsumo2Detail").val("");
    $("#txtIdCompraDetail").val("");
};
const limpiarComprasDetailAlmacen = () => {
    $("#txtClaveCompraDetailAlmacen").val("");
    $("#txtFechaCompraDetailAlmacen").val("");
    $("#txtCantidadProductosDetailAlmacen").val("");
    $("#txtLinkInsumo1DetailAlmacen").val("");
    $("#txtPrecioInsumo1DetailAlmacen").val("");
    $("#txtLinkInsumo2DetailAlmacen").val("");
    $("#txtPrecioInsumo2DetailAlmacen").val("");
    $("#txtIdCompraDetailAlmacen").val("");
};

const decideCompras = () => {
    if ($("#txtIdCompra").val()) {
        modificarCompra();
    } else {
        insertarCompra();
    }
};

const modificarCompra = () => {
    let validacion = validarCamposComprasDetail();
    if (validacion == "ok") {
        let link1 = $("#txtLinkInsumo1Detail").val();
        let precio1 = $("#txtPrecioInsumo1Detail").val();
        let link2 = $("#txtLinkInsumo2Detail").val();
        let precio2 = $("#txtPrecioInsumo2Detail").val();
        let cantidad = $("#txtCantidadProductosDetail").val();

        let uid = $("#txtIdCompraDetail").val();

        let datos = {
            id: uid,
            link_op1: link1,
            precio_op1: precio1,
            link_op2: link2,
            precio_op2: precio2,
            cantidad_solicitada: parseInt(cantidad),
            _token: $('input[name="_token"]').val(),
        };

        swal(
            {
                title: "¿Deseas continuar?",
                text: "Por favor, confirma que deseas modificar el registro.",
                type: "info",
                showCancelButton: true,
                cancelButtonText: "Cancelar",
                confirmButtonColor: "#4caf50",
                confirmButtonText: "Si, modificar",
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            },
            function () {
                $.ajax({
                    url: "/insumos/public/compras/acciones/modificar",
                    method: "POST",
                    data: datos,
                })
                    .done(function (res) {
                        if (res == "OK") {
                            limpiarCompras();
                            swal(
                                {
                                    type: "success",
                                    title: "Correcto",
                                    text: "Se modificó correctamente el registro.",
                                    confirmButtonText: "OK",
                                },
                                function () {
                                    location.href = "/insumos/public/compras";
                                }
                            );
                        } else {
                            swal(
                                {
                                    type: "error",
                                    title: "Error",
                                    text: "Ha ocurrido un error al momento de guardar",
                                    confirmButtonText: "OK",
                                },
                                function () {
                                    location.href = "/insumos/public/compras";
                                }
                            );
                        }
                    })
                    .fail(function (res) {
                        swal(
                            {
                                type: "error",
                                title: "Error",
                                text: "Ha ocurrido un error al momento de guardar",
                                confirmButtonText: "OK",
                            },
                            function () {
                                location.href = "/insumos/public/compras";
                            }
                        );
                    });
            }
        );
    } else {
        showNotification("bg-red", validacion, "bottom", "right", "", "");
    }
};

const detalleCompras = (uid) => {
    let datos = {
        id: uid,
        _token: $('input[name="_token"]').val(),
    };

    $.ajax({
        url: "/insumos/public/compras/acciones/buscar",
        method: "POST",
        data: datos,
    })
        .done(function (res) {
            if (res != "ERROR") {
                limpiarCompras();
                $("#txtIdCompraDetail").val(res[0].id_compra);
                $("#txtClaveCompraDetail").val(res[0].clave);
                $("#txtFechaCompraDetail").val(res[0].fecha_registro);
                $("#txtInsumosCompraDetail").val(res[0].insumo);
                $("#txtCantidadProductosDetail").val(
                    res[0].cantidad_solicitada
                );
                $("#txtLinkInsumo1Detail").val(res[0].link_op1);
                $("#txtPrecioInsumo1Detail").val(res[0].precio_op1);
                $("#txtLinkInsumo2Detail").val(res[0].link_op2);
                $("#txtPrecioInsumo2Detail").val(res[0].precio_op2);

                document.getElementById(
                    "txtInsumosCompraDetail"
                ).disabled = true;

                if (res[0].estatus != "Autorizado") {
                    document.getElementById("btnSuministrar").hidden = true;
                    document.getElementById("btnRecepcion").hidden = true;
                }
                $("#dlgComprasDetail").modal("show");
            } else {
                swal(
                    {
                        type: "error",
                        title: "Error",
                        text: "Ha ocurrido un error al momento de consultar",
                        confirmButtonText: "OK",
                    },
                    function () {
                        location.href = "/insumos/public/insumos";
                    }
                );
            }
        })
        .fail(function (res) {
            swal(
                {
                    type: "error",
                    title: "Error",
                    text: "Ha ocurrido un error al momento de consultar",
                    confirmButtonText: "OK",
                },
                function () {
                    location.href = "/insumos/public/insumos";
                }
            );
        });
};

const detalleComprasView = (uid) => {
    let datos = {
        id: uid,
        _token: $('input[name="_token"]').val(),
    };

    $.ajax({
        url: "/insumos/public/compras/acciones/buscar",
        method: "POST",
        data: datos,
    })
        .done(function (res) {
            if (res != "ERROR") {
                limpiarComprasDetail();
                $("#txtIdCompraDetail").val(res[0].id_compra);
                $("#txtClaveCompraDetail").val(res[0].clave);
                $("#txtFechaCompraDetail").val(res[0].fecha_registro);
                $("#txtInsumosCompraDetail").val(res[0].insumo);
                $("#txtCantidadProductosDetail").val(
                    res[0].cantidad_solicitada
                );
                $("#txtLinkInsumo1Detail").val(res[0].link_op1);
                $("#txtPrecioInsumo1Detail").val(res[0].precio_op1);
                $("#txtLinkInsumo2Detail").val(res[0].link_op2);
                $("#txtPrecioInsumo2Detail").val(res[0].precio_op2);
                document.getElementById(
                    "txtInsumosCompraDetail"
                ).disabled = true;
                document.getElementById(
                    "txtCantidadProductosDetail"
                ).disabled = true;
                document.getElementById("txtLinkInsumo1Detail").disabled = true;
                document.getElementById(
                    "txtPrecioInsumo1Detail"
                ).disabled = true;
                document.getElementById("txtLinkInsumo2Detail").disabled = true;
                document.getElementById(
                    "txtPrecioInsumo2Detail"
                ).disabled = true;
                $("#dlgComprasDetail").modal("show");
            } else {
                swal(
                    {
                        type: "error",
                        title: "Error",
                        text: "Ha ocurrido un error al momento de consultar",
                        confirmButtonText: "OK",
                    },
                    function () {
                        location.href = "/insumos/public/insumos";
                    }
                );
            }
        })
        .fail(function (res) {
            swal(
                {
                    type: "error",
                    title: "Error",
                    text: "Ha ocurrido un error al momento de consultar",
                    confirmButtonText: "OK",
                },
                function () {
                    location.href = "/insumos/public/insumos";
                }
            );
        });
};
const detalleComprasViewAlmacen = (uid) => {
    let datos = {
        id: uid,
        _token: $('input[name="_token"]').val(),
    };

    $.ajax({
        url: "/insumos/public/compras/acciones/buscar",
        method: "POST",
        data: datos,
    })
        .done(function (res) {
            if (res != "ERROR") {
                console.log(res);
                limpiarComprasDetail();
                $("#txtIdCompraDetailAlmacen").val(res[0].id_compra);
                $("#txtClaveCompraDetailAlmacen").val(res[0].clave);
                $("#txtFechaCompraDetailAlmacen").val(res[0].fecha_registro);
                $("#txtInsumosCompraDetailAlmacen").val(res[0].insumo);
                $("#txtCantidadProductosDetailAlmacen").val(
                    res[0].cantidad_solicitada
                );
                $("#txtLinkInsumo1DetailAlmacen").val(res[0].link_op1);
                $("#txtPrecioInsumo1DetailAlmacen").val(res[0].precio_op1);
                $("#txtLinkInsumo2DetailAlmacen").val(res[0].link_op2);
                $("#txtPrecioInsumo2DetailAlmacen").val(res[0].precio_op2);
                document.getElementById(
                    "txtInsumosCompraDetail"
                ).disabled = true;
                document.getElementById(
                    "txtCantidadProductosDetail"
                ).disabled = true;
                document.getElementById("txtLinkInsumo1Detail").disabled = true;
                document.getElementById(
                    "txtPrecioInsumo1Detail"
                ).disabled = true;
                document.getElementById("txtLinkInsumo2Detail").disabled = true;
                document.getElementById(
                    "txtPrecioInsumo2Detail"
                ).disabled = true;

                if (res[0].estatus == "Autorizado") {
                    document.getElementById("btnSuministrar").hidden = false;
                    document.getElementById("btnRecepcion").hidden = true;
                } else {
                    if (res[0].estatus == "Solicitado") {
                        document.getElementById("btnSuministrar").hidden = true;
                        document.getElementById("btnRecepcion").hidden = false;
                    } else {
                        document.getElementById("btnSuministrar").hidden = true;
                        document.getElementById("btnRecepcion").hidden = true;
                    }
                }
                $("#dlgComprasDetailAlmacen").modal("show");
            } else {
                swal(
                    {
                        type: "error",
                        title: "Error",
                        text: "Ha ocurrido un error al momento de consultar",
                        confirmButtonText: "OK",
                    },
                    function () {
                        location.href = "/insumos/public/insumos";
                    }
                );
            }
        })
        .fail(function (res) {
            swal(
                {
                    type: "error",
                    title: "Error",
                    text: "Ha ocurrido un error al momento de consultar",
                    confirmButtonText: "OK",
                },
                function () {
                    location.href = "/insumos/public/insumos";
                }
            );
        });
};

const insertarCompra = () => {
    let validacion = validarCamposCompras();
    if (validacion == "ok") {
        let ins = $("#cmbInsumosCompra").val();
        let ins_name = $("#cmbInsumosCompra option:selected").text();
        let clav = $("#txtClaveCompra").val();
        let link1 = $("#txtLinkInsumo1").val();
        let precio1 = $("#txtPrecioInsumo1").val();
        let link2 = $("#txtLinkInsumo2").val();
        let precio2 = $("#txtPrecioInsumo2").val();
        let cantidad = $("#txtCantidadProductos").val();
        let fecha = $("#txtFechaCompra").val();

        let datos = {
            id_insumo: parseInt(ins),
            insumo: ins_name,
            clave: clav,
            link_op1: link1,
            precio_op1: precio1,
            link_op2: link2,
            precio_op2: precio2,
            cantidad_solicitada: parseInt(cantidad),
            estatus: "Activo",
            estatus_validacion: "Pendiente Directivo",
            fecha_registro: fecha,
            _token: $('input[name="_token"]').val(),
        };

        swal(
            {
                title: "¿Deseas continuar?",
                text: "Por favor, confirma que deseas agregar el registro.",
                type: "info",
                showCancelButton: true,
                cancelButtonText: "Cancelar",
                confirmButtonColor: "#4caf50",
                confirmButtonText: "Si, agregar",
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            },
            function () {
                $.ajax({
                    url: "/insumos/public/compras/acciones/agregar",
                    method: "POST",
                    data: datos,
                })
                    .done(function (res) {
                        if (res == "OK") {
                            limpiarCompras();
                            swal(
                                {
                                    type: "success",
                                    title: "Correcto",
                                    text: "Se agregó correctamente el registro.",
                                    confirmButtonText: "OK",
                                },
                                function () {
                                    location.href = "/insumos/public/compras";
                                }
                            );
                        } else {
                            swal(
                                {
                                    type: "error",
                                    title: "Error",
                                    text: "Ha ocurrido un error al momento de guardar",
                                    confirmButtonText: "OK",
                                },
                                function () {
                                    location.href = "/insumos/public/compras";
                                }
                            );
                        }
                    })
                    .fail(function (res) {
                        swal(
                            {
                                type: "error",
                                title: "Error",
                                text: "Ha ocurrido un error al momento de guardar",
                                confirmButtonText: "OK",
                            },
                            function () {
                                location.href = "/insumos/public/compras";
                            }
                        );
                    });
            }
        );
        console.log(datos);
    } else {
        showNotification("bg-red", validacion, "bottom", "right", "", "");
    }
};

const validarCamposCompras = () => {
    if ($("#txtClaveClompra").val() == "") {
        return "Por favor, indica la clave de la compra. ";
    }
    if ($("#txtFechaCompra").val() == "") {
        return "Por favor, indica la fecha de la compra. ";
    }
    if (
        $("#txtCantidadProductos").val() == 0 ||
        $("#txtCantidadProductos").val() == ""
    ) {
        return "La cantidad de productos debe ser mayor a 0. ";
    }
    if ($("#txtLinkInsumo1").val() == "") {
        return "Por favor, ingrese un link para para validar la adquisión. ";
    }
    if (
        $("#txtPrecioInsumo1").val() == 0 ||
        $("#txtPrecioInsumo1").val() == ""
    ) {
        return "El precio debe ser mayor a 0. ";
    }
    if ($("#txtLinkInsumo2").val() == "") {
        return "Por favor, ingrese un link para para validar la adquisión. ";
    }
    if (
        $("#txtPrecioInsumo2").val() == 0 ||
        $("#txtPrecioInsumo2").val() == ""
    ) {
        return "El precio debe ser mayor a 0. ";
    }

    if ($("#cmbInsumosCompra").val() === 0) {
        console.log($("#cmbInsumosCompra").val());
        return "Debe seleccionar un insumo para continuar. ";
    }
    return "ok";
};

const validarCamposComprasDetail = () => {
    if (
        $("#txtCantidadProductosDetail").val() == 0 ||
        $("#txtCantidadProductosDetail").val() == ""
    ) {
        return "La cantidad de productos debe ser mayor a 0. ";
    }
    if ($("#txtLinkInsumo1Detail").val() == "") {
        return "Por favor, ingrese un link para para validar la adquisión. ";
    }
    if (
        $("#txtPrecioInsumo1Detail").val() == 0 ||
        $("#txtPrecioInsumo1Detail").val() == ""
    ) {
        return "El precio debe ser mayor a 0. ";
    }
    if ($("#txtLinkInsumo2Detail").val() == "") {
        return "Por favor, ingrese un link para para validar la adquisión. ";
    }
    if (
        $("#txtPrecioInsumo2Detail").val() == 0 ||
        $("#txtPrecioInsumo2Detail").val() == ""
    ) {
        return "El precio debe ser mayor a 0. ";
    }
    return "ok";
};

const eliminarCompra = (uid) => {
    datos = {
        id: uid,
        _token: $('input[name="_token"]').val(),
    };
    swal(
        {
            title: "¿Deseas continuar?",
            text: "Por favor, confirma que deseas eliminar la compra. ",
            type: "info",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si, eliminar",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        },
        function () {
            $.ajax({
                url: "/insumos/public/compras/acciones/eliminar",
                method: "POST",
                data: datos,
            })
                .done(function (res) {
                    if (res == "OK") {
                        swal(
                            {
                                type: "success",
                                title: "Correcto",
                                text: "Se elimino correctamente el registro.",
                                confirmButtonText: "OK",
                            },
                            function () {
                                location.href = "/insumos/public/compras";
                            }
                        );
                    } else {
                        swal(
                            {
                                type: "error",
                                title: "Error",
                                text: "Ha ocurrido un error al momento de procesar tu solicitud",
                                confirmButtonText: "OK",
                            },
                            function () {
                                location.href = "/insumos/public/compras";
                            }
                        );
                    }
                })
                .fail(function (res) {
                    swal(
                        {
                            type: "error",
                            title: "Error",
                            text: "Ha ocurrido un error al momento de procesar tu solicitud",
                            confirmButtonText: "OK",
                        },
                        function () {
                            location.href = "/insumos/public/compras";
                        }
                    );
                });
        }
    );
};

const mostrarModalRechazo = () => {
    let uid = $("#txtIdCompraDetail").val();
    $("#txtIdCompraRechazo").val(uid);
    $("#dlgRechazo").modal("show");
};

const mostrarModalRechazoDirectivo = () => {
    let uid = $("#txtIdCompraDetail").val();
    $("#txtIdCompraRechazoDirectivo").val(uid);
    $("#dlgRechazoDirectivo").modal("show");
};

const limpiarCamposComprasRechazo = () => {
    $("#txtIdCompraRechazo").val("");
    $("#txtMotivoRechazo").val("");
};

const limpiarCamposComprasRechazoDirectivo = () => {
    $("#txtIdCompraRechazoDirectivo").val("");
    $("#txtMotivoRechazoDirectivo").val("");
};

const suministrar = () => {
    let uid = $("#txtIdCompraDetailAlmacen").val();
    let nombre = $("#txtInsumosCompraDetailAlmacen").val();
    let datos = {
        id: uid,
        _token: $('input[name="_token"]').val(),
    };
    swal(
        {
            title: "¿Deseas continuar?",
            text:
                "Por favor, confirma que deseas suministrar el insumo '" +
                nombre +
                "'",
            type: "info",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            confirmButtonColor: "#4caf50",
            confirmButtonText: "Si, suministrar",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        },
        function () {
            $.ajax({
                url: "/insumos/public/compras/acciones/almacen_solicitar",
                method: "POST",
                data: datos,
            })
                .done(function (res) {
                    console.log(res);
                    if (res == "OK") {
                        limpiarComprasDetailAlmacen();
                        swal(
                            {
                                type: "success",
                                title: "Correcto",
                                text: "Se registro correctamente la solicitud.",
                                confirmButtonText: "OK",
                            },
                            function () {
                                location.href = "/insumos/public/compras";
                            }
                        );
                    } else {
                        swal(
                            {
                                type: "error",
                                title: "Error",
                                text: "Ha ocurrido un error al momento de guardar",
                                confirmButtonText: "OK",
                            },
                            function () {
                                location.href = "/insumos/public/compras";
                            }
                        );
                    }
                })
                .fail(function (res) {
                    swal(
                        {
                            type: "error",
                            title: "Error",
                            text: "Ha ocurrido un error al momento de guardar",
                            confirmButtonText: "OK",
                        },
                        function () {
                            location.href = "/insumos/public/compras";
                        }
                    );
                });
        }
    );
};

const recibir = () => {
    let uid = $("#txtIdCompraDetailAlmacen").val();
    let nombre = $("#txtInsumosCompraDetailAlmacen").val();
    let datos = {
        id: uid,
        _token: $('input[name="_token"]').val(),
    };
    swal(
        {
            title: "¿Deseas continuar?",
            text: "Por favor, confirma que recibio el insumo" + nombre,
            type: "info",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            confirmButtonColor: "#4caf50",
            confirmButtonText: "Si, recibido",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        },
        function () {
            $.ajax({
                url: "/insumos/public/compras/acciones/almacen_recibido",
                method: "POST",
                data: datos,
            })
                .done(function (res) {
                    if (res == "OK") {
                        limpiarComprasDetailAlmacen();
                        swal(
                            {
                                type: "success",
                                title: "Correcto",
                                text: "Se registro correctamente la recepción.",
                                confirmButtonText: "OK",
                            },
                            function () {
                                location.href = "/insumos/public/compras";
                            }
                        );
                    } else {
                        swal(
                            {
                                type: "error",
                                title: "Error",
                                text: "Ha ocurrido un error al momento de guardar",
                                confirmButtonText: "OK",
                            },
                            function () {
                                location.href = "/insumos/public/compras";
                            }
                        );
                    }
                })
                .fail(function (res) {
                    swal(
                        {
                            type: "error",
                            title: "Error",
                            text: "Ha ocurrido un error al momento de guardar",
                            confirmButtonText: "OK",
                        },
                        function () {
                            location.href = "/insumos/public/compras";
                        }
                    );
                });
        }
    );
};

const aceptarCompraDirectivo = () => {
    let uid = $("#txtIdCompraDetail").val();
    let nombre =$('#txtInsumosCompraDetail').val();

    let datos = {
        id: uid,
        estatus: "Aceptado Directivo",
        _token: $('input[name="_token"]').val(),
    };
    swal(
        {
            title: "¿Deseas continuar?",
            text: "Por favor, aceptar la compra del insumo " + nombre,
            type: "info",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            confirmButtonColor: "#4caf50",
            confirmButtonText: "Si, aceptar",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        },
        function () {
            $.ajax({
                url: "/insumos/public/compras/acciones/directivo",
                method: "POST",
                data: datos,
            })
                .done(function (res) {
                    if (res == "OK") {
                        limpiarComprasDetailAlmacen();
                        swal(
                            {
                                type: "success",
                                title: "Correcto",
                                text: "Se registro correctamente la aceptación.",
                                confirmButtonText: "OK",
                            },
                            function () {
                                location.href = "/insumos/public/compras_directivo";
                            }
                        );
                    } else {
                        swal(
                            {
                                type: "error",
                                title: "Error",
                                text: "Ha ocurrido un error al momento de guardar",
                                confirmButtonText: "OK",
                            },
                            function () {
                                location.href = "/insumos/public/compras_directivo";
                            }
                        );
                    }
                })
                .fail(function (res) {
                    swal(
                        {
                            type: "error",
                            title: "Error",
                            text: "Ha ocurrido un error al momento de guardar",
                            confirmButtonText: "OK",
                        },
                        function () {
                            location.href = "/insumos/public/compras_directivo";
                        }
                    );
                });
        }
    );

};

const guardarRechazoDirectivo = () => {
    let uid = $("#txtIdCompraDetail").val();
    let mmotivo_rechazo = $('#txtMotivoRechazoDirectivo').val();

    let datos = {
        id: uid,
        estatus: "Rechazado Directivo",
        motivo_rechazo:mmotivo_rechazo,
        _token: $('input[name="_token"]').val(),
    };
    swal(
        {
            title: "¿Deseas continuar?",
            text: "Esta seguro de rechazar la compra del insumo",
            type: "info",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            confirmButtonColor: "#4caf50",
            confirmButtonText: "Si, rechazar",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        },
        function () {
            $.ajax({
                url: "/insumos/public/compras/acciones/directivo",
                method: "POST",
                data: datos,
            })
                .done(function (res) {
                    if (res == "OK") {
                        limpiarComprasDetailAlmacen();
                        swal(
                            {
                                type: "success",
                                title: "Correcto",
                                text: "Se registro correctamente la aceptación.",
                                confirmButtonText: "OK",
                            },
                            function () {
                                location.href = "/insumos/public/compras_directivo";
                            }
                        );
                    } else {
                        swal(
                            {
                                type: "error",
                                title: "Error",
                                text: "Ha ocurrido un error al momento de guardar",
                                confirmButtonText: "OK",
                            },
                            function () {
                                location.href = "/insumos/public/compras_directivo";
                            }
                        );
                    }
                })
                .fail(function (res) {
                    swal(
                        {
                            type: "error",
                            title: "Error",
                            text: "Ha ocurrido un error al momento de guardar",
                            confirmButtonText: "OK",
                        },
                        function () {
                            location.href = "/insumos/public/compras_directivo";
                        }
                    );
                });
        }
    );

};

const aceptarCompraContador = () => {
    let uid = $("#txtIdCompraDetail").val();
    let nombre =$('#txtInsumosCompraDetail').val();

    let datos = {
        id: uid,
        estatus: "Aceptado Contador",
        _token: $('input[name="_token"]').val(),
    };
    swal(
        {
            title: "¿Deseas continuar?",
            text: "Por favor, decea aceptar la compra del insumo " + nombre,
            type: "info",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            confirmButtonColor: "#4caf50",
            confirmButtonText: "Si, aceptar",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        },
        function () {
            $.ajax({
                url: "/insumos/public/compras/acciones/contador",
                method: "POST",
                data: datos,
            })
                .done(function (res) {
                    if (res == "OK") {
                        limpiarCamposComprasRechazo();
                        swal(
                            {
                                type: "success",
                                title: "Correcto",
                                text: "Se registro correctamente la aceptación.",
                                confirmButtonText: "OK",
                            },
                            function () {
                                location.href = "/insumos/public/compras_contador";
                            }
                        );
                    } else {
                        swal(
                            {
                                type: "error",
                                title: "Error",
                                text: "Ha ocurrido un error al momento de guardar",
                                confirmButtonText: "OK",
                            },
                            function () {
                                location.href = "/insumos/public/compras_contador";
                            }
                        );
                    }
                })
                .fail(function (res) {
                    swal(
                        {
                            type: "error",
                            title: "Error",
                            text: "Ha ocurrido un error al momento de guardar",
                            confirmButtonText: "OK",
                        },
                        function () {
                            location.href = "/insumos/public/compras_contador";
                        }
                    );
                });
        }
    );

};

const guardarRechazoContador = () => {
    let uid = $("#txtIdCompraDetail").val();
    let mmotivo_rechazo = $('#txtMotivoRechazo').val();

    let datos = {
        id: uid,
        estatus: "Rechazado Contador",
        motivo_rechazo:mmotivo_rechazo,
        _token: $('input[name="_token"]').val(),
    };
    swal(
        {
            title: "¿Deseas continuar?",
            text: "Esta seguro de rechazar la compra del insumo",
            type: "info",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            confirmButtonColor: "#4caf50",
            confirmButtonText: "Si, rechazar",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        },
        function () {
            $.ajax({
                url: "/insumos/public/compras/acciones/contador",
                method: "POST",
                data: datos,
            })
                .done(function (res) {
                    if (res == "OK") {
                        limpiarCamposComprasRechazo();
                        swal(
                            {
                                type: "success",
                                title: "Correcto",
                                text: "Se registro correctamente la aceptación.",
                                confirmButtonText: "OK",
                            },
                            function () {
                                location.href = "/insumos/public/compras_contador";
                            }
                        );
                    } else {
                        swal(
                            {
                                type: "error",
                                title: "Error",
                                text: "Ha ocurrido un error al momento de guardar",
                                confirmButtonText: "OK",
                            },
                            function () {
                                location.href = "/insumos/public/compras_contador";
                            }
                        );
                    }
                })
                .fail(function (res) {
                    swal(
                        {
                            type: "error",
                            title: "Error",
                            text: "Ha ocurrido un error al momento de guardar",
                            confirmButtonText: "OK",
                        },
                        function () {
                            location.href = "/insumos/public/compras_contador";
                        }
                    );
                });
        }
    );

};
