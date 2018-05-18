<?php

namespace App\Http\Controllers;

use App\Events\MessagePosted;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatRoomController extends Controller
{
    /**
     * Get all messages.
     *
     * @return array[]
     */
    public function getMessages()
    {
        $messages = Message::with('user')->get();

        $user = Auth::user();

        $users = User::with(['messages' => function ($query) {
            $query->orderBy('created_at', 'desc')->first();
        }])
                    ->where('id', '<>', $user->id)
                    ->orderBy('name', 'desc')
                    ->get();

        $data = [
            'user'     => $user,
            'contacts' => $users,
            'messages' => $messages,
        ];

        return $data;
    }

    /**
     * Store a new message.
     *
     * @param Request $request
     *
     * @return array[]
     */
    public function storeMessage(Request $request)
    {
        $user = Auth::user();

        $message = $user->messages()->create([
            'message' => request()->get('message'),
        ]);

        broadcast(new MessagePosted($message, $user))->toOthers();

        return ['status' => 'OK'];
    }
}
