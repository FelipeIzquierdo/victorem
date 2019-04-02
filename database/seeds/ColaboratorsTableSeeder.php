<?php 

use \Illuminate\Database\Seeder;
use Victorem\Entities\Voter;
use Victorem\Libraries\Campaing;

class ColaboratorsTableSeeder extends Seeder
{
    public function run()
    {
        Voter::create([
        	'doc'               => Campaing::getCandidateDoc(),
            'name' 		        => Campaing::getCandidateName(),
            'location_id'       => 1,
            'colaborator'       => true,
            'delegate'          => true,
            'created_at'        => new DateTime,
            'updated_at'        => new DateTime 
        ]);
    }
}

?>