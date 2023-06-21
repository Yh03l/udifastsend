function AbrirDetalleCita(idCita) {
    /* window.open('{{ config('app.url') }}' + '/Citas/' + idPedido, '_blank'); */
    window.location.replace(route_app + '/Cita/' + idCita);
}

function AbrirPagina(url) {
    window.open(url, '_self');
    //window.location.replace(url);
}

function AbrirOpciones(nroCita, idCita, idReceta, idHC, celularPaciente) {
    $('#opcionesCitaModalLabel').html('');
    $('#opcionesCitaModalLabel').html('Cita Nº ' + nroCita);
    $('#codCM').val(idCita);
    $('#codR').val(idReceta);
    $('#codHC').val(idHC);
    $('#codChat').val(celularPaciente);


    $('#trVerReceta').prop('hidden', true);
    $('#trVerHC').prop('hidden', true);

    if (!isEmpty(idReceta)) {
        $('#trVerReceta').prop('hidden', false);
    }
    if (!isEmpty(idHC)) {
        $('#trVerHC').prop('hidden', false);
    }

    $('#opcionesCitaModal').modal('show');
    //alert(nroCita+idCita+idReceta+idHC+celularPaciente);
}

function opcionCitaMedica() {
    let codCM = $('#codCM').val();
    AbrirPagina(route_app + '/Cita/' + codCM);
}

function opcionReceta() {
    let codR = $('#codR').val();
    AbrirPagina(route_app + '/Receta/' + codR);
}

function opcionHistoriaClinica() {
    let codHC = $('#codHC').val();
    AbrirPagina(route_app + '/Historiaclinica/' + codHC);
}

function opcionChat() {
    let idChat = $('#codChat').val();
    window.open("https://api.whatsapp.com/send?phone=591" + idChat, '_blank');
}

let estadoActual = 1;
let paginaActual = 1;

$(document).ready(function () {

    $('#filtroPendientes').on('click', function () {
        actualizarEstadoActual(1)
        actualizarPaginaActual(1);
        actualizarSeleccionBoton(1);
    });
    $('#filtroAtendidas').on('click', function () {
        actualizarEstadoActual(2)
        actualizarPaginaActual(1);
        actualizarSeleccionBoton(2);
    });
    $('#filtroRechazadas').on('click', function () {
        actualizarEstadoActual(3)
        actualizarPaginaActual(1);
        actualizarSeleccionBoton(3);
    });
});

function cargarTablero(id_estado, pagina) {
    let token = $('meta[name="csrf-token"]').attr('content');
    let ruta = route_app + "/ObtenerHTMLParaTableroCitas";

    ajaxStart("Cargando");
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': token
        },
        type: "POST",
        url: ruta,
        data: {
            id_estado,
            pagina
        },
        success: function (r) {
            ajaxStop();
            $('#tablero').html('');
            $('#tablero').html(r.html);
            $('#pagination').pagination({
                items: r.totalPaginas,
                itemOnPage: 15,
                currentPage: r.paginaActual,
                cssStyle: 'light-theme',
                prevText: 'Anterior',
                nextText: 'Siguiente',
                onInit: function () { },
                onPageClick: function (page, evt) {
                    actualizarPaginaActual(page);
                }
            });
        },
        error: function (h) {
            ajaxStop();
            toastr.error(h, "Error en la comunicación con el servidor");
        }

    });
}

function actualizarPaginaActual(pagina) {
    paginaActual = pagina;
    $('#paginaActual').val(paginaActual);
    estadoActual = obtenerEstadoActual();
    cargarTablero(estadoActual, paginaActual);
}

function actualizarEstadoActual(estado) {
    estadoActual = estado;
    $('#estadoActual').val(estadoActual);
}

function obtenerPaginaActual() {
    return $('#paginaActual').val();
}

function obtenerEstadoActual() {
    return $('#estadoActual').val();
}

function actualizarSeleccionBoton(id_estado) {
    $('#filtroPendientes').removeClass('active');
    $('#filtroPendientes').removeClass('btn-rosa');

    $('#filtroAtendidas').removeClass('active');
    $('#filtroAtendidas').removeClass('btn-rosa');

    $('#filtroRechazadas').removeClass('active');
    $('#filtroRechazadas').removeClass('btn-rosa');

    switch (id_estado) {
        case 1:
            $('#filtroPendientes').addClass('active');
            $('#filtroPendientes').addClass('btn-rosa');
            break;
        case 2:
            $('#filtroAtendidas').addClass('active');
            $('#filtroAtendidas').addClass('btn-rosa');
            break;
        case 3:
            $('#filtroRechazadas').addClass('active');
            $('#filtroRechazadas').addClass('btn-rosa');
            break;
    }
}