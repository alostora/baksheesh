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
  <link href='https://fonts.googleapis.com/css?family=Cairo' rel='stylesheet'>
  <link rel="stylesheet" href="{{url('AdminDesign')}}/myStyle.css">

  @if(App::getLocale() == "ar" || App::getLocale() == "")
  <link rel="stylesheet" href="{{url('AdminDesign')}}/bootstrap/css/bootstrap-rtl.min.css">
  <link rel="stylesheet" href="{{url('AdminDesign')}}/dist/css1/AdminLTE-rtl.min.css">
  <link rel="stylesheet" href="{{url('AdminDesign')}}/dist/css1/skins/_all-skins-rtl.min.css">
  <?php $dir = "rtl" ?>
  @elseif(App::getLocale() == "en")
  <?php $dir = "ltr" ?>
  @else
  <link rel="stylesheet" href="{{url('AdminDesign')}}/bootstrap/css/bootstrap-rtl.min.css">
  <link rel="stylesheet" href="{{url('AdminDesign')}}/dist/css1/AdminLTE-rtl.min.css">
  <link rel="stylesheet" href="{{url('AdminDesign')}}/dist/css1/skins/_all-skins-rtl.min.css">
  <?php $dir = "rtl" ?>
  @endif
  <link rel="stylesheet" href="{{url('AdminDesign/myStyle.css')}}">

  <script src="{{url('AdminDesign/bower_components/ckeditor/ckeditor.js')}}"></script>
  <script src="{{url('AdminDesign/bower_components/jquery/dist/jquery.min.js')}}"></script>


  <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->

  <link href="{{url('AdminDesign')}}/select2/select2.css" rel="stylesheet" />

  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script> -->

  <script src="{{url('AdminDesign')}}/select2/select2.min.js" defer></script>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@100;300;500;600;700;800;900&display=swap" rel="stylesheet">

  <style>
    * {
      font-family: 'Noto Kufi Arabic', 'sans-serif', !important;
    }

    .box {
      text-align: center;
      align-items: center;
      border: 2px solid #c05c5cb4;
      border-radius: 5%;
      width: 100%;
      margin-bottom: 28px;
      box-shadow: 0 3px 4px 0 rgba(0, 0, 0, 0.3),
        0 6px 20px 0 rgba(0, 0, 0, 0.19);
      padding: 5px;
    }

    h1 {
      font-size: 26px;
      color: #991902de;
    }

    h4 {
      color: #991902de;
      font-size: 22px;
    }

    .text {
      font-size: 12px;
    }

    .avatar {
      height: 120px;
      width: 120px;
      border-radius: 50%;
      box-shadow: 0 3px 4px 0 rgba(0, 0, 0, 0.3),
        0 6px 20px 0 rgba(0, 0, 0, 0.35);
      border: 1px solid #f26c4f
    }

    .comment {
      font-size: 16px;
    }


    .bg-logo {
      background-color: #f26c4f;
      width: 100%;
      height: 20%;
      position: absolute;
      top: 0px;
      z-index: -1;
      border-bottom-left-radius: 5%;
      border-bottom-right-radius: 5%;

    }

    .footer-bg {
      background-color: #f26c4f;
      width: 100%;
      height: 15%;
      position: absolute;
      bottom: 0px;
      z-index: -1;
      border-top-left-radius: 5%;
      border-top-right-radius: 5%;
    }

    .logo {
      text-align: center;
      justify-content: center;
      height: auto;
      padding: 20px;
    }

    .logo .img-logo {
      width: 200px;
      height: 100px
    }
  </style>
</head>

<body class="hold-transition skin-blue sidebar-mini" style="justify-content: center; position:relative;" dir={{$dir}}>