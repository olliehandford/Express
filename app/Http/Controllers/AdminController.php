<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Keys;

class AdminController extends Controller
{
    //

    public function index() {
        return view('pages.admin.home');
    }

    public function search() {
        return view('pages.admin.search');
    }

    public function keys($key) {

        $user = Keys::select('*', 'discords.id AS discord_id', 'users.id AS users_user_id', 'subscriptions.id AS subscriptions_id')
                    ->leftJoin('users', 'users.id', '=', 'activation_keys.user_id')
                    ->leftJoin('discords', 'discords.user_id', '=', 'activation_keys.user_id')
                    ->leftJoin('subscriptions', 'subscriptions.user_id', '=', 'activation_keys.user_id')
                    ->leftJoin('payments', 'payments.subscription_id', '=', 'subscriptions.id')
                    ->where('activation_key', $key);

        // return $user->get();

        if ($user->exists()) {
            return view('pages.admin.keys')->with('key', $user->first());
        }

        return view('pages.admin.keys')->with('key', ['activation_key' => $key]);

    }
}
