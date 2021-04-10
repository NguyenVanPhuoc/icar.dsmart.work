<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PlanUser extends Model {

    protected $table = "plan_user";

    protected $fillable = [ 
        'author', 'plan_id', 'user_id', 'amount', 'detail', 'stop_date'
    ];

    protected $casts = [
        'detail' => 'array',
    ];

    /**
    * The model's default values for attributes.
    *
    * @var array
    */
    protected $attributes = [
        'detail' => '{
            "username": "Customer",
            "email": "Customer@mail",
            "planname": "Default",
            "profit": 0
        }'
    ];

    /**
    * Get user of deposit
    */
    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id' , 'id');
    }

    /**
    * Get author of deposit
    */
    public function auth() {
        return $this->belongsTo('App\Models\User', 'author' , 'id');
    }

    /**
    * Get plan of deposit
    */
    public function plan() {
        return $this->belongsTo('App\Models\Plan', 'plan_id' , 'id');
    }

    /**
    * Get referral of deposit
    */
    public function referral() {
        return $this->hasOne('App\Models\Referral', 'deposit_id', 'id');
    }

    /**
    * query deposit on active
    */
    public function scopeOnActive($query) {
        return $query->where('stop_date', NULL)->orWhereDate('stop_date', '>=', Carbon::now()->format('Y-md-d H:i:s'));
    }

    /**
    * Some function
    */
    public function isStopped() {
        return $this->stop_date != NULL && $this->stop_date < Carbon::now()->format('Y-md-d H:i:s');
    }
}
