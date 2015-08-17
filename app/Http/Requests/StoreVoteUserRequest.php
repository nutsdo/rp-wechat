<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreVoteUserRequest extends Request {

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
            'nickname' => 'required|unique:vote_users,nickname,{$this.id}|max:24',
            'phone' => 'required|digits:11',
            'image_url' => 'required|max:2000|mimes:jpeg,bmp,png,gif,jpg',
		];
	}

}
