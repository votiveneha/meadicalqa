  @if (!Auth::guard('nurse_middle')->check())
  <header class="header sticky-bar">
    <div class="container">
      <div class="main-header">
        <div class="header-left">
          <div class="header-logo"><a class='d-flex' href='{{ route("home_main") }}'><img alt="jobBox" src="{{ asset(env('LOGO_PATH'))}}"></a></div>
        </div>
        <div class="header-nav">
          <nav class="nav-main-menu">
            <ul class="main-menu">

              <!--  <li class="">
                  <a class='menu-link hover-up' href='{{ route("nurse.home") }}'>Home</a>
                </li> -->

              <li class="has-children">

                <a class='menu-link hover-up' href='{{ route("nurse.home") }}'>Nurses & Midwives</a>
                <ul class="sub-menu">
                  @php $nurseTypeData =nurse_Type_header();@endphp
                  @if($nurseTypeData)
                  @foreach ($nurseTypeData as $key => $items)
                  <li> <a href='{{ route("nurse.login") }}' class="active"> {{ $items->name}}</a></li>
                  @endforeach
                  @endif
                  <li> <a href='{{ route("nurse.login") }}'>JOBS by specialties <i class="fa-solid fa-caret-right fs-6"></i></a>
                    <ul class="sub-menu">
                      @php $nurseTypeSpecialData =practitioner_type_header();@endphp
                      @if($nurseTypeSpecialData)
                      @foreach ($nurseTypeSpecialData as $key => $itemSps)
                      <li> <a href='{{ route("nurse.login") }}'>{{ $itemSps->name }}</a></li>
                      @endforeach
                      @endif

                    </ul>
                  </li>

                </ul>
              </li>

              <li class="">
                <a class='{{ request()->is('medical-facilities') ?"active":"" }} hover-up' href='{{ route("medical-facilities.medical_facilities_home_main") }}'>Healthcare Facilities</a>
              </li>
              <li class="">
                <a class='{{ request()->is('agencies') ?"active":"" }} hover-up' href='{{ route("agencies.agencies_home_main") }}'>Agencies</a>
              </li>
              <li class="">

                <a class='{{ request()->is('nurseCareHome') ?"active":"" }} hover-up' href='{{ route("nurseCareHome") }}'>Nurse Care at Home
