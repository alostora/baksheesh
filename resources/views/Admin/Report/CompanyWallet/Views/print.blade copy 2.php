<section class="invoice" id="report" style="display:block">

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
            <p>@lang('company_wallet.print_report_all_companies_amount') {{$all_companies_amount}} @lang('general.sar')</p>
            <p>@lang('company_wallet.print_report_all_client_companies_amount') {{$all_clients_amount}} @lang('general.sar')</p>
            <p>@lang('company_wallet.print_report_one_company_amount') {{$one_company_amount}} @lang('general.sar')</p>

        </div>
        <div class="col-xs-12">
            <div style="width:100%;">
                <table id="table" style="width:100%; justify-content:space-between;">
                    <tr>
                        <th style="width:70%;text-align: start">All Companies : </th>
                        <td>{{$all_companies_amount}} <span> -SAR </span></td>
                    </tr>
                    <tr>
                        <th style="width:70%;text-align: start">Client Companies <span>Client Name</span> : </th>
                        <td>{{$all_clients_amount}} <span> -SAR </span></td>
                    </tr>
                    <tr>
                        <th style="width:70%;text-align: start">Company <span>Company Name</span> : </th>
                        <td>{{$one_company_amount}} <span> -SAR </span></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</section>
