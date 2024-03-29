<section class="content">

    <div class="box box-info">

        @include('Client/TableFilter/company_wallet')

        <div class="box-header">
            <h3 class="box-title col-md-8">@lang('company_wallet.page_title')</h3>
        </div>

        <div class="box">
            <div class="box-body">
                <div class="col-sm-4 col-md-2">
                    <div class="color-palette-set">
                        <div class="bg-blue disabled color-palette">
                            <span>
                                @lang('general.total') : {{$count_total}}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="box-body">
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('company_wallet.client')</th>
                        <th>@lang('company_wallet.company')</th>
                        <th>@lang('company_wallet.amount')</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($wallets))
                    @foreach ($wallets as $key=>$wallet)
                    <tr>
                        <td> {{$key+1}} </td>
                        <td> {{$wallet->client->name}} </td>
                        <td> {{$wallet->company ? $wallet->company->name : ''}} </td>
                        <td> {{$wallet->amount}}  @lang('general.sar')</td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>

            <div class="box-footer clearfix">
                <ul class="pagination pagination-sm no-margin pull-right">
                    {{ $wallets->appends($_GET)->render('pagination::bootstrap-4') }}
                </ul>
            </div>
        </div>
    </div>
</section>
