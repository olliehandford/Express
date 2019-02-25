@extends('layouts.app')


@section('content')

    <div class="wrapper">
        <account></account>

    @if(Auth::user()->subscribed('main'))
        <p>You are subscribed for Express Notify.</p>

        @if(Auth::user()->subscription('main')->cancelled())
            <p>Your subscription will end on <b>{{ Auth::user()->subscription('main')->ends_at->format('D d M Y') }}</b></p>
            <p>Want to keep access to Express Notify? Click <a href="{{ route('buy-resume') }}?_token={{ csrf_token() }}">here</a> to resume your subscription!</p>
        @else
            <p>Want to cancel? Click <a href="{{ route('buy-cancel') }}?_token={{ csrf_token() }}">here</a>!</p>
        @endif
    @else
        <p>You are not currently subscribed to Express Notify.</p>
    @endif

    </div>
    
    <script src="{{ asset('js/app.js') }}"></script>

@endsection
