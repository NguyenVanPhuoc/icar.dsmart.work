<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class BlogCate extends Model {
    protected $table = "blog_cats";


    protected $fillable = [
        'content', 'post_id'
    ];

}
