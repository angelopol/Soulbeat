<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Guide;
use App\Models\Parameter;
use App\Models\QA;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SettingsController extends Controller
{
    public function viewSettings(){
        return view('');
    }

    public function viewGlobalParameters(){
        $paremeters = Parameter::all();

        return view('',['parameters'=>$paremeters]);
    }

    public function viewSupport(){
        return view('');
    }

    public function viewGuides(){
        $guides = Guide::where('status',1)->get();
        return view('',['guides'=>$guides]);
    }

    public function viewQA(){
        $qa = QA::where('status',1)->get();
        return view('',['qa'=>$qa]);
    }

    public function viewAds(){
        $ads = Ad::where('status',1)->get();
        return view('',['ads'=>$ads]);
    }

    public function viewSubscription(){
        $user = Auth::user();
        return view('',['user'=>$user]);
    }

    public function storeSubscription(Request $request){
        $id = Auth::id();
        $user = User::findOrFail($id);
        $user->update(['subscribed' => 1]); 

        return to_route('subscription.view');
    }

    public function destroySubscription(){
        $id = Auth::id();
        $user = User::findOrFail($id);
        $user->update(['subscribed' => 0]); 

        return to_route('subscription.view');
    }

    public function enableUser(){
        $id = Auth::id();
        $user = User::findOrFail($id);
        $user->update(['status' => 2]); 

        return to_route('login');
    }

    public function disableUser(){
        $id = Auth::id();
        $user = User::findOrFail($id);
        $user->update(['status' => 1]); 

        return to_route('login');
    }

    public function destroyUser(){
        $id = Auth::id();
        $user = User::findOrFail($id);
        $user->update(['status' => 0]); 

        return to_route('login');
    }
}
