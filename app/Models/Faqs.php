<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Faqs extends Model {
    protected $table = "faqs";
    protected $fillable = [
        'content','post_id'
    ];
}
