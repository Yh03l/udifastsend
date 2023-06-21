<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Turno
 * 
 * @property int $id
 * @property string $nombre
 * @property string|null $abreviatura
 * @property Carbon $hora_inicio
 * @property Carbon $hora_fin
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $created_by_users_id
 * @property int $updated_by_users_id
 * @property bool $visible
 * @property bool $eliminado
 * 
 * @property User $user
 * @property Collection|Empleado[] $empleados
 *
 * @package App\Models
 */
class Turno extends Model
{
	protected $table = 'turnos';

	protected $casts = [
		'hora_inicio' => 'date',
		'hora_fin' => 'date',
		'created_by_users_id' => 'int',
		'updated_by_users_id' => 'int',
		'visible' => 'bool',
		'eliminado' => 'bool'
	];

	protected $fillable = [
		'nombre',
		'abreviatura',
		'hora_inicio',
		'hora_fin',
		'created_by_users_id',
		'updated_by_users_id',
		'visible',
		'eliminado'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'updated_by_users_id');
	}

	public function empleados()
	{
		return $this->hasMany(Empleado::class, 'id_turno');
	}
}
