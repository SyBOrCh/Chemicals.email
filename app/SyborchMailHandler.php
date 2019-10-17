<?php

namespace App;

use App\ReceivedMail;
use BeyondCode\Mailbox\InboundEmail;

class SyborchMailHandler
{
    public function __invoke(InboundEmail $email)
    {
        $mail = ReceivedMail::create([
        	'group'		=> 'syborch',
            'sender'    => $email->from(),
            'subject'   => $email->subject(),
            'content'   => $email->html(),
        ]);
    }
}
