    @include('Guest.CompanyPayment.Parts.cardInfo')
    @include('Guest.CompanyPayment.Parts.rating')
    @include('Guest.CompanyPayment.Parts.comment')
    @include('Guest.CompanyPayment.Parts.payment')

    <script>
        function postRate(element) {

            let userName = $("#payer_name").val();
            let userPhone = $("#payer_phone").val();
            let garageName = $("#garage_name").val();

            if (userName == '' || userPhone == '') {

                $('#noteErrorMsg').show();
                {{-- return false; --}}
            }

            $('#noteErrorMsg').hide();

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
                    garage_name: document.getElementById('garage_name').value,
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                },
                error: function(request, error) {
                    console.log("Request: " + JSON.stringify(request));
                    $('#noteErrorMsg').show();
                }
            });
        }

        function sendCompanyNote() {

            let userName = $("#payer_name").val();
            let userPhone = $("#payer_phone").val();
            let garageName = $("#garage_name").val();

            if (userName == '' || userPhone == '') {

                $('#noteErrorMsg').show();
                {{-- return false; --}}
            }
            $('#noteErrorMsg').hide();

            $.ajax({

                url: "{{ url('api/guest/payment/company-note') }}",
                type: 'POST',
                data: {
                    client_id: "{{ Request('company')->client_id }}",
                    company_id: "{{ Request('company')->id }}",
                    notes: document.getElementById('notes').value,
                    payer_name: document.getElementById('payer_name').value,
                    payer_phone: document.getElementById('payer_phone').value,
                    garage_name: document.getElementById('garage_name').value,
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

            if (amount < 25) {
                $('#errorMsg').show();
                $('#invoice_details').hide();
                $('#pay_btn').prop("disabled", true);
                return false;
            } else {
                $('#errorMsg').hide();
                $('#invoice_details').show();
                $('#pay_btn').removeAttr('disabled');
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

        function appendGarageName(e) {
            document.getElementById('garage_name').value = e.value
        }

        function disableBtn(e) {
            $('#pay_btn').hide();
            // $('#pay_btn').prop("disabled", true);
        }
    </script>
