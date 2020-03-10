<?php

namespace CreatyDev\Http\Api\Controllers\Account;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use CreatyDev\App\Controllers\Controller;
use CreatyDev\Domain\Account\Mail\PasswordUpdated;
use CreatyDev\Domain\Account\Requests\PasswordStoreRequest;

class PasswordController extends Controller
{

    /**
     * Store user's new password in storage.
     *
     * @param PasswordStoreRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PasswordStoreRequest $request)
    {
        //update user password
        $request->user()->update(['password' => bcrypt($request->password)]);

        //Send email
        Mail::to($request->user())->send(new PasswordUpdated());

        //return with no content
        return response()->json(null, 204);
    }
}
