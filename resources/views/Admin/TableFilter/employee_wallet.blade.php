<form role="form" action="{{ url('admin/employee-wallets') }}" method="GET">

    <div class="row">
        <div class="col-sm-4 col-md-4">
            <div class="form-group">
                <input type="text" class="form-control" name="query_string" value="{{Request('query_string')}}" placeholder="{{Lang::get('filter.query_string')}}">

            </div>
        </div>

        <div class="col-sm-4 col-md-4">
            <div class="form-group">
                <input type="date" name="date_from" value="{{Request('date_from')}}" class="form-control">
            </div>
        </div>

        <div class="col-sm-4 col-md-4">
            <div class="form-group">
                <input type="date" name="date_to" value="{{Request('date_to')}}" class="form-control">
            </div>
        </div>

        <div class="col-sm-4 col-md-4">
            <div class="form-group">
                <select class="form-control" name="client_id" onchange="getCompenies(this.value)">
                    <option value="">@lang('filter.clients')</option>
                    @foreach($clients as $client)
                    <?php $selected = Request('client_id') == $client->id ? "selected" : ""; ?>
                    <option value="{{$client->id}}" {{$selected}}>{{$client->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-4 col-md-4">
            <div class="form-group">
                <select class="form-control" name="company_id" id="company_id" onchange="getCompenyEmployees(this.value)">
                    <option value="">@lang('filter.companies')</option>
                    @foreach($companies as $company)
                    <?php $selected = Request('company_id') == $company->id ? "selected" : ""; ?>
                    <option value="{{$company->id}}" {{$selected}}>{{$company->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-sm-4 col-md-4">
            <div class="input-group">
                <select class="form-control" name="employee_id" id="employee_id">
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
    </div>
</form>

@include('Admin/TableFilter/filter_scripts')
