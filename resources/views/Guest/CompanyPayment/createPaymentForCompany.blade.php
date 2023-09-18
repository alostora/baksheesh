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
                <form role="form" action="{{url('api/guest/payment/pay-for-company')}}" method="POST">
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
                            <textarea class="form-control input-lg" id="notes" placeholder="Enter Notes"></textarea>
                        </div>

                        @foreach($company_available_ratings as $key=>$company_available_rating)
                        <div class="form-group">
                            <label>{{$company_available_rating->name}}</label>
                            <div>
                                <input type="radio" name="{{$company_available_rating->id}}" value="1">
                                <input type="radio" name="{{$company_available_rating->id}}" value="2">
                                <input type="radio" name="{{$company_available_rating->id}}" value="3">
                                <input type="radio" name="{{$company_available_rating->id}}" value="4">
                                <input type="radio" name="{{$company_available_rating->id}}" value="5">
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