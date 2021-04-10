<?php
namespace App\Http\Controllers\backends;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\PlanUser;
use App\Models\Plan;
use App\Models\Referral;
use App\Models\Transaction;

class DashboardController extends Controller {

    public function index(){

        $new_deposit = PlanUser::with(['user:id,displayname', 'plan:id,post_id'])->latest()->take(5)->get();
        $request_withdraw = Transaction::with('user:id,displayname')->withdraw()->request()->latest()->take(5)->get();
        $request_recharge = Transaction::with('user:id,displayname')->send()->request()->latest()->take(5)->get();
        $rank_plans = Plan::select('id', 'post_id', 'daily_profit', 'created_at')->withCount('deposits')->orderBy('deposits_count', 'DESC')->orderBy('created_at', 'ASC')->take(5)->get();

        //Monthly statistics
        $monthly_time = Carbon::now()->subMonths(9);
        for( $i=10; $i>0; $i-- ) {
            $month_label[] = $monthly_time->format('M-Y');
            $mo = $monthly_time->format('m');
            $yr = $monthly_time->format('Y');
            $monthly_deposit[] = PlanUser::whereMonth('created_at', $mo)->whereYear('created_at', $yr)->sum('amount');
            $monthly_withdrawals[] = Transaction::withdraw()->complete()->whereMonth('created_at', $mo)->whereYear('created_at', $yr)->sum('amount');
            $monthly_recharges[] = Transaction::send()->complete()->whereMonth('created_at', $mo)->whereYear('created_at', $yr)->sum('amount');
            $monthly_time = $monthly_time->addMonth();
        }
        $transaction_label = json_encode([__('Deposit'), __('Withdrawals'), __('Recharge')]);

        //Daily statistics
        $daily_time = Carbon::now()->subDays(9);
        for( $i=10; $i>0; $i-- ) {
            $daily_label[] = $daily_time->format('d-M');
            $date = $daily_time->format('Y-m-d');
            $daily_deposit[] = PlanUser::whereDate('created_at', $date)->sum('amount');
            $daily_withdrawals[] = Transaction::withdraw()->complete()->whereDate('created_at', $date)->sum('amount');
            $daily_recharges[] = Transaction::send()->complete()->whereDate('created_at', $date)->sum('amount');
            $daily_time = $daily_time->addDay();
        }

        $data = [
            'total_plan'            => Plan::postPublished()->count('id'),
            'total_user'            => User::count('id'),
            'total_referral'        => User::where('referral_id', '!=', NULL)->count('id'),
            'total_investor'        => PlanUser::count('user_id'),
            'total_invested'        => PlanUser::sum('amount'),
            'total_withdraw'        => Transaction::withdraw()->complete()->sum('amount'),
            'total_recharge'        => Transaction::send()->complete()->sum('amount'),
            'total_turover'         => Referral::sum('amount'),
            'currency'              => get_option('currency'),
            'month_label'           => $month_label,
            'daily_label'           => $daily_label,
            'monthly_deposit'       => $monthly_deposit,
            'monthly_withdrawals'   => $monthly_withdrawals,
            'monthly_recharges'     => $monthly_recharges,
            'daily_deposit'         => $daily_deposit,
            'daily_withdrawals'     => $daily_withdrawals,
            'daily_recharges'       => $daily_recharges,
            'transaction_label'     => $transaction_label,
            'new_deposit'           => $new_deposit,
            'request_withdraw'      => $request_withdraw,
            'request_recharge'      => $request_recharge,
            'rank_plans'            => $rank_plans,
        ];
        return view('backends.dashboard',$data);
    }

}