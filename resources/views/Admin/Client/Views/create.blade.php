<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title col-md-8">@lang('client.create')</h3>
        </div>
        <form role="form" action="{{url('admin/client')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="box-body">

            <div class="row">
              <div class="form-group">
                <div class="col-md-6">
                  <label for="file">@lang('client.file')</label>
                  <input type="file" class="form-control" name="file" id="file" placeholder="@lang('client.file')">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="form-group">
                <div class="col-md-6">
                  <label for="country_id">@lang('client.country')</label>
                  <select class="form-control select2" name="country_id" id="country_id" onchange="getGovernorate(this.value)">
                    <option value="">@lang('filter.select')</option>
                    @foreach ($countries as $country)
                    <option value="{{$country->id}}">{{$country->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-6" id="parent_governorate_id">
                  <label for="governorate_id">@lang('client.governorate')</label>
                  <select class="form-control select2" name="governorate_id" id="governorate_id"></select>
                </div>
              </div>
            </div>
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
                  <label for="password">@lang('client.password')</label>
                  <input type="password" class="form-control" name="password" id="password" placeholder="@lang('client.password')">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="form-group">
                <div class="col-md-6">
                  <label for="available_companies_count">@lang('client.available_companies_count')</label>
                  <input type="number" class="form-control" name="available_companies_count" id="available_companies_count" value="0">
                </div>
                <div class="col-md-6">
                  <label for="available_employees_count">@lang('client.available_employees_count')</label>
                  <input type="number" class="form-control" name="available_employees_count" id="available_employees_count" value="0">
                </div>
              </div>
            </div>
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">@lang('client.submit')</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>


<script>
  function getGovernorate(country_id) {

    $("#parent_governorate_id").hide();
    if (country_id != "") {

      $.ajax({

        url: '{{url("admin/country-governorates")}}/' + country_id,
        type: 'GET',
        data: {},
        dataType: 'json',
        success: function(response) {

          let result = response.data;
          if (result.length > 0) {

            $("#governorate_id").html(`<option value=''>@lang('filter.select')</option>`)

            for (let i = 0; i < result.length; i++) {

              $("#governorate_id").append(`<option value='${result[i].id}'>${result[i].name}</option>`);

            }

            $("#parent_governorate_id").show();

          }
        },
        error: function(request, error) {
          console.log("Request: " + JSON.stringify(request));
        }
      });
    }
  }
</script>
