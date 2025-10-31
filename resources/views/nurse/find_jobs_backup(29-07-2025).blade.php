@extends('nurse.layouts.layout')

@section('css')
 <style>
    
    /* Search bar */
    .search-bar {
      display: flex;
      gap: 10px;
      margin-bottom: 20px;
    }

    .search-bar input,
    .search-bar select,
    .search-bar button {
      padding: 10px;
      font-size: 14px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .search-bar input {
      flex: 2;
    }

    .search-bar select {
      flex: 1;
    }

    .search-bar button {
      background-color: black;
      color: white;
      border: none;
      cursor: pointer;
    }

    /* Layout */
    .content {
      display: flex;
      gap: 20px;
    }

    .filters {
      width: 25%;
      background: white;
      padding: 5px 5px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }

    .filter-sidebar {
    
    border: 1px solid #ccc;
    border-radius: 6px;
    font-family: Arial, sans-serif;
    background-color: #fff;
    overflow: hidden;
  }

  .filter-header {
    padding: 12px 16px;
    font-weight: bold;
    border-bottom: 1px solid #ccc;
    background-color: #f9f9f9;
  }

  .filter-list {
    list-style: none;
    margin: 0;
    padding: 0;
  }

  .filter-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 16px;
    border-bottom: 1px solid #eee;
    cursor: pointer;
    font-size: 14px;
  }

  .filter-item:hover {
    background-color: #f0f0f0;
  }

  .arrow {
    font-size: 16px;
    color: #888;
  }


    .toggle {
      display: flex;
      align-items: center;
      margin: 15px 0;
    }

    .toggle input {
      margin-right: 10px;
    }

    /* Job listings */
    .job-listings {
      width: 75%;
    }

    .job-card {
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 16px;
    margin-bottom: 16px;
    background: #fff;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    
  }

    .job-card-header {
    display: flex;
    justify-content: space-between;
    align-items: start;
  }

  .job-company {
    display: flex;
    align-items: center;
  }

  .job-logo {
    width: 40px;
    height: 40px;
    background: #007bff;
    border-radius: 8px;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 10px;
    font-size: 20px;
  }

  .job-details .location {
    color: #555;
    font-size: 0.9rem;
  }

  .job-sort-dropdown select {
    font-size: 0.85rem;
    padding: 5px 8px;
  }

  .job-role {
    font-size: 1.1rem;
    font-weight: bold;
    margin-top: 12px;
  }

  .job-meta {
    display: flex;
    justify-content: space-between;
    font-size: 0.95rem;
    color: #555;
    margin-top: 4px;
  }

  .job-matches {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    font-size: 0.85rem;
    color: #333;
    margin: 12px 0;
  }

  .dot {
    display: inline-block;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    margin-right: 6px;
  }

  .dot.blue {
    background-color: #007bff;
  }

  .dot.grey {
    background-color: #ccc;
  }

  .job-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-top: 1px solid #eee;
    padding-top: 10px;
    margin-top: 10px;
  }

  .match-score {
    font-weight: bold;
    color: #28a745;
    font-size: 0.95rem;
  }

  .apply-btn {
    background-color: black;
    color: white;
    border: none;
    padding: 6px 14px;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 500;
  }

  .apply-btn:hover {
    background-color: #0056b3;
  }

    .search-bar label {
        font-size: 12px;
        margin-bottom: 4px;
        font-weight: 500;
    }

    .find_job_div{
        background: #f5f6fa;
    }

    .toggle-container {
  display: flex;
  align-items: center;
  margin-bottom: 20px;
  font-family: 'Segoe UI', sans-serif;
}

.toggle-label {
  
  font-weight: 500;
}

/* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 44px;
  height: 24px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  background-color: #ccc;
  border-radius: 34px;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  transition: 0.4s;
}

/* Slider circle */
.slider:before {
  position: absolute;
  content: "";
  height: 18px;
  width: 18px;
  left: 3px;
  bottom: 3px;
  background-color: white;
  transition: 0.4s;
  border-radius: 50%;
}

/* Checked background */
.switch input:checked + .slider {
  background-color: black;
}

