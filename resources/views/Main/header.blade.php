<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> @lang('general.app_name')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{url('AdminDesign')}}/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{url('AdminDesign')}}/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{url('AdminDesign')}}/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('AdminDesign')}}/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
  folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{url('AdminDesign')}}/dist/css/skins/_all-skins.min.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{url('AdminDesign')}}/bower_components/morris.js/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{url('AdminDesign')}}/bower_components/jvectormap/jquery-jvectormap.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{url('AdminDesign')}}/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{url('AdminDesign')}}/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{url('AdminDesign')}}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <!-- DataTables -->
    <!-- <link rel="stylesheet" href="{{url('AdminDesign')}}/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css"> -->


    <!-- DataTables -->
    <link rel="stylesheet" href="{{url('AdminDesign')}}/lte3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{url('AdminDesign')}}/lte3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{url('AdminDesign')}}/lte3/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">


    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


    <link rel="stylesheet" href="{{url('AdminDesign')}}/myStyle.css">
    {{--

<link rel="stylesheet" href="{{url('AdminDesign')}}/bootstrap-print.css" media="print">
    --}}

    @if(App::getLocale() == "ar" || App::getLocale() == "")
    <link rel="stylesheet" href="{{url('AdminDesign')}}/bootstrap/css/bootstrap-rtl.min.css">
    <link rel="stylesheet" href="{{url('AdminDesign')}}/dist/css1/AdminLTE-rtl.min.css">
    <link rel="stylesheet" href="{{url('AdminDesign')}}/dist/css1/skins/_all-skins-rtl.min.css">
    <?php $dir = "rtl" ?>
    @elseif(App::getLocale() == "en")
    <?php $dir = "ltr" ?>
    @else
    <?php $dir = "rtl" ?>
    @endif

    <link href='https://fonts.googleapis.com/css?family=Cairo' rel='stylesheet'>
    <link rel="stylesheet" href="{{url('AdminDesign/myStyle.css')}}">
    <link rel="stylesheet" href="{{url('AdminDesign/home_page_design.css')}}">

    <script src="{{url('AdminDesign/bower_components/ckeditor/ckeditor.js')}}"></script>
    <script src="{{url('AdminDesign/bower_components/jquery/dist/jquery.min.js')}}"></script>


    <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->

    <link href="{{url('AdminDesign')}}/select2/select2.css" rel="stylesheet" />

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script> -->

    <script src="{{url('AdminDesign')}}/select2/select2.min.js" defer></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>

    <style>
        .box {
            padding: 10px !important;
        }
    </style>
</head>

<body class="hold-transition skin-blue sidebar-mini" dir={{$dir}}>

    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="{{url('admin')}}" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><img src="{{url('AdminDesign')}}/logo_tipo.png" style="width:40px"></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><img src="{{url('AdminDesign')}}/logo_tipo.png" style="width:50px"></span>
            </a>
            <nav class="navbar navbar-static-top">
                <a href="#" class="fa  fa-exchange" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">

                        @if(App::getLocale() == 'en')
                        <li class=" lang"><a href="{{url('lang/ar')}}"> عربي</a></li>
                        @else
                        <li class=" lang"><a href="{{url('lang/en')}}"> EN </a></li>
                        @endif

                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="{{url('/')}}/user2-160x160.png" class="user-image" alt="User Image" style="border-radius: 50%;">
                                <span class="hidden-xs">{{auth()->user()->name}}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header" style="background-color: #fff;">
                                    <img src="{{url('/')}}/user2-160x160.png" class="img-circle" alt="User Image" style="border-radius: 50%;">

                                    <p>
                                        {{auth()->user()->name}}
                                        <small>Member since {{date("Y-m-d",strtotime(auth()->user()->created_at))}}</small>
                                    </p>
                                </li>

                                <li class="user-footer">
                                    @if(auth()->user()->accountType == \App\Foundations\LookupType\AccountTypeCollection::client())
                                    <div class="pull-left">
                                        <a href="{{url('client/client-profile')}}" class="btn btn-default btn-flat">@lang('dashboard.profile')</a>
                                    </div>
                                    @endif
                                    <div class="pull-right">
                                        <a href="{{url('admin/logout')}}" class="btn btn-default btn-flat">@lang('dashboard.logout')</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
