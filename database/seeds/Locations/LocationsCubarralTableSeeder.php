<?php 

use \Illuminate\Database\Seeder;
use Victorem\Entities\Location;

class LocationsCubarralTableSeeder extends Seeder
{
    public static $locations = [
        ['name' => 'cubarral', 'type' => 2, 'superior' => null],
        //Barrios
        ['name' => 'El Centro', 'type' => 4, 'superior' => 1],
        ['name' => 'El Paraíso', 'type' => 4, 'superior' => 1],
        ['name' => 'El Jardín', 'type' => 4, 'superior' => 1],
        ['name' => 'El Prado', 'type' => 4, 'superior' => 1],
        ['name' => 'Santa Lucia', 'type' => 4, 'superior' => 1],
        ['name' => 'El Sinaí', 'type' => 4, 'superior' => 1],
        ['name' => 'El Triunfo', 'type' => 4, 'superior' => 1],
        ['name' => 'San Luis Beltrán', 'type' => 4, 'superior' => 1],
        ['name' => 'San Pedro', 'type' => 4, 'superior' => 1],
        ['name' => 'Villa Luz', 'type' => 4, 'superior' => 1],
        ['name' => 'El Porvenir', 'type' => 4, 'superior' => 1],
        ['name' => 'Prados del Rey', 'type' => 4, 'superior' => 1],
        ['name' => 'San Alejo', 'type' => 4, 'superior' => 1],
        ['name' => 'Colinas de San Vicente', 'type' => 4, 'superior' => 1],
        ['name' => 'Portales de Santa Isabel', 'type' => 4, 'superior' => 1],
        //Veredas
        ['name' => 'Monserrate', 'type' => 6, 'superior' => 1],
        ['name' => 'Los Alpes', 'type' => 6, 'superior' => 1],
        ['name' => 'Santa Bárbara', 'type' => 6, 'superior' => 1],
        ['name' => 'Bellavista', 'type' => 6, 'superior' => 1],
        ['name' => 'Brisas del Tonoa', 'type' => 6, 'superior' => 1],
        ['name' => 'La Libertad', 'type' => 6, 'superior' => 1],
        ['name' => 'La Libertad Alta', 'type' => 6, 'superior' => 1],
        ['name' => 'El Retiro', 'type' => 6, 'superior' => 1],
        ['name' => 'La Amistad', 'type' => 6, 'superior' => 1],
        ['name' => 'Arrayanes', 'type' => 6, 'superior' => 1],
        ['name' => 'Palomas ', 'type' => 6, 'superior' => 1],
        ['name' => 'La Unión', 'type' => 6, 'superior' => 1],
        ['name' => 'Rio Azul', 'type' => 6, 'superior' => 1],
        ['name' => 'Aguas Claras', 'type' => 6, 'superior' => 1],
        ['name' => 'El Jujuaro', 'type' => 6, 'superior' => 1],
        ['name' => 'El Vergel', 'type' => 6, 'superior' => 1],
        ['name' => 'El Vergel Alto', 'type' => 6, 'superior' => 1],
        ['name' => 'El Central', 'type' => 6, 'superior' => 1],
        ['name' => 'Mesa Redonda', 'type' => 6, 'superior' => 1],
        ['name' => 'Marayal ', 'type' => 6, 'superior' => 1],
        ['name' => 'San Miguel', 'type' => 6, 'superior' => 1],
        ['name' => 'Centro Poblado Puerto Ariari', 'type' => 6, 'superior' => 1],
        ['name' => 'Sierra Morena', 'type' => 6, 'superior' => 1],
        ['name' => 'Rio Grande', 'type' => 6, 'superior' => 1]      
    ];

    public function run()
    {
        $locations = self::$locations;

        foreach ($locations as $location) {         
            Location::create([
                'name'      => $location['name'],
                'type_id'   => $location['type'],
                'superior'  => $location['superior'],
                'electoral_potential'   => 0,
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime 
            ]);                
        }
    }
}

?>