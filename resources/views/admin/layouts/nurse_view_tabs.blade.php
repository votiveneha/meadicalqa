<ul class="nav nav-pills nav-fill mt-4 tabs-feat" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ Route::currentRouteName() == 'admin.view-profile' ? 'active' : '' }}" href="{{ route('admin.view-profile', ['id' => $profileData->id ]) }}">
            <span>Basic Details</span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ Route::currentRouteName() == 'admin.setting_availablity_view' ? 'active' : '' }}" href="{{ route('admin.setting_availablity_view', ['id' => $profileData->id ]) }}">
            <span>Setting & Availability</span>
        </a>
    </li>
    
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ Route::currentRouteName() == 'admin.profession_view' ? 'active' : '' }}" href="{{ route('admin.profession_view', ['id' => $profileData->id ]) }}">
            <span>Profession</span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ Route::currentRouteName() == 'admin.education_certification' ? 'active' : '' }}" href="{{ route('admin.education_certification', ['id' => $profileData->id ]) }}">
            <span>Education and Certifications</span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" data-bs-toggle="tab" href="#navpill-3" role="tab" aria-selected="false"
            tabindex="-1">
            <span>Mandatory Training and Continuing Education</span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" data-bs-toggle="tab" href="#navpill-4" role="tab" aria-selected="false"
            tabindex="-1">
            <span>Experience</span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" data-bs-toggle="tab" href="#navpill-4.1" role="tab" aria-selected="false"
            tabindex="-1">
            <span>References</span>
        </a>
    </li>
    
    <li class="nav-item" role="presentation">
        <a class="nav-link" data-bs-toggle="tab" href="#navpill-6" role="tab" aria-selected="false"
            tabindex="-1">
            <span>Vaccinations</span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" data-bs-toggle="tab" href="#navpill-7" role="tab" aria-selected="false"
            tabindex="-1">
            <span>Checks and Clearances</span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" data-bs-toggle="tab" href="#navpill-8" role="tab" aria-selected="false"
            tabindex="-1">
            <span>Professional Memberships & Awards</span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" data-bs-toggle="tab" href="#navpill-9" role="tab" aria-selected="false"
            tabindex="-1">
            <span>Language Skills</span>
        </a>
    </li>
    
</ul>