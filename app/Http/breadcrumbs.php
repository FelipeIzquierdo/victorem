<?php 
	Breadcrumbs::register('modules', function($breadcrumbs){
		$breadcrumbs->push('<i class="fa fa-home"></i>', url('/'));
	});		

	Breadcrumbs::register('database', function($breadcrumbs){
		$breadcrumbs->parent('modules');
		$breadcrumbs->push('Base de Datos', url('database'));
	});	

	Breadcrumbs::register('voters', function($breadcrumbs){
		$breadcrumbs->parent('database');
		$breadcrumbs->push('Votantes', route('database.voters.index'));
	});	

	Breadcrumbs::register('voters.create', function($breadcrumbs, $voter){
		$breadcrumbs->parent('voters');
		if($voter->exists)
		{
			$breadcrumbs->push('Nuevo', route('database.voters.create'));
		}
		else
		{
			$breadcrumbs->push($voter->doc, route('database.voters.create', $voter->doc));
		}
	});	

	Breadcrumbs::register('voters.search', function($breadcrumbs, $text){
		$breadcrumbs->parent('voters');
		$breadcrumbs->push('Buscar: ' . $text, route('database.voters.create'));
	});	

	Breadcrumbs::register('team', function($breadcrumbs){
		$breadcrumbs->parent('database');
		$breadcrumbs->push('Equipo de Campaña', route('database.team.index'));
	});	

	Breadcrumbs::register('team.create', function($breadcrumbs){
		$breadcrumbs->parent('team');
		$breadcrumbs->push('Nuevo', route('database.team.create'));
	});	

	Breadcrumbs::register('colaborator', function($breadcrumbs, $colaborator){
		$breadcrumbs->parent('team');
		$breadcrumbs->push($colaborator->doc, route('database.team.create', $colaborator->doc));
	});

	Breadcrumbs::register('roles', function($breadcrumbs){
		$breadcrumbs->parent('database');
		$breadcrumbs->push('Estructura', route('database.roles.index'));
	});	

	Breadcrumbs::register('reports', function($breadcrumbs){
		$breadcrumbs->parent('modules');
		$breadcrumbs->push('Reportes', route('reports.index'));
	});	

	Breadcrumbs::register('statistics', function($breadcrumbs){
		$breadcrumbs->parent('modules');
		$breadcrumbs->push('Estadisticas', route('statistics.index'));
	});	

	Breadcrumbs::register('system', function($breadcrumbs){
		$breadcrumbs->parent('modules');
		$breadcrumbs->push('Sistema', url('system'));
	});	

	Breadcrumbs::register('user-types', function($breadcrumbs){
		$breadcrumbs->parent('system');
		$breadcrumbs->push('Tipos de usuario', url('system/user-types'));
	});	

	Breadcrumbs::register('user-types.create', function($breadcrumbs, $user_type){
		$breadcrumbs->parent('user-types');
		
		if(! $user_type->exists)
		{
			$breadcrumbs->push('Nuevo', route('system.user-types.create'));
		}
		else
		{
			$breadcrumbs->push($user_type->name, route('system.user-types.edit', $user_type->id));
		}
	});	

	Breadcrumbs::register('users', function($breadcrumbs){
		$breadcrumbs->parent('system');
		$breadcrumbs->push('Usuarios', url('system/users'));
	});	

	Breadcrumbs::register('users.create', function($breadcrumbs, $user){
		$breadcrumbs->parent('users');

		if(! $user->exists)
		{
			$breadcrumbs->push('Nuevo', route('system.users.create'));
		}
		else
		{
			$breadcrumbs->push($user->name, route('system.users.edit', $user->id));
		}
	});	

	Breadcrumbs::register('crud-modules', function($breadcrumbs){
		$breadcrumbs->parent('system');
		$breadcrumbs->push('Modulos', url('system/modules'));
	});	

	Breadcrumbs::register('crud-modules.create', function($breadcrumbs, $module){
		$breadcrumbs->parent('crud-modules');

		if(!$module->exists)
		{
			$breadcrumbs->push('Nuevo', route('system.modules.create'));
		}
		else
		{
			$breadcrumbs->push($module->name, route('system.modules.edit', $module->id));
		}
	});


	Breadcrumbs::register('crud-sms', function($breadcrumbs){
		$breadcrumbs->parent('system');
		$breadcrumbs->push('Sms', url('system/sms'));
	});	

	Breadcrumbs::register('crud-sms.create', function($breadcrumbs, $sms){
		$breadcrumbs->parent('crud-sms');
		
		if(! $sms->exists)
		{
			$breadcrumbs->push('Nuevo', route('system.sms.create'));
		}
		else
		{
			$breadcrumbs->push($sms->name, route('system.sms.edit', $sms->id));
		}
	});

	Breadcrumbs::register('polls', function($breadcrumbs){
		$breadcrumbs->parent('modules');
		$breadcrumbs->push('Sondeos de Opinión', route('polls.index'));
	});	

	Breadcrumbs::register('polls.show', function($breadcrumbs, $poll){
		$breadcrumbs->parent('polls');
		$breadcrumbs->push($poll->name, route('polls.show', $poll->id));
	});

	Breadcrumbs::register('polls.question', function($breadcrumbs, $poll, $question = null){
		$breadcrumbs->parent('polls.show', $poll);
		if(! $question->exists)
		{
			$breadcrumbs->push('Nueva Pregunta', route('polls.questions.create'));
		}
		else
		{
			$breadcrumbs->push($question->id, route('polls.questions.edit', $question->id));
		}
	});	

	Breadcrumbs::register('polls.options', function($breadcrumbs, $poll){
		$breadcrumbs->parent('polls');
		$breadcrumbs->push($poll->name, route('polls.voters.options', $poll->id));
	});

	Breadcrumbs::register('polls.voterPoll', function($breadcrumbs, $voterPoll){
		$breadcrumbs->parent('polls.options', $voterPoll->poll);
		$breadcrumbs->push($voterPoll->id, route('polls.voters.edit', [$voterPoll->poll->id, $voterPoll->id]));
	});

	Breadcrumbs::register('reports', function($breadcrumbs){
		$breadcrumbs->parent('system');
		$breadcrumbs->push('Reportes', url('system/reports'));
	});	

	Breadcrumbs::register('reports.create', function($breadcrumbs, $report){
		$breadcrumbs->parent('reports');
		if(! $report->exists)
		{
			$breadcrumbs->push('Nuevo', route('system.reports.create'));
		}
		else
		{
			$breadcrumbs->push($report->name, route('system.reports.edit', $report->id));
		}
	});

	Breadcrumbs::register('locations', function($breadcrumbs){
		$breadcrumbs->parent('system');
		$breadcrumbs->push('Ubicaciones', url('system/locations'));
	});

	Breadcrumbs::register('locations.create', function($breadcrumbs, $location){
		$breadcrumbs->parent('locations');

		if(!$location->exists)
		{
			$breadcrumbs->push('Nuevo', route('system.locations.create'));
		}
		else
		{
			$breadcrumbs->push($location->name, route('system.locations.edit', $location->id));
		}
	});	

	Breadcrumbs::register('polling-stations', function($breadcrumbs){
		$breadcrumbs->parent('system');
		$breadcrumbs->push('Puestos de Votación', url('system/polling-stations'));
	});

	Breadcrumbs::register('polling-stations.create', function($breadcrumbs, $polling_station){
		$breadcrumbs->parent('polling-stations');
		if(! $polling_station->exists)
		{
			$breadcrumbs->push('Nuevo', route('system.polling-stations.create'));
		}
		else
		{
			$breadcrumbs->push($polling_station->name, route('system.polling-stations.edit', $polling_station->id));
		}
	});

	Breadcrumbs::register('diary', function($breadcrumbs){
		$breadcrumbs->parent('modules');
		$breadcrumbs->push('Agenda', route('diary.index'));
	});	

	Breadcrumbs::register('diary.create', function($breadcrumbs, $diary){
		$breadcrumbs->parent('diary');
		if(! $diary->exists)
		{
			$breadcrumbs->push('Nuevo', route('diary.create'));
		}
		else
		{
			$breadcrumbs->push($diary->name, route('diary.edit', $diary->id));
		}
	});

	Breadcrumbs::register('diary.people', function($breadcrumbs, $diary){
		$breadcrumbs->parent('diary');
		$breadcrumbs->push('Asistencia', route('diary.people.index', $diary->id));
	});


	Breadcrumbs::register('logistic', function($breadcrumbs){
		$breadcrumbs->parent('modules');
		$breadcrumbs->push('Logistica', url('logistic'));
	});	

	Breadcrumbs::register('advertising', function($breadcrumbs){
		$breadcrumbs->parent('modules');
		$breadcrumbs->push('Publicidad', url('advertising'));
	});	

	Breadcrumbs::register('sms', function($breadcrumbs){
		$breadcrumbs->parent('modules');
		$breadcrumbs->push('Mensajes de Texto', route('sms.index'));
	});
?>