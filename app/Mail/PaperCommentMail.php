<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaperCommentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $paper;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $paper)
    {
        $this->user = $user;
        $this->paper = $paper;

        $this->to($user->p_mail)->cc("iseser@iseser.com");
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.paper_comment');
    }
}
