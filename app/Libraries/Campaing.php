<?php namespace Victorem\Libraries;

class Campaing {

	static public function getTargetNumber()
	{
		return env('TARGET_NUMBER', 10000);		
	}

	static public function getCandidateDoc()
	{
		return env('DOC', 0011100);
	}

	static public function getCandidateName()
	{
		return env('NAME', 'Candidato Victorem');
	}

	static public function getPoliticalLogo()
	{
		return url(env('POLITICAL_LOGO', '/images/partido.jpg'));
	}

	static public function getLocationsSeeder()
	{
		return env('LOCATIONS_SEEDER', 'LocationsMetaTableSeeder');
	}

	public static function getStatisticRolNames()
	{
		if(env('STATISTICS_ROL_NAMES'))
		{
			return array_map('ucfirst', explode(',', env('STATISTICS_ROL_NAMES')));
		}

		return [];
	}

	public static function getStatisticRolIds()
	{
		if(env('STATISTICS_ROL_IDS'))
		{
			return explode(',', env('STATISTICS_ROL_IDS'));
		}
		
		return [];
	}

	public static function getReports()
	{
		return explode(',', env('REPORTS', 'people'));
	}

	public static function getStatistics()
	{
		return explode(',', env('STATISTICS'));
	}

	public static function getSms()
	{
		return explode(',', env('SMS'));
	}

	public static function getVoterTitles()
	{
		return explode(',', env('VOTER_LIST_TITLE'));
	}

	public static function getTeamTitles()
	{
		return explode(',', env('TEAM_LIST_TITLE'));
	}

	public static function getVoterAttributes()
	{
		return explode(',', env('VOTER_LIST_ATTRIBUTE'));
	}

	public static function getTeamAttributes()
	{
		return explode(',', env('TEAM_LIST_ATTRIBUTE'));
	}

	public static function getVoterClass()
	{
		return explode(',', env('VOTER_LIST_CLASS'));
	}

	public static function getTeamClass()
	{
		return explode(',', env('TEAM_LIST_CLASS'));
	}

	static public function isDemo()
	{
		return env('IS_DEMO', true);
	}

	public static function getPhoto()
	{
		return url(env('PHOTO', '/images/placeholders/photos/photo.png'));
	}

	public static function getElibomUsername()
	{
		return env('ELIBOM_USERNAME', 'andresmaopinzon@gmail.com');
	}

	public static function getElibomCode()
	{
		return env('ELIBOM_CODE', 'o6Gi4M04no');
	}

	public static function getMailchimpApiKey()
	{
		return env('MAILCHIMP_APIKEY', '684e040793fa2af676448301627d2482');
	}

	public static function getMailchimpIdList()
	{
		return env('MAILCHIMP_IDLIST', '8e3b136caf');
	}

	public static function getTemplateCss()
	{
		return env('TEMPLATE', 'flat');
	}

	public static function getRegistraduriaUrl()
	{
		return env('REGISTRADURIA_URL', 'https://wsp.registraduria.gov.co/censo/_censoResultado.php?nCedula=');	
	}


}
