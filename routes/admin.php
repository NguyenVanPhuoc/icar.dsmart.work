<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backends\DashboardController;
use App\Http\Controllers\backends\OptionController;
use App\Http\Controllers\backends\RoleController;
use App\Http\Controllers\backends\media\MediaAdminController;
use App\Http\Controllers\backends\media\MediaCatAdminController;
use App\Http\Controllers\backends\UserAdminController;
use App\Http\Controllers\backends\PageAdminController;
use App\Http\Controllers\backends\FaqsAdminController;
use App\Http\Controllers\backends\blog\BlogAdminController;
use App\Http\Controllers\backends\blog\BlogCatAdminController;
use App\Http\Controllers\backends\PlanAdminController;
use App\Http\Controllers\backends\TransactionAdminController;
use App\Http\Controllers\backends\DepositAdminController;
use App\Http\Controllers\backends\AffiateAdminController;
use App\Http\Controllers\backends\MenuAdminController;
use App\Http\Controllers\backends\CustomFieldAdminController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[DashboardController::class, 'index'])->name('admin.dashboard');

Route::post('/change-slug/{id}',[PageAdminController::class, 'changeSlug'])->name('changeSlugAdmin');
Route::group(['prefix'=>'page'],function(){
	Route::get('/',[PageAdminController::class, 'index'])->name('pageAdmin');
	Route::get('/create',[PageAdminController::class, 'store'])->name('storePageAdmin');
	Route::post('/create',[PageAdminController::class, 'create'])->name('createPageAdmin');
	Route::get('/edit/{id}',[PageAdminController::class, 'edit'])->name('editPageAdmin');
	Route::post('/edit/{id}',[PageAdminController::class, 'update'])->name('updatePageAdmin');
	Route::post('/slug/{id}',[PageAdminController::class, 'changeSlug'])->name('slugPageAdmin');
	Route::post('/delete/{id}',[PageAdminController::class, 'delete'])->name('deletePageAdmin');
	Route::post('/delete-choose',[PageAdminController::class, 'deleteChoose'])->name('deleteChoosePageAdmin');
});
Route::group(['prefix'=>'blog'],function(){
	Route::get('/',[BlogAdminController::class, 'index'])->name('blogAdmin');
	Route::get('/create',[BlogAdminController::class, 'store'])->name('storeBlogAdmin');
	Route::post('/create',[BlogAdminController::class, 'create'])->name('createBlogAdmin');
	Route::get('/edit/{id}',[BlogAdminController::class, 'edit'])->name('editBlogAdmin');
	Route::post('/edit/{id}',[BlogAdminController::class, 'update'])->name('updateBlogAdmin');
	Route::post('/slug/{id}',[BlogAdminController::class, 'changeSlug'])->name('slugBlogAdmin');
	Route::post('/delete/{id}',[BlogAdminController::class, 'delete'])->name('deleteBlogAdmin');
	Route::post('/delete-choose',[BlogAdminController::class, 'deleteChoose'])->name('deleteChooseBlogAdmin');
});
Route::group(['prefix'=>'blog-cat'],function(){
	Route::get('/',[BlogCatAdminController::class, 'index'])->name('blogCatAdmin');
	Route::get('/create',[BlogCatAdminController::class, 'store'])->name('storeBlogCatAdmin');
	Route::post('/create',[BlogCatAdminController::class, 'create'])->name('createBlogCatAdmin');
	Route::get('/edit/{id}',[BlogCatAdminController::class, 'edit'])->name('editBlogCatAdmin');
	Route::post('/edit/{id}',[BlogCatAdminController::class, 'update'])->name('updateBlogCatAdmin');
	Route::post('/slug/{id}',[BlogCatAdminController::class, 'changeSlug'])->name('slugBlogCatAdmin');
	Route::post('/delete/{id}',[BlogCatAdminController::class, 'delete'])->name('deleteBlogCatAdmin');
	Route::post('/delete-choose',[BlogCatAdminController::class, 'deleteChoose'])->name('deleteChooseBlogCatAdmin');
});
Route::group(['prefix'=>'faqs'],function(){
	Route::get('/',[FaqsAdminController::class, 'index'])->name('faqsAdmin');
	Route::get('/create',[FaqsAdminController::class, 'store'])->name('storeFaqsAdmin');
	Route::post('/create',[FaqsAdminController::class, 'create'])->name('createFaqsAdmin');
	Route::get('/edit/{id}',[FaqsAdminController::class, 'edit'])->name('editFaqsAdmin');
	Route::post('/edit/{id}',[FaqsAdminController::class, 'update'])->name('updateFaqsAdmin');
	Route::post('/slug/{id}',[FaqsAdminController::class, 'changeSlug'])->name('slugFaqsAdmin');
	Route::post('/delete/{id}',[FaqsAdminController::class, 'delete'])->name('deleteFaqsAdmin');
	Route::post('/delete-choose',[FaqsAdminController::class, 'deleteChoose'])->name('deleteChooseFaqsAdmin');
});

