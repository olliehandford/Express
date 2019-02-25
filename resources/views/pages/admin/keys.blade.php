@extends('layouts.app')


@section('content')

    <div class="wrapper">

        
        <h1 id="key">{{ $key->activation_key }}</h1>



        <h3>Activation Key</h3>
        @if (!empty($key->activation_key))
        <div class="item">
            <h2>{{ ucwords($key->key_type) }}</h2>
            <span>{{ ($key->key_type == "lifetime") ? 'Never' : $key->expires_on }}</span>
            <span>{{ ($key->activated_at) ?  $key->activated_at : 'Not activated' }}</span>
        </div>
        @endif

        <h3>User</h3>
        @if (!empty($key->users_user_id))
        <div class="item">
            <h2>{{ $key->name }}</h2>
            <span>{{ $key->email }}</span>
        </div>
        @else
        <p>This activation key is not yet linked to an account and is unbinded.</p>
        @endif

        <h3>Discord Account</h3>
        @if (!empty($key->discord_id))
        <div class="item">
            <img src="{{ $key->avatar }}" alt="Profile picture">
            <h2>{{ $key->username }}</h2>
            <span>{{ $key->discord_id }}</span>
        </div>
        @else
        <p>This activation key does not have a discord account assossiated with their account</p>
        @endif

        <h3>Subscriptions</h3>
        @if (!empty($key->subscription_id))
        <div class="item">
            <h2>{{ $key->payer_email }}</h2>
            <span>{{ $key->payer_name }}</span>
            <span>{{ $key->status }}</span>
        </div>
        @else
        <p>This activation key is not assossiated to any subscriptions</p>
        @endif


        
    

        
    </div>
    

@endsection
