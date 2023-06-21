/* IMAGENES DE HC */
let form_HC_adjuntar_imagen = $("#form_HC_adjuntar_imagen");
$('#btnHCAdjuntarImagen').on('click', function () {
    if (!validarFormularioImagen()) {
        return;
    }
    adjuntarImagenAHC();
});

$('#mbtnQuitarImagenHC').on('click', function () {
    let id_imagen = $('#idImagenHCEliminar').val();
    let ruta = route_app + "/eliminarImagenDeHC";

    ajaxStart("Procesando...");
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': token
        },
        type: "POST",
        url: ruta,
        data: {
            id_historia_clinica,
            id_imagen
        },
        success: function (r) {
            ajaxStop();
            if (r.Codigo == '0') {
                $('#QuitarImagenHCModal').modal('hide');
                $('#idImagenHCEliminar').val('');
                $('#listadoImagenesHC').html('');
                $('#listadoImagenesHC').html(r.Data);
                $('#pills-img-registrados-tab').trigger('click');
                toastr.success('Éxito', r.Mensaje, {
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
});

function validarFormularioImagen() {
    if (isEmpty(fileB64)) {
        toastr.error('Seleccione una IMAGEN en formato JPG o JPEG o PNG');
        return false;
    }
    return true;
}

function adjuntarImagenAHC() {
    let ruta = route_app + "/adjuntarImagenAHC";

    let formData = new FormData(form_HC_adjuntar_imagen[0]);
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
                $('#AprobarHCModal').modal('hide');
                $('#listadoImagenesHC').html('');
                $('#listadoImagenesHC').html(r.Data);
                $('#pills-img-registrados-tab').trigger('click');
                removeUpload();
                toastr.success('Éxito', r.Mensaje, {
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

function quitarImagenDeHC(idImagen) {
    $('#idImagenHCEliminar').val(idImagen);
    $('#QuitarImagenHCModal').modal('show');
}