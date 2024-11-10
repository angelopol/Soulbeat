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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

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
    Route::get('/posts',"IndexPosts")->name('post.index');
    Route::post('/posts',"storePost")->name('post.store');
    Route::get('/posts/{post}',"ShowPost")->name('post.show');
    Route::post('/posts/download/{post}', "DownloadSong")->name('post.download');
    Route::patch('/posts/{post}/update', "updatePost")->name('post.update');
    Route::post('/posts/reaction/{post}/{reaction}', "updateReaction")->name('post.update.reaction');
    Route::post('/posts/archive/{post}', "archivePost")->name('post.archive');
    Route::post('/posts/destroy/{post}', "destroyPost")->name('post.destroy');
});

#Search routes
Route::get('/search/posts', [SearchController::class,"viewPosts"])->name('search.posts.view');
Route::get('/search/users', [SearchController::class,"viewPosts"])->name('search.users.view');

#Profile routes
Route::controller(ProfileController::class)->group(function () {
    Route::get('/user/{user}','viewPosts')->name('profile.post.view');
    Route::get('/user/{user}/posts','GetPosts')->name('profile.post.get');
    Route::get('/user/{user}/reviews','viewReviews')->name('profile.reviews.view');
    Route::get('/user/{user}/followers','viewFollowers')->name('profile.followers.view');
    Route::get('/user/{user}/followeds','viewFolloweds')->name('profile.followeds.view');
    Route::post('/user/followeds/update/{user}','updateFolloweds')->name('followeds.update');
    Route::post('/user/{user}/biography','storeBiography')->name('profile.biography.store');
    Route::patch('/user/{user}/biography/update','updateBiography')->name('profile.biography.update');
    Route::delete('/user/{user}/biography/destroy','destroyBiography')->name('profile.biography.destroy');
    Route::post('/user/{user}/photo','storePhoto')->name('profile.photo.store');
    Route::patch('/user/{user}/photo/update','updatePhoto')->name('profile.photo.update');
    Route::delete('/user/{user}/photo/destroy','destroyPhoto')->name('profile.photo.destroy');
});

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
    Route::get('/chats',"viewDirects")->name('chat.directs.view');
    Route::get('/chats/transaction',"viewTransaction")->name('chat.transaction.view');
    Route::get('/chats/{chat}',"showChat")->name('chat.show');
    Route::post('/chats/{chat}',"storeChat")->name('chat.store');
    Route::delete('/chats/{chat}/destroy',"destroyChat")->name('chat.destroy');
    Route::patch('/chats/{chat}/time',"updateChatTime")->name('chat.time.update');
    Route::patch('/chats/{chat}/accept',"updateChatAccept")->name('chat.accept.update');
    Route::post('/chats/{chat}/message',"storeMessage")->name('message.store');
    Route::delete('/chats/{chat}/message/{message}/update',"destroyMessage")->name('message.destroy');
});

#settings routes
Route::controller(SettingsController::class)->group(function(){
    Route::get('/settings',"viewSettings")->name('settings.view');
    Route::get('/settings/global-parameters',"viewGlogalParameters")->name('settings.global.parameters.view');
    Route::get('/settings/support',"viewSupport")->name('settings.support.view');
    Route::get('/settings/support/guides',"viewGuides")->name('setting.guides.view');
    Route::get('/settings/support/q&a',"viewQA")->name('setting.QA.view');
    Route::get('/settings/ads',"viewAds")->name('settings.ads.view');
    Route::get('/settings/subscription',"viewSubscription")->name('settings.subscription.view');
    Route::post('/settings/subscription',"storeSubscription")->name('settings.subscription.store');
    Route::delete('/settings/subscription/destroy',"destroySubscription")->name('settings.subscription.destroy');
    Route::post('/settings/user/enable',"enableUser")->name('setting.user.enable');
    Route::post('/settings/user/disable',"disableUser")->name('setting.user.disable');
    Route::delete('/settings/user/destroy',"destroyUser")->name('setting.user.destroy');
});

#CompanySettings routes
Route::controller(CompanySettingsController::class)->group(function(){
    Route::get('/settings-company',"viewSettings")->name('company.settings.view');
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
    Route::patch('/settings-company/licenses/{license}/update/{post}',"updatePost")->name('licensesPost.update');
});

#PaidMethods routes
Route::controller(PaidMethodsController::class)->group(function(){
    Route::get('/settings-company/paid-methods',"viewPaidMethods")->name('paid.methods.view');
    Route::post('/settings-company/paid-methods',"storePaidMethods")->name('paid.methods.store');
    Route::patch('/settings-company/paid-methods/{paid_method}/update',"updatePaidMethods")->name('paid.methods.update');
    Route::delete('/settings-company/paid-methods/{paid_method}/destroy',"destroyPaidMethods")->name('paid.methods.destroy');
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
    Route::get('/settings-company/users',"viewUsers")->name('company.users.view');
    Route::post('/settings-company/users',"storeUsers")->name('company.users.store');
    Route::patch('/settings-company/users/{user}/update',"updateUsers")->name('company.users.update');
    Route::post('/settings-company/user/{user}/enable',"enableUser")->name('company.user.enable');
    Route::post('/settings-company/user/{user}/disable',"disableUser")->name('company.user.disable');
    Route::delete('/settings-company/users/{user}/destroy',"destroyUser")->name('company.user.destroy');
    Route::patch('/settings-company/users/{user}/permissions/update',"updatePermissions")->name('permissions.update');
});