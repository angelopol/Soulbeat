<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function viewPost(){
        $posts = Post::get();

        return view('',['posts'=>$posts]);
    }

    public function viewUsers(){
        $users = User::get();

        return view('',['users'=>$users]);
    }
}
