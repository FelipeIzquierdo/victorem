<?php namespace Victorem\Http\ViewComposers\Voter;

use Illuminate\Contracts\View\View;
use Victorem\Libraries\Campaing;


 
class ListTeamComposer {
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $teamTitles        = Campaing::getTeamTitles();
        $teamAttributes    = Campaing::getTeamAttributes();
        $teamClass         = Campaing::getTeamClass();

		$view->with([
            'voterTitles'       => $teamTitles,
            'voterAttributes'   => $teamAttributes,
            'voterClass'        => $teamClass
        ]);
    }
}
