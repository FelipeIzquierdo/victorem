<?php namespace Victorem\Http\ViewComposers\Voter;

use Illuminate\Contracts\View\View;
use Auth;
use Session;

use Victorem\Entities\Voter;


 
class ListComposer {
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $team             = Voter::allTeam();
		$teamSession      = Voter::getTeamSession();

		$view->with([
            'team'              => $team,
            'teamSession'       => $teamSession
        ]);
    }
}


