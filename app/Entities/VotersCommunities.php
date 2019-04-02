<?php namespace Victorem\Entities;

use Illuminate\Database\Eloquent\Model;

class VotersCommunities extends Model
{
	protected $table = 'voters_has_communities';
	public $timestamp = true;

	public static function getTelephones($communities)
	{
		$voters = self::wherein('community_id', $communities)->lists('voter_id');
		$telephones = Voter::wherein('id', $voters)->lists('telephone');

		return $telephones;
	}
}

?>