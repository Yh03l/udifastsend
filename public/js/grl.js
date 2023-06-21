function ajaxStart(text) {
    let imagengif = $('#imagengif').val();
    if (jQuery('body').find('#resultLoading').attr('id') != 'resultLoading') {
        /* 
        jQuery('body').append('<div id="resultLoading" style="display:none"><div><i class="fa fa-cog fa-spin fa-4x fa-fw"></i><div>' + text + '</div></div><div class="bg"></div></div>');
         */
        jQuery('body').append('<div id="resultLoading" style="display:none"><div><img src="' + imagengif + '" style="width: 150px !important;"></div><div class="bg"></div></div>');
    }

    jQuery('#resultLoading').css({
        'width': '100%',
        'height': '100%',
        'position': 'fixed',
        'z-index': '10000000',
        'top': '0',
        'left': '0',
        'right': '0',
        'bottom': '0',
        'margin': 'auto'
    });

    jQuery('#resultLoading .bg').css({
        'background': '#ffffff',
        'opacity': '0.7',
        'width': '100%',
        'height': '100%',
        'position': 'absolute',
        'top': '0'
    });

    jQuery('#resultLoading>div:first').css({
        'width': '250px',
        'height': '75px',
        'text-align': 'center',
        'position': 'fixed',
        'top': '0',
        'left': '0',
        'right': '0',
        'bottom': '0',
        'margin': 'auto',
        'font-size': '16px',
        'z-index': '10',
        'color': '#ffffff'

    });

    jQuery('#resultLoading .bg').height('100%');
    jQuery('#resultLoading').fadeIn(300);
    jQuery('body').css('cursor', 'wait');
}

function ajaxStop() {
    jQuery('#resultLoading .bg').height('100%');
    jQuery('#resultLoading').fadeOut(300);
    jQuery('body').css('cursor', 'default');
}

function ValidarSoloNumeros(campo) {
    var numeros = /^[0-9]+$/;
    var campo1 = '';
    campo1 = $.trim(campo);
    if (campo.match(numeros) && campo1 != '') {
        return true;
    } else {
        return false;
    }
}

function ValidarDecimales(campo) {
    var numeros = /^[0-9]{1,20}(\,[0-9]{0,2})?$/;
    var campo1 = '';
    campo1 = $.trim(campo);
    if (campo.match(numeros) && campo1 != '') {
        return true;
    } else {
        return false;
    }
}

function ValidarCorreoElectronico(campo) {
    var correo = /[A-Z0-9._%+-]+@[A-Z0-9.-]+.[A-Z]{2,4}/gim;
    var campo1 = '';
    campo1 = $.trim(campo);
    if (campo.match(correo) && campo1 != '') {
        return true;
    } else {
        return false;
    }
}

function ValidarSoloLetras(campo) {
    var letras = /^\s*[a-zA-Z,\s,ñ,á,é,í,ó,ú]+\s*$/;
    var campo1 = '';
    campo1 = $.trim(campo);
    if (campo.match(letras) && campo1 != '') {
        return true;
    } else {
        return false;
    }
}


function isEmpty(val) {
    return val === undefined || val.trim() == null || val.trim().length <= 0 ?
        true :
        false;
}

function isrMinCharacters(val, min_caracteres) {
    return val.trim().length < min_caracteres ?
        true :
        false;
}

function isDiferentTo(val1, val2) {
    return val1.trim().length != val2.trim().length ? true : false;
}

function calcularEdad(fecha) {
    var hoy = new Date();
    var cumpleanos = new Date(fecha);
    var edad = hoy.getFullYear() - cumpleanos.getFullYear();
    var m = hoy.getMonth() - cumpleanos.getMonth();

    if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
        edad--;
    }

    return edad;
}

function isEquals(val1, val2) {
    return val1 === val2 ? true : false;
}

function setCoutDown(intervalTime, divcountDownClassName, btnNameEventEdn) {
    var timer2 = intervalTime;
    $(btnNameEventEdn).prop('hidden', true);
    $(btnNameEventEdn).prop('disabled', true);
    $(divcountDownClassName).prop('hidden', false);

    var interval = setInterval(function() {
        var timer = timer2.split(':');
        //by parsing integer, I avoid all extra string processing
        var minutes = parseInt(timer[0], 10);
        var seconds = parseInt(timer[1], 10);
        --seconds;
        minutes = (seconds < 0) ? --minutes : minutes;

        if (minutes < 0) clearInterval(interval);

        seconds = (seconds < 0) ? 59 : seconds;
        seconds = (seconds < 10) ? '0' + seconds : seconds;

        //minutes = (minutes < 10) ?  minutes : minutes;
        if (minutes + ':' + seconds === '0:00') {
            clearInterval(interval);
            $(divcountDownClassName).prop('hidden', true);
            $(divcountDownClassName).empty();
            $(btnNameEventEdn).prop('hidden', false);
            $(btnNameEventEdn).prop('disabled', false);
        } else {
            $(divcountDownClassName).html(minutes + ':' + seconds);
        }
        timer2 = minutes + ':' + seconds;
    }, 1000);
}