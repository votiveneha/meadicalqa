 <style>

html, body {
    overflow-x: hidden; /* Prevent horizontal scrolling */
    width: 100%;
}

* {
    box-sizing: border-box; /* Prevent element sizing issues */
}

img, iframe, video {
    max-width: 100%; /* Make media responsive */
    height: auto;
}


   /* Hide menu by default on mobile */
@media (max-width: 991px) {
  .nav-main-menu {
    display: none;
    flex-direction: column;
    background: #fff;
    position: absolute;
    top: 60px; /* adjust according to header height */
    left: 0;
    width: 100%;
    z-index: 1000;
    padding: 10px 0;
  }

  .nav-main-menu.active {
    display: flex;
  }

  .burger-icon {
    display: block; /* show burger icon */
    cursor: pointer;
  }
}



 </style>



  @if (!Auth::guard('nurse_middle')->check())
  <header class="header sticky-bar top-view-desktop-add without_login">
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

              <li class="has-children mega-dropdown">

                <a class='hover-up' href='{{ route("nurse.home") }}'>Nurses & Midwives</a>
                <div class="mega-dropdown-content">
    
                  <!-- Column 1: Get Started -->
                  <div class="mega-column">
                    <h4><a href="#" class="get_started">Get Started</a></h4>
                    <p class="helper-text">Always free, nurse-first hiring</p>
                    <ul>
                      <li><a href="#">Matched Jobs</a></li>
                      <li><a href="#">Instant Connect</a></li>
                      <li><a href="#">Training & CPD</a></li>
                      <li><a href="#">Forum</a></li>
                    </ul>
                  </div>

                  <!-- Column 2: Browse Jobs -->
                  <div class="mega-column browse_by_jobs">
                    <h4><a href="#" class="get_started">Browse Jobs by</a></h4>
                    <p class="helper-text">Combine these filters & more in your profile & Find Jobs</p>
                    <ul>
                      <li class="flyout" data-open="specialtyModal">Specialty & Patient group ▸
                        
                      </li>
                      <li class="flyout" data-open="nurseModal">Type of nurse ▸
                        
                      </li>
                      <li class="flyout" data-open="workPreferModal">Work Preferences & Flexibility ▸
                        
                      </li>
                    </ul>
                  </div>
              </li>

              <li class="has-children mega-dropdown">
                <a class='{{ request()->is('medical-facilities') ?"active":"" }} hover-up' href='#'>Healthcare Facilities</a>
                <div class="mega-dropdown-content">
                  <div class="mega-column">
                    <ul>
                      <li><a href="#">Instant Connect</a></li>
                      <li><a href="#">Post Jobs</a></li>
                      <li><a href="#">Book a demo</a></li>
                      <li><a href="#">How it works</a></li>
                      <li><a href="#">Compliance & Screening</a></li>
                      <li><a href="{{ route('medical-facilities.login') }}">Sign in Employers</a></li>
                    </ul>
                  </div>
                </div>
              </li>
              <li class="has-children mega-dropdown">
                <a class='{{ request()->is('agencies') ?"active":"" }} hover-up' href='#'>Agencies</a>
                <div class="mega-dropdown-content">
                  <div class="mega-column">
                    <ul>
                      <li><a href="#">Deploy Nurses & Midwives</a></li>
                      <li><a href="#">Post Shifts</a></li>
                      <li><a href="#">Book a demo</a></li>
                      <li><a href="#">How it works</a></li>
                      <li><a href="#">Compliance & Screening</a></li>
                      <li><a href="{{ route('agencies.login') }}">Sign in Agencies</a></li>
                    </ul>
                  </div>
                </div>
              </li>
              <li class="has-children mega-dropdown">

                <a class='{{ request()->is('nurseCareHome') ?"active":"" }} hover-up' href='#'>Individuals</a>
                <div class="mega-dropdown-content">
                  <div class="mega-column">
                    <ul>
                      <li><a href="#">Hire a Nurse at Home</a></li>
                      <li><a href="#">Services Offered</a></li>
                      <li><a href="{{ route('individuals.login') }}">Sign in Individuals </a></li>
                    </ul>
                  </div>
                </div>
              </li>
              <li class="has-children mega-dropdown">

                <a class='{{ request()->is('contact') ?"active":"" }} hover-up' href='#'>CPD/CE Providers</a>
                <div class="mega-dropdown-content">
                  <div class="mega-column">
                    <ul>
                      <li><a href="#">Post a Course</a></li>
                      <li><a href="#">Pricing & Plans</a></li>
                      <li><a href="#">Benefits</a></li>
                      <li><a href="{{ route('cpd_providers.login') }}">Sign in CPD/CE Providers</a></li>
                    </ul>
                  </div>
                </div>
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
 <div id="modalOverlay" class="modal-overlay"></div>

  <!-- Nurse Types Modal -->
