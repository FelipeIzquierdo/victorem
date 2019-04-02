<?php namespace Victorem\Http\ViewComposers\Rol;

use Illuminate\Contracts\View\View;
use Auth;
use Session;

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
        $roles = Rol::allLists();
        $rolSession = Session::get('rol', null);
        $rolesTree = Rol::getTree();

		$view->with([
            'roles'         => $roles,
            'rolSession'    => $rolSession, 
            'rolesTree'     => $rolesTree, 
        ]);
    }
}