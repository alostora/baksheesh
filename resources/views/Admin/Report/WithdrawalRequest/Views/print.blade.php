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

            <p style="display:flex;justify-content: space-between;">@lang('withdrawal_request.print_report_head') </p>
<br>
            <p style="display:flex;justify-content: space-between;" >@lang('withdrawal_request.print_count_all') <span class="report_value">{{$count_all}} @lang('general.sar')</span></p>
            <hr>
            <p style="display:flex;justify-content: space-between;">@lang('withdrawal_request.print_count_pending') <span class="report_value">{{$count_pending}} @lang('general.sar')</span></p>
            <hr>
            <p style="display:flex;justify-content: space-between;">@lang('withdrawal_request.print_count_accepted') <span class="report_value">{{$count_accepted}} @lang('general.sar')</span></p>
            <hr>
            <p style="display:flex;justify-content: space-between;">@lang('withdrawal_request.print_count_refused') <span class="report_value">{{$count_refused}} @lang('general.sar')</span></p>
            <hr>
            <p style="display:flex;justify-content: space-between;">@lang('withdrawal_request.print_count_unexecutable') <span class="report_value">{{$count_unexecutable}} @lang('general.sar')</span></p>
            <hr>
            <p style="display:flex;justify-content: space-between;">@lang('withdrawal_request.print_sum_all') <span class="report_value">{{$sum_all}} @lang('general.sar')</span></p>
            <hr>
            <p style="display:flex;justify-content: space-between;">@lang('withdrawal_request.print_sum_pending') <span class="report_value">{{$sum_pending}} @lang('general.sar')</span></p>
            <hr>
            <p style="display:flex;justify-content: space-between;">@lang('withdrawal_request.print_sum_accepted') <span class="report_value">{{$sum_accepted}} @lang('general.sar')</span></p>
            <hr>
            <p style="display:flex;justify-content: space-between;">@lang('withdrawal_request.print_sum_refused') <span class="report_value">{{$sum_refused}} @lang('general.sar')</span></p>
            <hr>      
            <p style="display:flex;justify-content: space-between;">@lang('withdrawal_request.print_sum_unexecutable') <span class="report_value">{{$sum_unexecutable}} @lang('general.sar')</span></p>

            @if(isset($client_name))

            <p style="display:flex;justify-content: space-between;">@lang('withdrawal_request.client') : <strong> {{$client_name}} </strong> </p>

            <br>
            <p style="display:flex;justify-content: space-between;">@lang('withdrawal_request.print_client_count_all') <span class="report_value">{{$client_count_all}} @lang('general.sar')</span></p>
            <hr>
            <p style="display:flex;justify-content: space-between;">@lang('withdrawal_request.print_client_count_pending') <span class="report_value">{{$client_count_pending}} @lang('general.sar')</span></p>
              <hr>
            <p style="display:flex;justify-content: space-between;">@lang('withdrawal_request.print_client_count_accepted') <span class="report_value">{{$client_count_accepted}} @lang('general.sar')</span></p>
            <hr>
            <p style="display:flex;justify-content: space-between;">@lang('withdrawal_request.print_client_count_refused') <span class="report_value">{{$client_count_refused}} @lang('general.sar')</span></p>
            <hr>
            <p style="display:flex;justify-content: space-between;">@lang('withdrawal_request.print_client_count_unexecutable') <span class="report_value">{{$client_count_unexecutable}} @lang('general.sar')</span></p>

            <br>

          
            <p style="display:flex;justify-content: space-between;">@lang('withdrawal_request.print_client_sum_all') <span class="report_value">{{$client_sum_all}} @lang('general.sar')</span></p>
            <hr>
            <p style="display:flex;justify-content: space-between;">@lang('withdrawal_request.print_client_sum_pending') <span class="report_value">{{$client_sum_pending}} @lang('general.sar')</span></p>
            <hr>
            <p style="display:flex;justify-content: space-between;">@lang('withdrawal_request.print_client_sum_accepted') <span class="report_value">{{$client_sum_accepted}} @lang('general.sar')</span></p>
            <hr>
            <p style="display:flex;justify-content: space-between;">@lang('withdrawal_request.print_client_sum_refused') <span class="report_value">{{$client_sum_refused}} @lang('general.sar')</span></p>
            <hr>
            <p style="display:flex;justify-content: space-between;">@lang('withdrawal_request.print_client_sum_unexecutable') <span class="report_value">{{$client_sum_unexecutable}} @lang('general.sar')</span></p>

            @endif

        </div>
    </div>
</section>
