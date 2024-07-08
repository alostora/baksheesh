<section class="content">

    <div class="box box-info">

        @include('Client/TableFilter/employee')

        <div class="box-header">
            <h3 class="box-title col-md-8">@lang('company_employee.page_title')</h3>
            <div class="col-md-4">
                <a href="{{url('client/client-company-employee/create?company_id='.Request('company_id'))}}" class="btn btn-primary btn-sm" style="height:25px;padding:2px;width:150px">
                    <i class="fa fa-plus"></i>
                    <span>@lang('company_employee.create')</span>
                </a>
            </div>
        </div>
        <div class="box">
            <div class="box-body">
                <div class="col-sm-4 col-md-2">
                    <div class="color-palette-set">
                        <div class="bg-blue disabled color-palette">
                            <span>
                                @lang('general.total') : {{$count_inactive + $count_active}}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-md-2">
                    <div class="color-palette-set">
                        <div class="bg-red disabled color-palette">
                            <span>
                                @lang('company_employee.inactive') : {{$count_inactive}}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-md-2">
                    <div class="color-palette-set">
                        <div class="bg-green disabled color-palette">
                            <span>
                                @lang('company_employee.active') : {{$count_active}}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('company_employee.qr')</th>
                            <th>@lang('company_employee.file')</th>
                            <th>@lang('company_employee.name')</th>
                            <th>@lang('company_employee.phone')</th>
                            <th>@lang('company_employee.employee_job_name')</th>
                            <th>@lang('company_employee.operations')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($employees))
                        @foreach ($employees as $key=>$user)
                        <tr>
                            <td> {{$key+1}} </td>
                            <td onclick="PrintQr('{{$user->name}}','{{$user->id}}')">
                                <div id="{{$user->id}}">
                                    {!! $user->employee_qr !!}
                                </div>
                            </td>
                            <td>
                                @if($user->file)
                                <img src="{{ url('uploads/'.$user->file->new_name)}}" style="height:50px;width:50px;border-radius:50%">
                                @endif
                            </td>
                            <td> {{$user->name}} </td>
                            <td> {{$user->phone}} </td>
                            <td> {{$user->employee_job_name}} </td>
                            <td>

                                <a href="{{url('client/employee-available-ratings/search?employee_id='.$user->id.'&company_id='.$user->company_id)}}" class="btn btn-warning btn-sm">
                                    <i class="fa fa-star"></i>
                                </a>

                                <a href="{{url('client/employee-wallets?company_id='.$user->company_id.'&employee_id='.$user->id)}}" class="btn btn-success btn-sm">
                                    <i class="fa fa-info"></i> @lang('general.wallet')
                                </a>

                                <a href="{{url('guest/payment/pay-for-employee/'.$user->id)}}" target="_blank" class="btn btn-success btn-sm">
                                    <i class="fa fa-link"></i>
                                </a>

                                <a href="{{url('client/client-company-employee/edit/'.$user->id)}}" class="btn btn-success btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>

                                @if($user->stopped_at == null)
                                <a href="{{url('client/client-company-employee-inactive/'.$user->id)}}" class="btn btn-success btn-sm">
                                    <i class="fa fa-check"></i> current status : active
                                </a>
                                @else

                                <a href="{{url('client/client-company-employee-active/'.$user->id)}}" class="btn btn-danger btn-sm">
                                    <i class="fa fa-close"></i> current status : Inactive at {{$user->stopped_at}}
                                </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        {{ $employees->appends($_GET)->render('pagination::bootstrap-4') }}
                    </ul>
                </div>

            </div>
        </div>
</section>


<script>
    function PrintQr(userName, userId) {

        var mywindow = window.open(" ", "PRINT");

        mywindow.document.write(

            `<html lang="en">
                <head>
                    <style>
                        * {
                            margin: 0;
                            padding: 0;
                            box-sizing: border-box;
                        }
                        html {
                            font-size: 10px;
                        }
                        body {
                            font-family: "cairo", "sans-serif", "Marhey";
                            zoom : 105%;
                        }

                        .smil_bg {
                            width: 320px;
                            height: 320px;
                            border-radius: 50%;
                            background-color: yellow;
                            display: flex;
                            justify-content: center;
                            text-align: center;
                            align-items: center;
                            margin-top:45%;
                        }
                        .smiley-face {
                            width: 300px;
                            height: 300px;
                            border-radius: 50%;
                            background-color: yellow;
                            position: relative;
                            border: 6px solid black;
                        }
                        .rate_me {
                            position: absolute;
                            top: 5%;
                            left: 40%;
                            right: -50%;
                            width: 15%;
                            height: 15%;
                            display: flex;
                            justify-content: center;
                            text-align: center;
                            align-items: center;
                        }
                        .font-style {
                            font-family: Marhey ;
                            font-size: xx-large;
                            font-style: oblique;
                            font-weight: 400;
                        }
                        .style_font_1{
                            position: absolute;
                            top: 9.9%;
                            right: 29.8%;
                            width:4%;
                            height: 11px;
                            border-radius: 25px;
                            border: 8.5px solid black;
                            rotate: -15deg;
                        }
                        .style_font_2{
                            position: absolute;
                            top: 11.9%;
                            left: 44%;
                            width: 5%;
                            height: 12px;
                            border-radius: 25px;
                            border: 8px solid black;
                            rotate: 15deg;
                        }
                        .img{
                            position: absolute;
                            width: 50%;
                            height:50%;
                            top: 30%;
                            left: 25%;
                        }
                        .mouth {
                            position: absolute;
                            top: 60%;
                            left: 20%;
                            width: 60%;
                            height: 30%;
                            border-radius: 50%;
                            border-bottom: 8px solid black;
                        }
                        .mouth_circle {
                            position: relative;
                            top: 80%;
                            left: 50%;
                            transform: translate(-50%, -50%);
                            height: 100px;
                            width: 75%;
                            border-radius: 0 0 200px 200px;
                            border-bottom: 10px solid black;
                            border-left: 10px solid black;
                            border-right: 10px solid black;
                        }
                        .mouth_left {
                            position: absolute;
                            top: 61%;
                            right: 7.5%;
                            width: 15%;
                            height: 1px;
                            border-radius: 25px;
                            border: 8px solid black;
                            rotate: -15deg;
                        }
                        .mouth_right {
                            position: absolute;
                            top: 61%;
                            left: 7.5%;
                            width: 15%;
                            height: 1px;
                            border-radius: 25px;
                            border: 8px solid black;
                            rotate: 15deg;
                        }
                    </style>
                    <title>Tipo smart</title>
                </head>

                <body>
                    <center>
                        <div class="smil_bg">
                            <div class="smiley">
                                <div class="smiley-face">
                                    <div class="style_font_1"></div>
                                    <div class="style_font_2"></div>
                                    <div class="rate_me">
                                        <h1 class="font-style">قــيــمـنى</h1>
                                    </div>
                                    <div class="img">
                                        ${document.getElementById(userId).innerHTML}
                                    </div>
                                    <div class="mouth_left"></div>
                                    <div class="mouth_right"></div>
                                    <div class="mouth_circle"></div>
                                </div>
                            </div>
                        </div>
                    </center>
                </body>

            </html>`

        );

        mywindow.focus(); // necessary for IE >= 10*/
        mywindow.print();
        mywindow.close();
    }
</script>
