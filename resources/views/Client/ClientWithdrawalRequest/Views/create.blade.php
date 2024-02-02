<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title col-md-8">@lang('withdrawal_request.create')</h3>
                </div>
                <form role="form" action="{{url('client/client-withdrawal-request')}}" method="POST">
                    @csrf
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="amount">@lang('withdrawal_request.amount')</label>
                                    <input required type="number" class="form-control" name="amount" id="amount" placeholder="@lang('withdrawal_request.amount')">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">@lang('withdrawal_request.submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
