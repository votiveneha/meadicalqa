 <!-- Sidebar Start -->
 <aside class="left-sidebar">
  <!-- Sidebar scroll-->
  <div>
    <div class="brand-logo d-flex align-items-center justify-content-between">
      <a href="{{route('admin.dashboard')}}" class="text-nowrap logo-img">
        <img src="{{ asset(env('LOGO_PATH') )}}" class="dark-logo" width="150" alt="" />
        <img src="{{ asset(env('LOGO_PATH') )}}" class="light-logo"  width="150" alt="" />
      </a>
      <div class="close-btn d-lg-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
        <i class="ti ti-x fs-8 text-muted"></i>
      </div>
    </div>
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav scroll-sidebar" data-simplebar>
      <ul id="sidebarnav">
        <!-- =================== -->
        <!-- Dashboard -->
        <!-- =================== -->
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{route('admin.dashboard')}}" aria-expanded="false">
            <span>
              <i class="ti ti-aperture"></i>
            </span>
            <span class="hide-menu">Dashboard</span>
          </a>
        </li>
        
        <li class="sidebar-item">
          <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
            <span class="d-flex">
              <i class="ti ti-basket"></i>
            </span>
            <span class="hide-menu">Profession Management</span>
          </a>
          <ul aria-expanded="false" class="collapse first-level">
            <li class="sidebar-item">
              <a href="{{route('admin.professionList')}}" class="sidebar-link">
                <div class="round-16 d-flex align-items-center justify-content-center">
                  <i class="ti ti-circle"></i>
                </div>
                <span class="hide-menu">Type of Nurse</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a href="{{route('admin.specialityList')}}" class="sidebar-link">
                <div class="round-16 d-flex align-items-center justify-content-center">
                  <i class="ti ti-circle"></i>
                </div>
                <span class="hide-menu">Speciality Job List</span>
              </a>
            </li>
          </ul>
        </li>

        {{-- <li class="sidebar-item">
          <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
            <span class="d-flex">
              <i class="ti ti-star"></i>
            </span>
            <span class="hide-menu">Speciality Management</span>
          </a>
          <ul aria-expanded="false" class="collapse first-level">
            <li class="sidebar-item">
              <a href="{{route('admin.specialityList')}}" class="sidebar-link">
                <div class="round-16 d-flex align-items-center justify-content-center">
                  <i class="ti ti-circle"></i>
                </div>
                <span class="hide-menu">Speciality Job List</span>
              </a>
            </li>
          </ul>
        </li> --}}

        <li class="sidebar-item">
          <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
            <span class="d-flex">
              <i class="ti ti-package"></i>
            </span>
            <span class="hide-menu">Skill Management</span>
          </a>
          <ul aria-expanded="false" class="collapse first-level">
            <li class="sidebar-item">
              <a href="{{route('admin.skillList')}}" class="sidebar-link">
                <div class="round-16 d-flex align-items-center justify-content-center">
                  <i class="ti ti-circle"></i>
                </div>
                <span class="hide-menu">Skill List</span>
              </a>
            </li>
          </ul>
        </li>

        <li class="sidebar-item">
          <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
            <span class="d-flex">
              <i class="ti ti-package"></i>
            </span>
            <span class="hide-menu">Degree Management</span>
          </a>
          <ul aria-expanded="false" class="collapse first-level">
            <li class="sidebar-item">
              <a href="{{route('admin.degreeList')}}" class="sidebar-link">
                <div class="round-16 d-flex align-items-center justify-content-center">
                  <i class="ti ti-circle"></i>
                </div>
                <span class="hide-menu">Degree List</span>
              </a>
            </li>
          </ul>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
            <span class="d-flex">
              <i class="ti ti-package"></i>
            </span>
            <span class="hide-menu">Certificate Management</span>
          </a>
          <ul aria-expanded="false" class="collapse first-level">
            <li class="sidebar-item">
              <a href="{{route('admin.certificateList')}}" class="sidebar-link">
                <div class="round-16 d-flex align-items-center justify-content-center">
                  <i class="ti ti-circle"></i>
                </div>
                <span class="hide-menu">Certificate List</span>
              </a>
            </li>
          </ul>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
            <span class="d-flex">
              <i class="ti ti-package"></i>
            </span>
            <span class="hide-menu">Training Management</span>
          </a>
          <ul aria-expanded="false" class="collapse first-level">
            <li class="sidebar-item">
              <a href="{{route('admin.TrainingList')}}" class="sidebar-link">
                <div class="round-16 d-flex align-items-center justify-content-center">
                  <i class="ti ti-circle"></i>
                </div>
                <span class="hide-menu">Training List</span>
              </a>
            </li>
          </ul>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
            <span class="d-flex">
              <i class="ti ti-package"></i>
            </span>
            <span class="hide-menu">Vaccination Management</span>
          </a>
          <ul aria-expanded="false" class="collapse first-level">
            <li class="sidebar-item">
              <a href="{{route('admin.VaccinationList')}}" class="sidebar-link">
                <div class="round-16 d-flex align-items-center justify-content-center">
                  <i class="ti ti-circle"></i>
                </div>
                <span class="hide-menu">Vaccination List</span>
              </a>
            </li>
          </ul>
        </li>
         <li class="sidebar-item">
          <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
            <span class="d-flex">
            <i class="ti ti-building-store"></i>
            </span>
            <span class="hide-menu">Nurse Management</span>
          </a>
          <ul aria-expanded="false" class="collapse first-level">
            <li class="sidebar-item">
              <a href="{{route('admin.incoming-nurse-list')}}" class="sidebar-link">
                <div class="round-16 d-flex align-items-center justify-content-center">
                  <i class="ti ti-circle"></i>
                </div>
                <span class="hide-menu">Incoming Nurse List</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a href="{{route('admin.inprogess-nurse-nurse-list')}}" class="sidebar-link">
                <div class="round-16 d-flex align-items-center justify-content-center">
                  <i class="ti ti-circle"></i>
                </div>
                <span class="hide-menu">In Progress Profile Nurse List</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a href="{{route('admin.complete-nurse-nurse-list')}}" class="sidebar-link">
                <div class="round-16 d-flex align-items-center justify-content-center">
                  <i class="ti ti-circle"></i>
                </div>
                <span class="hide-menu">Completed Profile Nurse List</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a href="{{route('admin.approved-nurse-list')}}" class="sidebar-link">
                <div class="round-16 d-flex align-items-center justify-content-center">
                  <i class="ti ti-circle"></i>
                </div>
                <span class="hide-menu">Approved Nurse list</span>
              </a>
            </li>
          </ul>
        </li>
       
        <li class="sidebar-item">
          <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
            <span class="d-flex">
              <i class="ti ti-star"></i>
            </span>
            <span class="hide-menu">Verification Management</span>
          </a>
          <ul aria-expanded="false" class="collapse first-level">
            <li class="sidebar-item">
              <a href="{{route('admin.professionVerificationList')}}" class="sidebar-link">
                <div class="round-16 d-flex align-items-center justify-content-center">
                  <i class="ti ti-circle"></i>
                </div>
                <span class="hide-menu">Profession Verification List</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a href="{{route('admin.policeCheckVerificationList')}}" class="sidebar-link">
                <div class="round-16 d-flex align-items-center justify-content-center">
                  <i class="ti ti-circle"></i>
                </div>
                <span class="hide-menu">Police Check Verification List</span>
              </a>
            </li>
            
          </ul>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{route('admin.traeductionList')}}" aria-expanded="false">
            <span>
              <i class="ti ti-seo-edit"></i>
            </span>
            <span class="hide-menu">Mandatory Training</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{route('admin.contact-list')}}" aria-expanded="false">
            <span>
              <i class="ti ti-aperture"></i>
            </span>
            <span class="hide-menu">Contact Us</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{route('admin.SeoList')}}" aria-expanded="false">
            <span>
              <i class="ti ti-seo-edit"></i>
            </span>
            <span class="hide-menu">Seo Management</span>
          </a>
        </li>
      </ul>

    </nav>
    <!-- End Sidebar navigation -->
  </div>
  <!-- End Sidebar scroll-->
</aside>
<!--  Sidebar End -->