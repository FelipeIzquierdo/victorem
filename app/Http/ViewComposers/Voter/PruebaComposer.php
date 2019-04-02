<?php namespace Victorem\Http\ViewComposers\Voter;

use Illuminate\Contracts\View\View;

use Victorem\Entities\Voter;
use Victorem\Entities\Location;
use Victorem\Entities\Community;
use Victorem\Entities\Occupation;
use Victorem\Entities\Rol;
use Victorem\Entities\PollingStation;

class PruebaComposer {
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $team               = Voter::allTeam();
        $locations          = Location::getAllOrder(1);
        $communities        = Community::allLists();
        $occupations        = Occupation::allLists();
        $roles              = Rol::allLists();
        $polling_stations   = PollingStation::allLists();

        $view->with([
            'team'          => $team,
            'locations'     => $locations, 
            'communities'   => $communities, 
            'occupations'   => $occupations,
            'roles'         => $roles,
            'polling_stations'  => $polling_stations
        ]);
    }
}


