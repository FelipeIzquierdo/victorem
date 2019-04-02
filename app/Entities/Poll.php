<?php namespace Victorem\Entities;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;
use Auth;

class Poll extends Model
{
	public $timestamp = true;
	public $fillable = ['name', 'description', 'protocol', 'active'];

    /* Relations */
	public function questions()
    {
        return $this->hasMany('Victorem\Entities\Question');
    }

    public function voterPolls()
    {
        return $this->hasMany('Victorem\Entities\VoterPoll');
    }

    public function getProtocolShowAttribute()
    {
        return str_replace("[NAME]", Auth::user()->name, $this->protocol);
    }

    public function getQueryOptions()
    {
        $poll_id = $this->id;

        return Voter::leftJoin('voter_polls', function ($leftJoin) use ($poll_id) { 
                $leftJoin->on('voters.id', '=', 'voter_polls.voter_id')
                    ->where('voter_polls.poll_id', '=', $poll_id);
            })
            ->where(function ($query) {
                $query->where(function ($query){
                    $query->where(DB::raw('DATE(voter_polls.created_at)') ,'<>', Carbon::today())
                        ->where('result', '<>', 'answer')
                        ->where('result', '<>', 'dont_work');
                })
                ->orWhere(function ($query){
                    $query->where('voter_polls.created_at' ,'>=', Carbon::now()->subDays(15))
                        ->where('result', '=', 'answer');
                })
                ->orWhere(function ($query){
                    $query->where('voter_polls.created_at' ,'>=', Carbon::now()->subDays(30))
                        ->where('result', '=', 'dont_work');
                })
                ->orWhereNull('voter_polls.created_at');   
            })
            ->where('voters.telephone', '>', 1)
            ->orderBy('voter_polls.created_at', 'asc')
            ->select(['voters.id', 'doc', 'name', 'telephone', 'address', 'location_id', 'superior', 'occupation']);
    }

    public function getVoterRamdom($location_ids = [], $community_ids = [])
    {
        $query = $this->getQueryOptions();

        if( !empty($location_ids))
        {
            $query = $query->whereIn('voters.location_id', $location_ids);
        }

        if( !empty($community_ids))
        {
            $query = $query->join('voters_has_communities', function($join) use ($community_ids) {
                $join->on('voters_has_communities.voter_id', '=', 'voters.id');
            })->whereIn('voters_has_communities.community_id', $community_ids);  
        }

        $voter = $query->first();

        return $voter;
    }

    public function fillAndSave($data)
    {
        if(array_key_exists('active', $data))
        {
            $data['active'] = 1;
        }
        else
        {
            $data['active'] = 0;
        }

        $this->fill($data); 
        $this->save();
    }
}
