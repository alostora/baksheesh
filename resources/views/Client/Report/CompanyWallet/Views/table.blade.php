<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <!-- filter -->
            <div class="box box-warning">
                <div class="box-body">
                    <form role="form" action="{{url('client/company-wallet-report')}}" method="GET">
                        <div class="col-md-6">
                            <div class="input-group margin">
                                <input type="date" name="date_from" value="{{Request('date_from')}}" class="form-control">
                                <span class="input-group-btn">
                                    <button type="submit" name="search" id="search-btn" class="btn btn-flat bg-orange">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group margin">
                                <input type="date" name="date_to" value="{{Request('date_to')}}" class="form-control">
                                <span class="input-group-btn">
                                    <button type="submit" name="search" id="search-btn" class="btn btn-flat bg-orange">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-group margin">
                                <select class="form-control select2" name="company_id" id="company_id">
                                    <option value="">@lang('filter.companies')</option>
                                    @foreach($companies as $company)
                                    <?php $selected = Request('company_id') == $company->id ? "selected" : ""; ?>
                                    <option value="{{$company->id}}" {{$selected}}>{{$company->name}}</option>
                                    @endforeach
                                </select>
                                <span class="input-group-btn">
                                    <button type="submit" name="search" id="search-btn" class="btn btn-flat bg-orange">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="box box-info">
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
