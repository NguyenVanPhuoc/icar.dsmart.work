<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Affiate extends Model {
    protected $table = "affiates";
    protected $fillable = [
        'post_id','turnover','rewards'
    ];
    public function post() {
        return $this->belongsTo('App\Post', 'post_id' , 'id');
    }
}
