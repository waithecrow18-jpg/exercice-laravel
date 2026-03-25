<?php

namespace App\Mail;

use App\Models\Enrollment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EnrollmentCancelledMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Enrollment $enrollment) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('Your enrollment has been cancelled'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.enrollment-cancelled',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
