<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\User as UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Validation\Rule;
use DB;
use Carbon\Carbon;

class UserAPIController extends Controller
{
    public function show()
    {
        $user = User::join('activation_keys', 'users.id', '=', 'activation_keys.user_id')
                ->where('users.id', 1)
                ->first();

        $user->expires_on = Carbon::parse($user->expires_on)->format('dS M, Y');
        $user->expired    = Carbon::parse($user->expires_on)->isPast();


        return response()->json($user);
    }


    public function update(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore(Auth::id())
            ],
            'name' => 'required|min:5|max:255',
            'password' => 'required|min:5'
        ])->validate();

        if (!$validator) {
            return response()->json($validator, 422);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json(createError('Incorrect password, please try again.'), 422);
        }


        if (Auth::user()->email != $request->input('email')) {
            $user->email = $request->input('email');
        }

        $user->name = $request->input('name');
        
        if ($user->save()) {
            return new UserResource($user);
        }
    }



    public function destroy($id)
    {
        // let user delete account and all assosiated information
    }
}
