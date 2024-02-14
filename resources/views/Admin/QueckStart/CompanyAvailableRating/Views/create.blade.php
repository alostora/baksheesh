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
                <form role="form" action="{{url('admin/quick-start-create-company-available-rating')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="client_id" value="{{$client->id}}">
                    <div class="box-body">

                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="name">@lang('company_available_rating.name')</label>
                                    <input type="text" class="form-control" name="ratings[0][name]" id="name" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="name_ar">@lang('company_available_rating.name_ar')</label>
                                    <input type="text" class="form-control" name="ratings[0][name_ar]" id="name_ar" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="name">@lang('company_available_rating.name')</label>
                                    <input type="text" class="form-control" name="ratings[1][name]" id="name">
                                </div>
                                <div class="col-md-6">
                                    <label for="name_ar">@lang('company_available_rating.name_ar')</label>
                                    <input type="text" class="form-control" name="ratings[1][name_ar]" id="name_ar">
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

</script>
