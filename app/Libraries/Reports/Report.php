<?php namespace Victorem\Libraries\Reports;

use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\Collection;

use Victorem\Entities\Voter;
use Victorem\Entities\Location;
use Victorem\Entities\PollingStation;
use Victorem\Entities\Community;
use Victorem\Entities\Rol;
use Victorem\Entities\Occupation;
use Victorem\Entities\LocationType;

use Victorem\Libraries\Fpdf\ReportTable;
use Victorem\Libraries\Campaing;


class Report extends Model
{
    protected $fillable = ['name', 'select', 'description', 'message', 'url', 'image'];
    public $primaryKey = 'name';

    public static function getAllPlain()
    {
        return new Collection([
            new Report([
                'name'          => 'recursive_team',
                'select'        => 'team',
                'description'   => 'Estructura de equipo',
                'message'       => 'Seleccione personas del equipo',
                'url'           => 'reports.recursive-team', 
                'image'         => '/images/placeholders/icons/user.png'            
            ]),
            new Report([
                'name'          => 'recursive_team_voters',
                'select'        => 'team',
                'description'   => 'Estructura de equipo con votatntes',
                'message'       => 'Seleccione personas del equipo',
                'url'           => 'reports.recursive-team-voters', 
                'image'         => '/images/placeholders/icons/user.png'            
            ]),
            new Report([
                'name'          => 'team_of_roles',
                'select'        => 'roles',
                'description'   => 'Equipo por Cargos',
                'message'       => 'Seleccione los Cargos',
                'url'           => 'reports.team-of-roles', 
                'image'         => '/images/placeholders/icons/user.png'            
            ]),
            new Report([
                'name'          => 'people',
                'select'        => 'sex',
                'description'   => 'Todos los Votantes',
                'message'       => 'Seleccione Sexo',
                'url'           => 'reports.people',
                'image'         => '/images/placeholders/icons/user.png'            
            ]),
            new Report([
                'name'          => 'delegates',
                'description'   => 'Delegados de Campaña',
                'url'           => 'reports.delegates', 
                'image'         => '/images/placeholders/icons/user.png'           
            ]),
            new Report([
                'name'          => 'people_of_communes',
                'select'        => 'communes',  
                'description'   => 'Votantes por Comunas',
                'message'       => 'Seleccione Comunas',
                'url'           => 'reports.people-of-locations',
                'image'         => '/images/placeholders/icons/user.png'            
            ]),
            new Report([
                'name'          => 'people_of_neighborhood',
                'select'        => 'neighborhoods',  
                'description'   => 'Votantes por Barrios',
                'message'       => 'Seleccione los Barrios',
                'url'           => 'reports.people-of-locations',
                'image'         => '/images/placeholders/icons/user.png'            
            ]),
            new Report([
                'name'          => 'people_of_vereda',
                'select'        => 'veredas',  
                'description'   => 'Votantes por Veredas',
                'message'       => 'Seleccione las Veredas',
                'url'           => 'reports.people-of-locations',
                'image'         => '/images/placeholders/icons/user.png'            
            ]),
            new Report([
                'name'          => 'people_of_polling_stations',
                'select'        => 'polling_stations',
                'description'   => 'Votantes por Puestos de Votación',
                'message'       => 'Seleccione Puestos de Votación',
                'url'           => 'reports.people-of-polling-stations',
                'image'         => '/images/placeholders/icons/user.png'              
            ]),
            new Report([
                'name'          => 'people_per_communities',
                'select'        => 'communities',
                'description'   => 'Votantes por Comunidades',
                'message'       => 'Seleccione Comunidades',
                'url'           => 'reports.people-of-communities',
                'image'         => '/images/placeholders/icons/user.png'            
            ]),
            new Report([
                'name'          => 'people_per_occupations',
                'select'        => 'occupations',
                'description'   => 'Votantes por Profesiones',
                'message'       => 'Seleccione Profesiones',
                'url'           => 'reports.people-of-occupations',
                'image'         => '/images/placeholders/icons/user.png'            
            ]),
            new Report([
                'name'          => 'people_birthday_current_month',
                'description'   => 'Votantes con cumpleaños',
                'url'           => 'reports.people-with-birthday-current-month',
                'image'         => '/images/placeholders/icons/user.png'            
            ]),
            new Report([
                'name'          => 'team',
                'description'   => 'Equipo de Campaña',
                'url'           => 'reports.team',
                'image'         => '/images/placeholders/icons/user.png'             
            ]),
            new Report([
                'name'          => 'voters_of_team',
                'select'        => 'team',
                'description'   => 'Votantes del equipo',
                'message'       => 'Seleccione integrantes del equipo',
                'url'           => 'reports.team-with-voters',
                'image'         => '/images/placeholders/icons/user.png'            
            ]),
            new Report([
                'name'          => 'plan_blank',
                'select'        => 'plans', 
                'description'   => 'Plan de Campaña',
                'message'       => 'Seleccione el plan de campaña',
                'url'           => 'reports.plans', 
                'image'         => '/images/placeholders/icons/user.png'           
            ]),
            new Report([
                'name'          => 'plan_team',
                'select'        => 'team',
                'description'   => 'Plan de Campaña de Equipo',
                'message'       => 'Seleccione integrantes del equipo',
                'url'           => 'reports.plans-team', 
                'image'         => '/images/placeholders/icons/user.png'           
            ]),
            new Report([
                'name'          => 'people_without_polling_station',
                'description'   => 'Personas sin puestos de votación',
                'url'           => 'reports.people-without-polling-station', 
                'image'         => '/images/placeholders/icons/user.png'           
            ]),
            new Report([
                'name'          => 'users',
                'description'   => 'Todos los usuarios',
                'url'           => 'reports.users', 
                'image'         => '/images/placeholders/icons/user.png'           
            ])
            
        ]);
    }

