<?php namespace Victorem\Http\ViewComposers\Poll;

use Illuminate\Contracts\View\View;

use Victorem\Entities\Poll;


 
class ListComposer {
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $polls = Poll::whereActive(true)->orderBy('updated_at')->paginate(12);

		$view->with([
            'polls'           => $polls
        ]);
    }
}


