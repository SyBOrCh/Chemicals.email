<?php

namespace App;

use App\ReceivedMail;
use BeyondCode\Mailbox\InboundEmail;

class MedchemMailHandler
{
    public function __invoke(InboundEmail $email)
    {
        $mail = ReceivedMail::create([
        	'group'		=> 'medchem',
            'sender'    => $email->from(),
            'subject'   => $email->subject(),
            'content'   => $email->text(),
        ]);
    }
}
