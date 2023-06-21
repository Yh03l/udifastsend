<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TiposIdentificacione
 * 
 * @property int $id
 * @property string $nombre
 * @property string|null $abreviatura
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $created_by_users_id
 * @property int $updated_by_users_id
 * @property bool $eliminado
 * 
 * @property User $user
 * @property Collection|Cliente[] $clientes
 * @property Collection|Empleado[] $empleados
 *
 * @package App\Models
 */
class TiposIdentificacione extends Model
{
	protected $table = 'tipos_identificaciones';

	protected $casts = [
		'created_by_users_id' => 'int',
		'updated_by_users_id' => 'int',
		'eliminado' => 'bool'
	];

	protected $fillable = [
		'nombre',
		'abreviatura',
		'created_by_users_id',
		'updated_by_users_id',
		'eliminado'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'updated_by_users_id');
	}

	public function clientes()
	{
		return $this->hasMany(Cliente::class, 'id_tipo_identificacion');
	}

	public function empleados()
	{
		return $this->hasMany(Empleado::class, 'id_tipo_identificacion');
	}
}
