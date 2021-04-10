<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model {

    protected $table = "transactions";

    protected $fillable = [ 
        'author', 'user_id', 'type', 'content', 'amount', 'status', 'image', 'user_action'
    ];

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id' , 'id');
    }

    public function auth() {
        return $this->belongsTo('App\Models\User', 'author' , 'id');
    }

    /**
     * Scope transaction is withdraw
     */
    public function scopeWithdraw($query) {
        return $query->where('type', 'withdraw');
    }

    /**
     * Scope transaction is send to amount
     */
    public function scopeSend($query) {
        return $query->where('type', 'send');
    }

    /**
     * Scope transaction is complete
     */
    public function scopeComplete($query) {
        return $query->where('status', 'complete');
    }

    /**
     * Scope transaction is on request
     */
    public function scopeRequest($query) {
        return $query->where('status', 'request');
    }


    /**
     * Check transaction added/subtracted to amount of user OR not yet!
     */
    public function checkActionToUser() {
        return $this->user_action == 'yes';
    }

}
