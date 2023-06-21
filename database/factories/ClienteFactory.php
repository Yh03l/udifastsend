<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\clientes>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $celular = fake()->unique()->numerify('7#######');
        $sexo = fake()->randomElement(['Masculino', 'Femenino']);
        $fecha = fake()->dateTimeBetween('-71 years', '-19 years');
        $fecha_nacimiento  = Carbon::parse($fecha);
        $edad  = Carbon::parse($fecha_nacimiento)->age;

        return [
            'nombres' => $sexo == 'Masculino' ? fake('es_ES')->firstNameMale() : fake('es_ES')->firstNameFemale(),
            'apellido_paterno' => fake('es_ES')->lastName(),
            'apellido_materno' => fake()->randomElement(['', fake('es_ES')->lastName()]),
            'id_tipo_identificacion' => 1,
            'numero_identificacion' => fake()->unique()->numerify('########'),
            'fecha_nacimiento' => $fecha_nacimiento,
            'edad' => $edad,
            'sexo' => $sexo,
            'correo' => fake('es_ES')->unique()->email(),
            'cod_area' => '591',
            'celular' => $celular,
            //'telefono' => ,
            'direccion' => fake('es_ES')->address(),
            'created_by_users_id' => 1,
            'updated_by_users_id' => 1,
            'eliminado' => 0,
        ];
    }
}
