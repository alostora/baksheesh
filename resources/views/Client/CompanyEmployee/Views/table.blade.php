<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title col-md-8">@lang('company_employee.page_title')</h3>
                    <div class="col-md-4">
                        <a href="{{url('client/client-company-employee/create?company_id='.Request('company_id'))}}" class="btn btn-primary btn-sm" style="height:25px;padding:2px;width:150px">
                            <i class="fa fa-plus"></i>
                            <span>@lang('company_employee.create')</span>
                        </a>
                    </div>
                </div>
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('company_employee.name')</th>
                                <th>@lang('company_employee.email')</th>
                                <th>@lang('company_employee.phone')</th>
                                <th>@lang('company_employee.operations')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($employees))
                            @foreach ($employees as $key=>$user)
                            <tr>
                                <td> {{$key+1}} </td>
                                <td> {{$user->name}} </td>
                                <td> {{$user->email}} </td>
                                <td> {{$user->phone}} </td>
                                <td>
                                    <a href="{{url('admin/company-employee/edit/'.$user->id)}}" class="btn btn-success btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="{{url('admin/company-employee/delete/'.$user->id)}}" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i>
                                    </a>
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