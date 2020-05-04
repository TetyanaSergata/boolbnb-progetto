<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class MessageController extends Controller
{
    public function store(Request $request) {
        $this->validateRules =[
            'title'=> 'required|string|max:255',
            'email'=> 'required|email|max:255',
            'message'=> 'required|string|max:500'
          ];

          $request->validate($this->validateRules);
          $data = $request->all();
          $flatId = $data['id'];
          $newMessage = new Message;
          $newMessage->flat_id = $flatId;
          $newMessage->title = $data['title'];
          $newMessage->email = $data['email'];
          $newMessage->message = $data['message'];
          $saved = $newMessage->save();
          if(!$saved) {
            return redirect()->back()->withInput();
          } else {
            $status = 'messaggio inviato';
            // route('blog.single', ['id' => $article->id, 'slug' => $article->slug]);
            return redirect()->route('show.flat', ['slug' => $newMessage->flat->slug, 'status' => $status]);
          }
    }
}
