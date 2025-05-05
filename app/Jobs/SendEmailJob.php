<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private readonly array $data)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $name = $this->data['0'];
        $email = $this->data['1'];
        $message = $this->data['2'];
        Mail::send([],[], function($mail) use ($name, $email, $message) {
            return $mail->to($email)
                ->subject('Test email from Green Telcom Demo')
                ->line("Hello <b>{$name}</b>")
                ->line("Message: {$message}");
        });
    }
}
