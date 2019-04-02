<?php 

use \Illuminate\Database\Seeder;
use Victorem\Entities\Community;

class CommunitiesTableSeeder extends Seeder
{
    public function run()
    {
        Community::create([
            'name' 			=> 'Caballistas de Villavicencio',
            'description' 	=> 'Personas que asisten a las Cabalgatas de Villavicencio',
            'created_at'    => new DateTime,
            'updated_at'    => new DateTime 
        ]);

        Community::create([
            'name' 			=> 'Futbolistas',
            'created_at'    => new DateTime,
            'updated_at'    => new DateTime 
        ]);
    }
}

?>