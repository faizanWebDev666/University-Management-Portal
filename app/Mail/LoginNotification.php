<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LoginNotification extends Mailable
{
    use Queueable, SerializesModels;

       public $details;
    public function __construct(array $details)
    {
        $this->details = $details;
    }
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Login Notification',
        );
    }
    public function content(): Content
    {
         return new Content(
            view: 'Mail.LoginNotification', 
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
