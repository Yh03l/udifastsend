<!DOCTYPE html>
<html lang="es">

<head>
    <title>404 | LILFE MED BACKEND</title>
    <!-- Favicons-->
    <link rel="icon" href="{{ asset('img/icono.png') }}" type="image/x-icon" />
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/404.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="https://fonts.googleapis.com/css?family=Lato:300" rel="stylesheet" type="text/css">
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            display: table;
            font-weight: 100;
            font-family: 'Lato';
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-size: 96px;
        }

    </style>
</head>

<body>
    <div class="container">
        <div class="content">

            <img id="logo_404" class="mb-4" src="{{ asset('img/logo.png') }}" alt="" width="auto" height="150">

            <br><br><br>
            <br><br><br>


            <div class="title">404</div>

            <h1>¡Ups! Ha ocurrido un problema</h1>
            <h5>El elemento solicitado no se encuentra disponible</h5>

            <br><br><br>

            <a href="{{route('home')}}" class=" btn btn-primary" style="background-color: #E73000; border-color: #E73000">Volver a home</a>
        </div>
    </div>
</body>

</html>
