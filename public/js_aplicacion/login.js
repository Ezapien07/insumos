function login() {
    var err = validarCamposLogin();
    if (err == "OK") {
        var em = $('#email').val();
        var pass = $('#password').val();

        data = {
            password: pass,
            email: em,
            _token: $('input[name="_token"]').val()
        }
        $.ajax({
            url: "/login",
            method: "POST",
            data: data
        }).done(function (res) {
            switch (res) {
                case "1":
                    showNotification("bg-red", "El usuario y/o la contraseña son incorrectos.", "bottom", "right", "", "");
                    break;
                case "4":
                    location.href = "/pagina_principal";
                    break;
            }
        }).fail(function (res) {
            showNotification("bg-red", "Lo sentimos, ocurrió un error al procesar la petición.", "bottom", "right", "", "");
        });
    } else {
        showNotification("bg-red", err, "bottom", "right", "", "");
    }
}

function validarCamposLogin() {
    if ($('#email').val() == "") {
        return "Por favor, indica el usuario. ";
    }
    if ($('#password').val() == "") {
        return "Por favor, indica la contraseña. ";
    }

    return "OK";
}
