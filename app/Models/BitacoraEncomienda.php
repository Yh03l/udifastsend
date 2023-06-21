<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BitacoraEncomienda
 *
 * @property int $id
 * @property int $id_encomienda
 * @property int $id_estado_encomienda
 * @property Carbon $fecha_hora_registro
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $created_by_users_id
 * @property int $updated_by_users_id
 * @property bool $eliminado
 *
 * @property User $user
 * @property Encomienda $encomienda
 * @property EstadosEncomienda $estados_encomienda
 *
 * @package App\Models
 */
class BitacoraEncomienda extends Model
{
    protected $table = 'bitacora_encomiendas';

    protected $casts = [
        'id_encomienda' => 'int',
        'id_estado_encomienda' => 'int',
        'fecha_hora_registro' => 'date',
        'created_by_users_id' => 'int',
        'updated_by_users_id' => 'int',
        'eliminado' => 'bool'
    ];

    protected $fillable = [
        'id_encomienda',
        'id_estado_encomienda',
        'fecha_hora_registro',
        'created_by_users_id',
        'updated_by_users_id',
        'created_at',
        'eliminado'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by_users_id');
    }

    public function encomienda()
    {
        return $this->belongsTo(Encomienda::class, 'id_encomienda');
    }

    public function estados_encomienda()
    {
        return $this->belongsTo(EstadosEncomienda::class, 'id_estado_encomienda');
    }
}
