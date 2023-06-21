let token = $('meta[name="csrf-token"]').attr('content');
$('#btnRegistrarPlantilla').on('click', function () {
    $('#AsignarPlantillaModal').modal('show');
});

$('#mbtnAsignarPlantilla').on('click', function () {
    asginarHC();
});

function asginarHC() {
    let ruta = route_app + "/asignarPlantillaParaHC";
    let form_create_hc = $("#form_create_hc");
    let formData = new FormData(form_create_hc[0]);

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
                toastr.success(r.Mensaje, 'Éxito', {
                    timeOut: 2000,
                    fadeOut: 2000,
                    onHidden: function () { }
                });
                window.location.replace(route_app + '/Historiaclinica/' + r.Data);
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