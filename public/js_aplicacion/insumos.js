const limpiarInsumos = () => {
    $("#txtIdInsumos").val("");
    $("#txtDescripcionInsumo").val("");
    $("#txtCodigoInsumo").val("");
    $("#txtNombreInsumo").val("");
    $("#txtCantidadMinInsumo").val("");
    $("input:checkbox[name=chechInsumoConsumible]").attr("checked", false);
};

const decidirInsumos = () => {
    if ($("#txtIdInsumos").val()) {
        modificarInsumo();
    } else {
        insertarInsumo();
    }
};

const insertarInsumo = async () => {
    let salida = validarCamposInsumos();
    if (salida === "ok") {
        let desc = $("#txtDescripcionInsumo").val();
        let codi = $("#txtCodigoInsumo").val();
        let nom = $("#txtNombreInsumo").val();
        let minima = $("#txtCantidadMinInsumo").val();
        let consu = document.getElementById("chechInsumoConsumible").checked;
        datos = {
            nombre: validarCamposLetras(nom),
            descripcion: validarCamposLetras(desc),
            codigo: validarCamposLetras(codi),
            estatus: 1,
            tipo: consu ? true : false,
            cantidad_minima: minima,
            _token: $('input[name="_token"]').val(),
        };
        console.log(datos);
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
                    url: "/insumos/acciones/agregar",
                    method: "POST",
                    data: datos,
                })
                    .done(function (res) {
                        console.log(res);
                        if (res == "OK") {
                            limpiarInsumos();
                            swal(
                                {
                                    type: "success",
                                    title: "Correcto",
                                    text: "Se agregó correctamente el registro.",
                                    confirmButtonText: "OK",
                                },
                                function () {
                                    location.href = "/insumos";
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
                                    location.href = "/insumos";
                                }
                            );
                        }
                    })
                    .fail(function (res) {
                        console.log(res);
                        swal(
                            {
                                type: "error",
                                title: "Error",
                                text: "Ha ocurrido un error al momento de guardar",
                                confirmButtonText: "OK",
                            },
                            function () {
                                location.href = "/insumos";
                            }
                        );
                    });
            }
        );
    } else {
        showNotification("bg-red", salida, "bottom", "right", "", "");
    }
};

const modificarInsumo = async () => {
    let salida = validarCamposInsumos();
    if (salida === "ok") {
        let uid = $("#txtIdInsumos").val();
        let desc = $("#txtDescripcionInsumo").val();
        let codi = $("#txtCodigoInsumo").val();
        let nom = $("#txtNombreInsumo").val();
        let minima = $("#txtCantidadMinInsumo").val();
        let consu = document.getElementById("chechInsumoConsumible").checked;
        datos = {
            id: uid,
            nombre: validarCamposLetras(nom),
            descripcion: validarCamposLetras(desc),
            codigo: validarCamposLetras(codi),
            estatus: 1,
            tipo: consu ? true : false,
            cantidad_minima: minima,
            _token: $('input[name="_token"]').val(),
        };
        swal(
            {
                title: "¿Deseas continuar?",
                text:
                    "Por favor, confirma que deseas modificar el insumo " +
                    nom +
                    ". ",
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
                    url: "/insumos/acciones/modificar",
                    method: "POST",
                    data: datos,
                })
                    .done(function (res) {
                        console.log(res);
                        if (res == "OK") {
                            limpiarInsumos();
                            swal(
                                {
                                    type: "success",
                                    title: "Correcto",
                                    text: "Se modifico correctamente el registro.",
                                    confirmButtonText: "OK",
                                },
                                function () {
                                    location.href = "/insumos";
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
                                    location.href = "/insumos";
                                }
                            );
                        }
                    })
                    .fail(function (res) {
                        console.log(res);
                        swal(
                            {
                                type: "error",
                                title: "Error",
                                text: "Ha ocurrido un error al momento de guardar",
                                confirmButtonText: "OK",
                            },
                            function () {
                                location.href = "/insumos";
                            }
                        );
                    });
            }
        );
    } else {
        showNotification("bg-red", salida, "bottom", "right", "", "");
    }
};

