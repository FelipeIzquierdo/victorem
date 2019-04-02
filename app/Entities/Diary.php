<?php namespace Victorem\Entities;

use Illuminate\Database\Eloquent\Model; 
use DateTime;
	/**
	* 
	*/
	class Diary extends Model
	{
		protected $table = 'diary';
		public $timestamp = true;

		protected $fillable = [
			'name', 
			'location_id', 
			'place', 
			'description', 
			'date', 
			'time', 
			'endtime',
			'hasdelegate', 
			'delegate_id',
			'organizer_id',
			'logistic',
			'advertising',
			'people'
		];

		public $errors;

		/**
		 * Clean data
		 *
		 */
		private function cleanData(&$data)
		{
			$data['hasdelegate'] = array_key_exists('hasdelegate', $data) ? 1 : 0;	
			$data['time'] = DateTime::createFromFormat('h:i A', $data['time']);
			$data['endtime'] = DateTime::createFromFormat('h:i A', $data['endtime']);
		}

		public function fillAndSave($data)
		{			
			$this->cleanData($data);
			$this->fill($data);
			$this->save();
		}

		public function location()
	    {
	        return $this->belongsTo('Victorem\Entities\Location', 'location_id', 'id');
	    }

	    public function delegate()
	    {
	    	return $this->belongsTo('Victorem\Entities\Voter', 'delegate_id', 'id');
	    }

	    public function organizer()
	    {
	    	return $this->belongsTo('Victorem\Entities\Voter', 'organizer_id', 'id');
	    }

	    public function voters()
	    {
	        return $this->belongsToMany('Victorem\Entities\Voter');
	    }

	    public function getDelegateDefaultAttribute()
	    {
	    	if($this->delegate_id || is_null($value))
	    	{
	    		return $this->delegate_id;
	    	}

	    	return 1;
	    }

	    public function getOrganizerIdAttribute($value)
	    {
	    	if(! $this->exists || is_null($value))
	    	{
	    		return 1;
	    	}

	    	return $value;
	    }

	    public function getDelegateIdAttribute($value)
	    {
	    	if(! $this->exists)
	    	{
	    		return 1;
	    	}

	    	return $value;
	    }

	    public function getTimeForHumansAttribute()
	    {
	    	return date("h:i A", strtotime($this->time));
	    }

	    public function getTimeToEndtimeAttribute()
	    {
	    	return 'De '. date("h:i A", strtotime($this->time)) . ' a ' . date("h:i A", strtotime($this->endtime));
	    }

	    public function getEndTimeForHumansAttribute()
	    {
	    	return date("h:i A", strtotime($this->endtime));
	    }

	    public function getLocationPlaceAttribute()
	    {
	    	return $this->location->name . ', ' . $this->place;
	    }

	    public function getLogisticsAttribute()
	    {
	    	return explode(',', $this->logistic);
	    }

	    public function getAdvertisingsAttribute()
	    {
	    	return explode(',', $this->advertising);
	    }

	    public function getVotersPaginateAttribute()
	    {
	    	return $this->voters()->withAll()->paginate(10);
	    }

	}	

?>