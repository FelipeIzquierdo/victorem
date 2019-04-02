<?php namespace Victorem\Http\ViewComposers\Sms;

use Illuminate\Contracts\View\View;
use Auth;

use Victorem\Libraries\Sms\SendSMS;
use Victorem\Entities\Location;
use Victorem\Entities\PollingStation;
use Victorem\Entities\Community;
use Victorem\Entities\Occupation;
use Victorem\Entities\Rol;

class ListComposer {
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $sms = new SendSMS();

        $credits 	= $sms->credits();
		

        return $view->with([
            'credits'           => $credits,
            'locations'         => Location::getAllOrder(),
            'polling_stations'  => PollingStation::allLists(),
            'communities'       => Community::allLists(),
            'roles'             => Rol::allLists(),
            'occupations'       => Occupation::allLists(),
            'sex'               => ['F' => 'Femenino', 'M' => 'Masculino']            
        ]);
    }
}


