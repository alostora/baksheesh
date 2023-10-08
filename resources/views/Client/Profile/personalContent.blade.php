<section class="content">
  <div class="row">
    <div class="col-md-6">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">@lang('profile.page_title')</h3>
        </div>
        <div class="box-body">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">@lang('profile.general')</a></li>
              <li><a href="#tab_2" data-toggle="tab">@lang('profile.update_profile_request')</a></li>
              <li><a href="#tab_3" data-toggle="tab">@lang('profile.update_password')</a></li>
            </ul>
            <div class="tab-content">

              <div class="tab-pane active" id="tab_1">
                <div class="box-body box-profile">
                  @if(auth()->user()->file)
                  <img class="profile-user-img img-responsive img-circle" src="{{url('uploads/'.auth()->user()->file->new_name)}}" alt="User profile picture" style="height:100px; width:100px">
                  @else
                  <img class="profile-user-img img-responsive img-circle" src="{{url('AdminDesign')}}/dist/img/user2-160x160.jpg" alt="User profile picture">
                  @endif
                  <h3 class="profile-username text-center">{{auth()->user()->name}}</h3>

                  <p class="text-muted text-center">{{app()->getLocale() == 'ar' ? auth()->user()->accountType->name_ar : auth()->user()->accountType->name}}</p>

                  <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                      <b>@lang('profile.country')</b> <a class="pull-right">{{auth()->user()->country ? ( app()->getLocale() == 'ar' ? auth()->user()->country->name_ar :auth()->user()->country->name ) : 'NONE'}}</a>
                    </li>
                    <li class="list-group-item">
                      <b>@lang('profile.governorate')</b> <a class="pull-right">{{auth()->user()->governorate ? ( app()->getLocale() == 'ar' ? auth()->user()->governorate->name_ar :auth()->user()->governorate->name ) : 'NONE'}}</a>
                    </li>
                    <li class="list-group-item">
                      <b>@lang('profile.phone')</b> <a class="pull-right">{{auth()->user()->phone}}</a>
                    </li>

                    <li class="list-group-item">
                      <b>@lang('profile.email')</b> <a class="pull-right">{{auth()->user()->email}}</a>
                    </li>

                    <li class="list-group-item">
                      <b>@lang('profile.available_companies_count')</b> <a class="pull-right">{{auth()->user()->available_companies_count}}</a>
                    </li>

                    <li class="list-group-item">
                      <b>@lang('profile.available_employees_count')</b> <a class="pull-right">{{auth()->user()->available_employees_count}}</a>
                    </li>
                  </ul>
                </div>
              </div>

              <div class="tab-pane" id="tab_2">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">@lang('profile.update_profile_request')</h3>
                  </div>
                  <div class="box-body">
                    <form class="form-horizontal" action="{{url('client/client-update-profile-request')}}" method="POST">
                      @csrf
                      <div class="form-group margin-bottom-none">
                        <div class="col-sm-12">
                          <textarea name="update_profile_request" class="form-control" placeholder="@lang('profile.update_profile_request')" required></textarea>
                        </div>
                      </div>
                      <div class="box-footer">
                        <div class="col-sm-12">
                          <button type="submit" class="btn btn-primary">@lang('profile.submit')</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              <div class="tab-pane" id="tab_3">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">@lang('profile.update_password')</h3>
                  </div>
                  <div class="box-body">
                    <form class="form-horizontal" action="{{url('client/client-update-password')}}" method="POST">
                      @csrf
                      <div class="form-group margin-bottom-none">
                        <div class="col-sm-12">
                          <input type="password" name="password" class="form-control" placeholder="@lang('profile.new_password')" required>
                        </div>
                      </div>
                      <div class="form-group margin-bottom-none">
                        <div class="col-sm-12">
                          <input type="password" name="password" class="form-control" placeholder="@lang('profile.confirm_new_password')" required>
                        </div>
                      </div>
                      <div class="box-footer">
                        <div class="col-sm-12">
                          <button type="submit" class="btn btn-primary">@lang('profile.submit')</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>