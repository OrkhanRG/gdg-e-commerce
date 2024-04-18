<?php

namespace App\Listeners;

use App\Events\UserRegisterEvent;
use App\Mail\UserWelcomeMail;
use App\Notifications\UserWelcomeNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserRegisterListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegisterEvent $event): void
    {
        $token = Str::random(40);
        Cache::put('verify_token_'.$token, $event->user->id, 3600);

//        Mail::to($event->user->email)->send(new UserWelcomeMail($event->user, $token));
        $event->user->notify(new UserWelcomeNotification($token));
    }
}
