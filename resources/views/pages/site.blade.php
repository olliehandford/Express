@extends('layouts.app')


@section('content')
    <h1>Sites we're monitoring</h1>
    <p>A list of websites we are monitoring. Select the website to check the status of the monitor</p>
    <h1>{{ $site->name }}</h1>

    @foreach ($site->links as $link)
        <div class="item">
            <i class="material-icons">delete</i>
            <h2>{{ $link->value }}</h2>
        </div>
    @endforeach

@endsection