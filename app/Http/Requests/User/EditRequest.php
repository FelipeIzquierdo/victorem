<?php namespace Victorem\Http\Requests\User;

use Victorem\Http\Requests\Request;
use Illuminate\Routing\Route;

class EditRequest extends Request {

	/**
	 * @var Route
	 */
	private $route;
	private $createRequest;

	public function __construct(Route $route) 
	{
		$this->route = $route;
		$this->createRequest = new CreateRequest;
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
		$rules['username'] .= ',username,' . $this->route->getParameter('users') . ',id';
		$rules['name'] .= ',name,' . $this->route->getParameter('users') . ',id';
		$rules['email'] .= ',email,' . $this->route->getParameter('users') . ',id';
		$rules['password'] = 'confirmed';


		return $rules;
	}

}
