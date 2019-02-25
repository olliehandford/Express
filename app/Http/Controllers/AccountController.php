<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AccountController extends Controller
{
    //

    public function index() {
        return view('pages.account');
    }

    public function cancelSubscription()
    {
        Auth::user()->subscription('main')->cancel();

        return redirect()->route('account')->with(['notice', 'You have cancelled your subscription.']);
    }

    public function resumeSubscription()
    {
        Auth::user()->subscription('main')->resume();

        return redirect()->route('account')->with(['notice', 'You have resumed your subscription. Yay!']);
    }
    
}
