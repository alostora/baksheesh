<div class="logo_bg">
    @if ($employee->file)
    <img class="img-logo" src="{{ url('uploads/' . $employee->company->file->new_name) }}" alt="" height="150px;width:150px">
    @endif
</div>

<div class="employee_bg">
    @if ($employee->file)
    <img class="employee_img" src="{{ url('uploads/' . $employee->file->new_name) }}" alt="">
    @endif
    <div class="back_employee_img">
        <h1 class="name_employee">{{ $employee->name }}</h1>
        <h3 class="job_name">{{ $employee->employee_job_name }}</h3>
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
        @if ($employee->ratingForGuest->count())
        @foreach ($employee->ratingForGuest as $key => $employee_available_rating)
        <div class="rating_1">
            <div style="display:flex;margin-right:40px;margin-top:10px;padding-left:10px;">
                <label>
                    @foreach ([1, 2] as $i)
                    <?php $image = $i == 1 ? 'SadB' : 'HappyB'; ?>

                    <img src="{{ url('guest/images/' . $image . '.png') }}" class="{{ $key . '__' . $i }}" id="{{ $key . '__' . $i }}" style="font-size:50px;color:#fff; padding:5px; width:70px;height:70px; border-radius:100px;" name="{{ $employee_available_rating->employeeAvailableRating->id }}" onclick="postRate(this)" />
                    @endforeach
                </label>

            </div>
            <h3 class="rate_name">{{ $employee_available_rating->employeeAvailableRating->name_ar }}</h3>
        </div>
        @endforeach
        @endif
    </div>
</div>

<h1 class="text_rating_employee" id="note_header"> أضف تعليق</h1>

<form class="paying">
    <div class="form-group">
        <div class="payerDataBox" style="display:flex ;justify-content:space-between; text-align:center;align-items:center; ">
            <input class="form-control payerData" style="color:  #fff61a;" type="text" placeholder="الاسم" onkeyup="appendPayerName(this)">
            <label for="payer_name" class="col-md-4 payerName">الاسم</label>
        </div>
        <div class="payerDataBox" style="display:flex ;justify-content:space-between; text-align:center;align-items:center; ">
            <input class="form-control payerData" style="color:  #fff61a;" type="text" placeholder="الجوال" onkeyup="appendPayerPhone(this)">
            <label for="payer_phone" class="col-md-4 payerName">الجوال</label>
        </div>
        <div class="payerDataBox" style="display:flex ;justify-content:space-between; text-align:center;align-items:center; ">
            <textarea class="form-control payerData" name="notes" id="notes" style="color:  #fff61a; border-radius: 10px;text-align: right;padding:30px"></textarea>
            <label for="notes" class="col-md-4 payerName">التعليق</label>
        </div>
    </div>
    <div class="payerDataBox" style="display:flex ;justify-content:space-between; text-align:start; ">

        <button class="btn" onclick="sendEmployeeNote()" type="button">ارسال</button>
    </div>
    <br>
    <span id="noteErrorMsg" style="display:none;">من فضلك ادخل الاسم والجوال</span>
</form>




<h1 class="text_rating_employee" style="margin-top:70px;"> دفع مكافأة</h1>

<form role="form" action="{{ url('guest/payment/pay-for-employee') }}" method="POST" class="paying" id="payform">
    <input type="hidden" name="client_id" value="{{ Request('user')->client_id }}">
    <input type="hidden" name="company_id" value="{{ Request('user')->company_id }}">
    <input type="hidden" name="employee_id" value="{{ Request('user')->id }}">
    <input type="hidden" name="payer_name" id="payer_name" placeholder="الاسم" required>
    <input type="hidden" name="payer_phone" id="payer_phone" placeholder="الجوال" required>
    @csrf

    <div>
        <div class="payingButton">
            <button type="button" onclick="appendAmount(50)" dir="rtl">50 ريال</button>
            <button type="button" onclick="appendAmount(25)" dir="rtl">25 ريال</button>
            <button type="button" onclick="appendAmount(10)" dir="rtl">10 ريال</button>
        </div>
        <br>
        <br>

        <div class="anotherPriceBox">

            <input class="anotherPrice" type="hidden" name="amount" id="last_amount">
            <div class="payerDataBox" style="display:flex ;justify-content:space-between; text-align:center;align-items:center; ">
                <input class="anotherPrice" type="number" id="amount" placeholder="ادخل المبلغ" style="background-color: #14bbd8 ;color:  #fff61a;" onkeyup="appendAmount(this.value)">

                <label for="amount" class="col-md-4 payerName">مبلغ اخر</label>
            </div>
            <br>

            <span id="errorMsg" style="display:none;">لا يمكن اضافة اقل من 10 ريال</span>

        </div>
        <div id="invoice_details" class="inv_data" style="display: none;">

            <div dir="rtl" class="inv">
                <div>
                    <label class="col-sm-6">المبلغ</label>
                </div>
                <div>
                    <label style="color:darkgreen; font-size:16px" class="col-sm-6" id="tip_amount"></label>
                </div>
            </div>
            <hr>
            <div dir="rtl" class="inv">
                <div>
                    <label class="col-sm-6">رسوم الخدمة</label>
                </div>
                <div>
                    <label style="color:darkgreen; font-size:16px" class="col-sm-6" id="transaction_fees"></label>
                </div>
            </div>
            <hr>
            <div dir="rtl" class="inv">
                <div>
                    <label class="col-sm-6">الاجمالي</label>
                </div>
                <div>
                    <label style="color:darkgreen; font-size:16px" class="col-sm-6" id="total"></label>
                </div>
            </div>
        </div>
        <button class="pay_btn" type="submit" id="pay_btn" style="display: none;" onclick="disableBtn(this)">ادفع</button>
    </div>
