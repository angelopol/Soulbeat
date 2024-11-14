<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class PlaylistsController extends Controller
{
    public function viewPlaylists(User $user){
        $playlists = Playlist::where('user', $user->id)->where('status', '=', 1)->get();

        return view('profile.playlists.showallplaylist', ['playlists' => $playlists, 'user' => $user]);
    }

    public function showPlaylist(User $user, Playlist $playlist){
        return view('profile.playlists.playlist',['user' => $user, 'playlist' => $playlist]);
    }

    public function storePlaylist(Request $request,User $user){
        $validated = $request->validate([
            'name' => ['string','required','max:255'],
            'description' => ['string','nullable'],
            'photo' => ['nullable']
        ]);

        $data = array_merge(['user'=>$user->id],$validated);

        $playlist = Playlist::create($data);

        if(isset($validated['photo'])){
            $playlist->photo = $validated['photo']->storeAs('public/PlaylistPhotos', $playlist->id.'.'.$validated['photo']->getClientOriginalExtension());
            $playlist->save();
        }

        return to_route('playlist.view',['user'=>$user]);
    }

    public function updatePosts(Playlist $playlist, Post $post){
        
        $posts = "";
        if(str_contains($playlist->posts, '~'.$post->id.'~') != false){
            $posts = str_replace($post->id.'~', '', $playlist->posts);
        } else {
            if($playlist->posts == null OR $playlist->posts == "") $posts = '~';
            $posts .= $playlist->posts.$post->id.'~';
        }
        $playlist->posts = $posts;
        $playlist->save();

        return true;
    }

    public  function updatePlaylist(Request $request,User $user,Playlist $playlist){
        $validated = $request->validate([
            'name' => ['string','required','max:255'],
            'description' => ['string','nullable'],
            'photo' => ['string','nullable']
        ]);

        $playlist->update($validated);

        return to_route('playlist.show',['user'=>$user->id,'playlist'=>$playlist->id]);
    }

    public function destroyPlaylist(User $user,Playlist $playlist){
        $playlist->update(['status' => 0]);

        return to_route('playlist.view',['user'=>$user->id]);
    }
}
