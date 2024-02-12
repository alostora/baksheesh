<section class="invoice" id="report">

    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                <i class="fa fa-globe"></i> AdminLTE, Inc.
                <small class="pull-right">Date: 2/10/2014</small>
            </h2>
        </div>
    </div>

    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            To
            <address>
                <strong>John Doe</strong><br>
                Email: john.doe@example.com
            </address>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xs-12">
            <div style="width:100%;">
                <table id="table" style="width:100%; justify-content:space-between;">
                    <tr style="width:100%; justify-content:space-between;  ">
                        <th style="text-align: center;">All Companies</th>
                        <th style="text-align: center;">Client Companies</th>
                        <th style="text-align: center;">Company</th>
                    </tr>

                    <tr style="width:100%; justify-content:space-between; text-align:center">
                        <td>{{$all_companies_amount}} SAR</td>
                        <td> <span>Client Name</span> {{$all_clients_amount}} SAR</td>
                        <td> <span>Company Name</span>{{$one_company_amount}} SAR</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</section>
