<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Ciudade
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $abreviatura
 * @property int $id_pais
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $created_by_users_id
 * @property int $updated_by_users_id
 * @property bool $visible
 * @property bool $eliminado
 *
 * @property User $user
 * @property Paise $paise
 * @property Collection|Sucursale[] $sucursales
 *
 * @package App\Models
 */
class Ciudade extends Model
{
    protected $table = 'ciudades';

    protected $casts = [
        'id_pais' => 'int',
        'created_by_users_id' => 'int',
        'updated_by_users_id' => 'int',
        'visible' => 'bool',
        'eliminado' => 'bool'
    ];

    protected $fillable = [
        'nombre',
        'abreviatura',
        'id_pais',
        'created_by_users_id',
        'updated_by_users_id',
        'visible',
        'eliminado'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by_users_id');
    }

    public function paise()
    {
        return $this->belongsTo(Paise::class, 'id_pais');
    }

    public function sucursales()
    {
        return $this->hasMany(Sucursale::class, 'id_ciudad');
    }

    public static function obtenerDatosParaListado()
    {
        return Ciudade::select('id', 'nombre')->where('eliminado', 0)->where('visible', true)->orderBy('nombre', 'ASC')->get();
    }
}
