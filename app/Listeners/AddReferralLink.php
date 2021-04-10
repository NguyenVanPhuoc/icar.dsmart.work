<?php
namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use App\Models\User;

class AddReferralLink {

    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Registered $event
     * @return void
     */
    
    public function handle(Registered $event) {
    	$ref = app('request')->session()->get('referral_link');
        if($ref) {
            $ref_user = User::where('name', $ref)->first();
            if($ref_user && $ref_user->id != $event->user->id) {
                $event->user->referral_id = $ref_user->id;
                $event->user->save();
            }
        }
    }
}