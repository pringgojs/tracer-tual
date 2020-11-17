<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="description"
        content="Penelitian mengenai situasi alumni khususnya dalam hal pencarian kerja, situasi kerja, dan pemanfaatan pemerolehan kompetensi selama kuliah di polnes ">
    <meta name="keywords"
        content="tracer study Politeknik Perikanan Negeri Tual, Politeknik Perikanan Negeri Tual tracer study, tracer study politeknik elektronika negeri surabaya, polnes, kuesioner tracer study">
    <meta name="author" content="Pringgo Juni S.">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Tracer Study | Politeknik Perikanan Negeri Tual</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/app.css')}}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/all.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">

    @yield('styles')
</head>

<body>
    <nav class="navbar navbar-fixed-top navbar-default" style="background-color:#f8f8f8">
        <div class="container-fluid">
            <div class="container">
                <div class="navbar-header">
                    <a href="{{url('/')}}">
                        <img alt="Brand" src="{{asset('assets/images/tual.png')}}" class="logo">
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <div id="app">
        @yield('content')
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/all.js') }}"></script>
    @yield('scripts')
    @stack('scripts')
</body>

</html>