/* Checked position of the slider circle */
.switch input:checked + .slider:before {
  transform: translateX(20px);
}

/* Rounded style */
.slider.round {
  border-radius: 34px;
}

.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.4);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 999;
  }

  .modal-content {
    background: #fff;
    width: 50%;
    max-height: 90vh;
    border-radius: 8px;
    padding: 16px;
    overflow-y: auto;
  }

  .modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .modal-header h2 {
    margin: 0;
    font-size: 18px;
  }

  .modal-subtext {
    font-size: 0.9rem;
    color: #555;
    margin-bottom: 12px;
  }

  .close-btn {
    font-size: 20px;
    background: none;
    border: none;
    cursor: pointer;
  }

  .accordion-section {
    margin-bottom: 16px;
  }

  .accordion-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    cursor: pointer;
    background: #f7f7f7;
    padding: 8px;
    border-radius: 4px;
  }

  .accordion-content {
    margin-top: 8px;
    padding-left: 12px;
  }

  .accordion-content label {
    display: block;
    margin-bottom: 6px;
    font-size: 0.95rem;
  }

  .action-links {
    font-size: 0.85rem;
    color: #007bff;
  }

  .action-links a {
    margin-left: 4px;
    cursor: pointer;
    text-decoration: none;
  }


  </style>
@endsection

