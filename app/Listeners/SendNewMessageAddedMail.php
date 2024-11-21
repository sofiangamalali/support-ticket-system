<?php

namespace App\Listeners;

use App\Events\NewMessageAddedEvent;
use App\Mail\NewMessageAddedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;

class SendNewMessageAddedMail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewMessageAddedEvent $event): void
    {
        Mail::to($event->ticket->user->email)
        ->send(new NewMessageAddedMail($event->ticket, $event->message));
    }
}
