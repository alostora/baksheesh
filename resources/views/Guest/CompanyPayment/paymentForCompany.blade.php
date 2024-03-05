<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://kit.fontawesome.com/1492908104.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;700;700;800;900;1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{url('guest/style.css')}}">
    <title>Tipo smart</title>
    <script src="{{url('AdminDesign/bower_components/jquery/dist/jquery.min.js')}}"></script>
</head>

<body style="text-align: right;">
    <main class="bg">

        @include('Guest.CompanyPayment.createPaymentForCompany')

        <script src="{{url('AdminDesign')}}/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
        <script src="{{url('AdminDesign')}}/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="{{url('AdminDesign')}}/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <script src="{{url('AdminDesign')}}/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
        <script src="{{url('AdminDesign')}}/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    </main>
</body>

</html>
