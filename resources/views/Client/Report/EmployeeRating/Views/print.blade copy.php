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

            <p>@lang('withdrawal_request.client') : <strong> {{auth()->user()->name}} </strong> </p>

            <br>
            <p style="display:flex;justify-content: space-between;" >@lang('general.total') : <span>{{$total_good_count + $total_bad_count}}</span></p>
            <hr>
            <p style="display:flex;justify-content: space-between;" > @lang('employee_rating.total_good_count') : <span>{{$total_good_count}}</span></p>
            <hr>
            <p style="display:flex;justify-content: space-between;" >@lang('employee_rating.total_bad_count') : <span>{{$total_bad_count}}</span></p>
            <hr>

        </div>
    </div>
</section>
