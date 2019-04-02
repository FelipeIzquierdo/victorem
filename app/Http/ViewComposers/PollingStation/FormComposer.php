<?php namespace Victorem\Http\ViewComposers\PollingStation;

use Illuminate\Contracts\View\View;
use Auth;

use Victorem\Entities\Location;

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

        return $view->with([
            'locations'   => $locations,
        ]);


    }
}
