<?php namespace Victorem\Http\ViewComposers\Diary;

use Illuminate\Contracts\View\View;
use Auth;

use Victorem\Entities\Location;
use Victorem\Entities\Voter;

class FormComposer {
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $locations    = Location::getAllOrder();
        $delegates    = Voter::allDelegates();
        $team         = Voter::allTeam();

        return $view->with([
            'locations' => $locations,
            'delegates' => $delegates,
            'team'      => $team
        ]);
    }
}
