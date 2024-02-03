<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title col-md-8">@lang('company_employee.update')</h3>
                </div>
                <form role="form" action="{{url('client/client-company-employee/'.$employee->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="box-body">

                        @if($employee->file)
                        <img src="{{ url('uploads/'.$employee->file->new_name)}}" style="height:50px;width:50px;border-radius:50%">
                        @endif

                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="file">@lang('company_employee.file')</label>
                                    <input type="file" class="form-control" name="file" id="file">
                                </div>
                                <div class="col-md-6">
                                    <label for="employee_job_name">@lang('company_employee.employee_job_name')</label>
                                    <input required type="text" class="form-control" name="employee_job_name" id="employee_job_name" value="{{$employee->employee_job_name}}">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="company_id">@lang('company_employee.company')</label>
                                    <select required class="form-control" name="company_id" id="company_id">
                                        @foreach ($companies as $company)
                                        {{$selected = $company->id == $employee->company_id ? "selected" : "" }}
                                        <option value="{{$company->id}}" {{$selected}}>{{$company->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="name">@lang('company_employee.name')</label>
                                    <input required type="text" class="form-control" name="name" id="name" value="{{$employee->name}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="email">@lang('company_employee.email')</label>
                                    <input required type="email" class="form-control" name="email" id="email" value="{{$employee->email}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="phone">@lang('company_employee.phone')</label>
                                    <input required type="text" class="form-control" name="phone" id="phone" value="{{$employee->phone}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="available_rating_ids">@lang('company_employee.available_rating')</label>
                                    <select required class="form-control select2" multiple="multiple" name="available_rating_ids[]" id="available_rating_ids">
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
