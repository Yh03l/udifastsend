let token = $('meta[name="csrf-token"]').attr('content');

let form_receta = $("#form_receta");
let form_receta_adjuntar_medicamento = $("#form_receta_adjuntar_medicamento");

let id_cita = $("#cita_id").val();
let id_receta = $("#receta_id").val();

$('#btnRecetaAprobar').on('click', function () {
    if (!validarFormularioReceta()) {
        return;
    }
    $('#AprobarRecetaModal').modal('show');
});

$('#mbtnAprobarReceta').on('click', function () {
    if (!validarFormularioReceta()) {
        return;
    }
    aprobarReceta();
});

$('#btnRecetaGuardar').on('click', function () {
    if (!validarFormularioReceta()) {
        return;
    }
    actualizarReceta();
});

$('#receta_fecha_inicio').change(function () {
    habilitarBotonGuardarReceta();
});
$('#receta_fecha_fin').change(function () {
    habilitarBotonGuardarReceta();
});
$('#receta_notas').change(function () {
    habilitarBotonGuardarReceta();
});
$('#receta_comentario').change(function () {
    habilitarBotonGuardarReceta();
});

$('#btnRecetaAgregarMedicamento').on('click', function () {
    $('#busquedaMedicamentoModal').modal('show');
});

$('#mbtnBuscarMedicamento').on('click', function () {
    let mBusquedaNombre = $('#mBusquedaNombre').val();
    buscarMedicamentoParaReceta(mBusquedaNombre);
});

function validarFormularioReceta() {

    let receta_fecha_inicio = $("#receta_fecha_inicio").val();
    let receta_fecha_fin = $("#receta_fecha_fin").val();

    if (isEmpty(receta_fecha_inicio)) {
        toastr.error('Seleccione una fecha de inicio para el periodo de validez');
        return false;
    }
    if (isEmpty(receta_fecha_fin)) {
        toastr.error('Seleccione una fecha de caducidad para el periodo de validez');
        return false;
    }

    return true;
}

