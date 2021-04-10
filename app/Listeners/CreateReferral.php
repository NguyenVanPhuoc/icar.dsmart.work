<?php

namespace App\Listeners;

use App\Events\NewDeposit;
use App\Models\Referral;

class CreateReferral {

    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\NewDeposit $event
     * @return void
     */
    
    public function handle(NewDeposit $event) {
        if($event->deposit->user && $event->deposit->user->referral_user) {
            $rate = get_option('affiliate') != NULL ? get_option('affiliate') : '0';
            $amount = floatval(floatval($rate) * floatval($event->deposit->amount) / 100);
            $description['username'] = $event->deposit->user ? $event->deposit->user->display_name() : 'from Customer';
            $description['planname'] = $event->deposit->plan ? $event->deposit->plan->title : 'Default';
            $description['amount'] = $event->deposit->amount ? $event->deposit->amount : '0';
            $description['rate'] = $rate;

            Referral::create([
                'user_id' => $event->deposit->user->referral_user->id,
                'deposit_id' => $event->deposit->id,
                'amount' => $amount,
                'description' => $description,
            ]);

        }
    }
}
