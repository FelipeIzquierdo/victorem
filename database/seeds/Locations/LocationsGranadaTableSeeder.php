<?php 

use \Illuminate\Database\Seeder;
use Victorem\Entities\Location;

class LocationsGranadaTableSeeder extends Seeder
{   
    public static $locations = [
		['name' => 'granada', 'type' => 2, 'superior' => null],
		//BARRIOS
		['name' => 'EL DIAMANTE', 'type' => 4, 'superior' => 1],
		['name' => 'EL JARDIN', 'type' => 4, 'superior' => 1],
		['name' => 'EL TRIUNFO', 'type' => 4, 'superior' => 1],
		['name' => 'LA INMACULADA', 'type' => 4, 'superior' => 1],
		['name' => 'LA PEDAGOGICA', 'type' => 4, 'superior' => 1],
		['name' => 'PORVENIR', 'type' => 4, 'superior' => 1],
		['name' => 'PRADOS DEL NORTE', 'type' => 4, 'superior' => 1],
		['name' => 'URBANIZACION BULEVAR I', 'type' => 4, 'superior' => 1],
		['name' => 'URBANIZACION BULEVAR II', 'type' => 4, 'superior' => 1],
		['name' => 'VILLA UNION', 'type' => 4, 'superior' => 1],
		['name' => 'VILLALUZ', 'type' => 4, 'superior' => 1],
		['name' => 'VILLASALEM', 'type' => 4, 'superior' => 1],
		//VEREDAS
		['name' => 'ALTO EL TIGRE', 'type' => 6, 'superior' => 1],
		['name' => 'CAÑO ROJO', 'type' => 6, 'superior' => 1],
		['name' => 'LOS ANDES', 'type' => 6, 'superior' => 1],
		['name' => 'LOS MARACOS', 'type' => 6, 'superior' => 1],
		['name' => 'PUERTO SUAREZ', 'type' => 6, 'superior' => 1],
		['name' => 'VEREDA GUAYAQUIL', 'type' => 6, 'superior' => 1] 
    ];

    public function run()
    {
        $locations = self::$locations;

        foreach ($locations as $location) {         
            Location::create([
                'name'      => strtolower($location['name']),
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



