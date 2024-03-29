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
                                    <input type="file" class="form-control" name="file" id="file" placeholder="@lang('company_employee.file')" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="employee_job_name">@lang('company_employee.employee_job_name')</label>
                                    <input type="text" class="form-control" name="employee_job_name" id="employee_job_name" placeholder="@lang('company_employee.employee_job_name')" required>
                                </div>
                            </div>
                        </div>
 {{--

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label for="country_id">@lang('client.country')</label>
                                        <select class="form-control select2" name="country_id" id="country_id" onchange="getGovernorate(this.value)" required>
                                            <option value="">@lang('filter.select')</option>
                                            @foreach ($countries as $country)
                                            <option value="{{$country->id}}">{{$country->name}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="col-md-6" id="parent_governorate_id">
                        <label for="governorate_id">@lang('client.governorate')</label>
                        <select class="form-control select2" name="governorate_id" id="governorate_id" required></select>
                    </div>
            </div>
        </div>
        --}}

                        <div class="row">
                            <div class="col-md-6">
                                <label for="client_id">@lang('company.client')</label>
                                <select class="form-control select2" name="client_id" id="client_id" onchange="clientEmployeeAvailableRating(this.value)" required>
                                    <option value="">@lang('company.client')</option>

                                    @foreach ($clients as $client)
                                    <option value="{{$client->id}}">{{$client->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group" id="company_parent_id">
                                <div class="col-md-6">
                                    <label for="company_id">@lang('company_employee.company')</label>
                                    <select class="form-control" name="company_id" id="company_id" required>
                                        @if(isset($companies) && count($companies))
                                        @foreach ($companies as $company)
                                        {{$selected = $company->id == Request('company_id') ? "selected" : "" }}
                                        <option value="{{$company->id}}" {{$selected}}>{{$company->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="name">@lang('company_employee.name')</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="@lang('company_employee.name')" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group" id="available_rating">
                                <div class="col-md-6">
                                    <label for="available_rating_ids">@lang('company.available_rating')</label>
                                    <select class="form-control select2" multiple="multiple" name="available_rating_ids[]" id="available_rating_ids" required>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="phone">@lang('company_employee.phone')</label>
                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="@lang('company_employee.phone')" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email">@lang('company_employee.email')</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="@lang('company_employee.email')" required>
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
    function clientEmployeeAvailableRating(client_id) {

        if (client_id) {

            //client-employee-available-rating
            $.ajax({

                url: '{{url("admin/company/client-employee-available-rating")}}/' + client_id,
                type: 'GET',
                data: {},
                dataType: 'json',
                success: function(response) {

                    if (response.status == true) {

                        let result = response.available_rating;

                        $("#available_rating_ids").html(`<option value=''>@lang('filter.select')</option>`)

                        for (let i = 0; i < result.length; i++) {

                            $("#available_rating_ids").append(`<option value='${result[i].id}'>${result[i].name}</option>`);
                            console.log(result[i]);
                        }
                    } else {}
                },
                error: function(request, error) {
                    console.log("Request: " + JSON.stringify(request));
                }
            });

            //client-companies
            $.ajax({
                url: '{{url("admin/company/client-companies")}}/' + client_id,
                type: 'GET',
                data: {},
                dataType: 'json',
                success: function(response) {

                    if (response.status == true) {

                        $("#company_parent_id").show();
                        $(".select2").css('width', '100%');

                        let result = response.companies;

                        $("#company_id").html(`<option value=''>@lang('filter.select')</option>`)

                        for (let i = 0; i < result.length; i++) {

                            $("#company_id").append(`<option value='${result[i].id}'>${result[i].name}</option>`);
                            console.log(result[i]);

                        }
                    } else {}
                },
                error: function(request, error) {
                    console.log("Request: " + JSON.stringify(request));
                }
            });

        } else {}
    }

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
