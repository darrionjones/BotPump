<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $page_title or "BotPump" }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="icon" type="image/png" href="{{ asset('img/favicon-white.png') }}?v=2111">

    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ionicons/ionicons.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/bootstrap-slider/slider.css') }}">

    <link rel="stylesheet" href="{{ asset('css/datatables.net-bs/dataTables.bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/select2/select2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/bootstrap-daterangepicker/daterangepicker.css') }}">

    <link rel="stylesheet" href="{{ asset('css/highcharts/highcharts.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminlte/skins/_all-skins.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/w3.css') }}">

    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <link rel="stylesheet" href="{{ asset('css/loading.css') }}">

    @yield('stylesheet')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <!-- Header -->
        @include('partials.header')

        <!-- Sidebar -->
        @include('partials.sidebar')

        <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <?php
                        $segments = Request::segments();
                    ?>
                   <!--h1>
                        {{ ucwords($segments[0]) }}
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        @for($i = 0; $i < sizeof($segments); $i++)
                            @if($i == 0)
                                <li><i class="fa fa-dashboard"></i> {{ ucwords($segments[$i]) }}</li>
                            @elseif($i == sizeof($segments))
                                <li class="active">{{ ucwords($segments[$i]) }}</li>
                            @else
                                <li>{{ ucwords($segments[$i]) }}</li>
                            @endif
                        @endfor
                    </ol-->
                </section>

                <!-- Main content -->
                <section class="content">
                    <!-- Your Page Content Here -->
                    @yield('content')
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->

            <!-- Footer -->
            @include('partials.footer')

    </div><!-- ./wrapper -->

    <script src="{{ asset('js/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>

    <script src="{{ asset('js/datatables.net/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/datatables.net-bs/dataTables.bootstrap.min.js') }}"></script>

    <script src="{{ asset('js/moment/moment.js') }}"></script>
    <script src="{{ asset('js/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

    <script src="{{ asset('js/highcharts/highcharts.js') }}"></script>

    <script src="{{ asset('js/select2/select2.min.js') }}"></script>

    <script src="{{ asset('js/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>

    <script src="{{ asset('js/adminlte/adminlte.min.js') }}"></script>

    <script src="{{ asset('js/bootstrap-slider/bootstrap-slider.js') }}"></script>

    <script src="{{ asset('js/loading.js') }}"></script>

    @yield('script')

</body>
</html>