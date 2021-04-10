<?php
use Illuminate\Support\Facades\Auth;
use App\Models\Page;

if(! function_exists('get_template')) {
    function get_template() {
        return array(
            'default'=>'Default',
            'home'=>'Homepage',
            'faqs'=>'Faqs',
            'contact'=>'Contact',
            'investments'=>'Investments',
            'affiliate'=>'Affiliate'
        );
    }
}
if(! function_exists('get_pageByTemplate')) {
    function get_pageByTemplate($template,$post_id) {
        return Page::leftJoin('posts','posts.id','=','pages.post_id')
                    ->select('title','posts.slug as slug','content','meta_key','meta_value','excerpt','image_id')
                    ->where('type','page')
                    ->where('posts.id',$post_id)
                    ->where('template', $template)->first();
    }
}
if(! function_exists('get_pages')) {
    function get_pages() {
        return Page::leftJoin('posts','posts.id','=','pages.post_id')
                    ->select('pages.id as id','title','posts.slug as slug','post_id')
                    ->where('type','page')
                    ->latest('posts.created_at')->get();
    }
}