<?php

namespace App\Listeners;

use App\Mail\UserDeactivated;
use App\Events\UserDeactivatedEvent;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendDeactivatedEmailListener
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
     * @param  UserDeactivatedEvent  $event
     * @return void
     */
    public function handle(UserDeactivatedEvent $event)
    {
        Mail::to($event->email)->send(new UserDeactivated());
    }
}