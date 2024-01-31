<form role="form" action="{{url('admin/countries/search')}}" method="GET">
    <div class="row">
        <div class="col-sm-6 col-md-6">
            <div class="form-group">
                <input type="text" class="form-control" name="query_string" value="{{Request('query_string')}}" placeholder="{{Lang::get('filter.query_string')}}">
            </div>
        </div>
        <div class="col-sm-6 col-md-6">
            <div class="input-group">
                <select class="form-control" name="active">
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
    </div>
</form>
