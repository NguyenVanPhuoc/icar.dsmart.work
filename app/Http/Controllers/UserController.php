<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Actions\Transaction\CreateDeposit;
use App\Actions\Transaction\CreateNewTransaction;
use App\Events\NewDeposit;
use App\Events\UpdateUserAmount;
use App\Models\Plan;
use App\Models\PlanUser;
use App\Models\Transaction;
use App\Models\Referral;
use App\Models\User;

class UserController extends Controller {

    /**
     * View Account Dashboard
     * @param  App\Http\Controllers\UserController $request
     * @return view
     */
    public function profile(Request $request) {
        $user = Auth::user()->load(['deposits' => function ($query) {
                                        return $query->latest();
                                    },'transactions' => function ($query) {
                                        return $query->select('user_id','type','status','amount','created_at')->withdraw()->complete()->latest();
                                    },'deposits.plan:id,post_id']);
        $active_deposit = $user->active_deposits->sum('amount');

        $profit = $user->get_meta('earned_total') != null ? $user->get_meta('earned_total') : 0;
        $earned_total = $profit + $user->referrals->sum('amount');
        
        $data = [
            'user' => $user,
            'active_deposit' => $active_deposit,
            'earned_total' => $earned_total,
        ];
        return view('profile.index', $data);
    }

    /**
     * View Edit Account
     * @param  App\Http\Controllers\UserController $request
     * @return view
     */
    public function edit(Request $request) {
        $data = [
        	'user' => Auth::user(),
        ];
        return view('profile.update-info', $data);
    }

