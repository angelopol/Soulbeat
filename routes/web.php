<?php

use App\Http\Controllers\ChatsController;
use App\Http\Controllers\CompanySettingsController;
use App\Http\Controllers\CompanyUsersController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\GuidesController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LicensesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaidMethodsController;
use App\Http\Controllers\PlaylistsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QAController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
#Ruta Landing page
Route::get('/', [LandingController::class,"view"])->name('landing.view');

#Rutas Login
#Laravel?
Route::get('/login-company',[LoginController::class,"viewCompany"])->name('company.view');
Route::post('/login-company',[LoginController::class,"loginCompany"])->name('company.login');

#Ruta Feed
Route::get('/home',[FeedController::class,"view"])->name('feed.view');

#Rutas Post
Route::controller(PostController::class)->group(function(){
    Route::post('/post',"storePost")->name('post.store');
    Route::patch('/post/{post}/update', "updatePost")->name('post.update');
    Route::patch('/post/{post}/reaction', "updateReaction")->name('post.update.reaction');
    Route::delete('/posts/{post}/archive', "archivePost")->name('post.archive');
    Route::delete('/posts/{post}/destroy', "destroyPost")->name('post.destroy');
});

#Search routes
Route::get('/search/posts', [SearchController::class,"viewPosts"])->name('searchPosts.view');
Route::get('/search/users', [SearchController::class,"viewPosts"])->name('searchUsers.view');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

#Profile routes
Route::controller(ProfileController::class)->group(function () {
    Route::get('/user/{user}','viewPosts')->name('post.view');
    Route::get('/user/{user}/reviews','viewReviews')->name('reviews.view');
    Route::get('/user/{user}/followers','viewFollowers')->name('followers.view');
    Route::get('/user/{user}/followeds','viewFolloweds')->name('followeds.view');
    Route::post('/user/{user}/biography','storeBiography')->name('biography.store');
    Route::patch('/user/{user}/biography/update','updateBiography')->name('biography.update');
    Route::delete('/user/{user}/biography/destroy','destroyBiography')->name('biography.delete');
    Route::post('/user/{user}/photo','storePhoto')->name('photo.store');
    Route::patch('/user/{user}/photo/update','updatePhoto')->name('photo.update');
    Route::delete('/user/{user}/photo/destroy','destroyPhoto')->name('photo.destroy');
});

require __DIR__.'/auth.php';

#playlists routes
Route::controller(PlaylistsController::class)->group(function(){
    Route::get('/user/{user}/playlists',"viewPlaylists")->name('playlist.view');
    Route::get('/user/{user}/playlists/{playlist}',"showPlaylist")->name('playlist.show');
    Route::post('/user/{user}/playlists',"storePlaylist")->name('playlist.store');
    Route::patch('/user/{user}/playlists/{playlist}/update',"updatePlaylist")->name('playlist.update');
    Route::delete('/user/{user}/playlists/{playlist}/destroy',"destroyPlaylist")->name('playlist.destroy');
});

#chats routes
Route::controller(ChatsController::class)->group(function(){
    Route::get('/chat/direct',"viewDirects")->name('directs.view');
    Route::get('/chat/transaction',"viewTransaction")->name('transaction.view');
    Route::get('/chat/{chat}',"showChat")->name('chat.show');
    Route::post('/chat/{chat}',"storeChat")->name('chat.store');
    Route::delete('/chat/{chat}/destroy',"destroyChat")->name('chat.destroy');
    Route::patch('/chat/{chat}/time',"updateChatTime")->name('chatTime.update');
    Route::patch('/chat/{chat}/accept',"updateChatAccept")->name('chatAccept.update');
    Route::post('/chat/{chat}/message',"storeMessage")->name('message.store');
    Route::delete('/chat/{chat}/message/{message}/update',"destroyMessage")->name('message.destroy');
});

