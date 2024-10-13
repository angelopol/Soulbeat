<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('');
    }

    public function storeSubscription(Request $request){
        $validated = $request->validate([

        ]);
        Auth::user();
    }

    public function destroySubscription(){

    }

    public function enableUser(){

    }

    public function disableUser(){

    }

    public function destroyUser(){

    }
}
