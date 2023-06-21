let form_create_cita = $("#form_create_cita");

$('.selectpickerPaciente').selectpicker();
$('.selectpickerPacienteSeguro').selectpicker();
$('.selectpickerFrecuenciaPaciente').selectpicker();

$('#cita_centrosalud').change(function() {
    limpiarSelectHorario();
    cargarHorariosDisponibles();
    limpiarSelectPacientes();
    limpiarSelectSegurosPaciente();
    inhabilitarBtnNuevoSeguro();
    limpiarSelectServicios();
    cargarListadoPacientes();
});

$('#cita_paciente_id').change(function() {
    let id_centro_salud = $("#cita_centrosalud").val();

    limpiarSelectSegurosPaciente();
    inhabilitarBtnNuevoSeguro();

    if (id_centro_salud > 0) {
        cargarSegurosCliente();
        habilitarBtnNuevoSeguro();
    }
});

$('#cita_paciente_seguro_id').change(function() {
    let cita_paciente_id = $('#cita_paciente_id').val();

    restaurarPrecioCita();
    limpiarSelectServicios();

    if (cita_paciente_id > 0) {
        habilitarCoberturaManual();
        cargarServiciosMedicos();
    }
});

$('#cita_servicio_medico_id').change(function() {
    let id_servicio_medico = $("#cita_servicio_medico_id").val();

    restaurarPrecioCita();

    if (id_servicio_medico > 0) {
        cargarPrecioCitaMedica();
    }
});

$('#cita_modalidad_id').change(function() {
    let modalidad_cita = $('#cita_modalidad_id').find('option:selected');
    let agregar_direccion = modalidad_cita.attr("agregar_direccion");
    if (agregar_direccion == 1) {
        $("#div_paciente_direccion").prop('hidden', false);
    } else {
        $("#div_paciente_direccion").prop('hidden', true);
    }
});

$('#cita_fecha').change(function() {
    limpiarSelectHorario();
    cargarHorariosDisponibles();
});

/* precios */
$("#precio_descuento_medico").on("change", function() {
    let descuento_cambiado = $("#precio_descuento_medico").val();
    let precio_temp = $("#precio").val();

    if (parseFloat(descuento_cambiado) <= parseFloat(precio_temp)) {
        cargarPrecioCitaMedica();
    } else {
        Swal.fire("El precio del Descuento no puede ser mayor al Precio del Servicio.");
        $("#precio_descuento_medico").val(parseFloat(descuento_temp));
    }
});

$("#porcentaje_cobertura_seguro").on("change", function() {
    let porcentaje_cobertura = parseFloat($("#porcentaje_cobertura_seguro").val());
    if (porcentaje_cobertura > 100 || porcentaje_cobertura < 0) {
        Swal.fire("El porcentaje de cobertura debe estar entre 0-100");
        $("#porcentaje_cobertura_seguro").val(parseFloat(porcentaje_cobertura_temp));
        return;
    }
    let precio_con_descuento = parseFloat($("#precio").val()) - parseFloat($("#precio_descuento_medico")
        .val());

    let precio_cobertura = parseFloat((precio_con_descuento * porcentaje_cobertura) / 100);

    let precio_cita = parseFloat(precio_con_descuento - precio_cobertura);

    porcentaje_cobertura_temp = porcentaje_cobertura;
    precio_cobertura_temp = precio_cobertura;
    $("#porcentaje_cobertura_seguro").val(parseFloat(porcentaje_cobertura_temp));
    $("#precio_cobertura_seguro").val(parseFloat(precio_cobertura_temp));
    $("#precio_cita").val(parseFloat(precio_cita));
    return;
});

$("#precio_cobertura_seguro").on("change", function() {
    let precio_con_descuento = parseFloat($("#precio").val()) - parseFloat($("#precio_descuento_medico")
        .val());
    let precio_cobertura = parseFloat($("#precio_cobertura_seguro").val());
    if (precio_cobertura > precio_con_descuento || precio_cobertura < 0) {
        Swal.fire("El precio de cobertura no debe superar al Precio del Servicio");
        $("#precio_cobertura_seguro").val(parseFloat(precio_cobertura_temp));
        return;
    }

    let porcentaje_cobertura = parseFloat((precio_cobertura / precio_con_descuento) * 100);

    let precio_cita = parseFloat(precio_con_descuento - precio_cobertura);

    porcentaje_cobertura_temp = porcentaje_cobertura;
    precio_cobertura_temp = precio_cobertura;
    $("#porcentaje_cobertura_seguro").val(parseFloat(porcentaje_cobertura_temp));
    $("#precio_cobertura_seguro").val(parseFloat(precio_cobertura_temp));
    $("#precio_cita").val(parseFloat(precio_cita));
    return;
});

$('#btnRegistrarCita').on("click", function() {
    validarFormularioNuevaCita();
});

