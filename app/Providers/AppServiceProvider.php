<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        Response::macro('apiSuccess', function ($data, $mensaje = 'Consulta realizada exitosamente') {
            return Response::json([
                'Codigo' => 0,
                'Titulo' => 'Correcto',
                'Mensaje' => $mensaje,
                'Data' => $data
            ], 200);
        });

        Response::macro('apiError', function ($mensaje = 'Se produjo un error con la solicitud.', $status = 400) {
            return Response::json([
                'Codigo' => 1,
                'Titulo' => 'Error',
                'Mensaje' => $mensaje,
                'Data' => null
            ], $status);
        });

        Response::macro('apiException', function () {
            return Response::json([
                'Codigo' => 1,
                'Titulo' => 'Lo sentimos',
                'Mensaje' => 'Se produjo una excepción con la solicitud. Si el problema persiste comuníquese con el administrador.',
                'Data' => null
            ], 500);
        });
    }
}
