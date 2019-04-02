<?php namespace Victorem\Entities;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
	public $timestamp = true;
	public $fillable = ['text', 'poll_id', 'type'];
	public static $names = ['unic' => 'Respuesta Unica', 'multiple' => 'Respuesta Multiple'];

    /* Relations */
	public function answers()
    {
        return $this->hasMany('Victorem\Entities\Answer');
    }

    public function getTypeNameAttribute()
    {
    	return self::$names[$this->type];
    }
}