Route::group(['prefix'=>'affiate'],function(){
	Route::get('/',[AffiateAdminController::class, 'index'])->name('affiateAdmin');
	Route::get('/create',[AffiateAdminController::class, 'store'])->name('storeAffiateAdmin');
	Route::post('/create',[AffiateAdminController::class, 'create'])->name('createAffiateAdmin');
	Route::get('/edit/{id}',[AffiateAdminController::class, 'edit'])->name('editAffiateAdmin');
	Route::post('/edit/{id}',[AffiateAdminController::class, 'update'])->name('updateAffiateAdmin');
	Route::post('/delete/{id}',[AffiateAdminController::class, 'delete'])->name('deleteAffiatedmin');
	Route::post('/delete-choose',[AffiateAdminController::class, 'deleteChoose'])->name('deleteChooseAffiateAdmin');
	Route::post('/delete/{id}',[AffiateAdminController::class, 'delete'])->name('deleteAffiateAdmin');
});

Route::group(['prefix'=>'media'],function(){
	Route::get('/',[MediaAdminController::class, 'index'])->name('mediaAdmin');
	Route::get('/create',[MediaAdminController::class, 'store'])->name('storeMediaAdmin');
	Route::post('/create',[MediaAdminController::class, 'create'])->name('createMediaAdmin');
	Route::get('/edit/{id}',[MediaAdminController::class, 'edit'])->name('editMediaAdmin');
	Route::post('/edit/{id}',[MediaAdminController::class, 'update'])->name('updateMediaAdmin');
	Route::post('/slug/{id}',[MediaAdminController::class, 'changeSlug'])->name('slugMediaAdmin');
	Route::post('/delete/{id}',[MediaAdminController::class, 'delete'])->name('deleteMediaAdmin');
	Route::post('/delete-choose',[MediaAdminController::class, 'deleteChoose'])->name('deleteChooseMediaAdmin');
	Route::post('/popup-media',[MediaAdminController::class, 'loadMediaPopup'])->name('popupMediaAdmin');
	Route::get('/popup-delete-media',[MediaAdminController::class, 'deleteMediaSinglePopup'])->name('popupDeleteMediaSingleAdmin');
	Route::post('/popup-more-media',[MediaAdminController::class, 'loadMorePagePopup'])->name('popupMoreMediaAdmin');
	Route::post('/popup-filter-media',[MediaAdminController::class, 'filterMediaPopup'])->name('popupFilterMediaAdmin');
	Route::post('/popup-search-media-cat',[MediaAdminController::class, 'loadMediaByCatPopup'])->name('popupSearchCatMediaAdmin');
});

Route::group(['prefix'=>'media-cate'],function(){
	Route::get('/',[MediaCatAdminController::class, 'index'])->name('mediaCatAdmin');
	Route::get('/create',[MediaCatAdminController::class, 'store'])->name('storeMediaCatAdmin');
	Route::post('/create',[MediaCatAdminController::class, 'create'])->name('createMediaCatAdmin');
	Route::get('/edit/{id}',[MediaCatAdminController::class, 'edit'])->name('editMediaCatAdmin');
	Route::post('/edit/{id}',[MediaCatAdminController::class, 'update'])->name('updateMediaCatAdmin');
	Route::post('/slug/{id}',[MediaCatAdminController::class, 'changeSlug'])->name('slugMediaCatAdmin');
	Route::post('/delete/{id}',[MediaCatAdminController::class, 'delete'])->name('deleteMediaCatAdmin');
	Route::post('/delete-choose',[MediaCatAdminController::class, 'deleteChoose'])->name('deleteChooseMediaCatAdmin');
});

