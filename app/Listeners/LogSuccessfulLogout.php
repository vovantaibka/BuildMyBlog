<?php

namespace App\Listeners;

use App\Events\UserLogged;
use Illuminate\Auth\Events\Logout;
use Illuminate\Http\Request;

class LogSuccessfulLogout
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param Logout $event
     *
     * @return void
     */
    public function handle(Logout $event)
    {
        $user = $event->user;

        $user->active = 0;

        $user->save();

        broadcast(new UserLogged($user->id))->toOthers();
    }
}
