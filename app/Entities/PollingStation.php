<?php namespace Victorem\Entities;

use Illuminate\Database\Eloquent\Model; 
	/**
	* 
	*/
	class PollingStation extends Model
	{
		protected $table 	= 'polling_stations';
		public $timestamp 	= true;
		protected $fillable = ['description', 'location_id', 'address', 'electoral_potential', 'name', 'registraduria_location_id', 'tables'];

			
		public static function allLists()
	    {
	        return self::lists('name', 'id')->all();
	    }

	    public static function withVoters($polling_stations_ids = null, $rol_ids = null, $colaborator = null)
	    {
	    	$relations = ['voters', 'voters.roles', 'voters.superior', 'voters.location.superiorLocation.superiorLocation', 'location'];

	    	if( ! is_null($rol_ids) )
	    	{
	    		$relations['voters'] = function($query) use($rol_ids, $colaborator){
    				$query->join('voters_has_roles', function ($join) use($rol_ids) {
			            $join->on('voter_id', '=', 'voters.id')
			            	->whereIn('voters_has_roles.rol_id', $rol_ids)
			            	->orderBy('voters.superior', 'asc');
			        })->groupBy('voters.id');
    			};
	    	}
	    	else if( ! is_null($colaborator) )
	    	{
	    		$relations['voters'] = function($query) use($colaborator) {
    				$query->where('colaborator', $colaborator)
    					->orderBy('voters.superior', 'asc');
    			};
	    	}

	    	$collection = self::with($relations);

	    	if( ! is_null($polling_stations_ids))
	    	{
	    		$collection = $collection->whereIn('id', $polling_stations_ids);
	    	}	

	        return $collection->get()->sortByDesc(function($pollingStation) {
	        	return $pollingStation->voters->count();
	        });
	    }

	    public static function withVotersDayD($polling_stations_ids = null, $rol_ids = null, $colaborator = null)
	    {
	    	$relations = ['votersDayD', 'votersDayD.roles', 'votersDayD.location.superiorLocation.superiorLocation', 'location'];

	    	if( ! is_null($rol_ids) )
	    	{
	    		$relations['votersDayD'] = function($query) use($rol_ids, $colaborator){
    				$query->join('voters_has_roles', function ($join) use($rol_ids) {
			            $join->on('voter_id', '=', 'voters.id')
			            	->whereIn('voters_has_roles.rol_id', $rol_ids);
			        })->groupBy('voters.id');
    			};
	    	}
	    	else if( ! is_null($colaborator) )
	    	{
	    		$relations['votersDayD'] = function($query) use($colaborator) {
    				$query->where('colaborator', $colaborator);
    			};
	    	}

	    	$collection = self::with($relations);

	    	if( ! is_null($polling_stations_ids))
	    	{
	    		$collection = $collection->whereIn('id', $polling_stations_ids);
	    	}	

	        return $collection->get()->sortByDesc(function($pollingStation) {
	        	return $pollingStation->votersDayD->count();
	        });
	    }

	    public function getDescriptionAttribute($value)
	    {
	    	if(is_null($value))
	    	{
	    		$value = $this->name;
	    	}

	        return ucwords($value);
	    }

	    public function getLocationNameAttribute()
	    {
	        return $this->location->name;
	    }

	    public function getRegistraduriaLocationNameAttribute()
	    {
	        return $this->registraduriaLocation->name;
	    }

	    public function getNumberStat($val)
	    {
	    	$attribute = 'number' . $val;
	    	return $this->$attribute;
	    }

	    public function getPercentStat($val)
	    {
	    	$attribute = 'percent' . $val;
	    	return $this->attribute;
	    }

	    // Number Voters General
	    public function getNumberVotersAttribute()
	    {
	        return $this->voters->count();
	    }

	    public function getNumberOnlyVotersAttribute()
	    {
	        return $this->voters->whereLoose('colaborator', 0)->count();
	    }

	    public function getNumberTeamAttribute()
	    {
	        return $this->voters->whereLoose('colaborator', 1)->count();
	    }

	    // Number Voters Day D
	    public function getNumberVotersDayDAttribute()
	    {
	        return $this->votersDayD->count();
	    }

	    public function getNumberOnlyVotersDayDAttribute()
	    {
	        return $this->votersDayD->whereLoose('colaborator', 0)->count();
	    }

	    public function getNumberTeamDayDAttribute()
	    {
	        return $this->votersDayD->whereLoose('colaborator', 1)->count();
	    }

	    // Number Voters Rol General
	    public function getNumberRol($rol_id)
	    {
	    	return $this->voters->filter(function ($voter) use ($rol_id) {
	    		return $voter->roles->whereLoose('id', $rol_id)->first();
			})->count();
	    }

	    public function getPercentRol($rol_id)
	    {
	    	$number_voters = $this->number_voters;

	    	if($number_voters > 0)
	    	{	
	        	return ($this->getNumberRol($rol_id) / $number_voters) * 100;
	        }

	        return 0;
	    }

	    // Number Voters Rol Day D
	    public function getNumberRolDayD($rol_id)
	    {
	    	return $this->votersDayD->filter(function ($voter) use ($rol_id) {
	    		return $voter->roles->whereLoose('id', $rol_id)->first();
			})->count();
	    }

	    public function getPercentRolDayD($rol_id)
	    {
	    	$number_voters_day_d = $this->number_voters_day_d;

	    	if($number_voters_day_d > 0)
	    	{	
	        	return ($this->getNumberRolDayD($rol_id) / $number_voters_day_d) * 100;
	        }

	        return 0;
	    }


	    // Percent Voters General
	    public function getPercentOnlyVotersAttribute()
	    {
	    	$number_voters = $this->number_voters;

	    	if($number_voters > 0)
	    	{	
	        	return ($this->number_only_voters / $number_voters) * 100;
	        }

	        return 0;
	    }

	    public function getPercentTeamAttribute()
	    {
	    	$number_voters = $this->number_voters;

	    	if($number_voters > 0)
	    	{		
				return ($this->number_team / $number_voters) * 100;
			}

			return 0;
	    }

	    // Percent Voters Day D
	    public function getPercentOnlyVotersDayDAttribute()
	    {
	    	$number_voters_day_d = $this->number_voters_day_d;

	    	if($number_voters_day_d > 0)
	    	{	
	        	return ($this->number_only_voters_day_d / $number_voters_day_d) * 100;
	        }

	        return 0;
	    }

	    public function getPercentTeamDayDAttribute()
	    {
	    	$number_voters_day_d = $this->number_voters_day_d;

	    	if($number_voters_day_d > 0)
	    	{		
				return ($this->number_team_day_d / $number_voters_day_d) * 100;
			}

			return 0;
	    }

	    public function voters()
	    {
	        return $this->hasMany('Victorem\Entities\Voter');
	    }

	    public function votersDayD()
	    {
	        return $this->hasMany('Victorem\Entities\Voter', 'polling_station_day_d', 'id');
	    }

	    public function location()
		{
			return $this->hasOne('Victorem\Entities\Location', 'id', 'location_id');
		}	

		public function registraduriaLocation()
		{
			return $this->hasOne('Victorem\Entities\Location', 'id', 'registraduria_location_id');
		}	

	}
 ?>