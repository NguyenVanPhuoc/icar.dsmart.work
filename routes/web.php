<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\frontends\PageController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('image/{scr}/{w}/{h}', function($src, $w=100, $h=100){
	$caheimage = Image::cache(function($image) use ($src, $w, $h){ return $image->make(public_path('uploads/').$src)->fit($w, $h);}, 10, true);
	$extention = explode(".", $src);
	return $caheimage->response($extention[1]);
});


Route::group(['prefix'=>'account','middleware' => 'auth'],function(){
	Route::get('/', [UserController::class, 'profile'])->name('profile.index');
	Route::get('/update', [UserController::class, 'edit'])->name('profile.edit');
	Route::post('/update', [UserController::class, 'update'])->name('profile.update');
	Route::get('/make-deposit', [UserController::class, 'makeDeposit'])->name('profile.make_deposit');
	Route::post('/make-deposit', [UserController::class, 'createDeposit'])->name('profile.post_make_deposit');
	Route::get('/deposits-history', [UserController::class, 'depositsHistory'])->name('profile.deposits_history');
	Route::get('/earning-history', [UserController::class, 'earningHistory'])->name('profile.earning_history');
	Route::get('/withdraw', [UserController::class, 'withdraw'])->name('profile.withdraw');
	Route::post('/withdraw', [UserController::class, 'makeWithdraw'])->name('profile.make_withdraw');
	Route::get('/withdraw-history', [UserController::class, 'withdrawHistory'])->name('profile.withdraw_history');
	Route::get('/withdraw-detail/{withdraw_id}', [UserController::class, 'withdrawDetail'])->name('profile.withdraw_detail');
	Route::get('/recharge', [UserController::class, 'recharge'])->name('profile.recharge');
	Route::post('/recharge', [UserController::class, 'makeRecharge'])->name('profile.make_recharge');
	Route::get('/referrals', [UserController::class, 'referrals'])->name('profile.referrals');
	Route::get('/referral-history', [UserController::class, 'referralHistory'])->name('profile.referral_history');
});
Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/ref={ref}', [UserController::class, 'referralLink'])->name('referral_link');
Route::get('{slug}', [PageController::class, 'slug'])->name('slug');
Route::post('contact',[PageController::class, 'sendContact'])->name('sendContact');
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
