<section class="invoice visible-print-inline-block">
    <div class="row" style="text-align: left; padding:10px;">
        <span class="logo-mini"><img src="{{url('AdminDesign')}}/logo_tipo.png" style="width:100px"></span>
    </div>
    <div class="row">
        <div style="display:flex;justify-content:space-between;align-items:center;background-color:#f7ef31 !important">
            <div style="font-size:30px;font-weight:800; color:#1fbdd9 !important; background-color:white !important;margin-right: 100px;padding:5px">
                {{ config('app.name') }}
            </div>
            {{-- <div>
                <small style="padding:5px">@lang('general.date') : {{ date('Y-m-d') }}</small>
        </div> --}}
    </div>
    </div>



    <div class="row" style="justify-content:center; text-align:center;margin-top:20px">
        <address class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding:10px;font-weight:800; font-size:16px; justify-content:center; text-align:center ;align-item:center">
            <strong style="padding:10px;font-weight:800; font-size:16px;">@lang('company.name') :
                {{ isset($company_name) ? $company_name : '' }}</strong>
        </address>

        <address class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding:10px;font-weight:800; font-size:16px; justify-content:center; text-align:center ;align-item:center">
            <strong style="padding:10px;font-weight:800; font-size:16px;">@lang('company.client') :
                {{ auth()->user()->name }}</strong>
        </address>
        <address class="row" style="  font-weight:800; font-size:16px;  justify-content:center; text-align:center ;align-item:center">
            <strong>@lang('general.date') @lang('general.from') : {{ Request('date_from') }}
                @lang('general.to') :{{ Request('date_to') }} </strong>
        </address>
    </div>


</section>
