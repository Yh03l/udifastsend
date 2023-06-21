/* HISTORIA CLINICA */
$(function () {
    $('input[type="text"]').change(function () {
        this.value = $.trim(this.value);
    });
});

function habilitarBotonGuardar() {
    $('#btnGuardarFormularioHC').prop('disabled', false);
}

function deshabilitarBotonGuardar() {
    $('#btnGuardarFormularioHC').prop('disabled', true);
}

let form_HC = $("#form_HC");
$('#btnGuardarFormularioHC').on('click', function () {
    guardarDatosFormHC();
});

function guardarDatosFormHC() {
    let ruta = route_app + "/guardarDatosFormHC";

    let formData = new FormData(form_HC[0]);
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
                deshabilitarBotonGuardar();
                toastr.success(r.Mensaje, 'Exito', {
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