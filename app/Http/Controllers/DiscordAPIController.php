<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Discord as Discord;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Validator;


class DiscordAPIController extends Controller
{

    public function index() {
        return Discord::me()->first();
    }

    public function unlink(Request $request) {

        $data = Discord::me();

        if (!$data->exists()) {
            // User doesn't have linked account
            return response()->json(['error' => 'You do not have an account to unlink'], 422);
            // return redirect('discord')->withErrors(['Please link an account before trying to unlink an account.']);
        }

        $data = Discord::me()->where('created_at', '>', Carbon::now()->subDay());
        if (!$data->exists()) {
            // Account is more than 24 hours old do not let them unlink.

            return response()->json(createError('Your discord account cannot be unliked as it was added more than 24 hours ago.'), 422);
        }

        Discord::me()->delete();
        return response()->json(['success' => 'You have successfully unlinked your discord account. Please note this can only be done during the first 24 hours. The account inside the discord after this will remain.'], 200);
    }



}
