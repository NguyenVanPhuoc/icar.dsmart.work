<?php
use App\Models\BlogCate;
use App\Models\Blog;
use App\Models\Post;

/**
* get all blog categories
* @return $objects
*/
if(! function_exists('get_blogCats')) {
    function get_blogCats() {
        return BlogCate::leftJoin('posts','posts.id','=','blog_cats.post_id')
                        ->where('type','blogCat')
                        ->where('status','public')
                        ->select('blog_cats.id as id','title','slug')->latest('blog_cats.created_at')->get();
    }
}
/**
* get all blog categories
* @return $objects
*/
// if(! function_exists('get_blogCats')) {
//     function get_blogCats() {
//         return BlogCate::select('id','title','slug')->latest()->get();
//     }
// }
/**
* get blog category by id
* @param $cat_id
* @return $object
*/
if(! function_exists('get_blogCat')) {
    function get_blogCat($cat_id) {
        return BlogCate::where('id',$cat_id)->select('id','title')->first();
    }
}
/**
* count items
* @param $cat_id
* @return $object
*/
if(! function_exists('count_blogCat')) {
    function count_blogCat($cat_id) {
        return BlogCate::whereRaw('JSON_CONTAINS(category_ids, \'["'.$cat_id.'"]\')')->count();
    }
}