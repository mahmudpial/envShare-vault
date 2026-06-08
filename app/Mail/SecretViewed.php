<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SecretViewed extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $ip,
        public string $viewedAt,
        public string $token,
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your .envShare secret was viewed',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.secret-viewed',
        );
    }
}