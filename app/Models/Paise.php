<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Paise
 * 
 * @property int $id
 * @property string $nombre
 * @property string|null $abreviatura
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $created_by_users_id
 * @property int $updated_by_users_id
 * @property bool $visible
 * @property bool $eliminado
 * 
 * @property User $user
 * @property Collection|Ciudade[] $ciudades
 *
 * @package App\Models
 */
class Paise extends Model
{
	protected $table = 'paises';

	protected $casts = [
		'created_by_users_id' => 'int',
		'updated_by_users_id' => 'int',
		'visible' => 'bool',
		'eliminado' => 'bool'
	];

	protected $fillable = [
		'nombre',
		'abreviatura',
		'created_by_users_id',
		'updated_by_users_id',
		'visible',
		'eliminado'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'updated_by_users_id');
	}

	public function ciudades()
	{
		return $this->hasMany(Ciudade::class, 'id_pais');
	}
}
