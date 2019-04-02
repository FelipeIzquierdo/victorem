<?php 

use \Illuminate\Database\Seeder;
use Victorem\Entities\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name'          => 'Súper Administrador',
            'username'      => 'superadmin',
            'email'         => 'superadmin@victorem.info',
            'password'      => 123,
            'type_id'       => 1,
            'created_at'    => new DateTime,
            'updated_at'    => new DateTime 
        ]);

        User::create([
            'name'          => 'Andrés Pinzón',
            'username'      => 'admin',
            'email'         => 'andrestntx@victorem.info',
            'password'      => 123,
            'type_id'       => 2,
            'created_at'    => new DateTime,
            'updated_at'    => new DateTime 
        ]);

        User::create([
            'name'          => 'Digitadora Ana Maria',
            'username'      => 'ana',
            'email'         => 'admin@victorem.info',
            'password'      => 123,
            'type_id'       => 3,
            'created_at'    => new DateTime,
            'updated_at'    => new DateTime 
        ]);
    }
}

?>