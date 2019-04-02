<?php

use Victorem\Libraries\Reports\Report;
use Victorem\Libraries\Campaing;

use Victorem\Entities\Location;
use Victorem\Libraries\Sms\SendSMS;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/***** Auth *****/
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

/** App **/
Route::group(['middleware' => ['auth']], function()
{
	Route::get('/', ['as' => 'modules', 'uses' => 'DashboardController@index']);

	Route::group(['prefix' => 'system', 'middleware' => 'module:system', 'namespace' => 'System'], function() 
	{
		Route::get('/', ['as' => 'system', 'uses' => 'SystemController@getindex']);
		Route::get('logs', ['as' => 'system.logs', 'uses' => '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index']);
		Route::resource('users', 'UsersController');
		Route::resource('user-types', 'UserTypesController');
		Route::resource('modules', 'ModulesController');
		Route::resource('locations', 'LocationsController');
		Route::resource('polling-stations', 'PollingStationsController');
	});
		
	Route::group(['prefix' => 'database', 'namespace' => 'Database', 'middleware' => 'module:database'], function() 
	{
		Route::get('/', ['as' => 'database', 'uses' => 'DataBaseController@index']);

		Route::group(['middleware' => 'module:delete-voters'], function() { 
			Route::post('voters/delete/{id}', ['as' => 'database.voters.destroy', 'uses' => 'VotersController@destroy']);
		});

		Route::group(['middleware' => 'module:voters'], function() {
			Route::get('voters', ['as' => 'database.voters.index', 'uses' => 'VotersController@index']);
			Route::post('voters/redirect', ['as' => 'database.voters.redirect', 'uses' => 'VotersController@redirect']);
			Route::get('voters/search', ['as' => 'database.voters.search', 'uses' => 'VotersController@search']);
			Route::get('voters/find-name/{doc}', ['as' => 'database.voters.find-name', 'uses' => 'VotersController@findName']);
			Route::get('voters/find-polling-station/{doc}', ['as' => 'database.voters.find-polling-station', 'uses' => 'VotersController@findPollingStation']);
			Route::get('voters/diaries/{doc}', ['as' => 'database.voters.diaries', 'uses' => 'VotersController@diaries']);
			
			Route::get('voters/{id}/add-to-team/{diary?}', ['as' => 'database.voters.add-to-team', 'uses' => 'VotersController@addToTeam', 'middleware' => 'module:add-to-team-voters']);
			Route::get('voters/{doc}/{diary?}', ['as' => 'database.voters.create', 'uses' => 'VotersController@create']);
			Route::post('voters/{doc}/{diary?}', ['as' => 'database.voters.store', 'uses' => 'VotersController@store']);
		});

		Route::group(['middleware' => 'module:team'], function() {
			Route::get('team', ['as' => 'database.team.index', 'uses' => 'ColaboratorsController@index']);
			Route::post('team/redirect', ['as' => 'database.team.redirect', 'uses' => 'ColaboratorsController@redirect']);
			Route::get('team/{doc}/remove/{diary?}', ['as' => 'database.team.remove', 'uses' => 'ColaboratorsController@remove']);				
			Route::get('team/{doc}/{diary?}', ['as' => 'database.team.create', 'uses' => 'ColaboratorsController@create']);
			Route::post('team/{doc}/{diary?}', ['as' => 'database.team.store', 'uses' => 'ColaboratorsController@store']);
		});

		Route::group(['middleware' => 'module:roles'], function() {
			Route::resource('roles', 'RolesController',  ['only' => ['index', 'edit', 'update', 'store', 'destroy']]);
		});
	});

	Route::group(['namespace' => 'Secondary'], function() {
		Route::group(['middleware' => 'module:reports'], function() {
			Route::controller('reports', 'ReportsController', [
				'getIndex' 								=> 'reports.index',

				'getPeople' 							=> 'reports.people',
				'getDelegates'							=> 'reports.delegates',
				'getPeopleWithBirthdayCurrentMonth' 	=> 'reports.people-with-birthday-current-month',
				'getPeopleWithoutPollingStation' 		=> 'reports.people-without-polling-station',

				'getPeopleOfLocations' 					=> 'reports.people-of-locations',
				'getPeopleOfPollingStations' 			=> 'reports.people-of-polling-stations',
				'getPeopleOfPollingStationsDayD' 		=> 'reports.people-of-polling-stations-day-d',
				'getPeopleOfCommunities' 				=> 'reports.people-of-communities',
				'getPeopleOfOccupations' 				=> 'reports.people-of-occupations',

				'getTeamWithVoters' 					=> 'reports.team-with-voters',
				'getRecursiveTeam' 						=> 'reports.recursive-team',
				'getRecursiveTeamVoters' 				=> 'reports.recursive-team-voters',
				'getTeam' 								=> 'reports.team',

				'getTeamOfRoles'						=> 'reports.team-of-roles',

				'getPlans' 								=> 'reports.plans',
				'getPlansTeam' 							=> 'reports.plans-team',
				
				'getBlankTemplate' 						=> 'reports.blank-template',
				
				'getUsers'								=> 'reports.users',
				'getVoterPolls'							=> 'reports.voter-polls'
			]);
		});
			
		Route::group(['prefix' => 'statistics', 'middleware' => 'module:statistics'], function() 
		{
			Route::controller('/', 'StatisticsController', [
				'getIndex'							=> 'statistics.index',
				'getBars'							=> 'statistics.bars',
				'getVotersOfPollingStations'		=> 'statistics.voters-of-polling-stations',
				'getVotersOfPollingStationsDayD'	=> 'statistics.voters-of-polling-stations-day-d',
				'getVotersOfLocations' 				=> 'statistics.voters-of-locations'
			]);		
		});

		Route::group(['middleware' => 'module:diary'], function() 
		{
			Route::get('diary-json', ['as' => 'diary.json', 'uses' => 'DiaryController@json']);
			Route::get('diary-print', ['as' => 'diary.print', 'uses' => 'DiaryController@printDiary']);
			Route::resource('diary', 'DiaryController');
			
			Route::get('diary/{diary}/people', ['as' => 'diary.people.index', 'uses' => 'DiaryPeopleController@index']);
			Route::post('diary/{diary}/people/add-masive', ['as' => 'diary.people.add-masive', 'uses' => 'DiaryPeopleController@addMasive']);

			Route::post('diary/{diary}/people/{id}/remove', ['as' => 'diary.people.remove', 'uses' => 'DiaryPeopleController@remove']);


		});

		Route::group(['prefix' => 'logistic', 'middleware' => 'module:logistic'], function(){
			Route::get('/', ['as' => 'logistic', 'uses' => 'LogisticController@getindex']);
		});

		Route::group(['prefix' => 'advertising', 'middleware' => 'module:advertising'], function(){
			Route::get('/', ['as' => 'advertising', 'uses' => 'AdvertisingController@getindex']);
		});
	});
	
	Route::group(['namespace' => 'Extra'], function() {
		
		/* Envío masivo de Mensajes de texto */
		Route::group(['middleware' => 'module:sms'], function() {
			Route::controller('sms', 'SmsController', [
				'getIndex' 				=> 'sms.index',
				'postSend' 				=> 'sms.send',		
			]);
		});
		/* Fin Modulo Envío masivo de Mensajes de texto */

		Route::group(['middleware' => 'module:polls'], function() {
			Route::resource('polls', 'PollsController');
			Route::resource('polls.questions', 'PollsQuestionsController');	
			Route::get('polls/{polls}/stats', ['as' => 'polls.stats', 'uses' => 'PollsController@stats']);
			Route::get('polls/{polls}/stats/json', ['as' => 'polls.stats.json', 'uses' => 'PollsController@statsJson']);
			Route::delete('answers/{id}/delete', ['as' => 'answers.destroy', 'uses' => 'PollsQuestionsController@answersDestroy']);

			Route::get('polls/{polls}/voters/options', ['as' => 'polls.voters.options', 'uses' => 'PollsVotersController@options']);
			Route::post('polls/{polls}/voters/options', ['as' => 'polls.voters.options.store', 'uses' => 'PollsVotersController@postOptions']);
			Route::resource('polls.voters', 'PollsVotersController');
		});
	});
	
});