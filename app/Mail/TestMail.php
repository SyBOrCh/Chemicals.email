<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $sender;
    public $subject;
    public $content;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sender = null, $subject = null, $content = null)
    {
        $this->sender = $sender ?? 'john@doe.com';
        $this->subject = $subject ?? 'A chemical search';
        $this->content = $content ?? 'acetic acid';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from($this->sender)
            ->subject($this->subject)
            ->view('emails.test.mail');
    }
}
