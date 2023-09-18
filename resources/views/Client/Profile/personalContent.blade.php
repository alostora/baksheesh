<section class="content">

  <div class="row">
    <div class="col-md-6">

      <div class="box box-primary">
        <div class="box-body box-profile">
          @if(auth()->user()->file)
          <img class="profile-user-img img-responsive img-circle" src="{{url('uploads/'.auth()->user()->file->new_name)}}" alt="User profile picture">
          @else
          <img class="profile-user-img img-responsive img-circle" src="{{url('AdminDesign')}}/dist/img/user2-160x160.jpg" alt="User profile picture">
          @endif
          <h3 class="profile-username text-center">{{auth()->user()->name}}</h3>

          <p class="text-muted text-center">{{auth()->user()->accountType->name}}</p>

          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <b>Country</b> <a class="pull-right">{{auth()->user()->country ? auth()->user()->country->name : 'NONE'}}</a>
            </li>
            <li class="list-group-item">
              <b>Governorate</b> <a class="pull-right">{{auth()->user()->governorate ? auth()->user()->governorate->name : 'NONE'}}</a>
            </li>
            <li class="list-group-item">
              <b>Phone</b> <a class="pull-right">{{auth()->user()->phone}}</a>
            </li>

            <li class="list-group-item">
              <b>Email</b> <a class="pull-right">{{auth()->user()->email}}</a>
            </li>

            <li class="list-group-item">
              <b>Available Companies Count</b> <a class="pull-right">{{auth()->user()->available_companies_count}}</a>
            </li>

            <li class="list-group-item">
              <b>Available Employees Count</b> <a class="pull-right">{{auth()->user()->available_employees_count}}</a>
            </li>
          </ul>

          <form class="form-horizontal" action="{{url('client/client-update-profile-request')}}" method="POST">
            @csrf
            <div class="form-group margin-bottom-none">
              <div class="col-sm-12">
                <textarea name="update_profile_request" class="form-control" placeholder="Update Profile Request" required></textarea>
              </div>
            </div>
            <div class="box-footer">
              <div class="col-sm-12">
                <button type="submit" class="btn btn-primary">@lang('company.submit')</button>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
  <!-- /.row -->

</section>