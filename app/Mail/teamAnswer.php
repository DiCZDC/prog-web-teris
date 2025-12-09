<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class teamAnswer extends Mailable
{
    use Queueable, SerializesModels;
    protected $user;
    protected $userDestination;
    protected $team;
    protected $answer;
    protected $mailSender;
    /**
     * Create a new message instance.
     */
    public function __construct($user, $userDestination, $team, $answer, $mailSender)
    {
        $this->user = $user;
        $this->userDestination = $userDestination;
        $this->team = $team;
        $this->answer = $answer;
        $this->mailSender = $mailSender;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->mailSender, "Support Teris"),
            subject: 'Tu invitación al equipo ' . $this->team['nombre'] . ' ha sido respondida',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            html: 'mails.team.answer',
            with: [
                'userName' => $this->userDestination['name'],
                'teamMemberName' => $this->user['name'],
                'teamName' => $this->team['nombre'],
                'response' => $this->answer,
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
