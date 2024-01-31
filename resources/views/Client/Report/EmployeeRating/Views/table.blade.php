<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <!-- filter -->
            <div class="box box-warning">
                <div class="box-body">
                    <form role="form" action="{{url('client/employee-rating-report')}}" method="GET">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="input-group margin">
                                    <input type="date" name="date_from" value="{{Request('date_from')}}" class="form-control">
                                    <span class="input-group-btn">
                                        <button type="submit" name="search" id="search-btn" class="btn btn-flat bg-orange">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group margin">
                                    <input type="date" name="date_to" value="{{Request('date_to')}}" class="form-control">
                                    <span class="input-group-btn">
                                        <button type="submit" name="search" id="search-btn" class="btn btn-flat bg-orange">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group margin">
                                    <input type="text" name="query_string" value="{{Request('query_string')}}" placeholder="{{Lang::get('filter.query_string')}}" class="form-control">
                                    <span class="input-group-btn">
                                        <button type="submit" name="search" id="search-btn" class="btn btn-flat bg-orange">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
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
                                <th>@lang('employee_rating.payer_name')</th>
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
        </div>
    </div>
</section>
