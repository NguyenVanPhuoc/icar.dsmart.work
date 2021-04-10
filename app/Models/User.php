<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Carbon\Carbon;
use App\Models\UserMeta;

class User extends Authenticatable {
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'displayname',
        'name',
        'email',
        'password',
        'image',
        'address',
        'phone',
        'last_login',
        'amount',
        'referral_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the metas of user
     */
    public function user_metas(){
        return $this->hasMany('App\Models\UserMeta', 'user_id', 'id');
    }

    /**
     * Get transactions of user
     */
    public function transactions(){
        return $this->hasMany('App\Models\Transaction', 'user_id', 'id');
    }

    /**
     * Get transaction_author of user
     */
    public function transaction_authors(){
        return $this->hasMany('App\Models\Transaction', 'author', 'id');
    }

    /**
     * Get deposits of user
     */
    public function deposits(){
        return $this->hasMany('App\Models\PlanUser', 'user_id', 'id');
    }

    /**
     * Get active deposits of user
     */
    public function active_deposits(){
        return $this->hasMany('App\Models\PlanUser', 'user_id', 'id')->onActive();
    }

    /**
     * Get deposit_author of user
     */
    public function deposit_authors(){
        return $this->hasMany('App\Models\PlanUser', 'author', 'id');
    }

    /**
    * Get plans of user
    */
    public function plans() {
        return $this->belongsToMany('App\Models\Plan', 'plan_user', 'user_id', 'plan_id');
    }

    /**
    * Get referral user - user register
    */
    public function referral_user() {
        return $this->hasOne('App\Models\User', 'id', 'referral_id');
    }

    /**
    * Get all user referrals of current user
    * @return array object App\Models\User
    */
    public function user_referrals() {
        return $this->hasMany('App\Models\User', 'referral_id', 'id');
    }

    /**
    * Get all referral histories of user
    * @return array object App\Models\Referral
    */
    public function referrals() {
        return $this->hasMany('App\Models\Referral', 'user_id', 'id');
    }


    /**
     * Get user_meta by $key
     */
    public function get_meta($key){
        $res = $this->user_metas()->select('value')->where('key',$key)->first();
        if($res) return $res->value;
            else return null;
    }

    /**
     * Update user_meta by $key
     */
    public function update_meta($key, $value){
        if($this->get_meta($key) != null) return $this->user_metas()->update(['key'=>$key,'value'=>$value]);
            else return $this->user_metas()->create(['key'=>$key,'value'=>$value]);
    }

    /**
     * Update Earned Amount in UserMeta
     * @param $amount
     */
    public function updateEarnedAmount($amount) {
        $meta = $this->get_meta('earned_total');
        if($this->get_meta('earned_total') != null) {
            $this->user_metas()->update([
                                'key' => 'earned_total',
                                'value' => floatval($meta) + floatval($amount),
                                ]);
        }else{
            $this->user_metas()->create(['key'=>'earned_total', 'value'=>floatval($amount)]);
        }
    }

    /**
     * Update lastLogin
     */
    public function lastLogin() {
        $this->last_login = Carbon::now();
        return $this->save();
    }

    /**
     * Update User Amount
     * @param $amount
     */
    public function updateAmount($amount) {
        $this->amount += $amount;
        $this->save();
    }


    /**
     * Check user can deposit
     * @param $amount
     */
    public function canDeposit(int $amount) {
        return $this->amount >= $amount;
    }

    /**
     * Show displaynem
     * @param $amount
     */
    public function display_name() {
        return $this->displayname;
    }

    
}
