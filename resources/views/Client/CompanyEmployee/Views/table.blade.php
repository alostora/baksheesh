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

        mywindow.document.write('<html><head><title>' + userName + '</title>');
        mywindow.document.write('</head><body >');
        mywindow.document.write('<h1>' + userName + '</h1>');
        mywindow.document.write(document.getElementById(userId).innerHTML);
        mywindow.document.write('</body></html>');

        mywindow.focus(); // necessary for IE >= 10*/
        mywindow.print();
        mywindow.close();

        return true;
    }
</script>
