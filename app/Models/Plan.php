<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Plan extends Model {

    protected $table = "plans";

    protected $fillable = [ 
        'min_deposit', 'daily_profit', 'post_id', 'content'
    ];

    protected $appends = ['title', 'image'];

    /**
     * Append title
     */
    public function getTitleAttribute() {
        $post = Post::select('title')->find($this->post_id);
        if($post) return $post->title;
            else return '';
    }

    /**
    * Append image
    */
    public function getImageAttribute() {
        $post = Post::select('image_id')->find($this->post_id);
        if($post) return $post->image_id;
            else return '';
    }

    /**
     * Get dpost of plan
     */
    public function post() {
        return $this->belongsTo('App\Models\Post', 'post_id' , 'id');
    }

    /**
     * Scope plan is publish
     */
    public function scopePostPublished($query) {
        return $query->whereHas('post', function ($query) {
            $query->where('posts.status', 'public');
        });
    }

    /**
     * Get deposits of plan
     */
    public function deposits(){
        return $this->hasMany('App\Models\PlanUser', 'plan_id', 'id');
    }

    /**
    * Get users has deposit plan
    */
    public function users() {
        return $this->belongsToMany('App\Models\User', 'plan_user', 'plan_id', 'user_id');
    }
}
