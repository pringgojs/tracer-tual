
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/logo-tual.png')}}">
    <title>Tracer Study - Politeknik Perikanan Negeri Tual </title>
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('lite/css/style.css')}}" rel="stylesheet">
    <link href="{{ asset('css/css-chart.css')}}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{ asset('lite/css/colors/default-dark.css')}}" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper" class="login-register login-sidebar"  style="background-image:url({{ asset('assets/images/gedung-tual.jpg')}});">
        <div class="login-box card">
            <div class="card-body col-lg-12">
                <form class="form-horizontal form-material" id="loginform" method="post" action="{{url('login')}}">
                    {{ csrf_field() }}
                    <a style="color: #525c65" href="javascript:void(0)" class="text-center db"><img src="{{ asset('assets/images/logo-tual.png')}}" width=50 alt="Home" /><br/><font style="font-weight:700; color: #525c65">Tracer Study</font> </a>  
                    <div class="form-group m-t-40">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" name="email" required="" placeholder="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" name="password" required="" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="checkbox"  id="cb-laki-laki" class="filled-in"/>
                        <label for="cb-laki-laki">Remember me</label>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button style="border-radius:0" class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
                        </div>
                    </div>
                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            <p>Copyright &copy; <?php echo date('Y');?> <b></b></p>
                        </div>
                    </div>
                </form>
                <br>
                @if(session('failed_login'))
                    <div class="alert alert-danger">
                        <strong>Failed!</strong> {{ session('failed_login') }}
                    </div>
                @endif
            </div>
        </div>
    </section>
    <!-- ============================================================== -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('assets/plugins/bootstrap/js/tether.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ asset('lite/js/jquery.slimscroll.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('lite/js/waves.js')}}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('lite/js/sidebarmenu.js')}}"></script>
    <!--stickey kit -->
    <script src="{{ asset('assets/plugins/sticky-kit-master/dist/sticky-kit.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/mdb-chart/js/popper.min.js')}}"></script>
    <!--Custom JavaScript -->
</body>

</html>