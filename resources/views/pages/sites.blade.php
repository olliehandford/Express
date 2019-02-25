@extends('layouts.app')


@section('content')
    <h1>Sites we're monitoring</h1>
    <p>A list of websites we are monitoring. Select the website to check the status of the monitor</p>

    @if (count($sites) > 0)
        @foreach ($sites as $site)
            <a href="{{ url('admin/sites/'.$site->name) }}" class="item">
                <i class="on material-icons">fiber_manual_record</i>
                <h2>{{ $site->name }}</h2>
                <span>31 Links</span>
            </a>
        @endforeach
    @endif
@endsection