<?php

namespace App\Http\Controllers;
use App\Mail\createdAccount;
use Illuminate\Http\Request;

class MailController extends Controller
{
    
    function sendCreatedAccountEmail($user)
    {
        \Mail::to($user->email)
            ->send(new createdAccount($user));
        return "E-mail Enviado";
    }
    
}
