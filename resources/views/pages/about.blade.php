@extends('layouts.app')


@section('content')
    <h1>{{ $title }}</h1>
    <p>Express Notify Beta</p>
    @if (count($features) > 0)
        <ul>
        @foreach($features as $feature)
            <li>{{ $feature }}</li>
        @endforeach
        </ul>
    @endif
@endsection