const validarCamposInsumos = () => {
    if ($("#txtNombreInsumo").val() == "") {
        return "Por favor, indica el nombre. ";
    }
    if ($("#txtDescripcionInsumo").val() == "") {
        return "Por favor, indica la descripción. ";
    }
    if ($("#txtCodigoInsumo").val() == "") {
        return "Por favor, indica un codigo de Insumo. ";
    }
    if ($("#txtCantidadMinInsumo").val() == "0") {
        return "La cantidad minima en stock es de 3 productos. ";
    }
    return "ok";
};

const detalleInsumos = (uid) => {
    datos = {
        id: uid,
        _token: $('input[name="_token"]').val(),
    };

    $.ajax({
        url: "/insumos/acciones/buscar",
        method: "POST",
        data: datos,
    })
        .done(function (res) {
            if (res != "ERROR") {
                limpiarInsumos();
                $("#txtIdInsumos").val(res.id);
                $("#txtDescripcionInsumo").val(res.descripcion);
                $("#txtCodigoInsumo").val(res.codigo);
                $("#txtNombreInsumo").val(res.nombre);
                $("#txtCantidadMinInsumo").val(res.cantidad_minima);
                res.tipo_producto == "Consumible"
                    ? (document.getElementById(
                          "chechInsumoConsumible"
                      ).checked = true)
                    : (document.getElementById(
                          "chechInsumoConsumible"
                      ).checked = false);
                $("#dlginsumos").modal("show");
            } else {
                swal(
                    {
                        type: "error",
                        title: "Error",
                        text: "Ha ocurrido un error al momento de consultar",
                        confirmButtonText: "OK",
                    },
                    function () {
                        location.href = "/insumos";
                    }
                );
            }
        })
        .fail(function (res) {
            console.log(res);
            swal(
                {
                    type: "error",
                    title: "Error",
                    text: "Ha ocurrido un error al momento de consultar",
                    confirmButtonText: "OK",
                },
                function () {
                    location.href = "/insumos";
                }
            );
        });
};

const eliminarInsumos = (uid) => {
    datos = {
        id: uid,
        _token: $('input[name="_token"]').val(),
    };
    swal(
        {
            title: "¿Deseas continuar?",
            text: "Por favor, confirma que deseas eliminar el insumo. ",
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
                url: "/insumos/acciones/eliminar",
                method: "POST",
                data: datos,
            })
                .done(function (res) {
                    console.log(res);
                    if (res == "OK") {
                        swal(
                            {
                                type: "success",
                                title: "Correcto",
                                text: "Se elimino correctamente el registro.",
                                confirmButtonText: "OK",
                            },
                            function () {
                                location.href = "/insumos";
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
                                location.href = "/insumos";
                            }
                        );
                    }
                })
                .fail(function (res) {
                    console.log(res);
                    swal(
                        {
                            type: "error",
                            title: "Error",
                            text: "Ha ocurrido un error al momento de procesar tu solicitud",
                            confirmButtonText: "OK",
                        },
                        function () {
                            location.href = "/insumos";
                        }
                    );
                });
        }
    );
};
const activarInsumos = (uid) => {
    datos = {
        id: uid,
        _token: $('input[name="_token"]').val(),
    };
    swal(
        {
            title: "¿Deseas continuar?",
            text: "Por favor, confirma que deseas activar el insumo. ",
            type: "info",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            confirmButtonColor: "#4CAF50",
            confirmButtonText: "Si, activar",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        },
        function () {
            $.ajax({
                url: "/insumos/acciones/activar",
                method: "POST",
                data: datos,
            })
                .done(function (res) {
                    console.log(res);
                    if (res == "OK") {
                        swal(
                            {
                                type: "success",
                                title: "Correcto",
                                text: "Se elimino correctamente el registro.",
                                confirmButtonText: "OK",
                            },
                            function () {
                                location.href = "/insumos";
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
                                location.href = "/insumos";
                            }
                        );
                    }
                })
                .fail(function (res) {
                    console.log(res);
                    swal(
                        {
                            type: "error",
                            title: "Error",
                            text: "Ha ocurrido un error al momento de procesar tu solicitud",
                            confirmButtonText: "OK",
                        },
                        function () {
                            location.href = "/insumos";
                        }
                    );
                });
        }
    );
};
