<div class="logo_bg" style="display: none;">
    @if ($company->file)
    <img class="img-logo" src="{{ url('uploads/' . $company->file->new_name) }}" alt="" height="150px;width:150px">
    @endif
</div>

<div class="employee_bg">
    @if ($company->file)
    <img class="employee_img" src="{{ url('uploads/' . $company->file->new_name) }}" alt="">
    @endif
    <div class="back_employee_img">
        <h1 class="name_employee">{{ $company->name }}</h1>
        <h3 class="job_name">{{ $company->company_field }}</h3>
    </div>

    <div class="icons">

        @if ($company->companyTotalRating > 0 && $company->companyTotalRating <= 20) <i class="fas fa-regular fa-star" style="font-size:16px;color:#f7ef31; "></i>
            @endif

            @if ($company->companyTotalRating >= 21 && $company->companyTotalRating <= 40) <i class="fas fa-regular fa-star" style="font-size:16px;color:#f7ef31; "></i>
                <i class="fas fa-regular fa-star" style="font-size:16px;color:#f7ef31; "></i>
                @endif

                @if ($company->companyTotalRating >= 41 && $company->companyTotalRating <= 60) <i class="fas fa-regular fa-star" style="font-size:16px;color:#f7ef31; "></i>
                    <i class="fas fa-regular fa-star" style="font-size:16px;color:#f7ef31; "></i>
                    <i class="fas fa-regular fa-star" style="font-size:16px;color:#f7ef31; "></i>
                    @endif

                    @if ($company->companyTotalRating >= 61 && $company->companyTotalRating <= 80) <i class="fas fa-regular fa-star" style="font-size:16px;color:#f7ef31; "></i>
                        <i class="fas fa-regular fa-star" style="font-size:16px;color:#f7ef31; "></i>
                        <i class="fas fa-regular fa-star" style="font-size:16px;color:#f7ef31; "></i>
                        <i class="fas fa-regular fa-star" style="font-size:16px;color:#f7ef31; "></i>
                        @endif

                        @if ($company->companyTotalRating >= 81 && $company->companyTotalRating <= 100) <i class="fas fa-regular fa-star" style="font-size:16px;color:#f7ef31; "></i>
                            <i class="fas fa-regular fa-star" style="font-size:16px;color:#f7ef31; "></i>
                            <i class="fas fa-regular fa-star" style="font-size:16px;color:#f7ef31; "></i>
                            <i class="fas fa-regular fa-star" style="font-size:16px;color:#f7ef31; "></i>
                            <i class="fas fa-regular fa-star" style="font-size:16px;color:#f7ef31; "></i>
                            @endif

    </div>
</div>

<h1 class="text_rating_employee">تقييم الشركة</h1>

<div class="bg_rating_employee">
    <div class="box-body">
        @if (count($company->ratingForGuest))
        @foreach ($company->ratingForGuest as $key => $company_available_rating)
        <div class="rating_1">
            <div style="display:flex;margin-right:40px;margin-top:10px;padding-left:10px;">
                <label>
                    @foreach ([1, 2] as $i)
                    <?php $image = $i == 1 ? 'SadB' : 'HappyB'; ?>

                    <img src="{{ url('guest/images/' . $image . '.png') }}" class="{{ $key . '__' . $i }}" name="{{ $company_available_rating->companyAvailableRating->id }}" value="{{ $i }}" onclick="postRate(this)" id="{{ $key . '__' . $i }}" style="font-size:50px;color:#fff; padding:5px; width:70px;height:70px; border-radius:100px;" />
                    @endforeach
                </label>

            </div>
            <h3 class="rate_name">{{ $company_available_rating->companyAvailableRating->name_ar }}</h3>
        </div>
        @endforeach
        @endif
    </div>
</div>


<h1 class="text_rating_employee" id="note_header"> أضف تعليق</h1>
<div class="text">
    <textarea name="notes" id="notes" style="text-align: right;padding:50px"></textarea>
</div>
<button class="btn" onclick="sendCompanyNote()">ارسال</button>


