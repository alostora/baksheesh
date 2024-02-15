<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title col-md-8">@lang('employee_available_rating.create')</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{url('client/quick-start-create-employee-available-rating')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">

                        <div class="row">
                            <div class="col-md-12">
                                <a href="#" class="btn btn-sm btn-success" onclick="appendRating(this)">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>

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

                        <div id="rating"></div>

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
    var countr = 1;

    function appendRating(e) {

        $('#rating').append(
            '<div class="row" id="' + countr + '">' +

            '<div class="col-md-12">' +
            '<a href="#" class="btn btn-sm btn-danger" onclick="removeRating(this)" value="' + countr + '">' +
            '<i class="fa fa-close"></i>' +
            '</a>' +
            '</div>' +

            '<div class="col-md-6">' +
            '<label for="name">@lang("company_available_rating.name")</label>' +
            '<input type="text" class="form-control" name="ratings[' + countr + '][name]" id="name" required>' +
            '</div>' +

            '<div class="col-md-6">' +
            '<label for="name_ar">@lang("company_available_rating.name_ar")</label>' +
            '<input type="text" class="form-control" name="ratings[' + countr + '][name_ar]" id="name_ar" required>' +
            '</div>' +

            '</div>'
        );

        countr++;
    }

    function removeRating(e) {

        e.parentNode.parentNode.remove()
    }
</script>
