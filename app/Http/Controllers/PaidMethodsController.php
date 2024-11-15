<?php

namespace App\Http\Controllers;

use App\Models\PaidMethod;
use Illuminate\Http\Request;

class PaidMethodsController extends Controller
{
    public function __construct() 
    {  
        $this->middleware(['auth', 'company']);
    }
    
    public function viewPaidMethods(){
        $paidMethods = PaidMethod::where('status', 1)->get();

        return view('',['paidMethods'=>$paidMethods]);
    }  
    
    public function storePaidMethods(Request $request){
        $validated = $request->validate([
            'name'=>['required','string'],
            'description'=>['string','nullable'],
        ]);

        PaidMethod::create($validated);
        
        return to_route('');
    }

    public function updatePaidMethods(Request $request,PaidMethod $paid_method){
        $validated = $request->validate([
            'name'=>['nullable','string'],
            'description'=>['string','nullable'],
        ]);

        if(isset($validated['name'])){
            $paid_method->name = $validated['name'];
        }
        if(isset($validated['feature'])){
            $paid_method->description = $validated['description'];
        }
        $paid_method->save();
        
        return back();
    }

    public function destroyPaidMethods(PaidMethod $paid_method){
        $paid_method->update(['status'=>0]);
        
        return back();
    }
    
}
