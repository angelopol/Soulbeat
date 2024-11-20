<?php

namespace App\Http\Controllers;

use App\Models\License;
use Illuminate\Http\Request;

class LicensesController extends Controller
{
    public function __construct() 
    {  
        $this->middleware(['auth', 'company']);
    }
    
    public function viewLicenses(){
        return view('');
    }

    public function storeLicenses(Request $request){
        $validated = $request->validate([
            'name'=>['required','string'],
            'feature'=>['required','string'],
        ]);

        License::create($validated);

        return to_route('');
    }

    public function updateLicenses(Request $request,License $license){
        $validated = $request->validate([
            'name'=>['nullable','string'],
            'feature'=>['nullable','string'],
        ]);

        if(isset($validated['name'])){
            $license->name = $validated['name'];
        }
        if(isset($validated['feature'])){
            $license->feature = $validated['feature'];
        }
        $license->save();

        return back();
    }

    public function updatePost(License $license,int $post){
        $license->update(['post'=>$post]);

        return to_route('');
    }

    public function destroyLicenses(License $license){
        $license->update(['status'=>0]);

        return back();
    }
}
