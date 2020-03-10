<?php

namespace CreatyDev\Domain\Users\Models;

use Illuminate\Database\Eloquent\Model;

class ConfirmationToken extends Model
{
    public $timestamps = false;

    protected $dates = [
        'expires_at'
    ];

    protected $fillable = [
        'token',
        'expires_at'
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($token) {
            // delete any previously available confirmation token
            optional($token->user->confirmationToken)->delete();
        });
    }

    /**
     * The route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'token';
    }

    /**
     * Get the token user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check's if token has expired.
     *
     * @return bool
     */
    public function hasExpired()
    {
        return $this->freshTimestamp()->gt($this->expires_at);
    }
}
