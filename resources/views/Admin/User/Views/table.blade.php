<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <!-- filter -->
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('user.filter')</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <form role="form" action="{{url('admin/users/search')}}" method="GET">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('user.active')</label>
                                    <select class="form-control select2" name="active">
                                        <option value="" {{Request('active') == "" ? "selected" : "";}}>All</option>
                                        <option value="active" {{Request('active') == "active" ? "selected" : "";}}>Active</option>
                                        <option value="inactive" {{Request('active') == "inactive" ? "selected" : "";}}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('user.user_account_type')</label>
                                    <select class="form-control select2" name="user_account_type_id" style="width: 100%;">
                                        <option value="">@lang('user.select')</option>
                                        @foreach($user_account_types as $account_type)
                                        <?php $selected = Request('user_account_type_id') == $account_type->id ? "selected" : ""; ?>
                                        <option value="{{$account_type->id}}" {{$selected}}>{{$account_type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('user.query_string')</label>
                                    <input type="text" name="query_string" value="{{Request('query_string')}}" class="form-control" style="width: 100%;">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right">Search</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title col-md-8">@lang('user.page_title')</h3>
                    <div class="col-md-4">
                        <a href="{{url('admin/user/create')}}" class="btn btn-primary btn-sm" style="height:25px;padding:2px;width:150px">
                            <i class="fa fa-plus"></i>
                            <span>@lang('user.create')</span>
                        </a>
                    </div>
                </div>

                <div class="box-body">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('user.name')</th>
                                <th>@lang('user.email')</th>
                                <th>@lang('user.phone')</th>
                                <th>@lang('user.withdrawal_requests')</th>
                                <th>@lang('user.operations')</th>
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
                                    @if($user->accountType && $user->accountType->code == \App\Constants\HasLookupType\UserAccountType::CLIENT['code'])
                                    <a href="{{url('admin/client-withdrawal-requests/'.$user->id)}}" class="btn btn-success btn-sm">
                                        <i class="fa fa-info"></i> @lang('user.withdrawal_requests')
                                    </a>
                                    @else
                                    <label class="label label-default">@lang('user.empty')</label>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{url('admin/user/edit/'.$user->id)}}" class="btn btn-success btn-sm">
                                        <i class="fa fa-edit"></i> @lang('user.update')
                                    </a>
                                    @if($user->stopped_at == null)
                                    <a href="{{url('admin/user-inactive/'.$user->id)}}" class="btn btn-success btn-sm">
                                        <i class="fa fa-check"></i>
                                        current status : active
                                    </a>
                                    @else

                                    <a href="{{url('admin/user-active/'.$user->id)}}" class="btn btn-danger btn-sm">
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