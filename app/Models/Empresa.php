<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Empresa
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
 * @property Collection|Sucursale[] $sucursales
 *
 * @package App\Models
 */
class Empresa extends Model
{
	protected $table = 'empresas';

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

	public function sucursales()
	{
		return $this->hasMany(Sucursale::class, 'id_empresa');
	}
}