#settings routes
Route::controller(SettingsController::class)->group(function(){
    Route::get('/settings',"viewSettings")->name('settings.view');
    Route::get('/settings/global-parameters',"viewGlogalParameters")->name('globalParameters.view');
    Route::get('/settings/support',"viewSupport")->name('suport.view');
    Route::get('/settings/support/guides',"viewGuides")->name('settingGuides.view');
    Route::get('/settings/support/q&a',"viewQA")->name('settingQA.view');
    Route::get('/settings/ads',"viewAds")->name('ads.view');
    Route::get('/settings/subscription',"viewSubscription")->name('subscription.view');
    Route::post('/settings/subscription',"storeSubscription")->name('subscription.store');
    Route::delete('/settings/subscription/destroy',"destroySubscription")->name('subscription.destroy');
    Route::post('/settings/user/enable',"enableUser")->name('settingUser.enable');
    Route::post('/settings/user/disable',"disableUser")->name('settingUser.disable');
    Route::delete('/settings/user/destroy',"destroyUser")->name('settingUser.destroy');
});

#CompanySettings routes
Route::controller(CompanySettingsController::class)->group(function(){
    Route::get('/settings-company',"viewSettings")->name('companySettings.view');
    Route::get('/settings-company/payment',"viewPayment")->name('payment.view');
    Route::get('/settings-company/parameters',"viewParameters")->name('parameters.view');
    Route::patch('/settings-company/parameters/update',"updateParameters")->name('parameters.update');
});

#Licenses routes
Route::controller(LicensesController::class)->group(function(){
    Route::get('/settings-company/licenses',"viewLicenses")->name('licenses.view');
    Route::post('/settings-company/licenses',"storeLicenses")->name('licenses.store');
    Route::patch('/settings-company/licenses/{license}/update',"updateLicenses")->name('licenses.update');
    Route::delete('/settings-company/licenses/{license}/destroy',"destroyLicenses")->name('licenses.destroy');
});

#PaidMethods routes
Route::controller(PaidMethodsController::class)->group(function(){
    Route::get('/settings-company/paid-methods',"viewPaidMethods")->name('paidMethods.view');
    Route::post('/settings-company/paid-methods',"storePaidMethods")->name('paidMethods.store');
    Route::patch('/settings-company/paid-methods/{paid_method}/update',"updatePaidMethods")->name('paidMethods.update');
    Route::delete('/settings-company/paid-methods/{paid_method}/destroy',"destroyPaidMethods")->name('paidMethods.destroy');
});

#Guides routes
Route::controller(GuidesController::class)->group(function(){
    Route::get('/settings-company/guides',"viewGuides")->name('guides.view');
    Route::post('/settings-company/guides',"storeGuides")->name('guides.store');
    Route::patch('/settings-company/guides/{guide}/update',"updateGuides")->name('guides.update');
    Route::delete('/settings-company/guides/{guide}/destroy',"destroyGuides")->name('guides.destroy');
});

#Q&A routes
Route::controller(QAController::class)->group(function(){
    Route::get('/settings-company/q&a',"viewQA")->name('QA.view');
    Route::post('/settings-company/q&a',"storeQA")->name('QA.store');
    Route::patch('/settings-company/q&a/{q&a}/update',"updateQA")->name('QA.update');
    Route::delete('/settings-company/q&a/{q&a}/destroy',"destroyQA")->name('QA.destroy');
});

#CompanyUsers routes
Route::controller(CompanyUsersController::class)->group(function(){
    Route::get('/settings-company/users',"viewUsers")->name('companyUsers.view');
    Route::post('/settings-company/users',"storeUsers")->name('companyUsers.store');
    Route::patch('/settings-company/users/{user}/update',"updateUsers")->name('companyUsers.update');
    Route::post('/settings-company/user/{user}/enable',"enableUser")->name('companyUser.enable');
    Route::post('/settings-company/user/{user}/disable',"disableUser")->name('companyUser.disable');
    Route::delete('/settings-company/users/{user}/destroy',"destroyUser")->name('companyUser.destroy');
    Route::patch('/settings-company/users/{user}/permissions/update',"updatePermissions")->name('permissions.update');
});