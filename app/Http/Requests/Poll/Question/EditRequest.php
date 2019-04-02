<?php namespace Victorem\Http\Requests\Poll\Question;

use Victorem\Http\Requests\Request;
use Illuminate\Routing\Route;

class EditRequest extends Request {

	private $route;
	private $createRequest;

	public function __construct(Route $route) 
	{
		$this->route = $route;
		$this->createRequest = new CreateRequest();
	}

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
		$rules = $this->createRequest->rules();
		$rules['text'] .= ',' . $this->route->getParameter('questions');
		$rules['new_answers'] = '';

		return $rules;
	}

}
