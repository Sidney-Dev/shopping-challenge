<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $userNew;

    public function __construct($userNew)
    {
        $this->userNew = $userNew;
    }

    public function build()
    {
        $this->subject("Updated Email");
        return $this->view('emails.updatedUser');
    }
}
