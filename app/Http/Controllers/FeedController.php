<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class FeedController extends Controller
{
    public function __construct() 
    {  
        $this->middleware(['auth']);
    }
    
    public function view(){
        $company = Post::join('users', 'posts.user', '=', 'users.id')
            ->where('users.type', 1)->where('posts.status', 1)
            ->select('posts.*')->orderBy('posts.created_at', 'desc')->get();

        $posts = PostController::GetPosts();

        $users = User::where('status', 1)->where('id', '!=', auth()->user()->id)
            ->select('users.*', DB::raw("(SELECT COUNT(*) FROM users AS followers WHERE followers.followed LIKE CONCAT('%~', users.id, '~%')) as followers_count"))
            ->orderBy('followers_count', 'desc')->limit(5)->get();
        foreach($users as $user){
            if(str_contains($user->followed, '~'.auth()->user()->id.'~')){
                $users = $users->reject(function ($u) use ($user) {
                    return $u->id === $user->id;
                });
            }
        }

        return view('feed.feed', ['company' => $company, 'posts' => $posts, 'users' => $users]);
    }
}
