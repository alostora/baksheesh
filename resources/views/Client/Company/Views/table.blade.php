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
                    <form role="form" action="{{url('client/client-companies/search')}}" method="GET">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('filter.active')</label>
                                    <select class="form-control select2" name="active" style="width: 100%;">
                                        <option value="" {{Request('active') == "" ? "selected" : "";}}>All</option>
                                        <option value="active" {{Request('active') == "1" ? "selected" : "";}}>Active</option>
                                        <option value="inactive" {{Request('active') == "0" ? "selected" : "";}}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('filter.query_string')</label>
                                    <input type="text" name="query_string" value="{{Request('query_string')}}" placeholder="{{Lang::get('filter.query_string')}}" class="form-control" style="width: 100%;">
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
                        <a href="{{url('client/client-company/create')}}" class="btn btn-primary btn-sm" style="height:25px;padding:2px;width:150px">
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
                                <th>@lang('company.file')</th>
                                <th>@lang('company.name')</th>
                                <th>@lang('company.employees')</th>
                                <th>@lang('company.demo_link')</th>
                                <th>@lang('company.qr')</th>
                                <th>@lang('company.operations')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($companies))
                            @foreach ($companies as $key=>$company)
                            <tr>
                                <td> {{$key+1}} </td>
                                <td>
                                    @if($company->file)
                                    <img src="{{ url('uploads/'.$company->file->new_name)}}" style="height:50px;width:50px;border-radius:50%">
                                    @endif
                                </td>
                                <td> {{$company->name}} </td>
                                <td>
                                    <a href="{{url('client/client-company-employees/search?company_id='.$company->id)}}" class="btn btn-success btn-sm">
                                        <i class="fa fa-info"></i> @lang('company.employees')
                                    </a>
                                </td>

                                <td>
                                    <a href="{{url('guest/payment/pay-for-company/'.$company->id)}}" target="_blank" class="btn btn-success btn-sm">
                                        <i class="fa fa-link"></i>
                                    </a>
                                </td>
                                <td>
                                    <canvas id="{{$company->id}}"></canvas>
                                    <script type="text/javascript">
                                        new QRious({
                                            element: document.getElementById("{{$company->id}}"),
                                            value: "{{url('guest/payment/pay-for-company/'.$company->id)}}"
                                        });
                                    </script>

                                </td>

                                <td>
                                    <a href="{{url('client/client-company/edit/'.$company->id)}}" class="btn btn-success btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    @if($company->stopped_at == null)
                                    <a href="{{url('client/client-company-inactive/'.$company->id)}}" class="btn btn-success btn-sm">
                                        <i class="fa fa-check"></i> current status : active
                                    </a>
                                    @else

                                    <a href="{{url('client/client-company-active/'.$company->id)}}" class="btn btn-danger btn-sm">
                                        <i class="fa fa-close"></i> current status : Inactive at {{$company->stopped_at}}
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
                            {{ $companies->render( "pagination::bootstrap-4") }}
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>