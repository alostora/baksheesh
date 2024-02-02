<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title col-md-8">@lang('company_available_rating.create')</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{url('admin/company-available-rating')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">

                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="client_id">@lang('company_available_rating.client')</label>
                                    <select class="form-control" name="client_id" id="client_id" require>
                                        @foreach ($clients as $client)
                                        <option value="{{$client->id}}">{{$client->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="name">@lang('company_available_rating.name')</label>
                                    <input type="text" class="form-control" name="name" id="name" value="">
                                </div>
                                <div class="col-md-6">
                                    <label for="name_ar">@lang('company_available_rating.name_ar')</label>
                                    <input type="text" class="form-control" name="name_ar" id="name_ar" value="">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">@lang('company_available_rating.submit')</button>
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
