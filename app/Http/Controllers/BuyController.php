<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Mail;
use App\Mail\SubscriptionCreated;
use App\User;
use Hash;

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

        Mail::to(Auth::user())->send(new SubscriptionCreated(Auth::user()));

        return redirect()->back()->with('notice', 'You have now been subscribed.');
    }

    public function buyWithoutAccount(Request $request)
    {

        $user = User::create([
            'name' => 'nonameset',
            'email' => $request->input('email'),
            'password' => Hash::make(str_random(30)),
            'role' => 'user',
            'api_token' => str_random(48)
        ]);

        $user->newSubscription('main', 'plan_Eat7iKwyY4Ypjd')->create($request->input('token'), [
            'email' => $user->email
        ]);
        
        Mail::to($user)->send(new SubscriptionCreated($user));

        Auth::login($user, true);

        return redirect()->back()->with('notice', 'You have now been subscribed.');
    }
}
