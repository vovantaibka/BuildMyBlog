<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\MessagePosted;
use App\User;
use App\Message;

class ChatRoomController extends Controller
{
    public function getMessages()
    {
    	$messages = Message::with('user')->get();
    	$user = Auth::user();

    	$data = array('userName' => $user->name,
    		'messages' => $messages);

    	return $data;
    }

    public function storeMessage(Request $request)
    {	
    	$user = Auth::user();

	    $message = $user->messages()->create([
	        'message' => request()->get('message')
	    ]);

	    broadcast(new MessagePosted($message, $user))->toOthers();

	    return ['status' => 'OK'];
    }
}
