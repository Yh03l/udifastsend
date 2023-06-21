
let token = $('meta[name="csrf-token"]').attr('content');
let id_cita = $('#cita_id').val();
let id_historia_clinica = $('#id_historia_clinica').val();

$('#btnHCAprobar').on('click', function () {
    const elementNotaHC = document.getElementById('btnHCGuardar');
    if (!elementNotaHC.disabled) {
        toastr.error('Primero, Guarda los datos de la Nota');
        return false;
    }
    const elementFormHC = document.getElementById('btnGuardarFormularioHC');
    if (!elementFormHC.disabled) {
        toastr.error('Primero, Guarda los datos del formulario de Historia Clínica');
        return false;
    }

    $('#AprobarHCModal').modal('show');
});

$('#mbtnAprobarHC').on('click', function () {
    aprobarHC();
});

function aprobarHC() {
    let ruta = route_app + "/aprobarHC";
    let formData = new FormData();
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
                toastr.success(r.Mensaje, 'Éxito', {
                    timeOut: 2000,
                    fadeOut: 2000,
                    onHidden: function () { }
                });
                window.location.replace(route_app + '/Historiaclinica/' + r.Data);
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