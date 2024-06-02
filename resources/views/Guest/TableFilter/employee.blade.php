<form role="form" action="{{ url('guest/company-employees/search') }}" method="GET">
    <div class="row">
        <div class="col-md-4">
            <div class="input-group">
                <input type="hidden" name="company_id" value="{{ Request('company_id') }}">

                <input type="text" class="form-control" name="query_string" value="{{ Request('query_string') }}"
                    placeholder="{{ Lang::get('filter.query_string') }}">

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
