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

            <p>@lang('withdrawal_request.print_report_head') </p>

            <p>@lang('withdrawal_request.print_total') {{$count_all}} @lang('general.sar')</p>
            <p>@lang('withdrawal_request.print_pending') {{$count_pending}} @lang('general.sar')</p>
            <p>@lang('withdrawal_request.print_accepted') {{$count_accepted}} @lang('general.sar')</p>
            <p>@lang('withdrawal_request.print_refused') {{$count_refused}} @lang('general.sar')</p>
            <p>@lang('withdrawal_request.print_unexecutable') {{$count_unexecutable}} @lang('general.sar')</p>

            @if(isset($client_withdrawal_request_amount))

            <p>@lang('withdrawal_request.print_report_head') </p>
            <br>
            <strong> {{$client_name}} </strong> :

            <p>@lang('withdrawal_request.print_client_total') {{$client_count_all}} @lang('general.sar')</p>
            <p>@lang('withdrawal_request.print_client_pending') {{$client_count_pending}} @lang('general.sar')</p>
            <p>@lang('withdrawal_request.print_client_accepted') {{$client_count_accepted}} @lang('general.sar')</p>
            <p>@lang('withdrawal_request.print_client_refused') {{$client_count_refused}} @lang('general.sar')</p>
            <p>@lang('withdrawal_request.print_client_unexecutable') {{$client_count_unexecutable}} @lang('general.sar')</p>

            @endif

        </div>
    </div>
</section>
