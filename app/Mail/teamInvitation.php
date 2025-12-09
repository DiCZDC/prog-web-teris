<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class teamInvitation extends Mailable
{
    use Queueable, SerializesModels;
    protected $user;
    protected $team;
    protected $mailsender;
    /**
     * Create a new message instance.
     */
    public function __construct($user, $team, $mailsender)
    {
        $this->user = $user;
        $this->team = $team;
        $this->mailsender = $mailsender;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->mailsender,"Support Teris"),
            subject: 'Invitación para unirse al equipo ' . $this->team['nombre'],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            html: 'mails.team.invitation',
            with:[
                'userName' => $this->user['name'],
                'teamName' => $this->team['nombre'],
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
