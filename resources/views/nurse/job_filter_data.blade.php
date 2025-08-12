@foreach($jobs as $job)
<div class="job-card">
    <!-- Top Row: Company Logo & Position -->
    <div class="job-card-header">
        <div class="job-company">
        <div class="job-logo">🏥</div>
        <div class="job-details">
            <strong>Registered Nurse</strong>
            <div class="location">Sydney, NSW</div>
        </div>
        </div>
    </div>

    <!-- Job Role / Hospital Name -->
    <div class="job-role">St. John's Hospital</div>

    <!-- Main Job Info -->
    <div class="job-meta">
        <span><strong>Position:</strong> Casual - Night Shift</span>
        <span><strong>Salary:</strong> $440.00/hr</span>
    </div>

    <!-- Expanded Job Details -->
    <div class="job-info-details">
        <div><strong>Sector:</strong> {{ $job->sector }}</div>
        <div><strong>Employment Type:</strong> Permanent</div>
        <div><strong>Shift Type:</strong> Permanent</div>
        <div><strong>Work Environment:</strong> Permanent</div>
        <div><strong>Benefits:</strong> Travel allowance, Free accommodation</div>
        <div><strong>Type of Nurse:</strong> ICU Nurse</div>
        <div><strong>Specialty:</strong> Critical Care</div>
        <div><strong>Experience Required:</strong> 2+ years</div>
    </div>

    <!-- Footer: Match & Apply -->
    <div class="job-footer">
        <div class="match-score">85% Match</div>
        <button class="apply-btn">Apply Now</button>
    </div>
</div>
@endforeach