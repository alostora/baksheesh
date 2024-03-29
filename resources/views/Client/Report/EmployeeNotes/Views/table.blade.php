<section class="content">
    <div class="box box-info">

        @include('Client.Report.EmployeeNotes.Views.print')

        <div class="no-print">
            @include('Client/TableFilter/employee_notes_report')
        </div>

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
                        <th style="background-color: #1fbdd9 !important;" class="no-print">#</th>
                        <th style="background-color: #1fbdd9 !important;">@lang('employee_notes.payer_name')</th>
                        <th style="background-color: #1fbdd9 !important;">@lang('employee_notes.client')</th>
                        <th style="background-color: #1fbdd9 !important;">@lang('employee_notes.notes')</th>
                        <th style="background-color: #1fbdd9 !important;">@lang('employee_notes.created_at')</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($employee_notes))
                    @foreach ($employee_notes as $key=>$employee_note)
                    <tr>
                        <td class="no-print"> {{$key+1}} </td>
                        <td> {{$employee_note->payer_name}} <br> {{$employee_note->payer_phone}} </td>
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
                    {{ $employee_notes->appends($_GET)->render('pagination::bootstrap-4') }}
                </ul>
            </div>
        </div>
    </div>
</section>
