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
                    <form role="form" action="{{url('admin/clients/search')}}" method="GET">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('filter.active')</label>
                                    <select class="form-control select2" name="active">
                                        <option value="" {{Request('active') == "" ? "selected" : "";}}>All</option>
                                        <option value="active" {{Request('active') == "active" ? "selected" : "";}}>Active</option>
                                        <option value="inactive" {{Request('active') == "inactive" ? "selected" : "";}}>Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('filter.query_string')</label>
                                    <input type="text" name="query_string" value="{{Request('query_string')}}" class="form-control" style="width: 100%;">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right">@lang('filter.search')</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title col-md-8">@lang('client.page_title')</h3>
                    <div class="col-md-4">
                        <a href="{{url('admin/client/create')}}" class="btn btn-primary btn-sm" style="height:25px;padding:2px;width:150px">
                            <i class="fa fa-plus"></i>
                            <span>@lang('client.create')</span>
                        </a>
                    </div>
                </div>

                <div class="box-body">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('client.name')</th>
                                <th>@lang('client.email')</th>
                                <th>@lang('client.phone')</th>
                                <th>@lang('client.withdrawal_requests')</th>
                                <th>@lang('client.operations')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($users))
                            @foreach ($users as $key=>$user)
                            <tr>
                                <td> {{$key+1}} </td>
                                <td> {{$user->name}} </td>
                                <td> {{$user->email}} </td>
                                <td> {{$user->phone}} </td>
                                <td>
                                    <a href="{{url('admin/client-withdrawal-requests/'.$user->id)}}" class="btn btn-success btn-sm">
                                        <i class="fa fa-info"></i> @lang('client.withdrawal_requests')
                                    </a>
                                </td>
                                <td>
                                    <a href="{{url('admin/client/edit/'.$user->id)}}" class="btn btn-success btn-sm">
                                        <i class="fa fa-edit"></i> @lang('client.update')
                                    </a>
                                    @if($user->stopped_at == null)
                                    <a href="{{url('admin/client-inactive/'.$user->id)}}" class="btn btn-success btn-sm">
                                        <i class="fa fa-check"></i>
                                        current status : active
                                    </a>
                                    @else

                                    <a href="{{url('admin/client-active/'.$user->id)}}" class="btn btn-danger btn-sm">
                                        <i class="fa fa-close"></i>
                                        current status : Inactive at {{$user->stopped_at}}
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
                            {{ $users->render( "pagination::bootstrap-4") }}
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>