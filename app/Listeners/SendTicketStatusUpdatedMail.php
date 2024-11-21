<?php

namespace App\Listeners;

use App\Events\TicketStatusUpdatedEvent;
use App\Mail\TicketStatusUpdatedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;

class SendTicketStatusUpdatedMail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     */
    public function handle(TicketStatusUpdatedEvent $event): void
    {
        Mail::to($event->ticket->user->email)
            ->send(new TicketStatusUpdatedMail($event->ticket));
    }
}
