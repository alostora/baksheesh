<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <!-- filter -->
            <div class="box box-success">

                <div class="box-body">
                    <form role="form" action="{{url('client/company-wallets')}}" method="GET">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group margin">
                                    <select class="form-control select2" name="company_id" style="width: 100%;">
                                        <option value="">@lang('company_wallet.select')</option>
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
                            <div class="col-md-6">
                                <div class="input-group margin">
                                    <input type="date" name="date_from" value="{{Request('date_from')}}" class="form-control" style="width: 100%;">
                                    <span class="input-group-btn">
                                        <button type="submit" name="search" id="search-btn" class="btn btn-flat bg-orange">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group margin">
                                    <input type="date" name="date_to" value="{{Request('date_to')}}" class="form-control" style="width: 100%;">
                                    <span class="input-group-btn">
                                        <button type="submit" name="search" id="search-btn" class="btn btn-flat bg-orange">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="box">
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
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($wallets))
                            @foreach ($wallets as $key=>$wallet)
                            <tr>
                                <td> {{$key+1}} </td>
                                <td> {{$wallet->client->name}} </td>
                                <td> {{$wallet->company ? $wallet->company->name : ''}} </td>
                                <td> {{$wallet->amount}} </td>
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
