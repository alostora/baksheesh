<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title col-md-8">@lang('company.create')</h3>
                </div>
                <form role="form" action="{{url('admin/company')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">

                        <div class="row">
                            <div class="col-md-6">
                                <label for="file">@lang('company.file')</label>
                                <input type="file" class="form-control" name="file" id="file" placeholder="@lang('company.file')" required>
                            </div>

                            <div class="col-md-6">
                                <label for="company_field">@lang('company.company_field')</label>
                                <input type="text" class="form-control" name="company_field" id="company_field" placeholder="@lang('company.company_field')" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="client_id">@lang('company.client')</label>
                                    <select class="form-control select2" name="client_id" id="client_id" onchange="clientCompanyAvailableRating(this.value)" required>
                                        <option value="">@lang('company.client')</option>

                                        @foreach ($clients as $client)
                                        <option value="{{$client->id}}">{{$client->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="name">@lang('company.name')</label>
                                    <input required type="text" class="form-control" name="name" id="name" placeholder="@lang('company.name')">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group" id="available_rating">
                                <div class="col-md-6">
                                    <label for="available_rating_ids">@lang('company.available_rating')</label>
                                    <select required class="form-control select2" multiple="multiple" name="available_rating_ids[]" id="available_rating_ids">
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">@lang('company.submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>




<script>
    function clientCompanyAvailableRating(client_id) {

        if (client_id) {

            $.ajax({

                url: '{{url("admin/company/client-company-available-rating")}}/' + client_id,
                type: 'GET',
                data: {},
                dataType: 'json',
                success: function(response) {

                    if (response.status == true) {

                        $("#available_rating").css('display', 'block');
                        $(".select2").css('width', '100%');

                        let result = response.available_rating;

                        $("#available_rating_ids").html(`<option value=''>@lang('filter.select')</option>`)

                        for (let i = 0; i < result.length; i++) {

                            $("#available_rating_ids").append(`<option value='${result[i].id}'>${result[i].name}</option>`);
                            console.log(result[i]);


                        }
                    } else {

                        $("#available_rating").css('display', 'none');
                    }
                },
                error: function(request, error) {
                    $("#available_rating").css('display', 'none');
                    console.log("Request: " + JSON.stringify(request));
                }
            });
        } else {
            $("#available_rating").css('display', 'none');
        }
    }
</script>
