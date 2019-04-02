<?php namespace Victorem\Http\Requests\Voter;

use Victorem\Http\Requests\Request;
use Victorem\Entities\Voter;
use Illuminate\Routing\Route;

class NewRequest extends Request {

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
		$rules = [
        	'colaborator'	=> 'required|exists:voters,id',
        	'doc' 			=> 'required|integer'
        ];

        return $rules;
	}
}