</a>
              </li>
              <li class="">

                <a class='{{ request()->is('contact') ?"active":"" }} hover-up' href='{{ route("contact") }}'>Contact</a>
              </li>
            </ul>
          </nav>
          <div class="burger-icon burger-icon-white">
            <span class="burger-icon-top"></span><span class="burger-icon-mid"></span><span class="burger-icon-bottom"></span>
          </div>
        </div>
        <div class="header-right">
          <div class="block-signin d-flex align-items-center gap-3 justify-content-end">
            <!-- <a class='text-link-bd-btom hover-up' href='nurse_signup.php'>Become a Nurse</a> -->
            <a class='btn btn-default btn-shadow hover-up' href='{{ route("nurse.login") }}'>Log in</a>
            <a class='btn btn-default btn-shadow hover-up' href='{{ route("nurse.nurse-register") }}'>Sign up</a>
            <!-- @if(request()->is('') || request()->is('/'))
            <a class='btn btn-default btn-shadow hover-up' href='{{ route("nurse.home") }}'>Sign in</a>
            @elseif(request()->is('nurse'))
            <a class='btn btn-default btn-shadow hover-up' href='{{ route("nurse.login") }}'>Sign in</a>
            @endif -->

          </div>
        </div>
      </div>
    </div>
  </header>

  @else
  <header class="header sticky-bar  border-bottom">
    <div class="container">
      <div class="main-header">
        <div class="header-left">
          <div class="header-logo"><a class='d-flex' href='{{ route("home_main") }}'><img alt="jobBox" src="{{ asset(env('LOGO_PATH'))}}"></a></div>
        </div>
        <div class="header-nav">
          <nav class="nav-main-menu">
            <ul class="main-menu">
              <li class="">
                <a class='menu-link hover-up' href='{{ route("nurse.find_jobs") }}'>Find Jobs</a>
              </li>
              <li class="">
                <a class='hover-up' href='{{ route("nurse.dashboard") }}'>My Jobs / MyApplications</a>
              </li>
              <li class="">
                  <a class='' href='{{ route("nurse.interview", ["page" => "interview_references"]) }}'>Interviews</a>
              </li>
              <li class="">
                  <a class='' href='{{ route("nurse.dashboard") }}'>Testimonial and Reviews</a>
              </li>
              <li class="">
                <a class=' hover-up' href='{{ route("nurse.dashboard") }}'>Community</a>
              </li>

              <li>

                <a class="{{ request()->is('nurse/my-profile') ?'active':'' }}  hover-up " href='{{ route("nurse.my-profile") }}?page=my_profile'>Profile</a>

              </li>

              <li>

                <a class="{{ request()->is('nurse/sector_preferences') ?'active':'' }} {{ request()->is('nurse/work_environment_preferences') ?'active':'' }} {{ request()->is('nurse/employeement_type_preferences') ?'active':'' }} {{ request()->is('nurse/WorkShiftPreferences') ?'active':'' }} {{ request()->is('nurse/position_preferences') ?'active':'' }} {{ request()->is('nurse/benefitsPreferences') ?'active':'' }} {{ request()->is('nurse/locationPreferences') ?'active':'' }} {{ request()->is('nurse/salaryExpectations') ?'active':'' }} hover-up " href='{{ route("nurse.sector_preferences") }}?page=sector_preferences'>Work Preferences & Flexibility</a>

              </li>
              <li>
                <a class="{{ request()->is('nurse/match_percentage') ?'active':'' }} hover-up" href="{{ route("nurse.match_percentage") }}">Match Percentage</a>
              </li>
            </ul>
          </nav>
          <div class="burger-icon burger-icon-white">
            <span class="burger-icon-top"></span><span class="burger-icon-mid"></span><span class="burger-icon-bottom"></span>
          </div>
        </div>
        <div class="header-right">
          <div class="block-signin d-flex align-items-center gap-3 justify-content-end">
            <!-- <a class='text-link-bd-btom hover-up' href='nurse_signup.php'>Become a Nurse</a> -->
            <div class="dropdown d-inline-block">
              <a class="btn btn-notify" id="dropdownNotify" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static">
                <i class="fa-regular fa-bell"></i>
              </a>
              <ul class="dropdown-menu dropdown-menu-light dropdown-menu-end" aria-labelledby="dropdownNotify">
                <li><a class="dropdown-item active" href="#">0 notifications</a></li>
                <li><a class="dropdown-item" href="#">0 messages</a></li>
                <li><a class="dropdown-item" href="#">0 replies</a></li>
              </ul>
            </div>


            <div class="member-login d-flex align-items-center gap-1">
             
              <div class="info-member">
                <div class="dropdown">

                  <a class="font-xs color-text-paragraph-2 icon-down" data-bs-toggle="dropdown" style="cursor:pointer;"> <img alt="{{  Auth::guard('nurse_middle')->user()->name }}" src="{{ asset( Auth::guard('nurse_middle')->user()->profile_img)}}"><strong class="color-brand-1" >{{ Auth::guard('nurse_middle')->user()->name }}</strong></a>
                  <ul class="dropdown-menu dropdown-menu-light dropdown-menu-end" aria-labelledby="dropdownProfisle">
                    <!-- <li> --><a href='{{ route("nurse.my-profile") }}?page=my_profile' class="dropdown-item">Profile</a><!-- </li> -->
                    <!--  <li> --><a class="dropdown-item change_password_link" style="cursor: pointer;">change Password</a><!-- </li> -->
                    <!-- <li> --><a href='{{ route("nurse.logout") }}' class="dropdown-item">Logout</a><!-- </li> -->
                  </ul>
                </div>
              </div>
            </div>
            <!-- <a class='btn btn-default btn-shadow hover-up' href='#'>Sign in</a> -->
          </div>
        </div>
      </div>
    </div>
  </header>
  
  @endif
  