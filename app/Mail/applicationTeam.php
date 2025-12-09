<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class applicationTeam extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $team;
    protected $response;
    protected $mailsender;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $team, $response, $mailsender)
    {
        $this->user = $user;
        $this->team = $team;
        $this->response = $response;
        $this->mailsender = $mailsender;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->mailsender,"Support Teris"),
            subject: 'Alguien te ha enviado una solicitud para unirse a tu equipo',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            html: 'mails.team.application',
            with: [
                'userName' => $this->user['name'],
                'teamName' => $this->team['name'],
                'response' => $this->response,
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
        return [];
    }
}
