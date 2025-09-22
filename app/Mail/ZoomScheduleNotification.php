<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\ZoomSchedule;

class ZoomScheduleNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $schedule;

    /**
     * Create a new message instance.
     */
    public function __construct(ZoomSchedule $schedule)
    {
        $this->schedule = $schedule;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '📅 Jadwal Zoom Baru: ' . ($this->schedule->title ?? 'Jadwal Baru'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.zoom.schedule',
            with: [
                'schedule' => $this->schedule,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
