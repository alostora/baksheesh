<section class="content-header">
    <div class="row">
        <img src="{{ url('uploads/'.$employee->file->new_name)}}" style="height:250px;width:250px;border-radius:50%">
    </div>
    <h1>
        {{$employee->name}}
    </h1>
</section>
<section class="content">

    <div class="row">
        <div class="col-md-6">

            <div class="box box-primary">
                
                <div class="box-header with-border">
                    <h3 class="box-title">Review Employee</h3>
                </div>

                <form role="form" action="{{url('guest/payment/pay-for-employee')}}" method="POST">

                    @csrf

                    <input type="hidden" name="client_id" value="{{Request('user')->client_id}}">
                    <input type="hidden" name="company_id" value="{{Request('user')->company_id}}">
                    <input type="hidden" name="employee_id" value="{{Request('user')->id}}">


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

                        @foreach($employee_available_ratings as $key=>$employee_available_rating)
                        <div class="form-group">
                            <label>{{$employee_available_rating->name}}</label>
                            <div>
                                @for($i = 1; $i <= 5; $i ++) <label>
                                    <input type="radio" class="{{$key.'__'.$i}}" name="{{$employee_available_rating->id}}" value="{{$i}}" onclick="postRate(this)" style="display:none">
                                    <i class="fa fa-star fa-lg" id="{{$key.'__'.$i}}" style="font-size: 30px;"></i>
                                    </label>
                                    @endfor
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

            url: '{{url("api/guest/payment/employee-rating/".Request("user")->id)}}',
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
</script>