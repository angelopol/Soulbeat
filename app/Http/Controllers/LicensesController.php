<?php

namespace App\Http\Controllers;

use App\Models\License;
use Illuminate\Http\Request;

class LicensesController extends Controller
{
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
            'name'=>['required','string'],
            'feature'=>['required','string'],
        ]);

        $license->update($validated);

        return to_route('');
    }

    public function destroyLicenses(License $license){
        $license->update(['status'=>0]);

        return to_route('');
    }
}
