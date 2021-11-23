/****************************************************
 * Notificaciones
 ****************************************************/
function showNotification(colorName, text, placementFrom, placementAlign, animateEnter, animateExit) {
    if (colorName === null || colorName === '') {
        colorName = 'bg-black';
    }
    if (text === null || text === '') {
        text = 'Turning standard Bootstrap alerts';
    }
    if (animateEnter === null || animateEnter === '') {
        animateEnter = 'animated fadeInDown';
    }
    if (animateExit === null || animateExit === '') {
        animateExit = 'animated fadeOutUp';
    }
    var allowDismiss = true;

    $.notify({
        message: text
    },
        {
            type: colorName,
            allow_dismiss: allowDismiss,
            newest_on_top: true,
            timer: 100,
            z_index: 1500,
            placement: {
                from: placementFrom,
                align: placementAlign
            },
            animate: {
                enter: animateEnter,
                exit: animateExit
            },
            template: '<div class="alert alert-warning">' + text +
                ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>' +
                '</div>'
        });
}

/****************************************************
 *              Validaciones
 ****************************************************/
function validarCamposLetras(valor) {
    const WHITE_LIST_MAY = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "Ñ", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];
    const WHITE_LIST_MIN = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "ñ", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"];
    const WHITE_LIST_NUM = [".", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "-", " ", "@", "_"];
    const WHITE_LIST_EXC = ["Á", "É", "Í", "Ó", "Ú", "á", "é", "í", "ó", "ú"];

    str = '';

    if (valor.length > 0) {
        for (let i of valor) {
            str += WHITE_LIST_MAY.indexOf(i) > -1 ? i : '';
            str += WHITE_LIST_MIN.indexOf(i) > -1 ? i : '';
            str += WHITE_LIST_NUM.indexOf(i) > -1 ? i : '';
            str += WHITE_LIST_EXC.indexOf(i) > -1 ? i : '';
        }
    } else
        str = '0';

    return str;
}

function validarEmail(valor) {
    re = /^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/
    if (!re.exec(valor)) {
        return "error";
    }
    else {
        return "ok";
    };
}