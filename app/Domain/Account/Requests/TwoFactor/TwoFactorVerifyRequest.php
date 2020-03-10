<?php

namespace CreatyDev\Domain\Account\Requests\TwoFactor;

use Illuminate\Foundation\Http\FormRequest;
use CreatyDev\App\TwoFactor\TwoFactor;
use CreatyDev\Domain\Account\Rules\ValidTwoFactorRule;
use CreatyDev\Domain\Users\Models\User;

class TwoFactorVerifyRequest extends FormRequest
{
    /**
     * @var TwoFactor
     */
    protected $twoFactor;

    /**
     * Create a new form request instance.
     *
     * @param TwoFactor $twoFactor
     */
    public function __construct(TwoFactor $twoFactor)
    {
        $this->twoFactor = $twoFactor;
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
        if (session()->has('twofactor')) {
            $this->setUserResolver($this->userResolver());
        }

        return [
            'token' => [
                'required',
                new ValidTwoFactorRule($this->user(), $this->twoFactor)
            ]
        ];
    }

    protected function userResolver()
    {
        return function () {
            return User::find(session('twofactor')->user_id);
        };
    }
}
