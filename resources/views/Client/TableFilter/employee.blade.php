<form role="form" action="{{url('client/client-company-employees/search')}}" method="GET">

    <div class="row">

        <div class="col-md-4">
            <div class="input-group">
                <input type="text" class="form-control" name="query_string" value="{{Request('query_string')}}" placeholder="{{Lang::get('filter.query_string')}}">

                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat bg-orange">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <select class="form-control" name="active">
                    <option value="" {{Request('active') == "" ? "selected" : "";}}>@lang('filter.all')</option>
                    <option value="active" {{Request('active') == "active" ? "selected" : "";}}>@lang('filter.active')</option>
                    <option value="inactive" {{Request('active') == "inactive" ? "selected" : "";}}>@lang('filter.inactive')</option>
                </select>

            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <select class="form-control" name="company_id" id="company_id">
                    <option value="">@lang('filter.companies')</option>
                    @foreach ($companies as $company)
                    <?php $selected = Request('company_id') == $company->id ? 'selected' : ''; ?>
                    <option value="{{ $company->id }}" {{ $selected }}>{{ $company->name }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="clear-fix"></div>
    </div>

</form>
