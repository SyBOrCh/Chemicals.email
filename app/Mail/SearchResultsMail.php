<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SearchResultsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mail;
    public $results;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mail, $results)
    {
        $this->mail = $mail;
        $this->results = $results;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Re: ' . $this->mail->subject)
            ->view('mails.searchresults');
    }
}
