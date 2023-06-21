<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Fast Send">
    <meta name="author" content="Joel Herbas, OsBolivia">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('img/icono.png') }}">
    <title>Fast Send | Inicio de Sesión</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/grl.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('/css/toastr.css') }}">

    <style>
        @font-face {
            font-family: BackendFont;
            src: url('{{ asset('font/Palanquin-Regular.ttf') }}');
        }

        body {
            font-family: BackendFont;
        }

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .form-control,
        .btn-primary {
            border-radius: 15px;
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="{{ asset('css/front/signin.css') }}" rel="stylesheet">
</head>

<body class="text-center">

    <main class="form-signin">
        <form>
            <div>
                <img class="mb-4 img-fluid" src="{{ asset('img/logo.png') }}" alt="">
            </div>

            <h1 class="mb-3 fw-normal" style="color: #F5BAD1">BIENVENIDO(A)</h1>
            <br>
            {{-- <h3 class="h3 mb-3 fw-normal" style="color: #F5BAD1">Iniciar sesión</h3> --}}
            <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">

            <div class="form-floating mb-2">
                <input type="text" class="form-control" id="floatingInput" placeholder="Usuario" required>
                <label for="floatingInput">Usuario</label>
            </div>

            <div class="form-floating" style="border-radius: 15px;">
                <input type="password" class="form-control" id="floatingPassword"style="border-radius: 15px;"
                    placeholder="Contraseña" required>
                <label for="floatingPassword">Contraseña</label>
            </div>

            <input type="checkbox" onclick="mostrarClave()"><small> Mostrar contraseña</small><br><br>

            <button class="w-100 btn btn-lg btn-primary pt-2" type="button" id="btnLogin" onclick="validar()"
                style="background-color: #E73000; border-color: #E73000">Iniciar sesión</button>

            <p class="mt-5 mb-3 text-muted">&copy;
                <script>
                    document.write(new Date().getFullYear())
                </script>
            </p>
        </form>
        <input type="hidden" id="imagengif" value="{{ asset('img/loading.gif') }}">
    </main>


    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    <script>
        let route_app = '{{ config('app.url') }}';

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "5000",
            "hideDuration": "200",
            "timeOut": "2000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

        document.getElementById('floatingPassword').onkeydown = function(e) {
            if (e.keyCode == 13) {
                validar();
            }
        };

        function validar() {
            var token = $('meta[name="csrf-token"]').attr('content');
            var ruta = route_app + "/login";
            var usuario = $("#floatingInput").val();
            var password = $("#floatingPassword").val();
            if (!usuario || !usuario.trim().length) {
                toastr.error('Ingrese su nombre de usuario');
                return;
            }
            if (!password || !password.trim().length) {
                toastr.error('Ingrese su contraseña');
                return;
            }

            ajaxStart("Valindando");
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': token
                },
                type: "POST",
                url: ruta,
                data: {
                    usuario,
                    password
                },
                success: function(r) {
                    ajaxStop();

                    if (r.Codigo != 0) {
                        toastr.error(r.Mensaje);
                    } else {
                        toastr.success(r.Mensaje, "¡Bienvenido!", {
                            timeOut: 2000,
                            fadeOut: 2000,
                            onHidden: function() {
                                window.location = route_app;
                            }
                        });
                    }
                },
                error: function(h) {
                    ajaxStop();
                    toastr.error(h, "Error en la comunicación con el servidor");
                }

            });
        }

        function mostrarClave() {
            var x = document.getElementById("floatingPassword");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>

</html>
