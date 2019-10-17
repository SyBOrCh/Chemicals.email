<?php

namespace App;

use BeyondCode\Mailbox\InboundEmail;

class RegisterMailHandler
{
    public function __invoke(InboundEmail $email)
    {
        if ($email->from() !== config('app.admin_email')) {
            return;
        }

        $user = User::where('email', $email->subject())->first();

        if (!$user) {
            return;
        }

        $user->update(['email_verified_at' => now()]);

        return redirect('/');
    }
}
