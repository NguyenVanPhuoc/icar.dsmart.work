<?php
use Illuminate\Support\Facades\Auth;
use App\Models\Plan;

if(! function_exists('get_plans')) {
    function get_plans($number) {
        return Plan::leftJoin('posts','posts.id','=','plans.post_id')
        ->select('title','image_id','post_id','plans.id as id','min_deposit','daily_profit')
        ->where('type','plan')
        ->where('status','public')->latest('posts.created_at')->paginate($number);
    }
}