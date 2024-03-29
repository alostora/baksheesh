<section class="content">
    <div class="box box-info">
        <!-- filter -->
        @include('Admin.Report.WithdrawalRequest.Views.print')
        <div class="no-print">
            @include('Admin/TableFilter/withdrawal_request_report')
        </div>
        <div class="box-header no-print">
            <h3 class="box-title col-md-8">@lang('withdrawal_request.page_title')</h3>
            <button class="btn bg-navy margin" style="height:25px;padding:2px;width:70px;" onclick="PrintElem()">
                <i class="fa fa-print"></i>
            </button>
        </div>

        <div class="box box-success no-print">
            <div class="box-body">
                <div class="col-sm-4 col-md-2">
                    <div class="color-palette-set">
                        <div class="bg-info disabled color-palette">
                            <span>
                                @lang('withdrawal_request.total') : {{$count_all}}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 col-md-2">
                    <div class="color-palette-set">
                        <div class="bg-blue disabled color-palette">
                            <span>
                                @lang('withdrawal_request.pending') : {{$count_pending}}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 col-md-2">
                    <div class="color-palette-set">
                        <div class="bg-green disabled color-palette">
                            <span>
                                @lang('withdrawal_request.accepted') : {{$count_accepted}}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 col-md-2">
                    <div class="color-palette-set">
                        <div class="bg-yellow disabled color-palette">
                            <span>
                                @lang('withdrawal_request.refused') : {{$count_refused}}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 col-md-2">
                    <div class="color-palette-set">
                        <div class="bg-default disabled color-palette">
                            <span>
                                @lang('withdrawal_request.unexecutable') : {{$count_unexecutable}}
                            </span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="box-body table-responsive no-padding">
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="background-color: #1fbdd9 !important;">#</th>
                        {{-- <th style="background-color: #1fbdd9 !important;">@lang('withdrawal_request.reference_code')</th>--}}
                        <th style="background-color: #1fbdd9 !important;">@lang('withdrawal_request.amount')</th>
                        <th style="background-color: #1fbdd9 !important;">@lang('withdrawal_request.status')</th>
                        <th style="background-color: #1fbdd9 !important;">@lang('withdrawal_request.created_at')</th>
                        <th style="background-color: #1fbdd9 !important;">@lang('withdrawal_request.action_at')</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $color = '' ?>
                    @if(!empty($withdrawalRequests))
                    @foreach ($withdrawalRequests as $key=>$withdrawalRequest)

                    @if($withdrawalRequest->withdrawalRequestStatus->code == App\Constants\HasLookupType\WithdrawalRequestStatus::PENDING['code'])
                    <?php $color = 'blue' ?>
                    @elseif($withdrawalRequest->withdrawalRequestStatus->code == App\Constants\HasLookupType\WithdrawalRequestStatus::ACCEPTED['code'])
                    <?php $color = 'green' ?>
                    @elseif($withdrawalRequest->withdrawalRequestStatus->code == App\Constants\HasLookupType\WithdrawalRequestStatus::REFUSED['code'])
                    <?php $color = 'orange' ?>
                    @endif

                    <tr>
                        <td> {{$key+1}} </td>
                        {{--<td> {{substr($withdrawalRequest->id, 0, 7)}} </td>--}}
                        <td> {{$withdrawalRequest->amount}} @lang('general.sar')</td>
                        <td>
                            <label class="label bg-{{$color}}">{{$withdrawalRequest->withdrawalRequestStatus->name}}</label>
                        </td>
                        <td> {{$withdrawalRequest->created_at}} </td>
                        <td> {{$withdrawalRequest->updated_at}} </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>

            <div class="box-footer clearfix">
                <ul class="pagination pagination-sm no-margin pull-right">
                    {{ $withdrawalRequests->appends($_GET)->render('pagination::bootstrap-4') }} }}
                </ul>
            </div>

        </div>
    </div>

</section>
