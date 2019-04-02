<?php namespace Victorem\Http\Requests\Voter;

use Victorem\Http\Requests\Request;
use Victorem\Entities\Voter;
use Illuminate\Routing\Route;

class CreateRequest extends Request {

	/**
	 * @var Voter
	 */
	private $voter;

	function __construct(Route $route) {
		$this->voter = Voter::findwithTrashedOrNew($route->getParameter('doc'));
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
	 *
	 * @return Voter
	 */
	public function getVoter()
	{
		return $this->voter;
	}
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$rules = [
        	'doc'			=> 'max:100|unique:voters',
        	'occupation' 	=> 'exists:occupations,id',
        	'communities' 	=> 'array',
            'email'     	=> 'email|max:100|unique:voters',
            'name'     		=> 'max:100',
            'telephone' 	=> 'max:100',
            'sex'     		=> 'max:1|required',
            'date_of_birth'	=> 'date',
            'location_id'   => 'required'
        ];

        if ($this->voter->exists)
        {
			$rules['email'] .= ',email,'.$this->voter->id.',id';
			$rules['doc'] .= ',doc,'.$this->voter->id.',id';
        }

        return $rules;
	}
}