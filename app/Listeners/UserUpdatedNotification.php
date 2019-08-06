<?php

namespace App\Listeners;

use App\Events\UserUpdate;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserUpdated;

class UserUpdatedNotification
{

    public function handle(UserUpdate $event)
    {
        $userNew = $event->user;
        Mail::to($event->old_email)->send(new UserUpdated($userNew));
    }
}
