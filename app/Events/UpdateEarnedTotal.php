<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use App\Models\User;

class UpdateEarnedTotal {
    use SerializesModels;

    /**
     * The User.
     *
     * @var App\Models\User
     */
    public $user;
    public $amount;

    /**
     * Create a new event instance.
     *
     * @param  App\Models\User $user
     * @return void
     */
    public function __construct($user, $amount) {
        $this->user = $user;
        $this->amount = $amount;
    }
}
