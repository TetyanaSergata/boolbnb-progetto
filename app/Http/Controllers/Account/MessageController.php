<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Flat;
use App\Messages;

class MessageController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index() {
        // dati utente
        $user = Auth::user();
        // richiedere tutti i flat del utente loggato
        $flats = $user->flats;

        // ciclare tutti i flat del utente
        $userMessage = [];
        foreach ($flats as $key => $flat) {
            foreach ($flat->messages as $key => $message) {
                $userMessage[] = $message;
            }
        }
        return view('user.message', ['userMessage' => $userMessage]);
    }
}