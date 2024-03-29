<section class="content">
    <div class="box box-info">
        <!-- filter -->
        @include('Admin/TableFilter/user')
        <div class="box-header">
            <h3 class="box-title col-md-8">@lang('user.page_title')</h3>
            <div class="col-md-4">
                <a href="{{url('admin/user/create')}}" class="btn bg-olive btn-sm" style="height:25px;padding:2px;width:150px">
                    <i class="fa fa-plus"></i>
                    <span>@lang('user.create')</span>
                </a>
            </div>
        </div>

        <div class="box box-success">
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
                        <div class="bg-green disabled color-palette">
                            <span>
                                @lang('general.active') : {{$count_active}}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 col-md-2">
                    <div class="color-palette-set">
                        <div class="bg-red disabled color-palette">
                            <span>
                                @lang('general.inactive') : {{$count_inactive}}
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
                        <th>@lang('user.name')</th>
                        <th>@lang('user.email')</th>
                        <th>@lang('user.phone')</th>
                        <th>@lang('user.account_type')</th>
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
                        <td> {{$user->accountType ? $user->accountType->name : ''}} </td>
                        <td>
                            <a href="{{url('admin/user/edit/'.$user->id)}}" class="btn btn-info btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>
                            @if($user->stopped_at == null)
                            <a href="{{url('admin/user-inactive/'.$user->id)}}" class="btn btn-success btn-sm">
                                <i class="fa fa-check"></i> @lang('user.active')
                            </a>
                            @else

                            <a href="{{url('admin/user-active/'.$user->id)}}" class="btn btn-danger btn-sm">
                                <i class="fa fa-close"></i> @lang('user.inactive')
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
                    {{ $users->appends($_GET)->render('pagination::bootstrap-4') }} }}
                </ul>
            </div>
        </div>
    </div>
</section>
