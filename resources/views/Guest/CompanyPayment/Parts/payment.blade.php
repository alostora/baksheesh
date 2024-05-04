<div class="comp_title">
    <h3>دفع مكافأه</h3>
</div>

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
    <input type="hidden" name="payer_name" id="payer_name" placeholder="الاسم" required>
    <input type="hidden" name="payer_phone" id="payer_phone" placeholder="الجوال" required>
    @csrf

    <center>
        <div class="paying_bg">
            <div class="paying_button" onclick="appendAmount(10)">10</div>
            <div class="paying_button" onclick="appendAmount(25)">25</div>
            <div class="paying_button" onclick="appendAmount(50)">50</div>
            <div class="paying_button" onclick="appendAmount(75)">75</div>
            <div class="paying_button" onclick="appendAmount(100)">100</div>
        </div>
    </center>

    <div class="comment_row another_price">
        <input class="anotherPrice" type="hidden" name="amount" id="last_amount">
        <input class="input_name another_price_input" min="10" type="number" id="amount" placeholder="ادخل المبلغ" onkeyup="appendAmount(this.value);">
        <label for="amount" class="label_name">مبلغ اخر</label>
    </div>

    <br>
    <span id="errorMsg" style="display:none;">لا يمكن اضافة اقل من 10 ريال</span>


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

    <button class="pay_btn" type="submit" id="pay_btn" disabled onclick="disableBtn(this)">دفع</button>
</form>

<div style="flex-direction:row;letter-spacing: 2p;text-align:center">

    <p style="font-size:18px;color:#fff;font-weight: 200;margin-right:5px">Powered by </p>
    <a href="{{ url('https://tiposmart.com') }}" style="font-size:20px;text-decoration: none;color:#4e5458"> Tiposmart.com</a>
</div>
