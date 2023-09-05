<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title col-md-8">@lang('general.update')</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="{{url('admin/user/'.$user->id)}}" method="post">
          @csrf
          @method('PATCH')
          <div class="box-body">
            <div class="row">
              <div class="form-group">
                <div class="col-md-6">
                  <label for="user_account_type_id">@lang('user.account_type')</label>
                  <select class="form-control" name="user_account_type_id" id="user_account_type_id">
                    @foreach ($user_account_types as $account_type)
                    {{$selected = $account_type->id == $user->user_account_type_id ? "selected" : "" }}
                    <option value="{{$account_type->id}}" {{$selected}}>{{$account_type->name}}</option>
                    @endforeach
                  </select>
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

          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" class="btn btn-primary">@lang('user.Submit')</button>
          </div>
        </form>
      </div>
      <!-- /.box -->



    </div>

  </div>
  <!-- /.row -->
</section>
<!-- /.content -->