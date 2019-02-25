<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restock;

class RestockController extends Controller
{
    public function enterWithPassword(Request $request)
    {

        $restock = Restock::where('password', $request->input('password'))->first();

        if($restock == null)
        {
            return redirect()->back()->with(['notice' => 'That password does not exist or isn\'t correct.']);
        }

        session(['hasRestockPassword' => true]);

        //dd($restock);
        return redirect()->route('buy');
    }
}
