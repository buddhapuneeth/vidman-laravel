<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Helpers\AuthHelper;

class RolesRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		if(AuthHelper::authenticate() == 'admin'){
			return true;
		}
		return false;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		switch($this->method()){
			case 'GET':
				break;
			case 'DELETE':
			{
				return [];
			}
			case 'POST':{
				return [
					'user' => 'required|min:1',
					'role' => 'required',
				];
			}
			case 'PUT':
				break;
			case 'PATCH':
			{
				return [
				'user' => 'required|min:3',
				'role' => 'required',
			];
			}

			default:break;
		}



	}

}
