<?php

namespace CreatyDev\Domain\Account\Requests;

use Illuminate\Foundation\Http\FormRequest;
use CreatyDev\Domain\Auth\Rules\CurrentPassword;

class PasswordStoreRequest extends FormRequest
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
            'password' => 'required|string|min:6|confirmed',
            'current_password' => ['required', new CurrentPassword()],
        ];
    }
}
