<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class MenuMetas extends Model
{
    protected $table = "menu_metas";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title_custom','title_default','parent','position','user_id','menu_id','type','target','post_id'
    ];
}