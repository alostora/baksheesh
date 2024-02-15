<section class="content">

    <div class="box box-info">
        @include('Client.Report.CompanyRating.Views.print')
        @include('Client/TableFilter/company_rating_report')

        <div class="box-header">
            <h3 class="box-title col-md-8">@lang('company_rating.page_title')</h3>
            <div class="col-md-4">

                <button class="btn bg-navy margin" style="height:25px;padding:2px;width:70px;" onclick="PrintElem()">
                    <i class="fa fa-print"></i>
                </button>

            </div>
        </div>

        <div class="box">
            <div class="box-body">
                <div class="col-sm-4 col-md-2">
                    <div class="color-palette-set">
                        <div class="bg-blue disabled color-palette">
                            <span>
                                @lang('general.total') : {{$total_good_count + $total_bad_count}}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-md-2">
                    <div class="color-palette-set">
                        <div class="bg-green disabled color-palette">
                            <span>
                                @lang('company_rating.total_good_count') : {{$total_good_count}}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-md-2">
                    <div class="color-palette-set">
                        <div class="bg-red disabled color-palette">
                            <span>
                                @lang('company_rating.total_bad_count') : {{$total_bad_count}}
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
                        <th>@lang('company_rating.client')</th>
                        <th>@lang('company_rating.company')</th>
                        <th>@lang('company_rating.available_rating')</th>
                        <th>@lang('company_rating.rating_value')</th>
                        <th>@lang('company_rating.payer_name')</th>
                        <th>@lang('company_rating.created_at')</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($company_ratings))
                    @foreach ($company_ratings as $key=>$company_rating)
                    <tr>
                        <td> {{$key+1}} </td>
                        <td> {{$company_rating->client ? $company_rating->client->name : ''}} </td>
                        <td> {{$company_rating->company ? $company_rating->company->name : ''}} </td>
                        <td> {{$company_rating->availableRating ? $company_rating->availableRating->name : ''}} </td>
                        <td>
                            {!! $company_rating->rating_value === 1 ? '<label class="label label-danger" style="font-size:12px">'.Lang::get("company_rating.bad").'</label>' : '<label class="label label-success" style="font-size:12px">'.Lang::get("company_rating.good").'</label>' !!}
                        </td>
                        <td> {{$company_rating->payer_name}} </td>
                        <td> {{$company_rating->created_at}} </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            <div class="box-footer clearfix">
                <ul class="pagination pagination-sm no-margin pull-right">
                    {{ $company_ratings->render( "pagination::bootstrap-4") }}
                </ul>
            </div>

        </div>
    </div>

</section>
<script>
    function PrintElem() {

        var mywindow = window.open(" ", "PRINT");

        mywindow.document.write('<html><head>');
        mywindow.document.write('</head><body dir="rtl">');
        mywindow.document.write(document.getElementById('report').innerHTML);
        mywindow.document.write('</body></html>');
        // mywindow.focus(); // necessary for IE >= 10*/

        mywindow.print();
    }
</script>
