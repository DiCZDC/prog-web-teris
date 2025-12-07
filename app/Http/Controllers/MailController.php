<?php

namespace App\Http\Controllers;
use App\Mail\createdAccount;
use Illuminate\Http\Request;
use App\Mail\pdfSent;
class MailController extends Controller
{
    private $mailsender ="noreply_teris@test-ywj2lpnxppqg7oqz.mlsender.net";
    
    function sendCreatedAccountEmail($user){
        \Mail::to($user->email)
            ->send(new createdAccount($user, $this->mailsender));
        return "E-mail Enviado";
    }

    function sendSubmittedProjectEmail($user, $team){
        \Mail::to($user->email)
            ->send(new submittedProject($user, $team, $this->mailsender));
        return "E-mail Enviado";
    }
    
    function sendRatedProjectEmail($user, $team){
        \Mail::to($user->email)
            ->send(new ratedProject($user, $team, $this->mailsender));
        return "E-mail Enviado";
    }

    function sendCreatedTeamEmail($user, $team){
        \Mail::to($user->email)
            ->send(new joinedTeam($user, $team, $this->mailsender));
        return "E-mail Enviado";
    }
    
    function sendJoinedTeamEmail($user, $team){
        \Mail::to($user->email)
            ->send(new joinedTeam($user, $team, $this->mailsender));
        return "E-mail Enviado";
    }
    function sendPdfEmail($team, $user, $event, $date){
        \Mail::to($user->email)
            ->send(new pdfSent($team, $user, $this->mailsender, $event, $date));
        return "E-mail Enviado";
    }
}
