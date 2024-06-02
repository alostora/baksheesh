<section class="bg">
    <!-- filter -->
    @include('Guest/TableFilter/employee')
    <div class="box-header">
        <h3 class="box-title col-md-8">@lang('company_employee.page_title')</h3>
    </div>

    <div class="box-body">
        <table id="example2" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>@lang('company_employee.file')</th>
                    <th>@lang('company_employee.name')</th>
                    <th>@lang('company_employee.employee_job_name')</th>
                    <th>@lang('company_employee.payment_page')</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($employees))
                    @foreach ($employees as $key => $user)
                        <tr>
                            <td> {{ $key + 1 }} </td>
                            <td>
                                @if ($user->file)
                                    <img src="{{ url('uploads/' . $user->file->new_name) }}"
                                        style="height:40px;width:40px;border-radius:50%">
                                @endif
                            </td>
                            <td> {{ $user->name }} </td>
                            <td> {{ $user->employee_job_name }} </td>
                            <td>
                                <a href="{{ url('guest/payment/pay-for-employee/' . $user->id) }}" target="_blank"
                                    class="btn bg-purple btn-sm">
                                    <i class="fa fa-link"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <div class="box-footer clearfix">
            <ul class="pagination pagination-sm no-margin pull-right">
                {{ $employees->appends($_GET)->render('pagination::bootstrap-4') }}
            </ul>
        </div>
    </div>

</section>


<script>
    function PrintQr(userName, userId) {

        var mywindow = window.open(" ", "PRINT");

        mywindow.document.write('<html><head><title>' + userName + '</title>');
        mywindow.document.write('</head><body >');
        mywindow.document.write('<h1>' + userName + '</h1>');
        mywindow.document.write(document.getElementById(userId).innerHTML);
        mywindow.document.write('</body></html>');


        mywindow.focus(); // necessary for IE >= 10*/
        mywindow.print();
        mywindow.close();
    }
</script>
