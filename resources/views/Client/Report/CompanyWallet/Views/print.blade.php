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

            <p>@lang('company_wallet.print_report_head') </p>
          <br>
            <p style="display:flex;justify-content: space-between;" >@lang('company_wallet.print_report_all_companies_amount') <span>{{$all_companies_amount}} @lang('general.sar')</span>  </p>
            
            @if(isset($one_company_amount))
            <p style="display:flex;justify-content: space-between;" >@lang('company_wallet.print_report_one_company_amount')<strong>{{$company_name}}</strong> : <label> {{$one_company_amount}} @lang('general.sar')</label> </p>
            @endif
<hr>
        </div>

    </div>
</section>
