<section class="content">
    <div class="box box-info">
        @include('Admin.Report.CompanyNotes.Views.print')

        <div class="no-print">
            @include('Admin/TableFilter/company_notes_report')
        </div>

        <div class="box-header no-print">
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
                        <th style="background-color: #1fbdd9 !important;" class="no-print">#</th>
                        <th style="background-color: #1fbdd9 !important;">@lang('company_notes.payer_name')</th>
                        <th style="background-color: #1fbdd9 !important;">@lang('company_notes.client')</th>
                        <th style="background-color: #1fbdd9 !important;">@lang('company_notes.notes')</th>
                        <th style="background-color: #1fbdd9 !important;">@lang('company_notes.created_at')</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($company_notes))
                    @foreach ($company_notes as $key=>$company_note)
                    <tr>
                        <td class="no-print"> {{$key+1}} </td>
                        <td> {{$company_note->payer_name}} <br> {{$company_note->payer_phone}} </td>
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
                    {{ $company_notes->appends($_GET)->render('pagination::bootstrap-4') }}
                </ul>
            </div>

        </div>
    </div>
</section>
