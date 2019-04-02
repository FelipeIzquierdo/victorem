<?php namespace Victorem\Entities;

use Illuminate\Database\Eloquent\Model; 
	/**
	* 
	*/
	class Location extends Model
	{
		protected $table = 'locations';
		public $timestamp = true;
		public $fillable = ['name', 'electoral_potential', 'superior', 'type_id'];

		public function childrenLocations()
	    {
	        return $this->hasMany('Victorem\Entities\Location', 'superior', 'id');
	    }

		public function superiorLocation()
	    {
	        return $this->belongsTo('Victorem\Entities\Location', 'superior', 'id');
	    }

	    public function voters()
	    {
	        return $this->hasMany('Victorem\Entities\Voter');
	    }

	    public function type()
	    {
	        return $this->belongsTo('Victorem\Entities\LocationType', 'type_id', 'id');
	    }

	    public static function allLists()
	    {
	        return self::lists('name', 'id')->all();
	    }

	    public static function allMunicipalities()
	    {
	        return self::whereTypeId(2)->lists('name', 'id')->all();
	    }

	    public static function allCommunes()
	    {
	        return self::whereTypeId(3)->lists('name', 'id')->all();
	    }

	    public static function allNeighborhoods()
	    {
	        return self::whereTypeId(4)->lists('name', 'id')->all();
	    }

	    public static function allVeredas()
	    {
	        return self::whereTypeId(6)->lists('name', 'id')->all();
	    }

	    public function getAllNumberVotersAttribute()
	    {	 
	    	$number = $this->number_voters;

	    	foreach ($this->childrenLocations as $location) 
	    	{
	    		$number += $location->all_number_voters;
	    	}

	    	return $number;
	    }

	    public function getAllNumberOnlyVotersAttribute()
	    {	 
	    	$number = $this->number_only_voters;

	    	foreach ($this->childrenLocations as $location) 
	    	{
	    		$number += $location->all_number_only_voters;
	    	}

	    	return $number;
	    }

	    public function getAllNumberTeamAttribute()
	    {	 
	    	$number = $this->number_team;

	    	foreach ($this->childrenLocations as $location) 
	    	{
	    		$number += $location->all_number_team;
	    	}

	    	return $number;
	    }

	    public function getAllPercentOnlyVotersAttribute()
	    {
	    	$all_number_voters = $this->all_number_voters;

	    	if($all_number_voters > 0)
	    	{
	    		return ($this->all_number_only_voters / $all_number_voters) * 100;	
	    	}
	        
	        return 0;
	    }

	    public function getAllPercentTeamAttribute()
	    {
	    	$all_number_voters = $this->all_number_voters;

	    	if($all_number_voters > 0)
	    	{
	        	return ($this->all_number_team / $all_number_voters) * 100;
	        }

	        return 0;
	    }

	    /* Query */
	    public static function withVoters($location_ids = null, $type_ids = null)
	    {
	    	$locations = self::with('voters', 'type', 'childrenLocations.voters',
	    		'childrenLocations.childrenLocations.voters', 'childrenLocations.childrenLocations.childrenLocations.voters',
	    		'childrenLocations.childrenLocations.childrenLocations.childrenLocations.voters');
	    	
	    	if(! is_null($location_ids))
	    	{
	    		$locations = $locations->whereIn('id', $location_ids);
	    	}

	    	if(! is_null($type_ids))
	    	{
	    		$locations = $locations->whereIn('type_id', $type_ids);
	    	}
	    	
	        return $locations->get()->sortByDesc(function($location) {
	        	return $location->all_number_voters;
	        });
	    }

	    public static function findByName($name)
	    {
	    	return self::whereName($name)->first();
	    }

		public function scopeInLocation($query, $location_id)
	    {
	        return $query->where('superior', '=', $location_id);
	    }

	    public function getNumberVotersAttribute()
	    {
	        return $this->voters->count();
	    }

	    public function getNumberOnlyVotersAttribute()
	    {
	        return $this->voters->where('colaborator', '0')->count();
	    }

	    public function getNumberTeamAttribute()
	    {
	        return $this->voters->where('colaborator', '1')->count();
	    }


	    public function getUnameAttribute()
	    {
	    	return ucwords(strtolower($this->name));
	    }

	    public function getNameAttribute($value)
	    {
	    	return ucwords(strtolower($value));
	    }

	    public function isFinal()
	    {
	    	if(self::inLocation($this->id)->count('id') == 0)
	    	{
	    		return true;
	    	}

	    	return false;
	    }

	    public static function getAllOrder($location_id = 1)
	    {
	    	$locations = self::whereId($location_id)
	    		->with('childrenLocations.childrenLocations.childrenLocations.childrenLocations')
				->get();

			return self::orderCollections($locations);
	    }

	    public static function orderCollections($locations, &$lists = [], $location_name = null)
	    {	
	    	foreach ($locations as $location) 
	    	{
	    		if(is_null($location_name))
	    		{
	    			$name = $location->uname;
	    		}
	    		else
	    		{
	    			$name = $location_name.' - '.$location->uname;
	    		}

	    		$lists[$location->id] = $name;

	    		self::orderCollections($location->childrenLocations, $lists, $name);
	    	}

	    	return $lists;
	    }

	    public static function getAllOrderIds($location_ids = [1])
	    {
	    	$locations = Location::whereIn('id', $location_ids)
            	->with('childrenLocations.childrenLocations.childrenLocations.childrenLocations')
            	->get();

			return self::orderIdCollections($locations);
	    }

	    public static function orderIdCollections($locations, &$lists = [])
	    {	
	    	foreach ($locations as $location) 
	    	{
	    		$lists[$location->id] = $location->id;
	    		self::orderIdCollections($location->childrenLocations, $lists);
	    	}

	    	return $lists;
	    }

	    public function getNameRecursiveAttribute()
	    {
	    	return $this->nameRecursive($this, 4);
	    }

	    public function getSuperiorNameAttribute()
	    {
	    	if($this->superiorLocation)
	    	{
	    		return $this->superiorLocation->name;
	    	}

	    	return '';
	    }

	    public function getTypeNameAttribute()
	    {
	    	if($this->type)
	    	{
	    		return $this->type->name;
	    	}

	    	return '';
	    }

	    public static function nameRecursive($location, $superior, &$name = null)
	    {
	    	if($location->superiorLocation)
	    	{
	    		if(is_null($name))
	    		{
	    			$name = $location->name;
	    		}
	    		else
	    		{
	    			$name = $location->name.' > '.$name;
	    		}

	    		if($location->superiorLocation->id != $superior)
	    		{
	    			self::nameRecursive($location->superiorLocation, $superior, $name);
	    		}
	    	}

	    	if(is_null($name))
	    	{
	    		$name = $location->name;
	    	}

	    	return $name;
	    }
	}
 ?>