</form>
<div style="display:flex;flex-direction:row;margin-top:20px;">
    <p style="font-size:18px;color:#fff;font-weight: 200;margin-right:5px">Powered by </p>
    <a href="{{ url('/') }}" style="font-size:20px;text-decoration: none;color:#fff61a"> Tiposmart.com</a>
</div>


<script>
    function postRate(element) {

        let elementClass = element.className;
        let elementId = elementClass;

        let level = elementClass.split("__")[0];
        let value = elementClass.split("__")[1];


        if (value == 1) {
            document.getElementById(elementId).src = "{{ url('guest') }}/images/" + "Sad" + ".png";
            document.getElementById(Number(level) + "__" + (Number(value) + 1)).src = "{{ url('guest') }}/images/" +
                "HappyB" + ".png";
        } else {
            document.getElementById(elementId).src = "{{ url('guest') }}/images/" + "Happy" + ".png";
            document.getElementById(Number(level) + "__" + (Number(value) - 1)).src = "{{ url('guest') }}/images/" +
                "SadB" + ".png";
        }

        $.ajax({

            url: "{{ url('api/guest/payment/employee-rating/' . Request('user')->id) }}",
            type: "POST",
            data: {
                rating_value: value,
                rating_id: element.name,
                guest_key: "{{ Request()->session()->get('guest_key') }}",
                payer_name: document.getElementById('payer_name').value,
                payer_phone: document.getElementById('payer_phone').value,
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

    function sendEmployeeNote() {

        let userName = $("#payer_name").val();
        let userPhone = $("#payer_phone").val();

        if (userName == '' || userPhone == '') {

            $('#noteErrorMsg').show();
            return false;
        }

        $('#noteErrorMsg').hide();

        $.ajax({

            url: "{{ url('api/guest/payment/employee-note') }}",
            type: 'POST',
            data: {
                client_id: "{{ Request('user')->client_id }}",
                company_id: "{{ Request('user')->company_id }}",
                employee_id: "{{ Request('user')->id }}",
                notes: document.getElementById('notes').value,
                payer_name: document.getElementById('payer_name').value,
                payer_phone: document.getElementById('payer_phone').value,
                guest_key: "{{ Request()->session()->get('guest_key') }}",
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

        if (amount < 10) {
            $('#errorMsg').show();
            $('#invoice_details').hide();
            $('#pay_btn').hide();
            return false;
        } else {
            $('#errorMsg').hide();
            $('#invoice_details').show();
            $('#pay_btn').show();
        }

        var transaction_fees = (Number(amount) * (5 / 100)) + 2;
        var total = Number(amount) + transaction_fees;

        document.getElementById("tip_amount").innerHTML = Number(amount);
        document.getElementById("transaction_fees").innerHTML = Number(transaction_fees);
        document.getElementById("total").innerHTML = Number(total);
        document.getElementById("last_amount").value = Number(total);
        document.getElementById("amount").value = Number(amount);

    }

    function appendPayerName(e) {
        document.getElementById('payer_name').value = e.value
    }

    function appendPayerPhone(e) {
        document.getElementById('payer_phone').value = e.value
    }

    function disableBtn(e) {
        $('#pay_btn').hide();
    }
</script>
