<?php

namespace App\Listeners;

use App\Mail\UserActivated;
use App\Events\UserActivatedEvent;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendActivatedEmailListener
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
     * @param  UserActivatedEvent  $event
     * @return void
     */
    public function handle(UserActivatedEvent $event)
    {
        Mail::to($event->email)->send(new UserActivated());
    }
}
