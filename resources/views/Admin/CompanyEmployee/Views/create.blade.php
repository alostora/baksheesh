<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title col-md-8">@lang('company_employee.create')</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="{{url('admin/company-employee')}}" method="POST">
          @csrf
          <div class="box-body">
            <div class="row">
              <div class="form-group">
                <div class="col-md-6">
                  <label for="company_id">@lang('company_employee.company')</label>
                  <select class="form-control" name="company_id" id="company_id">
                    @foreach ($companies as $company)
                    {{$selected = $company->id == Request('company_id') ? "selected" : "" }}
                    <option value="{{$company->id}}" {{$selected}}>{{$company->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="form-group">
                <div class="col-md-6">

                  <label for="name">@lang('company_employee.name')</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="@lang('company_employee.name')">
                </div>
                <div class="col-md-6">
                  <label for="email">@lang('company_employee.email')</label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="@lang('company_employee.email')">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="form-group">
                <div class="col-md-6">
                  <label for="phone">@lang('company_employee.phone')</label>
                  <input type="text" class="form-control" name="phone" id="phone" placeholder="@lang('company_employee.phone')">
                </div>
                <div class="col-md-6">
                  <label for="address">@lang('company_employee.address')</label>
                  <input type="text" class="form-control" name="address" id="address" placeholder="@lang('company_employee.address')">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="form-group">
                <div class="col-md-6">
                  <label for="password">@lang('company_employee.password')</label>
                  <input type="password" class="form-control" name="password" id="password" placeholder="@lang('company_employee.password')">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="form-group">
                <div class="col-md-6">
                  <label for="available_rating_ids">@lang('company_employee.available_rating')</label>
                  <select class="form-control select2" multiple="multiple" name="available_rating_ids[]" id="available_rating_ids">
                    @foreach ($available_rating as $available_rating)
                    <option value="{{$available_rating->id}}">{{$available_rating->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>

          <div class="box-footer">
            <button type="submit" class="btn btn-primary">@lang('company_employee.submit')</button>
          </div>
        </form>
      </div>
      <!-- /.box -->



    </div>

  </div>
  <!-- /.row -->
</section>
<!-- /.content -->