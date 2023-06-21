<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TiposEncomienda
 *
 * @property int $id
 * @property string $nombre
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $created_by_users_id
 * @property int $updated_by_users_id
 * @property bool $visible
 * @property bool $eliminado
 *
 * @property User $user
 * @property Collection|DetallesEncomienda[] $detalles_encomiendas
 * @property Collection|TarifasEncomienda[] $tarifas_encomiendas
 *
 * @package App\Models
 */
class TiposEncomienda extends Model
{
    protected $table = 'tipos_encomiendas';

    protected $casts = [
        'created_by_users_id' => 'int',
        'updated_by_users_id' => 'int',
        'visible' => 'bool',
        'eliminado' => 'bool'
    ];

    protected $fillable = [
        'nombre',
        'created_by_users_id',
        'updated_by_users_id',
        'visible',
        'eliminado'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by_users_id');
    }

    public function detalles_encomiendas()
    {
        return $this->hasMany(DetallesEncomienda::class, 'id_tipo_encomienda');
    }

    public function tarifas_encomiendas()
    {
        return $this->hasMany(TarifasEncomienda::class, 'id_tipo_encomienda');
    }

    public static function obtenerDatosParaListado()
    {
        return TiposEncomienda::select('id', 'nombre')->where('eliminado', 0)->where('visible', true)->orderBy('id', 'ASC')->get();
    }
}
