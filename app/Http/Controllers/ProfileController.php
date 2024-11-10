<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Playlist;
use App\Models\Post;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function GetPosts(User $user, $ids = null){
        $posts = Post::where('posts.status', 1)->where('posts.user', $user->id)
            ->join('users', 'posts.user', '=', 'users.id')->select('posts.*', 'users.photo as UserPhoto', 'users.UserName',
                'users.name as PersonName', 'users.FullName as PersonFullName', 'users.subscribed', 
                DB::raw('IF(posts.user = '.auth()->user()->id.', "True", "False") as ThisUser'))
            ->orderBy('created_at', 'desc')->limit(5);

        if($ids != null) {
            $posts = $posts->whereNotIn('posts.id', $ids);
        }
        $posts = $posts->get();
        
        return $posts;
    }

    #Metodos del word
    public function viewPosts(User $user){
        $posts = self::GetPosts($user);

        $followers = DB::table('users')->where('followed', 'LIKE', '%~'.$user->id.'~%')->get();

        $followed = [];
        foreach (explode('~', $user->followed) as $follow) {
            if ($follow != '' AND $follow != '~') {
                $user = User::where('id', preg_replace('/\D/', '', $follow))->where('status', 1)->first();
                if ($user != null) $followed[] = $user;
            }
        }

        $reviews = Review::join('users', 'reviews.to', '=', 'users.id')->where('reviews.to', $user->id)->where('reviews.status', '=', 1)
            ->select('reviews.*', 'users.name as PersonName', 'users.FullName as PersonFullName')->get();

        $playlists = Playlist::where('user', $user->id)->where('status', 1)->get();
        
        return view('profile.profile', ['posts'=>$posts, 'user'=>$user, 'followers'=>$followers, 'followed'=>$followed, 'reviews'=>$reviews, 'playlists'=>$playlists]);
    }

    public function viewReviews(User $user){
        $reviews = Review::where('to',$user)->get();

        return view('profile.reviews.showreviews',['reviews'=>$reviews]);
    }

    public function viewFollowers(int $user){
        $followers = User::where('followeds', 'LIKE', "%,$user,%")
                         ->orWhere('followeds', 'LIKE', "$user,%")
                         ->orWhere('followeds', 'LIKE', "%,$user")
                         ->orWhere('followeds', '=', "$user")
                         ->get();

        return view('', ['followers' => $followers]);
    }

    public function updateFolloweds($user){
        $userLogged = Auth::user();

        $followedsArray = explode(',', $userLogged->followeds);
        
        if (!in_array($user, $followedsArray)) {
            $followedsArray[] = $user;
        }else{
            $followedsArray = array_diff($followedsArray, [$user]);
        }

        $userLogged->followeds = implode(',', $followedsArray);
        $userLogged->save();

        return to_route('post.view',$user);
    }

    public function viewFolloweds(User $user){
        $followedsArray = explode(',', $user->followeds);

        $followeds = User::whereIn('id', $followedsArray)->get();

        return view('', ['followeds' => $followeds]);
    }

    public function updateBiography(Request $request,User $user){
        $user-> biography = $request->input('biography');

        $user->save();

        return to_route('post.view',$user);
    }

    public function updatePhoto(Request $request,User $user){
        $user-> photo = $request->input('photo');

        $user->save();

        return to_route('post.view',$user);
    }
}
