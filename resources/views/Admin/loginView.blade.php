<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Parking | Log in</title>
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
  <!-- iCheck -->
  <link rel="stylesheet" href="{{url('AdminDesign')}}/plugins/iCheck/square/blue.css">

  <link rel="stylesheet" href="{{url('AdminDesign')}}/myStyle.css">

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
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page" dir="{{$dir}}">
<div class="login-box">
  <div class="login-logo">
    <img src="{{url('adminDesign')}}/logo.png" style="height: 170px;width:200px;">
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">@lang('general.login') @lang('general.dashboard')</p>

    <form action="{{url('admin/login')}}" method="post">
      @csrf
      <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">@lang('general.login')</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script src="{{url('AdminDesign')}}/bower_components/jquery/dist/jquery.min.js"></script>
<script src="{{url('AdminDesign')}}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="{{url('AdminDesign')}}/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
