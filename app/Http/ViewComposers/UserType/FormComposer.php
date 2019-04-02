<?php namespace Victorem\Http\ViewComposers\UserType;

use Illuminate\Contracts\View\View;
use Auth;

use Victorem\Entities\Module;

class FormComposer {
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $modules = Module::allLists();

        return $view->with([
            'modules'     => $modules
        ]);
    }
}
