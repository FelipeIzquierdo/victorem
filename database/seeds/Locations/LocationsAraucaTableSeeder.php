<?php 

use \Illuminate\Database\Seeder;
use Victorem\Entities\Location;

class LocationsAraucaTableSeeder extends Seeder
{   
    public static $locations = [
        ['name' => 'arauca', 'type' => 1, 'superior' => null],
        ['name' => 'arauca', 'type' => 2, 'superior' => 1],
        ['name' => 'arauquita', 'type' => 2, 'superior' => 1],
        ['name' => 'cravo norte', 'type' => 2, 'superior' => 1],
        ['name' => 'fortul', 'type' => 2, 'superior' => 1],
        ['name' => 'puerto rondón', 'type' => 2, 'superior' => 1],
        ['name' => 'saravena', 'type' => 2, 'superior' => 1],
        ['name' => 'tame', 'type' => 2, 'superior' => 1]
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