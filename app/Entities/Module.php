<?php namespace Victorem\Entities;

use Illuminate\Database\Eloquent\Model; 
	/**
	* 
	*/
	class Module extends Model
	{
		protected $table = 'modules';
		public $timestamp = true;
		public $increments = true;
		public static $types = ['main' => 'main', 'extra' => 'extra', 'system' => 'system'];
		protected $fillable = ['name', 'description', 'superior', 'color_class', 'icon_class', 
			'image', 'type', 'active', 'url'
		];

		/*Mutators*/
		public function getSuperiorDescriptionAttribute()
		{
			if($superior = $this->superiorModule)
			{
				return $superior->description;
			}

			return 'Sin superior';
		}

		/* Querys */
		public static function allPaginate($number_pages = 10)
	    {
	        return self::orderBy('updated_at')->paginate($number_pages);
	    }

		public static function allLists()
	    {
	        return self::lists('description', 'id')->all();
	    }

		/* Scopes */
	    public function scopeActive($query)
	    {
	    	return $query->whereActive(true);
	    }

	    public function scopeIsSuperior($query)
	    {
	    	return $query->whereNull('superior');
	    }

	    public function scopeSelectNecesary($query)
	    {
	    	return $query->select('description', 'color_class', 'icon_class', 'image', 'type', 'url');
	    }

	    public function scopeOfMenu($query)
	    {
	    	return $query->selectNecesary()
	        	->active()
	        	->isSuperior()
	        	->whereIn('type', ['main', 'extra']);
	    }
	    
	    /* Functions */
	    public function isName($name)
	    {
	    	if($this->name == $name)
	    	{
	    		return true;
	    	}

	    	return false;
	    }

	    public function ofSuperior($superior)
	    {
	    	if(!$this->isSuperior() && $this->superiorModule->name == $superior)
	    	{
	    		return true;
	    	}

	    	return false;
	    }

	    public function isType($type)
	    {
	    	if($this->type == $type)
	    	{
	    		return true;
	    	}

	    	return false;
	    }

	    public function isMain()
	    {
	    	return $this->isType('main');
	    }

	    public function isExtra()
	    {
	    	return $this->isType('extra');
	    }

	    public function isSuperior()
	    {
	    	if(is_null($this->superior))
	    	{
	    		return true;
	    	}

	    	return false;
	    }

	    public function isSuperiorAndType($type)
	    {
	    	if($this->isSuperior() && $this->isType($type))
	    	{
	    		return true;
	    	}

	    	return false;
	    }	

	    public function superiorModule()
	    {
	        return $this->belongsTo('Victorem\Entities\Module', 'superior');
	    }

	    /* Relations */
		public function userTypes()
	    {
	        return $this->belongsToMany('Victorem\Entities\UserType');
	    }

	    public function fillAndSave($data)
	    {
	        if(array_key_exists('active', $data))
	        {
	            $data['active'] = 1;
	        }
	        else
	        {
	            $data['active'] = 0;
	        }

	        $this->fill($data); 

	        if(empty($data['superior']))
	        {
	            $this->superior = null;
	        } 

	        $this->save();
	    }
	}
 ?>