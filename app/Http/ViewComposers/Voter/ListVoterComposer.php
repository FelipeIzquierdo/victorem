<?php namespace Victorem\Http\ViewComposers\Voter;

use Illuminate\Contracts\View\View;
use Victorem\Libraries\Campaing;


 
class ListVoterComposer {
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {        
        $voterTitles        = Campaing::getVoterTitles();
        $voterAttributes    = Campaing::getVoterAttributes();
        $voterClass         = Campaing::getVoterClass();

		$view->with([
            'voterTitles'       => $voterTitles,
            'voterAttributes'   => $voterAttributes,
            'voterClass'        => $voterClass
        ]);
    }
}


