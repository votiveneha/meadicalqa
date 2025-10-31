<ul class="nav nav-pills nav-fill mt-4 tabs-feat" role="tablist">
                
    <li class="nav-item " role="presentation">
        <a class="nav-link {{ $expid!='' ? '' : 'disabled' }}" href="{{ $expid!=''?route('admin.edit_nurse', ['id' => $profileData->id ?? null, 'tab' => 'tab-1']): route('admin.add_nurse', ['tab' => 'tab-1'])}}"
            aria-selected="true">
            <span>Basic Details</span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ $expid!='' ? '' : 'disabled' }}" href="{{ $expid!=''?route('admin.edit_nurse', ['id' => $profileData->id ?? null, 'tab' => 'tab-2']): route('admin.add_nurse', ['tab' => 'tab-2'])}}" aria-selected="false" >
            <span>Setting</span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ $expid!='' ? '' : 'disabled' }}" href="{{ $expid!=''?route('admin.edit_nurse', ['id' => $profileData->id ?? null, 'tab' => 'tab-3']): route('admin.add_nurse', ['tab' => 'tab-3'])}}" aria-selected="false" >
            <span>Profession</span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ $expid!='' ? '' : 'disabled' }}" href="{{ $expid!=''?route('admin.edit_nurse', ['id' => $profileData->id ?? null, 'tab' => 'tab-4']): route('admin.add_nurse', ['tab' => 'tab-4'])}}" aria-selected="false" >
            <span>Education and Certifications</span>
        </a>
    </li>
    
    
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ $expid!='' ? '' : 'disabled' }}" href="{{ $expid!=''?route('admin.edit_nurse', ['id' => $profileData->id ?? null, 'tab' => 'tab-7']): route('admin.add_nurse', ['tab' => 'tab-6'])}}" aria-selected="false" >
            <span>Mandatory Training and Continuing Education</span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link  {{ $expid!='' ? '' : 'disabled' }}" href="{{ $expid!=''?route('admin.edit_nurse', ['id' => $profileData->id ?? null, 'tab' => 'tab-5']): route('admin.add_nurse', ['tab' => 'tab-7'])}}" aria-selected="false" >
            <span>Experience</span>
        </a>
    </li>
    
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ $expid!='' ? '' : 'disabled' }}" href="{{ $expid!=''?route('admin.edit_nurse', ['id' => $profileData->id ?? null, 'tab' => 'tab-6']): route('admin.add_nurse', ['tab' => 'navpill-5.1'])}}" aria-selected="false" >
            <span>References</span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link  {{ $expid!='' ? '' : 'disabled' }}" href="{{ $expid!=''?route('admin.edit_nurse', ['id' => $profileData->id ?? null, 'tab' => 'tab-8']): route('admin.add_nurse', ['tab' => 'navpill-7'])}}" aria-selected="false">
            <span>Vaccinations</span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link  {{ $expid!='' ? '' : 'disabled' }}" href="{{ $expid!=''?route('admin.edit_nurse', ['id' => $profileData->id ?? null, 'tab' => 'tab-9']): route('admin.add_nurse', ['tab' => 'navpill-8'])}}" aria-selected="false">
            <span>Checks and Clearances</span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ $expid!='' ? '' : 'disabled' }}" href="{{ $expid!=''?route('admin.edit_nurse', ['id' => $profileData->id ?? null, 'tab' => 'tab-10']): route('admin.add_nurse', ['tab' => 'navpill-9'])}}" aria-selected="false" >
            <span>Professional Memberships & Awards</span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ $expid!='' ? '' : 'disabled' }}" href="{{ $expid!=''?route('admin.edit_nurse', ['id' => $profileData->id ?? null, 'tab' => 'tab-11']): route('admin.add_nurse', ['tab' => 'navpill-10'])}}" aria-selected="false" >
            <span>Language Skills</span>
        </a>
    </li>
    
</ul>