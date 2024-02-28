<section class="invoice" id="report">

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

    <hr>

    <div class="row">
        <div class="col-sm-4 invoice-col">
            <address>
                <strong>@lang('company.name') : {{isset($company_name) ? $company_name : ''}}</strong>
            </address>

            <address>
                <strong>@lang('company.client') : {{isset($client_name) ? $client_name : ''}}</strong>
            </address>
            <address>
                <strong>@lang('general.date') @lang('general.from') : {{Request('date_from')}} @lang('general.to') : {{Request('date_to')}} </strong>
            </address>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4 invoice-col">
            <address>
                <strong> @lang('general.total') : {{isset($one_company_amount) ? $one_company_amount : ''}} @lang('general.sar')</strong>
            </address>
        </div>
    </div>

</section>