Route::group(['prefix'=>'plans'],function(){
	Route::get('/',[PlanAdminController::class, 'index'])->name('admin.plans')->middleware('permission:plans.read');
	Route::get('/create',[PlanAdminController::class, 'create'])->name('admin.plan_create')->middleware('permission:plans.create');
	Route::post('/create',[PlanAdminController::class, 'store'])->name('admin.plan_store')->middleware('permission:plans.create');
	Route::get('/edit/{id}',[PlanAdminController::class, 'edit'])->name('admin.plan_edit')->middleware('permission:plans.read');
	Route::post('/edit/{id}',[PlanAdminController::class, 'update'])->name('admin.plan_update')->middleware('permission:plans.update');
	Route::post('/delete/{id}',[PlanAdminController::class, 'delete'])->name('admin.plan_delete')->middleware('permission:plans.delete');
	Route::post('/delete-choose',[PlanAdminController::class, 'deleteChoose'])->name('admin.plans_delete_choose')->middleware('permission:plans.delete');
});

Route::group(['prefix'=>'transactions'],function(){
	Route::get('/',[TransactionAdminController::class, 'index'])->name('admin.transactions');
	Route::get('/create',[TransactionAdminController::class, 'create'])->name('admin.transaction_create');
	Route::post('/create',[TransactionAdminController::class, 'store'])->name('admin.transaction_store');
	Route::get('/edit/{id}',[TransactionAdminController::class, 'edit'])->name('admin.transaction_edit');
	Route::post('/edit/{id}',[TransactionAdminController::class, 'update'])->name('admin.transaction_update');
	Route::post('/delete/{id}',[TransactionAdminController::class, 'delete'])->name('admin.transaction_delete');
	Route::post('/delete-choose',[TransactionAdminController::class, 'deleteChoose'])->name('admin.transactions_delete_choose');
});

Route::group(['prefix'=>'deposits'],function(){
	Route::get('/',[DepositAdminController::class, 'index'])->name('admin.deposits');
	Route::get('/create',[DepositAdminController::class, 'create'])->name('admin.deposit_create');
	Route::post('/create',[DepositAdminController::class, 'store'])->name('admin.deposit_store');
	Route::get('/edit/{id}',[DepositAdminController::class, 'edit'])->name('admin.deposit_edit');
	Route::post('/edit/{id}',[DepositAdminController::class, 'update'])->name('admin.deposit_update');
	Route::post('/delete/{id}',[DepositAdminController::class, 'delete'])->name('admin.deposit_delete');
	Route::post('/delete-choose',[DepositAdminController::class, 'deleteChoose'])->name('admin.deposits_delete_choose');
});

