<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TeacherRegistrationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    public function __construct(array $details)
    {
        $this->details = $details;
    }

    public function envelope()
    {
        return new Envelope(
            subject: $this->details['title'] ?? 'Successful Registration of Become Faculity Member Notification', 
        );
    }


    public function content()
    {
        return new Content(
            view: 'Mail.TeacherRegistrationMail', // Ensure this view exists
        );
    }

   
    public function attachments()
    {
        return [];
    }
}
