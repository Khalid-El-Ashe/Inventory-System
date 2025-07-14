@extends('dashboard.parent')

@section('content')
<div class="container">
    <h1>{{ $guard }}</h1>

    <button type="button" onclick="submitChangePassword('{{ $guard }}')" class="btn btn-info">Show Gard</button>
</div>
@endsection

@section('scripts')
<script src="{{asset('js/crud.js')}}"></script>
<script>
    function submitChangePassword(guard) {
    console.log("Guard value:", guard);

    const url = `/auth/${guard}/change-password`;
    console.log("URL for change password:", url);
    }
</script>
@endsection