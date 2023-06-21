<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Empleado>
 */
class EmpleadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $celular = fake()->unique()->numerify('7#######');
        $genero = fake()->randomElement(['Masculino', 'Femenino']);
        $fecha = fake()->dateTimeBetween('-41 years', '-17 years');
        $fecha_nacimiento  = Carbon::parse($fecha);
        $edad  = Carbon::parse($fecha_nacimiento)->age;
        $id_turno = fake()->numberBetween(1, 4, true);

        return [
            'nombres' => $genero == 'Masculino' ? fake('es_ES')->firstNameMale() : fake('es_ES')->firstNameFemale(),
            'apellido_paterno' => fake('es_ES')->lastName(),
            'apellido_materno' => fake()->randomElement(['', fake('es_ES')->lastName()]),
            'id_tipo_identificacion' => 1,
            'numero_identificacion' => fake()->unique()->numerify('#######'),
            'fecha_nacimiento' => $fecha_nacimiento,
            'edad' => $edad,
            'genero' => $genero,
            'correo' => fake('es_ES')->unique()->email(),
            'cod_area' => '591',
            'celular' => $celular,
            //'telefono' => ,
            'direccion' => fake('es_ES')->address(),
            'id_turno' => $id_turno,
            'created_by_users_id' => 1,
            'updated_by_users_id' => 1,
            'eliminado' => 0
        ];
    }
}
