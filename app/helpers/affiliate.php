<?php
use Illuminate\Support\Facades\Auth;
use App\Models\Affiate;

if(! function_exists('get_affiates')) {
    function get_affiates($number) {
        return Affiate::leftJoin('posts','posts.id','=','affiates.post_id')
        ->select('title','image_id','post_id','affiates.id as id','turnover','rewards')
        ->where('type','affiate')
        ->where('status','public')->latest('posts.created_at')->paginate($number);
    }
}