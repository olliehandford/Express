<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SearchAPIController extends Controller
{

    /**
     * Will be able to search through
     * - Activation keys
     * - Names and email addresses (users)
     * - Subscription ids, paypal emails
     * - Discord ids
     */

    public function search($search) {
        // store all results
        $results = [];
        // activation keys
        $results['activation_keys'] =
                DB::table("activation_keys")
                ->select("activation_key", "key_type", "created_at")
                ->where('activation_key', 'like', "%{$search}%")
                ->limit(10)
                ->get();

        // discords
        $results['discord'] =
                DB::table('discords')
                ->select('username', 'id', 'created_at')
                ->where('id', '=', $search)
                ->orWhere('username', 'like', "%{$search}%")
                ->limit(10)
                ->get();

        // users
        $results['users'] =
                DB::table('users')
                ->select('name', 'email', 'created_at')
                ->where('email', 'like', "%{$search}%")
                ->orWhere('name', 'like', "%{$search}%")
                ->limit(10)
                ->get();

        // subscriptions
        $results['subscriptions'] =
                DB::table('subscriptions', 'payments.payer_email', 'subscriptions.status')
                ->select('payer_name', 'payer_email', 'status')
                ->join('payments', 'payments.subscription_id', '=', 'subscriptions.id')
                ->where('payer_name', 'like', "%{$search}%")
                ->orWhere('payer_email', 'like', "%{$search}%")
                ->groupBy('subscription_id')
                ->limit(10)
                ->get();

        // payments
        $results['payments'] =
                DB::table('payments')
                ->select('payer_name', 'payer_email', 'amount')
                ->where('payer_name', 'like', "%{$search}%")
                ->orWhere('payer_email', 'like', "%{$search}%")
                ->limit(10)
                ->get();

        

        
        return $results;
    }

}
