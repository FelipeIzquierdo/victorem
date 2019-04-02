<?php 

use \Illuminate\Database\Seeder;
use Victorem\Entities\Location;

class LocationsAcaciasTableSeeder extends Seeder
{
    public function run()
    {
        Location::create([
            'name'                  => 'Acacias',
            'type_id'               => 2,
            'electoral_potential'   => 51288,
            'created_at'            => new DateTime,
            'updated_at'            => new DateTime 
        ]);
    }
}

?>