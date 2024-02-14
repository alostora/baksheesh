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
                <form role="form" action="{{url('admin/quick-start-create-employee')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="company_id" value="{{$company->id}}">
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

                        <div class="row">

                            <div class="col-md-6">
                                <label for="name">@lang('company_employee.name')</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="@lang('company_employee.name')" required>
                            </div>
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

        } else {}
    }


    $(function() {
        clientEmployeeAvailableRating("{{$company->client_id}}")
    });
</script>
