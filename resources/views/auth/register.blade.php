@extends('auth.index')

@section('content')
<div class="register-box">
    <div class="register-logo">
        <a href=""><b>Invenrtory</b>Managment</a>
    </div>

    <div class="card card-info" style="width: 100%">
        <div class="card-header">
            <h3 class="card-title">تسجيل جديد</h3>
        </div>

        <form>
            @csrf
            <div class="card-body">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Full name" id="name" name="name">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Email" id="email" name="email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" id="password" name="password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Retype password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="button" onclick="submitRegister('{{ $guard }}')" class="btn btn-success">Register</button>
            </div>
            <div class="social-auth-links text-center mb-3">
                <p>- OR -</p>
                <div class="card-footer">
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i> Sign in using Google
                    </a>
                </div>
            </div>

            <div class="input-group mb-3" style="margin-left: 20%">
                <a href="{{route('auth.login', $guard)}}" class="text-center">I already have a membership</a>
            </div>
    </div>
    <!-- /.card-footer -->
    </form>
</div>
</div>

<!-- /.register-box -->
@endsection

@section('scripts')
<script src="{{asset('js/axios.js')}}"></script>
<script src="{{ asset('js/crud.js') }}"></script>
<script>
    function submitRegister(guard) {
    const data = {
    name: document.getElementById('name').value,
    email: document.getElementById('email').value,
    password: document.getElementById('password').value
    };

    const url = `/auth/${guard}/register`;

    register(url, guard, data);
    }
</script>
@endsection
