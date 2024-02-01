<section class="content">


    <div class="box box-info">

        @include('Client/TableFilter/company_wallet')
        
        <div class="box-header">
            <h3 class="box-title col-md-8">@lang('company_wallet.page_title')</h3>
        </div>

        <div class="box">
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
                        <th>@lang('company_wallet.client')</th>
                        <th>@lang('company_wallet.company')</th>
                        <th>@lang('company_wallet.amount')</th>
                        <th>@lang('company_wallet.created_at')</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($wallets))
                    @foreach ($wallets as $key=>$wallet)
                    <tr>
                        <td> {{$key+1}} </td>
                        <td> {{$wallet->client->name}} </td>
                        <td> {{$wallet->company->name}} </td>
                        <td> {{$wallet->amount}} </td>
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
</script>
