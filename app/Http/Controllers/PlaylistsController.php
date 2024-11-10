<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\User;
use Illuminate\Http\Request;

class PlaylistsController extends Controller
{
    public function viewPlaylists(int $user){
        $playlists = Playlist::where('user', $user)->get();

        return view('profile.playlists.showallplaylist',['playlists' => $playlists]);
    }

    public function showPlaylist(/*Playlist $playlist*/){
        return view('profile.playlists.playlist'/*,['playlist' => $playlist]*/);
    }

    public function storePlaylist(Request $request,User $user){
        $id = $user-> id;
        $validated = $request->validate([
            'name' => ['string','required','max:255'],
            'description' => ['string','nullable'],
            'photo' => ['string','nullable'],
            'posts' => ['string']
        ]);

        $data = array_merge(['user'=>$id],$validated);

        Playlist::create($data);

        return to_route('playlist.view',['user'=>$user->id]);
    }

    public  function updatePlaylist(Request $request,User $user,Playlist $playlist){
        $validated = $request->validate([
            'name' => ['string','required','max:255'],
            'description' => ['string','nullable'],
            'photo' => ['string','nullable'],
            'posts' => ['string']
        ]);

        $playlist->update($validated);

        return to_route('playlist.show',['user'=>$user->id,'playlist'=>$playlist->id]);
    }

    public function destroyPlaylist(User $user,Playlist $playlist){
        $playlist->update(['status' => 0]);

        return to_route('playlist.view',['user'=>$user->id]);
    }
}
