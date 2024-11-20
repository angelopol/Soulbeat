<?php

namespace App\Http\Controllers;

use App\Models\QA;
use Illuminate\Http\Request;

class QAController extends Controller
{
    public function __construct() 
    {  
        $this->middleware(['auth', 'company']);
    }
    
    public function viewQA(){
        $QA = QA::where('status',1)->get();

        return view('',['QA'=>$QA]);
    }

    public function storeQA(Request $request){
        $validated = $request->validate([
            'question'=>['required','string'],
            'answer'  =>['required','string'],
        ]);

        QA::create($validated);

        return to_route('');
    }

    public function updateQA(Request $request,QA $qa){
        $validated = $request->validate([
            'question'=>['required','string'],
            'answer'  =>['required','string'],
        ]);

        $qa->update($validated);

        return to_route('');
    }

    public function destroyQA(QA $qa){
        $qa->update(['status'=>0]);

        return to_route('');
    }
}
