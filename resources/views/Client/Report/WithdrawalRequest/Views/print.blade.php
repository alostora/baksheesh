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

            <p>@lang('withdrawal_request.client') : <strong> {{$client_name}} </strong> </p>

            <br>
            <p>@lang('withdrawal_request.print_client_count_all') {{$client_count_all}} @lang('general.sar')</p>
            <p>@lang('withdrawal_request.print_client_count_pending') {{$client_count_pending}} @lang('general.sar')</p>
            <p>@lang('withdrawal_request.print_client_count_accepted') {{$client_count_accepted}} @lang('general.sar')</p>
            <p>@lang('withdrawal_request.print_client_count_refused') {{$client_count_refused}} @lang('general.sar')</p>
            <p>@lang('withdrawal_request.print_client_count_unexecutable') {{$client_count_unexecutable}} @lang('general.sar')</p>

            <br>

            <p>@lang('withdrawal_request.print_client_sum_all') {{$client_sum_all}} @lang('general.sar')</p>
            <p>@lang('withdrawal_request.print_client_sum_pending') {{$client_sum_pending}} @lang('general.sar')</p>
            <p>@lang('withdrawal_request.print_client_sum_accepted') {{$client_sum_accepted}} @lang('general.sar')</p>
            <p>@lang('withdrawal_request.print_client_sum_refused') {{$client_sum_refused}} @lang('general.sar')</p>
            <p>@lang('withdrawal_request.print_client_sum_unexecutable') {{$client_sum_unexecutable}} @lang('general.sar')</p>

        </div>
    </div>
</section>
