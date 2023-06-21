/* NOTAS DE LA HC */
let form_Nota_HC = $("#form_Nota_HC");
$('#HC_notas').on('change', function () {
    let nota = $('#HC_notas').val();
    if (!isEmpty(nota)) {
        habilitarBotonHCGuardar();
    }
});

function habilitarBotonHCGuardar() {
    $('#btnHCGuardar').prop('disabled', false);
}

function deshabilitarBotonHCGuardar() {
    $('#btnHCGuardar').prop('disabled', true);
}

$('#btnHCGuardar').on('click', function () {
    guardarNotaDeHC();
});

function guardarNotaDeHC() {
    let ruta = route_app + "/actualizarNotaHC";

    let formData = new FormData(form_Nota_HC[0]);
    formData.append('id_cita', id_cita);
    formData.append('id_historia_clinica', id_historia_clinica);

    ajaxStart("Procesando...");
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': token
        },
        type: "POST",
        url: ruta,
        dataType: 'json',
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        success: function (r) {
            ajaxStop();
            if (r.Codigo == '0') {
                deshabilitarBotonHCGuardar();
                toastr.success(r.Data, r.Mensaje, {
                    timeOut: 2000,
                    fadeOut: 2000,
                    onHidden: function () { }
                });
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