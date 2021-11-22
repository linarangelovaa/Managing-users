<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Events\EmailVerificationEvent;


class EmailConfirmController extends Controller
{
    public function validation(User $user)
    {

        event(new EmailVerificationEvent($user));

        return view('verification_success');
    }
}