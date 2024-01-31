<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <!-- filter -->
            <div class="box box-warning">
                <div class="box-body">
                    <form role="form" action="{{url('admin/companies/search')}}" method="GET">

                        <div class="row">
                            <div class="col-sm-4 col-md-4">
                                <div class="input-group margin">
                                    <input type="text" class="form-control" name="query_string" value="{{Request('query_string')}}" placeholder="{{Lang::get('filter.query_string')}}">
                                    <span class="input-group-btn">
                                        <button type="submit" name="search" id="search-btn" class="btn btn-flat bg-orange">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4">
                                <div class="input-group margin">
                                    <select class="form-control select2" name="active">
                                        <option value="" {{Request('active') == "" ? "selected" : "";}}>@lang('filter.all')</option>
                                        <option value="active" {{Request('active') == "active" ? "selected" : "";}}>@lang('filter.active')</option>
                                        <option value="inactive" {{Request('active') == "inactive" ? "selected" : "";}}>@lang('filter.inactive')</option>
                                    </select>
                                    <span class="input-group-btn">
                                        <button type="submit" name="search" id="search-btn" class="btn btn-flat bg-orange">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-4 col-md-4">
                                <div class="input-group margin">
                                    <select class="form-control select2" name="client_id">
                                        <option value="">@lang('filter.clients')</option>
                                        @foreach($clients as $client)
                                        <?php $selected = Request('client_id') == $client->id ? "selected" : ""; ?>
                                        <option value="{{$client->id}}" {{$selected}}>{{$client->name}}</option>
                                        @endforeach
                                    </select>
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

            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title col-md-8">@lang('company.page_title')</h3>
                    <div class="col-md-4">
                        <a href="{{url('admin/company/create')}}" class="btn bg-olive btn-sm" style="height:25px;padding:2px;width:150px">
                            <i class="fa fa-plus"></i>
                            <span>@lang('company.create')</span>
                        </a>
                    </div>
                </div>

                <div class="box">
                    <div class="box-body">
                        <div class="col-sm-4 col-md-2">
                            <div class="color-palette-set">
                                <div class="bg-blue disabled color-palette">
                                    <span>
                                        @lang('general.total') : {{$count_inactive + $count_active}}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-2">
                            <div class="color-palette-set">
                                <div class="bg-green disabled color-palette">
                                    <span>
                                        @lang('general.active') : {{$count_active}}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 col-md-2">
                            <div class="color-palette-set">
                                <div class="bg-red disabled color-palette">
                                    <span>
                                        @lang('general.inactive') : {{$count_inactive}}
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
                                <th>@lang('company.qr')</th>
                                <th>@lang('company.file')</th>
                                <th>@lang('company.name')</th>
                                <th>@lang('company.client')</th>
                                <th>@lang('company.operations')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($companies))
                            @foreach ($companies as $key=>$company)
                            <tr>
                                <td> {{$key+1}} </td>
                                <td onclick="PrintElem('{{$company->name}}','{{$company->id}}')">
                                    <div id="{{$company->id}}">

                                        {!! $company->company_qr !!}
                                    </div>
                                </td>
                                <td>
                                    @if($company->file)
                                    <img src="{{ url('uploads/'.$company->file->new_name)}}" style="height:40px;width:40px;border-radius:50%">
                                    @endif
                                </td>
                                <td> {{$company->name}} </td>
                                <td> {{$company->client->name}} </td>
                                <td>

                                    <a href="{{url('admin/company/edit/'.$company->id)}}" class="btn btn-info btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <a href="{{url('guest/payment/pay-for-company/'.$company->id)}}" target="_blank" class="btn  bg-purple btn-sm">
                                        <i class="fa fa-link"></i>
                                    </a>

                                    <a href="{{url('admin/company-wallets?company_id='.$company->id.'&client_id='.$company->client_id)}}" class="btn bg-purple btn-sm">
                                        <i class="fa fa-info"></i> @lang('general.wallet') : ( {{$company->cash->sum('amount')}} )
                                    </a>

                                    <a href="{{url('admin/company-employees/search?company_id='.$company->id)}}" class="btn  bg-purple btn-sm">
                                        <i class="fa fa-info"></i> @lang('company.employees') : ( {{$company->employees->count()}} )
                                    </a>

                                    @if($company->stopped_at == null)
                                    <a href="{{url('admin/company-inactive/'.$company->id)}}" class="btn btn-success btn-sm">
                                        <i class="fa fa-check"></i> @lang('general.active')
                                    </a>
                                    @else

                                    <a href="{{url('admin/company-active/'.$company->id)}}" class="btn btn-danger btn-sm">
                                        <i class="fa fa-close"></i> @lang('general.inactive')
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            {{ $companies->render( "pagination::bootstrap-4") }}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<script>
    function PrintElem(companyName, companyId) {

        var mywindow = window.open('', 'PRINT', );

        mywindow.document.write('<html><head><title>' + companyName + '</title>');
        mywindow.document.write('</head><body >');
        mywindow.document.write('<h1>' + companyName + '</h1>');
        mywindow.document.write(document.getElementById(companyId).innerHTML);
        mywindow.document.write('</body></html>');

        mywindow.focus(); // necessary for IE >= 10*/

        mywindow.print();

        return true;
    }
</script>
