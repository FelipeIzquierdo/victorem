<?php namespace Victorem\Http\ViewComposers\Report;

use Illuminate\Contracts\View\View;
use Victorem\Libraries\Reports\Report;

class ListComposer {
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $selects = Report::getSelects();

        return $view->with([
            'selects'	=> $selects
        ]);
    }
}
		
				
			