function cargarListadoPacientes() {
    let id_centro_salud = $("#cita_centrosalud").val();
    let route = route_app + "/ObtenerHTMLParaListadoPacientes";
    ajaxStart("Cargando pacientes");
    $.ajax({
        url: route,
        headers: {
            'X-CSRF-TOKEN': token
        },
        type: 'POST',
        dataType: 'json',
        data: {
            id_centro_salud
        },
        success: function(r) {
            ajaxStop();
            $('.selectpickerPaciente').empty().append(r.html);
            $('.selectpickerPaciente').selectpicker("refresh").trigger('change');
        },
        error: function(h) {
            ajaxStop();
            toastr.error(h, "Error en la comunicación con el servidor");
        }
    });
}

function cargarSegurosCliente() {
    let cita_paciente_id = $('#cita_paciente_id').val();
    let route = route_app + "/ObtenerHTMLParaListadoSegurosPaciente";
    ajaxStart("Cargando seguros del cliente");
    $.ajax({
        url: route,
        headers: {
            'X-CSRF-TOKEN': token
        },
        type: 'POST',
        dataType: 'json',
        data: {
            cita_paciente_id
        },
        success: function(r) {
            ajaxStop();
            $('.selectpickerPacienteSeguro').empty().append(r.html);
            $('.selectpickerPacienteSeguro').val(0).selectpicker("refresh").trigger('change');
        },
        error: function(h) {
            ajaxStop();
            toastr.error(h, "Error en la comunicación con el servidor");
        }
    });
}

function cargarServiciosMedicos() {
    let id_centro_salud = $("#cita_centrosalud").val();
    let id_seguro_paciente = $("#cita_paciente_seguro_id").val();

    let route = route_app + "/ObtenerHTMLParaListadoServiciosMedicos";
    ajaxStart("Cargando servicios médicos");
    $.ajax({
        url: route,
        headers: {
            'X-CSRF-TOKEN': token
        },
        type: 'POST',
        dataType: 'json',
        data: {
            id_seguro_paciente,
            id_centro_salud
        },
        success: function(r) {
            ajaxStop();
            $('#cita_servicio_medico_id').empty().append(r.html);
            $('#cita_servicio_medico_id').trigger('change');
        },
        error: function(h) {
            ajaxStop();
            toastr.error(h, "Error en la comunicación con el servidor");
        }
    });
}

function cargarPrecioCitaMedica() {
    let id_centro_salud = $("#cita_centrosalud").val();
    let id_seguro_paciente = $("#cita_paciente_seguro_id").val();
    let id_servicio_medico = $("#cita_servicio_medico_id").val();
    let precio_descuento_medico = $("#precio_descuento_medico").val();
    let route = route_app + "/ObtenerPrecioCitaMedica";

    ajaxStart("Procesando...");
    $.ajax({
        url: route,
        headers: {
            'X-CSRF-TOKEN': token
        },
        type: 'POST',
        dataType: 'json',
        data: {
            id_centro_salud,
            id_seguro_paciente,
            id_servicio_medico,
            precio_descuento_medico
        },
        success: function(response) {
            ajaxStop();
            if (response.Codigo == '0') {
                $('#precio').val(response.Data.precio_servicio).trigger('change');
                $('#precio_descuento_medico').val(response.Data.precio_descuento_medico);
                descuento_temp = parseFloat(response.Data.precio_descuento_medico);
                $('#porcentaje_cobertura_seguro').val(response.Data.porcentaje_cobertura_seguro);
                porcentaje_cobertura_temp = parseFloat(response.Data.porcentaje_cobertura_seguro);
                $('#precio_cobertura_seguro').val(response.Data.precio_cobertura_seguro);
                precio_cobertura_temp = parseFloat(response.Data.precio_cobertura_seguro);
                $('#precio_cita').val(response.Data.precio_cita);
            } else {
                toastr.error(response.Mensaje, "No se puede proceder");
            }
        },
        error: function(h) {
            ajaxStop();
            toastr.error(h, "Error en la comunicación con el servidor");
        }
    });

}

function cargarHorariosDisponibles() {
    let id_centro_salud = $("#cita_centrosalud").val();
    let fecha = $("#cita_fecha").val();
    let route = route_app + "/ObtenerHTMLParaListadoHorarioDisponible";

    ajaxStart("Cargando horarios");
    $.ajax({
        url: route,
        headers: {
            'X-CSRF-TOKEN': token
        },
        type: 'POST',
        dataType: 'json',
        data: {
            fecha,
            id_centro_salud
        },
        success: function(r) {
            ajaxStop();
            $('#cita_hora').append(r.html);
        },
        error: function(h) {
            ajaxStop();
            toastr.error(h, "Error en la comunicación con el servidor");
        }
    });

}

function habilitarCoberturaManual() {
    let id_seguro = $('#cita_paciente_seguro_id').val();
    if (id_seguro > 0) {
        $('#porcentaje_cobertura_seguro').prop('readonly', false);
        $('#precio_cobertura_seguro').prop('readonly', false);
    } else {
        $('#porcentaje_cobertura_seguro').prop('readonly', true);
        $('#precio_cobertura_seguro').prop('readonly', true);
    }
}

