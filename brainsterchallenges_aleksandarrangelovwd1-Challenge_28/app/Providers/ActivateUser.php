<?php

namespace App\Providers;

use App\Providers\EmailVerificationEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ActivateUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  EmailVerificationEvent  $event
     * @return void
     */
    public function handle(EmailVerificationEvent $event)
    {
        //
    }
}
