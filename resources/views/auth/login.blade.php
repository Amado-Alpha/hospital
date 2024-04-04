<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CareLink-Login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Custom css -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <!-- Fontawesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body class="hold-transition login-page">
    @if (session('success'))
        <script>
            $(document).ready(function() {
                toastr.success('{{ session('success') }}');
            });
        </script>
    @elseif (session('error'))
        <script>
            $(document).ready(function() {
                toastr.error('{{ session('error') }}');
            });
        </script>
    @endif

    @if ($errors->has('email'))
        <script>
            $(document).ready(function() {
                toastr.error('{{ $errors->first('email') }}');
            });
        </script>
    @endif

    @if ($errors->has('password'))
        <script>
            $(document).ready(function() {
                toastr.error('{{ $errors->first('password') }}');
            });
        </script>
    @endif
    @if ($errors->has('nurse_number'))
        <script>
            $(document).ready(function() {
                toastr.error('{{ $errors->first('nurse_number') }}');
            });
        </script>
    @endif


    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="" class="h1"><b>CareLink</b></a>
            </div>
            <div class="card-body">

                <p class="login-box-msg">Nurse Attendance</p>

                <form action="{{route('attendance')}}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="nurse_number" class="form-control"  autocomplete="off" placeholder="Nurse_ID" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-id-card"></span>
                            </div>
                        </div>
                    </div>

                    <div class="social-auth-links text-center mt-2 mb-3">
                        <div class="row">
                            <div class="col col-md-6">
                                <button type="submit" name="action" value="signin" class="btn btn-primary float-left">
                                <span class="fa fa-sign-in"></span> Sign In
                                </button>
                            </div>
                            <div class="col col-md-6">
                                <button type="submit" name="action" value="signout" class="btn btn-danger float-right">
                                    <span class="fa fa-sign-out"></span> Sign Out
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="float-left">
                        <p><a href="" data-toggle="modal" data-target="#loginModal">Admin Login
                                &hellip;</a></p>
                    </div> -->

                    <div class="col col-md-6">
                        <p><a href="#" id="showLoginForm">Admin Login</a></p>
                    </div>
                </form>
            
            <!-- /.card-body -->

        
        <!-- /.card -->
    
    
    <!-- Login form -->
                <div id="loginForm" style="display: none;">
                    <form action="{{ route('authentication') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div> <!-- /.card-body -->
        </div>
    </div>
    {{-- //end of modal --}}

    
    <!-- Toastr -->
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function () {
            $("#showLoginForm").click(function () {
                $("#loginForm").slideToggle();
            });
        });
    </script>
</body>

</html>
