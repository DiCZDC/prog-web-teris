<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Mail\{
    createdAccount,
    pdfSent,
    teamInvitation,
    teamAnswer,
    solitudeTeam,
};

class MailController extends Controller
{
    private $mailsender ="fmauro@nubograma.com";
    
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
    //invitar a unirse al equipo
    function sendTeamInvitationEmail($user, $team){
        \Mail::to($user->email)
            ->send(new teamInvitation($user, $team, $this->mailsender));
        return "E-mail Enviado";
    }
    //responder a la invitacion de unirse al equipo
    function sendTeamAnswerEmail($user, $userDestination, $team, $answer){
        \Mail::to($user->email)
            ->send(new teamAnswer($userDestination, $user, $team, $answer, $this->mailsender));
        return "E-mail Enviado";
    }
    function sendApplicationTeamEmailResponse($user, $team, $response){
        \Mail::to($team->lider->email)
            ->send(new applicationTeam($user, $team, $response, $this->mailsender));
        return "E-mail Enviado";
    }
    //solicitud para unirse al equipo
    function sendSolitudeTeamEmail($team, $userRequest, $userDestination){
        \Mail::to($userDestination->email)
            ->send(new solitudeTeam($team, $userRequest, $userDestination, $this->mailsender));
        return "E-mail Enviado";
    }
}
