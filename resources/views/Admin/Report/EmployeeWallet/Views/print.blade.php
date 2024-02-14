<section class="invoice" id="report" style="display:none">

    <div class="row">
        <div>
            <div style="display:flex;justify-content:space-between;align-items:center">
                <div style="font-size:30px">
                    {{config('app.name')}}
                </div>
                <div>
                    <small>@lang('general.date') : {{date('Y-m-d')}}</small>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-4 invoice-col">
            @lang('general.to')
            <address>
                @lang('general.mr') : <span>{{auth()->user()->name}}</span>
                <br>
                @lang('general.email') : {{auth()->user()->email}}
            </address>
        </div>
    </div>

    <hr>
    <div class="row">
        <div class="col-xs-12">

            <p>@lang('employee_wallet.print_report_head') </p>
            <p>@lang('employee_wallet.print_report_all_employees_amount') {{$all_employees_amount}} @lang('general.sar')</p>

            @if(isset($client_employees_amount))
            <p>@lang('employee_wallet.print_report_client_employees_amount') <strong> {{$client_name}} </strong> : <label>{{$client_employees_amount}} @lang('general.sar')</label></p>
            @endif

            @if(isset($one_company_employees_amount))
            <p>@lang('employee_wallet.print_report_one_company_employees_amount')<strong> {{$company_name}} </strong> : <label> {{$one_company_employees_amount}} @lang('general.sar')</label></p>
            @endif

            @if(isset($one_employee_amount))
            <p>@lang('employee_wallet.print_report_one_employee_amount')<strong> {{$employee_name}} </strong> : <label> {{$one_employee_amount}} @lang('general.sar')</label></p>
            @endif

        </div>
    </div>
</section>
