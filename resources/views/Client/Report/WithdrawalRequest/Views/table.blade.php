<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <!-- filter -->
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('filter.filter')</h3> <i class="fa fa-filter"></i>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <form role="form" action="{{url('client/withdrawal-request-report')}}" method="GET">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('filter.date_from')</label>
                                    <input type="date" name="date_from" value="{{Request('date_from')}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('filter.date_to')</label>
                                    <input type="date" name="date_to" value="{{Request('date_to')}}" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6">
                                    <label>@lang('filter.status')</label>
                                    <select class="form-control select2" name="status">
                                        <option value="">@lang('filter.select')</option>
                                        @foreach($withdrawal_request_status as $withdrawal_status)
                                        <?php $selected = Request('status') == $withdrawal_status->id ? "selected" : ""; ?>
                                        <option value="{{$withdrawal_status->id}}" {{$selected}}>{{app()->getLocale() == 'ar' ? $withdrawal_status->name_ar : $withdrawal_status->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label>@lang('filter.query_string')</label>
                                    <input type="text" name="query_string" value="{{Request('query_string')}}" placeholder="{{Lang::get('filter.query_string')}}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right">@lang('filter.search')</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title col-md-8">@lang('withdrawal_request.page_title')</h3>
                    <div class="col-md-4">

                    </div>
                </div>

                <div class="box">
                    <div class="box-body">
                        <div class="col-sm-4 col-md-2">
                            <div class="color-palette-set">
                                <div class="bg-green disabled color-palette">
                                    <span>
                                        @lang('sidebar.withdrawal_requests') : {{$withdrawal_requests ? $withdrawal_requests->count() : 0}}
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
                                <th>@lang('withdrawal_request.reference_code')</th>
                                <th>@lang('withdrawal_request.amount')</th>
                                <th>@lang('withdrawal_request.status')</th>
                                <th>@lang('withdrawal_request.created_at')</th>
                                <th>@lang('withdrawal_request.action_at')</th>
                                <th>@lang('withdrawal_request.bank_transfer_number')</th>
                                <th>@lang('withdrawal_request.admin_notes')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($withdrawal_requests))
                            @foreach ($withdrawal_requests as $key=>$withdrawal_request)

                            @if($withdrawal_request->withdrawalRequestStatus->code == App\Constants\HasLookupType\WithdrawalRequestStatus::PENDING['code'])
                            <?php $color = 'blue' ?>
                            @elseif($withdrawal_request->withdrawalRequestStatus->code == App\Constants\HasLookupType\WithdrawalRequestStatus::ACCEPTED['code'])
                            <?php $color = 'green' ?>
                            @elseif($withdrawal_request->withdrawalRequestStatus->code == App\Constants\HasLookupType\WithdrawalRequestStatus::REFUSED['code'])
                            <?php $color = 'orange' ?>
                            @endif

                            <tr>
                                <td> {{$key+1}} </td>
                                <td> {{substr($withdrawal_request->id, 0, 7)}} </td>
                                <td> {{$withdrawal_request->amount}} </td>
                                <td>
                                    <label class="label bg-{{$color}}">{{$withdrawal_request->withdrawalRequestStatus->name}}</label>
                                </td>
                                <td> {{$withdrawal_request->created_at}} </td>
                                <td> {{$withdrawal_request->updated_at}} </td>
                                <td> {{$withdrawal_request->bank_transfer_number}} </td>
                                <td> {{$withdrawal_request->admin_notes}} </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>

                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            {{ $withdrawal_requests->render( "pagination::bootstrap-4") }}
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
