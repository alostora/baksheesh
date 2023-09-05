<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title col-md-8">@lang('wallet.page_title_admins')</h3>
                    <div class="col-md-4">
                        
                    </div>
                </div>
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>@lang('wallet.client')</th>
                                <th>@lang('wallet.company')</th>
                                <th>@lang('wallet.amount')</th>
                                <th>@lang('wallet.payer_name')</th>
                                <th>@lang('wallet.payer_email')</th>
                                <th>@lang('wallet.payer_phone')</th>
                                <th>@lang('wallet.notes')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($wallets))
                            @foreach ($wallets as $key=>$wallet)
                            <tr>
                                <td> {{$wallet->client->name}} </td>
                                <td> {{$wallet->company->name}} </td>
                                <td> {{$wallet->amount}} </td>
                                <td> {{$wallet->payer_name}} </td>
                                <td> {{$wallet->payer_email}} </td>
                                <td> {{$wallet->payer_phone}} </td>
                                <td> {{$wallet->notes}} </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>

                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            {{ $wallets->render( "pagination::bootstrap-4") }}
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>