@extends('layouts.app')


@section('content')
<h1>Buy a key</h1>
<p>You don't even need to register, just give us a few details.</p>

@if(Auth::user()->subscribed('ExpressKey'))
    <p>You already have a key for Express Notify.</p>
@else
    <p>You do not already have a key, lets begin.</p>
    
    <form action="{{ route('buy-withaccount') }}" method="post" id="buykey">
        @csrf

        <label>
            Choose plan:
            <select name="plan" id="plan">
                <option value="ExpressKey">Express Key ($10/month)</option>
            </select>
        </label>

        @include('partials.card')

        <button>Make payment</button>
    </form>

@endif

@endsection

