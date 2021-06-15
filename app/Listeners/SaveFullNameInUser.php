<?php

namespace App\Listeners;

use App\Events\FullNameInOrderSavedOrUpdated;

class SaveFullNameInUser
{
    public function handle(FullNameInOrderSavedOrUpdated $event)
    {
        if (!$event->user->name) {
            $event->user->name = $event->order->name;
            $event->user->save();
        }
    }
}
