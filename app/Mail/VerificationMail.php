<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificationMail extends Mailable
{
use Queueable, SerializesModels;

public $password;

public function __construct($password)
{
$this->password = $password;
}

public function build()
{
return $this->view('emails.verification')
->subject('كلمة مرور التحقق')
->with(['password' => $this->password]);
}
}
