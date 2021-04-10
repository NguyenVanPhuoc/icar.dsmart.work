<?php
use Illuminate\Support\Facades\Auth;
use App\Models\Faqs;

if(! function_exists('get_faqs')) {
    function get_faqs($number) {
        return Faqs::leftJoin('posts','posts.id','=','faqs.post_id')
        ->select('title','content','post_id','faqs.id as id','slug')
        ->where('type','faqs')
        ->where('status','public')->latest('posts.created_at')->paginate($number);
    }
}