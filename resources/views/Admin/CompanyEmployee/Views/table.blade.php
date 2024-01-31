<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <!-- filter -->
            <div class="box box-warning">
                <div class="box-body">
                    <form role="form" action="{{url('admin/company-employees/search')}}" method="GET">

                        <div class="row">

                            <div class="col-sm-6 col-md-6">
                                <div class="input-group margin">
                                    <input type="text" class="form-control" name="query_string" value="{{Request('query_string')}}" placeholder="{{Lang::get('filter.query_string')}}">
                                    <span class="input-group-btn">
                                        <button type="submit" name="search" id="search-btn" class="btn btn-flat bg-orange">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group margin">
                                    <select class="form-control select2" name="active">
                                        <option value="" {{Request('active') == "" ? "selected" : "";}}>@lang('filter.all')</option>
                                        <option value="active" {{Request('active') == "active" ? "selected" : "";}}>@lang('filter.active')</option>
                                        <option value="inactive" {{Request('active') == "inactive" ? "selected" : "";}}>@lang('filter.inactive')</option>
                                    </select>
                                    <span class="input-group-btn">
                                        <button type="submit" name="search" id="search-btn" class="btn btn-flat bg-orange">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group margin">
                                    <select class="form-control select2" name="client_id" onchange="getEmployees(this.value);getCompanies(this.value)">
                                        <option value="">@lang('filter.clients')</option>
                                        @foreach ($clients as $client)
                                        <?php $selected = Request('client_id') == $client->id ? 'selected' : ''; ?>
                                        <option value="{{ $client->id }}" {{ $selected }}>{{ $client->name }}
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

                            <div class="col-md-6">
                                <div class="input-group margin">
                                    <select class="form-control select2" name="company_id" id="company_id" onchange="getEmployees('',this.value);">
                                        <option value="">@lang('filter.companies')</option>
                                        @foreach ($companies as $company)
                                        <?php $selected = Request('company_id') == $company->id ? 'selected' : ''; ?>
                                        <option value="{{ $company->id }}" {{ $selected }}>{{ $company->name }}
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
                </div>
            </div>

            <div class="box box-promary">
                <div class="box-header">
                    <h3 class="box-title col-md-8">@lang('company_employee.page_title')</h3>
                    <div class="col-md-4">
                        <a href="{{url('admin/company-employee/create?company_id='.Request('company_id'))}}" class="btn bg-olive btn-sm" style="height:25px;padding:2px;width:150px">
                            <i class="fa fa-plus"></i>
                            <span>@lang('company_employee.create')</span>
                        </a>
                    </div>
                </div>

                <div class="box">
                    <div class="box-body">
                        <div class="col-sm-4 col-md-2">
                            <div class="color-palette-set">
                                <div class="bg-red disabled color-palette">
                                    <span>
                                        @lang('company_employee.inactive') : {{$count_inactive}}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-2">
                            <div class="color-palette-set">
                                <div class="bg-green disabled color-palette">
                                    <span>
                                        @lang('company_employee.active') : {{$count_active}}
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
                                <th>@lang('company_employee.qr')</th>
                                <th>@lang('company_employee.file')</th>
                                <th>@lang('company_employee.name')</th>
                                <th>@lang('company_employee.phone')</th>
                                <th>@lang('company_employee.employee_job_name')</th>
                                <th>@lang('company_employee.country')</th>
                                <th>@lang('company_employee.operations')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($employees))
                            @foreach ($employees as $key=>$user)
                            <tr>
                                <td> {{$key+1}} </td>
                                <td onclick="PrintElem('{{$user->name}}','{{$user->id}}')">
                                    <div id="{{$user->id}}">
                                        {!! $user->employee_qr !!}
                                    </div>
                                </td>
                                <td>
                                    @if($user->file)
                                    <img src="{{ url('uploads/'.$user->file->new_name)}}" style="height:40px;width:40px;border-radius:50%">
                                    @endif
                                </td>
                                <td> {{$user->name}} </td>
                                <td> {{$user->phone}} </td>
                                <td> {{$user->employee_job_name}} </td>
                                <td> {{$user->country ? $user->country->name : ""}} </td>
                                <td>
                                    <a href="{{url('admin/company-employee/edit/'.$user->id)}}" class="btn btn-info btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <a href="{{url('guest/payment/pay-for-employee/'.$user->id)}}" target="_blank" class="btn bg-purple btn-sm">
                                        <i class="fa fa-link"></i>
                                    </a>

                                    <a href="{{url('admin/employee-wallets?client_id='.$user->client_id.'&company_id='.$user->company_id)}}" class="btn bg-purple btn-sm">
                                        <i class="fa fa-info"></i> @lang('general.wallet') : ( {{$user->employeeCash->sum('amount')}} )
                                    </a>

                                    @if($user->stopped_at == null)
                                    <a href="{{url('admin/company-employee-inactive/'.$user->id)}}" class="btn btn-success btn-sm">
                                        <i class="fa fa-check"></i> @lang('company.active')
                                    </a>
                                    @else

                                    <a href="{{url('admin/company-employee-active/'.$user->id)}}" class="btn btn-danger btn-sm">
                                        <i class="fa fa-close"></i> @lang('company.inactive')
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>

                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            {{ $employees->render( "pagination::bootstrap-4") }}
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>


<script>
    function PrintElem(userName, userId) {

        var mywindow = window.open('', 'PRINT', 'height=400,width=600');

        mywindow.document.write('<html><head><title>' + userName + '</title>');
        mywindow.document.write('</head><body >');
        mywindow.document.write('<h1>' + userName + '</h1>');
        mywindow.document.write(document.getElementById(userId).innerHTML);
        mywindow.document.write('</body></html>');

        mywindow.focus(); // necessary for IE >= 10*/

        mywindow.print();

        return true;
    }
</script>
