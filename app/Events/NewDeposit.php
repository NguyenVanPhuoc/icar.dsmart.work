<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use App\Models\PlanUser;

class NewDeposit {
    use SerializesModels;

    /**
     * The depsosit.
     *
     * @var App\Models\PlanUser
     */
    public $deposit;

    /**
     * Create a new event instance.
     *
     * @param  App\Models\PlanUser  $deposit
     * @return void
     */
    public function __construct($deposit) {
        $this->deposit = $deposit;
    }
}
