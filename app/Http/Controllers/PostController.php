<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function storePost(Request $request){
        $validated = $request->validate([
            'title' => ['string','required','max:255'],
            'body' => ['string','nullable'],
            'song' => ['string','required'],
            'photo' => ['string','nullable'],
            'bpm' => ['numeric','nullable'],
            'scale' => ['string','nullable'],
            'paid-methods' => ['string','nullable'],
            #'cost' => ['string'],
            'licenses' => ['string','required'],
            'tags' => ['string','nullable'],
        ]);

        Post::create($validated);
        
        //$post = new Post();
        //$post ->title = $request->input('title');
        //$post ->body = $request->input('body');
        //$post ->song = $request->input('song');
        //$post ->photo = $request->input('photo');
        //$post ->bpm = $request->input('bpm');
        //$post ->scale = $request->input('scale');
        //$post ->PaidMethods = $request->input('paid-methods');
        //$post ->licenses = $request->input('licenses');
        //$post ->tags = $request->input('tags');

        //$post->save();

        #session()->flash('status','Post created!');

        return to_route('');
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
        $post -> status = 2;

        $post->save();

        return to_route('');
    }

    public function destroyPost(Post $post){
        $post -> status = 0;

        $post->save();

        return to_route('');
    }

    public function updateReaction(Request $request,Post $post){
        #validar los 5 inputs de las reacciones, el que no sea null es el que va sumar
        if(isset($request['reaction1'])){
            $post -> reaction1 +=1;
        }elseif (isset($request['reaction2'])) {
            $post -> reaction2 +=1;
        }elseif (isset($request['reaction3'])) {
            $post -> reaction3 +=1;
        }elseif (isset($request['reaction4'])) {
            $post -> reaction4 +=1;
        }else{
            $post -> reaction5 +=1;
        }
        $post->save();

        return to_route('');
    }
}
