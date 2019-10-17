<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
use App\ReceivedMail;

class IncomingMailTest extends TestCase
{
    use RefreshDatabase;

   public function setUp(): void
   {
       parent::setUp();

       config(['mail.driver' => 'log']);
   } 

   /** @test **/  
   function incoming_mail_is_saved_to_the_mails_table()
   {
        $email = new TestMail(
            $sender = 'sender@example.com',
            $subject = 'Test E-mail',
            $content = 'Some example text in the body'
        );

        Mail::to('syborch@chemicals.email')->send($email);

        $this->assertCount(1, ReceivedMail::all());

        tap(ReceivedMail::first(), function ($mail) use ($sender, $subject, $content) {
            $this->assertEquals($sender, $mail->sender);    
            $this->assertEquals('syborch', $mail->group); 
            $this->assertEquals($subject, $mail->subject);    
            $this->assertStringContainsString($content, $mail->content);    
        });
    }

    /** @test **/
    function query_keywords_are_extracted_from_incoming_emails()
    {
        $content = <<<MULTILINE
nBuLi
n-butyllithium
lithium
MULTILINE;
        
        $email = new TestMail(null, null, $content);

        Mail::to('meDcHem@chemicals.email')->send($email);

        tap(ReceivedMail::first(), function ($mail) {
            $this->assertEquals('medchem', $mail->group);
            $this->assertContains('nBuLi', $mail->keywords());
            $this->assertContains('n-butyllithium', $mail->keywords());
            $this->assertContains('lithium', $mail->keywords());
        });
    }
}
