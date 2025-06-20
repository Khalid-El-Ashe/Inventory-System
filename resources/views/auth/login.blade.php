@extends('auth.index')

@section('styles')
<link rel="stylesheet" href="{{asset('plugins/toastr/toastr.min.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
@endsection

@section('content')


{{--
<x-resources.components.toaster type="success" /> --}}

<div class="login-box">
    <div class="login-logo">
        <a href=""><b>Invenrtory</b>Managment</a>
    </div>
    <!-- /.login-logo -->

    <div class="card card-info" style="width: 100%">
        <div class="card-header">
            <h3 class="card-title">تسجيل الدخول</h3>
        </div>

        <form>
            @csrf
            <div class="card-body">
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Email" id="email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" id="password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="button" onclick="submitLogin('{{ $guard }}')" class="btn btn-primary">Sign in</button>
                {{-- <button type="submit" class="btn btn-default float-right">Rgister</button> --}}
                <a href="{{route('auth.register', $guard)}}" class="btn btn-success float-right">Register</a>
            </div>
            <div class="social-auth-links text-center mb-3">
                <p>- OR -</p>
                <div class="card-footer">
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i> Sign in using Google
                    </a>
                </div>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
</div>
<!-- /.login-box -->
@endsection
@section('scripts')
{{-- Sweet Alert 2 --}}
<script src="{{ asset('js/sweetAlert.js') }}"></script>
{{-- Axios --}}
<script src="{{ asset('js/axios.js') }}"></script>
{{-- my Toaster --}}
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
<script src="{{asset('js/crud.js')}}"></script>
<script>
    function submitLogin(guard) {
    console.log("Guard value:", guard);
    const data = {
    email: document.getElementById('email').value,
    password: document.getElementById('password').value,
    guard: guard
    };
    const url = `/auth/${guard}/login`;
    login(url, guard, data);
    }
</script>
@endsection