function actualizarReceta() {
    let ruta = route_app + "/actualizarReceta";

    let formData = new FormData(form_receta[0]);
    formData.append('id_cita', id_cita);
    formData.append('id_receta', id_receta);

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
                deshabilitarBotonGuardarReceta();
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



function aprobarReceta() {
    let ruta = route_app + "/aprobarReceta";

    ajaxStart("Procesando...");
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': token
        },
        type: "POST",
        url: ruta,
        data: {
            id_receta
        },
        success: function (r) {
            ajaxStop();
            if (r.Codigo == '0') {
                $('#AprobarRecetaModal').modal('hide');
                toastr.success(r.Data, r.Mensaje, {
                    timeOut: 2000,
                    fadeOut: 2000,
                    onHidden: function () {
                        location.reload(true);
                    }
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

function habilitarBotonGuardarReceta() {
    $('#btnRecetaGuardar').prop('disabled', false);
}

function deshabilitarBotonGuardarReceta() {
    $('#btnRecetaGuardar').prop('disabled', true);
}

let form_receta_adjuntar_imagen = $("#form_receta_adjuntar_imagen");

$('#btnRecetaAdjuntarImagen').on('click', function () {
    if (!validarFormularioImagen()) {
        return;
    }
    adjuntarImagenAReceta();
});

function validarFormularioImagen() {
    if (isEmpty(fileB64)) {
        toastr.error('Seleccione una IMAGEN en formato JPG o JPEG o PNG');
        return false;
    }
    return true;
}

function adjuntarImagenAReceta() {
    let ruta = route_app + "/adjuntarImagenAReceta";

    let formData = new FormData(form_receta_adjuntar_imagen[0]);
    formData.append('id_cita', id_cita);
    formData.append('id_receta', id_receta);

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
                $('#AprobarRecetaModal').modal('hide');
                $('#listadoImagenesReceta').html('');
                $('#listadoImagenesReceta').html(r.Data);
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

function quitarImagenDeReceta(idImagen) {
    $('#idImagenRecetaEliminar').val(idImagen);
    console.log(idImagen);
    $('#QuitarImagenRecetaModal').modal('show');
}

$('#mbtnQuitarImagenReceta').on('click', function () {
    let id_imagen = $('#idImagenRecetaEliminar').val();
    let ruta = route_app + "/eliminarImagenAReceta";

    ajaxStart("Procesando...");
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': token
        },
        type: "POST",
        url: ruta,
        data: {
            id_receta,
            id_imagen
        },
        success: function (r) {
            ajaxStop();
            if (r.Codigo == '0') {
                $('#QuitarImagenRecetaModal').modal('hide');
                $('#idImagenRecetaEliminar').val('');
                $('#listadoImagenesReceta').html('');
                $('#listadoImagenesReceta').html(r.Data);
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

function buscarMedicamentoParaReceta(mBusquedaNombre) {
    let ruta = route_app + "/ObtenerHTMLParaBusquedaMedicamento";

    ajaxStart("Procesando...");
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': token
        },
        type: "POST",
        url: ruta,
        data: {
            mBusquedaNombre
        },
        success: function (r) {
            ajaxStop();
            $('#tablaResultadoBusqueda').html('');
            $('#tablaResultadoBusqueda').html(r.html);
        },
        error: function (h) {
            ajaxStop();
            toastr.error(h, "Error en la comunicación con el servidor");
        }
    });
}

function seleccionarMedicamentoParaReceta(id_vademecum, nombre) {
    $('#med_id_vademecum').val(id_vademecum);
    $('#med_nombre').val(nombre);
    $('#formRegistroMedicamentoModal').modal('show');

}

$('#mbtnAgregarMedicamentoReceta').on('click', function () {
    if (!validarFormularioRegistroMedicamento()) {
        return;
    }
    adjuntarMedicamentoAReceta();
});

function validarFormularioRegistroMedicamento() {
    let med_id_vademecum = $("#med_id_vademecum").val();
    let med_dosificacion = $("#med_dosificacion").val();
    let med_frecuencia = $("#med_frecuencia").val();
    let med_duracion = $("#med_duracion").val();

    if (isEmpty(med_id_vademecum)) {
        toastr.error('Seleccione un medicamento');
        return false;
    }
    if (isEmpty(med_dosificacion)) {
        toastr.error('Ingrese una dosificación');
        return false;
    }
    if (isEmpty(med_frecuencia)) {
        toastr.error('Seleccione una frecuencia');
        return false;
    }
    if (isEmpty(med_duracion)) {
        toastr.error('Ingrese la duración');
        return false;
    }

    return true;
}

function adjuntarMedicamentoAReceta() {
    let ruta = route_app + "/adjuntarMedicamentoAReceta";

    let formData = new FormData(form_receta_adjuntar_medicamento[0]);
    formData.append('id_cita', id_cita);
    formData.append('id_receta', id_receta);

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
                form_receta_adjuntar_medicamento.trigger("reset");
                $('#formRegistroMedicamentoModal').modal('hide');
                $('#listadoMedicamentosReceta').html('');
                $('#listadoMedicamentosReceta').html(r.Data);
                $('#pills-registrados-tab').trigger('click');
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

function quitarMedicamentoDeReceta(idMedicamento) {
    $('#idMedicamentoRecetaEliminar').val(idMedicamento);
    console.log(idMedicamento);
    $('#QuitarMedicamentoRecetaModal').modal('show');
}

$('#mbtnQuitarMedicamentoReceta').on('click', function () {
    let id_detalle_receta = $('#idMedicamentoRecetaEliminar').val();
    let ruta = route_app + "/eliminarMedicamentoDeReceta";

    ajaxStart("Procesando...");
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': token
        },
        type: "POST",
        url: ruta,
        data: {
            id_receta,
            id_detalle_receta
        },
        success: function (r) {
            ajaxStop();
            if (r.Codigo == '0') {
                $('#QuitarMedicamentoRecetaModal').modal('hide');
                $('#idMedicamentoRecetaEliminar').val('');
                $('#listadoMedicamentosReceta').html('');
                $('#listadoMedicamentosReceta').html(r.Data);
                $('#pills-registrados-tab').trigger('click');
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