<div id="nurseModal" class="side-modal">
  <div class="side-modal-content">
    <span class="close-btn" data-close="nurseModal">&times;</span>
    <h3>Nurse Types</h3>
    <ul class="submenu">
      @foreach($practitioner_data as $key=>$prac_data)
      <li class="{{ $key > 14 ? 'hidden-speciality' : '' }}"><a href="#">{{ $prac_data->name }}</a></li>
      @endforeach
      @if(count($practitioner_data) > 15)
      <li class="toggle_nurse more-btn"><a href="#">+ All Type of Nurse</a></li>
      @endif
      
    </ul>
  </div>
</div>

<div id="specialtyModal" class="side-modal">
  <div class="side-modal-content">
    <span class="close-btn" data-close="specialtyModal">&times;</span>
    <h3>Specialty & Patient group</h3>
    <ul class="submenu">
      @foreach($speciality_data as $key => $speciality)
      <li class="{{ $key > 14 ? 'hidden-speciality' : '' }}"><a href="#">{{ $speciality->name }}</a></li>
      @endforeach
      
      @if(count($speciality_data) > 15)
      <li class="toggle-specialities more-btn"><a href="#">+ More Specialties</a></li>
      @endif
    </ul>
  </div>
</div>

<div id="workPreferModal" class="side-modal">
  <div class="side-modal-content">
    <span class="close-btn" data-close="workPreferModal">&times;</span>
    <h3>Work Preferences & Flexibility</h3>
    <ul class="submenu">
      @foreach($work_preferences_data as $key => $work_prefer_data)
      <li class="{{ $key > 14 ? 'hidden-speciality' : '' }}"><a href="#">{{ $work_prefer_data->env_name }}</a></li>
      @endforeach
      @if(count($work_preferences_data) > 15)
      <li class="toggle-environment more-btn"><a href="#">+ Set More Preferences in Your Profile</a></li>
      @endif
    </ul>
  </div>
</div>
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
              <li>
                <a class="{{ request()->is('nurse/my-profile') ?'active':'' }}  hover-up " href='{{ route("nurse.my-profile") }}?page=my_profile'>Profile</a>
              </li>
              <li>
                <a class="{{ request()->is('nurse/sector_preferences') ?'active':'' }} {{ request()->is('nurse/work_environment_preferences') ?'active':'' }} {{ request()->is('nurse/employeement_type_preferences') ?'active':'' }} {{ request()->is('nurse/WorkShiftPreferences') ?'active':'' }} {{ request()->is('nurse/position_preferences') ?'active':'' }} {{ request()->is('nurse/benefitsPreferences') ?'active':'' }} {{ request()->is('nurse/locationPreferences') ?'active':'' }} {{ request()->is('nurse/salaryExpectations') ?'active':'' }} hover-up " href='{{ route("nurse.sector_preferences") }}?page=sector_preferences'>Work Preferences</a>
              </li>
              <li class="">
                <a class='menu-link hover-up' href='{{ route("nurse.find_jobs") }}'>Find Jobs</a>
              </li>
              <li class="">
                <a class='menu-link hover-up' href='#'>Saved Jobs</a>
              </li>
              <li class="mega-dropdown career_dropdown">
                <a class='menu-link hover-up' href='{{ route("nurse.match_percentage") }}'>My Career</i></a>
                
              </li>
              <!-- <li class="">
                <a class='hover-up' href='{{ route("nurse.dashboard") }}'>My Jobs / MyApplications</a>
              </li>
              <li class="">
                  <a class='' href='{{ route("nurse.interview", ["page" => "interview_references"]) }}'>Interviews</a>
              </li>
              <li class="">
                  <a class='' href='{{ route("nurse.dashboard") }}'>Testimonial and Reviews</a>
              </li> -->
              <li class="">
                <a class=' hover-up' href='{{ route("nurse.dashboard") }}'>Community</a>
              </li>

              <!-- <li>
                <a class="{{ request()->is('nurse/match_percentage') ?'active':'' }} hover-up" href="{{ route("nurse.match_percentage") }}">Match Percentage</a>
              </li> -->
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
  
  <script>
