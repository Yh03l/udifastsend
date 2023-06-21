let estadoActual = 0;

$(document).ready(function () {
  $("#filtroHoy").on("click", function () {
    actualizarEstadoActual(0);
    actualizarSeleccionBoton(0);
  });
  $("#filtroMes").on("click", function () {
    actualizarEstadoActual(1);
    actualizarSeleccionBoton(1);
  });
  $("#filtroTotal").on("click", function () {
    actualizarEstadoActual(2);
    actualizarSeleccionBoton(2);
  });
});

function cargarTablero(id_estado) {
  let token = $('meta[name="csrf-token"]').attr("content");
  let ruta = route_app + "/ObtenerHTMLParaTableroGanancias";
  ajaxStart("Cargando");
  $.ajax({
    headers: {
      "X-CSRF-TOKEN": token,
    },
    type: "POST",
    url: ruta,
    data: {
      id_estado,
    },
    success: function (r) {
      ajaxStop();
      $("#tablero").html("");
      $("#tablero").html(r.html);
    },
    error: function (h) {
      ajaxStop();
      toastr.error(h, "Error en la comunicación con el servidor");
    },
  });
}

function actualizarEstadoActual(estado) {
  estadoActual = estado;
  $("#estadoActual").val(estadoActual);
  cargarTablero(estadoActual);
}

function actualizarSeleccionBoton(id_estado) {
  $("#filtroHoy").removeClass("active");
  $("#filtroHoy").removeClass("btn-rosa");

  $("#filtroMes").removeClass("active");
  $("#filtroMes").removeClass("btn-rosa");

  $("#filtroTotal").removeClass("active");
  $("#filtroTotal").removeClass("btn-rosa");

  switch (id_estado) {
    case 0:
      $("#filtroHoy").addClass("active");
      $("#filtroHoy").addClass("btn-rosa");
      break;
    case 1:
      $("#filtroMes").addClass("active");
      $("#filtroMes").addClass("btn-rosa");
      break;
    case 2:
      $("#filtroTotal").addClass("active");
      $("#filtroTotal").addClass("btn-rosa");
      break;
  }
}
