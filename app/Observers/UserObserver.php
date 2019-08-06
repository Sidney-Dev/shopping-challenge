<?php

namespace App\Observers;

use App\User;
use App\Events\UserUpdate;

class UserObserver
{

    public function updated(User $user)
    {
        if($user->isDirty('email')){
            $new_email = $user->email; 
            $old_email = $user->getOriginal('email');

            event(new UserUpdate($user, $old_email));
        }
    }

}
