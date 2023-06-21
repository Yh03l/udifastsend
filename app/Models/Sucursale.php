<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Sucursale
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $direccion
 * @property int $id_ciudad
 * @property int $id_empresa
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $created_by_users_id
 * @property int $updated_by_users_id
 * @property bool $visible
 * @property bool $eliminado
 *
 * @property User $user
 * @property Ciudade $ciudade
 * @property Empresa $empresa
 * @property Collection|Encomienda[] $encomiendas
 * @property Collection|TarifasEncomienda[] $tarifas_encomiendas
 *
 * @package App\Models
 */
class Sucursale extends Model
{
    protected $table = 'sucursales';

    protected $casts = [
        'id_ciudad' => 'int',
        'id_empresa' => 'int',
        'created_by_users_id' => 'int',
        'updated_by_users_id' => 'int',
        'visible' => 'bool',
        'eliminado' => 'bool'
    ];

    protected $fillable = [
        'nombre',
        'direccion',
        'id_ciudad',
        'id_empresa',
        'created_by_users_id',
        'updated_by_users_id',
        'visible',
        'eliminado'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by_users_id');
    }

    public function ciudade()
    {
        return $this->belongsTo(Ciudade::class, 'id_ciudad');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'id_empresa');
    }

    public function encomiendas()
    {
        return $this->hasMany(Encomienda::class, 'id_sucursal_origen');
    }

    public function tarifas_encomiendas()
    {
        return $this->hasMany(TarifasEncomienda::class, 'id_sucursal_origen');
    }

    public static function obtenerDatosParaListadoPorCiudad($id_ciudad)
    {
        return Sucursale::select('id', 'nombre')->where('eliminado', 0)->where('visible', true)->where('id_ciudad', $id_ciudad)->orderBy('nombre', 'ASC')->get();
    }
}
