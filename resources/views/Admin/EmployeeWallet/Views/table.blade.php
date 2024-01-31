<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <!-- filter -->
            <div class="box box-warning">
                <div class="box-body">
                    <form role="form" action="{{ url('admin/employee-wallets') }}" method="GET">

                        <div class="row">
                            <div class="col-sm-3 col-md-3">
                                <div class="input-group margin">
                                    <input type="text" class="form-control" name="query_string" value="{{Request('query_string')}}" placeholder="{{Lang::get('filter.query_string')}}">
                                    <span class="input-group-btn">
                                        <button type="submit" name="search" id="search-btn" class="btn btn-flat bg-orange">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-3 col-md-3">
                                <div class="input-group margin">
                                    <input type="date" name="date_from" value="{{Request('date_from')}}" class="form-control">
                                    <span class="input-group-btn">
                                        <button type="submit" name="search" id="search-btn" class="btn btn-flat bg-orange">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-3 col-md-3">
                                <div class="input-group margin">
                                    <input type="date" name="date_to" value="{{Request('date_to')}}" class="form-control">
                                    <span class="input-group-btn">
                                        <button type="submit" name="search" id="search-btn" class="btn btn-flat bg-orange">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-3 col-md-3">
                                <div class="input-group margin">

                                    <select class="form-control select2" name="employee_id" id="employee_id">
                                        <option value="">@lang('filter.employees')</option>
                                        @foreach ($employees as $employee)
                                        <?php $selected = Request('employee_id') == $employee->id ? 'selected' : ''; ?>
                                        <option value="{{ $employee->id }}" {{ $selected }}>
                                            {{ $employee->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <span class="input-group-btn">
                                        <button type="submit" name="search" id="search-btn" class="btn btn-flat bg-orange">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-3 col-md-3">
                                <div class="input-group margin">
                                    <select class="form-control select2" name="client_id">
                                        <option value="">@lang('filter.clients')</option>
                                        @foreach($clients as $client)
                                        <?php $selected = Request('client_id') == $client->id ? "selected" : ""; ?>
                                        <option value="{{$client->id}}" {{$selected}}>{{$client->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="input-group-btn">
                                        <button type="submit" name="search" id="search-btn" class="btn btn-flat bg-orange">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-3 col-md-3">
                                <div class="input-group margin">
                                    <select class="form-control select2" name="company_id" id="company_id">
                                        <option value="">@lang('filter.companies')</option>
                                        @foreach($companies as $company)
                                        <?php $selected = Request('company_id') == $company->id ? "selected" : ""; ?>
                                        <option value="{{$company->id}}" {{$selected}}>{{$company->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="input-group-btn">
                                        <button type="submit" name="search" id="search-btn" class="btn btn-flat bg-orange">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title col-md-8">@lang('employee_wallet.page_title')</h3>
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
                                <th>@lang('employee_wallet.client')</th>
                                <th>@lang('employee_wallet.company')</th>
                                <th>@lang('employee_wallet.employee')</th>
                                <th>@lang('employee_wallet.amount')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($wallets))
                            @foreach ($wallets as $key => $wallet)
                            <tr>
                                <td> {{ $key + 1 }} </td>
                                <td> {{ $wallet->client->name }} </td>
                                <td> {{ $wallet->company? $wallet->company->name :  $wallet->company_id}} </td>
                                <td> {{ $wallet->employee ? $wallet->employee->name : $wallet->employee_id }} </td>
                                <td> {{ $wallet->amount }} </td>
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
        </div>
    </div>
</section>


<script>
    function getEmployees(client_id = "", company_id = "") {

        $.ajax({

            url: '{{url("admin/employees?client_id=")}}' + client_id + '&company_id=' + company_id,
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

    function getCompanies(client_id) {

        $.ajax({

            url: '{{url("admin/companies/all?client_id=")}}' + client_id,
            type: 'GET',
            data: {},
            dataType: 'json',
            success: function(response) {

                let result = response.data;

                $("#company_id").html(`<option value=''>@lang('filter.select')</option>`)

                for (let i = 0; i < result.length; i++) {

                    $("#company_id").append(`<option value='${result[i].id}'>${result[i].name}</option>`);
                    console.log(result[i]);


                }
            },
            error: function(request, error) {
                console.log("Request: " + JSON.stringify(request));
            }
        });
    }
</script>
