let form_create_paciente = $("#form_create_paciente");
$("#admpac_fechanacimiento").change(function () {
    let edad = calcularEdad($(this).val());
    $("#admpac_edad").val(edad);
});

$("#admpac_nombre").change(function () {
    let dato = $(this).val().trim() + " " + $("#admpac_apellidos").val().trim();
    let actual = $("#admpac_razonsocial").val().trim();
    if (isEmpty(actual)) {
        $("#admpac_razonsocial").val(dato);
    }
});

$("#admpac_apellidos").change(function () {
    let dato = $("#admpac_nombre").val().trim() + " " + $(this).val().trim();
    let actual = $("#admpac_razonsocial").val().trim();
    if (isEmpty(actual)) {
        $("#admpac_razonsocial").val(dato);
    } else {
        if (actual == $("#admpac_nombre").val().trim()) {
            $("#admpac_razonsocial").val(dato);
        }
    }
});

$("#admpac_ci").change(function () {
    let dato = $(this).val().trim();
    let actual = $("#admpac_nit").val().trim();
    if (isEmpty(actual)) {
        $("#admpac_nit").val(dato);
    }
});

$("#btnRegistrarPaciente").on("click", function () {
    let adm_centro_salud = $("#adm_centro_salud").val().trim();
    let admpac_nombre = $("#admpac_nombre").val().trim();
    let admpac_apellidos = $("#admpac_apellidos").val().trim();
    let admpac_cod = $("#admpac_cod").val().trim();
    let admpac_ci = $("#admpac_ci").val().trim();
    let admpac_ext = $("#admpac_ext").val().trim();
    let admpac_fechanacimiento = $("#admpac_fechanacimiento").val().trim();
    let admpac_genero = $("#admpac_genero").val().trim();
    let admpac_ciudad = $("#admpac_ciudad").val().trim();
    let admpac_celular = $("#admpac_celular").val().trim();
    let admpac_email = $("#admpac_email").val().trim();
    let admpac_razonsocial = $("#admpac_razonsocial").val().trim();
    let admpac_nit = $("#admpac_nit").val().trim();

    if (isEmpty(adm_centro_salud)) {
        toastr.error("Seleccione un Centro de Salud para la admisión");
        return;
    }
    if (isEmpty(admpac_nombre)) {
        toastr.error("Campo NOMBRE vacío");
        return;
    }
    if (isEmpty(admpac_apellidos)) {
        toastr.error("Campo APELLIDO vacío");
        return;
    }
    if (isEmpty(admpac_ci)) {
        toastr.error("Campo CI vacío");
        return;
    }
    if (isEmpty(admpac_fechanacimiento)) {
        toastr.error("Campo FECHA DE NACIMIENTO vacío");
        return;
    }
    if (isEmpty(admpac_genero)) {
        toastr.error("Campo GÉNERO vacío");
        return;
    }
    if (isEmpty(admpac_ciudad)) {
        toastr.error("Campo CIUDAD vacío");
        return;
    }
    if (isEmpty(admpac_celular)) {
        toastr.error("Campo CELULAR vacío");
        return;
    }
    if (!isEmpty(admpac_email)) {
        if (!ValidarCorreoElectronico(admpac_email)) {
            toastr.error("Campo CORREO erróneo");
            return;
        }
    }
    
    registrarPaciente();
});

function registrarPaciente() {
    let token = $('meta[name="csrf-token"]').attr("content");
    let ruta = route_app + "/AdmPaciente/registrarPaciente";
    let adm_centro_salud = $("#adm_centro_salud").val().trim();
    let formData = new FormData(form_create_paciente[0]);

    ajaxStart("Procesando...");
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": token,
        },
        type: "POST",
        dataType: "json",
        url: ruta,
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        success: function (r) {
            ajaxStop();
            if (r.Codigo == "0") {
            
                toastr.success(r.Data, r.Mensaje, {
                    timeOut: 2000,
                    fadeOut: 2000,
                    onHidden: function () { },
                });

                let paciente = r.Data;

                pacienteRegistrado(
                    adm_centro_salud,
                    paciente.id,
                    paciente.nombre +
                    " " +
                    paciente.apellidos +
                    " [CI:" +
                    paciente.ci +
                    "]"
                );

                form_create_paciente.trigger("reset");
            } else {
                toastr.error(r.Mensaje, "Error en la solicitud");
            }
        },
        error: function (h) {
            ajaxStop();
            toastr.error(h, "Error en la comunicación con el servidor");
        },
    });
}
