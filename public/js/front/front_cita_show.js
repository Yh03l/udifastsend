$('#btnCitaAceptar').on('click', function () {
    cambiarEstadoCita(1, '')
});
$('#btnCitaRechazar').on('click', function () {
    $('#citaRechazarModal').modal('show');
});
$('#btnCitaEntregar').on('click', function () {
    cambiarEstadoCita(2, '')
});

$('#mbtnCitaRechazar').on('click', function () {
    let motivo = $('#motivoRechazoCita').val();
    if (isEmpty(motivo)) {
        toastr.error('Campo MOTIVO vacío');
        return;
    }
    cambiarEstadoCita(4, motivo)
});

function cambiarEstadoCita(id_estado, motivo_estado) {
    let token = $('meta[name="csrf-token"]').attr('content');
    let ruta = route_app + "/cambiarEstadoCita";

    let id_cita = $('#cita_id').val();
    if (isEmpty(id_cita)) {
        toastr.error('Cita no puede ser procesado');
        return;
    }

    ajaxStart("Procesando...");
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': token
        },
        type: "POST",
        url: ruta,
        data: {
            id_cita,
            id_estado,
            motivo_estado
        },
        success: function (r) {
            ajaxStop();
            if (r.Codigo == '0') {
                if (id_estado == 3) {
                    $('#citaRechazarModal').modal('hide');
                }
                toastr.success(r.Data, r.Mensaje, {
                    timeOut: 2000,
                    fadeOut: 2000,
                    onHidden: function () { }
                });
                location.reload(true);
            } else {
                toastr.error(r.Mensaje, "Error en la solicitud");
            }

        },
        error: function (h) {
            ajaxStop();
            toastr.error(h, "Error en la comunicación con el servidor");
        }
    });
}