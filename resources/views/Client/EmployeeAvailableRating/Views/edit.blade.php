<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title col-md-8">@lang('employee_available_rating.update')</h3>
                </div>
                <form role="form" action="{{url('client/employee-available-rating/'.$employeeAvailableRating->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="name">@lang('employee_available_rating.name')</label>
                                    <input required type="text" class="form-control" name="name" id="name" value="{{$employeeAvailableRating->name}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="name_ar">@lang('employee_available_rating.name_ar')</label>
                                    <input required type="text" class="form-control" name="name_ar" id="name_ar" value="{{$employeeAvailableRating->name_ar}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">@lang('employee_available_rating.submit')</button>
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
