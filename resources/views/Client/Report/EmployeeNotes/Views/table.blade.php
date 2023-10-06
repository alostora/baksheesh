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
                    <form role="form" action="{{url('client/employee-notes-report')}}" method="GET">
                        <div class="row">

                            <div class="form-group">
                                <div class="col-md-6">
                                    <label>@lang('filter.date_from')</label>
                                    <input type="date" name="date_from" value="{{Request('date_from')}}" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label>@lang('filter.date_to')</label>
                                    <input type="date" name="date_to" value="{{Request('date_to')}}" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('filter.query_string')</label>
                                    <input type="text" name="query_string" value="{{Request('query_string')}}" placeholder="{{Lang::get('filter.query_string')}}" class="form-control">
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
                    <h3 class="box-title col-md-8">@lang('employee_notes.page_title')</h3>
                    <div class="col-md-4">

                    </div>
                </div>
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('employee_notes.payer_name')</th>
                                <th>@lang('employee_notes.client')</th>
                                <th>@lang('employee_notes.notes')</th>
                                <th>@lang('employee_notes.created_at')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($employee_notes))
                            @foreach ($employee_notes as $key=>$employee_note)
                            <tr>
                                <td> {{$key+1}} </td>
                                <td> {{$employee_note->payer_name}} </td>
                                <td> {{$employee_note->client->name}} </td>
                                <td> {{$employee_note->notes}} </td>
                                <td> {{$employee_note->created_at}} </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            {{ $employee_notes->render( "pagination::bootstrap-4") }}
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>