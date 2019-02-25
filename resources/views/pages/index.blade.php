@extends('layouts.app')


@section('content')
<h1>{{ $title }}</h1>
<p>Express Notify Beta</p>

<a href="{{ route('buy') }}">Buy a key</a>
@endsection