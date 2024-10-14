<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\User;
use Illuminate\Http\Request;

class PlaylistsController extends Controller
{
    public function viewPlaylists(int $user){
        $playlists = Playlist::where('user',$user)->get();

        return view('profile.playlists.playlist',['playlists' => $playlists]);
    }

    public function showPlaylist(Playlist $playlist){
        return view('profile.playlists.playlist',['playlist' => $playlist]);
    }

    public function storePlaylist(Request $request){
        $validated = $request->validate([
            'name' => ['string','required','max:255'],
            'description' => ['string','nullable'],
            'photo' => ['string','nullable'],
            'posts' => ['string']
        ]);

        Playlist::create($validated);

        return to_route('');
    }

    public  function updatePlaylist(Request $request,Playlist $playlist){
        $validated = $request->validate([
            'name' => ['string','required','max:255'],
            'description' => ['string','nullable'],
            'photo' => ['string','nullable'],
            'posts' => ['string']
        ]);

        $playlist->update($validated);

        return to_route('');
    }

    public function destroyPlaylist(Playlist $playlist){
        $playlist->update(['status' => 0]);

        return to_route('');
    }
}
