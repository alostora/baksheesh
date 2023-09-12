<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title col-md-8">@lang('company.update')</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="{{url('admin/company/'.$company->id)}}" method="post">
          @csrf
          @method('PATCH')
          <div class="box-body">
            <div class="row">
              <div class="form-group">
                <div class="col-md-6">

                  <label for="name">@lang('company.name')</label>
                  <input type="text" class="form-control" name="name" id="name" value="{{$company->name}}">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="form-group">
                <div class="col-md-6">
                  <label for="available_rating_ids">@lang('company.available_rating')</label>
                  <select class="form-control select2" multiple="multiple" name="available_rating_ids[]" id="available_rating_ids">
                    @foreach ($available_rating as $available_rating)
                    <option value="{{$available_rating->id}}">{{$available_rating->name}}</option>
                    @endforeach
                    
                    @foreach ($selected_available_rating as $selected_available_rating)
                    <option value="{{$selected_available_rating->id}}" selected>{{$selected_available_rating->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">@lang('company.submit')</button>
          </div>
        </form>
      </div>
      <!-- /.box -->



    </div>

  </div>
  <!-- /.row -->
</section>
<!-- /.content -->