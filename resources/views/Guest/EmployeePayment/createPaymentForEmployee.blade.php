<div class="logo_bg">
    @if($employee->file)
    <img class="img-logo" src="{{ url('uploads/'.$employee->company->file->new_name)}}" alt="" height="150px;width:150px">
    @endif
</div>

<div class="employee_bg">
    @if($employee->file)
    <img class="employee_img" src="{{ url('uploads/'.$employee->file->new_name)}}" alt="">
    @endif
    <div class="back_employee_img">
        <h1 class="name_employee">{{$employee->name}}</h1>
        <h3 class="job_name">{{$employee->employee_job_name}}</h3>
    </div>

    <div class="icons">

        @if ($employee->employeeTotalRating > 0 && $employee->employeeTotalRating <= 20) <i class="fas fa-regular fa-star" style="font-size:16px;color:#f7ef31; "></i>
            @endif

            @if ($employee->employeeTotalRating >= 21 && $employee->employeeTotalRating <= 40) <i class="fas fa-regular fa-star" style="font-size:16px;color:#f7ef31; "></i>
                <i class="fas fa-regular fa-star" style="font-size:16px;color:#f7ef31; "></i>
                @endif

                @if ($employee->employeeTotalRating >= 41 && $employee->employeeTotalRating <= 60) <i class="fas fa-regular fa-star" style="font-size:16px;color:#f7ef31; "></i>
                    <i class="fas fa-regular fa-star" style="font-size:16px;color:#f7ef31; "></i>
                    <i class="fas fa-regular fa-star" style="font-size:16px;color:#f7ef31; "></i>
                    @endif

                    @if ($employee->employeeTotalRating >= 61 && $employee->employeeTotalRating <= 80) <i class="fas fa-regular fa-star" style="font-size:16px;color:#f7ef31; "></i>
                        <i class="fas fa-regular fa-star" style="font-size:16px;color:#f7ef31; "></i>
                        <i class="fas fa-regular fa-star" style="font-size:16px;color:#f7ef31; "></i>
                        <i class="fas fa-regular fa-star" style="font-size:16px;color:#f7ef31; "></i>
                        @endif

                        @if ($employee->employeeTotalRating >= 81 && $employee->employeeTotalRating <= 100) <i class="fas fa-regular fa-star" style="font-size:16px;color:#f7ef31; "></i>
                            <i class="fas fa-regular fa-star" style="font-size:16px;color:#f7ef31; "></i>
                            <i class="fas fa-regular fa-star" style="font-size:16px;color:#f7ef31; "></i>
                            <i class="fas fa-regular fa-star" style="font-size:16px;color:#f7ef31; "></i>
                            <i class="fas fa-regular fa-star" style="font-size:16px;color:#f7ef31; "></i>
                            @endif

    </div>
</div>

<h1 class="text_rating_employee">تقييم الموظف</h1>

<div class="bg_rating_employee">
    <div class="box-body">
        @if($employee->ratingForGuest->count())
        @foreach($employee->ratingForGuest as $key=>$employee_available_rating)
        <div class="rating_1">
            <div style="display:flex;margin-right:40px;margin-top:10px;padding-left:10px;">
                <label>
                    @foreach([1,2] as $i)

                    <?php $image = $i == 1 ? 'SadB' : 'HappyB' ?>

                    <img src="{{url('guest/images/'.$image.'.png')}}" class="{{$key.'__'.$i}}" id="{{$key.'__'.$i}}" style="font-size:50px;color:#fff; padding:5px; width:70px;height:70px; border-radius:100px;" name="{{$employee_available_rating->employeeAvailableRating->id}}" onclick="postRate(this)" />

                    @endforeach
                </label>

            </div>
            <h3 class="rate_name">{{$employee_available_rating->employeeAvailableRating->name_ar}}</h3>
        </div>
        @endforeach
        @endif
    </div>
</div>


<h1 class="text_rating_employee" id="note_header"> أضف تعليق</h1>
<div class="text">
    <textarea name="notes" id="notes" style="text-align: right;padding:50px"></textarea>
</div>
<button class="btn " onclick="sendEmployeeNote()">ارسال</button>



