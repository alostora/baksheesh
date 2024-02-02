<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">@lang('governorate.create')</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="{{url('admin/governorate')}}" method="POST">
          @csrf
          <div class="box-body">
            <div class="row">
              <div class="form-group">
                <div class="col-md-6">
                  <label for="country_id">@lang('governorate.country')</label>
                  <select class="form-control" name="country_id" id="country_id" required>
                    @foreach ($countries as $country)
                    <?php $selected = Request('country_id') == $country->id ? "selected" : ""; ?>
                    <option value="{{$country->id}}" {{$selected}}>{{$country->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="form-group">
                <div class="col-md-6">
                  <label for="name">@lang('country.name')</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="@lang('country.name')" required>
                </div>
                <div class="col-md-6">
                  <label for="name_ar">@lang('country.name_ar')</label>
                  <input type="text" class="form-control" name="name_ar" id="name_ar" placeholder="@lang('country.name_ar')" required>
                </div>
              </div>
            </div>
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">@lang('governorate.submit')</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
