<?php


namespace App\Jobs;

use App\Mail\LoginNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendLoginNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $details;
    public $email;

    public function __construct($email, array $details)
    {
        $this->email = $email;
        $this->details = $details;
    }

    public function handle(): void
    {
        Mail::to($this->email)->send(new LoginNotification($this->details));
    }
}
