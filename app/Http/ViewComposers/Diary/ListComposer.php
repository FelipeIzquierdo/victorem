<?php namespace Victorem\Http\ViewComposers\Diary;

use Illuminate\Contracts\View\View;
use Auth;

use Victorem\Entities\Diary;
use DB;

class ListComposer {
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $events = Diary::with('delegate', 'organizer', 'location')
            ->where('date', '>=', DB::raw('NOW() - INTERVAL 3 DAY'))
            ->orderBy('date', 'desc')->get();

        return $view->with([
            'events' => $events
        ]);
    }
}
