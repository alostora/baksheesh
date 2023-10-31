<div class="bg-logo"></div>
<div class="logo">
    <img class="img-logo" src="{{ url('uploads/'.$company->file->new_name)}}" alt="">
</div>
<section class="content-header">
    <div class="box">
        <div class="row">
            <img src="{{ url('uploads/'.$company->file->new_name)}}" class="avatar">
        </div>

        <h1 style="margin: 5px 0px 15px 0px;">
            {{$company->name}}
        </h1>

        <label style="border: solid 1px #c05c5cb4; border-radius:10%;padding:3px;">
            <i class="fa fa-star fa-lg" style="font-size: 30px;color:#e2e202"></i>
            <i class="fa fa-star fa-lg" style="font-size: 30px;color:#e2e202"></i>
            <i class="fa fa-star fa-lg" style="font-size: 30px;color:#e2e202"></i>
            <i class="fa fa-star fa-lg" style="font-size: 30px;color:#e2e202"></i>
            <i class="fa fa-star fa-lg" style="font-size: 30px;color:#e2e202"></i>
        </label>
    </div>
</section>
<section class="content">

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">تقييم الشركة</h3>
                </div>

                <div class="box-body">
                    @foreach($company_available_ratings as $key=>$company_available_rating)
                    <div class="row">
                        <div class="form-group">
                            <label class="col-xs-4 text-sm">{{$company_available_rating->name_ar}}</label>
                            <div class="col-xs-8">
                                <label style="border: solid 1px #c05c5cb4; border-radius:10%;padding:2px;">
                                    @for($i = 1; $i <= 5; $i ++) <label>
                                        <input type="radio" class="{{$key.'__'.$i}}" name="{{$company_available_rating->id}}" value="{{$i}}" onclick="postRate(this)" style="display:none">
                                        <i class="fa fa-star fa-lg" id="{{$key.'__'.$i}}"></i>
                                </label>
                                @endfor
                                </label>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="box-body">
                    <div class="form-group">
                        <label for="notes">اضف تعليق</label>
                        <textarea class="form-control input-lg" name="notes" id="notes" placeholder="اضف تعليق" style="background-color: rgba(255, 51, 0, 0.342)"></textarea>
                    </div>
                </div>

                <div class="box-footer" style="margin-bottom: 15px;">
                    <button onclick="sendCompanyNote()" class="btn" style="float: left;background-color: rgb(248, 82, 40);border-radius: 10px;width: 100px;">ارسال</button>
                </div>
            </div>

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">دفع اكرامية</h3>
                </div>
                <form role="form" action="{{url('guest/payment/pay-for-company')}}" method="POST">
                    @csrf

                    <input type="hidden" name="client_id" value="{{Request('company')->client_id}}">
                    <input type="hidden" name="company_id" value="{{Request('company')->id}}">

                    <div class="box-body">

                        <div class="form-group">
                            <div for="amount" class="col-xs-4">
                                <button type="button" class="btn margin" onclick="appendAmount(5)" style="background-color: rgba(255, 51, 0, 0.342)">5 ريال</button>
                            </div>
                            <div for="amount" class="col-xs-4">
                                <button type="button" class="btn margin" onclick="appendAmount(10)" style="background-color: rgba(255, 51, 0, 0.342)">10 ريال</button>
                            </div>
                            <div for="amount" class="col-xs-4">
                                <button type="button" class="btn margin" onclick="appendAmount(20)" style="background-color: rgba(255, 51, 0, 0.342)">20 ريال</button>
                            </div>
                        </div>

                        <br>
                        <br>
                        <br>

                        <div class="form-group">
                            <label for="amount" class="col-md-4">مبلغ اخر</label>
                            <div class="col-md-4">
                                <input type="number" name="amount" class="form-control" id="amount" placeholder="ادخل المبلغ" style="background-color: rgba(255, 51, 0, 0.342)">
                            </div>
                        </div>
                    </div>

                    <div class="box-footer" style="margin-bottom: 40px;">
                        <button type="submit" class="btn" style="
                    background-color: rgb(248, 82, 40);
                    border-radius: 10px;
                    width: 200px;
                    height: 50px;
                  ">الانتقال الي صفحة الدفع</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div style="text-align: center;">
        Powered By <a target="_blank" href="https://tiposmart.com">tiposmart.com</a> <br>
        All Right Resereved <i class="fa fa-copyright"></i> 2023
    </div>
</section>

<div class="footer-bg">
</div>

<script>
    function postRate(element) {

        elementClass = element.className;
        elementId = elementClass;

        level = elementClass.split("__")[0];
        value = elementClass.split("__")[1];

        for (var i = 1; i <= value; i++) {
            $("#" + level + "__" + i).css("color", "#e2e202");
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
                guest_key: "{{Request()->session()->get('guest_key')}}",
                guest_key: "{{Request()->session()->get('guest_key')}}",
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

    function sendCompanyNote() {

        $.ajax({

            url: '{{url("api/guest/payment/pay-for-company")}}',
            type: 'POST',
            data: {
                client_id: "{{Request('company')->client_id}}",
                company_id: "{{Request('company')->id}}",
                notes: document.getElementById('notes').value,
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