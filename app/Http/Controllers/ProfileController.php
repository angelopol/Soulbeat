<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Post;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

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

    #Metodos del word
    public function viewPost(int $user){
        $posts = Post::where('user',$user)->get();
        
        return view('',['posts'=>$posts]);
    }

    public function viewReviews(int $user){
        $reviews = Review::where('to',$user)->get();

        return view('',['reviews'=>$reviews]);
    }

    public function viewFollowers(int $user){
        $followers = User::where('followeds', 'LIKE', "%,$user,%")
                         ->orWhere('followeds', 'LIKE', "$user,%")
                         ->orWhere('followeds', 'LIKE', "%,$user")
                         ->orWhere('followeds', '=', "$user")
                         ->get();

        return view('', ['followers' => $followers]);
    }

    public function updateFolloweds(string $user){
        $userLogged = Auth::user();

        $followedsArray = explode(',', $userLogged->followeds);
        
        if (!in_array($user, $followedsArray)) {
            $followedsArray[] = $user;
        }

        $userLogged->followeds = implode(',', $followedsArray);
        $userLogged->save();

        return to_route('');
    }

    public function viewFolloweds(User $user){
        $followedsArray = explode(',', $user->followeds);

        $followeds = User::whereIn('id', $followedsArray)->get();

        return view('', ['followeds' => $followeds]);
    }

    public function updateBiography(Request $request,User $user){
        $user-> biography = $request->input('biography');

        $user->save();

        return to_route('');
    }

    public function updatePhoto(Request $request,User $user){
        $user-> photo = $request->input('photo');

        $user->save();

        return to_route('');
    }
}
