<?php 

use \Illuminate\Database\Seeder;
use Victorem\Entities\Occupation;

class OccupationsTableSeeder extends Seeder
{
    public static $occupations = [
        'Abogado', 'Administrador de empresas', 'Administrador Público', 'Adminitrador Técnico', 'Agricultor', 
        'Arquitecto', 'Asesor Comercial', 'Auxiliar de Enfermería', 'Bacteriólogo', 'Comerciante', 'Comunicador Social', 
        'Conductor', 'Contador Público', 'Médico', 'Economista', 'Empleado', 'Empleado Bancario', 'Enfermero', 'Escolta', 
        'Estudiante', 'Folclorista', 'Fundición', 'Ganadero', 'Hogar', 'Independiente', 'Ingeniero Ambiental', 
        'Ingeniero Industrial', 'Ingeniero Agroindustrial', 'Matemático', 'Ingeniero Químico', 'Ingeniero de Sistemas', 
        'Ingeniero Agrónomo', 'Ingeniero Civil', 'Inmobiliario', 'Licenciado Educación Física', 
        'Maderero', 'Maestro de Construcción', 'Mecánico', 'Mercadeo Agropecuario', 
        'Publicista', 'Músico', 'Negocios Internacionales', 'Odontólogo', 'Oficios Varios', 'Panadero', 'Estilista', 'Pensionado', 
        'Piloto', 'Policia', 'Profesor de Tenis', 'Psicólogo', 'Seguros', 
        'Taxista', 'Tercera Edad', 'Transportador', 'Veterinario'     
    ];

    public function run()
    {
        foreach (self::$occupations as $occupation) 
        {
            Occupation::create([
                'name'             => $occupation,
                'created_at'       => new DateTime,
                'updated_at'       => new DateTime 
            ]);
        }
    }
}

?>