function habilitarBtnNuevoSeguro() {
    let cita_paciente_id = $('#cita_paciente_id').val();
    if (cita_paciente_id && cita_paciente_id > 0) {
        $('#nuevoSeguro').prop('disabled', false);
    } else {
        $('#nuevoSeguro').prop('disabled', true);
    }
}

function inhabilitarBtnNuevoSeguro() {
    $('#nuevoSeguro').prop('disabled', true);
}

function limpiarSelectPacientes() {
    $('.selectpickerPaciente').empty().append('<option value="0" selected>Seleccionar Paciente</option>')
        .selectpicker("refresh");
    $('.selectpickerPaciente').val(0).selectpicker("refresh").trigger('change');
}

function limpiarSelectSegurosPaciente() {
    $('.selectpickerPacienteSeguro').empty().append(
        '<option data-tokens="NINGUNO" value="0" selected>Proceder sin seguro</option>').selectpicker("refresh");
    $('.selectpickerPacienteSeguro').val(0).selectpicker("refresh");
}

function limpiarSelectServicios() {
    $('#cita_servicio_medico_id').empty().append(
        '<option data-tokens="NINGUNO" value="0" selected>Sin servicios disponibles</option>');
    $('#cita_servicio_medico_id').val(0).trigger('change');
}

function limpiarSelectHorario() {
    $('#cita_hora').empty();
}

function restaurarPrecioCita() {
    $('#porcentaje_cobertura_seguro').val(0);
    $('#precio_cobertura_seguro').val(0);
    $('#precio_cita').val(0);
    $('#precio').val(0).trigger('change');
}

function validarFormularioNuevaCita() {
    let id_centro_salud = $("#cita_centrosalud").val();
    if (isEmpty(id_centro_salud) || id_centro_salud == 0) {
        toastr.error("Seleccione un Centro de Salud");
        return;
    }
    let id_paciente = $("#cita_paciente_id").val();
    if (isEmpty(id_paciente) || id_paciente == 0) {
        toastr.error("Seleccione un Paciente");
        return;
    }
    let id_frecuencia_paciente = $("#cita_frecuencia_paciente").val();
    if (isEmpty(id_frecuencia_paciente) || id_frecuencia_paciente == 0) {
        toastr.error("Seleccione la Frecuencia del paciente");
        return;
    }
    let id_servicio_medico = $("#cita_servicio_medico_id").val();
    if (isEmpty(id_servicio_medico) || id_servicio_medico == 0) {
        toastr.error("Seleccione un Servicio Médico");
        return;
    }
    let fecha = $("#cita_fecha").val();
    if (isEmpty(fecha)) {
        toastr.error("Seleccione una Fecha");
        return;
    }
    let hora = $("#cita_hora").val();
    if (isEmpty(hora)) {
        toastr.error("Seleccione una Hora");
        return;
    }
    let cita_modalidad_id = $("#cita_modalidad_id").val();
    if (isEmpty(cita_modalidad_id) || cita_modalidad_id == 0) {
        toastr.error("Seleccione una Modalidad de Atención");
        return;
    }

    registrarCitaMedica();
}

function registrarCitaMedica() {
    let route = route_app + "/Cita";

    let cita_centrosalud = $('#cita_centrosalud').find('option:selected');
    let cita_id_unidad_negocio = cita_centrosalud.attr("id_unidad_negocio");

    let formData = new FormData(form_create_cita[0]);
    formData.append('id_unidad_negocio', cita_id_unidad_negocio);

    ajaxStart("Procesando");
    $.ajax({
        url: route,
        headers: {
            'X-CSRF-TOKEN': token
        },
        type: 'POST',
        dataType: 'json',
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        success: function(r) {
            ajaxStop();
            if (r.Codigo == '0') {
                toastr.success(r.Mensaje);
                form_create_cita.trigger("reset");
                window.location.reload(true);
            } else {
                toastr.error(r.Mensaje, "No se puede proceder");
            }
        },
        error: function(h) {
            ajaxStop();
            toastr.error(h, "Error en la comunicación con el servidor");
        }
    });
}


function pacienteRegistrado(cita_centrosalud, paciente_id, paciente_nombre) {

    $('#busquedaPacienteModal').modal('hide');

    $('.selectpickerPaciente').append(
        '<option value="' + paciente_id + '" selected>' + paciente_nombre + '</option>'
    );
    $('.selectpickerPaciente').val(paciente_id).selectpicker("refresh").trigger('change');
}

$('#nuevoSeguro').on('click', function() {
    let add_seguro_paciente_id = $('#cita_paciente_id').val();
    let add_seguro_paciente_nombre = $("#cita_paciente_id option:selected").text();
    abrirModalAddSeguroPaciente(add_seguro_paciente_id, add_seguro_paciente_nombre);
});

function SeguroPacienteRegistrado(add_seguro_paciente_id, add_seguro_paciente_nombre) {
    cargarSegurosCliente();
}