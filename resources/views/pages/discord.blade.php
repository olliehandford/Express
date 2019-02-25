@extends('layouts.app')


@section('content')

    <div class="wrapper">

        @foreach ($errors->all() as $error)
            <span class="error">{{ $error }}</span>
        @endforeach

        @if (session('success'))
            <span class="success">{{ session('success') }}</span>
        @endif

        <discord></discord>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    

@endsection
