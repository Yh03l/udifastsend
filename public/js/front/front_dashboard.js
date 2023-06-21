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

    cargarPieChart();
});

function cargarTablero(id_estado) {
    let token = $('meta[name="csrf-token"]').attr("content");
    let ruta = route_app + "/ObtenerHTMLParaTableroDashboard";
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
            cargarPieChart();
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

function cargarPieChart() {
    $("#colPieChart").attr("hidden", true);

    (Chart.defaults.global.defaultFontFamily = "Nunito"),
        '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = "#858796";

    // Pie Chart Example
    let porcentajePP = $("#porcentajePP").val();
    let porcentajePC = $("#porcentajePC").val();
    let porcentajePR = $("#porcentajePR").val();

    let ctx = document.getElementById("pieChartDashboard");
    let myPieChart = new Chart(ctx, {
        type: "doughnut",
        data: {
            labels: ["Pendientes", "Completados", "Rechazados"],
            datasets: [
                {
                    data: [porcentajePP, porcentajePC, porcentajePR],
                    backgroundColor: ["#4e73df", "#1cc88a", "#36b9cc"],
                    hoverBackgroundColor: ["#2e59d9", "#17a673", "#2c9faf"],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                },
            ],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: "#dddfeb",
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: false,
            },
            cutoutPercentage: 80,
        },
    });

    if (porcentajePP > 0 || porcentajePC > 0 || porcentajePR > 0) {
        $("#colPieChart").attr("hidden", false);
    }
}
