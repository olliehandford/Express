<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Discord as Discord;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DiscordController extends Controller
{

    private $CLIENT_ID     = "546270202212646932";
    private $CLIENT_SECRET = "t9rXBnlIgDg4s1ZWuc3skk2u8lpgKkrh";
    private $REDIRECT_URI  = "http://localhost/express/public/discord/handler";
    private $SCOPES        = "identify email guilds.join guilds";

    public function index() {
        $discord = Discord::me()->first();
        return view('pages.discord')->with('discord', $discord);
    }

    public function join() {

        // Check user doesn't already have linked discord
        if (Discord::me()->exists()) {
            return redirect('discord')->withErrors(['You already have a linked discord account.']);
        }

        // Redirect to Discord OAuth
        return redirect('https://discordapp.com/api/oauth2/authorize?client_id=' . $this->CLIENT_ID . '&redirect_uri=' . $this->REDIRECT_URI .'&response_type=code&scope=' . $this->SCOPES);
    }
    

    public function handleJoin(Request $request) {
        // Handle response from Discord

        $data = $this->exchangeCode($request->code);

        // Grant already used or another error
        if (isset($data['error'])) {
            return Redirect('discord')->withErrors(['There was an error trying to connect your discord account']);
        }


        $user = $this->getUser($data['access_token']);

        if (Discord::where('id', $user['id'])->exists()) {
            return Redirect('discord')->withErrors(['This discord account has already been linked to another account']);
        }

        $discord = new Discord;
        $discord->id            = $user['id'];
        $discord->user_id       = Auth::user()->id;
        $discord->username      = $user['username'] . '#' . $user['discriminator'];
        $discord->avatar        = 'https://cdn.discordapp.com/avatars/' . $user['id'] . '/' . $user['avatar'] . '.jpg?size=128';
        $discord->refresh_token = $data['refresh_token'];
        $discord->access_token  = $data['access_token'];


        $discord->save();
        return redirect('discord')->withSuccess('Successfully added a discord account');
    }


    public function exchangeCode($code) {
        $headers = [
            'Content-type' => 'application/x-www-form-urlencoded'
        ];

        $data = [
            'client_id' => $this->CLIENT_ID,
            'client_secret' => $this->CLIENT_SECRET,
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => $this->REDIRECT_URI,
            'scope' => $this->SCOPES
        ];

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'https://discordapp.com/api/oauth2/token',
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_HTTPHEADER => $headers
        ));
        $res = curl_exec($curl);
        curl_close($curl);

        return json_decode($res, true);
    }


    public function getUser($token) {
        $headers = [
            'Authorization: Bearer ' . $token 
        ];

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'https://discordapp.com/api/users/@me',
            CURLOPT_HTTPHEADER => $headers
        ));
        $res = curl_exec($curl);
        curl_close($curl);

        return json_decode($res, true);
    }
}
