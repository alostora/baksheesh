<section class="content">

    <div class="box box-info">

        @include('Client/TableFilter/employee_rating_report')

        <div class="box-header">
            <h3 class="box-title col-md-8">@lang('employee_rating.page_title')</h3>
            <div class="col-md-4">

            </div>
        </div>
        <div class="box-body">
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('employee_rating.client')</th>
                        <th>@lang('employee_rating.company')</th>
                        <th>@lang('employee_rating.employee')</th>
                        <th>@lang('employee_rating.available_rating')</th>
                        <th>@lang('employee_rating.rating_value')</th>
                        <th>@lang('employee_rating.payer_name')</th>
                        <th>@lang('employee_rating.created_at')</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($employee_ratings))
                    @foreach ($employee_ratings as $key=>$employee_rating)
                    <tr>
                        <td> {{$key+1}} </td>
                        <td> {{$employee_rating->client ? $employee_rating->client->name : ''}} </td>
                        <td> {{$employee_rating->company ? $employee_rating->company->name : ''}} </td>
                        <td> {{$employee_rating->employee ? $employee_rating->employee->name : ''}} </td>
                        <td> {{$employee_rating->availableRating ? $employee_rating->availableRating->name : ''}} </td>
                        <td>
                            {!! $employee_rating->rating_value === 1 ? '<label class="label label-danger" style="font-size:12px">bad</label>' : '<label class="label label-success" style="font-size:12px">good</label>' !!}
                        </td>
                        <td> {{$employee_rating->payer_name}} </td>
                        <td> {{$employee_rating->created_at}} </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            <div class="box-footer clearfix">
                <ul class="pagination pagination-sm no-margin pull-right">
                    {{ $employee_ratings->render( "pagination::bootstrap-4") }}
                </ul>
            </div>

        </div>
    </div>

</section>