Route::group(['prefix'=>'user'],function(){
	Route::get('/',[UserAdminController::class, 'index'])->name('admin.users')->middleware('permission:users.read');
	Route::get('/create',[UserAdminController::class, 'create'])->name('admin.user_create')->middleware('permission:users.create');
	Route::post('/create',[UserAdminController::class, 'store'])->name('admin.user_store')->middleware('permission:users.create');
	Route::get('/edit/{id}',[UserAdminController::class, 'edit'])->name('admin.user_edit')->middleware('permission:users.read');
	Route::post('/edit/{id}',[UserAdminController::class, 'update'])->name('admin.user_update')->middleware('permission:users.update');
	Route::post('/delete/{id}',[UserAdminController::class, 'delete'])->name('admin.user_delete')->middleware('permission:users.delete');
	Route::post('/delete-choose',[UserAdminController::class, 'deleteChoose'])->name('admin.users_delete_choose')->middleware('permission:users.delete');
	Route::get('/create-permission/{permission}',[UserAdminController::class, 'createPermission'])->name('admin.permission_create');
});
Route::group(['prefix'=>'custom-fields'],function(){
	Route::get('/',[CustomFieldAdminController::class, 'index'])->name('customFieldAdmin');
	Route::get('/create',[CustomFieldAdminController::class, 'store'])->name('storeCustomFieldAdmin');
	Route::post('/create',[CustomFieldAdminController::class, 'create'])->name('createCustomFieldAdmin');
	Route::get('/edit/{id}',[CustomFieldAdminController::class, 'edit'])->name('editCustomFieldAdmin');
	Route::post('/edit/{id}',[CustomFieldAdminController::class, 'update'])->name('updateCustomFieldAdmin');
	Route::post('/delete/{id}',[CustomFieldAdminController::class, 'delete'])->name('deleteCustomFieldAdmin');
	Route::post('/delete-choose',[CustomFieldAdminController::class, 'deleteChoose'])->name('deleteChooseCustomFieldAdmin');
});
Route::group(['prefix'=>'system'],function(){
	Route::get('/option', [OptionController::class, 'index'])->name('admin.system')->middleware('permission:system.read|system.create|system.update|system.delete');
	Route::post('/option', [OptionController::class, 'update'])->name('admin.system_update')->middleware('permission:system.update|system.delete');
	Route::group(['prefix'=>'roles'],function(){
		Route::get('/',[RoleController::class, 'index'])->name('admin.roles')->middleware('permission:role.read');
		Route::get('/create',[RoleController::class, 'create'])->name('admin.role_create')->middleware('permission:role.create');
		Route::post('/create',[RoleController::class, 'store'])->name('admin.role_store')->middleware('permission:role.create');
		Route::get('/edit/{id}',[RoleController::class, 'edit'])->name('admin.role_edit')->middleware('permission:role.read');
		Route::post('/edit/{id}',[RoleController::class, 'update'])->name('admin.role_update')->middleware('permission:role.update');
		Route::post('/delete/{id}',[RoleController::class, 'delete'])->name('admin.role_delete')->middleware('permission:role.delete');
		Route::post('/delete-choose',[RoleController::class, 'deleteChoose'])->name('admin.roles_delete_choose')->middleware('permission:role.delete');
	});
	//menus
	Route::group(['prefix'=>'menu'],function(){
		Route::get('/',[MenuAdminController::class, 'index'])->name('menuAdmin');
		Route::get('/create',[MenuAdminController::class, 'store'])->name('storeMenuAdmin');
		Route::post('/create',[MenuAdminController::class, 'create'])->name('createMenuAdmin');
		Route::get('/edit/{id}',[MenuAdminController::class, 'edit'])->name('editMenuAdmin');
		Route::post('/edit/{id}',[MenuAdminController::class, 'update'])->name('updateMenuAdmin');
		Route::post('/delete/{id}',[MenuAdminController::class, 'delete'])->name('deleteMenuAdmin');
		Route::post('/delete-choose',[MenuAdminController::class, 'deleteChoose'])->name('deleteChooseMenuAdmin');
		Route::get('/sub/{id}',[MenuAdminController::class, 'storeSubMenu'])->name('storeSubMenuAdmin');
		Route::post('/sub/{id}',[MenuAdminController::class, 'createSubMenu'])->name('createSubMenuAdmin');
		Route::post('/load',[MenuAdminController::class, 'loadMenu'])->name('loadTypeMenuAdmin');
		Route::post('/search',[MenuAdminController::class, 'searchMenuAjax'])->name('searchMenuAdmin');
	});
});

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Application cache flushed";
})->middleware('role:admin');
Route::get('/clear-route-cache', function() {
    Artisan::call('route:clear');
    return "Route cache file removed";
})->middleware('role:admin');
Route::get('/clear-config-cache', function() {
    Artisan::call('config:clear');
    return "Configuration cache file removed";
})->middleware('role:admin');
Route::get('/tesss', function() {
    Artisan::call('optimize');
    return "optimize file removed";
})->middleware('role:admin');
Route::get('/updateapp', function() {
    system('composer dump-autoload --optimize');
    echo 'dump-autoload complete';
})->middleware('role:admin');

Route::get('/testDailyProfit', function() {
    Artisan::call('userAmount:dailyProfit');
    return "Schedule running!";
})->middleware('role:admin');