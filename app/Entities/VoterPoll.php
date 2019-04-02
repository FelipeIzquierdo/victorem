<?php namespace Victorem\Entities;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

class VoterPoll extends Model
{	
	public $timestamp = true;
	public $fillable = ['voter_id', 'poll_id', 'user_id', 'result', 'observation'];

    public function getResultAttribute($value)
    {
        return \Lang::get('validation.translate.'.$value);
    }

    public static function getCount($poll_id)
    {
        return self::wherePollId($poll_id)
            ->realized()
            ->count();
    }

    public static function getCountToday($poll_id)
    {
        return self::wherePollId($poll_id)
            ->realized()
            ->today()
            ->count();
    }

    public function scopeRealized($query)
    {
        return $query->where('result', '<>', 'unrealized');
    }

    public function scopeToday($query)
    {
        return $query->where(DB::raw('DATE(created_at)'), '=', Carbon::today());
    }

    public function scopeCalls($query)
    {
        return $query->select('result', DB::raw('COUNT(*) as number'))
            ->realized()
            ->groupBy('result');
    }

    public function poll()
    {
        return $this->belongsTo('Victorem\Entities\Poll');
    }

    public function voter()
    {
        return $this->belongsTo('Victorem\Entities\Voter');
    }

    public function user()
    {
        return $this->belongsTo('Victorem\Entities\User');
    }

    public function answers()
    {
        return $this->belongsToMany('Victorem\Entities\Answer');
    }

    public function getVoterTelephoneAttribute()
    {
        return $this->voter->telephone;
    }

    public function getVoterNameWithRolesAndCommunitiesAttribute()
    {
        return $this->voter->name_with_roles_and_communities;
    }

    public function getUserUsernameAttribute()
    {
        return $this->user->username;
    }

    public function getReportAnswersAttribute()
    {
        $answers = '';

        foreach ($this->answers as $count => $answer) 
        {
            if($count > 0)
            {
                $answers .= ' ';
            }

            $answers .= $count + 1 . '. ' . $answer->text; 
        }

        return $answers;
    }

    

}
