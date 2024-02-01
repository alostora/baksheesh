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
                <form role="form" action="{{url('admin/company-employee')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="file">@lang('company_employee.file')</label>
                                    <input type="file" class="form-control" name="file" id="file" placeholder="@lang('company_employee.file')">
                                </div>
                                <div class="col-md-6">
                                    <label for="employee_job_name">@lang('company_employee.employee_job_name')</label>
                                    <input type="text" class="form-control" name="employee_job_name" id="employee_job_name" placeholder="@lang('company_employee.employee_job_name')">
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
                                    <label for="company_id">@lang('company_employee.company')</label>
                                    <select class="form-control" name="company_id" id="company_id">
                                        @foreach ($companies as $company)
                                        {{$selected = $company->id == Request('company_id') ? "selected" : "" }}
                                        <option value="{{$company->id}}" {{$selected}}>{{$company->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="name">@lang('company_employee.name')</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="@lang('company_employee.name')">
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
                                    <label for="email">@lang('company_employee.email')</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="@lang('company_employee.email')">
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
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">@lang('company_employee.submit')</button>
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
