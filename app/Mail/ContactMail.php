<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name2;
    public $from2;
    public $title2;
    public $message2;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $from, $title, $message)
    {
        $this->name2 = $name;
        $this->from2 = $from;
        $this->title2 = $title;
        $this->message2 = $message;

        $this->replyTo($from, $name);

        $this->subject("Kontakt Form: $title");
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $name2 = $this->name2;
        $from2 = $this->from2;
        $title2 = $this->title2;
        $message2 = $this->message2;

        return $this->view('emails.contact', compact('name2', 'from2', 'title2', 'message2'));
    }
}
