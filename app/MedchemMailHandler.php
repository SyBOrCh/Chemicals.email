<?php

namespace App;

use App\Mail\WelcomeMail;
use App\ReceivedMail;
use BeyondCode\Mailbox\InboundEmail;
use Illuminate\Support\Facades\Mail;

class MedchemMailHandler
{
    public function __invoke(InboundEmail $email)
    {
        // If the user is not known, send them a welcome first
        if (User::where('email', $email->from())->count() < 1) {
            Mail::to($email->from())->send(new WelcomeMail());
            return;
        }

        if (! User::where('email', $email->from())->first()->email_verified_at) {
            return;
        }

        $mail = ReceivedMail::create([
        	'group'		=> 'medchem',
            'sender'    => $email->from(),
            'subject'   => $email->subject(),
            'content'   => $email->text(),
        ]);
    }
}
