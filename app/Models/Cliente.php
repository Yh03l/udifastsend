<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Nette\Utils\Arrays;

/**
 * Class Cliente
 *
 * @property int $id
 * @property string $nombres
 * @property string $apellido_paterno
 * @property string|null $apellido_materno
 * @property int|null $id_tipo_identificacion
 * @property string|null $numero_identificacion
 * @property Carbon|null $fecha_nacimiento
 * @property string|null $edad
 * @property string|null $sexo
 * @property string|null $correo
 * @property string|null $cod_area
 * @property string|null $celular
 * @property string|null $telefono
 * @property string|null $direccion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $created_by_users_id
 * @property int $updated_by_users_id
 * @property bool $eliminado
 *
 * @property User $user
 * @property TiposIdentificacione|null $tipos_identificacione
 * @property Collection|Encomienda[] $encomiendas
 *
 * @package App\Models
 */
class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    protected $casts = [
        'id_tipo_identificacion' => 'int',
        'fecha_nacimiento' => 'date',
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
        'sexo',
        'correo',
        'cod_area',
        'celular',
        'telefono',
        'direccion',
        'created_by_users_id',
        'updated_by_users_id',
        'eliminado'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by_users_id');
    }

    public function tipos_identificacione()
    {
        return $this->belongsTo(TiposIdentificacione::class, 'id_tipo_identificacion');
    }

    public function encomiendas()
    {
        return $this->hasMany(Encomienda::class, 'id_cliente_remitente');
    }

    function nombre_completo(): String
    {
        return $this->nombres . ' ' . $this->apellido_paterno . ' ' . $this->apellido_materno;
    }

    public static function buscarCliente($filtro_busqueda)
    {
        $data = DB::select(
            "SELECT
                clientes.id,
                clientes.nombres,
                clientes.apellido_paterno,
                clientes.apellido_materno,
                clientes.numero_identificacion
            FROM
                clientes
            WHERE
                clientes.eliminado = 0
                AND (clientes.nombres LIKE '%$filtro_busqueda%'
                OR clientes.apellido_paterno LIKE '%$filtro_busqueda%'
                OR clientes.numero_identificacion LIKE '%$filtro_busqueda%')
            ORDER BY
                clientes.nombres ASC"
        );
        foreach ($data as $value) {
            $value->nombre_completo = $value->nombres . ' ' . $value->apellido_paterno . ($value->apellido_materno ? ' ' . $value->apellido_materno : '');
        }
        return $data;
    }
}