    /**
     * Update Account Information
     * @param  App\Http\Controllers\UserController $request
     * @return reponse
     */
    public function update(Request $request) {
        $user = Auth::user();
        $rules = [
            // 'phone'=>['required',Rule::unique('users')->ignore($user->id)],
            // 'email'=>['required','email',Rule::unique('users')->ignore($user->id)],
            'displayname'=>'required',
        ];
        $messages = [
            // 'phone.required'=>'Please input phone number!',
            // 'phone.unique'=>'Phone had exist!',
            // 'email.required'=>'Please input email!',
            // 'email.unique'=>'Email had exist!',
            'displayname.required'=>'Please input Full name!',
        ];
        if($request->password != ''){
            $rules['password'] = 'required|min:8|max:32';
            $rules['password_confirmation'] = 'required|same:password';
            $messages['password.required'] = 'Please input password!';
            $messages['password.min'] = 'Password min is 8 characters!';
            $messages['password.max'] = 'Password min is 32 characters!';
            $messages['password_confirmation.required'] = 'Please confirm password!';
            $messages['password_confirmation.same'] = 'Password confirm not match!';
        }
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return redirect()->route('profile.edit')->withErrors($validator)->withInput();
        }else{
            // $user->phone = $request['phone'];
            // $user->email = $request['email'];
            // $user->address = $request['address'];
            // $user->image = $request['image'];
            $user->displayname = $request['displayname'];
            if($request->password != '') $user->password = bcrypt($request->password);
            if($user->save()) {
                if($user->wasChanged()) $request->session()->flash('success', 'Update Successful!');
            }else $request->session()->flash('error', 'Has error!');
            return redirect()->route('profile.edit');
        }
    }

    /**
     * View Account make deposit
     * @param  App\Http\Controllers\UserController $request
     * @return view
     */
    public function makeDeposit(Request $request) {
        $data = [
            'plans' => Plan::postPublished()->orderBy('min_deposit', 'ASC')->get(),
        ];

        return view('profile.make-deposit', $data);
    }

    public function createDeposit(Request $request, CreateDeposit $creator) {
        $amount = intval($request->deposit_amount);
        // return $amount;
        $currency = get_option('currency');
        $user = Auth::user();
        if($amount <= 0) {
             $request->session()->flash('error', __('Number of').' '.$currency.' '.__('not enough!'));
        }else{
            if(!$user->canDeposit($amount)) {
                $request->session()->flash('error', __('Number of').' '.$currency.' '.__('not enough!'));
            }else{
                // return 'To be Continue...';
                $plans = Plan::select('id', 'min_deposit')->orderBy('min_deposit', 'ASC')->get();
                if($plans):
                    $check = 0;
                    $total = $plans->count();
                    foreach ($plans as $key => $item) {
                        if($amount >= $item->min_deposit && ($key >= $total - 1 || (isset($plans[$key + 1]) && $amount < $plans[$key + 1]->min_deposit))) {
                            $check = $item->id;
                            break;
                        }
                    }
                    if($check != 0) {
                        event(new NewDeposit($deposit = $creator->create(['user_id' => $user->id, 'plan_id' => $check, 'amount' => $amount])));
                        if($deposit) {
                            event(new UpdateUserAmount($user, - $amount));
                            if($deposit->referral && $deposit->referral->user) event(new UpdateUserAmount($deposit->referral->user, $deposit->referral->amount));
                            $request->session()->flash('success', __('Create a deposit succesful!'));
                        }else{
                            $request->session()->flash('error', __('System has error! Please try again later!'));
                        }
                    }else{
                        $request->session()->flash('error', __('Don\'t find any match plans!'));
                    }
                else:
                    $request->session()->flash('error', __('Don\'t find any match plans!'));
                endif;
            }
        }
        return redirect()->back();
        // return redirect()->route('profile.make_deposit');
    }

    /**
     * View Account deposits history
     * @param  App\Http\Controllers\UserController $request
     * @return view
     */
    public function depositsHistory(Request $request) {
        $deposits = PlanUser::with('plan:id,post_id')->where('user_id', Auth::id())->latest()->paginate(15);
        $data = [
            'deposits' => $deposits
        ];

        return view('profile.deposits-history', $data);
    }

    /**
     * View Account earning history
     * @param  App\Http\Controllers\UserController $request
     * @return view
     */
    public function earningHistory(Request $request) {
        $data = [
            
        ];

        return view('profile.earning-history', $data);
    }

    /**
     * View Account withdraw
     * @param  App\Http\Controllers\UserController $request
     * @return view
     */
    public function withdraw(Request $request) {
        $user = Auth::user();
        $active_deposit = $user->active_deposits->sum('amount');
        $data = [
            'user' => $user,
            'active_deposit' => $active_deposit,
            'currency' => get_option('currency'),
        ];

        return view('profile.withdraw', $data);
    }

    /**
     * Make withdraw
     * @param  App\Http\Controllers\UserController $request
     * @return $result
     */
    public function makeWithdraw(Request $request, CreateNewTransaction $creator) {
        $user = Auth::user();
        $amount = $request->withdraw_amount;
        if($amount > 0){
            if($user->amount >= $amount) {
                $transaction = $creator->create(['amount'=>$amount, 'status'=>'request', 'type'=>'withdraw', 'content'=>$request->withdraw_content, 'user_id'=>$user->id, 'user_action'=>'yes']);

                if($transaction) {
                    $request->session()->flash('success', __('Send request successful!'));
                    event(new UpdateUserAmount($user, - $amount));
                }else $request->session()->flash('error', 'Has error!');

            }else $request->session()->flash('error', 'You not enough '.get_option('currency').'!');
        }else $request->session()->flash('error', 'Please input more amount!');

        return redirect()->route('profile.withdraw');
    }

    /**
     * View Account withdraw history
     * @param  App\Http\Controllers\UserController $request
     * @return view
     */
    public function withdrawHistory(Request $request) {
        $transactions = Transaction::with('auth')->where('user_id', Auth::id())->withdraw()->latest()->paginate(15);
        $data = [        
            'transactions' => $transactions,
            'statuses' => generate_transaction_status(),
        ];
        return view('profile.withdraw-history', $data);
    }

    /**
     * View Account withdraw detail
     * @param  App\Http\Controllers\UserController $request
     * @return view
     */
    public function withdrawDetail(Request $request, $withdraw_id) {
        $withdraw = Transaction::where('user_id', Auth::id())->withdraw()->find($withdraw_id);
        if($withdraw) {
            $data = [
                'withdraw' => $withdraw,
                'statuses' => generate_transaction_status(),
            ];
            return view('profile.withdraw-detail', $data);
        }else{
            $request->session()->flash('error', __('You don\'t have permission to view this Withdraw!'));
            return redirect()->back();
        }    
    }

    /**
     * View Account recharge with form request
     * @param  App\Http\Controllers\UserController $request
     * @return view
     */
    public function recharge(Request $request) {
        $user = Auth::user();
        $recharges = Transaction::where('user_id', Auth::id())->send()->paginate(15);
        $data = [
            'user' => $user,
            'recharges' => $recharges,
            'currency' => get_option('currency'),
            'statuses' => generate_transaction_status(),
        ];

        return view('profile.recharge', $data);
    }

    /**
     * Make withdraw
     * @param  App\Http\Controllers\UserController $request
     * @return $result
     */
    public function makeRecharge(Request $request, CreateNewTransaction $creator) {
        $user = Auth::user();
        $amount = $request->recharge_amount;
        if($amount > 0){
                $transaction = $creator->create(['amount'=>$amount, 'status'=>'request', 'type'=>'send', 'content'=>$request->recharge_content, 'user_id'=>$user->id, 'user_action'=>'no']);
                if($transaction) $request->session()->flash('success', __('Send request successful!'));
                    else $request->session()->flash('error', 'Has error!');
        }else $request->session()->flash('error', 'Please input more amount!');
        return redirect()->route('profile.recharge');
    }

    public function referrals(Request $request) {
        $user = Auth::user();
        $user_referrals = User::select('id', 'name', 'displayname', 'referral_id', 'created_at', 'email')->where('referral_id', $user->id)->latest()->paginate(15);
        $data = [
            'user' => $user,
            'user_referrals' => $user_referrals,
            'currency' => get_option('currency'),
        ];
        return view('profile.referrals', $data);
    }

    public function referralHistory(Request $request) {
        $referrals = Referral::where('user_id', Auth::id())->with(['deposit:id,user_id,plan_id,amount,detail', 'deposit.plan:id,post_id', 'deposit.user:id,displayname'])->latest()->paginate(15);
        $data = [
            'referrals' => $referrals,
            'currency' => get_option('currency'),
        ];
        return view('profile.referral-history', $data);
    }

    public function referralLink(Request $request, $ref) {
        $request->session()->put('referral_link', $ref);
        return redirect()->route('home');
    }


}