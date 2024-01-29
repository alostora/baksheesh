<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <!-- filter -->
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('filter.filter')</h3> <i class="fa fa-filter"></i>

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
                                        <option value="" {{Request('active') == "" ? "selected" : "";}}>@lang('filter.all')</option>
                                        <option value="active" {{Request('active') == "active" ? "selected" : "";}}>@lang('filter.active')</option>
                                        <option value="inactive" {{Request('active') == "inactive" ? "selected" : "";}}>@lang('filter.inactive')</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('filter.query_string')</label>
                                    <input type="text" name="query_string" value="{{Request('query_string')}}" class="form-control" placeholder="{{Lang::get('filter.query_string')}}">
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
                <div class="box">
                    <div class="box-body">
                        <div class="col-sm-4 col-md-2">
                            <div class="color-palette-set">
                                <div class="bg-red disabled color-palette">
                                    <span>
                                        @lang('client.inactive') : {{$users ? $users->where('stopped_at','!=',null)->count() : 0}}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-2">
                            <div class="color-palette-set">
                                <div class="bg-green disabled color-palette">
                                    <span>
                                        @lang('client.active') : {{$users ? $users->where('stopped_at',null)->count() : 0}}
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
                                <th>@lang('client.file')</th>
                                <th>@lang('client.name')</th>
                                <th>@lang('client.email')</th>
                                <th>@lang('client.phone')</th>
                                <th>@lang('client.country')</th>
                                <th>@lang('client.available_companies_count')</th>
                                <th>@lang('client.available_employees_count')</th>
                                <th>@lang('client.operations')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($users))
                            @foreach ($users as $key=>$user)
                            <tr>
                                <td> {{$key+1}} </td>
                                <td>
                                    @if($user->file)
                                    <img src="{{ url('uploads/'.$user->file->new_name)}}" style="height:50px;width:50px;border-radius:50%">
                                    @endif
                                </td>
                                <td> {{$user->name}} </td>
                                <td> {{$user->email}} </td>
                                <td> {{$user->phone}} </td>
                                <td> {{$user->country ? $user->country->name : ""}} </td>
                                <td> {{$user->available_companies_count}} </td>
                                <td> {{$user->available_employees_count}} </td>
                                <td>

                                    <a href="{{url('admin/companies/search?client_id='.$user->id)}}" class="btn btn-success btn-sm">
                                        <i class="fa fa-info"></i> @lang('client.companies') : ( {{$user->companies->count()}} )
                                    </a>

                                    <a href="{{url('admin/all-client-withdrawal-requests/search?client_id='.$user->id)}}" class="btn btn-success btn-sm">
                                        <i class="fa fa-info"></i> @lang('client.withdrawal_requests')
                                    </a>

                                    <a href="{{url('admin/client/edit/'.$user->id)}}" class="btn btn-success btn-sm">
                                        <i class="fa fa-edit"></i> @lang('client.update')
                                    </a>

                                    @if($user->stopped_at == null)
                                    <a href="{{url('admin/client-inactive/'.$user->id)}}" class="btn btn-success btn-sm">
                                        <i class="fa fa-check"></i>
                                        @lang('general.current_status') : @lang('general.active')
                                    </a>
                                    @else
                                    <a href="{{url('admin/client-active/'.$user->id)}}" class="btn btn-danger btn-sm">
                                        <i class="fa fa-close"></i>
                                        @lang('general.current_status') : @lang('general.inactive')
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
