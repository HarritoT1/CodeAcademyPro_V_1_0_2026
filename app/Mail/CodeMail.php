<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $subjectMail,
        public string $code,
        public string $greeting,
        public string $salutation,
        public string $time,
        public int $attempts
    ) {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subjectMail,
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.code-mail',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}