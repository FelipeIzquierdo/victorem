<?php 

use \Illuminate\Database\Seeder;
use Victorem\Entities\Rol;
use Victorem\Libraries\Campaing;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        Rol::create([
            'name'          => Campaing::getCandidateName(),
            'description'	=> Campaing::getCandidateName(),
            'created_at'    => new DateTime,
            'updated_at'    => new DateTime 
        ]); 

        if(Campaing::isDemo()) // Only Demo
        {
            Rol::create([
                'name' => 'Coordinador Político',
                'superior'	=> 1,
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime 
            ]);

            Rol::create([
                'name' => 'Gerente de Campaña',
                'superior'	=> 1,
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime 
            ]);

            Rol::create([
                'name' => 'Agenda Jefe',
                'superior'	=> 1,
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime 
            ]);

            Rol::create([
                'name' => 'Asesor de Prensa',
                'superior'	=> 1,
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime 
            ]);

            //6

            Rol::create([
                'name' => 'Coordinador de Comunas',
                'superior'	=> 2,
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime 
            ]);

            Rol::create([
                'name' => 'Coordinador de Municipios',
                'superior'	=> 2,
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime 
            ]);

            Rol::create([
                'name' => 'Coordinador',
                'superior'	=> 7,
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime 
            ]);

            Rol::create([
                'name' => 'Coordinador de Publicidad',
                'superior'	=> 3,
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime 
            ]);

            Rol::create([
                'name' => 'Agenda Móvil',
                'superior'	=> 4,
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime 
            ]);

            Rol::create([
                'name' => 'Agenda Sede Principal',
                'superior'	=> 4,
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime 
            ]);
        }
    }
}

?>