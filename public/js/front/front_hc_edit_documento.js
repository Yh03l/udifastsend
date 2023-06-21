/* IMAGENES DE HC */
let form_HC_adjuntar_documento = $("#form_HC_adjuntar_documento");
$('#btnHCAdjuntarDocumento').on('click', function() {
    if (!validarFormularioDocumento()) {
        return;
    }
    adjuntarDocumentoAHC();
});

$('#mbtnQuitarDocumentoHC').on('click', function() {
    let id_documento = $('#idDocumentoHCEliminar').val();
    let ruta = route_app + "/eliminarDocumentoDeHC";

    ajaxStart("Procesando...");
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': token
        },
        type: "POST",
        url: ruta,
        data: {
            id_historia_clinica,
            id_documento
        },
        success: function(r) {
            ajaxStop();
            if (r.Codigo == '0') {
                $('#QuitarDocumentoHCModal').modal('hide');
                $('#idDocumentoHCEliminar').val('');
                $('#listadoDocumentosHC').html('');
                $('#listadoDocumentosHC').html(r.Data);
                $('#pills-doc-registrados-tab').trigger('click');
                toastr.success('Éxito', r.Mensaje, {
                    timeOut: 2000,
                    fadeOut: 2000,
                    onHidden: function() {}
                });
            } else {
                toastr.error(r.Mensaje, "Error en la solicitud");
            }

        },
        error: function(h) {
            ajaxStop();
            toastr.error(h, "Error en la comunicación con el servidor");
        }
    });
});

function validarFormularioDocumento() {
    if (isEmpty(fileB64_aux)) {
        toastr.error('Seleccione un documento en formato WORD, EXCEL, PDF o TXT');
        return false;
    }
    return true;
}

function adjuntarDocumentoAHC() {
    let ruta = route_app + "/adjuntarDocumentoAHC";

    let formData = new FormData(form_HC_adjuntar_documento[0]);
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
        success: function(r) {
            ajaxStop();
            if (r.Codigo == '0') {
                $('#AprobarHCModal').modal('hide');
                $('#listadoDocumentosHC').html('');
                $('#listadoDocumentosHC').html(r.Data);
                $('#pills-doc-registrados-tab').trigger('click');
                removeUpload_aux();
                toastr.success('Éxito', r.Mensaje, {
                    timeOut: 2000,
                    fadeOut: 2000,
                    onHidden: function() {}
                });
            } else {
                toastr.error(r.Mensaje, "Error en la solicitud");
            }

        },
        error: function(h) {
            ajaxStop();
            toastr.error(h, "Error en la comunicación con el servidor");
        }
    });
}

function quitarDocumentoDeHC(idDocumento) {
    $('#idDocumentoHCEliminar').val(idDocumento);
    $('#QuitarDocumentoHCModal').modal('show');
}