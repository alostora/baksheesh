<section class="invoice visible-print-inline-block">
    <div class="row" style="text-align: left; padding:10px;">
        <span class="logo-mini"><img src="{{url('AdminDesign')}}/logo_tipo.png" style="width:100px"></span>
    </div>
    <div class="row">
        <div style="display:flex;justify-content:space-between;align-items:center;background-color:#f7ef31 !important">
            <div style="font-size:30px;font-weight:800; color:#1fbdd9 !important; background-color:white !important;margin-right: 100px;padding:5px">
                {{ config('app.name') }}
            </div>
        </div>
    </div>

    <div class="row" style="justify-content:center; text-align:center;margin-top:20px">

        <address class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding:10px;font-weight:800; font-size:16px; justify-content:center; text-align:center ;align-item:center">
            <strong style="padding:10px;font-weight:800; font-size:16px;">@lang('company.client') :
                {{ isset($client_name) ? $client_name : '' }}</strong>
        </address>

        <address class="row" style="  font-weight:800; font-size:16px;  justify-content:center; text-align:center ;align-item:center">
            <strong>@lang('general.date') @lang('general.from') : {{ Request('date_from') }}
                @lang('general.to') :{{ Request('date_to') }} </strong>
        </address>
    </div>

    <div class="row">
        <address>
            <strong style="font-weight:800; font-size:18px; background-color:#f7ef31 !important; padding:10px">
                @lang('general.total') :
                {{ isset($client_sum_all) ? $client_sum_all : '' }} @lang('general.sar')</strong>
        </address>
    </div>

    {{--
    <div class="row">
        <div class="col-xs-12">
            @if(isset($client_name))
            <div class="col-sm-6">
                <p style="display:flex;justify-content: space-between;">@lang('withdrawal_request.print_client_count_all') <span class="report_value">{{$client_count_all}}</span></p>
    <p style="display:flex;justify-content: space-between;">@lang('withdrawal_request.print_client_count_pending') <span class="report_value">{{$client_count_pending}}</span></p>
    <p style="display:flex;justify-content: space-between;">@lang('withdrawal_request.print_client_count_accepted') <span class="report_value">{{$client_count_accepted}}</span></p>
    <p style="display:flex;justify-content: space-between;">@lang('withdrawal_request.print_client_count_refused') <span class="report_value">{{$client_count_refused}}</span></p>
    <p style="display:flex;justify-content: space-between;">@lang('withdrawal_request.print_client_count_unexecutable') <span class="report_value">{{$client_count_unexecutable}}</span></p>
    </div>
    <div class="col-sm-6">
        <p style="display:flex;justify-content: space-between;">@lang('withdrawal_request.print_client_sum_all') <span class="report_value">{{$client_sum_all}} @lang('general.sar')</span></p>
        <p style="display:flex;justify-content: space-between;">@lang('withdrawal_request.print_client_sum_pending') <span class="report_value">{{$client_sum_pending}} @lang('general.sar')</span></p>
        <p style="display:flex;justify-content: space-between;">@lang('withdrawal_request.print_client_sum_accepted') <span class="report_value">{{$client_sum_accepted}} @lang('general.sar')</span></p>
        <p style="display:flex;justify-content: space-between;">@lang('withdrawal_request.print_client_sum_refused') <span class="report_value">{{$client_sum_refused}} @lang('general.sar')</span></p>
        <p style="display:flex;justify-content: space-between;">@lang('withdrawal_request.print_client_sum_unexecutable') <span class="report_value">{{$client_sum_unexecutable}} @lang('general.sar')</span></p>
    </div>
    @endif
    </div>
    </div>


    --}}

</section>
