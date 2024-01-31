<section class="content">

    <div class="row">
        <div class="col-xs-12">

            <!-- filter -->
            <div class="box box-warning">
                <div class="box-body">
                    <form role="form" action="{{url('admin/governorates-search-all')}}" method="GET">

                        <div class="row">
                            <div class="col-sm-4 col-md-4">
                                <div class="input-group margin">
                                    <input type="text" class="form-control" name="query_string" value="{{Request('query_string')}}" placeholder="{{Lang::get('filter.query_string')}}">
                                    <span class="input-group-btn">
                                        <button type="submit" name="search" id="search-btn" class="btn btn-flat bg-orange">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-4 col-md-4">
                                <div class="input-group margin">
                                    <select class="form-control select2" name="active">
                                        <option value="" {{Request('active') == "" ? "selected" : "";}}>@lang('filter.all')</option>
                                        <option value="active" {{Request('active') == "active" ? "selected" : "";}}>@lang('filter.active')</option>
                                        <option value="inactive" {{Request('active') == "inactive" ? "selected" : "";}}>@lang('filter.inactive')</option>
                                    </select>
                                    <span class="input-group-btn">
                                        <button type="submit" name="search" id="search-btn" class="btn btn-flat bg-orange">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-4 col-md-4">
                                <div class="input-group margin">
                                    <select class="form-control select2" name="country_id">
                                        <option value="">@lang('filter.countries')</option>
                                        @foreach($countries as $country)
                                        <?php $selected = Request('country_id') == $country->id ? "selected" : ""; ?>
                                        <option value="{{$country->id}}" {{$selected}}>{{$country->name}}</option>
                                        @endforeach
                                    </select>
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
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title col-md-8">@lang('governorate.page_title')</h3>
                    <div class="col-md-4">
                        <a href="{{url('admin/governorate/create?country_id='.Request('country_id'))}}" class="btn bg-olive btn-sm" style="height:25px;padding:2px;width:150px">
                            <i class="fa fa-plus"></i>
                            <span>@lang('governorate.create')</span>
                        </a>
                    </div>
                </div>

                <div class="box">
                    <div class="box-body">
                        <div class="col-sm-4 col-md-2">
                            <div class="color-palette-set">
                                <div class="bg-blue disabled color-palette">
                                    <span>
                                        @lang('general.active') : {{$count_active + $count_inactive}}
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
                                <th>@lang('governorate.name')</th>
                                <th>@lang('governorate.country')</th>
                                <th>@lang('governorate.operations')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($governorates))
                            @foreach ($governorates as $key=>$governorate)
                            <tr>
                                <td> {{$key+1}} </td>
                                <td> {{$governorate->name}} </td>
                                <td> {{$governorate->country->name}} </td>
                                <td>
                                    <a href="{{url('admin/governorate/edit/'.$governorate->id)}}" class="btn btn-info btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    @if($governorate->stopped_at == null)
                                    <a href="{{url('admin/governorate-inactive/'.$governorate->id)}}" class="btn btn-success btn-sm">
                                        <i class="fa fa-check"></i> @lang('general.active')
                                    </a>
                                    @else

                                    <a href="{{url('admin/governorate-active/'.$governorate->id)}}" class="btn btn-danger btn-sm">
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
                            {{ $governorates->render( "pagination::bootstrap-4") }}
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
