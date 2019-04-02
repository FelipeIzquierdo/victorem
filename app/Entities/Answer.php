<?php namespace Victorem\Entities;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public $timestamp = true;
	public $fillable = ['text', 'question_id'];
}
