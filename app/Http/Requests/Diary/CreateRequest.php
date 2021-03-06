<?php namespace Victorem\Http\Requests\Diary;

use Victorem\Http\Requests\Request;

class CreateRequest extends Request {
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name'			=> 'max:100|required',
        	'location_id'	=> 'required',
        	'place'			=> 'max:200|required',
        	'description'	=> 'max:200',
        	'date'			=> 'required',
        	'time'			=> 'required',
        	'endtime'		=> 'required|different:time',
        	'organizer_id'	=> 'required'
		];
	}
}