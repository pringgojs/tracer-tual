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
    <title>Politeknik Perikanan Negeri Tual</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="{{ asset('assets/plugins/chartist-js/dist/chartist.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/chartist-js/dist/chartist-init.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css')}}" rel="stylesheet">
    <!--This page css - Morris CSS -->
    <link href="{{ asset('assets/plugins/c3-master/c3.min.css')}}" rel="stylesheet">
    <!--This MDB chart -->
    <link href="{{ asset('assets/plugins/mdb-chart/css/mdb.min.css')}}" rel="stylesheet">
    <!-- toaster -->
    <link href="{{ asset('assets/plugins/toaster/css/jquery.toast.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('lite/css/style.css')}}" rel="stylesheet">
    <link href="{{ asset('css/css-chart.css')}}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{ asset('lite/css/colors/blue.css')}}" id="theme" rel="stylesheet">
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('lite/js/jquery-ui.js')}}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/tether.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/lodash.min.js') }}"></script>
    
    <script src="{{ asset('assets/plugins/highchart-js/highcharts.js')}}"></script>
    <script src="{{ asset('assets/plugins/highchart-js/modules/exporting.js')}}"></script>
    <script src="{{ asset('assets/plugins/highchart-js/modules/drilldown.js')}}"></script>

    {{-- MDT --}}
    <link href='https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/mdt/dist/css/mdDateTimePicker.css')}}">
    <script src="{{ asset('assets/plugins/mdt/dist/js/moment.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/mdt/dist/js/lang/de.js')}}"></script>
    <script src="{{ asset('assets/plugins/mdt/dist/js/lang/fr.js')}}"></script>
    <script src="{{ asset('assets/plugins/mdt/dist/js/lang/af.js')}}"></script>
    <script src="{{ asset('assets/plugins/mdt/dist/js/lang/zh-cn.js')}}"></script>
    <script src="{{ asset('assets/plugins/mdt/dist/js/scroll-into-view-if-needed.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/mdt/dist/js/draggabilly.pkgd.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/mdt/dist/js/mdDateTimePicker.js')}}"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    @yield('styles')
</head>

<body class="fix-header fix-sidebar card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{url('/')}}">
                        <!-- Logo icon --><b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            
                            <!-- Light Logo icon -->
                            <img src="{{ asset('assets/images/logo-tual-white.png') }}" width="50" height="50" alt="homepage" class="light-logo" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span style="color:#eee">
                            <!-- Light Logo text -->    
                            <b style="font-weight:700;color:#fff">TRACER</b>STUDY
                            {{--  <img src="{{ asset('assets/images/logo-light-text.png')}}" class="light-logo" alt="homepage" />  --}}
                        </span>
                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- ============================================================== -->
                        <!-- Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> {{auth()->user()->name}}</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        @include('include.left-sidebar')
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                @yield('content')
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer"> © {{date('Y')}} Politeknik Perikanan Negeri Tual </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ asset('lite/js/jquery.slimscroll.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('lite/js/waves.js')}}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('lite/js/sidebarmenu.js')}}"></script>
    <!--stickey kit -->
    <script src="{{ asset('assets/plugins/sticky-kit-master/dist/sticky-kit.min.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('lite/js/custom.min.js')}}"></script>
    <script src="{{ asset('lite/js/jquery.sparkline.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/ion-range-slider/js/ion.rangeSlider.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/ion-range-slider/js/ion.rangeSlider-init.js')}}"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!-- chartist chart -->
    <script src="{{ asset('assets/plugins/chartist-js/dist/chartist.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js')}}"></script>
    <!--c3 JavaScript -->
    <script src="{{ asset('assets/plugins/d3/d3.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/c3-master/c3.min.js')}}"></script>
    <!-- mdb chart -->
    <script src="{{ asset('assets/plugins/mdb-chart/js/popper.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/mdb-chart/js/mdb.min.js')}}"></script>
    <!--data table -->
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <!-- toaster -->
    <script src="{{ asset('assets/plugins/toaster/js/jquery.toast.js')}}"></script>
    @yield('scripts')

    <script>
    function confirmation() {
        var t = confirm('Anda yakin ingin menghapus data ini ? data yang dihapus tidak dapat dikembalikan.');
        if (t) return true;

        return false;
    }

    function notification(title, text) {
        $.toast({
            heading: title,
            text: text,
            position: 'top-right',
            loaderBg:'#ff6849',
            icon: '',
            hideAfter: 3000, 
            stack: 6
        });
    }
    </script>
    
    <script>
    $(function() {
        
        {{-- Notification --}}
        @for($i=0;$i<=10;$i++)
            @if(session()->has('toaster_message_'.$i))
                $.toast({
                    heading: '{{ session()->get("toaster_title_".$i) }}',
                    text: '{{ session()->get("toaster_message_".$i) }}',
                    position: 'top-right',
                    loaderBg:'#ff6849',
                    icon: '{{ session()->get("toaster_icon_".$i) }}',
                    hideAfter: 3000, 
                    stack: 6
                });
                <?php  //session()->forget('toaster_message_'.$i); ?>
            @endif

        @endfor

        
    });
    </script>

</body>

</html>
