<?php namespace Victorem\Http\ViewComposers\Statistics;

use Illuminate\Contracts\View\View;

use Victorem\Entities\Voter;
use Victorem\Libraries\Campaing;
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
        $statistics 		= Report::getAllGraphicActive();
		
        $goal_percentage 	= Voter::getGoalPercentage();	
		$number_voters 		= Voter::numberVoters();
		$target_number 		= Campaing::getTargetNumber();

        return $view->with([
            'statistics'    	=> $statistics,
            'goal_percentage'   => $goal_percentage,
            'number_voters'   	=> $number_voters,
            'target_number'   	=> $target_number
        ]);
    }
}


