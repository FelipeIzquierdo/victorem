<?php namespace Victorem\Entities;

use Illuminate\Database\Eloquent\Model;  
/**
* 
*/

class LocationType extends Model
{
	protected $table 	= 'location_types';
	public $timestamp 	= true;
	
	public function superior()
    {
        return $this->belongsTo('Victorem\Entities\LocationType', 'superior', 'id');
    }

    public static function allLists()
    {
        return self::lists('name', 'id')->all();
    }
	
}


?>