<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title col-md-8">@lang('withdrawal_request.update')</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="{{url('client/client-withdrawal-request/'.$clientWithdrawalRequest->id)}}" method="post">
          @csrf
          @method('PATCH')
          
          <div class="box-body">
            <div class="row">
              <div class="form-group">
                <div class="col-md-6">
                  <label for="amount">@lang('withdrawal_request.amount')</label>
                  <input type="number" class="form-control" name="amount" id="amount" value="{{$clientWithdrawalRequest->amount}}">
                </div>
              </div>
            </div>
          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" class="btn btn-primary">@lang('withdrawal_request.submit')</button>
          </div>
        </form>
      </div>
      <!-- /.box -->



    </div>

  </div>
  <!-- /.row -->
</section>
<!-- /.content -->