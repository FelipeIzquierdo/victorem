<?php namespace Victorem\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composers([
            'Victorem\Http\ViewComposers\MenuComposer'        => ['auth.login',
                                                                'dashboard.pages.modules',
                                                                'dashboard.pages.database.hello',
                                                                'dashboard.pages.database.voters.diaries',
                                                                'dashboard.pages.database.voters.lists.layout',
                                                                'dashboard.pages.database.voters.forms.layout',
                                                                'dashboard.pages.database.roles.*',
                                                                'dashboard.pages.reports.*',
                                                                'dashboard.pages.statistics.*',
                                                                'dashboard.pages.diary.*',
                                                                'dashboard.pages.logistic.*',
                                                                'dashboard.pages.advertising.*',
                                                                'dashboard.pages.sms.*',
                                                                'dashboard.pages.polls.*',
                                                                'dashboard.pages.system.*'],
            'Victorem\Http\ViewComposers\DatabaseComposer'    => 'dashboard.pages.database.hello',

            /* Database */
            'Victorem\Http\ViewComposers\Voter\ListComposer'          => ['dashboard.pages.database.voters.lists.voter', 
                                                                        'dashboard.pages.database.voters.lists.team',
                                                                        'dashboard.pages.diary.people'],
            'Victorem\Http\ViewComposers\Voter\ListVoterComposer'     => ['dashboard.pages.database.voters.lists.voter',
                                                                        'dashboard.pages.database.voters.lists.search',
                                                                        'dashboard.pages.diary.people'],
            'Victorem\Http\ViewComposers\Voter\ListTeamComposer'      => 'dashboard.pages.database.voters.lists.team',
            'Victorem\Http\ViewComposers\Voter\PruebaComposer'          => ['dashboard.pages.database.voters.forms.voter', 
                                                                        'dashboard.pages.database.voters.forms.team'],
            'Victorem\Http\ViewComposers\Rol\FormComposer'            => 'dashboard.pages.database.roles.lists',

            /* System */
            'Victorem\Http\ViewComposers\Location\FormComposer'           => 'dashboard.pages.system.locations.form',
            'Victorem\Http\ViewComposers\PollingStation\FormComposer'     => 'dashboard.pages.system.polling_stations.form',
            'Victorem\Http\ViewComposers\Module\FormComposer'             => 'dashboard.pages.system.modules.form',
            'Victorem\Http\ViewComposers\Sms\FormComposer'                => 'dashboard.pages.system.sms.form',
            'Victorem\Http\ViewComposers\User\FormComposer'               => 'dashboard.pages.system.users.form',
            'Victorem\Http\ViewComposers\UserType\FormComposer'           => 'dashboard.pages.system.user_types.form',
            'Victorem\Http\ViewComposers\ReportStatistics\FormComposer'   => 'dashboard.pages.system.reports.form',

            /* Secundary */
            'Victorem\Http\ViewComposers\Diary\FormComposer'              => 'dashboard.pages.diary.form',
            'Victorem\Http\ViewComposers\Diary\ListComposer'              => ['dashboard.pages.logistic.hello',
                                                                            'dashboard.pages.advertising.hello'],
            'Victorem\Http\ViewComposers\Statistics\ListComposer'         => 'dashboard.pages.statistics.lists',
            'Victorem\Http\ViewComposers\Report\ListComposer'             => ['dashboard.pages.reports.lists',
                                                                            'dashboard.pages.statistics.lists'],

            /* Extra */
            'Victorem\Http\ViewComposers\Sms\ListComposer'                => 'dashboard.pages.sms.sms',
            'Victorem\Http\ViewComposers\Poll\ListComposer'               => 'dashboard.pages.polls.lists',
            'Victorem\Http\ViewComposers\Poll\OptionsComposer'            => 'dashboard.pages.polls.options'
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
