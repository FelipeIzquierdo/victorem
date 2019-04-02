<?php namespace Victorem\Http\Requests\Poll\Question;

use Victorem\Http\Requests\Request;
use Illuminate\Routing\Route;

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
			'text' 			=> 'required|unique_with:questions,poll_id',
			'new_answers'	=> 'required',
			'type'			=> 'required|in:unic,multiple'
		];
	}
}