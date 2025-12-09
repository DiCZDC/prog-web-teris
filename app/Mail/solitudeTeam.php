<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class solitudeTeam extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    protected $team;
    protected $userRequest;
    protected $userDestination;
    protected $mailsender;

    public function __construct($team, $userRequest, $userDestination, $mailsender)
    {
        $this->team = $team;
        $this->userRequest = $userRequest;
        $this->userDestination = $userDestination;
        $this->mailsender = $mailsender;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->mailsender,"Support Teris"),
            subject: 'Solicitud de unirse al equipo ' . $this->team['nombre'],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            html: 'mails.team.solitude',
            with: [
                'userName' => $this->userRequest['name'],
                'teamName' => $this->team['nombre'],
                'requesterName' => $this->userDestination['name'],
            ],
            //
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
