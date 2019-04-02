<?php 

use \Illuminate\Database\Seeder;
use Victorem\Entities\Location;

class LocationsYopalTableSeeder extends Seeder
{   
    public static $locations = [
        ['name' => 'yopal', 'type' => 2, 'superior' => null],
        // Comunas de YOPAL
        ['name' => 'comuna 1', 'type' =>  3, 'superior' => 1],
        ['name' => 'comuna 2', 'type' =>  3, 'superior' => 1],
        ['name' => 'comuna 3', 'type' =>  3, 'superior' => 1],
        ['name' => 'comuna 4', 'type' =>  3, 'superior' => 1],
        ['name' => 'comuna 5', 'type' =>  3, 'superior' => 1],
        // Corregimientos de YOPAL        
        ['name' => 'alcaravan la niata', 'type' => 5, 'superior' => 1],
        ['name' => 'punto nuevo', 'type' => 5, 'superior' => 1],
        ['name' => 'matelimon', 'type' => 5, 'superior' => 1],
        ['name' => 'el charte', 'type' => 5, 'superior' => 1],
        ['name' => 'el morro', 'type' => 5, 'superior' => 1],
        ['name' => 'la chaparrera', 'type' => 5, 'superior' => 1],
        ['name' => 'morichal', 'type' => 5, 'superior' => 1],
        ['name' => 'tacarimena', 'type' => 5, 'superior' => 1],
        ['name' => 'tilodiran', 'type' => 5, 'superior' => 1],
        ['name' => 'quebradaseca', 'type' => 5, 'superior' => 1],
        
    ];

    public function run()
    {
        $locations = self::$locations;

        foreach ($locations as $location) {         
            Location::create([
                'name'      => $location['name'],
                'type_id'   => $location['type'],
                'superior'  => $location['superior'],
                'electoral_potential'   => 0,
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime 
            ]);                
        }
    }
}

?>