<aside class="main-sidebar">

    <section class="sidebar">

        <ul class="sidebar-menu" data-widget="tree">

            <li class="header">
                @if(in_array(auth()->user()->accountType->code,[\App\Constants\HasLookupType\UserAccountType::ADMIN['code'],\App\Constants\HasLookupType\UserAccountType::ROOT['code']]))
                <a href="{{url('admin')}}">@lang('sidebar.home')</a>
                @elseif(in_array(auth()->user()->accountType->code,[\App\Constants\HasLookupType\UserAccountType::CLIENT['code']]))
                <a href="{{url('client')}}">@lang('sidebar.home')</a>
                @endif

            </li>

            @if(in_array(auth()->user()->accountType->code,[\App\Constants\HasLookupType\UserAccountType::ADMIN['code'],\App\Constants\HasLookupType\UserAccountType::ROOT['code']]))

            <?php
            $info = \App\Foundations\SideBar\SideBarCollection::adminSideBarInfo();
            ?>

            <li class="active treeview">

                <a href="#">
                    <i class="fa fa-th-large"></i> <span>@lang('sidebar.dashboard')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu level-two">

                    <!-- countries -->
                    <li>
                        <a href="{{url('admin/countries')}}">
                            <i class="fa fa-flag"></i>@lang('sidebar.countries')
                        </a>
                    </li>


                    <!-- governorates -->
                    <li>
                        <a href="{{url('admin/governorates-search-all')}}">
                            <i class="fa fa-map"></i>@lang('sidebar.governorates')
                        </a>
                    </li>

                    <!-- users -->
                    <li>
                        <a href="{{url('admin/users')}}">
                            <i class="fa  fa-users"></i>@lang('sidebar.users')
                            <span class="pull-right-container">
                                <small class="label pull-right bg-yellow">{{$info['users_count']}}</small>
                            </span>
                        </a>
                    </li>

                    <!-- clients -->
                    <li class=" treeview ">
                        <a href="#" style="padding: 10px !important;">
                            <i class="ion ion-ios-people"></i> <span>@lang('sidebar.clients')</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>

                        <ul class="treeview-menu">

                            <li>
                                <a href="{{url('admin/clients/search?active=active')}}">
                                    <div class="col-md-12">
                                        <i class="ion ion-ios-people"></i> @lang('sidebar.edit_client')
                                        <span class="pull-right-container">
                                            <small class="label pull-right bg-primary">{{$info['clients_count']}}</small>
                                        </span>
                                    </div>
                                </a>
                            </li>

                            <li>
                                <a href="{{url('admin/client/create')}}">

                                    <div class="col-md-12">
                                        <i class="fa fa-user-plus"></i> @lang('sidebar.create_new_client')
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- companies -->
                    <li class=" treeview ">
                        <a href="#" style="padding: 10px !important;">
                            <i class="fa fa-bank"></i> <span> @lang('sidebar.companies')</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>

                        <ul class="treeview-menu">

                            <li>
                                <a href="{{url('admin/companies/search?active=active')}}">
                                    <div class="col-md-12">
                                        <i class="fa fa-bank"></i> @lang('sidebar.edit_company')
                                        <span class="pull-right-container">
                                            <small class="label pull-right bg-primary">{{$info['companies_count']}}</small>
                                        </span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('admin/company/create')}}">
                                    <div class="col-md-12">
                                        <i class="fa fa-plus"></i> @lang('sidebar.create_new_company')
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- employees -->
                    <li>
                        <a href="{{url('admin/company-employees/search?active=active')}}">
                            <i class="ion ion-person-stalker"></i>@lang('sidebar.company_employee')
                        </a>
                    </li>

                    <!-- withdrawal requests -->
                    <li>
                        <a href="{{url('admin/all-client-withdrawal-requests/search')}}">
                            <i class="fa fa-list-ol"></i>@lang('sidebar.withdrawal_requests')
                        </a>
                    </li>

                    <!-- company wallets -->
                    <li>
                        <a href="{{url('admin/company-wallets')}}">
                            <i class="fa fa-credit-card"></i>@lang('sidebar.company_wallets')
                        </a>
                    </li>

                    <!-- employee wallets -->
                    <li>
                        <a href="{{url('admin/employee-wallets')}}">
                            <i class="fa  fa-credit-card"></i>@lang('sidebar.employee_wallets')
                        </a>
                    </li>
                </ul>
            </li>

            <li class="active treeview">

                <a href="#">
                    <i class="fa fa-pie-chart"></i> <span>@lang('sidebar.reports')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">
                    <li>
                        <a href="{{url('admin/company-wallet-report')}}">
                            <i class="fa fa-line-chart"></i>@lang('sidebar.company_wallet_report')
                        </a>
                    </li>
                    <li>
                        <a href="{{url('admin/employee-wallet-report')}}">
                            <i class="fa fa-bar-chart"></i>@lang('sidebar.employee_wallet_report')
                        </a>
                    </li>

                    <li>
                        <a href="{{url('admin/withdrawal-request-report')}}">
                            <i class="fa fa-file-text-o"></i>@lang('sidebar.withdrawal_request_report')
                        </a>
                    </li>
                    <li>
                        <a href="{{url('admin/inactive-client-report?active=inactive')}}">
                            <i class="fa fa-file-text"></i>@lang('sidebar.inactive_client_report')
                        </a>
                    </li>
                </ul>
            </li>

            @elseif(in_array(auth()->user()->accountType->code,[\App\Constants\HasLookupType\UserAccountType::CLIENT['code']]))


            <?php
            $info = \App\Foundations\SideBar\SideBarCollection::clientSideBarInfo();
            ?>

            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-th-large"></i> <span>@lang('sidebar.dashboard')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <!-- companies -->
                    <li class=" treeview ">
                        <a href="#" style="padding: 10px !important;">
                            <i class="fa fa-bank"></i> <span> @lang('sidebar.companies')</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>

                        <ul class="treeview-menu">

                            <li>
                                <a href="{{url('client/client-companies/search?active=active')}}">
                                    <div class="col-md-12">
                                        <i class="fa fa-bank"></i> @lang('sidebar.edit_company')
                                        <span class="pull-right-container">
                                            <small class="label pull-right bg-primary">{{$info['companies_count']}}</small>
                                        </span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('client/client-company/create')}}">
                                    <div class="col-md-12">
                                        <i class="fa fa-plus"></i> @lang('sidebar.create_new_company')
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- employees -->
                    <li>
                        <a href="{{url('client/client-company-employees/search')}}">
                            <div class="col-md-12">
                                <i class="ion ion-person-stalker"></i>@lang('sidebar.employees')
                                <span class="pull-right-container">
                                    <small class="label pull-right bg-green">{{$info['employees_count']}}</small>
                                </span>
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="{{url('client/company-wallets')}}">
                            <i class="fa fa-credit-card"></i>@lang('sidebar.company_wallets')
                        </a>
                    </li>
                    <li>
                        <a href="{{url('client/employee-wallets')}}">
                            <i class="fa fa-credit-card"></i>@lang('sidebar.employee_wallets')
                        </a>
                    </li>
                    <li>
                        <a href="{{url('client/client-withdrawal-requests')}}">
                            <i class="fa fa-list-ol"></i>@lang('sidebar.withdrawal_requests')
                        </a>
                    </li>

                </ul>
            </li>

            <li class="active treeview">

                <a href="#">
                    <i class="fa fa-pie-chart"></i> <span>@lang('sidebar.reports')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">

                    <li>
                        <a href="{{url('client/company-wallet-report')}}">
                            <i class="fa fa-line-chart"></i>@lang('sidebar.company_wallet_report')
                        </a>
                    </li>
                    <li>
                        <a href="{{url('client/employee-wallet-report')}}">
                            <i class="fa fa-bar-chart"></i>@lang('sidebar.employee_wallet_report')
                        </a>
                    </li>

                    <li>
                        <a href="{{url('client/withdrawal-request-report')}}">
                            <i class="fa fa-file-text-o"></i>@lang('sidebar.withdrawal_request_report')
                        </a>
                    </li>

                    <li>
                        <a href="{{url('client/employee-rating-report')}}">
                            <i class="fa fa-regular fa-star"></i>@lang('sidebar.employee_rating_report')
                        </a>
                    </li>

                    <li>
                        <a href="{{url('client/employee-notes-report')}}">
                            <i class="fa fa-solid fa-clipboard"></i>@lang('sidebar.employee_notes_report')
                        </a>
                    </li>

                </ul>
            </li>

            @endif
        </ul>
    </section>
</aside>

<div class="content-wrapper">

    @if ($errors->any())
    <div class="alert alert-warning col-md-6" style="margin-top: 60px;">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if (session()->has('success'))
    <div class="alert alert-success col-md-6" style="margin-top: 60px;">
        <ul>
            <li>{{ session('success') }}</li>
        </ul>
    </div>
    @endif

    @if (session()->has('error'))
    <div class="alert alert-success col-md-6" style="margin-top: 60px;">
        <ul>
            <li>{{ session('error') }}</li>
        </ul>
    </div>
    @endif
