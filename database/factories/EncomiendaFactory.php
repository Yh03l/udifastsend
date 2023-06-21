<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\encomiendas>
 */
class EncomiendaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fecha_hora_recepcion = fake()->dateTimeBetween('-9 month', '-2 days');
        $randomDays = fake()->numberBetween(1, 30);
        $fecha_hora_recepcion = Carbon::parse($fecha_hora_recepcion);
        $fecha_hora_entrega = $fecha_hora_recepcion->copy()->addDays($randomDays)->addMinutes(45);

        $id_sucursal_origen = fake()->numberBetween(1, 5, true);
        $id_sucursal_destino = fake()->numberBetween(1, 5, true);
        while ($id_sucursal_destino == $id_sucursal_origen) {
            $id_sucursal_destino = fake()->numberBetween(1, 5, true);
        }
        $id_cliente_remitente = fake()->numberBetween(1, 107000, true);
        $id_cliente_destinatario = fake()->numberBetween(1, 107000, true);
        while ($id_cliente_destinatario == $id_cliente_remitente) {
            $id_cliente_destinatario = fake()->numberBetween(1, 107000, true);
        }

        $id_empleado_recepcionista = fake()->numberBetween(1, 20, true);
        $id_empleado_despachante = fake()->numberBetween(1, 20, true);
        while ($id_empleado_despachante == $id_empleado_recepcionista) {
            $id_empleado_despachante = fake()->numberBetween(1, 20, true);
        }

        $id_tipo_envio = fake()->numberBetween(1, 2, true);
        $tarifa_total_envio = fake()->numberBetween(25, 300, true);

        $var = '';
        return [
            'id_sucursal_origen' => $id_sucursal_origen,
            'id_sucursal_destino' => $id_sucursal_destino,
            'id_cliente_remitente' => $id_cliente_remitente,
            'id_cliente_destinatario' => $id_cliente_destinatario,
            'fecha_hora_recepcion' => $fecha_hora_recepcion,
            'id_empleado_recepcionista' => $id_empleado_recepcionista,
            'fecha_hora_entrega' => $fecha_hora_entrega,
            'id_empleado_despachante' => $id_empleado_despachante,
            'observaciones' => 'Sin observaciones',
            'id_tipo_envio' => $id_tipo_envio,
            'tarifa_total_envio' => $tarifa_total_envio,
            'pagado' => true,
            'created_by_users_id' => 1,
            'updated_by_users_id' => 1,
            'eliminado' => 0,
        ];
    }
}
