<?php 

use \Illuminate\Database\Seeder;
use Victorem\Entities\UserType;

class UserTypesTableSeeder extends Seeder
{
    public function run()
    {
    	UserType::create([
    		'name'    => 'Súper Aministrador',
            'system'  => 1 
    	]);

    	UserType::create([
    		'name' => 'Aministrador de Campaña'
    	]);

    	UserType::create([
    		'name' => 'Digitador'
    	]);

        UserType::create([
            'name' => 'Invitado'
        ]);
    }
}

?>