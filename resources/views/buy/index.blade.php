@extends('layouts.app')


@section('content')
<h1>Buy a key</h1>

@if(!Auth::check())

<p>If you already have an account with us, please login first. You can login <a href="{{ route('login') }}">here</a>.</p>
<p>And if you don't, there's no worry. We can get you setup quickly.</p>

    <form action="{{ route('buy-withoutaccount') }}" method="post" id="buykey">
        @csrf

        <label for="email">Email address</label>
        <input type="email" name="email" id="email">

        <label>
            Choose plan:
            <select name="plan" id="plan">
                <option value="ExpressKey">Express Key ($10/month)</option>
            </select>
        </label>

        @include('partials.card')

        <button>Make payment</button>
    </form>

@else

@if(Auth::user()->subscribed('main'))
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

@endif



@endsection

