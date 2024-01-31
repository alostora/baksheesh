<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <!-- filter -->
            <div class="box box-warning">
                <div class="box-body">
                    <form role="form" action="{{url('client/client-company-employees/search')}}" method="GET">
                        <input type="hidden" name="company_id" value="{{Request('company_id')}}">
                        <div class="row">
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
                            <div class="col-sm-4 col-md-4">
                                <div class="input-group margin">
                                    <input type="text" class="form-control" name="query_string" value="{{Request('query_string')}}" placeholder="{{Lang::get('filter.query_string')}}">
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
                                    <select class="form-control select2" name="company_id" id="company_id" onchange="getEmployees('',this.value);">
                                        <option value="">@lang('filter.select')</option>
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

            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title col-md-8">@lang('company_employee.page_title')</h3>
                    <div class="col-md-4">
                        <a href="{{url('client/client-company-employee/create?company_id='.Request('company_id'))}}" class="btn btn-primary btn-sm" style="height:25px;padding:2px;width:150px">
                            <i class="fa fa-plus"></i>
                            <span>@lang('company_employee.create')</span>
                        </a>
                    </div>
                </div>
                <div class="box">
                    <div class="box-body">
                        <div class="col-sm-4 col-md-2">
                            <div class="color-palette-set">
                                <div class="bg-blue disabled color-palette">
                                    <span>
                                        @lang('general.total') : {{$count_inactive + $count_active}}
                                    </span>
                                </div>
                            </div>
                        </div>
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
                                        <img src="{{ url('uploads/'.$user->file->new_name)}}" style="height:50px;width:50px;border-radius:50%">
                                        @endif
                                    </td>
                                    <td> {{$user->name}} </td>
                                    <td> {{$user->phone}} </td>
                                    <td> {{$user->employee_job_name}} </td>
                                    <td> {{$user->country ? $user->country->name : ""}} </td>
                                    <td>
                                        <a href="{{url('client/employee-wallets?company_id='.$user->company_id.'&employee_id='.$user->id)}}" class="btn btn-success btn-sm">
                                            <i class="fa fa-info"></i> @lang('general.wallet') : ( {{$user->employeeCash->sum('amount')}} )
                                        </a>

                                        <a href="{{url('guest/payment/pay-for-employee/'.$user->id)}}" target="_blank" class="btn btn-success btn-sm">
                                            <i class="fa fa-link"></i>
                                        </a>

                                        <a href="{{url('client/client-company-employee/edit/'.$user->id)}}" class="btn btn-success btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        @if($user->stopped_at == null)
                                        <a href="{{url('client/client-company-employee-inactive/'.$user->id)}}" class="btn btn-success btn-sm">
                                            <i class="fa fa-check"></i> current status : active
                                        </a>
                                        @else

                                        <a href="{{url('client/client-company-employee-active/'.$user->id)}}" class="btn btn-danger btn-sm">
                                            <i class="fa fa-close"></i> current status : Inactive at {{$user->stopped_at}}
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

        mywindow.print();

        return true;
    }
</script>
