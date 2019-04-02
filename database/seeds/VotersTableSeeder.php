<?php 

use \Illuminate\Database\Seeder;
use Victorem\Entities\Voter;

class VotersTableSeeder extends Seeder
{
    public function run()
    {
    	$faker = Faker\Factory::create();
 		
 		/* Team */ 		
		for ($i = 0; $i < 30; $i++)
		{
	        Voter::create([
	        	'doc'	=> 1121895026 + $i,
	            'name' => $faker->name,
	            'telephone'	=> $faker->PhoneNumber,
	            'email'	=> $faker->email,
	            'address'	=> $faker->streetName,
	            'location_id'	=> $faker->numberBetween(2, 38),
	            'sex'	=> $faker->randomElement(['M', 'F']),
	            'colaborator'	=> true,
	            'superior'	=> $faker->numberBetween(1, $i + 1),
	            'polling_station_id'	=> $faker->numberBetween(1, 15),
	            'created_by'	=> 2,
	            'created_at'    => new DateTime,
	            'updated_at'    => new DateTime 
	        ]);
	    }
	    
	    /* Voters */
		for ($i = 0; $i < 200; $i++)
		{
	        Voter::create([
	        	'doc'	=> 1121895126 + $i,
	            'name' => $faker->name,
	            'telephone'	=> $faker->PhoneNumber,
	            'email'	=> $faker->email,
	            'address'	=> $faker->streetName,
	            'location_id'	=> $faker->numberBetween(2, 38),
	            'sex'	=> $faker->randomElement(['M', 'F']),
	            'colaborator'	=> false,
	            'superior'	=> $faker->numberBetween(2, 29),
	            'polling_station_id'	=> $faker->numberBetween(1, 15),
	            'created_by'	=> 3,
	            'created_at'    => new DateTime,
	            'updated_at'    => new DateTime 
	        ]);
	    }
    }
}

?>