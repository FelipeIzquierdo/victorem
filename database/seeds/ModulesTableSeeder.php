<?php 

use \Illuminate\Database\Seeder;
use Victorem\Entities\Module;

class ModulesTableSeeder extends Seeder
{
    public function run()
    {
        /* Data Base */
        Module::create([
            'name' => 'database',
            'description' => 'Base de Datos',
            'image'   => 'images/placeholders/icons/pc.png',
            'url'   => 'database',
            'icon_class'    => 'gi gi-display'
        ]);

    	Module::create([
    		'name' => 'voters',
            'description' => 'Votantes',
            'superior'  => 1,
            'image'   => 'images/placeholders/icons/feed_db.png',
            'url'   => 'database/voters'
    	]);

    	Module::create([
    		'name' => 'team',
            'description' => 'Equipo de Campaña',
            'superior'  => 1,
            'image'   => 'images/placeholders/icons/search_db.png',
            'url'   => 'database/team'
    	]);

    	Module::create([
    		'name' => 'roles',
            'description' => 'Estructura de Campaña',
            'superior'  => 1,
            'image'   => 'images/placeholders/icons/structure_db.png',
            'url'   => 'database/roles'
    	]);
        /* End Data Base */

        Module::create([
            'name' => 'reports',
            'description' => 'Reportes',
            'image'   => 'images/placeholders/icons/print.png',
            'url'   => 'reports',
            'color_class'   => 'themed-background-danger',
            'icon_class'    => 'fa fa-file-text'

        ]);

        Module::create([
            'name' => 'statistics',
            'description' => 'Estadísticas',
            'image'   => 'images/placeholders/icons/stats.png',
            'url'   => 'statistics',
            'color_class'   => 'themed-background-warning',
            'icon_class'    => 'hi hi-stats'
        ]);

        //diary
        Module::create([
            'name' => 'diary',
            'description' => 'Agenda',
            'image'   => 'images/placeholders/icons/calendar.png',
            'url'   => 'diary',
            'color_class'   => 'themed-background-success',
            'icon_class'    => 'hi hi-calendar'
        ]);

        Module::create([
            'name' => 'logistic',
            'description' => 'Logística',
            'image'   => 'images/placeholders/icons/box.png',
            'url'   => 'logistic',
            'color_class'   => 'themed-background-success',
            'icon_class'    => 'gi gi-group'
        ]);

        Module::create([
            'name' => 'advertising',
            'description' => 'Publicidad',
            'image'   => 'images/placeholders/icons/bag.png',
            'url'   => 'advertising',
            'color_class'   => 'themed-background-danger',
            'icon_class'    => 'hi hi-flag'
        ]);

        Module::create([
            'name' => 'schedule',
            'description' => 'Agendar',
            'superior'  => 7,
            'image'   => 'images/placeholders/icons/feed_db.png',
            'url'   => 'diary/listar'
        ]);

        Module::create([
            'name' => 'show-diary',
            'description' => 'Ver Agenda',
            'superior'  => 7,
            'image'   => 'images/placeholders/icons/calendar.png',
            'url'   => 'diary/show'
        ]);
        //end diary

        Module::create([
            'name' => 'sms',
            'description' => 'Envío SMS',
            'image'   => 'images/placeholders/icons/sms.png',
            'url'   => 'sms',
            'type'  => 'extra',
            'icon_class'    => 'hi hi-fullscreen'
        ]);

        Module::create([
            'name' => 'emails',
            'description' => 'Envío Emails',
            'image'   => 'images/placeholders/icons/email.png',
            'url'   => 'http://mailchimp.com',
            'type'  => 'extra',
            'icon_class'    => 'gi gi-inbox'
        ]);

        Module::create([
            'name' => 'witnesses',
            'description' => 'Testigos electorales',
            'image'   => 'images/placeholders/icons/user.png',
            'url'   => 'witnesses',
            'type'  => 'extra',
            'active'    => false,
            'icon_class'    => 'fa fa-check-square-o'
        ]);

        Module::create([
            'name' => 'system',
            'description' => 'Sistema',
            'image'   => 'images/placeholders/icons/user.png',
            'url'   => 'system',
            'type'  => 'system',
            'icon_class'    => 'fa fa-asterisk'
        ]);

        Module::create([
            'name' => 'delete-voters',
            'description' => 'Eliminar Votantes',
            'image'   => 'images/placeholders/icons/user.png',
            'type'  => 'system',
            'icon_class'    => 'fa fa-asterisk',
            'superior'  => 2
        ]);

        Module::create([
            'name' => 'add-to-team-voters',
            'description' => 'Agregar Votante al Equipo',
            'image'   => 'images/placeholders/icons/user.png',
            'type'  => 'system',
            'icon_class'    => 'fa fa-asterisk',
            'superior'  => 2
        ]);

        Module::create([
            'name' => 'polls',
            'description' => 'Sondeos de Opinión',
            'image'   => 'images/placeholders/icons/poll.png',
            'type'  => 'extra',
            'icon_class'    => 'fa fa-phone',
            'url'  => 'polls'
        ]);
    }
}

?>