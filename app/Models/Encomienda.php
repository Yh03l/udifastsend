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
 * Class Encomienda
 *
 * @property int $id
 * @property int $id_sucursal_origen
 * @property int $id_sucursal_destino
 * @property int $id_cliente_remitente
 * @property int $id_cliente_destinatario
 * @property Carbon $fecha_hora_recepcion
 * @property int $id_empleado_recepcionista
 * @property Carbon|null $fecha_hora_entrega
 * @property int|null $id_empleado_despachante
 * @property string $observaciones
 * @property int $id_tipo_envio
 * @property float $tarifa_total_envio
 * @property bool $pagado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $created_by_users_id
 * @property int $updated_by_users_id
 * @property bool $eliminado
 *
 * @property User $user
 * @property Cliente $cliente
 * @property Empleado $empleado
 * @property Sucursale $sucursale
 * @property Collection|BitacoraEncomienda[] $bitacora_encomiendas
 * @property Collection|DetallesEncomienda[] $detalles_encomiendas
 *
 * @package App\Models
 */
class Encomienda extends Model
{
    use HasFactory;

    protected $table = 'encomiendas';

    protected $casts = [
        'id_sucursal_origen' => 'int',
        'id_sucursal_destino' => 'int',
        'id_cliente_remitente' => 'int',
        'id_cliente_destinatario' => 'int',
        'fecha_hora_recepcion' => 'datetime',
        'id_empleado_recepcionista' => 'int',
        'fecha_hora_entrega' => 'datetime',
        'id_empleado_despachante' => 'int',
        'id_tipo_envio' => 'int',
        'tarifa_total_envio' => 'float',
        'pagado' => 'bool',
        'created_by_users_id' => 'int',
        'updated_by_users_id' => 'int',
        'eliminado' => 'bool'
    ];

    protected $fillable = [
        'id_sucursal_origen',
        'id_sucursal_destino',
        'id_cliente_remitente',
        'id_cliente_destinatario',
        'fecha_hora_recepcion',
        'id_empleado_recepcionista',
        'fecha_hora_entrega',
        'id_empleado_despachante',
        'observaciones',
        'id_tipo_envio',
        'tarifa_total_envio',
        'pagado',
        'created_by_users_id',
        'updated_by_users_id',
        'eliminado'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by_users_id');
    }

    public function cliente_remitente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente_remitente');
    }

    public function cliente_destinatario()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente_destinatario');
    }

    public function empleado_recepcionista()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado_recepcionista');
    }

    public function empleado_despachante()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado_despachante');
    }

    public function sucursal_origen()
    {
        return $this->belongsTo(Sucursale::class, 'id_sucursal_origen');
    }
    public function sucursal_destino()
    {
        return $this->belongsTo(Sucursale::class, 'id_sucursal_destino');
    }

    public function bitacora_encomiendas()
    {
        return $this->hasMany(BitacoraEncomienda::class, 'id_encomienda');
    }

    public function detalles_encomiendas()
    {
        return $this->hasMany(DetallesEncomienda::class, 'id_encomienda');
    }
}
