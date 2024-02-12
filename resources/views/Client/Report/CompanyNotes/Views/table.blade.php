<section class="content">
    <div class="box box-info">
    @include('Client.Report.CompanyNotes.Views.print')

        @include('Client/TableFilter/company_notes_report')

        <div class="box-header">
            <h3 class="box-title col-md-8">@lang('company_notes.page_title')</h3>
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
                        <th>@lang('company_notes.payer_name')</th>
                        <th>@lang('company_notes.client')</th>
                        <th>@lang('company_notes.notes')</th>
                        <th>@lang('company_notes.created_at')</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($company_notes))
                    @foreach ($company_notes as $key=>$company_note)
                    <tr>
                        <td> {{$key+1}} </td>
                        <td> {{$company_note->payer_name}} </td>
                        <td> {{$company_note->client?$company_note->client->name : ''}} </td>
                        <td> {{$company_note->notes}} </td>
                        <td> {{$company_note->created_at}} </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            <div class="box-footer clearfix">
                <ul class="pagination pagination-sm no-margin pull-right">
                    {{ $company_notes->render( "pagination::bootstrap-4") }}
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
