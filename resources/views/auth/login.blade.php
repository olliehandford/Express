@extends('layouts.app')


@section('content')


    <div class="wrapper">
        <form method="POST" class="main-form" action="{{ route('login') }}">
            <h1>Login</h1>
            @csrf
    
            @if ($errors->has('email'))
                <span class="error">{{ $errors->first('email') }}</span>
            @endif
    
            <label>
                <input type="email" class="{{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email address" required autofocus>
            </label>
            <label>
                <input type="password" class="{{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" placeholder="Password" required>
            </label>
    
            @if ($errors->has('password'))
                <span class="error">{{ $errors->first('password') }}</span>
            @endif
    
            <label>
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                <span>Remember me</span>
            </label>
    
            <div class="buttons">
                <button type="submit" class="btn">
                    {{ __('Login') }}
                </button>
        
                @if (Route::has('password.request'))
                    <a class="" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
        </form>
    </div>
    

@endsection
