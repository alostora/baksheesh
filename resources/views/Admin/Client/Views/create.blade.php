<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title col-md-8">@lang('client.create')</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="{{url('admin/client')}}" method="POST">
          @csrf
          <div class="box-body">
            <div class="row">
              <div class="form-group">
                <div class="col-md-6">

                  <label for="name">@lang('client.name')</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="@lang('client.name')">
                </div>
                <div class="col-md-6">
                  <label for="email">@lang('client.email')</label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="@lang('client.email')">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="form-group">
                <div class="col-md-6">
                  <label for="phone">@lang('client.phone')</label>
                  <input type="text" class="form-control" name="phone" id="phone" placeholder="@lang('client.phone')">
                </div>
                <div class="col-md-6">
                  <label for="address">@lang('client.address')</label>
                  <input type="text" class="form-control" name="address" id="address" placeholder="@lang('client.address')">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="form-group">
                <div class="col-md-6">
                  <label for="password">@lang('client.password')</label>
                  <input type="password" class="form-control" name="password" id="password" placeholder="@lang('client.password')">
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="form-group">
                <div class="col-md-6">
                  <label for="available_companies_count">@lang('client.available_companies_count')</label>
                  <input type="number" class="form-control" name="available_companies_count" id="available_companies_count" placeholder="@lang('client.available_companies_count')">
                </div>
                <div class="col-md-6">
                  <label for="available_employees_count">@lang('client.available_employees_count')</label>
                  <input type="number" class="form-control" name="available_employees_count" id="available_employees_count" placeholder="@lang('client.available_employees_count')">
                </div>
              </div>
            </div>

          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" class="btn btn-primary">@lang('client.submit')</button>
          </div>
        </form>
      </div>
      <!-- /.box -->



    </div>

  </div>
  <!-- /.row -->
</section>
<!-- /.content -->