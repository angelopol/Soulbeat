<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function storePost(Request $request){
        $request->validate([
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
    }

    public function updatePost(){
        
    }

    public function archivePost(){
        
    }

    public function destroyPost(){
        
    }
}
