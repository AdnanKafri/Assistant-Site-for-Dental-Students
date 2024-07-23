<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $supervisorName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($supervisorName)
    {
        $this->supervisorName = $supervisorName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('طلب مراجعة حالة')
            ->view('emails.notification');
    }
}
