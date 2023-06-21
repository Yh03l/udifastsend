$("#permite_chat").change(function () {
  habilitarBotonGuardarConfiguracion();
});
$("#permite_llamada").change(function () {
  habilitarBotonGuardarConfiguracion();
});
$("#medico_solidario").change(function () {
  habilitarBotonGuardarConfiguracion();
});
$("#medico_domicilio").change(function () {
  habilitarBotonGuardarConfiguracion();
});

$("#mbtnCambiarContrasena").on("click", function () {
  let passActual = $("#passActual").val();
  let passNueva = $("#passNueva").val();
  let passRepetida = $("#passNuevaVerificacion").val();

  if (isEmpty(passActual)) {
    toastr.error("Contraseña Actual vacía");
    return;
  }
  if (isEmpty(passNueva)) {
    toastr.error("Contraseña Nueva vacía");
    return;
  }
  if (isEmpty(passRepetida)) {
    toastr.error("Repita su Contraseña Nueva");
    return;
  }
  if (isrMinCharacters(passNueva, 6)) {
    toastr.error("Contraseña Nueva debe tener min 6 caracteres");
    return;
  }
  if (isDiferentTo(passNueva, passRepetida)) {
    toastr.error("Contraseña Nueva y de Confirmación no coinciden");
    return;
  }
  cambiarPassword(passActual, passNueva);
});

$("#mbtnCambiarConfiguracionMedico").on("click", function () {
  let permite_chat = $("#permite_chat").is(":checked") ? 1 : 0;
  let permite_llamada = $("#permite_llamada").is(":checked") ? 1 : 0;
  let medico_solidario = $("#medico_solidario").is(":checked") ? 1 : 0;
  let medico_domicilio = $("#medico_domicilio").is(":checked") ? 1 : 0;

  let archivo64 = null;

  let token = $('meta[name="csrf-token"]').attr("content");
  let ruta = route_app + "/Perfil/actualizarPerfilMedico";

  ajaxStart("Procesando...");
  $.ajax({
    headers: {
      "X-CSRF-TOKEN": token,
    },
    type: "POST",
    url: ruta,
    data: {
      permite_chat,
      permite_llamada,
      medico_solidario,
      medico_domicilio,
      archivo64,
    },
    success: function (r) {
      ajaxStop();
      if (r.Codigo == "0") {
        deshabilitarBotonGuardarConfiguracion();
        toastr.success(r.Data, r.Mensaje, {
          timeOut: 2000,
          fadeOut: 2000,
          onHidden: function () { },
        });
      } else {
        toastr.error(r.Mensaje, "Error en la solicitud");
      }
    },
    error: function (h) {
      ajaxStop();
      toastr.error(h, "Error en la comunicación con el servidor");
    },
  });
});

function cambiarPassword(passActual, passNueva) {
  let token = $('meta[name="csrf-token"]').attr("content");
  let ruta = route_app + "/Perfil/cambiarPassword";

  ajaxStart("Procesando...");
  $.ajax({
    headers: {
      "X-CSRF-TOKEN": token,
    },
    type: "POST",
    url: ruta,
    data: {
      passActual,
      passNueva,
    },
    success: function (r) {
      ajaxStop();
      if (r.Codigo == "0") {
        $("#cambiarPasswordNModal").modal("hide");
        $("#passActual").val("");
        $("#passNueva").val("");
        $("#passNuevaVerificacion").val("");
        toastr.success(r.Data, r.Mensaje, {
          timeOut: 2000,
          fadeOut: 2000,
          onHidden: function () { },
        });
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

function cambiarPassword(passActual, passNueva) {
  let token = $('meta[name="csrf-token"]').attr("content");
  let ruta = route_app + "/Perfil/cambiarPassword";

  ajaxStart("Procesando...");
  $.ajax({
    headers: {
      "X-CSRF-TOKEN": token,
    },
    type: "POST",
    url: ruta,
    data: {
      passActual,
      passNueva,
    },
    success: function (r) {
      ajaxStop();
      if (r.Codigo == "0") {
        $("#cambiarPasswordNModal").modal("hide");
        toastr.success(r.Data, r.Mensaje, {
          timeOut: 2000,
          fadeOut: 2000,
          onHidden: function () { },
        });
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

function habilitarBotonGuardarConfiguracion() {
  $("#mbtnCambiarConfiguracionMedico").prop("hidden", false);
}

function deshabilitarBotonGuardarConfiguracion() {
  $("#mbtnCambiarConfiguracionMedico").prop("hidden", true);
}
