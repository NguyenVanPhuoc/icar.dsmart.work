<?php
namespace App\Listeners;
use App\Events\UpdateUserAmount;

class UpdatedUserAmount {
    /**
     * Handle the event.
     *
     * @param  App\Events\UpdateUserAmount  $event
     * @return void
     */
    public function handle(UpdateUserAmount $event) {
    	if($event->user->amount + $event->amount >= 0) $event->user->updateAmount($event->amount);
    }
}