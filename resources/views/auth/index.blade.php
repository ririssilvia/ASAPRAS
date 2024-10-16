<!doctype html>
<html lang="en" data-bs-theme="light">


<!-- Mirrored from codervent.com/maxton/demo/vertical-menu/auth-cover-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 Jul 2024 16:19:34 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ASPRAS</title>
    <!--favicon-->
    <link rel="icon" href="{{ url('assets/images/auth/logo-asmoro.png') }}" type="image/png">
    <!-- loader-->
    <link href="{{ url('assets/css/pace.min.css') }}" rel="stylesheet">
    <script src="{{ url('assets/js/pace.min.js') }}"></script>

    <!--plugins-->
    <link href="{{ url('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/plugins/metismenu/metisMenu.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/plugins/metismenu/mm-vertical.css') }}">
    <!--bootstrap css-->
    <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" rel="stylesheet">
    <!--main css-->
    <link href="{{ url('assets/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="{{ url('sass/main.css') }}" rel="stylesheet">
    <link href="{{ url('sass/dark-theme.css') }}" rel="stylesheet">
    <link href="{{ url('sass/blue-theme.css') }}" rel="stylesheet">
    <link href="{{ url('sass/responsive.css') }}" rel="stylesheet">

</head>

<body>


    <!--authentication-->

    <div class="section-authentication-cover">
        <div class="">
            <div class="row g-0">

                <div
                    class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex border-end bg-transparent">

                    <div class="card rounded-0 mb-0 border-0 shadow-none bg-transparent bg-none">
                        <div class="card-body">
                            <img src="{{ url('assets/images/auth/login-asmoro.png') }}"
                                class="img-fluid auth-img-cover-login" width="650" alt="">
                        </div>
                    </div>

                </div>

                <div class="col-12 col-xl-5 col-xxl-4 auth-cover-right align-items-center justify-content-center border-top border-4 border-primary border-gradient-1">
                    <div class="card rounded-0 m-3 mb-0 border-0 shadow-none bg-none">
                        <div class="card-body p-sm-5">
                            <img src="{{ url('assets/images/auth/logo-asmoro.png') }}" class="mb-4" width="80" alt="">
                
                            <h4 class="fw-bold">ASPRAS</h4>
                            <p class="mb-0">Aplikasi Perbaikan Sarana dan Prasarana Rumah Sakit</p>
                            <hr>
                
                            <div class="form-body mt-4">
                                <form class="row g-3" action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="col-12">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="jhon@example.com">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group" id="show_hide_password">
                                            <input type="password" class="form-control" id="password" name="password"
                                                placeholder="Enter Password">
                                            <a href="javascript:;" class="input-group-text bg-transparent"><i
                                                    class="bi bi-eye-slash-fill"></i></a>
                                        </div>
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary">Login</button>
                                        </div>
                                    </div>
                
                                </form>
                            </div>
                
                        </div>
                    </div>
                </div>
                

            </div>
            <!--end row-->
        </div>
    </div>

    <!--authentication-->




    <!--plugins-->
    <script src="{{ url('assets/js/jquery.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bi-eye-slash-fill");
                    $('#show_hide_password i').removeClass("bi-eye-fill");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bi-eye-slash-fill");
                    $('#show_hide_password i').addClass("bi-eye-fill");
                }
            });
        });
    </script>

</body>


<!-- Mirrored from codervent.com/maxton/demo/vertical-menu/auth-cover-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 Jul 2024 16:19:34 GMT -->

</html>
