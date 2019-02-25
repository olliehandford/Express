@if(Session::has('notice'))
    <p>
        {{ Session::get('notice') }}
    </p>
@endif