<h1 class="text_rating_employee" style="margin-top:80px;"> دفع مكافأة</h1>

<form role="form" action="{{ url('guest/payment/pay-for-company') }}" method="POST" class="paying" id="payform">


    @if ($errors->any())
    <div class="alert alert-warning col-md-6" style="margin-top: 60px;">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if (session()->has('success'))
    <div class="alert alert-success col-md-6" style="margin-top: 60px;">
        <ul>
            <li>{{ session('success') }}</li>
        </ul>
    </div>
    @endif

    @if (session()->has('error'))
    <div class="alert alert-success col-md-6" style="margin-top: 60px;">
        <ul>
            <li>{{ session('error') }}</li>
        </ul>
    </div>
    @endif

    <input type="hidden" name="client_id" value="{{ Request('company')->client_id }}">
    <input type="hidden" name="company_id" value="{{ Request('company')->id }}">
    @csrf

    <div class="form-group">
        <div class="payerDataBox">
            <input class="form-control payerData" type="text" name="payer_name" id="payer_name" placeholder="الاسم">
            <label for="payer_name" class="col-md-4 payerName">الاسم</label>
        </div>
        <div class="payerDataBox">
            <input class="form-control payerData" type="text" name="payer_phone" id="payer_phone" placeholder="الهاتف">
            <label for="payer_phone" class="col-md-4 payerPhone">الهاتف</label>
        </div>
    </div>

    <div class="payingButton">
        <button type="button" onclick="appendAmount(50)" dir="rtl">50 ريال</button>
        <button type="button" onclick="appendAmount(25)" dir="rtl">25 ريال</button>
        <button type="button" onclick="appendAmount(10)" dir="rtl">10 ريال</button>
        <button type="button" onclick="appendAmount(5)" dir="rtl">5 ريال</button>
    </div>
    <br>
    <br>

    <div class="anotherPriceBox">

        <input class="anotherPrice" type="hidden" name="amount" id="last_amount">

        <input class="anotherPrice" type="number" id="amount" placeholder="ادخل المبلغ" style="background-color: #14bbd8" onkeyup="appendAmount(this.value)">

        <label for="amount" class="col-md-4">مبلغ اخر</label>

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
    <!-- <div class="apple_pay">
        <button>
            <i class="fa-brands fa-apple" style="font-size: 30px;color:#14bbd8;"></i>
            Apple Pay
        </button>
    </div> -->
    <input type="submit" value="ادفع" class="pay_btn">
</form>
<div style="display:flex;flex-direction:row;letter-spacing: 2p;margin-top:20px;">

    <p style="font-size:18px;color:#fff;font-weight: 200;">Powered by </p>
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

            url: "{{ url('api/guest/payment/company-rating/' . Request('company')->id) }}",
            type: 'POST',
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

    function sendCompanyNote() {

        $.ajax({

            url: "{{ url('api/guest/payment/company-note') }}",
            type: 'POST',
            data: {
                client_id: "{{ Request('company')->client_id }}",
                company_id: "{{ Request('company')->id }}",
                notes: document.getElementById('notes').value,
                payer_name: document.getElementById('payer_name').value,
                payer_phone: document.getElementById('payer_phone').value,
                guest_key: "{{ Request()->session()->get('guest_key') }}",
            },
            dataType: 'json',
            success: function(response) {

                // document.getElementById('notes').value = "";
                document.getElementById('note_header').innerHTML = "تم ارسال التعليق";

            },
            error: function(request, error) {
                console.log("Request: " + JSON.stringify(request));

            }
        });

    }

    function appendAmount(amount) {

        var transaction_fees = (Number(amount) * (5 / 100)) + 2;

        var total = Number(amount) + transaction_fees;

        document.getElementById("tip_amount").innerHTML = Number(amount);

        document.getElementById("transaction_fees").innerHTML = Number(transaction_fees);

        document.getElementById("total").innerHTML = Number(total);
        document.getElementById("last_amount").value = Number(total);

        document.getElementById("amount").value = Number(amount);

        document.getElementById("invoice_details").style = "display:block";

    }
</script>
