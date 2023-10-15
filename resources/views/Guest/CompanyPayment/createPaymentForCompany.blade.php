<section class="content-header">
    <div class="box box-success" style="border-radius:20%;text-align:center">
        <div class="row">
            <img src="{{ url('uploads/'.$company->file->new_name)}}" style="height:250px;width:250px;border-radius:50%">
        </div>

        <h1 style="margin: 5px 0px 15px 0px;">
            {{$company->name}}
        </h1>

        <label>
            <i class="fa fa-star fa-lg" style="font-size: 30px;color:yellow"></i>
            <i class="fa fa-star fa-lg" style="font-size: 30px;color:yellow"></i>
            <i class="fa fa-star fa-lg" style="font-size: 30px;color:yellow"></i>
            <i class="fa fa-star fa-lg" style="font-size: 30px;color:yellow"></i>
            <i class="fa fa-star fa-lg" style="font-size: 30px;color:yellow"></i>
        </label>
    </div>
</section>
<section class="content">

    <div class="row">
        <div class="col-md-12">
            <div class="box box-success" style="border-radius:20%;text-align:center">
                <div class="box-header with-border">
                    <h3 class="box-title">Review Company</h3>
                </div>
                <form role="form" action="{{url('guest/payment/pay-for-company')}}" method="POST">
                    @csrf

                    <input type="hidden" name="client_id" value="{{Request('company')->client_id}}">
                    <input type="hidden" name="company_id" value="{{Request('company')->id}}">

                    <div class="box-body">
                        @foreach($company_available_ratings as $key=>$company_available_rating)
                        <div class="form-group">
                            <label class="col-xs-6">{{$company_available_rating->name}}</label>
                            <div class="col-xs-6">
                                @for($i = 1; $i <= 5; $i ++) <label style="margin-bottom: 20px;">
                                    <input type="radio" class="{{$key.'__'.$i}}" name="{{$company_available_rating->id}}" value="{{$i}}" onclick="postRate(this)" style="display:none">
                                    <i class="fa fa-star fa-lg" id="{{$key.'__'.$i}}" style="font-size: 30px;"></i>
                                    </label>
                                    @endfor
                            </div>
                        </div>
                        @endforeach

                        <div class="form-group">
                            <label for="notes">Add Notes</label>
                            <textarea class="form-control input-lg" name="notes" id="notes" placeholder="Enter Notes"></textarea>
                        </div>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-default" style="float: left;background-color:orange">Send</button>
                    </div>
                </form>
            </div>

            <div class="box box-success" style="border-radius:20%;text-align:center">
                <div class="box-header with-border">
                    <h3 class="box-title">Pay Tips</h3>
                </div>
                <form role="form" action="{{url('guest/payment/pay-for-company')}}" method="POST">
                    @csrf

                    <input type="hidden" name="client_id" value="{{Request('company')->client_id}}">
                    <input type="hidden" name="company_id" value="{{Request('company')->id}}">

                    <div class="box-body">

                        <div class="form-group">
                            <div for="amount" class="col-xs-4">
                                <button type="button" class="btn bg-maroon margin" onclick="appendAmount(5)">5 Ryal</button>
                            </div>
                            <div for="amount" class="col-xs-4">
                                <button type="button" class="btn bg-maroon margin" onclick="appendAmount(10)">10 Ryal</button>
                            </div>
                            <div for="amount" class="col-xs-4">
                                <button type="button" class="btn bg-maroon margin" onclick="appendAmount(20)">20 Ryal</button>
                            </div>
                        </div>

                        <br>
                        <br>
                        <br>

                        <div class="form-group">
                            <label for="amount" class="col-md-4">Amount</label>
                            <div class="col-md-4">
                                <input type="number" name="amount" class="form-control" id="amount" placeholder="Enter Amount">
                            </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-default" style="float: left;background-color:orange">Move To Payment Page</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    function postRate(element) {

        elementClass = element.className;
        elementId = elementClass;

        level = elementClass.split("__")[0];
        value = elementClass.split("__")[1];

        for (var i = 1; i <= value; i++) {
            $("#" + level + "__" + i).css("color", "yellow");
        }

        for (var x = (Number(value) + 1); x <= 5; x++) {
            $("#" + level + "__" + x).css("color", "#333");
        }

        $.ajax({

            url: '{{url("api/guest/payment/company-rating/".Request("company")->id)}}',
            type: 'POST',
            data: {
                rating_value: element.value,
                rating_id: element.name,
                payer_name: document.getElementById("payer_name").value,
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

    function appendAmount(amount) {
        document.getElementById("amount").value = Number(amount);
    }
</script>