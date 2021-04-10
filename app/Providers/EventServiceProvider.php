<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use App\Events\UpdateUserAmount;
use App\Events\UpdateEarnedTotal;
use App\Events\NewDeposit;

use App\Listeners\LastUserLogin;
use App\Listeners\UpdatedUserAmount;
use App\Listeners\UpdatedEarnedTotal;
use App\Listeners\AddReferralLink;
use App\Listeners\CreateReferral;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            AddReferralLink::class,  // Add referral if registed new user
        ],

        Login::class => [
            LastUserLogin::class,
        ],

        UpdateUserAmount::class => [ // Update User amount (withdraw, recharge, deposit)
            UpdatedUserAmount::class,
        ],

        UpdateEarnedTotal::class => [ // Update earned total amount for User (daily Profit)
            UpdatedEarnedTotal::class,
        ],

        NewDeposit::class => [
            CreateReferral::class,   // Create new Referral if user has create new Deposit
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
