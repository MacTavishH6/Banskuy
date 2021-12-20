<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $_newPassword = '';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($newPassword)
    {
        $this->_newPassword = $newPassword;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $newPassword = $this->_newPassword;
        return $this->markdown('ResetPassword.newpasswordreset', compact('newPassword'));
    }
}
