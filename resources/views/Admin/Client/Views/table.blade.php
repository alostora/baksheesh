<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <!-- filter -->
            @include('Admin/TableFilter/client')

            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title col-md-8">@lang('client.page_title')</h3>
                    <div class="col-md-4">
                        <a href="{{url('admin/client/create')}}" class="btn bg-olive btn-sm" style="height:25px;padding:2px;width:150px">
                            <i class="fa fa-plus"></i>
                            <span>@lang('client.create')</span>
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
                                <div class="bg-green disabled color-palette">
                                    <span>
                                        @lang('client.active') : {{$count_active}}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 col-md-2">
                            <div class="color-palette-set">
                                <div class="bg-red disabled color-palette">
                                    <span>
                                        @lang('client.inactive') : {{$count_inactive}}
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
                                <td> {{$user->phone}} </td>
                                <td> {{$user->country ? $user->country->name : ""}} </td>
                                <td> {{$user->available_companies_count}} </td>
                                <td> {{$user->available_employees_count}} </td>
                                <td>

                                    <a href="{{url('admin/client/edit/'.$user->id)}}" class="btn btn-info btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <a href="{{url('admin/companies/search?client_id='.$user->id)}}" class="btn  bg-purple btn-sm">
                                        <i class="fa fa-info"></i> @lang('client.companies') : ( {{$user->companies->count()}} )
                                    </a>

                                    <a href="{{url('admin/all-client-withdrawal-requests/search?client_id='.$user->id)}}" class="btn bg-purple btn-sm">
                                        <i class="fa fa-info"></i> @lang('client.withdrawal_requests')
                                    </a>

                                    @if($user->stopped_at == null)
                                    <a href="{{url('admin/client-inactive/'.$user->id)}}" class="btn btn-success btn-sm">
                                        <i class="fa fa-check"></i> @lang('general.active')
                                    </a>
                                    @else
                                    <a href="{{url('admin/client-active/'.$user->id)}}" class="btn btn-danger btn-sm">
                                        <i class="fa fa-close"></i> @lang('general.inactive')
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
