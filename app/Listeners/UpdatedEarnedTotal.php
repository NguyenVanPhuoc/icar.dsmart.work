<?php
namespace App\Listeners;
use App\Events\UpdateEarnedTotal;

class UpdatedEarnedTotal {
    /**
     * Handle the event.
     *
     * @param  App\Events\UpdateEarnedTotal  $event
     * @return void
     */
    public function handle(UpdateEarnedTotal $event) {
    	$event->user->updateEarnedAmount($event->amount);
    }
}