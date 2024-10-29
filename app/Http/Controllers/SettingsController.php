<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SettingsController extends Controller
{
    public function viewSettings(){
        return view('');
    }

    public function viewGlobalParameters(){
        return view('');
    }

    public function viewSupport(){
        return view('');
    }

    public function viewGuides(){
        return view('');
    }

    public function viewQA(){
        return view('');
    }

    public function viewAds(){
        return view('');
    }

    public function viewSubscription(){
        $user = Auth::user();
        return view('',['user'=>$user]);
    }

    public function storeSubscription(Request $request){
        $id = Auth::id();
        $user = User::findOrFail($id);
        $user->update(['subscribed' => 1]); 

        return to_route('');
    }

    public function destroySubscription(){
        $id = Auth::id();
        $user = User::findOrFail($id);
        $user->update(['subscribed' => 0]); 

        return to_route('');
    }

    public function enableUser(){
        $id = Auth::id();
        $user = User::findOrFail($id);
        $user->update(['status' => 2]); 

        return to_route('');
    }

    public function disableUser(){
        $id = Auth::id();
        $user = User::findOrFail($id);
        $user->update(['status' => 1]); 

        return to_route('');
    }

    public function destroyUser(){
        $id = Auth::id();
        $user = User::findOrFail($id);
        $user->update(['status' => 0]); 

        return to_route('');
    }
}
