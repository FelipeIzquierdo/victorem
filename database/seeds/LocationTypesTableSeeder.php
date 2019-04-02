<?php 

use \Illuminate\Database\Seeder;
use Victorem\Entities\LocationType;

class LocationTypesTableSeeder extends Seeder
{
    public function run()
    {
        LocationType::create([
            'name' => 'departamento',
            'created_at'    => new DateTime,
            'updated_at'    => new DateTime 
        ]);

        LocationType::create([
            'name'      => 'municipios',
            'superior'  => 1,
            'created_at'    => new DateTime,
            'updated_at'    => new DateTime 
        ]);

        LocationType::create([
            'name'      => 'comunas',
            'superior'  => 2,
            'created_at'    => new DateTime,
            'updated_at'    => new DateTime 
        ]);

        LocationType::create([
            'name'      => 'barrios',
            'superior'  => 3,
            'created_at'    => new DateTime,
            'updated_at'    => new DateTime 
        ]);

        LocationType::create([
            'name'      => 'corregimientos',
            'superior'  => 2,
            'created_at'    => new DateTime,
            'updated_at'    => new DateTime 
        ]);

        LocationType::create([
            'name'      => 'veredas',
            'superior'  => 2,
            'created_at'    => new DateTime,
            'updated_at'    => new DateTime 
        ]);
    }
}

?>