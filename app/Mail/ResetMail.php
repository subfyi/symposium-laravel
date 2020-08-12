<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $link;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $link)
    {
        $this->user = $user;
        $this->link = $link;

        $this->to($user->email)->cc("iseser@iseser.com");
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.reset');
    }
}
