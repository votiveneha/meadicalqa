 <!--  Header Start -->
 <header class="app-header"> 
    <nav class="navbar navbar-expand-lg navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link sidebartoggler nav-icon-hover ms-n3" id="headerCollapse" href="javascript:void(0)">
            <i class="ti ti-menu-2"></i>
          </a>
        </li>
      </ul>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <div class="d-flex align-items-center justify-content-between">
          <a href="javascript:void(0)" class="nav-link d-flex d-lg-none align-items-center justify-content-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenavbar" aria-controls="offcanvasWithBothOptions">
            <i class="ti ti-align-justified fs-7"></i>
          </a>
          <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">
            <li class="nav-item dropdown">
              <a class="nav-link pe-0" href="javascript:void(0)" id="drop1" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="d-flex align-items-center">
                  <div class="user-profile-img">
                    @if(auth()->guard('admin')->user()->image)
                     <img src="{{url('storage/app/public/'.auth()->guard('admin')->user()->image)}}" class="rounded-circle" width="35" height="35" alt="" />
                    @else
                    <img src="{{asset('assets/admin/dist/images/logos/dummy.png')}}" class="rounded-circle" width="35" height="35" alt="" />
                    @endif
                  </div>
                </div>
              </a>
              <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop1">
                <div class="profile-dropdown position-relative" data-simplebar>
                  <div class="py-3 px-7 pb-0">
                    <h5 class="mb-0 fs-5 fw-semibold">Admin Profile</h5>
                  </div>
                  <div class="d-flex align-items-center py-9 mx-7 border-bottom">
                    @if(auth()->guard('admin')->user()->image)
                      <img src="{{url('storage/app/public/'.auth()->guard('admin')->user()->image)}}" class="rounded-circle" width="80" height="80" alt="" />
                    @else
                    <img src="{{asset('assets/admin/dist/images/logos/dummy.png')}}" class="rounded-circle" width="80" height="80" alt="" />
                    @endif
                    <div class="ms-3">
                      <h5 class="mb-1 fs-3">{{auth()->guard('admin')->user()->name}}</h5>
                      <p class="mb-0 d-flex text-dark align-items-center gap-2">
                        <i class="ti ti-mail fs-4"></i> {{auth()->guard('admin')->user()->email}}
                      </p>
                    </div>
                  </div>
                  <div class="message-body">
                    <a href="{{route('admin.my-profile')}}" class="py-8 px-7 mt-8 d-flex align-items-center">
                      <span class="d-flex align-items-center justify-content-center bg-light rounded-1 p-6">
                        @if(auth()->guard('admin')->user()->image)
                         <img src="{{url('storage/app/public/'.auth()->guard('admin')->user()->image)}}" alt="" width="24" height="24">
                        @else
                        <img src="{{asset('assets/admin/dist/images/logos/dummy.png')}}" alt="" width="24" height="24">
                        @endif
                      </span>
                      <div class="w-75 d-inline-block v-middle ps-3">
                        <h6 class="mb-1 bg-hover-primary fw-semibold"> My Profile </h6>
                        <span class="d-block text-dark">Account Settings</span>
                      </div>
                    </a>
                  </div>
                  <div class="d-grid py-4 px-7 pt-8">
                    <a href="{{route('admin.logout')}}" class="btn btn-outline-primary">Log Out</a>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <!--  Header End -->