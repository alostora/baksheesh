<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <!-- filter -->
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('filter.filter')</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <form role="form" action="{{ url('client/employee-wallets') }}" method="GET">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('filter.companies')</label>
                                    <select class="form-control select2" name="company_id" id="company_id" onchange="getEmployees(this.value);">
                                        <option value="">@lang('filter.select')</option>
                                        @foreach ($companies as $company)
                                        <?php $selected = Request('company_id') == $company->id ? 'selected' : ''; ?>
                                        <option value="{{ $company->id }}" {{ $selected }}>{{ $company->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('filter.employees')</label>
                                    <select class="form-control select2" name="employee_id" id="employee_id">
                                        <option value="">@lang('filter.select')</option>
                                        @foreach ($employees as $employee)
                                        <?php $selected = Request('employee_id') == $employee->id ? 'selected' : ''; ?>
                                        <option value="{{ $employee->id }}" {{ $selected }}>
                                            {{ $employee->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('filter.date_from')</label>
                                    <input type="date" name="date_from" value="{{ Request('date_from') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('filter.date_to')</label>
                                    <input type="date" name="date_to" value="{{ Request('date_to') }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right">@lang('filter.search')</button>
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
                                <th>@lang('employee_wallet.created_at')</th>
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
                                <td> {{$wallet->created_at}} </td>
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

<script>
    function getEmployees(company_id = "") {

        $.ajax({

            url: '{{url("client/employees?company_id=")}}' + company_id,
            type: 'GET',
            data: {},
            dataType: 'json',
            success: function(response) {

                let result = response.data;

                $("#employee_id").html(`<option value=''>@lang('filter.select')</option>`)

                for (let i = 0; i < result.length; i++) {

                    $("#employee_id").append(`<option value='${result[i].id}'>${result[i].name}</option>`)

                }
            },
            error: function(request, error) {
                console.log("Request: " + JSON.stringify(request));
            }
        });
    }
</script>