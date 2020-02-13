<?php
/**
 * Created by PhpStorm.
 * User: pazgalev
 * Date: 12/17/19
 * Time: 1:35 PM
 */

namespace App\Http\Requests\Api\User;


use App\Http\Requests\Api\ApiRequest;

/**
 * Class UpdateRequest
 * @property string $name
 * @property string $surname
 * @property string $login
 * @property string $password
 * @property integer $role_id
 * @package App\Http\Requests\Api\User
 */
class UpdateRequest extends ApiRequest
{
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
            'name' => 'string|min:2|max:255',
            'surname' => 'string|min:2|max:255',
            'login' => 'string|min:6|max:55|unique:users,login,' . $this->route()->id,
            'password' => 'string|min:6|max:255',
            'role_id' => 'integer|exists:roles,id'
        ];
    }
}
