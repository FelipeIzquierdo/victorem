<?php

use \Illuminate\Database\Seeder;
use Victorem\Libraries\Campaing;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

        $this->call('LocationTypesTableSeeder'); // Static
        
        $this->call(Campaing::getLocationsSeeder()); // Diminamic

        $this->call('OccupationsTableSeeder'); // Static
		$this->call('UserTypesTableSeeder'); // Static
		$this->call('ModulesTableSeeder'); // Static
		$this->call('UserTypesHasModulesTableSeeder'); // Static
		$this->call('UsersTableSeeder'); // Static
		$this->call('ColaboratorsTableSeeder'); //Static
		$this->call('RolesTableSeeder'); // Static

		if(Campaing::isDemo()) // Only Demo
		{
			$this->call('PollingStationsTableSeeder'); // Only Demo
	        $this->call('CommunitiesTableSeeder'); // Only Demo
			$this->call('VotersTableSeeder'); // Only Demo
		}
		
	}

}

/**
* 
*/
