<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <!-- filter -->
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('company.filter')</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                <form role="form" action="{{url('admin/companies/search')}}" method="GET">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('company.client')</label>
                                    <select class="form-control select2" name="client_id" style="width: 100%;">
                                        <option value="">@lang('company.select')</option>
                                        @foreach($clients as $client)
                                        <?php $selected = Request('client_id') == $client->id ? "selected" : ""; ?>
                                        <option value="{{$client->id}}" {{$selected}}>{{$client->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('company.query_string')</label>
                                    <input type="text" name="query_string" value="{{Request('query_string')}}" placeholder="{{Lang::get('company.query_string')}}" class="form-control" style="width: 100%;">
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
                    <h3 class="box-title col-md-8">@lang('company.page_title')</h3>
                    <div class="col-md-4">
                        <a href="{{url('admin/company-employee/create')}}" class="btn btn-primary btn-sm" style="height:25px;padding:2px;width:150px">
                            <i class="fa fa-plus"></i>
                            <span>@lang('company.create')</span>
                        </a>
                    </div>
                </div>
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('company.name')</th>
                                <th>@lang('company.employees')</th>
                                <th>@lang('company.operations')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($companies))
                            @foreach ($companies as $key=>$company)
                            <tr>
                                <td> {{$key+1}} </td>
                                <td> {{$company->name}} </td>
                                <td>
                                    <a href="{{url('admin/company-employees/search?company_id='.$company->id)}}" class="btn btn-success btn-sm">
                                        <i class="fa fa-info"></i> @lang('company.employees')
                                    </a>
                                </td>
                                <td>
                                    <a href="{{url('admin/company/edit/'.$company->id)}}" class="btn btn-success btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="{{url('admin/company/delete/'.$company->id)}}" class="btn btn-danger btn-sm">
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
                            {{ $companies->render( "pagination::bootstrap-4") }}
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>