<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CapsuleEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $capsule;

    public function __construct($capsule)
    {
        $this->capsule = $capsule;
    }

    public function build()
    {

        $html = "
        <h1>Hello {$this->capsule->user->name},</h1>
        <p>Your capsule <strong>{$this->capsule->title}</strong> has been revealed and its ready to be opened!</p>";
       
        return $this->subject("Your Time Capsule Is Ready!")
                    ->html($html);
    }
}
