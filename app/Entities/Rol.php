<?php namespace Victorem\Entities;

use Illuminate\Database\Eloquent\Model; 
use Victorem\Libraries\Campaing;
	/**
	* 
	*/
	class Rol extends Model
	{
		protected $table = 'roles';
		public $timestamp = true;
		protected $fillable = ['name', 'description', 'superior'];

		public function rolsuperior()
	    {
	        return $this->belongsTo('Victorem\Entities\Rol', 'superior', 'id');
	    }

	    public function childrenRoles()
	    {
	        return $this->hasMany('Victorem\Entities\Rol', 'superior', 'id');
	    }

	    public function voters()
		{
			return $this->belongsToMany('Victorem\Entities\Voter', 'voters_has_roles', 'rol_id', 'voter_id');
		}

	    public static function createdRoles($number_pages = 10)
	    {
	        return self::with('rolsuperior')->orderBy('updated_at', 'desc')->paginate($number_pages);
	    }

	    public function getSuperiorNameAttribute()
	    {
	    	if($this->rolsuperior)
	    	{
	    		return $this->rolsuperior->name;
	    	}

	    	return 'sin superior';
	    }

	    public function getUpdatedAtForHumansAttribute()
	    {
	       return LocalizedCarbon::instance($this->updated_at)->diffForHumans();
	    }

	    public static function allLists()
	    {
	        return self::lists('name', 'id')->all();
	    }

	    public function scopeUnderlings($query, $rol_id)
	    {
	        return $query->where('superior', '=', $rol_id);
	    }

	    public static function getTree()
	    {
	    	$roles = self::whereSuperior(1)
	    		->with('childrenRoles.childrenRoles.childrenRoles.childrenRoles.childrenRoles.childrenRoles.childrenRoles.childrenRoles')
				->get();

	    	return self::listsRecursive($roles) . '</li></ul>';
	    }

	    public static function listsRecursive($roles, &$lists = null)
	    {
	    	if(is_null($lists))
	    	{
	    		$photo = Campaing::getPhoto();
	    		$lists = '<ul id="roles-tree"><li><img class="img-thumbnail img-thumbnail-avatar-2x" src="' . $photo . '">';
	    	}

	    	if(!is_null($roles))
	    	{
	    		$lists .= '<ul>';
	    	}

	    	foreach ($roles as $rol) 
	    	{
	    		$lists .= '<li data-roledit="'.route('database.roles.edit', $rol->id).'"><p>'.$rol->name.'</p>';

	    		self::listsRecursive($rol->childrenRoles, $lists);
	    		
	    		$lists .= '</li>';
	    	}

	    	if(!is_null($roles))
	    	{
	    		$lists .= '</ul>';
	    	}

	    	return $lists;
	    }

	    public static function getTelephones($roles_id)
	    {
	    	$tels = [];
	    	foreach(self::withVoters($roles_id) as $rol)
	    	{
	    		foreach ($rol->voters as $voter) 
	    		{
	    			if(! is_null($voter->telephone))
	    			{
	    				array_push($tels, $voter->telephone);
	    			}
	    		}
	    	}

	    	return $tels;
	    }

	    public static function withVoters($roles_id = [])
	    {
	    	if(is_null($roles_id))
	    	{
	    		return self::with('voters')->get();
	    	}
	    	
	        return self::whereIn('id', $roles_id)->with('voters')->get();
	    }

	    public static function withTeam($rol_ids = [])
	    {	
	        return self::whereIn('id', $rol_ids)
	        	->with(['voters.superiorVoter' => function($query){
                		$query->isTeam();
            		}, 'voters.superiorVoter.roles' => function($query) {
                		$query->orderBy('roles.name');
            		}
            	]);
	    }

	}
?>