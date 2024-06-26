<section class="content">

    <div class="box box-info">
        @include('Client.Report.EmployeeRating.Views.print')

        <div class="no-print"> @include('Client/TableFilter/employee_rating_report')</div>

        <div class="box-header no-print">
            <h3 class="box-title col-md-8">@lang('employee_rating.page_title')</h3>
            <div class="col-md-4">

                <button class="btn bg-navy margin" style="height:25px;padding:2px;width:70px;" onclick="PrintElem()">
                    <i class="fa fa-print"></i>
                </button>

            </div>
        </div>

        <div class="box">
            <div class="box-body no-print">
                <div class="col-sm-4 col-md-2">
                    <div class="color-palette-set">
                        <div class="bg-blue disabled color-palette">
                            <span>
                                @lang('general.total') : {{ $total_good_count + $total_bad_count }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-md-2">
                    <div class="color-palette-set">
                        <div class="bg-green disabled color-palette">
                            <span>
                                @lang('employee_rating.total_good_count') : {{ $total_good_count }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-md-2">
                    <div class="color-palette-set">
                        <div class="bg-red disabled color-palette">
                            <span>
                                @lang('employee_rating.total_bad_count') : {{ $total_bad_count }}
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
                        <th style="background-color: #1fbdd9 !important;" class="no-print">#</th>
                        <th style="background-color: #1fbdd9 !important;">@lang('employee_rating.payer_name')</th>
                        <th style="background-color: #1fbdd9 !important;">@lang('employee_rating.employee')</th>
                        <th style="background-color: #1fbdd9 !important;">@lang('employee_rating.available_rating')</th>
                        <th style="background-color: #1fbdd9 !important;">@lang('employee_rating.rating_value')</th>
                        <th style="background-color: #1fbdd9 !important;">@lang('employee_rating.created_at')</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($employee_ratings))
                    @foreach ($employee_ratings as $key => $employee_rating)
                    <tr>
                        <td> {{ $key + 1 }} </td>
                        <td> {{$employee_rating->payer_name}} <br> {{$employee_rating->payer_phone}} </td>
                        <td> {{ $employee_rating->employee ? $employee_rating->employee->name : '' }} </td>
                        <td> {{ $employee_rating->employeeAvailableRating ? $employee_rating->employeeAvailableRating->name : '' }}
                        </td>
                        <td>
                            {!! $employee_rating->rating_value === 1
                            ? '<label class="label label-danger" style="font-size:12px">' . Lang::get('employee_rating.bad') . '</label>'
                            : '<label class="label label-success" style="font-size:12px">' . Lang::get('employee_rating.good') . '</label>' !!}
                        </td>
                        <td> {{ $employee_rating->created_at }} </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            <div class="box-footer clearfix">
                <ul class="pagination pagination-sm no-margin pull-right">
                    {{ $employee_ratings->appends($_GET)->render('pagination::bootstrap-4') }}
                </ul>
            </div>
        </div>
    </div>
</section>
