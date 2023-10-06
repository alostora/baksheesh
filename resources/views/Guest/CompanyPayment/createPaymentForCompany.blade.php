<section class="content-header">
    <h1>
        @lang('dashboard.app_name')
        <small>Company Review</small>
    </h1>
</section>
<section class="content">

    <div class="row">
        <div class="col-md-6">

            <div class="box box-primary">
                <!--  <div class="box-header with-border">
                    <h3 class="box-title">Review Company</h3>
                </div> -->
                <form role="form" action="{{url('guest/payment/pay-for-company')}}" method="POST">
                    @csrf

                    <input type="hidden" name="client_id" value="{{Request('company')->client_id}}">
                    <input type="hidden" name="company_id" value="{{Request('company')->id}}">

                    <div class="box-body">

                        <div class="form-group">
                            <label for="payer_name">Payer Name</label>
                            <input type="text" name="payer_name" class="form-control input-lg" id="payer_name" placeholder="Enter Payer Name">
                        </div>

                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" name="amount" class="form-control input-lg" id="amount" placeholder="Enter Amount">
                        </div>

                        <div class="form-group">
                            <label for="notes">Notes</label>
                            <textarea class="form-control input-lg" name="notes" id="notes" placeholder="Enter Notes"></textarea>
                        </div>

                        @foreach($company_available_ratings as $key=>$company_available_rating)
                        <div class="form-group">
                            <label>{{$company_available_rating->name}}</label>
                            <div>
                                <input type="radio" name="{{$company_available_rating->id}}" value="1" onclick="postRate(this)">
                                <input type="radio" name="{{$company_available_rating->id}}" value="2" onclick="postRate(this)">
                                <input type="radio" name="{{$company_available_rating->id}}" value="3" onclick="postRate(this)">
                                <input type="radio" name="{{$company_available_rating->id}}" value="4" onclick="postRate(this)">
                                <input type="radio" name="{{$company_available_rating->id}}" value="5" onclick="postRate(this)">
                            </div>
                        </div>
                        @endforeach

                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    function postRate(value) {

        $.ajax({

            url: '{{url("api/guest/payment/company-rating/".Request("company")->id)}}',
            type: 'POST',
            data: {
                rating_value: value.value,
                rating_id: value.name,
            },
            dataType: 'json',
            success: function(response) {

                console.log(response);

            },
            error: function(request, error) {
                console.log("Request: " + JSON.stringify(request));
            }
        });
    }
</script>