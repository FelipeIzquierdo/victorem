<?php namespace Victorem\Http\ViewComposers\Location;

use Illuminate\Contracts\View\View;
use Auth;

use Victorem\Entities\Location;
use Victorem\Entities\LocationType;

class FormComposer {
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $locations  = Location::allLists();
        $types      = LocationType::allLists();

        return $view->with([
            'locations'     => $locations,
            'types'         => $types
        ]);
    }
}
