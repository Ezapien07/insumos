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
            nombre:validarCamposLetras(nom),
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
                    url: "/insumos/public/insumos/acciones/agregar",
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
                                    location.href = "/insumos/public/insumos";
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
                                    location.href = "/insumos/public/insumos";
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
                                location.href = "/insumos/public/insumos";
                            }
                        );
                    });
            }
        );
    } else {
        showNotification("bg-red", salida, "bottom", "right", "", "");
    }
};
const modificarInsumo = () => {
    let salida = validarCamposInsumos();
    if (salida) {
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
