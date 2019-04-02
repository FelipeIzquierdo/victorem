<?php namespace Victorem\Http\Requests\User;

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
			'username'		=> 'max:100|required|unique:user',
			'name'			=> 'max:100|required|unique:user',
			'email'			=> 'email|max:100|required|unique:user',
			'password'		=> 'max:255|required|confirmed',
			'type_id'		=> 'required|exists:user_types,id'
		];
	}
}