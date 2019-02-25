@extends('layouts.app')


@section('content')

    <div class="wrapper">

        <h1>Admin panel</h1>


        @if ($errors->any())
            <span class="error">{{ $errors->first() }}</span>
        @endif

        @if (session('success'))
            <span class="success">{{ session('success') }}</span>
        @endif


        @if (!empty($discord->id))
        <div class="item">
            <img src="{{ $discord->avatar }}" alt="Profile picture">
            <h2>{{ $discord->username }}</h2>
            <span>{{ $discord->id }}</span>
        </div>

        <div class="buttons">
            <button class="btn">Unlink Discord</button>
        </div>
        @else

        <span>Welcome to the Express Notify administrator panel. Everything you do is logged and recorded. You can view your log of recent changes here</span>

        <div class="buttons">
            <a href="admin/log" class="btn">My Admin Log</a>
        </div>
        @endif
    

        
    </div>
    

@endsection
