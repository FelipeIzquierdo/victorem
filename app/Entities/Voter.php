<?php namespace Victorem\Entities;

use Illuminate\Database\Eloquent\Model;  
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

use Victorem\Libraries\Campaing;
use Victorem\Libraries\WebScraping;
use Session, DB, Auth;
use Carbon\Carbon;

/**
* 
*/
class Voter extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

	protected $table = 'voters';
	public $timestamp = true;
	
    protected $fillable = ['doc', 'name', 'email', 'telephone', 'sex', 'superior', 'occupation', 'description',
		'date_of_birth', 'location_id', 'address', 'table_number', 'delegate', 'polling_station_day_d'];
    
    public $result_scraping = null;

    /* Scopes */
    public function scopeIsTeam($query, $isTeam = true)
    {
        return $query->whereColaborator($isTeam);
    }

    public function scopeIsDelegate($query, $isDelegate = true)
    {
        return $query->whereDelegate($isDelegate);
    }

    public function scopeIsSex($query, $sex = array('F', 'M'))
    {
        return $query->whereIn('sex', $sex);
    }

    public function scopeWithAll($query)
    {
        return $query->with('location', 'roles', 'occupations', 'communities', 'pollingStation', 'pollingStationDay', 
                        'superiorVoter', 'diaries', 'organizedDiaries', 'delegatedDiaries', 'voters');
    }

    public function isNew()
    {
        if($this->created_at == $this->updated_at)
        {
            return true;
        }

        return false;
    }

    
	/* Querys */
    public static function votersBirthDay()
    {
        return self::whereNotNull('date_of_birth')
            ->whereNotNull('telephone')
            ->get();
    }

    public static function withBirthdayCurrentMonth()
    {
        return self::whereNotNull('date_of_birth')->orderBy('date_of_birth')->get()->filter(function($voter)
        {
            return $voter->isBirthdayCurrentMonth();
        });
    }

    public static function whereNullPollingStation()
    {
        return self::whereNull('polling_station_id')
            ->with('superior')
            ->get();
    }

    public static function withSex($sex = null)
    {
        return self::isSex($sex)->get();
    }

    public static function votersPaginate($number_pages = 10, $isColaborator = false, $order = null)
    {
        if(Auth::user()->type->can_view_all)
        {
            $voters = self::withAll()->whereColaborator($isColaborator);
        }
        else
        {
            $voters = Auth::user()->voters()->with('location', 'roles')->whereColaborator($isColaborator);
        }

        if( ! is_null($order)) {
            $voters = $voters->where(function ($query) use($order) {
                $query->where('name', 'like', strtolower($order) . '%')
                    ->orWhere('name', 'like', ucwords($order) . '%');
            }); 
        }

        return $voters->orderBy('name', 'asc')->paginate($number_pages);
    }

    public static function teamPaginate($number_pages = 10)
    {
        return self::votersPaginate($number_pages, true);
    }

    public static function allTeam()
    {
        return self::isTeam()->with('roles')->get()->lists('name_with_roles', 'id')->all();
    }

    public static function allDelegates()
    {
        return self::isDelegate()->lists('name', 'id')->all();
    }

    public static function allVoterOfColaborator($colaborator_id)
    {
        return self::whereSuperior($colaborator_id)->isTeam(false)->get();
    }

    public static function allVotersOfTeam($team_ids = [])
    {
        return self::whereIn('superior', $team_ids)->isTeam(false)->get();
    }

    public static function getTeamWithVoters($team_ids = null)
    {
        $team = self::isTeam()->with(['voters' => function($query){
                $query->whereColaborator(false);
            }, 'location']);

        if(!is_null($team_ids))
        {
            $team = $team->whereIn('id', $team_ids);
        }
        
        return $team->get();
    }

    public function getAllDiariesAttribute()
    {
        return $this->diaries->merge($this->organizedDiaries->merge($this->delegatedDiaries));
    }

    public static function numberVoters()
    {
        return self::count();
    }

    public static function getGoalPercentage()
    {
        return (self::numberVoters() / Campaing::getTargetNumber()) * 100;
    }

	/* Relations */
	public function location()
    {
        return $this->belongsTo('Victorem\Entities\Location', 'location_id', 'id');
    }

    public function pollingStation()
    {
        return $this->belongsTo('Victorem\Entities\PollingStation', 'polling_station_id');
    }

    public function pollingStationDay()
    {
        return $this->belongsTo('Victorem\Entities\PollingStation', 'polling_station_day_d');
    }

    public function superior()
    {
        return $this->belongsTo('Victorem\Entities\Voter', 'superior', 'id');
    }

    public function superiorVoter()
    {
        return $this->belongsTo('Victorem\Entities\Voter', 'superior', 'id');
    }

    public function voters()
    {
        return $this->hasMany('Victorem\Entities\Voter', 'superior', 'id');
    }

    public function organizedDiaries()
    {
        return $this->hasMany('Victorem\Entities\Diary', 'organizer_id', 'id');
    }

    public function delegatedDiaries()
    {
        return $this->hasMany('Victorem\Entities\Diary', 'delegate_id', 'id');
    }

    public function communities()
    {
        return $this->belongsToMany('Victorem\Entities\Community', 'voters_has_communities', 'voter_id', 'community_id');
    }

    public function occupations()
    {
        return $this->belongsTo('Victorem\Entities\Occupation', 'occupation', 'id');
    }

    public function roles()
    {
        return $this->belongsToMany('Victorem\Entities\Rol', 'voters_has_roles', 'voter_id', 'rol_id');
    }

    public function diaries()
    {
        return $this->belongsToMany('Victorem\Entities\Diary');
    }

    /* Mutator Attribures */

    public function getNameAttribute($value)
    {
        return ucwords(strtolower($value));  
    }

    public function getAddressAttribute($value)
    {
        return ucwords(strtolower($value));  
    }

    public function getPollingStationNameAttribute()
    {
        if($this->pollingStation)
        {
            return ucwords($this->pollingStation->name);
        }

        return ' ';
    }

    public function getPollingStationDescriptionAttribute()
    {
        if($this->pollingStation)
        {
            return $this->pollingStation->description;
        }

        return ' ';
    }

    public function getOccupationNameAttribute()
    {
        if($this->occupations)
        {
            return $this->occupations->name;
        }

        return ' ';
    }

    public function getFirstNameAttribute()
    {
        return explode(' ', $this->name)[0];
    }

    public function getHappyBirthdayAttribute()
    {
        return 'Hola ' . $this->first_name . ', Feliz Cumpleanos. Muchas felicidades en este dia tan especial. ' 
        . Campaing::getCandidateName();
    }

    public function getWelcomeMessageAttribute()
    {
        return 'Hola ' . $this->first_name . ', Gracias por unirte a nuestro equipo. Unidos lograremos nuestro Proposito. ' 
        . Campaing::getCandidateName();
    }

    public function getNumberVotersAttribute()
    {
        return $this->voters->count();
    }

    public function getLocationNameAttribute()
    {
        if($this->location)
        {
            return ucwords($this->location->name);
        }
        
        return 'Sin Ubicación';
    }

    public function getLocationRecursiveNameAttribute()
    {
        if($this->location)
        {
            return ucwords($this->location->name_recursive);
        }
        
        return 'Sin Ubicación';
    }

    public function getTitleReportAttribute()
    {
        return '(' . $this->superior_name . '), ' . $this->name_with_roles;
    }

    public function getSuperiorNameAttribute()
    {
        if($this->superiorVoter)
        {
            return $this->superiorVoter->name;
        }

        return 'Sin Referido';
    }

    public function getSuperiorNameWithRolesAttribute()
    {
        if($this->superiorVoter)
        {
            return $this->superiorVoter->name_with_roles;
        }

        return 'Sin Referido';
    }

    public function getCommunitiesListAttribute()
    {
        return $this->communities()->lists('id')->all();
    }

    public function getRolesListAttribute()
    {
        return $this->roles()->lists('id')->all();
    }

    public function getNameWithRolesAttribute()
    {
        $name_with_roles = $this->name;

        foreach ($this->roles as $count => $rol) 
        {
            if($count == 0)
            {
               $name_with_roles .= ' >> '; 
            }
            else
            {
                $name_with_roles .= ', '; 
            }

            $name_with_roles .= $rol->name ;
        }

        return $name_with_roles;
    }

    public function getNameWithRolesAndCommunitiesAttribute()
    {
        $name_with_roles_and_communities = $this->name_with_roles;

        foreach ($this->communities as $count => $community) 
        {
            if($count == 0)
            {
               $name_with_roles_and_communities .= ' ('; 
            }
            else
            {
                $name_with_roles_and_communities .= ', '; 
            }

            $name_with_roles_and_communities .= $community->name;
        }

        if($this->communities->count() > 0)
        {
            $name_with_roles_and_communities .= ')';
        }

        return $name_with_roles_and_communities;
    }

    public function getAllRolesAttribute()
    {
        if($this->colaborator)
        {
            $allRoles = '';
            
            foreach ($this->roles as $count => $rol) 
            {
                if($count > 0)
                {
                    $allRoles .= ', '; 
                }

                $allRoles .= $rol->name ;
            }
            
        }
        else
        {
            $allRoles = 'Votante';
        }

        return $allRoles;
    }

    public function getUpdatedAtHummansAttribute()
    {
        Carbon::setLocale('es');
        return ucfirst(Carbon::createFromFormat('Y-m-d H:i:s', $this->updated_at)->diffForHumans());
    }

    public function getTelTenNumbersAttribute()
    {
       return substr(trim($this->telephone), 0, 10);
    }

    public function getBirthDayMonthAttribute()
    {
        if($this->date_of_birth)
        {
            return date('d-M', strtotime($this->date_of_birth));
        }
    }

    /* Functions */
    public static function setTeamSession($voter_id)
    {
        Session::put('colaborator', $voter_id);
    }

    public static function getTeamSession()
    {
        return Session::get('colaborator', null);
    }

    public function getTeamSessionAttribute()
    {
        if($this->exists)
        {
            return $this->superior;
        }

        return Voter::getTeamSession();
    }

    public function isBirthdayCurrentMonth()
    {
        if(date('m', strtotime($this->date_of_birth)) == date('m'))
        {
            return true;
        }

        return false;
    }

    public static function searchLike($text, $number_page = 15)
    {
        $search = '%'. $text . '%';

        return self::withAll()
            ->where(function($query) use ($search) {
                $query->where('doc', 'like', $search)
                    ->orWhere('name', 'like', $search)
                    ->orWhere('email', 'like', $search)
                    ->orWhere('telephone', 'like', $search);
            })->paginate($number_page);
    }

    public static function findwithTrashedOrNew($doc)
    {
        $voter = self::withTrashed()->whereDoc($doc)->first();

        if(! $voter)
        {
            $voter = new Voter;
            $voter->doc = $doc;
        }

        return $voter;
    }

    public function getTextMessage($message)
    {
        $message = str_replace('[NOMBRE]', $this->first_name, $message);
        
        if($this->pollingStation)
        {
            $message = str_replace('[PUESTO]', $this->pollingStation->description, $message);
        }
        else
        {
            $message = str_replace('[PUESTO]', '      ', $message);
        }
        
        $message = str_replace('[MESA]', $this->table_number, $message);

        return $message;
    }

    public static function getFileSms($voters, $message)
    {
        $fileArray = [];

        foreach ($voters as $voter) 
        {
            $sms = [$voter->telephone, $voter->getTextMessage($message)];
            array_push($fileArray, $sms);
        }

        return $fileArray;
    } 

    public function hasPollingStation($refresh = false)
    {
        if(! is_null($this->pollingStation) && !$refresh)
        {   
            $this->pollingStation->load('location');
            $result['status'] = true;
            $result['polling_station'] = $this->pollingStation;
            $result['table_number'] = $this->table_number;
        }
        else
        {
            $result['status'] = false;
            $webScraper = new WebScraping;
            $content = $webScraper->run($this->doc);

            if($content['status'])
            {
                if($location = Location::findByName($content['location']))
                {
                    $pollingStation = PollingStation::firstOrNew([
                        'name'                          => $content['place'],
                        'registraduria_location_id'     => $location->id
                    ]);

                    if(! $pollingStation->exists)
                    {
                        $pollingStation->location_id    = $location->id;
                        $pollingStation->description    = $content['place'];
                    }

                    $pollingStation->address = $content['place_address'];
                    $pollingStation->save();

                    $result['status'] = true;
                    $pollingStation->load('location');
                    
                    $result['polling_station']  = $pollingStation;
                    $result['table_number']     = $content['table_number'];
                }
                else
                {
                    $result['message'] = 'La persona no vota dentro del lugar objetivo (' . $content['location'] . ')';    
                }
            }
            else if(array_key_exists('message', $content))
            {
                $result['message'] = $content['message'];
            }
            else
            {
                $result['message'] = 'Lo sentimos, la registraduria no responde';
            }            
        }

        return $result;
    }

    public function saveAndSync($data, $colaborator = false)
    {
        $this->fill($data);
        $this->colaborator = $colaborator;

        if( !empty($data['polling_station_id']) )
        {
            $this->polling_station_id = $data['polling_station_id'];
        }

        if( empty($data['polling_station_day_d']) )
        {
            $this->polling_station_day_d = $data['polling_station_id'];

            if( empty($data['polling_station_id']) ) 
            {
                $this->polling_station_day_d = null;
            }
        }
        
        if(empty($data['date_of_birth']))
        {
            $this->date_of_birth = null;
        }

        if(empty($data['occupation']) || !empty($data['new-occupation']))
        {
            $this->syncNewOccupation($data['new-occupation']);
        }

        if(!$this->exists)
        {
            $this->created_by = Auth::user()->id;    
        }

        if(array_key_exists('delegate', $data))
        {
            $this->delegate = 1;
        }
        else
        {
            $this->delegate = 0;
        }
        
        $this->save();

        if(array_key_exists('communities', $data))
        {
            $this->communities()->sync($data['communities']);
        }
        else
        {
            $this->communities()->sync([]);
        }

        $this->syncNewCommunities($data['new-communities']);

        if(array_key_exists('roles', $data))
        {
            $this->roles()->sync($data['roles']);
        }
        else
        {
            $this->roles()->sync([]);
        }

        if($this->trashed())
        {
            $this->restore();
        }

        return true;
    }


    public function syncNewCommunities($communities)
    {
        if(!is_null($communities) && !empty($communities))
        {
            $communities = explode(",", $communities);
            foreach ($communities as $name) 
            {
                $newCommunity = Community::firstOrCreate(['name' => trim($name)]);
                $this->communities()->attach($newCommunity);
            }
        }
    }

    public function syncNewOccupation($occupation)
    {
        if(!is_null($occupation) && !empty($occupation))
        {
            $newOccupation = Occupation::firstOrCreate(['name' => $occupation]);
            $this->occupation = $newOccupation->id;
        }
        else
        {
            $this->occupation = null;
        }
    }

    public static function getFilterVoters($data)
    {
        if( !array_key_exists('locations', $data) || (count($data['locations']) == 1 && reset($data['locations']) == 1)) 
        {
            $voters = self::whereNotNull('location_id');                
        }
        else
        {
            $voters = self::whereIn('location_id', Location::getAllOrderIds($data['locations']));
        }

        if(array_key_exists('sex', $data))
        {
            $voters = $voters->isSex($data['sex']);
        }

        if(array_key_exists('polling_stations', $data))
        {
            $voters = $voters->whereIn('polling_station_id', $data['polling_stations']);
        }

        if(array_key_exists('communities', $data))
        {
            $voters = $voters->join('voters_has_communities', 'voters.id', '=', 'voters_has_communities.voter_id')
                ->whereIn('voters_has_communities.community_id', $data['communities']);
        }

        if(array_key_exists('roles', $data))
        {
            $voters = $voters->join('voters_has_roles', 'voters.id', '=', 'voters_has_roles.voter_id')
                ->whereIn('voters_has_roles.rol_id', $data['roles']);
        }

        if(array_key_exists('occupations', $data))
        {
            $voters = $voters->whereIn('occupation', $data['occupations']);
        }
        
        return $voters;
    }

    public static function getTelephones($data)
    {
        $telephones = self::getFilterVoters($data)
            ->where(DB::raw('CHAR_LENGTH(telephone)'), '=', '10')
            ->lists('telephone')->all();

        return $telephones;
    }

    public static function getVotersWithTelephones($data)
    {
        $telephones = self::getFilterVoters($data)
            ->where(DB::raw('CHAR_LENGTH(telephone)'), '=', '10')
            ->get();

        return $telephones;
    }

    public static function getVoterSex($sex)
    {
        $voters = self::isSex($sex)->get();

        return $voters;
    }
}