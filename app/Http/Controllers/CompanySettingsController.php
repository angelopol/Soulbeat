<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\License;
use App\Models\PaidMethod;
use App\Models\User;
use App\Models\Guide;
use App\Models\QA;

class CompanySettingsController extends Controller
{
    public function __construct() 
    {  
        $this->middleware(['auth', 'company']);
    }
    
    public function viewSettings(){
        $licenses = License::where('status',1)->where('post', null)->get();
        $PaidMethods = PaidMethod::where('status',1)->get();
        $users = User::where('status', '!=', 0)->where('type', 1)->where('id', '!=', auth()->user()->id)->get();
        $guides = Guide::where('status',1)->get();
        $qas = QA::where('status',1)->get();

        return view('settings.company.settingsavanced', ['licenses'=>$licenses, 'PaidMethods'=>$PaidMethods, 'users'=>$users, 'guides'=>$guides, 'qas'=>$qas]);
    }

    public function viewPayment(){
        return view('');
    }

    public function viewParameters(){
        return view('');
    }

    public function updateParameters(){
        return to_route('');
    }
}
