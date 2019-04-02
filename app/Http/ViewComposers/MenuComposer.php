<?php namespace Victorem\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Auth;
use Victorem\Libraries\Campaing;
use Victorem\Entities\Module;
 
class MenuComposer {
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        if($user = Auth::user())
        {
            $userModules = $user->getMenuModules();

            $mainModules = $userModules->filter(function($module)
            {
                return $module->isType('main');
            });

            $extraModules = $userModules->filter(function($module)
            {
                return $module->isType('extra');
            });


            $view->with([
                'mainModules'       => $mainModules,
                'extraModules'      => $extraModules
            ]);
        }

        $view->with([
            'template'  => Campaing::getTemplateCss()
        ]);
    }
 
}