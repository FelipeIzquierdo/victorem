<?php 

use \Illuminate\Database\Seeder;
use Victorem\Entities\Location;

class LocationsGirardotTableSeeder extends Seeder
{   
    public static $locations = [
    	['name' => 'girardot', 'type' => 2, 'superior' => null],
    	//COMUNAS
    	['name' => 'Comuna 1 Centro', 'type' => 3, 'superior' => 1],
		['name' => 'Comuna 2 Sur', 'type' => 3, 'superior' => 1],
		['name' => 'Comuna 3 Occidente', 'type' => 3, 'superior' => 1],
		['name' => 'Comuna 4 Norte', 'type' => 3, 'superior' => 1],
		['name' => 'Comuna 5 Oriente', 'type' => 3, 'superior' => 1],
		/* BARRIOS */
		//Comuna 1
		['name' => 'Acacias', 'type' => 4, 'superior' => 2],
		['name' => 'Centro', 'type' => 4, 'superior' => 2],
		['name' => 'Granada', 'type' => 4, 'superior' => 2],
		['name' => 'La Magdalena', 'type' => 4, 'superior' => 2],
		['name' => 'Miraflores', 'type' => 4, 'superior' => 2],
		['name' => 'San Antonio', 'type' => 4, 'superior' => 2],
		['name' => 'San Miguel', 'type' => 4, 'superior' => 2],
		['name' => 'Santander', 'type' => 4, 'superior' => 2],
		['name' => 'Sucre', 'type' => 4, 'superior' => 2],
		//Comuna 2
		['name' => 'Alto de la Cruz' , 'type' => 4, 'superior' => 3],
		['name' => 'Alto del Rosario' , 'type' => 4, 'superior' => 3],
		['name' => 'Alto de las Rosas' , 'type' => 4, 'superior' => 3],
		['name' => 'Bocas del Bogotá' , 'type' => 4, 'superior' => 3],
		['name' => 'Diez de Mayo' , 'type' => 4, 'superior' => 3],
		['name' => 'Divino Niño' , 'type' => 4, 'superior' => 3],
		['name' => 'El Porvenir' , 'type' => 4, 'superior' => 3],
		['name' => 'Parques B. del Bogotá' , 'type' => 4, 'superior' => 3],
		['name' => 'Puerto Cabrera' , 'type' => 4, 'superior' => 3],
		['name' => 'Puerto Mongui' , 'type' => 4, 'superior' => 3],
		['name' => 'Puerto Montero' , 'type' => 4, 'superior' => 3],
		['name' => 'Santa Mónica' , 'type' => 4, 'superior' => 3],
		['name' => 'Veinte de Julio' , 'type' => 4, 'superior' => 3],
		//Comuna 3
		['name' => 'Arrayanes', 'type' => 4, 'superior' => 4],
		['name' => 'Buenos Aires', 'type' => 4, 'superior' => 4],
		['name' => 'Cambulos Etapa 1 y 2', 'type' => 4, 'superior' => 4],
		['name' => 'Cambulos Etapa 3', 'type' => 4, 'superior' => 4],
		['name' => 'Centenario', 'type' => 4, 'superior' => 4],
		['name' => 'La Esperanza', 'type' => 4, 'superior' => 4],
		['name' => 'La Esperanza Etapa 4', 'type' => 4, 'superior' => 4],
		['name' => 'Estación', 'type' => 4, 'superior' => 4],
		['name' => 'Gaitán', 'type' => 4, 'superior' => 4],
		['name' => 'Gólgota', 'type' => 4, 'superior' => 4],
		['name' => 'Urb. Hda. Girardot', 'type' => 4, 'superior' => 4],
		['name' => 'Urb. Hda. Girardot Etapa II', 'type' => 4, 'superior' => 4],
		['name' => 'La Colina', 'type' => 4, 'superior' => 4],
		['name' => 'Meneses', 'type' => 4, 'superior' => 4],
		['name' => 'Ntra. Sra. del Cármen', 'type' => 4, 'superior' => 4],
		['name' => 'Pozo Azul', 'type' => 4, 'superior' => 4],
		['name' => 'Quintas', 'type' => 4, 'superior' => 4],
		['name' => 'Quinto Patio', 'type' => 4, 'superior' => 4],
		['name' => 'Santa Elena', 'type' => 4, 'superior' => 4],
		['name' => 'Santa Isabel', 'type' => 4, 'superior' => 4],
		['name' => 'Villa Alexander', 'type' => 4, 'superior' => 4],
		['name' => 'Urb. Villa Cecilia', 'type' => 4, 'superior' => 4],
		['name' => 'Villanpiss', 'type' => 4, 'superior' => 4],
		['name' => 'Vivisol', 'type' => 4, 'superior' => 4],
		//Comuna 4
		['name' => 'Algarrobos Etapa 3', 'type' => 4, 'superior' => 5],
		['name' => 'Algarrobos Etapa 4', 'type' => 4, 'superior' => 5],
		['name' => 'Altos del Peñón', 'type' => 4, 'superior' => 5],
		['name' => 'Ciudad Montes', 'type' => 4, 'superior' => 5],
		['name' => 'Corazón de C/marca', 'type' => 4, 'superior' => 5],
		['name' => 'Diamante Central', 'type' => 4, 'superior' => 5],
		['name' => 'Diamante Nororiental', 'type' => 4, 'superior' => 5],
		['name' => 'Diamante Etapa 5', 'type' => 4, 'superior' => 5],
		['name' => 'Esmeralda 1er Sector', 'type' => 4, 'superior' => 5],
		['name' => 'Esmeralda Etapa 2', 'type' => 4, 'superior' => 5],
		['name' => 'Esmeralda Etapa 3', 'type' => 4, 'superior' => 5],
		['name' => 'Esperanza Norte', 'type' => 4, 'superior' => 5],
		['name' => 'Juan Pablo 2', 'type' => 4, 'superior' => 5],
		['name' => 'Los Naranjos', 'type' => 4, 'superior' => 5],
		['name' => 'Ramón Bueno', 'type' => 4, 'superior' => 5],
		['name' => 'Rosablanca', 'type' => 4, 'superior' => 5],
		['name' => 'Rosablanca 2 Sector', 'type' => 4, 'superior' => 5],
		['name' => 'San Fernando', 'type' => 4, 'superior' => 5],
		['name' => 'Santa Rita', 'type' => 4, 'superior' => 5],
		['name' => 'Solaris', 'type' => 4, 'superior' => 5],
		['name' => 'Talisman', 'type' => 4, 'superior' => 5],
		//Comuna 5
		['name' => 'Brisas del Bogotá', 'type' => 4, 'superior' => 6],
		['name' => 'Cedro Villa Olarte', 'type' => 4, 'superior' => 6],
		['name' => 'Kennedy', 'type' => 4, 'superior' => 6],
		['name' => 'Kennedy III Sector', 'type' => 4, 'superior' => 6],
		['name' => 'La Carolina', 'type' => 4, 'superior' => 6],
		['name' => 'La Victoria', 'type' => 4, 'superior' => 6],
		['name' => 'Magdalena III', 'type' => 4, 'superior' => 6],
		['name' => 'Obrero', 'type' => 4, 'superior' => 6],
		['name' => 'Portachuelo', 'type' => 4, 'superior' => 6],
		['name' => 'Primero de Enero', 'type' => 4, 'superior' => 6],
		['name' => 'Salsipuedes', 'type' => 4, 'superior' => 6],
		['name' => 'San Jorge', 'type' => 4, 'superior' => 6],
		['name' => 'Santa Fe', 'type' => 4, 'superior' => 6],
		['name' => 'El Triunfo', 'type' => 4, 'superior' => 6],
		['name' => 'Villa Kennedy', 'type' => 4, 'superior' => 6],
		//VEREDAS
		['name' => 'Barzalosa Centro', 'type' => 6, 'superior' => 1],
		['name' => 'Barzalosa Cementerio', 'type' => 6, 'superior' => 1],
		['name' => 'Berlín', 'type' => 6, 'superior' => 1],
		['name' => 'Guabinal Cerro', 'type' => 6, 'superior' => 1],
		['name' => 'Guabinal Plan', 'type' => 6, 'superior' => 1],
		['name' => 'Los Prados I Sector', 'type' => 6, 'superior' => 1],
		['name' => 'Luis Carlos Galán', 'type' => 6, 'superior' => 1],
		['name' => 'Piamonte', 'type' => 6, 'superior' => 1],
		['name' => 'Presidente', 'type' => 6, 'superior' => 1],
		['name' => 'Acapulco (Zumbamicos)', 'type' => 6, 'superior' => 1],
		['name' => 'Aguablanca', 'type' => 6, 'superior' => 1],
		['name' => 'Potrerillo', 'type' => 6, 'superior' => 1],
		['name' => 'San Lorenzo', 'type' => 6, 'superior' => 1]
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





