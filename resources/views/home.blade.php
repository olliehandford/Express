@extends('layouts.app')


@section('content')

<form action="{{ route('restock') }}" method="post">
    @csrf
    <input type="password" placeholder="Password" name="password">
    <button type="submit">Purchase Express</button>
</form>

@endsection