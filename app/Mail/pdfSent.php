<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class pdfSent extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    protected $team;
    protected $user;
    protected $mailsender;
    protected $date;
    protected $event;
    public function __construct($team, $user, $mailsender, $event, $date)
    {
        $this->team = $team;
        $this->user = $user;
        $this->mailsender = $mailsender;
        $this->event = $event;
        $this->date = $date;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->mailsender,"Support Teris"),
            subject: 'Tu certificado del evento ' . $this->event['nombre'],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            html: 'mails.pdf.cert',
            with: [
                'userName' => $this->user['name'],
                'teamName' => $this->team['nombre'],
                'eventName' => $this->event['nombre'],
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            \Illuminate\Mail\Mailables\Attachment::fromData(fn () => Pdf::loadView('pdf.participation', [
                'userName' => $this->user['name'],
                'teamName' => $this->team['nombre'],
                'eventName' => $this->event['nombre'],
                'eventDate' => \Carbon\Carbon::parse($this->date)->format('d/m/Y'),
            ])->setPaper('a4')->output(), 'certificado-' . $this->event['nombre'] . '.pdf')
                ->withMime('application/pdf')
        ];
    }
}
