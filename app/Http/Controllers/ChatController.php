<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Message;
use App\User;
use App\Events\NewMessageAdded;

class ChatController extends Controller
{
	public function __construct()
	{	
    	$this->middleware('auth');
	}

    public function getIndex()
    {
    	$messages = Message::all();
    	return view('chat.index', compact('messages'));
    }

    public function postMessage(Request $request)
    {
    	$message = new Message($request->all());
        $message->author = \Auth::user()->email;
        $message->save();

    	event(
    		new NewMessageAdded($message)
    	);
    	return redirect()->back();
    }
}
