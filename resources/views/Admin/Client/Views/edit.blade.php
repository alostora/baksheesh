<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title col-md-8">@lang('user.update')</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="{{url('admin/client/'.$user->id)}}" method="post" enctype="multipart/form-data">
          @csrf
          @method('PATCH')
          <div class="box-body">

            @if($user->file)
            <img src="{{ url('uploads/'.$user->file->new_name)}}" style="height:50px;width:50px;border-radius:50%">
            @endif

            <div class="row">
              <div class="form-group">

                <div class="col-md-6">
                  <label for="file">@lang('user.file')</label>
                  <input type="file" class="form-control" name="file" id="file">
                </div>

              </div>
            </div>

            <div class="row">
              <div class="form-group">
                <div class="col-md-6">

                  <label for="name">@lang('user.name')</label>
                  <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}">
                </div>
                <div class="col-md-6">
                  <label for="email">@lang('user.email')</label>
                  <input type="email" class="form-control" name="email" id="email" value="{{$user->email}}">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="form-group">
                <div class="col-md-6">
                  <label for="phone">@lang('user.phone')</label>
                  <input type="text" class="form-control" name="phone" id="phone" value="{{$user->phone}}">
                </div>
                <div class="col-md-6">
                  <label for="address">@lang('user.address')</label>
                  <input type="text" class="form-control" name="address" id="address" value="{{$user->address}}">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="form-group">
                <div class="col-md-6">
                  <label for="password">@lang('user.password')</label>
                  <input type="password" class="form-control" name="password" id="password">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="form-group">
                <div class="col-md-6">
                  <label for="available_companies_count">@lang('client.available_companies_count')</label>
                  <input type="number" class="form-control" name="available_companies_count" id="available_companies_count" value="{{(int)$user->available_companies_count}}">
                </div>
                <div class="col-md-6">
                  <label for="available_employees_count">@lang('client.available_employees_count')</label>
                  <input type="number" class="form-control" name="available_employees_count" id="available_employees_count" value="{{(int)$user->available_employees_count}}">
                </div>
              </div>
            </div>

          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" class="btn btn-primary">@lang('user.submit')</button>
          </div>
        </form>
      </div>
      <!-- /.box -->



    </div>

  </div>
  <!-- /.row -->
</section>
<!-- /.content -->