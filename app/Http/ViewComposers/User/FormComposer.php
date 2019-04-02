<?php namespace Victorem\Http\ViewComposers\User;

use Illuminate\Contracts\View\View;
use Auth;

use Victorem\Entities\UserType;

class FormComposer {
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $user_types = UserType::allLists();

		$view->with([
            'user_types'  => $user_types
        ]);
    }
}

