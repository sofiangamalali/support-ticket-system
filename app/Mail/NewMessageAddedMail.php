<?php

namespace App\Mail;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewMessageAddedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The Ticket instance.
     */
    public Ticket $ticket;

    /**
     * The message content.
     */
    public string $message;

    /**
     * Create a new message instance.
     */
    public function __construct(Ticket $ticket, string $message)
    {
        $this->ticket = $ticket;
        $this->message = $message;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Message Added to Ticket: ' . $this->ticket->title,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'newMessageMail',
            with: [
                'ticket' => $this->ticket,
                'customMessage' => $this->message
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
