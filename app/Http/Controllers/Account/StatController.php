<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Flat;

class StatController extends Controller
{
    public function show($slug){
        $flat = Flat::where('slug', $slug)->first();

        // check if user has post_id
        if (Auth::id() !== $flat->user_id) {
            abort('500');
        }

        // controllo utente ha quel flat che richiede di vedere
        if(empty($flat)){
          abort(404);
        }

        return view('user.stats', compact('flat'));
    }
}
