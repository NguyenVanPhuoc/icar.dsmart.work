<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Referral extends Model {

    protected $table = "referrals";

    protected $fillable = [ 
        'user_id', 'deposit_id', 'amount', 'description'
    ];

    protected $casts = [
        'description' => 'array',
    ];

    /**
    * The model's default values for attributes.
    *
    * @var array
    */
    protected $attributes = [
        'description' => '{
            "username": "from Customer",
            "planname": "Default",
            "amount": 0,
            "rate": 0
        }'
    ];


    /**
    * Get user of refferal/ user has registed
    */
    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    /**
    * Get deposit of referral
    */
    public function deposit() {
        return $this->belongsTo('App\Models\PlanUser', 'deposit_id', 'id');
    }
}
