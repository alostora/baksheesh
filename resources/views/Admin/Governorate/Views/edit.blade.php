<!-- Main content -->
<section class="content">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">@lang('governorate.update')</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" action="{{url('admin/governorate/'.$governorate->id)}}" method="POST">
            @csrf
            @method('patch')

            <input type="hidden" class="form-control" name="id" id="id" value="{{$governorate->id}}">

            <div class="box-body">

                <div class="form-group">
                    <div class="col-md-6">
                        <label for="name">@lang('governorate.name')</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{$governorate->name}}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="name_ar">@lang('governorate.name_ar')</label>
                        <input type="text" class="form-control" name="name_ar" id="name_ar" value="{{$governorate->name_ar}}" required>
                    </div>

                </div>

            </div>
            <!-- /.box-body -->

            <div class="box-footer">
              <button type="submit" class="btn btn-primary">@lang('governorate.submit')</button>
            </div>
          </form>
        </div>
        <!-- /.box -->



      </div>

    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
