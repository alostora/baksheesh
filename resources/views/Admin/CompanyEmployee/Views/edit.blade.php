<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title col-md-8">@lang('company_employee.update')</h3>
        </div>
        <form role="form" action="{{url('admin/company-employee/'.$employee->id)}}" method="post">
          @csrf
          @method('PATCH')
          <div class="box-body">
            <div class="row">
              <div class="form-group">
                <div class="col-md-6">
                  <label for="company_id">@lang('company_employee.company')</label>
                  <select class="form-control" name="company_id" id="company_id">
                    @foreach ($companies as $company)
                    {{$selected = $company->id == $employee->company_id ? "selected" : "" }}
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
                  <input type="text" class="form-control" name="name" id="name" value="{{$employee->name}}">
                </div>
                <div class="col-md-6">
                  <label for="email">@lang('company_employee.email')</label>
                  <input type="email" class="form-control" name="email" id="email" value="{{$employee->email}}">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="form-group">
                <div class="col-md-6">
                  <label for="phone">@lang('company_employee.phone')</label>
                  <input type="text" class="form-control" name="phone" id="phone" value="{{$employee->phone}}">
                </div>
                <div class="col-md-6">
                  <label for="address">@lang('company_employee.address')</label>
                  <input type="text" class="form-control" name="address" id="address" value="{{$employee->address}}">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="form-group">
                <div class="col-md-6">
                  <label for="password">@lang('company_employee.password')</label>
                  <input type="password" class="form-control" name="password" id="password">
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
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">@lang('company_employee.submit')</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>