<h1 class="text_rating_employee" style="margin-top:70px;"> دفع مكافأة</h1>
<form role="form" action="{{url('guest/payment/pay-for-employee')}}" method="POST" class="paying" id="payform">
    <input type="hidden" name="client_id" value="{{Request('user')->client_id}}">
    <input type="hidden" name="company_id" value="{{Request('user')->company_id}}">
    <input type="hidden" name="employee_id" value="{{Request('user')->id}}">
    @csrf

    <div class="form-group">
        <div class="payerDataBox">
            <input class="form-control payerData" type="text" name="payer_name " id="payer_name" placeholder="الاسم">
            <label for="payer_name" class="col-md-4 payerName">الاسم</label>
        </div>
        <div class="payerDataBox">
            <input class="form-control payerData" type="text" name="payer_phone" id="payer_phone" placeholder="الهاتف">
            <label for="payer_phone" class="col-md-4 payerPhone">الهاتف</label>
        </div>
    </div>

    <div>
        <div class="payingButton">
            <button type="button" onclick="appendAmount(50)" dir="rtl">50 ريال</button>
            <button type="button" onclick="appendAmount(25)" dir="rtl">25 ريال</button>
            <button type="button" onclick="appendAmount(10)" dir="rtl">10 ريال</button>
            <button type="button" onclick="appendAmount(5)" dir="rtl">5 ريال</button>
        </div>
        <br>
        <br>
        <div class="anotherPriceBox">
            <input class="anotherPrice" type="number" name="amount" id="amount" placeholder="ادخل المبلغ" style="background-color: #14bbd8">
            <label for="amount" class="col-md-4">مبلغ اخر</label>

        </div>
        <div class="apple_pay">
            <button>
                <i class="fa-brands fa-apple" style="font-size: 30px;color:#14bbd8;"></i>
                Apple Pay
            </button>
        </div>


        <div class="visa">

            <div id="paymentErrors"></div>

            <div>
                <input required type="text" data-paylib="number" placeholder="Card Number" style="width:93%;height:43px;border-radius:5px;text-align:center;font-size: 14px; border: 1px solid #f7ef31;">>
            </div>

            <div class="input_visa">
                <input size="2" required type="text" data-paylib="expmonth" placeholder="MM" style="width:30%;height:50px;border-radius:5px;display:flex;text-align:center;font-size: 14px;transform: scale(1.1);  border: 1px solid #f7ef31;">
                <input size="4" required type="text" data-paylib="expyear" placeholder="YYYY" style="width:30%;height:50px;border-radius:5px;display:flex;text-align:center;font-size: 14px;transform: scale(1.1);  border: 1px solid #f7ef31;">
                <input size="3" required type="text" data-paylib="cvv" placeholder="CVV" style="width:30%;height:50px;border-radius:5px;display:flex;text-align:center;font-size: 14px;transform: scale(1.1);  border: 1px solid #f7ef31;">
            </div>
            <div class="input_visa_logo">
                <img src="{{url('guest/images/')}}/visa-dark-large.svg" alt="" style="width: 20%;height:auto;">
                <img src="{{url('guest/images/')}}/mastercard-dark-large.svg" alt="" style="width: 20%;height:auto;">
                <img src="{{url('guest/images/')}}/americanexpress-dark-large.svg" alt="" style="width: 20%;height:auto;">
            </div>
        </div>
        <button class="pay_btn" type="submit">ادفع</button>
    </div>
</form>
<div style="display:flex;flex-direction:row;margin-top:20px;">

    <p style="font-size:18px;color:#fff;font-weight: 200;">Powered by </p>
    <a href="{{url('/')}}" style="font-size:20px;text-decoration: none;color:#fff61a"> Tiposmart.com</a>
</div>


<script>
    function postRate(element) {

        let elementClass = element.className;
        let elementId = elementClass;

        let level = elementClass.split("__")[0];
        let value = elementClass.split("__")[1];


        if (value == 1) {
            document.getElementById(elementId).src = "{{url('guest')}}/images/" + "Sad" + ".png";
            document.getElementById(Number(level) + "__" + (Number(value) + 1)).src = "{{url('guest')}}/images/" + "HappyB" + ".png";
        } else {
            document.getElementById(elementId).src = "{{url('guest')}}/images/" + "Happy" + ".png";
            document.getElementById(Number(level) + "__" + (Number(value) - 1)).src = "{{url('guest')}}/images/" + "SadB" + ".png";
        }

        $.ajax({

            url: '{{url("api/guest/payment/employee-rating/".Request("user")->id)}}',
            type: 'POST',
            data: {
                rating_value: value,
                rating_id: element.name,
                guest_key: "{{Request()->session()->get('guest_key')}}",
            },
            dataType: 'json',
            success: function(response) {
                console.log(response);

                // if (value == 1) {
                //     document.getElementById(elementId).src = "{{url('guest')}}/images/" + "Sad" + ".png";
                //     document.getElementById(Number(level) + "__" + (Number(value) + 1)).src = "{{url('guest')}}/images/" + "HappyB" + ".png";
                // } else {
                //     document.getElementById(elementId).src = "{{url('guest')}}/images/" + "Happy" + ".png";
                //     document.getElementById(Number(level) + "__" + (Number(value) - 1)).src = "{{url('guest')}}/images/" + "SadB" + ".png";
                // }

            },
            error: function(request, error) {
                console.log("Request: " + JSON.stringify(request));
            }
        });
    }

    function sendEmployeeNote() {

        $.ajax({

            url: '{{url("api/guest/payment/pay-for-employee")}}',
            type: 'POST',
            data: {
                client_id: "{{Request('user')->client_id}}",
                company_id: "{{Request('user')->company_id}}",
                employee_id: "{{Request('user')->id}}",
                notes: document.getElementById('notes').value,
                payer_name: document.getElementById('payer_name').value,
                payer_phone: document.getElementById('payer_phone').value,
            },
            dataType: 'json',
            success: function(response) {

                document.getElementById('note_header').innerHTML = "تم ارسال التعليق";

            },
            error: function(request, error) {
                console.log("Request: " + JSON.stringify(request));
            }
        });
    }

    function appendAmount(amount) {
        document.getElementById("amount").value = Number(amount);
        document.getElementById("cart_amount").value = Number(amount);
    }
</script>

<script type="text/javascript">
    var myform = document.getElementById('payform');
    paylib.inlineForm({
        // 'key': 'C2KMDG-HTKK6H-K92GVT-RDTQ9T', old
        'key': 'CHKMDG-HTRK6H-V69G2K-HG6TM7',
        'form': myform,
        'autoSubmit': true,
        'callback': function(response) {
            document.getElementById('paymentErrors').innerHTML = '';
            if (response.error) {
                paylib.handleError(document.getElementById('paymentErrors'), response);
            }
        }
    });
</script>
