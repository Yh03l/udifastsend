<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DetallesEncomienda
 *
 * @property int $id
 * @property int $id_encomienda
 * @property int $id_tipo_encomienda
 * @property string $contenido
 * @property int $cantidad
 * @property float $peso
 * @property float $precio_envio
 * @property float $recargo_adicional_volumen
 * @property float $costo_envio
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $created_by_users_id
 * @property int $updated_by_users_id
 * @property bool $eliminado
 *
 * @property User $user
 * @property Encomienda $encomienda
 * @property TiposEncomienda $tipos_encomienda
 *
 * @package App\Models
 */
class DetallesEncomienda extends Model
{
    use HasFactory;

    protected $table = 'detalles_encomiendas';

    protected $casts = [
        'id_encomienda' => 'int',
        'id_tipo_encomienda' => 'int',
        'cantidad' => 'int',
        'peso' => 'float',
        'precio_envio' => 'float',
        'recargo_adicional_volumen' => 'float',
        'costo_envio' => 'float',
        'created_by_users_id' => 'int',
        'updated_by_users_id' => 'int',
        'eliminado' => 'bool'
    ];

    protected $fillable = [
        'id_encomienda',
        'id_tipo_encomienda',
        'contenido',
        'cantidad',
        'peso',
        'precio_envio',
        'recargo_adicional_volumen',
        'costo_envio',
        'created_by_users_id',
        'updated_by_users_id',
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

    public function tipos_encomienda()
    {
        return $this->belongsTo(TiposEncomienda::class, 'id_tipo_encomienda');
    }

    public static function obtenerPrecioEnvioPorUnidad(int $id_sucursal_origen, int $id_sucursal_destino, int $id_tipo_envio, int $id_tipo_encomienda, float $peso)
    {
        $tarifa = TarifasEncomienda::firstOrNew([
            'id_sucursal_origen' => $id_sucursal_origen,
            'id_sucursal_destino' => $id_sucursal_destino,
            'id_tipo_envio' => $id_tipo_envio,
            'id_tipo_encomienda' => $id_tipo_encomienda,
        ]);

        if (!$tarifa->exists) {
            return null; //
        }

        return $peso <= $tarifa->peso_maximo
            ? $tarifa->precio_base
            : ($tarifa->precio_base * $peso) / $tarifa->peso_maximo;
    }
}
