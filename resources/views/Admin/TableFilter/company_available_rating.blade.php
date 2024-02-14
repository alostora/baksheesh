<form role="form" action="{{url('admin/company-available-ratings/search')}}" method="GET">


    <div class="row">

        <div class="col-md-4">
            <div class="form-group">
                <input type="text" class="form-control" name="query_string" value="{{Request('query_string')}}" placeholder="{{Lang::get('filter.query_string')}}">
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
            <div class="input-group">
                <select class="form-control" name="client_id">
                    <option value="">@lang('filter.clients')</option>
                    @foreach ($clients as $client)
                    <?php $selected = Request('client_id') == $client->id ? 'selected' : ''; ?>
                    <option value="{{ $client->id }}" {{ $selected }}>{{ $client->name }}
                    </option>
                    @endforeach
                </select>
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat bg-orange">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </div>

        <div class="clear-fix"></div>
    </div>

</form>


