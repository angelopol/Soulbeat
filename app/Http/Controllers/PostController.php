<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\DB;
use App\Models\Ad;

use function Laravel\Prompts\error;

class PostController extends Controller
{
    public function storePost(Request $request){
        $validated = $request->validate([
            'title' => ['string','required','max:255'],
            'body' => ['string','nullable'],
            'song' => ['required', File::types(['mp3', 'wav', 'ogg'])],
            'photo' => ['nullable', File::types(['jpg', 'png', 'jpeg'])],
            'bpm' => ['numeric','nullable'],
            'scale' => ['string','nullable'],
            'paid-methods' => ['nullable'],
            'cost' => ['string'],
            'licenses' => ['string','required'],
            'tags' => ['string','nullable'],
        ]);

        $paid_methods = "~";
        foreach($validated['paid-methods'] as $paid_method) $paid_methods .= $paid_method . "~";
        $tags = "~";
        foreach(explode(' ', $validated['tags']) as $tag) $tags .= $tag . "~";

        $post = Post::create([
            'user' => auth()->user()->id,
            'title' => $validated['title'],
            'body' => $validated['body'],
            'bpm' => $validated['bpm'],
            'scale' => $validated['scale'],
            'PaidMethods' => $paid_methods,
            'cost' => $validated['cost'],
            'licenses' => $validated['licenses'],
            'tags' => $tags
        ]);
        if(isset($validated['photo'])){
            $post->photo = $validated['photo']->storeAs('public/photos', $post->id.'.'.$validated['photo']->getClientOriginalExtension());
        }
        $post->song = $validated['song']->storeAs('public/songs', $post->id.'.'.$validated['song']->getClientOriginalExtension());
        $post->save();

        return back();
    }

    public function DownloadSong(Post $post){
        if($post->cost != 0 OR $post->status != 1) return error(404);
        return Storage::download($post->song, $post->title.'.'.pathinfo($post->song, PATHINFO_EXTENSION));
    }

    public function updatePost(Request $request,Post $post){
        $validated = $request->validate([
            'title' => ['string','required','max:255'],
            'body' => ['string','nullable'],
            'song' => ['string','required'],
            'photo' => ['string','nullable'],
            'bpm' => ['numeric','nullable'],
            'scale' => ['string','nullable'],
            'paid-methods' => ['string','nullable'],
            'cost' => ['string'],
            'licenses' => ['string','required'],
            'tags' => ['string','nullable'],
        ]);
        
        $post->update($validated);

        return to_route('');
    }

    public function archivePost(Post $post){
        if ($post->user != auth()->user()->id) return error(404);

        $post->status = 2;

        $post->save();

        return back();
    }

    public function destroyPost(Post $post){
        if ($post->user != auth()->user()->id) return error(404);

        $post -> status = 0;

        $post->save();

        return back();
    }

    public function AnnouncePost(Request $request, Post $post){
        $validated = $request->validate([
            'EndTime' => ['required']
        ]);

        $ad = Ad::where('post', $post->id)->where('status', 1)->first();
        if(isset($ad)){
            return back();
        }

        Ad::create([
            'post' => $post->id,
            'EndTime' => $validated['EndTime']
        ]);

        return back();
    }

    public function updateReaction(Request $request, Post $post,int $reaction){
        #validar los 5 inputs de las reacciones, el que no sea null es el que va sumar
        if($reaction == 1){
            $post -> reaction1 +=1;
        }elseif ($reaction == 2) {
            $post -> reaction2 +=1;
        }elseif ($reaction == 3) {
            $post -> reaction3 +=1;
        }elseif ($reaction == 4) {
            $post -> reaction4 +=1;
        }else{
            $post -> reaction5 +=1;
        }
        $post->save();

        return True;
    }

    public static function GetPosts($limit = 5, $ids = null){
        $posts = Post::where('posts.status', 1)->whereDoesntHave('ads')
            ->join('users', 'posts.user', '=', 'users.id')->select('posts.*', 'users.photo as UserPhoto', 'users.UserName',
                'users.name as PersonName', 'users.FullName as PersonFullName', 'users.subscribed', 
                DB::raw('IF(posts.user = '.auth()->user()->id.', "True", "False") as ThisUser'))
            ->orderBy(DB::raw('reaction1 + reaction2 + reaction3 + reaction4 + reaction5'), 'desc')
            ->limit($limit);
        
        $ad = Post::join('ads', 'posts.id', '=', 'ads.post')->join('users', 'posts.user', '=', 'users.id')
            ->select('posts.*', 'users.photo as UserPhoto', 'users.UserName', 'users.name as PersonName', 'users.FullName as PersonFullName', 'users.subscribed', 
                DB::raw('IF(posts.user = '.auth()->user()->id.', "True", "False") as ThisUser'));

        if($ids != null) {
            $posts = $posts->whereNotIn('posts.id', $ids);
            $ad = $ad->whereNotIn('post', $ids);
        }
        $posts = $posts->get();
        $ad = $ad->first();

        if ($ad) $posts->prepend($ad);
        return $posts;
    }

    public function IndexPosts(Request $request){
        if($request->has('ids')) return self::GetPosts(5, explode(',', $request->ids));
        return self::GetPosts(5);
    }

    public function ShowPost(Post $post){
        return [Storage::url($post->song), Storage::url($post->photo)];
    }
}
