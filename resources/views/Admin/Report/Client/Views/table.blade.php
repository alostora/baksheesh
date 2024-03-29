<section class="content">

    <div class="box box-info">

        @include('Admin.Report.Client.Views.print')
        <!-- filter -->
        <div class="no-print">@include('Admin/TableFilter/client_report')</div>

        <div class="box-header no-print">
            <h3 class="box-title col-md-8">@lang('client.page_title')</h3>

            <a href="{{url('admin/client/create')}}" class="btn bg-purple margin" style="height:25px;padding:2px;width:150px;">
                <i class="fa fa-plus"></i>
                <span>@lang('client.create')</span>
            </a>

            {{--
            <button class="btn bg-navy margin" style="height:25px;padding:2px;width:70px;" onclick="PrintElem()">
                <i class="fa fa-print"></i>
            </button>
--}}
        </div>
        <div class="box box-success no-print">
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
                        <th style="background-color: #1fbdd9 !important;">#</th>
                        <th style="background-color: #1fbdd9 !important;">@lang('client.name')</th>
                        <th style="background-color: #1fbdd9 !important;">@lang('client.companies')</th>
                        <th style="background-color: #1fbdd9 !important;">@lang('client.employees')</th>
                        <th style="background-color: #1fbdd9 !important;">@lang('client.created_at')</th>
                        <th style="background-color: #1fbdd9 !important;">@lang('client.stopped_at')</th>
                        <th style="background-color: #1fbdd9 !important;">@lang('client.collected_cash')</th>
                        <th style="background-color: #1fbdd9 !important;">@lang('client.delivered_cash')</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($users))
                    @foreach ($users as $key=>$user)
                    <tr>
                        <td> {{$key+1}} </td>
                        <td> {{$user->name}} </td>
                        <td> {{$user->companies()->count()}} </td>
                        <td> {{$user->employees()->count()}} </td>
                        <td> {{$user->created_at}} </td>
                        <td> {{$user->stopped_at}} </td>
                        <td> {{$user->clientEmployeeCash()->sum('amount') + $user->clientCompanyCash()->sum('amount')}} </td>
                        <td> {{$user->acceptedWithdrawal()->sum('amount')}} </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            <div class="box-footer clearfix">
                <ul class="pagination pagination-sm no-margin pull-right">
                    {{ $users->appends($_GET)->render('pagination::bootstrap-4') }}
                </ul>
            </div>
        </div>
    </div>
</section>

