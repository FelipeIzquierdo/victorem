<?php namespace Victorem\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Auth;
 
class DatabaseComposer {
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {        
        $modules = Auth::user()->type->getSubmenuModules('database');

        $view->with(['modules' => $modules]);
    }
 
}
