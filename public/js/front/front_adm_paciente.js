let token = $('meta[name="csrf-token"]').attr('content');

function pacienteRegistrado(cita_centrosalud, paciente_id, paciente_nombre) {
    $('#paciente_registrado_id_centrosalud').val(cita_centrosalud);
    $('#paciente_registrado_id').val(paciente_id);
    $('#paciente_registrado_nombre').val(paciente_nombre);

    $('#divPacienteRegistrado').prop('hidden', false);
}

$('#btnRegistrarCitaParaPaciente').on("click", function () {
    let registrado_centrosalud = $('#paciente_registrado_id_centrosalud').val();
    let registrado_id = $('#paciente_registrado_id').val();
    let registrado_nombre = $('#paciente_registrado_nombre').val();

    if (isEmpty(registrado_centrosalud)) {
        toastr.error("No se tiene seleccionado un centro de salud para la cita");
    }
    if (isEmpty(registrado_id)) {
        toastr.error("No se tiene seleccionado un centro de salud para la cita");
    }
    if (isEmpty(registrado_nombre)) {
        toastr.error("No se tiene seleccionado un centro de salud para la cita");
    }
    window.open(route_app + '/Cita/createWithUser/' + registrado_centrosalud + '/' + registrado_id, '_cita');
    //window.location.replace('/Cita/createWithUser/'+registrado_centrosalud+'/'+registrado_id);
});

$('#nuevoSeguro').on('click', function () {
    let add_seguro_paciente_id = $('#paciente_registrado_id').val();
    let add_seguro_paciente_nombre = $("#paciente_registrado_nombre").val();
    abrirModalAddSeguroPaciente(add_seguro_paciente_id, add_seguro_paciente_nombre);
});

function SeguroPacienteRegistrado(add_seguro_paciente_id, add_seguro_paciente_nombre) {
    //
}