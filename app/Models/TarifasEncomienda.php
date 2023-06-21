<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TarifasEncomienda
 * 
 * @property int $id
 * @property float|null $peso_maximo
 * @property float $precio_base
 * @property int $id_tipo_envio
 * @property int $id_tipo_encomienda
 * @property int $id_sucursal_origen
 * @property int $id_sucursal_destino
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $created_by_users_id
 * @property int $updated_by_users_id
 * @property bool $visible
 * @property bool $eliminado
 * 
 * @property User $user
 * @property Sucursale $sucursale
 * @property TiposEncomienda $tipos_encomienda
 * @property TiposEnvio $tipos_envio
 *
 * @package App\Models
 */
class TarifasEncomienda extends Model
{
	protected $table = 'tarifas_encomiendas';

	protected $casts = [
		'peso_maximo' => 'float',
		'precio_base' => 'float',
		'id_tipo_envio' => 'int',
		'id_tipo_encomienda' => 'int',
		'id_sucursal_origen' => 'int',
		'id_sucursal_destino' => 'int',
		'created_by_users_id' => 'int',
		'updated_by_users_id' => 'int',
		'visible' => 'bool',
		'eliminado' => 'bool'
	];

	protected $fillable = [
		'peso_maximo',
		'precio_base',
		'id_tipo_envio',
		'id_tipo_encomienda',
		'id_sucursal_origen',
		'id_sucursal_destino',
		'created_by_users_id',
		'updated_by_users_id',
		'visible',
		'eliminado'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'updated_by_users_id');
	}

	public function sucursale()
	{
		return $this->belongsTo(Sucursale::class, 'id_sucursal_origen');
	}

	public function tipos_encomienda()
	{
		return $this->belongsTo(TiposEncomienda::class, 'id_tipo_encomienda');
	}

	public function tipos_envio()
	{
		return $this->belongsTo(TiposEnvio::class, 'id_tipo_envio');
	}
}
