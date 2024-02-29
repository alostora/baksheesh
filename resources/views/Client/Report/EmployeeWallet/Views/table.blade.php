<section class="content">
    <div class="box box-info">
        @include('Client.Report.EmployeeWallet.Views.print')

        <div class="no-print"> @include('Client/TableFilter/employee_wallet_report')</div>
        <div class="box-header no-print">
            <h3 class="box-title col-md-8">@lang('employee_wallet.page_title')</h3>
            <div class="col-md-4">

                <button class="btn bg-navy margin" style="height:25px;padding:2px;width:70px;" onclick="PrintElem()">
                    <i class="fa fa-print"></i>
                </button>

            </div>
        </div>
        <div class="box">
            <div class="box-body no-print">
                <div class="col-sm-4 col-md-2">
                    <div class="color-palette-set">
                        <div class="bg-blue disabled color-palette">
                            <span>
                                @lang('general.total') : {{ $count_total }}
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
                        <th style="background-color: #1fbdd9 !important;">#</th>
                        <th style="background-color: #1fbdd9 !important;">@lang('employee_wallet.company')</th>
                        <th style="background-color: #1fbdd9 !important;">@lang('employee_wallet.employee')</th>
                        <th style="background-color: #1fbdd9 !important;">@lang('employee_wallet.amount')</th>
                        <th style="background-color: #1fbdd9 !important;">@lang('employee_wallet.created_at')</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($wallets))
                    @foreach ($wallets as $key => $wallet)
                    <tr>
                        <td> {{ $key + 1 }} </td>
                        <td> {{ $wallet->company ? $wallet->company->name : '' }} </td>
                        <td> {{ $wallet->employee ? $wallet->employee->name : '' }} </td>
                        <td> {{ $wallet->amount }} @lang('general.sar')</td>
                        <td> {{ $wallet->created_at }} </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            <div class="box-footer clearfix">
                <ul class="pagination pagination-sm no-margin pull-right">
                    {{ $wallets->render('pagination::bootstrap-4') }}
                </ul>
            </div>

        </div>
    </div>
</section>

