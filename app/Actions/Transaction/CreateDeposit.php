<?php

namespace App\Actions\Transaction;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\PlanUser;
use App\Models\Plan;
use App\Models\User;
use Session;

class CreateDeposit {

    /**
     * Validate and create a newly deposit use plan_user table
     *
     * @param  array  $input
     * @return \App\Models\PlanUser
     */
    public function create(array $input) {
        $messages = [
            'user_id.required' => __('Please choose User!'),
            'plan_id.required' => __('Please choose Investment Plans!'),
            'amount.required' => __('Please input amount of Investment Plans!'),
        ];
        Validator::make($input, [
            'user_id' => ['required'],
            'plan_id' => ['required'],
            'amount' => ['required'],
        ], $messages)->validate();
        $user = User::find($input['user_id']);
        $plan = Plan::find($input['plan_id']);
        if(intval($input['amount']) < intval($plan->min_deposit)) {
            Session::flash('error', __('Minimum amount of this Plans is ').format_currency($plan->min_deposit));
            return false;
        }
        if(!$user->canDeposit($input['amount'])) {
            Session::flash('error', __('User has not enough amount!'));
            return false;
        }
        $detail['username'] = $user ? $user->display_name() : 'Customer';
        $detail['email'] = $user ? $user->email : 'customer@gmail.com';
        $detail['planname'] = $plan ? $plan->title : 'Default';
        $detail['profit'] = $plan ? $plan->daily_profit : '0';
        return PlanUser::create([
            'user_id' => $input['user_id'],
            'plan_id' => $input['plan_id'],
            'amount' => $input['amount'],
            'author' => isset($input['author']) ? $input['author'] : Auth::id(),
            'detail' => $detail,
            'stop_date' => isset($input['stop_date']) ? $input['stop_date'] : NULL,
        ]);
    }
}
