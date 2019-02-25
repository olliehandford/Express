<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\User as UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{



    public function show()
    {
        $user = User::findOrFail(Auth::id());
        return new UserResource($user);        
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
        //
    }
}
