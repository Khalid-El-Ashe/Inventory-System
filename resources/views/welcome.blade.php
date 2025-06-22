<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{config('app.name')}}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('cms/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('cms/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('cms/dist/css/adminlte.min.css')}}">
</head>

<body class="hold-transition login-page">

    <div class="container" style="margin-top: 150px">
        <div class="card card-info" style="width: 100%">
            <div class="card-header">
                <h3 class="card-title-center">{{config('app.name')}}</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Chose the Account Type</label>
                    <select class="form-control" style="width: 100%;" onchange="redirectToRoute(this)">
                        <option selected disabled>Account Type</option>
                        <option value="{{ route('auth.login', 'admin') }}">System Admin</option>
                        <option value="{{ route('auth.login', 'manager') }}">Manager</option>
                        <option value="{{ route('auth.login', 'customer') }}">Customer</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{asset('cms/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('cms/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('cms/dist/js/adminlte.min.js')}}"></script>
    <script>
        function redirectToRoute(selectElement) {
                const url = selectElement.value;
                if (url) {
                    window.location.href = url;
                }
            }
    </script>
</body>

</html>