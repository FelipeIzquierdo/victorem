<?php 

use \Illuminate\Database\Seeder;
use Victorem\Entities\Location;

class LocationsCasanareTableSeeder extends Seeder
{   
    public static $locations = [
        ['name' => 'casanare', 'type' => 1, 'superior' => null],
        ['name' => 'yopal', 'type' => 2, 'superior' => 1],
        ['name' => 'aguazul', 'type' => 2, 'superior' => 1],
        ['name' => 'chameza', 'type' => 2, 'superior' => 1],
        ['name' => 'hato corozal', 'type' => 2, 'superior' => 1],
        ['name' => 'la salina', 'type' => 2, 'superior' => 1],
        ['name' => 'mani', 'type' => 2, 'superior' => 1],
        ['name' => 'monterrey', 'type' => 2, 'superior' => 1],
        ['name' => 'nunchia', 'type' => 2, 'superior' => 1],
        ['name' => 'orocue', 'type' => 2, 'superior' => 1],
        ['name' => 'paz de ariporo', 'type' => 2, 'superior' => 1],
        ['name' => 'pore', 'type' => 2, 'superior' => 1],
        ['name' => 'recetor', 'type' => 2, 'superior' => 1],
        ['name' => 'sabanalarga', 'type' => 2, 'superior' => 1],
        ['name' => 'sacama', 'type' => 2, 'superior' => 1],
        ['name' => 'san luis de palenque', 'type' => 2, 'superior' => 1],
        ['name' => 'tamara', 'type' => 2, 'superior' => 1],
        ['name' => 'tauramena', 'type' => 2, 'superior' => 1],
        ['name' => 'trinidad', 'type' => 2, 'superior' => 1],
        ['name' => 'villanueva', 'type' =>  2, 'superior' => 1],
        // Comunas de YOPAL
        ['name' => 'comuna 1', 'type' =>  3, 'superior' => 2],
        ['name' => 'comuna 2', 'type' =>  3, 'superior' => 2],
        ['name' => 'comuna 3', 'type' =>  3, 'superior' => 2],
        ['name' => 'comuna 4', 'type' =>  3, 'superior' => 2],
        ['name' => 'comuna 5', 'type' =>  3, 'superior' => 2],
        // Corregimientos de YOPAL
        ['name' => 'colegio braulio gonzalez', 'type' => 5, 'superior' => 2],
        ['name' => 'carcel municipal', 'type' => 5, 'superior' => 2],
        ['name' => 'alcaravan la niata', 'type' => 5, 'superior' => 2],
        ['name' => 'punto nuevo', 'type' => 5, 'superior' => 2],
        ['name' => 'matelimon', 'type' => 5, 'superior' => 2],
        ['name' => 'el charte', 'type' => 5, 'superior' => 2],
        ['name' => 'el morro', 'type' => 5, 'superior' => 2],
        ['name' => 'la chaparrera', 'type' => 5, 'superior' => 2],
        ['name' => 'morichal', 'type' => 5, 'superior' => 2],
        ['name' => 'tacarimena', 'type' => 5, 'superior' => 2],
        ['name' => 'tilodiran', 'type' => 5, 'superior' => 2],
        ['name' => 'quebradaseca', 'type' => 5, 'superior' => 2],
        // Corregimientos de AGUAZUL
        ['name' => 'bellavista', 'type' => 5, 'superior' => 3],
        ['name' => 'cunama', 'type' => 5, 'superior' => 3],
        ['name' => 'cupiagua', 'type' => 5, 'superior' => 3],
        ['name' => 'guadalcanal', 'type' => 5, 'superior' => 3],
        ['name' => 'la turua', 'type' => 5, 'superior' => 3],
        ['name' => 'monterralo', 'type' => 5, 'superior' => 3],
        ['name' => 'san jose del bubuy', 'type' => 5, 'superior' => 3],
        ['name' => 'san miguel de farallones', 'type' => 5, 'superior' => 3],
        ['name' => 'unete', 'type' => 5, 'superior' => 3],
        // Corregimientos de Hato Corozal
        ['name' => 'berlin', 'type' => 5, 'superior' => 5],
        ['name' => 'chire', 'type' => 5, 'superior' => 5],
        ['name' => 'corralito', 'type' => 5, 'superior' => 5],
        ['name' => 'el guafal', 'type' => 5, 'superior' => 5],
        ['name' => 'la frontera (la chapa)', 'type' => 5, 'superior' => 5],
        ['name' => 'las camelias', 'type' => 5, 'superior' => 5],
        ['name' => 'las tapias', 'type' => 5, 'superior' => 5],
        ['name' => 'manare', 'type' => 5, 'superior' => 5],
        ['name' => 'paso real de ariporo', 'type' => 5, 'superior' => 5],
        ['name' => 'puerto colombia', 'type' => 5, 'superior' => 5],
        ['name' => 'resguardo caño mochuelo', 'type' => 5, 'superior' => 5],
        ['name' => 'san jose de ariporo', 'type' => 5, 'superior' => 5],
        ['name' => 'san nicolas', 'type' => 5, 'superior' => 5],
        ['name' => 'san salvador', 'type' => 5, 'superior' => 5],
        ['name' => 'santa barbara', 'type' => 5, 'superior' => 5],
        ['name' => 'santa rita', 'type' => 5, 'superior' => 5],
        // Corregimientos de Mani
        ['name' => 'chavinabe', 'type' => 5, 'superior' => 7],
        ['name' => 'fronteras', 'type' => 5, 'superior' => 7],
        ['name' => 'guafalpintado', 'type' => 5, 'superior' => 7],
        ['name' => 'la poyata', 'type' => 5, 'superior' => 7],
        ['name' => 'la gloria (ventanas)', 'type' => 5, 'superior' => 7],
        ['name' => 'las gaviotas', 'type' => 5, 'superior' => 7],
        ['name' => 'paso real de guariamena', 'type' => 5, 'superior' => 7],
        ['name' => 'san joaquin de garibay', 'type' => 5, 'superior' => 7],
        ['name' => 'sta elena de cusiva', 'type' => 5, 'superior' => 7],
        // Corregimientos de Monterrey
        ['name' => 'carcel', 'type' => 5, 'superior' => 8],
        ['name' => 'brisas del llano', 'type' => 5, 'superior' => 8],
        ['name' => 'el porvenir', 'type' => 5, 'superior' => 8],
        ['name' => 'la orqueta', 'type' => 5, 'superior' => 8],
        ['name' => 'palo negro', 'type' => 5, 'superior' => 8],
        ['name' => 'villa carola', 'type' => 5, 'superior' => 8],
        // Corregimientos de Nunchia
        ['name' => 'barbacoas', 'type' => 5, 'superior' => 9],
        ['name' => 'barranquilla', 'type' => 5, 'superior' => 9],
        ['name' => 'corea', 'type' => 5, 'superior' => 9],
        ['name' => 'el amparo', 'type' => 5, 'superior' => 9],
        ['name' => 'el caucho', 'type' => 5, 'superior' => 9],
        ['name' => 'el conchal', 'type' => 5, 'superior' => 9],
        ['name' => 'el cazadero', 'type' => 5, 'superior' => 9],
        ['name' => 'el pretexto', 'type' => 5, 'superior' => 9],
        ['name' => 'el veladero', 'type' => 5, 'superior' => 9],
        ['name' => 'guanapalo', 'type' => 5, 'superior' => 9],
        ['name' => 'la palmira', 'type' => 5, 'superior' => 9],
        ['name' => 'pedregal', 'type' => 5, 'superior' => 9],
        ['name' => 'puerto tocaria', 'type' => 5, 'superior' => 9],
        ['name' => 'sirivana', 'type' => 5, 'superior' => 9],
        ['name' => 'vizerta', 'type' => 5, 'superior' => 9],
        // Corregimientos de Orocue
        ['name' => 'banco largo', 'type' => 5, 'superior' => 10],
        ['name' => 'bocas del cravo', 'type' => 5, 'superior' => 10],
        ['name' => 'churrubay', 'type' => 5, 'superior' => 10],
        ['name' => 'el algarrobo (cravosur)', 'type' => 5, 'superior' => 10],
        ['name' => 'el duya', 'type' => 5, 'superior' => 10],
        ['name' => 'tujua', 'type' => 5, 'superior' => 10],
        // Corregimientos de Paz de Ariporo
        ['name' => 'carcel', 'type' => 5, 'superior' => 11],
        ['name' => 'bocas de la hermosa', 'type' => 5, 'superior' => 11],
        ['name' => 'caño chiquito', 'type' => 5, 'superior' => 11],
        ['name' => 'las guamas', 'type' => 5, 'superior' => 11],
        ['name' => 'moreno', 'type' => 5, 'superior' => 11],
        ['name' => 'montaña del totumo', 'type' => 5, 'superior' => 11],
        // Corregimientos de Pore
        ['name' => 'el banco', 'type' => 5, 'superior' => 12],
        ['name' => 'la plata', 'type' => 5, 'superior' => 12],
        // Corregimientos de Recetor
        ['name' => 'los alpes', 'type' => 5, 'superior' => 13],
        ['name' => 'pueblo nuevo', 'type' => 5, 'superior' => 13],
        // Corregimientos de Sabanalarga
        ['name' => 'aguaclara', 'type' => 5, 'superior' => 14],
        ['name' => 'el secreto', 'type' => 5, 'superior' => 14],
        // Corregimientos de San Luis de Palenque
        ['name' => 'miramar de guanapalo (bocas d', 'type' => 5, 'superior' => 16],
        ['name' => 'gaviotas quiteve', 'type' => 5, 'superior' => 16],
        ['name' => 'jagueyes', 'type' => 5, 'superior' => 16],
        ['name' => 'la venturosa', 'type' => 5, 'superior' => 16],
        ['name' => 'riverita', 'type' => 5, 'superior' => 16],
        ['name' => 'san francisco', 'type' => 5, 'superior' => 16],
        ['name' => 'san rafael de guanapalo', 'type' => 5, 'superior' => 16],
        ['name' => 'sirivana algodonale', 'type' => 5, 'superior' => 16],
        // Corregimientos de Tamara
        ['name' => 'el ariporo', 'type' => 5, 'superior' => 17],
        ['name' => 'la florida', 'type' => 5, 'superior' => 17],
        ['name' => 'tablon de tamara', 'type' => 5, 'superior' => 17],
        ['name' => 'tabloncito', 'type' => 5, 'superior' => 17],
        ['name' => 'ten (teislandia)', 'type' => 5, 'superior' => 17],
        // Corregimientos de Tauramena
        ['name' => 'carupana', 'type' => 5, 'superior' => 18],
        ['name' => 'corocito', 'type' => 5, 'superior' => 18],
        ['name' => 'paso cusiana', 'type' => 5, 'superior' => 18],
        ['name' => 'el raizal', 'type' => 5, 'superior' => 18],
        ['name' => 'la urama', 'type' => 5, 'superior' => 18],
        // Corregimientos de Trinidad
        ['name' => 'belgica', 'type' => 5, 'superior' => 19],
        ['name' => 'bocas del pauto', 'type' => 5, 'superior' => 19],
        ['name' => 'caiman', 'type' => 5, 'superior' => 19],
        ['name' => 'guamal', 'type' => 5, 'superior' => 19],
        ['name' => 'paso real de la soledad', 'type' => 5, 'superior' => 19],
        ['name' => 'el convento', 'type' => 5, 'superior' => 19],
        ['name' => 'los chochos', 'type' => 5, 'superior' => 19],
        ['name' => 'santa irene', 'type' => 5, 'superior' => 19],
        ['name' => 'san vicente', 'type' => 5, 'superior' => 19],
        // Corregimientos de Villanueva
        ['name' => 'caribayona', 'type' => 5, 'superior' => 20],
        ['name' => 'san agustin', 'type' => 5, 'superior' => 20],
        ['name' => 'santa helena de upia', 'type' => 5, 'superior' => 20]
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