document.addEventListener("DOMContentLoaded", function () {
  const burger = document.querySelector(".burger-icon");
  const navMenu = document.querySelector(".nav-main-menu");

  burger.addEventListener("click", function () {
    navMenu.classList.toggle("active");
    burger.classList.toggle("open");
  });
});

document.addEventListener("DOMContentLoaded", function () {
    const toggleBtn = document.querySelector(".submenu .toggle_nurse a");
    if (toggleBtn) {
      let expanded = false;

      toggleBtn.addEventListener("click", function () {
        const hiddenItems = document.querySelectorAll("#nurseModal .submenu .hidden-speciality");

        if (!expanded) {
          hiddenItems.forEach(li => li.style.display = "list-item");
          toggleBtn.textContent = "− Show Less";
          expanded = true;
        } else {
          hiddenItems.forEach(li => li.style.display = "none");
          toggleBtn.textContent = "+ All Type of Nurse";
          expanded = false;
        }
      });
    }
  });
  document.addEventListener("DOMContentLoaded", function () {
  const toggleBtn = document.querySelector("#specialtyModal .submenu .toggle-specialities a");
  if (toggleBtn) {
    let expanded = false;

    toggleBtn.addEventListener("click", function () {
      const hiddenItems = document.querySelectorAll("#specialtyModal .submenu .hidden-speciality");

      if (!expanded) {
        hiddenItems.forEach(li => li.style.display = "list-item");
        toggleBtn.textContent = "− Show Less";
        expanded = true;
        
      } else {
        hiddenItems.forEach(li => li.style.display = "none");
        toggleBtn.textContent = "+ More Specialties";
        expanded = false;
        //$("#specialtyModal").css("overflow-y","hidden");
      }
    });
  }
});


document.addEventListener("DOMContentLoaded", function () {
  const toggleBtn = document.querySelector(".submenu .toggle-environment a");
  if (toggleBtn) {
    let expanded = false;

    toggleBtn.addEventListener("click", function () {
      const hiddenItems = document.querySelectorAll(".submenu .hidden-speciality");

      if (!expanded) {
        hiddenItems.forEach(li => li.style.display = "list-item");
        toggleBtn.textContent = "− Show Less";
        expanded = true;
      } else {
        hiddenItems.forEach(li => li.style.display = "none");
        toggleBtn.textContent = "+ Set More Preferences in Your Profile";
        expanded = false;
      }
    });
  }
});

// Open modals
  document.querySelectorAll("[data-open]").forEach(link => {
    link.addEventListener("click", function(e) {
      e.preventDefault();
      const modalId = this.getAttribute("data-open");
      document.getElementById(modalId).style.display = "block";
    });
  });

  // Close modals
  document.querySelectorAll("[data-close]").forEach(btn => {
    btn.addEventListener("click", function() {
      const modalId = this.getAttribute("data-close");
      document.getElementById(modalId).style.display = "none";
    });
  });

  // Close when clicking outside content
  window.onclick = function(e) {
    if (e.target.classList.contains("side-modal")) {
      e.target.style.display = "none";
    }
  }

  const overlay = document.getElementById("modalOverlay");

  // To show overlay
  overlay.style.display = "block";

  // To hide overlay
  overlay.style.display = "none";

  // Optional: close overlay by clicking it
  overlay.addEventListener("click", () => {
    overlay.style.display = "none";
  });
</script>
