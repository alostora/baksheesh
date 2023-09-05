<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <!-- filter -->
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('employee_wallet.filter')</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <form role="form" action="{{url('client/employee-wallets')}}" method="GET">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('employee_wallet.employee')</label>
                                    <select class="form-control select2" name="employee_id" style="width: 100%;">
                                        <option value="">@lang('employee_wallet.select')</option>
                                        @foreach($employees as $employee)
                                        <?php $selected = Request('employee_id') == $employee->id ? "selected" : ""; ?>
                                        <option value="{{$employee->id}}" {{$selected}}>{{$employee->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('employee_wallet.company')</label>
                                    <select class="form-control select2" name="company_id" style="width: 100%;">
                                        <option value="">@lang('employee_wallet.select')</option>
                                        @foreach($companies as $company)
                                        <?php $selected = Request('company_id') == $company->id ? "selected" : ""; ?>
                                        <option value="{{$company->id}}" {{$selected}}>{{$company->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('employee_wallet.date_from')</label>
                                    <input type="date" name="date_from" value="{{Request('date_from')}}" class="form-control" style="width: 100%;">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('employee_wallet.date_to')</label>
                                    <input type="date" name="date_to" value="{{Request('date_to')}}" class="form-control" style="width: 100%;">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right">Search</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title col-md-8">@lang('employee_wallet.page_title')</h3>
                    <div class="col-md-4">

                    </div>
                </div>
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('employee_wallet.client')</th>
                                <th>@lang('employee_wallet.company')</th>
                                <th>@lang('employee_wallet.employee')</th>
                                <th>@lang('employee_wallet.amount')</th>
                                <th>@lang('employee_wallet.payer_name')</th>
                                <th>@lang('employee_wallet.payer_email')</th>
                                <th>@lang('employee_wallet.payer_phone')</th>
                                <th>@lang('employee_wallet.notes')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($wallets))
                            @foreach ($wallets as $key=>$wallet)
                            <tr>
                                <td> {{$key+1}} </td>
                                <td> {{$wallet->client->name}} </td>
                                <td> {{$wallet->company->name}} </td>
                                <td> {{$wallet->employee->name}} </td>
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