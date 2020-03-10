<?php
/**
 * Created by PhpStorm.
 * User: CreatyDev
 * Date: 12/29/2017
 * Time: 2:38 AM
 */

namespace CreatyDev\App\Traits\Eloquent\Auth;


use CreatyDev\Domain\Users\Models\ConfirmationToken;

trait HasConfirmationToken
{
    /**
     *  Generates a confirmation token for a user.
     */
    public function generateConfirmationToken()
    {
        $this->confirmationToken()->create([
            'token' => $token = str_random(200),
            'expires_at' => $this->getConfirmationTokenExpiry(),
        ]);

        return $token;
    }

    protected function getConfirmationTokenExpiry()
    {
        return $this->freshTimestamp()->addMinutes(10);
    }

    /**
     * Get's the user's confirmation token.
     *
     * @return mixed
     */
    public function confirmationToken()
    {
        return $this->hasOne(ConfirmationToken::class);
    }
}