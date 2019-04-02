<?php namespace Victorem\Entities;

use Illuminate\Database\Eloquent\Model; 
	/**
	* 
	*/
	class Community extends Model
	{
		protected $table = 'communities';
		public $timestamp = true;
		public $increments = true;

		protected $fillable = ['name', 'description'];

		public function voters()
		{
			return $this->belongsToMany('Victorem\Entities\Voter', 'voters_has_communities', 'community_id', 'voter_id');
		}

		public static function allLists()
	    {
	        return self::lists('name', 'id')->all();
	    }

	    public static function getTelephones($communities)
	    {
	    	$tels = [];
	    	foreach(self::withVoters($communities) as $community)
	    	{
	    		foreach ($community->voters as $voter) 
	    		{
	    			if(! is_null($voter->telephone))
	    			{
	    				array_push($tels, $voter->telephone);
	    			}
	    		}
	    	}

	    	return $tels;
	    }

	    public static function withVoters($communities_id = [])
	    {
	    	if(is_null($communities_id))
	    	{
	    		return self::with('voters')->get();
	    	}
	    	
	        return self::whereIn('id', $communities_id)->with('voters')->get();
	    }
	}
 ?>