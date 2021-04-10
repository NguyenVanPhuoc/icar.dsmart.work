<?php
 
namespace App\Console\Commands;
 
use Illuminate\Console\Command;
use App\Models\PlanUser;
use App\Events\UpdateUserAmount;
use App\Events\UpdateEarnedTotal;
 
class DailyProfit extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'userAmount:dailyProfit';
 
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add Daily profit to User amount';
 
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }
 
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $deposits = PlanUser::onActive()->whereHas('plan', function ($query) {
                                            $query->postPublished();
                                        })->get();
        if($deposits) {
            foreach ($deposits as $deposit) {
                event(new UpdateUserAmount($deposit->user, floatval($deposit->amount * floatval($deposit->detail['profit'])/100)));
                event(new UpdateEarnedTotal($deposit->user, floatval($deposit->amount * floatval($deposit->detail['profit'])/100)));
            }
        }
    }
}