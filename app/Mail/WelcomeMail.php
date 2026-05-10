<?php

namespace App\Mail;

use App\Models\GeneralSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $schoolName;
    public string $schoolEmail;
    public string $schoolPhone;

    public function __construct(
        public string $subscriberEmail,
        public ?string $subscriberName = null,
    ) {
        $settings = GeneralSetting::first();
        $this->schoolName = $settings->school_name ?? 'SMA Tunas Harapan';
        $this->schoolEmail = $settings->email ?? 'info@smatunasharapan.sch.id';
        $this->schoolPhone = $settings->phone ?? '-';
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Selamat Datang di Newsletter {$this->schoolName}!",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.welcome',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
