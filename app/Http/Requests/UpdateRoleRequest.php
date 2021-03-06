<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateRoleRequest extends Request {

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
            'name' => 'required|alpha_dash|Unique:permissions,name,'.$this->id,
            'display_name' => 'required',
            'description' => 'required|max:255',
		];
	}

}
