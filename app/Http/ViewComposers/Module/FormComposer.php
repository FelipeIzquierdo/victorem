<?php namespace Victorem\Http\ViewComposers\Module;

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
        $types = Module::$types;

        return $view->with([
            'modules'       => $modules,
            'types'         => $types
        ]);
    }
}
