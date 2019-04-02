<?php namespace Victorem\Entities;

use Illuminate\Database\Eloquent\Model;
use DB;

class ViewPoll extends Model
{
    public $table = 'view_polls';

    public static function getStats($poll_id)
    {
    	return self::select('question_id', 'question_text', 'answer_id', 'answer_text', DB::raw('COUNT(answer_id) as number_answers'))
			->whereResult('answer')
			->wherePollId($poll_id)
			->groupBy('question_id', 'answer_id')
			->orderBy('question_id', 'asc')
            ->orderBy('number_answers', 'desc')
			->get();
	}

	public static function getJsonStats($poll_id)
	{
		$statsJson = array();
		$series = array();
        
        $stats = self::getStats($poll_id);
        $question_id = $stats->first()->question_id;
        
        foreach ($stats as $stat) {
            if($question_id != $stat->question_id)
            {
                array_push($statsJson, ['id' => $question_id, 'series' => $series]);
                $series = array(); 
            }

            array_push($series, ['label' => $stat->answer_text, 'data' => $stat->number_answers]);
            $question_id = $stat->question_id;
        }

        array_push($statsJson, ['id' => $question_id, 'series' => $series]);

        return $statsJson;
	}
}
