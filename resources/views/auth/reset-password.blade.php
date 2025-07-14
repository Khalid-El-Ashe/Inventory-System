@extends('auth.index')

@section('content')
<h1>{{ $guard }}</h1>

<button type="button" onclick="submitResetPassword('{{ $guard }}')" class="btn btn-info">Show Gard</button>
@endsection

@section('scripts')
<script src="{{asset('js/crud.js')}}"></script>
<script>
    function submitResetPassword(guard) {
    console.log("Guard value:", guard);

    const url = `/auth/${guard}/reset-password`;
    console.log("URL for change password:", url);
    }
</script>
@endsection
