<?php

namespace App\Http\Controllers;

use App\Models\Guide;
use Illuminate\Http\Request;


class GuidesController extends Controller
{
    public function __construct() 
    {  
        $this->middleware(['auth', 'company']);
    }
    
    public function viewGuides(){
        $guides = Guide::where('status',1)->get();

        return view('',['guides'=>$guides]);
    }

    public function storeGuides(Request $request){
        $validated = $request->validate([
            'name'=>['required','string'],
            'summary'=>['string','nullable'],
            'file'=>['string','nullable'],
        ]);

        Guide::create($validated);

        return to_route('');
    }

    public function updateGuides(Request $request,Guide $guide){
        $validated = $request->validate([
            'name'=>['required','string'],
            'summary'=>['string','nullable'],
            'file'=>['string','nullable'],
        ]);

        $guide->update($validated);

        return to_route('');
    }

    public function destroyGuides(Guide $guide){
        $guide->update(['status'=>0]);

        return to_route('');
    }
}