@section('content')
<main class="main find_job_div">
    <section class="section-box mt-30">
        <div class="container">
            <h1 style="font-size: 24px; font-weight: bold;">Find Jobs</h1>
            <!-- Horizontal Search Bar with Labels -->
            <div class="search-bar">
            <div style="display: flex; flex-direction: column; flex: 2;">
                <label for="keywords">Keywords</label>
                <input type="text" id="keywords" placeholder="e.g. ICU, aged care, night shift">
            </div>

            <div style="display: flex; flex-direction: column;">
                <label for="location">Location</label>
                <select id="location">
                <option>Melbourne, VIC</option>
                <option>Sydney, NSW</option>
                </select>
            </div>

            <div style="display: flex; flex-direction: column;">
                <label for="agency">Facility/Agency</label>
                <select id="agency">
                <option>Optional Facility/Agency</option>
                <option>St. John’s Hospital</option>
                <option>Brightview Care</option>
                </select>
            </div>

            <div style="display: flex; flex-direction: column;">
                <label for="sort">Sort By</label>
                <select>
                    <option>Match Percentage</option>
                    <option>Most Recent/fresh listings</option>
                    <option>Highest Salary / Hourly Rate</option>
                    <option>Proximity / Nearest Location</option>
                    <option>Urgent Hire</option>
                    <option>Facility/Agency Rating</option>
                    <option>Application Deadline Soonest</option>
                </select>
            </div>

            <div style="display: flex; flex-direction: column; justify-content: flex-end;">
                <button style="margin-top: auto;">Search</button>
            </div>
            </div>
            <div class="row">
                <div class="filters col-md-4">
                    
                    <div class="filter-sidebar">
                    <div class="filter-header">Filters</div>

                    <ul class="filter-list">
                      <li class="filter-item">
                        <label for="toggleRegisteredPreferences" class="toggle-label">Use My Registered Preferences</label>&nbsp;
                        <label class="switch">
                            <input type="checkbox" id="toggleRegisteredPreferences" checked>
                            <span class="slider round"></span>
                        </label>
                      </li>
                      <li class="filter-item">
                        <label for="toggleRegisteredPreferences" class="toggle-label">Update My Preferences</label>&nbsp;
                        <label class="switch">
                            <input type="checkbox" id="toggleRegisteredPreferences" checked>
                            <span class="slider round"></span>
                        </label>
                      </li>
                      <li class="filter-item" onclick="openModal('Employment Type','employeement_type_content')">
                        <span>Employment Type</span>
                        <span class="arrow">›</span>
                      </li>
                      <li class="filter-item" onclick="openModal('Shift Type','shift_type_content')">
                        <span>Shift Type</span>
                        <span class="arrow">›</span>
                      </li>
                      <li class="filter-item" onclick="openModal('Work Environment','work_environment')">
                        <span>Work Environment</span>
                        <span class="arrow">›</span>
                      </li>
                      <li class="filter-item">
                        <span>Specialty</span>
                        <span class="arrow">›</span>
                      </li>
                      <li class="filter-item">
                        <span>Years of Experience</span>
                        <span class="arrow">›</span>
                      </li>
                      <li class="filter-item">
                        <span>Certifications</span>
                        <span class="arrow">›</span>
                      </li>
                      <li class="filter-item">
                        <span>Salary Range</span>
                        <span class="arrow">›</span>
                      </li>
                      <li class="filter-item">
                        <span>Facility Type</span>
                        <span class="arrow">›</span>
                      </li>
                      <li class="filter-item">
                        <span>Benefits</span>
                        <span class="arrow">›</span>
                      </li>
                    </ul>
                  </div>

                </div>
                <!-- Job Listings -->
                <div class="job-listings col-md-8">
                  <div class="job-card">
                    <!-- Top Row: Company Logo & Dropdown -->
                    <div class="job-card-header">
                      <div class="job-company">
                        <div class="job-logo">🏥</div>
                        <div class="job-details">
                          <strong>Registered Nurse</strong>
                          <div class="location">Sydney, NSW</div>
                        </div>
                      </div>
                    
                    </div>

                    <!-- Job Info -->
                    <div class="job-role">St. John's Hospital</div>
                    <div class="job-meta">
                      <span>Casual - Night Shift</span>
                      <span>$440.00/hr</span>
                    </div>

                    <!-- Match Criteria -->
                    <div class="job-matches">
                      <div><span class="dot blue"></span> Specialty Match</div>
                      <div><span class="dot blue"></span> Shift Momentum Match</div>
                      <div><span class="dot grey"></span> A Arschecd freak</div>
                      <div><span class="dot grey"></span> Minimal ora brief</div>
                    </div>

                    <!-- Bottom Row: Match % and Button -->
                    <div class="job-footer">
                      <div class="match-score">85% Match</div>
                      <button class="apply-btn">Apply Now</button>
                    </div>
                  </div>
                  <div class="job-card">
                    <!-- Top Row: Company Logo & Dropdown -->
                    <div class="job-card-header">
                      <div class="job-company">
                        <div class="job-logo">🏥</div>
                        <div class="job-details">
                          <strong>Registered Nurse</strong>
                          <div class="location">Sydney, NSW</div>
                        </div>
                      </div>
                    
                    </div>

                    <!-- Job Info -->
                    <div class="job-role">St. John's Hospital</div>
                    <div class="job-meta">
                      <span>Casual - Night Shift</span>
                      <span>$440.00/hr</span>
                    </div>

                    <!-- Match Criteria -->
                    <div class="job-matches">
                      <div><span class="dot blue"></span> Specialty Match</div>
                      <div><span class="dot blue"></span> Shift Momentum Match</div>
                      <div><span class="dot grey"></span> A Arschecd freak</div>
                      <div><span class="dot grey"></span> Minimal ora brief</div>
                    </div>

                    <!-- Bottom Row: Match % and Button -->
                    <div class="job-footer">
                      <div class="match-score">85% Match</div>
                      <button class="apply-btn">Apply Now</button>
                    </div>
                  </div>
                </div>
            </div>
        </div>
        <!-- Modal Overlay -->
        <div id="employmentModal" class="modal-overlay" style="display: none;">
          <div class="modal-content" id="employeement_type_content" style="display:none;">
            <!-- Header -->
            <div class="modal-header">
              <h2>Employment Type</h2>
              <button class="close-btn" onclick="closeModal()">×</button>
            </div>
            <p class="modal-subtext">Your saved preferences are pre-filled. You can adjust below.</p>

            
            <!-- Scrollable Filter Section -->
            <div class="modal-body">

              @foreach($employeement_type_data as $employeement_type)
               <div class="accordion-section">
                <div class="accordion-header" onclick="toggleAccordion(this)">
                  <strong>{{ $employeement_type->emp_type }}</strong>
                  <div class="action-links">
                    <a href="#" onclick="selectAll(event, 'perm')">Select All</a> |
                    <a href="#" onclick="clearAll(event, 'perm')">Clear All</a>
                  </div>
                </div>
                <?php
                  $subemp_type = DB::table("employeement_type_preferences")->where("sub_prefer_id",$employeement_type->emp_prefer_id)->get();
                ?>
                <div class="accordion-content" id="perm">
                  @foreach($subemp_type as $subemp)
                  <label><input type="checkbox"> {{ $subemp->emp_type }}</label>
                  @endforeach
                </div>
              </div>
              @endforeach
              
            </div>
          </div>
          <div class="modal-content" id="shift_type_content" style="display:none;">
            <div class="modal-header">
              <h2>Shift Type</h2>
              <button class="close-btn" onclick="closeModal()">×</button>
            </div>
            <p class="modal-subtext">Your saved preferences are pre-filled. You can adjust below.</p>

            
            <!-- Scrollable Filter Section -->
            <div class="modal-body">

              @foreach($shift_type_data as $shift_type)
              <div class="accordion-section">
                <div class="accordion-header" onclick="toggleAccordion(this)">
                  <strong>{{ $shift_type->shift_name }}</strong>
                  <div class="action-links">
                    <a href="#" onclick="selectAll(event, 'perm')">Select All</a> |
                    <a href="#" onclick="clearAll(event, 'perm')">Clear All</a>
                  </div>
                </div>
                <?php
                  
                  $subshift_type = DB::table("work_shift_preferences")->where("shift_id",$shift_type->work_shift_id)->where("sub_shift_id",NULL)->get();
                  
                ?>
                <div class="accordion-content" id="perm">
                  @foreach($subshift_type as $subshift)
                  <label><input type="checkbox" @if($subshift->work_shift_id == "61")id="specificDaysToggle" onchange="toggleSpecificDays()" @endif> {{ $subshift->shift_name }}</label>
                  
                  
                  @endforeach
                </div>
                @if($subshift->work_shift_id == "61")
                <div id="specificDaysSection" style="display: none; margin-top: 10px;">
                  <div class="accordion-header">
                    <strong>Specific Days Off</strong>
                    <div class="action-links">
                      <a href="#" onclick="selectAll(event, 'specificDays')">Select All</a> |
                      <a href="#" onclick="clearAll(event, 'specificDays')">Clear All</a>
                    </div>
                  </div>
                  <?php
                    $subsubdays = DB::table("work_shift_preferences")->where("shift_id","8")->where("sub_shift_id","61")->get();
                  ?>
                
                  <div class="accordion-content" id="specificDays">
                    @foreach($subsubdays as $subdays) 
                      <label><input type="checkbox"> {{ $subdays->shift_name }}</label>
                    @endforeach  
                  </div>
                </div>
              </div>
              @endif
              @endforeach
              
            </div>
          </div>
        </div>
    </section>
</main>
@endsection
@section('js')
<script>
  function openModal(filter_type,filter_id) {
    var modal_heading = $("#"+filter_id+" .modal-header h2").text();
    console.log("modal_heading",modal_heading);
    if(filter_type == modal_heading){
      $(".modal-content").hide();
      $("#"+filter_id).show();
    }
    document.getElementById("employmentModal").style.display = "flex";

    
  }

  function closeModal() {
    document.getElementById("employmentModal").style.display = "none";
  }

  function toggleAccordion(header) {
    const content = header.nextElementSibling;
    const isOpen = content.style.display === 'block';
    content.style.display = isOpen ? 'none' : 'block';
  }

  function selectAll(e, id) {
    e.preventDefault();
    const section = document.getElementById(id);
    section.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = true);
  }

  function clearAll(e, id) {
    e.preventDefault();
    const section = document.getElementById(id);
    section.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
  }

  function toggleSpecificDays() {
    const checkbox = document.getElementById("specificDaysToggle");
    const section = document.getElementById("specificDaysSection");
    section.style.display = checkbox.checked ? "block" : "none";
  }
</script>

@endsection