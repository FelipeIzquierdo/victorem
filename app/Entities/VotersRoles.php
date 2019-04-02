<?php namespace Victorem\Entities;

use Illuminate\Database\Eloquent\Model;

class VotersRoles extends Model
{
	protected $table = 'voters_has_roles';
	public $timestamp = true;

	public static function getTelephones($rol)
	{
		$voters = self::wherein('rol_id', $rol)->lists('voter_id');
		$telephones = Voter::wherein('id', $voters)->lists('telephone');

		return $telephones;
	}
}

?>