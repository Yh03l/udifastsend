<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Fast Send">
    <meta name="author" content="Joel Herbas, OsBolivia">

    <link rel="icon" href="{{ asset('img/icono.png') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>@yield('title', config('app.name', 'Fast Send'))</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    {{-- <script src="https://kit.fontawesome.com/0aec2fa28d.js" crossorigin="anonymous"></script> --}}
    <script src="{{ asset('js/0aec2fa28d.js') }}" crossorigin="anonymous"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sb-admin-2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('css/normalize.css') }}">

    <style>
        @font-face {
            font-family: BackendFont;
            src: url('{{ asset('font/Palanquin-Regular.ttf') }}');
        }

        @font-face {
            font-family: SophiaReign;
            src: url('{{ asset('font/sophia-reign.ttf') }}');
        }

        @font-face {
            font-family: ZenKaku;
            src: url('{{ asset('font/zenkakugothicantique.ttf') }}');
        }

        @font-face {
            font-family: Aboreto;
            src: url('{{ asset('font/aboreto-regular.ttf') }}');
        }

        body {
            /* font-family: BackendFont; */
        }

        .SophiaReignFont {
            /* font-family: SophiaReign; */
        }

        .ZenKakuFont {
            /* font-family: ZenKaku; */
        }

        .AboretoFont {
            /* font-family: Aboreto; */
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

        /* .form-control,
        .btn-primary {
            border-radius: 15px;
        } */

        .more_options:hover {
            cursor: pointer;
            color: #1d4f90;
            transform: scale(1.1);
        }

        .options:hover {
            cursor: pointer;
            color: #ed6d7e;
        }
    </style>
    @livewireStyles
    @yield('estilos')
    @stack('estilos_add')

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('layouts.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('layouts.header')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    {{-- <h1 class="h3 mb-0 text-gray-800">@yield('pagina_titulo', '')</h1>
                        <p class="mb-4">@yield('pagina_descripcion', '')</p> --}}
                    <!--a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a-->


                    @yield('content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Joel Herbas
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                        </span>
                    </div>
                </div>
            </footer>

            {{-- <audio src="{{ asset('audio/mdcn_notificacion.mp3') }}" controls style="display: none"
                id="notificacionAudio"></audio> --}}
            <input type="hidden" id="imagengif" value="{{ asset('img/loading.gif') }}">
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    @include('modals.mCloseSession')

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/grl.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.js') }}"></script>
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
            "timeOut": "3000",
            "extendedTimeOut": "2000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        $(document).ready(function() {});
    </script>

    @livewireScripts

    @yield('scripts')
    @stack('scripts_add')
</body>

</html>
