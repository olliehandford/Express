@extends('layouts.app')


@section('content')

    <div class="wrapper">
        <account></account>

    @if(Auth::user()->subscribed('ExpressKey'))
        <p>You already have a key for Express Notify.</p>
    @else
        <p>You do not already have a key, lets begin.</p>
    @endif

    </div>
    
    <script src="{{ asset('js/app.js') }}"></script>

@endsection
