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
<br>
            <p>@lang('withdrawal_request.client') : <strong> {{$client_name}} </strong> </p>

            <br>
            <br>
        
            <p style="display:flex;justify-content: space-between;" >@lang('withdrawal_request.print_client_count_all') <spain>{{$client_count_all}} @lang('general.sar')</spain></p>
            <hr>
            <p style="display:flex;justify-content: space-between;" >@lang('withdrawal_request.print_client_count_pending') <spain>{{$client_count_pending}} @lang('general.sar')</spain></p>
            <hr>
            <p style="display:flex;justify-content: space-between;" >@lang('withdrawal_request.print_client_count_accepted') <spain>{{$client_count_accepted}} @lang('general.sar')</spain></p>
            <hr>
            <p style="display:flex;justify-content: space-between;" >@lang('withdrawal_request.print_client_count_refused') <spain>{{$client_count_refused}} @lang('general.sar')</spain></p>
            <hr>
            <p style="display:flex;justify-content: space-between;" >@lang('withdrawal_request.print_client_count_unexecutable') <spain>{{$client_count_unexecutable}} @lang('general.sar')</spain></p>

            <br>

        
            <p style="display:flex;justify-content: space-between;" >@lang('withdrawal_request.print_client_sum_all') <spain>{{$client_sum_all}} @lang('general.sar')</spain></p>
            <hr>
            <p style="display:flex;justify-content: space-between;" >@lang('withdrawal_request.print_client_sum_pending') <spain>{{$client_sum_pending}} @lang('general.sar')</spain></p>
            <hr>
            <p style="display:flex;justify-content: space-between;" >@lang('withdrawal_request.print_client_sum_accepted') <spain>{{$client_sum_accepted}} @lang('general.sar')</spain></p>
            <hr>
            <p style="display:flex;justify-content: space-between;" >@lang('withdrawal_request.print_client_sum_refused') <spain>{{$client_sum_refused}} @lang('general.sar')</spain></p>
            <hr>
            <p style="display:flex;justify-content: space-between;" >@lang('withdrawal_request.print_client_sum_unexecutable') <spain>{{$client_sum_unexecutable}} @lang('general.sar')</spain></p>

        </div>
    </div>
</section>
