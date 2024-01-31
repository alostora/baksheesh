<form role="form" action="{{url('admin/all-client-withdrawal-requests/search')}}" method="GET">
    <div class="row">
        <div class="col-sm-4 col-md-4">
            <div class="form-group">
                <input type="text" class="form-control" name="query_string" value="{{Request('query_string')}}" placeholder="{{Lang::get('filter.query_string')}}">
            </div>
        </div>
        <div class="col-sm-4 col-md-4">
            <div class="form-group">
                <select class="form-control" name="status" style="width: 100%;">
                    <option value="">@lang('filter.status')</option>
                    @foreach($withdrawal_request_status as $withdrawal_status)
                    <?php $selected = Request('status') == $withdrawal_status->id ? "selected" : ""; ?>
                    <option value="{{$withdrawal_status->id}}" {{$selected}}>{{app()->getLocale() == 'ar' ? $withdrawal_status->name_ar : $withdrawal_status->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-4 col-md-4">
            <div class="form-group">
                <select class="form-control" name="client_id">
                    <option value="">@lang('filter.clients')</option>
                    @foreach($clients as $client)
                    <?php $selected = Request('client_id') == $client->id ? "selected" : ""; ?>
                    <option value="{{$client->id}}" {{$selected}}>{{$client->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-sm-4 col-md-4">
            <div class="form-group">
                <input type="date" name="date_from" value="{{ Request('date_from') }}" class="form-control">
            </div>
        </div>
        <div class="col-sm-4 col-md-4">
            <div class="input-group">
                <input type="date" name="date_to" value="{{ Request('date_to') }}" class="form-control">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat bg-orange">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </div>
    </div>
</form>
