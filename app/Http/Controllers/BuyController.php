<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class BuyController extends Controller
{
    public function index()
    {
        return view('buy.index');
    }

    public function buyWithAccount(Request $request)
    {
        Auth::user()->newSubscription('main', 'plan_Eat7iKwyY4Ypjd')->create($request->input('token'), [
            'email' => Auth::user()->email
        ]);

        return redirect()->back()->with('notice', 'You have now been subscribed.');
    }
}
