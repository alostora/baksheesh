<form role="form" action="{{url('admin/users/search')}}" method="GET">
    <div class="row">
        <div class="col-sm-4 col-md-4">
            <div class="form-group">
                <input type="text" class="form-control" name="query_string" value="{{Request('query_string')}}" placeholder="{{Lang::get('filter.query_string')}}">
            </div>
        </div>
        <div class="col-sm-4 col-md-4">
            <div class="form-group">
                <select class="form-control" name="active">
                    <option value="" {{Request('active') == "" ? "selected" : "";}}>@lang('filter.all')</option>
                    <option value="active" {{Request('active') == "active" ? "selected" : "";}}>@lang('filter.active')</option>
                    <option value="inactive" {{Request('active') == "inactive" ? "selected" : "";}}>@lang('filter.inactive')</option>
                </select>
            </div>
        </div>
        <div class="col-sm-4 col-md-4">
            <div class="input-group">
                <select class="form-control" name="user_account_type_id">
                    <option value="">@lang('filter.user_account_type')</option>
                    @foreach($user_account_types as $account_type)
                    <?php $selected = Request('user_account_type_id') == $account_type->id ? "selected" : ""; ?>
                    <option value="{{$account_type->id}}" {{$selected}}>{{ app()->getLocale() == 'en' ? $account_type->name : $account_type->name_ar}}</option>
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
