<ul class="nav nav-pills nav-fill mt-4 tabs-feat" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link" href="#">
            <span>Basic Details</span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link"  data-bs-toggle="tab" href="{{ route('admin.edit_nurse', ['id' => $profileData->id ]) }}?tab=tab-2"  role="tab" aria-selected="false"
            tabindex="-1">
            <span>Setting & Availability</span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ Route::currentRouteName() == 'admin.add_registration_licences' ? 'active' : '' }}" href="{{ route('admin.add_registration_licences', ['id' => $profileData->id ]) }}">
            <span>Registrations and Licences</span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" data-bs-toggle="tab" href="#tab-3" role="tab" aria-selected="false"
            tabindex="-1">
            <span>Profession</span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" data-bs-toggle="tab" href="#tab-4" role="tab" aria-selected="false"
            tabindex="-1">
            <span>Education and Certifications</span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" href="{{ route('admin.mandatory_training_edit', ['id' => $profileData->id ]) }}">
            <span>Mandatory Training and Continuing Education</span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" href="{{ route('admin.exptab', ['id' => $profileData->id ?? null, 'tab' => 'tab-7']) }}" tabindex="-1">
            <span>Experience</span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" data-bs-toggle="tab" href="#tab-6" role="tab" aria-selected="false"
            tabindex="-1">
            <span>References</span>
        </a>
    </li>
    
    <li class="nav-item" role="presentation">
        <a class="nav-link" href="{{ route('admin.updateVaccinationRecord', ['id' => $profileData->id ?? null, 'tab' => 'tab-8']) }}" aria-selected="false">
            <span>Vaccinations</span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" href="{{ route('admin.updateWorkClreance', ['id' => $profileData->id ?? null, 'tab' => 'tab-9']) }}" aria-selected="false"
            tabindex="-1">
            <span>Checks and Clearances</span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" href="{{ route('admin.professional_membership_awards', ['id' => $profileData->id]) }}" aria-selected="false"
            tabindex="-1">
            <span>Professional Memberships & Awards</span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" href="{{ route('admin.editLanguageSkills', ['id' => $profileData->id]) }}">
            <span>Language Skills</span>
        </a>
    </li>
</ul>