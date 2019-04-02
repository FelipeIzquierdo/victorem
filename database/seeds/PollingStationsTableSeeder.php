<?php 

use \Illuminate\Database\Seeder;
use Victorem\Entities\PollingStation;

class PollingStationsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create();
        
        /* Team */      
        for ($i = 0; $i < 15; $i++)
        {
            PollingStation::create([
                'name' 			=> $faker->company,
                'address'    => $faker->streetName,
                'registraduria_location_id'	=> $faker->numberBetween(2, 38),
                'electoral_potential'   => $faker->numberBetween(150, 355),
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime 
            ]);
        }
    }
}

?>