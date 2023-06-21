let form_add_seguro_paciente = $("#form_add_seguro_paciente");

function abrirModalAddSeguroPaciente(add_seguro_paciente_id, add_seguro_paciente_nombre) {
    $('#add_seguro_paciente_id').val(add_seguro_paciente_id);
    $('#add_seguro_paciente_nombre').val(add_seguro_paciente_nombre);
    $('#mAddSeguroPacienteModalLabel').html('');
    $('#mAddSeguroPacienteModalLabel').html(add_seguro_paciente_nombre);

    $('#mAddSeguroPacienteModal').modal('show');
}

$('#add_seguro_id').on('change', function () {
    cargarListadoTiposSeguro();
});

function cargarListadoTiposSeguro() {
    let add_seguro_id = $('#add_seguro_id').val();
    let route = route_app + "/ObtenerHTMLParaListadoTiposSeguro";
    ajaxStart("Cargando...");
    $.ajax({
        url: route,
        headers: {
            'X-CSRF-TOKEN': token
        },
        type: 'POST',
        dataType: 'json',
        data: {
            add_seguro_id
        },
        success: function (r) {
            ajaxStop();
            $('#add_seguro_grupo_id').empty().append(r.html);
        },
        error: function (h) {
            ajaxStop();
            toastr.error(h, "Error en la comunicación con el servidor");
        }
    });
}

$('#btnRegistrarSeguroPaciente').on('click', function () {
    AddNuevoSeguroPaciente();
});

function AddNuevoSeguroPaciente() {
    let add_seguro_paciente_id = $('#add_seguro_paciente_id').val();
    let add_seguro_paciente_nombre = $('#add_seguro_paciente_nombre').val();
    let add_seguro_id = $('#add_seguro_id').val();
    let add_seguro_grupo_id = $('#add_seguro_grupo_id').val();
    let add_seguro_codigo = $('#add_seguro_codigo').val();
    let add_seguro_nro = $('#add_seguro_nro').val();

    let validacion = validarDatosSeguroStore(add_seguro_paciente_id, add_seguro_id, add_seguro_grupo_id,
        add_seguro_codigo);
    if (!validacion) {
        return;
    }

    let formData = new FormData(form_add_seguro_paciente[0]);

    let route = route_app + "/AdmPaciente/registrarSeguroPaciente";

    ajaxStart("Procesando...");
    $.ajax({
        url: route,
        headers: {
            'X-CSRF-TOKEN': token
        },
        type: 'POST',
        dataType: 'json',
        cache: false,
        processData: false,
        contentType: false,
        data: formData,
        success: function (r) {
            ajaxStop();
            if (r.Codigo == '0') {
                toastr.success(r.Mensaje);
                $('#mAddSeguroPacienteModal').modal('hide');
                form_add_seguro_paciente.trigger("reset");
                SeguroPacienteRegistrado(add_seguro_paciente_id, add_seguro_paciente_nombre);
            } else {
                toastr.error(r.Mensaje, "No se puede proceder");
            }
        },
        error: function () {
            ajaxStop();
            Swal.fire({
                title: "ERROR AL GUARDAR SEGURO",
                type: "error",
                showConfirmButton: false,
                closeOnConfirm: false,
                timer: 1000
            });
        }
    });

}

function validarDatosSeguroStore(add_seguro_paciente_id, add_seguro_id, add_seguro_grupo_id, add_seguro_codigo) {
    if (isEmpty(add_seguro_paciente_id) || add_seguro_paciente_id == 0) {
        toastr.error("Seleccione un Paciente");
        return false;
    }
    if (isEmpty(add_seguro_id) || add_seguro_id == 0) {
        toastr.error("Seleccione un seguro");
        return false;
    }
    if (isEmpty(add_seguro_grupo_id) || add_seguro_grupo_id == 0) {
        toastr.error("Seleccione tipo de seguro");
        return false;
    }
    if (isEmpty(add_seguro_codigo)) {
        toastr.error("Ingrese el código del seguro");
        return false;
    }
    return true;
}