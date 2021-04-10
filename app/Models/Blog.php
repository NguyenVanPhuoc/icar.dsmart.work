<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model {
    protected $table = "blogs";
    protected $fillable = [
        'post_id','cat_ids','content'
    ]; 
    protected $casts = [
        'cat_ids' => 'array'
    ];
    public function post() {
        return $this->belongsTo('App\Post', 'post_id' , 'id');
    }
}
