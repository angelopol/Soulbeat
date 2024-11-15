<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;

class CompanyUsersController extends Controller
{
    public function __construct() 
    {  
        $this->middleware(['auth', 'company']);
    }
    
    public function viewUsers(){
        $users = User::where('status',1)->get();

        return view('',['users'=>$users]);
    }

    public function storeUsers(Request $request){
        $validated = $request->validate([
            'UserName' => ['required','string','unique:users,username'],
            'name'     => ['required','string'],
            'FullName' => ['required','string'],
            'biography'=> ['string','nullable'],
            'photo'    => ['string','nullable'],
            //'followed' => ['string','nullable'],
            'email'    => ['required','string','unique:users,email'],
            'password' => ['required', 'string', 'min:8'],      
        ]);

        $user = User::create($validated);

        $id = $user->id;

        Permission::create(['user'=>$id]);

        return to_route('');
    }

    public function updateUsers(Request $request,User $user){
        $validated = $request->validate([
            'UserName' => ['required','string','unique:users,username'],
            'name'     => ['required','string'],
            'FullName' => ['required','string'],
            'biography'=> ['string','nullable'],
            'photo'    => ['string','nullable'],
            //'followed' => ['string','nullable'],
            'email'    => ['required','string','unique:users,email'],
            'password' => ['required', 'string', 'min:8'],      
        ]);

        $user->update($validated);

        return to_route('');
    }

    public function enableUser(User $user){
        $user->update(['status'=>1]);

        return to_route('');
    }

    public function disableUser(User $user){
        $user->update(['status'=>2]);

        return to_route('');
    }

    public function destroyUser(User $user){
        $user->update(['status'=>0]);

        return back();
    }

    public function updatePermissions(Request $request,int $user){
        $permission = Permission::where('user',$user)->get();

        if(null !== $request->input('togglePost')){
            $permission->posts = 1;
        }else{
            $permission->posts = 0;
        }
        if(null !== $request->input('togglePlayList')){
            $permission->playlist = 1;
        }else{
            $permission->playlist = 0;
        }
        if(null !== $request->input('toggleChats')){
            $permission->chats = 1;
        }else{
            $permission->chats = 0;
        }
        if(null !== $request->input('togglePayment')){
            $permission->payment = 1;
        }else{
            $permission->payment = 0;
        }
        if(null !== $request->input('toggleUsers')){
            $permission->users = 1;
        }else{
            $permission->users = 0;
        }
        if(null !== $request->input('toggleLicenses')){
            $permission->licenses = 1;
        }else{
            $permission->licenses = 0;
        }
        if(null !== $request->input('togglePaidMethods')){
            $permission->PaidMethods = 1;
        }else{
            $permission->PaidMethods = 0;
        }
        if(null !== $request->input('toggleGuides')){
            $permission->guides = 1;
        }else{
            $permission->guides = 0;
        }
        if(null !== $request->input('toggleQA')){
            $permission->QA = 1;
        }else{
            $permission->QA = 0;
        }

        $permission->save();

        return to_route('');
    }
}
