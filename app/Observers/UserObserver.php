<?php

namespace App\Observers;

use App\Models\User;
use App\Notifications\UserWelcomeNotification;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        $token = Str::random(40);
        Cache::put('verify_token_'.$token,$user->id, 3600);

//        Mail::to($event->user->email)->send(new UserWelcomeMail($event->user, $token));
        $user->notify(new UserWelcomeNotification($token));
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        Cache::forget('verify_token_'.request()->token);
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
