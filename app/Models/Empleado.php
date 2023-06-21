<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Empleado
 *
 * @property int $id
 * @property string $nombres
 * @property string|null $apellido_paterno
 * @property string|null $apellido_materno
 * @property int $id_tipo_identificacion
 * @property string|null $numero_identificacion
 * @property Carbon|null $fecha_nacimiento
 * @property string|null $edad
 * @property string|null $genero
 * @property string|null $correo
 * @property string|null $cod_area
 * @property string|null $celular
 * @property string|null $telefono
 * @property string|null $direccion
 * @property int $id_turno
 * @property int|null $id_usuario
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $created_by_users_id
 * @property int $updated_by_users_id
 * @property bool $eliminado
 *
 * @property User $user
 * @property TiposIdentificacione $tipos_identificacione
 * @property Turno $turno
 * @property Collection|Encomienda[] $encomiendas
 *
 * @package App\Models
 */
class Empleado extends Model
{
    use HasFactory;

    protected $table = 'empleados';

    protected $casts = [
        'id_tipo_identificacion' => 'int',
        'fecha_nacimiento' => 'date',
        'id_turno' => 'int',
        'id_usuario' => 'int',
        'created_by_users_id' => 'int',
        'updated_by_users_id' => 'int',
        'eliminado' => 'bool'
    ];

    protected $fillable = [
        'nombres',
        'apellido_paterno',
        'apellido_materno',
        'id_tipo_identificacion',
        'numero_identificacion',
        'fecha_nacimiento',
        'edad',
        'genero',
        'correo',
        'cod_area',
        'celular',
        'telefono',
        'direccion',
        'id_turno',
        'id_usuario',
        'created_by_users_id',
        'updated_by_users_id',
        'eliminado'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id_usuario');
    }

    public function tipos_identificacione()
    {
        return $this->belongsTo(TiposIdentificacione::class, 'id_tipo_identificacion');
    }

    public function turno()
    {
        return $this->belongsTo(Turno::class, 'id_turno');
    }

    public function encomiendas()
    {
        return $this->hasMany(Encomienda::class, 'id_empleado_recepcionista');
    }

    public static function obtenerIdEmpleadoDeUsuario($id_usuario): int
    {
        $empleado = Empleado::select('id')->where('id_usuario', $id_usuario)->first();
        return $empleado->id;
    }
}
