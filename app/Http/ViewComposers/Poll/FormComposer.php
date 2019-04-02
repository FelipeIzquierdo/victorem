<?php namespace Victorem\Http\ViewComposers\Voter;

use Illuminate\Contracts\View\View;
use Auth;

use Victorem\Entities\Voter;
use Victorem\Entities\Location;
use Victorem\Entities\Community;
use Victorem\Entities\Occupation;
use Victorem\Entities\Rol;

class FormComposer {
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
		$locations 			= Location::getAllOrder(1);
        $communities        = Community::allLists();

		$view->with([
            'locations'     => $locations
        ]);
    }
}


