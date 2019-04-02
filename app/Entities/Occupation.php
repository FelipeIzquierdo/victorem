<?php namespace Victorem\Entities;

use Illuminate\Database\Eloquent\Model; 
	/**
	* 
	*/
	class Occupation extends Model
	{
		protected $table = 'occupations';
		public $timestamp = true;
		public $increments = true;

		protected $fillable = ['name', 'description'];

		public static function allLists()
	    {
	        return self::lists('name', 'id')->all();
	    }

	    public function voters()
	    {
	        return $this->hasMany('Victorem\Entities\Voter', 'occupation', 'id');
	    }

	    public static function withVoters($occupations_id = null)
	    {
	    	if(is_null($occupations_id))
	    	{
	    		return self::with('voters')->get();
	    	}

	    	return self::whereIn('id', $occupations_id)->with('voters')->get();
	        
	    }
	}
 ?>