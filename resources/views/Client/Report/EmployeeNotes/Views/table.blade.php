<section class="content">
    <div class="box box-info">
    @include('Client.Report.EmployeeNotes.Views.print')

        @include('Client/TableFilter/employee_notes_report')

        <div class="box-header">
            <h3 class="box-title col-md-8">@lang('employee_notes.page_title')</h3>
            <div class="col-md-4">

<button class="btn bg-navy margin" style="height:25px;padding:2px;width:70px;" onclick="PrintElem()">
    <i class="fa fa-print"></i>
</button>

</div>
        </div>
        <div class="box-body">
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('employee_notes.payer_name')</th>
                        <th>@lang('employee_notes.client')</th>
                        <th>@lang('employee_notes.notes')</th>
                        <th>@lang('employee_notes.created_at')</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($employee_notes))
                    @foreach ($employee_notes as $key=>$employee_note)
                    <tr>
                        <td> {{$key+1}} </td>
                        <td> {{$employee_note->payer_name}} </td>
                        <td> {{$employee_note->client?$employee_note->client->name : ''}} </td>
                        <td> {{$employee_note->notes}} </td>
                        <td> {{$employee_note->created_at}} </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            <div class="box-footer clearfix">
                <ul class="pagination pagination-sm no-margin pull-right">
                    {{ $employee_notes->render( "pagination::bootstrap-4") }}
                </ul>
            </div>

        </div>
    </div>
</section>
<script>
  

    function PrintElem() {

        var mywindow = window.open(" ", "PRINT");

        mywindow.document.write('<html><head><title>' + "test report print" + '</title>');
        mywindow.document.write('</head><body >');
        mywindow.document.write(document.getElementById('report').innerHTML);
        mywindow.document.write('</body></html>');

        // mywindow.focus(); // necessary for IE >= 10*/


        mywindow.print();
    }
</script>