@extends('layouts.app')


@section('content')


<div class="wrapper">

    @if (session('success'))
        <span class="success">{{ session('success') }}</span>
    @endif

    <dashboard></dashboard>
</div>

<script src="{{ asset('js/app.js') }}"></script>

@endsection
