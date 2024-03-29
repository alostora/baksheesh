<section class="content">

    <div class="box box-info">

        @include('Client/TableFilter/company')

        <div class="box-header">
            <h3 class="box-title col-md-8">@lang('company.page_title')</h3>
            <div class="col-md-4">
                <a href="{{url('client/client-company/create')}}" class="btn btn-primary btn-sm" style="height:25px;padding:2px;width:150px">
                    <i class="fa fa-plus"></i>
                    <span>@lang('company.create')</span>
                </a>
            </div>
        </div>

        <div class="box box-success">
            <div class="box-body">
                <div class="col-sm-4 col-md-2">
                    <div class="color-palette-set">
                        <div class="bg-blue disabled color-palette">
                            <span>
                                @lang('company.active') : {{$count_active + $count_inactive}}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-md-2">
                    <div class="color-palette-set">
                        <div class="bg-green disabled color-palette">
                            <span>
                                @lang('company.active') : {{$count_active}}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-md-2">
                    <div class="color-palette-set">
                        <div class="bg-red disabled color-palette">
                            <span>
                                @lang('company.inactive') : {{$count_inactive}}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="box-body">
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('company.qr')</th>
                        <th>@lang('company.file')</th>
                        <th>@lang('company.name')</th>
                        <th>@lang('company.operations')</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($companies))
                    @foreach ($companies as $key=>$company)
                    <tr>
                        <td> {{$key+1}} </td>
                        <td onclick="PrintQr('{{$company->name}}','{{$company->id}}')">
                            <div id="{{$company->id}}">
                                {!! $company->company_qr !!}
                            </div>
                        </td>
                        <td>
                            @if($company->file)
                            <img src="{{ url('uploads/'.$company->file->new_name)}}" style="height:50px;width:50px;border-radius:50%">
                            @endif
                        </td>
                        <td> {{$company->name}} </td>
                        <td>

                            <a href="{{url('client/company-available-ratings/search?company_id='.$company->id)}}" class="btn btn-warning btn-sm">
                                <i class="fa fa-star"></i>
                            </a>

                            <a href="{{url('client/company-wallets?company_id='.$company->id)}}" class="btn btn-success btn-sm">
                                <i class="fa fa-info"></i> @lang('general.wallet') : ( {{$company->cash->sum('amount')}} )
                            </a>

                            <a href="{{url('client/client-company-employees/search?company_id='.$company->id)}}" class="btn btn-success btn-sm">
                                <i class="fa fa-info"></i> @lang('company.employees') : ( {{$company->employees->count()}} )
                            </a>

                            <a href="{{url('guest/payment/pay-for-company/'.$company->id)}}" target="_blank" class="btn btn-success btn-sm">
                                <i class="fa fa-link"></i>
                            </a>

                            <a href="{{url('client/client-company/edit/'.$company->id)}}" class="btn btn-success btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>

                            @if($company->stopped_at == null)
                            <a href="{{url('client/client-company-inactive/'.$company->id)}}" class="btn btn-success btn-sm">
                                <i class="fa fa-check"></i> @lang('general.current_status') : @lang('general.active')
                            </a>
                            @else

                            <a href="{{url('client/client-company-active/'.$company->id)}}" class="btn btn-danger btn-sm">
                                <i class="fa fa-close"></i> @lang('general.current_status') : @lang('general.inactive')
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
                    {{ $companies->appends($_GET)->render('pagination::bootstrap-4') }} }}
                </ul>
            </div>

        </div>
    </div>

</section>


<script>
    function PrintQr(companyName, companyId) {

        var mywindow = window.open(" ", "PRINT");

        mywindow.document.write('<html><head><title>' + companyName + '</title>');
        mywindow.document.write('</head><body >');
        mywindow.document.write('<h1>' + companyName + '</h1>');
        mywindow.document.write(document.getElementById(companyId).innerHTML);
        mywindow.document.write('</body></html>');

        // mywindow.focus(); // necessary for IE >= 10*/


        mywindow.print();
    }
</script>

