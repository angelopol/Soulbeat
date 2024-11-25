<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Guide;
use App\Models\Parameter;
use App\Models\QA;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function __construct() 
    {  
        $this->middleware(['auth']);
    }
    
    public function viewSettings(){
        $ads = Ad::join('posts', 'ads.post', '=', 'posts.id')->where('post.user', auth()->user()->id)->where('ads.status', 1)->select(['ads.*', 'posts.*'])->get();

        return view('settings.user.settings', ['ads'=>$ads]);
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

    public function storeSubscription(){
        Auth::user()->subscribed = 1;
        Auth::user()->save(); 

        return True;
    }

    public function destroySubscription(){
        Auth::user()->subscribed = 0;
        Auth::user()->save(); 

        return False;
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
        Auth::user()->status = 0;
        Auth::user()->save();
        Auth::guard('web')->logout();

        return true;
    }

    public function CheckPassword(Request $request){
        $request->validate([
            'password' => ['required', 'string'],
        ]);

        if (Hash::check($request->password, Auth::user()->password)){
            return response(status: 200);
        } else {
            return response(status: 401);
        }
    }

    public function UpdateUser(Request $request){
        $request->validate([
            'username' => ['nullable', 'string', 'max:255', Rule::unique('users')->where(fn (Builder $query) => $query->where('status', '!=', 0))],
            'email' => ['nullable', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users')->where(fn (Builder $query) => $query->where('status', '!=', 0))],
            'password' => ['nullable', 'confirmed', Password::defaults()],
        ]);

        if($request->username){
            Auth::user()->username = $request->username;
        }
        if($request->email){
            Auth::user()->email = $request->email;
        }
        if($request->password){
            Auth::user()->password = Hash::make($request->password);
        }

        Auth::user()->save();
        Auth::guard('web')->logout();

        return redirect()->route('login');
    }
}