    public static function getAllGraphic()
    {
        return new Collection([
            new Report([
                'name'          => 'people_per_polling_stations',
                'select'        => null,
                'description'   => 'Número de votantes por puesto de votación',
                'message'       => 'Seleccione puestos de votación',
                'url'           => 'statistics.voters-of-polling-stations',
                'image'         => '/images/placeholders/icons/user.png'             
            ]),
            new Report([
                'name'          => 'people_per_polling_stations_day_d',
                'select'        => null,
                'description'   => 'Número de votantes UBICADOS por puesto de votación',
                'message'       => 'Seleccione puestos de votación',
                'url'           => 'statistics.voters-of-polling-stations-day-d',
                'image'         => '/images/placeholders/icons/user.png'             
            ]),
            new Report([
                'name'          => 'voters_per_locations',
                'select'        => 'location_types',
                'description'   => 'Número de Votantes por Ubicación',
                'message'       => 'Seleccione tipos de Ubicación',
                'url'           => 'statistics.voters-of-locations',
                'image'         => '/images/placeholders/icons/user.png'             
            ])
        ]);
    }

    public static function getSelects()
    {
        return [
            'location_types'    => LocationType::allLists(),
            'team'              => Voter::allTeam(),
            'communes'          => Location::allCommunes(),
            'municipalities'    => Location::allMunicipalities(),
            'neighborhoods'     => Location::allNeighborhoods(),
            'veredas'           => Location::allVeredas(),
            'polling_stations'  => PollingStation::allLists(),
            'communities'       => Community::allLists(),
            'occupations'       => Occupation::allLists(),
            'sex'               => ['F' => 'Femenino', 'M' => 'Masculino'],
            'plans'             => ReportTable::$plans,
            'roles'             => Rol::allLists()
        ];
    }

    public static function getAllPlainActive()
    {
        return self::getAllPlain()->only(Campaing::getReports());
    }

    public static function getAllGraphicActive()
    {
        return self::getAllGraphic()->only(Campaing::getStatistics());
    }

    public function getRouteJson($parameter)
    {
        return route($this->url, $parameter);
    }
}