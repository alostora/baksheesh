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
                    <form role="form" action="{{url('admin/countries/search')}}" method="GET">
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
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title col-md-8">@lang('country.page_title')</h3>
                    <div class="col-md-4">
                        <a href="{{url('admin/country/create')}}" class="btn btn-primary btn-sm" style="height:25px;padding:2px;width:150px">
                            <i class="fa fa-plus"></i>
                            <span>@lang('country.create')</span>
                        </a>
                    </div>
                </div>
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('country.name')</th>
                                <th>@lang('country.governorates')</th>
                                <th>@lang('country.operations')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($countries))
                            @foreach ($countries as $key=>$country)
                            <tr>
                                <td> {{$key+1}} </td>
                                <td> {{$country->name}} </td>
                                <td>
                                    <a href="{{url('admin/governorates-search-all/?country_id='.$country->id)}}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-edit"></i> @lang('country.governorates')
                                    </a>
                                </td>
                                <td>
                                    <a href="{{url('admin/country/edit/'.$country->id)}}" class="btn btn-success btn-sm">
                                        <i class="fa fa-edit"></i> @lang('country.update')
                                    </a>

                                    @if($country->stopped_at == null)
                                    <a href="{{url('admin/country-inactive/'.$country->id)}}" class="btn btn-success btn-sm">
                                        <i class="fa fa-check"></i> @lang('country.current_status') : @lang('country.active')
                                    </a>
                                    @else

                                    <a href="{{url('admin/country-active/'.$country->id)}}" class="btn btn-danger btn-sm">
                                        <i class="fa fa-close"></i> @lang('country.current_status') : @lang('country.inactive')
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
                            {{ $countries->render( "pagination::bootstrap-4") }}
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>