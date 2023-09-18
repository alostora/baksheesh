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
                    <form role="form" action="{{url('client/employee-rating-report')}}" method="GET">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('filter.rating_value')</label>
                                    <input type="text" name="rating_value" value="{{Request('rating_value')}}" placeholder="{{Lang::get('filter.rating_value')}}" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('filter.date_from')</label>
                                    <input type="date" name="date_from" value="{{Request('date_from')}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('filter.date_to')</label>
                                    <input type="date" name="date_to" value="{{Request('date_to')}}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right">@lang('filter.search')</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="box">
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
                                <th>@lang('employee_rating.created_at')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($employee_ratings))
                            @foreach ($employee_ratings as $key=>$employee_rating)
                            <tr>
                                <td> {{$key+1}} </td>
                                <td> {{$employee_rating->client->name}} </td>
                                <td> {{$employee_rating->company->name}} </td>
                                <td> {{$employee_rating->employee->name}} </td>
                                <td> {{$employee_rating->availableRating->name}} </td>
                                <td> {{$employee_rating->rating_value}} </td>
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
        </div>
    </div>
</section>