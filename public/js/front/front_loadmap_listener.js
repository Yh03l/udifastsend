/* MAPA */
//ubicacion inicial del mapa_cita
let ubicacionInicial = {
    lat: -17.783052,
    lng: -63.180574
};
let latitud = -17.783052;
let longitud = -63.180574;
let marcador = null;

//inicializo el mapa_cita
function initMap(id) {
    let latitu = parseFloat($('#latitud' + id).val());
    let longitu = parseFloat($('#longitud' + id).val());
    marcador = null;
    if (latitud != '' && latitud != 0) {
        setMap(latitu, longitu, id);
    }
}

//set mapa_cita
function setMap(latitud, longitud, id) {
    if (latitud != "" && longitud != "") {
        ubicacionInicial = {
            lat: latitud,
            lng: longitud
        };
    } else {
        ubicacionInicial = {
            lat: -17.783052,
            lng: -63.180574
        }
    }

    mapa_cita = new google.maps.Map(document.getElementById('mapa' + id), {
        center: ubicacionInicial,
        zoom: 14,
        streetViewControl: false,
        rotateControl: true,
        fullscreenControl: true,
        mapTypeControlOptions: {
            mapTypeIds: ['roadmap', 'satellite']
        }
    });
    mapa_cita.addListener('click', function(e) {
        posicionarMarcador(e.latLng, mapa_cita, id);
    });
    let coordenadas = new google.maps.LatLng(ubicacionInicial.lat, ubicacionInicial.lng);
    posicionarMarcador(coordenadas, mapa_cita, id);
}

//guardamis coordenadas
function setCoordenada(posicion, id) {
    $('#latitud' + id).val(posicion.lat());
    $('#longitud' + id).val(posicion.lng());
}

//pintamos el marcador
function posicionarMarcador(posicion, mapa_cita, id) {
    if (marcador == null) {
        marcador = new google.maps.Marker({
            position: posicion,
            map: mapa_cita
        });
    } else {
        marcador.setPosition(posicion);
    }
    mapa_cita.panTo(posicion);
    setCoordenada(posicion, id);
}