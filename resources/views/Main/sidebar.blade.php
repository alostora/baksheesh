<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{url('AdminDesign')}}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{auth()->user()->name}}</p>
        <a href="#"><i class="fa fa-circle text-success"></i>@lang('sidebar.online')</a>
      </div>
    </div>
    <!-- search form -->
    <!-- <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
      </div>
    </form> -->
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">

      <li class="header"><a href="{{url('admin')}}">@lang('sidebar.home')</a></li>

      @if(in_array(auth()->user()->accountType->code,[\App\Constants\HasLookupType\UserAccountType::ADMIN['code'],\App\Constants\HasLookupType\UserAccountType::ROOT['code']]))

      <li class="active treeview">

        <a href="#">
          <i class="fa fa-dashboard"></i> <span>@lang('sidebar.dashboard')</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>

        <ul class="treeview-menu">

          <li>
            <a href="{{url('admin/countries')}}">
              <i class="fa fa-circle-o"></i>@lang('sidebar.countries')
            </a>
          </li>

          <li>
            <a href="{{url('admin/users')}}">
              <i class="fa fa-circle-o"></i>@lang('sidebar.users')
            </a>
          </li>
          
          <li>
            <a href="{{url('admin/clients')}}">
              <i class="fa fa-circle-o"></i>@lang('sidebar.clients')
            </a>
          </li>

          <li>
            <a href="{{url('admin/companies')}}">
              <i class="fa fa-circle-o"></i>@lang('sidebar.companies')
            </a>
          </li>

          <li>
            <a href="{{url('admin/company-wallets')}}">
              <i class="fa fa-circle-o"></i>@lang('sidebar.company_wallets')
            </a>
          </li>
          <li>
            <a href="{{url('admin/employee-wallets')}}">
              <i class="fa fa-circle-o"></i>@lang('sidebar.employee_wallets')
            </a>
          </li>

        </ul>
      </li>
      @elseif(in_array(auth()->user()->accountType->code,[\App\Constants\HasLookupType\UserAccountType::CLIENT['code']]))

      <li class="active treeview">

        <a href="#">
          <i class="fa fa-dashboard"></i> <span>@lang('sidebar.dashboard')</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>

        <ul class="treeview-menu">

          <li>
            <a href="{{url('client/client-companies')}}">
              <i class="fa fa-circle-o"></i>@lang('sidebar.companies')
            </a>
          </li>

          <li>
            <a href="{{url('client/company-wallets')}}">
              <i class="fa fa-circle-o"></i>@lang('sidebar.company_wallets')
            </a>
          </li>
          <li>
            <a href="{{url('client/employee-wallets')}}">
              <i class="fa fa-circle-o"></i>@lang('sidebar.employee_wallets')
            </a>
          </li>
          <li>
            <a href="{{url('client/client-withdrawal-requests')}}">
              <i class="fa fa-circle-o"></i>@lang('sidebar.withdrawal_requests')
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
  <div class="alert alert-warning col-md-6">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  @if (session()->has('success'))
  <div class="alert alert-success col-md-6">
    <ul>
      <li>{{ session('success') }}</li>
    </ul>
  </div>
  @endif