<section class="content">
    <div class="box box-info">
        <!-- filter -->
        @include('Admin.Report.EmployeeWallet.Views.print')
        @include('Admin/TableFilter/employee_wallet_report')
        <div class="box-header">
            <h3 class="box-title col-md-8">@lang('employee_wallet.page_title')</h3>
            <button class="btn bg-navy margin" style="height:25px;padding:2px;width:70px;" onclick="PrintElem()">
                <i class="fa fa-print"></i>
            </button>
        </div>



        <div class="box box-success">
            <div class="box-body">
                <div class="col-sm-4 col-md-2">
                    <div class="color-palette-set">
                        <div class="bg-blue disabled color-palette">
                            <span>
                                @lang('general.total') : {{$count_total}}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-body">
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('employee_wallet.client')</th>
                        <th>@lang('employee_wallet.company')</th>
                        <th>@lang('employee_wallet.employee')</th>
                        <th>@lang('employee_wallet.amount')</th>
                        <th>@lang('employee_wallet.created_at')</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($wallets))
                    @foreach ($wallets as $key=>$wallet)
                    <tr>
                        <td> {{$key+1}} </td>
                        <td> {{$wallet->client ? $wallet->client->name : ''}} </td>
                        <td> {{$wallet->company ? $wallet->company->name : ''}} </td>
                        <td> {{$wallet->employee ? $wallet->employee->name : ''}} </td>
                        <td> {{$wallet->amount}} @lang('general.sar')</td>
                        <td> {{$wallet->created_at}} </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>

            <div class="box-footer clearfix">
                <ul class="pagination pagination-sm no-margin pull-right">
                    {{ $wallets->render( "pagination::bootstrap-4") }}
                </ul>
            </div>
        </div>
    </div>
</section>


<script>
    function getEmployees(client_id = "", company_id = "") {

        $.ajax({

            url: '{{url("admin/employees?client_id=")}}' + client_id + '&company_id=' + company_id,
            type: 'GET',
            data: {},
            dataType: 'json',
            success: function(response) {

                let result = response.data;

                $("#employee_id").html(`<option value=''>@lang('filter.select')</option>`)

                for (let i = 0; i < result.length; i++) {

                    $("#employee_id").append(`<option value='${result[i].id}'>${result[i].name}</option>`)

                }
            },
            error: function(request, error) {
                console.log("Request: " + JSON.stringify(request));
            }
        });
    }

    function getCompanies(client_id) {

        $.ajax({

            url: '{{url("admin/companies/all?client_id=")}}' + client_id,
            type: 'GET',
            data: {},
            dataType: 'json',
            success: function(response) {

                let result = response.data;

                $("#company_id").html(`<option value=''>@lang('filter.select')</option>`)

                for (let i = 0; i < result.length; i++) {

                    $("#company_id").append(`<option value='${result[i].id}'>${result[i].name}</option>`);
                    console.log(result[i]);


                }
            },
            error: function(request, error) {
                console.log("Request: " + JSON.stringify(request));
            }
        });
    }

    function PrintElem() {

        var mywindow = window.open(" ", "PRINT");

        mywindow.document.write('<html><head>');
        mywindow.document.write('</head><body dir="rtl">');
        mywindow.document.write('<h1>' + 'test report print' + '</h1>');
        mywindow.document.write(document.getElementById('report').innerHTML);
        mywindow.document.write('</body></html>');

        // mywindow.focus(); // necessary for IE >= 10*/


        mywindow.print();
    }
</script>
