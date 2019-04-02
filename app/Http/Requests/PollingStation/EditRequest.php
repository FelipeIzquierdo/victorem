<?php namespace Victorem\Http\Requests\PollingStation;

use Victorem\Http\Requests\Request;
use Illuminate\Routing\Route;

class EditRequest extends Request {

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
			'description'	=> 'max:200',
			'address'		=> 'max:200',
			'location_id'	=> 'integer|required|exists:locations,id',
			'electoral_potential'	=> 'integer'
		];

		return $rules;
	}

}
