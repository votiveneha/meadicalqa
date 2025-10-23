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
    background: white;
    padding: 10px 10px;
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

  .apply-btn.applied {
    background: none;
    color: #28a745; /* green */
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 6px;
    border: none;
    cursor: default;
    padding: 0;
}

.apply-btn.applied::before {
    content: "✔"; /* check icon */
    font-weight: bold;
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

  .third-level{
    display:none;
    margin-left:20px;
  }

  .panel {
      width: 50%;
      padding: 10px;
      
    }

    .panel.left {
      border-right: 1px solid #ddd;
    }

    .panel.left, .panel.right {
      padding: 16px;
      overflow-y: auto;
    }

    .search-box {
      width: 100%;
      padding: 8px;
      margin: 10px 0;
      /* border: 1px solid #ccc; */
      border-radius: 6px;
    }

    .search-box input {
      width: 100%;
      padding: 6px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .list-item {
      padding: 8px;
      cursor: pointer;
      border-radius: 4px;
    }

    .list-item:hover {
      background-color: #f2f2f2;
    }

    .checkbox-list,.checkbox-list-spec {
        max-height: 60vh;
        overflow-y: auto;
        padding-right: 10px;
    }

    .checkbox-list label, .checkbox-list-spec label {
      display: flex;
      align-items: center;
      margin: 6px 0;
    }

    .checkbox-list input[type="checkbox"], .checkbox-list-spec input[type="checkbox"] {
      margin-right: 10px;
    }

    .modal-actions {
      margin-top: 15px;
      text-align: right;
    }

    .modal-actions button {
      padding: 8px 14px;
      margin-left: 10px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .cancel-btn {
      background-color: #f0f0f0;
    }

    .apply-btn {
      background-color: #1e293b;
      color: white;
    }

    .modal-header {
      font-weight: bold;
      margin-bottom: 10px;
    }

    .select-bar {
      display: flex;
      justify-content: space-between;
      font-size: 13px;
      margin-bottom: 5px;
    }

    .select-bar span {
      color: #1e293b;
      cursor: pointer;
    }

    .filter-item {
  list-style: none;
  border-bottom: 1px solid #ddd;
  padding: 12px 16px;
}

.filter-label {
  display: flex;
  justify-content: space-between;
  align-items: center;
  cursor: pointer;
  font-weight: 600;
}

.arrow {
  transition: transform 0.3s ease;
}

.arrow.rotated {
  transform: rotate(90deg);
}

.sector-options {
  display: none;
  margin-top: 10px;
  padding-left: 10px;
}

.sector-options label {
  display: block;
  margin-bottom: 8px;
  font-size: 14px;
}

.auto_fill_message{
  color:#28a745;
  display:none;
}

.auto_empty_message{
  color:#28a745;
  display:none;
}

.tooltip_preferences {
  background: #333;
  color: #fff;
  padding: 6px 10px;
  border-radius: 6px;
  font-size: 12px;
  white-space: nowrap;
  margin-left: 10px;
  display: none; /* hidden by default */
}

.btn-secondary {
  background-color: #f1f1f1;
  color: #333;
  border: 1px solid #ccc;
}

.urgent-tag {
  background: #000000ff; /* red */
  color: #fff;
  font-size: 12px;
  font-weight: bold;
  padding: 4px 10px;
  border-radius: 12px;
  height: fit-content;
}

.custom-multiselect {
  position: relative;
  width: 220px; /* same as other selects */
}

.select-box {
  background: #fff;
  border: 1px solid #ced4da;
  border-radius: 6px;
  padding: 6px 12px;
  cursor: pointer;
  font-size: 14px;
  line-height: 1.5;
}

.custom-multiselect .select-box::after {
    content: "▾";
    position: absolute;
    right: 2px;
    top: 50%;
    transform: translateY(-50%);
    pointer-events: none;
    color: #6c757d;
    font-size: 20px;
}

.checkbox-options {
  display: none;
  position: absolute;
  background: #fff;
  border: 1px solid #ced4da;
  border-radius: 6px;
  margin-top: 2px;
  padding: 8px;
  z-index: 1000;
  width: 100%;
  max-height: 200px;
  overflow-y: auto;
  box-shadow: 0 2px 6px rgba(0,0,0,0.15);
}

.checkbox-options label {
  display: flex;
  align-items: center;
  justify-content: flex-start;
  gap: 6px; /* spacing between checkbox & text */
  font-size: 14px;
  padding: 4px 8px;
  cursor: pointer;
  width: 100%;
}

.checkbox-options input[type="checkbox"] {
  margin: 0;
  width: 14px;
  height: 14px;
  accent-color: #0d6efd; /* Bootstrap primary color */
}

.checkbox-options input{
  flex:none;
}
.no-jobs-box {
  padding: 20px;
  margin: 15px 0;
  border: 2px dashed #ccc;
  border-radius: 8px;
  background: #fafafa;
  text-align: center;
  box-shadow: 0 2px 6px rgba(0,0,0,0.05);
}
.no-jobs-box h3 {
  margin: 0 0 10px;
  font-size: 18px;
  color: #444;
}
.no-jobs-box p {
  margin: 0;
  font-size: 14px;
  color: #777;
}

.last-date {
  font-size: 13px;
  font-weight: 500;
  color: #dc3545; /* red */
  margin-top: 4px;
}

.item { display: none; margin: 5px; padding: 10px; border: 1px solid #ccc; }
    .pagination { 
      margin-top: 20px;
      justify-content: center; 
      align-items: center; 
      gap: 6px; 
     }
    .pagination button {
      padding: 5px 10px;
      margin: 2px;
      border: 1px solid #333;
      cursor: pointer;
      background: #f2f2f2;
    }
    .pagination .active {
      background: #333;
      color: #fff;
    }

    .accordion-header .actions button {
      margin-left: 5px;
      padding: 2px 8px;
      font-size: 12px;
      border: 1px solid #ccc;
      background: #fff;
      cursor: pointer;
      border-radius: 4px;
    }

    .accordion-header .actions button:hover {
      background: #eee;
    }

    

    .form-group.top_filter.location_filter .select-box {
    background: #fff;
    border: 1px solid #ced4da;
    border-radius: 6px;
    padding: 8px 12px;
    cursor: pointer;
    font-size: 14px;
    line-height: inherit;
    height: 43px;
    color: #666666;
}

.top_filter.agency_filter select#agency {
    background: #fff;
    height: 43px;
    color: #666666;
    border: 1px solid #ced4da;
}

.top_filter.sort_by_filter select {
    background: #fff;
    height: 43px;
    color: #666666;
    border: 1px solid #ced4da;
}

.top_filter.keywords_filter {
    width: 35%;
}

.top_filter.keywords_filter input#keywords {
    background: #fff;
    height: 43px;
    color: #666666;
    border: 1px solid #ced4da;
}

.search-bar {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
    padding-right: 8px;
    margin-left: -10px;
    justify-content: space-between;
}

.job-card.item {
    margin-top: 0px;
}

.row.filters_jobs {
    margin-bottom: 40px;
}

.tag-badge {
  display: inline-flex;
  align-items: center;
  background-color: #e9f5ff;
  color: #0d6efd;
  padding: 6px 12px;
  border-radius: 20px;
  margin: 4px;
  font-size: 14px;
  font-weight: 500;
}

.tag-badge .remove-tag {
  margin-left: 8px;
  cursor: pointer;
  font-weight: bold;
  color: #0d6efd;
}

.tag-badge .remove-tag:hover {
  color: #dc3545; /* red on hover */
}

.edit-btns{
      background: #ffffffff;
      border: none;
      border-radius: 50%;
      width: 40px;
      height: 40px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background 0.3s ease, transform 0.2s ease;
    }
    
    #saveSearchModal .modal-content{
        width:100%;
    }
</style>
@endsection

@section('content')
<main class="main find_job_div">
    <section class="section-box mt-30">
        <div class="container">
            
            <!-- <div id="oneTimeMessage" class="alert alert-info" 
                style="display:none;margin:10px 0; font-size:14px; padding:12px 40px 12px 12px; 
                        border-radius:6px; background:#e8f4fd; border:1px solid #b6e0fe; color:#084298; 
                        position:relative;">

              <span>
                <strong>Info!</strong> This alert box could indicate a neutral informative change or action.
              </span>

              
              <button id="dismissMessage" class="close" data-dismiss="alert" aria-label="close" 
                      style="position:absolute; top:8px; right:10px; background:none; 
                            border:none; font-size:16px; font-weight:bold; 
                            color:#084298; cursor:pointer;">
                ×
              </button>
            </div> -->
            <div class="saved-searches">
              <!-- My Preferences (Dynamic) -->
              <div class="chip active">
                <span>My Preferences</span>
                <!-- Link icon -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                    stroke-width="1.5" stroke="currentColor" width="16" height="16" style="opacity:0.7;">
                  <path stroke-linecap="round" stroke-linejoin="round" 
                        d="M13.19 8.688a4.5 4.5 0 0 1 0 6.364l-1.06 1.06a4.5 4.5 0 0 1-6.364-6.364l1.06-1.06m5.657 5.657a4.5 4.5 0 0 0 0-6.364l-1.06-1.06a4.5 4.5 0 0 0-6.364 6.364l1.06 1.06" />
                </svg>
                <div class="tooltip">This search is always linked to your current preferences.</div>
              </div>

              <!-- Other searches -->
              <div class="chip">
                <span>Nearby Hospitals</span>
                <span class="dot"></span>
              </div>
              <div class="chip">
                <span>Night Shifts</span>
              </div>

              <!-- Add new -->
              <div class="chip add-new" id="btnAddNew">
                + Save New
              </div>
            </div>
            <div class="find-jobs-header d-flex justify-content-between align-items-center mb-3">
                <h2 class="find-jobs-title mb-0 fw-bold">Find Jobs</h2>
                <button class="btn btn-primary save-search-btn" id="openSaveSearchModal">
                  <i class="fa fa-bookmark me-2"></i> Save Search
                </button>
              </div>
            <!-- Horizontal Search Bar with Labels -->
            <div class="search-bar">
           <div class="top_filter keywords_filter">
                <label for="keywords">Keywords</label>
                <input type="text" id="keywords" placeholder="e.g. ICU, aged care, night shift">
            </div>

            <div class="form-group top_filter location_filter">
              <label for="agency">Location</label>
              <div class="custom-multiselect">
                <div class="select-box">Select Location</div>
                <div class="checkbox-options location_boxes">
                  @if($location_status == 'international_location' || $location_status == 'multiple_location')
                  @if(!empty($country_name))
                  @foreach($country_name as $cname)
                  <label><input type="checkbox" class="location-checkbox" value="{{ $cname }}" checked> {{ $cname }}</label>
                  @endforeach
                  @endif
                  @else
                  @if($location_status == 'current_location')
                  <label><input type="checkbox" class="location-checkbox" value="{{ $country_name }}" checked> {{ $country_name }}</label>
                  @endif
                  @endif
                </div>
              </div>
            </div>

            <!-- Hidden input to store selected values -->
            <input type="hidden" id="selectedLocations" name="locations">

            <div class="top_filter agency_filter">
                <label for="agency">Facility/Agency</label>
                <select id="agency">
                  <option value="">Select Agency</option>
                
                </select>
            </div>

            <div class="top_filter sort_by_filter">
                <label for="sort">Sort By</label>
                <select onchange="sortBy(this.value)">
                    <option value="match_percent">Match Percentage</option>
                    <option value="most_recent">Most Recent/fresh listings</option>
                    <option value="highest_salary">Highest Salary / Hourly Rate</option>
                    <option value="nearest_location">Proximity / Nearest Location</option>
                    <option value="urgent_hire">Urgent Hire</option>
                    <option value="agency_rating">Facility/Agency Rating</option>
                    <option value="application_deadline">Application Deadline Soonest</option>
                </select>
            </div>

            </div>
            <div class="row">
                <div class="filters col-md-4">
                    
                    <div class="filter-sidebar">
                    <div class="filter-header">Filters</div>

                    <ul class="filter-list">
                      <li class="filter-item">
                        <label for="toggleRegisteredPreferences" class="toggle-label">Use My Registered Preferences
                          <div class="auto_fill_message">Filters are Auto-filled from your preferences</div>
                          <div class="auto_empty_message">Filters are empty/default and not Auto-filled<br> from your preferences</div>
                        </label>&nbsp;
                        <label class="switch">
                            <input type="checkbox" id="toggleRegisteredPreferences" checked>
                            <span class="slider round"></span>
                        </label>
                      </li>
                      <li class="filter-item">
                        <label for="toggleRegisteredPreferences" class="toggle-label">Update My Preferences
                          <!-- <div class="tooltip_preferences" id="tooltipPref">
                            Temporary filtering, your current filter choices are not saved
                          </div> -->
                        </label>&nbsp;
                        <label class="switch update_switch" data-bs-toggle="tooltip" data-bs-placement="right"
           title="Your current filter choices are saved in your Work Preferences & Flexibility section. Your preferences are updated for future job matching">
                            <input type="checkbox" id="toggleUpdatePreferences">
                            <span class="slider round"></span>
                        </label>
                        
                      </li>
                      <li class="filter-item" onclick="openSectorModal()">
                        <span>Sector</span>
                        <span class="arrow">›</span>
                      </li>


                      <li class="filter-item" onclick="openModal('Employment Type','employeement_type_preferences','sub_prefer_id','emp_prefer_id','emp_type')">
                        <span>Employment Type</span>
                        <span class="arrow">›</span>
                      </li>
                      <li class="filter-item" onclick="openModal_enviroment('Shift Type')">
                        <span>Shift Type</span>
                        <span class="arrow">›</span>
                      </li>
                      <li class="filter-item" onclick="openModal_enviroment('Work Environment')">
                        <span>Work Environment</span>
                        <span class="arrow">›</span>
                      </li>
                      <li class="filter-item" onclick="openModal('Position','employee_positions','subposition_id','position_id','position_name')">
                        <span>Position</span>
                        <span class="arrow">›</span>
                      </li>
                      <li class="filter-item" onclick="openModal('Benefits','benefits_preferences','subbenefit_id','benefits_id','benefits_name')">
                        <span>Benefits</span>
                        <span class="arrow">›</span>
                      </li>
                      <li class="filter-item" onclick="openLocationModel()">
                        <span>Location Preferences</span>
                        <span class="arrow">›</span>
                      </li>
                      <li class="filter-item" onclick="openNurseModal('Type of nurse')">
                        <span>Type of nurse</span>
                        <span class="arrow">›</span>
                      </li>
                      <li class="filter-item" onclick="openSpecialityModal('Speciality')">
                        <span>Specialty</span>
                        <span class="arrow">›</span>
                      </li>
                     
                      <li class="filter-item" onclick="openYearExperienceModal()">
                        <span>Years of Experience</span>
                        <span class="arrow">›</span>
                      </li>
                      <!-- <li class="filter-item">
                        <span>Certifications</span>
                        <span class="arrow">›</span>
                      </li> -->
                      <li class="filter-item" onclick="openSalaryModal()">
                        <span>Salary Range</span>
                        <span class="arrow">›</span>
                      </li>
                      
                      
                    </ul>
                  </div>

                </div>
                <!-- Job Listings -->
                 
                <div class="job-listings col-md-8">
                  <div id="no-jobs" class="no-jobs-box" style="display:none;">
                    <h3>🚫 No Jobs Found</h3>
                    <p>Sorry, no jobs match your search.</p>
                  </div>
                  <div class="job-container">
                  @foreach($jobs as $job)
                  <div class="job-card item" data-location="{{ $job->location_name }}">
                    <!-- Top Row: Company Logo & Position -->
                    <div class="job-card-header">
                      <div class="job-company">
                        <div class="job-logo">🏥</div>
                        <div class="job-details">
                          <?php

                            $nurse_type = json_decode($job->nurse_type);
                            $nurse_arr = array();  
                            if(!empty($nurse_type)){
                              foreach($nurse_type as $nt){
                                $nurse_type = DB::table("practitioner_type")->where("id",$nt)->first();
                                $nurse_arr[] = (!empty($nurse_type))?$nurse_type->name:"";
                              }
                            }

                            $nurse_arr_string = implode(",",$nurse_arr);


                            $emplyeement_positions = json_decode($job->emplyeement_positions);
                            
                            $emp_pos_arr = array();  
                            if(!empty($emplyeement_positions)){
                              foreach($emplyeement_positions as $emppos){
                                $emp_position = DB::table("employee_positions")->where("position_id",$emppos)->first();
                                $emp_pos_arr[] = $emp_position->position_name;
                              }
                            }

                            $emp_pos_arr_string = implode(",",$emp_pos_arr);

                            $emplyeement_type = json_decode($job->emplyeement_type);
                            
                            $emplyeement_type_arr = array();  
                            if(!empty($emplyeement_type)){
                              foreach($emplyeement_type as $emptype){
                                
                                $emp_type = DB::table("employeement_type_preferences")->where("emp_prefer_id",$emptype)->first();
                                
                                $emplyeement_type_arr[] = $emp_type->emp_type;
                              }
                            }

                            $emplyeement_type_arr_string = implode(",",$emplyeement_type_arr);
                            

                            $shift_type = json_decode($job->shift_type);
                            
                            $shift_type_arr = array();  
                            if(!empty($shift_type)){
                              foreach($shift_type as $shifttype){
                                
                                $shiftty = DB::table("work_shift_preferences")->where("work_shift_id",$shifttype)->first();
                                
                                $shift_type_arr[] = $shiftty->shift_name;
                              }
                            }

                            $shift_type_arr_string = implode(",",$shift_type_arr);

                            $work_environment = json_decode($job->work_environment);
                            
                            $work_environment_arr = array();  
                            if(!empty($work_environment)){
                              foreach($work_environment as $work_env){
                                
                                $workenv = DB::table("work_enviornment_preferences")->where("prefer_id",$work_env)->first();
                                
                                $work_environment_arr[] = $workenv->env_name;
                              }
                            }

                            $work_environment_arr_string = implode(",",$work_environment_arr);

                            $benefits = json_decode($job->benefits);
                            
                            $benefits_arr = array();  
                            if(!empty($benefits)){
                              foreach($benefits as $benefit){
                                
                                $benefit_data = DB::table("benefits_preferences")->where("benefits_id",$benefit)->first();
                                
                                $benefits_arr[] = $benefit_data->benefits_name;
                              }
                            }

                            $benefits_arr_string = implode(",",$benefits_arr);

                            $specialityies = json_decode($job->typeofspeciality);
                            
                            $speciality_arr = array();  
                            if(!empty($specialityies)){
                              foreach($specialityies as $special){
                                
                                $speciality_data = DB::table("speciality")->where("id",$special)->first();
                                
                                //$speciality_arr[] = $speciality_data?->name : '';
                              }
                            }

                            $speciality_arr_string = implode(",",$speciality_arr);
                            
                            
                          ?>
                          <strong>{{ $nurse_arr_string }}</strong>
                          <div class="location">{{ $job->location_name }}</div>
                        </div>
                      </div>
                      @if($job->urgent_hire == 1)
                      <div class="urgent-tag">Urgent Hiring</div>
                      @endif
                    </div>

                    <!-- Job Role / Hospital Name -->
                    <div class="job-role">{{ $job->agency_name }}</div>

                    <!-- Main Job Info -->
                    <div class="job-meta">
                      <span><strong>Position:</strong> {{ $emp_pos_arr_string }}</span>
                      <span class="salary"><strong>Salary:</strong> ${{ $job->salary }}/hr</span>
                    </div>

                    <!-- Expanded Job Details -->
                    <div class="job-info-details">
                      <div><strong>Sector:</strong> {{ $job->sector }}</div>
                      <div><strong>Employment Type:</strong> {{ $emplyeement_type_arr_string }}</div>
                      <div><strong>Shift Type:</strong> {{ $shift_type_arr_string }}</div>
                      <div><strong>Work Environment:</strong> {{ $work_environment_arr_string }}</div>
                      <div><strong>Benefits:</strong> {{ $benefits_arr_string }}</div>
                      
                      <div><strong>Specialty:</strong> {{ $speciality_arr_string }}</div>
                      <div><strong>Experience Required:</strong>
                      
                      {{ $job->experience_level }}{{ $job->experience_level == 1 ? 'st' : ($job->experience_level == 2 ? 'nd' : ($job->experience_level == 3 ? 'rd' : 'th')) }} Year</div>
                      <div class="last-date">
                        Last Date:
                        <?php
                          echo $formattedDate = date("d M Y", strtotime($job->application_submission_date));
                        ?>
                         
                      </div>      
                    </div>
                    <?php
                    
                        $sector_percent = (!empty($work_preferences_data) && $work_preferences_data->sector_preferences == $job->sector) ? 1 : 0;
                        $emptype_preferences = (!empty($work_preferences_data))?$work_preferences_data->emptype_preferences:'';
                        $emp_type = (array)json_decode($emptype_preferences);
                        $mainIndex = array_key_first($emp_type);

                        if($mainIndex != ""){
                          $ids = $emp_type[$mainIndex];
                        }else{
                          $ids = [0];
                        }
                        
                        $names = DB::table('employeement_type_preferences')
                                    ->whereIn('emp_prefer_id', $ids)
                                    ->pluck('emp_type')
                                    ->toArray();
                        $mainIndexName = DB::table('employeement_type_preferences')
                                          ->where('emp_prefer_id', $mainIndex)
                                          ->value('emp_type');        
                                          
                        $result = [
                          "main_index" => $mainIndexName,
                          "children"   => $names
                        ];             
                        
                        $searchValues = array_map('trim', explode(',', $emplyeement_type_arr_string));
                        //print_r($searchValues);
                        $getEmp = '';
                        foreach ($searchValues as $searchValue) {
                            if ($result['main_index'] === $searchValue) {
                                $getEmp = 1;
                            } elseif (in_array($searchValue, $result['children'])) {
                                $getEmp = 1;
                            } else {
                                $getEmp = 0;
                            }
                        }

                        $shift_values = (array)json_decode($job->shift_type);
                        $shift_percent = '';
                        foreach ($shift_values as $shiftKey) {
                          $work_shift_preferences = (!empty($work_preferences_data))?$work_preferences_data->work_shift_preferences:'';        
                          if (array_key_exists($shiftKey, (array)json_decode($work_shift_preferences))) {
                            $shift_percent = 1;
                          } else {
                            $shift_percent = 0;
                          }
                        }

                        $match_percent_add = $sector_percent + $getEmp + $shift_percent;

                        $total_percent = $match_percent_add * 100/10;

                        
                        $work_environment_preferences = (!empty($work_preferences_data))?$work_preferences_data->work_environment_preferences:'';        
                        $workEnvPrefs = (array)json_decode($work_environment_preferences);

                        
                        $user_id = Auth::guard("nurse_middle")->user()->id;

                        $apply_job_data = DB::table("job_apply")->where("user_id",$user_id)->where("job_id",$job->id)->first();
                        //print_r($names);
                    ?>        
                    <!-- Footer: Match & Apply -->
                    <div class="job-footer">
                      <div class="match-score">{{ $total_percent }}% Match</div>
                      <button class="apply-btn apply-btn-{{ $job->id }} @if(!empty($apply_job_data)) applied @endif" onclick="applyNow('{{ $user_id }}','{{ $job->id }}')">
                        @if(!empty($apply_job_data))
                        Applied
                        @else
                        Apply Now
                        @endif
                      </button>
                      
                    </div>
                  </div>
                  @endforeach
                  </div>
                  <div class="pagination"></div>
                </div>
                
            </div>
        </div>
        @include('nurse.job_modals')
        
    </section>
    <!-- Save Search Modal -->
<div class="modal fade" id="saveSearchModal" tabindex="-1" aria-labelledby="saveSearchLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4">
      <div class="modal-header">
        <h5 class="modal-title fw-semibold" id="saveSearchLabel">Save Search</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">

        <div class="mb-3">
          <label class="form-label fw-semibold">Search Name</label>
          <input type="text" class="form-control" id="searchName" value="Sydney • Night • ICU">
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Email Alert</label>
          <select class="form-select" id="alertFrequency">
            <option>Off</option>
            
            <option selected>Daily</option>
            <option>Weekly</option>
            <option>Monthly</option>
          </select>
        </div>


      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-primary" id="createSearchBtn">Create</button>
      </div>
    </div>
  </div>
</div>
</main>
<script>
$(document).ready(function(){

  const saveSearch = document.getElementById('createSearchBtn');
  const modal = document.getElementById('saveSearchModal');

  saveSearch.addEventListener('click', () => {
    const nameInput = document.getElementById('searchName');
    const name = nameInput.value.trim() || 'Saved Search';
    const newChip = document.createElement('div');
    newChip.className = 'chip';
    newChip.innerHTML = `<span>${name}</span>`;
    document.querySelector('.saved-searches').insertBefore(
      newChip,
      document.getElementById('btnAddNew')
    );
    nameInput.value = '';
    modal.classList.remove('active');
    $("#saveSearchModal").hide();
    $(".modal-backdrop").hide();
  });
  
    
  
      
  $('[data-bs-toggle="tooltip"]').tooltip();

  // Open modal
  $('#openSaveSearchModal, .add-new').click(function(){
    $('#saveSearchModal').modal('show');
  });

  // Chip active state (except My Preferences non-clickable)
  $('.saved-search-chip').not('.my-preferences').click(function(){
    $('.saved-search-chip').removeClass('active');
    $(this).addClass('active');
  });

  // Unsaved changes detection
  $('.filter-field').on('change', function(){
    $('#unsavedDot').removeClass('d-none');
    $('#updateSearchBtn').prop('disabled', false);
  });

  
  // Simulate save
  // $('#createSearchBtn').click(function(){
  //   $('#saveSearchModal').modal('hide');
  //   $('#unsavedDot').addClass('d-none');
  //   $('#updateSearchBtn').prop('disabled', true);
  //   alert('✅ Saved search created!');
  // });

  // Prevent deleting My Preferences (example safeguard)
  $('.saved-search-chip.my-preferences').on('contextmenu', function(e){
    e.preventDefault();
    alert('ℹ️ “My Preferences” search cannot be deleted.');
  });
});
</script>
<script>
$(document).ready(function(){
    
  
      
  $('[data-bs-toggle="tooltip"]').tooltip();

  // Open modal
  $('#openSaveSearchModal, .add-new').click(function(){
    $('#saveSearchModal').modal('show');
  });

  // Chip active state (except My Preferences non-clickable)
  $('.saved-search-chip').not('.my-preferences').click(function(){
    $('.saved-search-chip').removeClass('active');
    $(this).addClass('active');
  });

  // Unsaved changes detection
  $('.filter-field').on('change', function(){
    $('#unsavedDot').removeClass('d-none');
    $('#updateSearchBtn').prop('disabled', false);
  });

  // Simulate save
  $('#createSearchBtn').click(function(){
    $('#saveSearchModal').modal('hide');
    $('#unsavedDot').addClass('d-none');
    $('#updateSearchBtn').prop('disabled', true);
    alert('✅ Saved search created!');
  });

  // Prevent deleting My Preferences (example safeguard)
  $('.saved-search-chip.my-preferences').on('contextmenu', function(e){
    e.preventDefault();
    alert('ℹ️ “My Preferences” search cannot be deleted.');
  });
});
</script>
<script>

  // $(document).ready(function () {
  //     var $container = $('.job-listings'); // replace with your actual wrapper id/class

  //     // Get all job cards
  //     var $cards = $container.children('.job-card');

  //     // Sort by match percentage
  //     $cards.sort(function (a, b) {
  //         var aVal = parseInt($(a).find('.match-score').text()); // "20% Match" → 20
  //         var bVal = parseInt($(b).find('.match-score').text());

  //         return bVal - aVal; // High to Low (swap if you want Low → High)
  //     });

  //     // Re-append in sorted order
  //     $container.append($cards);
  // });
  function sortBy(value){
    if(value == 'most_recent' || value == 'urgent_hire' || value == 'application_deadline'){
      $.ajax({
        type: "POST",
        url: "{{ url('/nurse/getJobsSorting') }}",
        data: {sort_name:value,_token:'{{ csrf_token() }}'},
        cache: false,
        success: function(data){
          console.log("data",data);
          $(".job-listings").html(data);
        }  
      });
    }

    if(value == 'match_percent'){
       // Container holding all job cards
      var $container = $('.job-listings'); // replace with your actual wrapper id/class

      // Get all job cards
      var $cards = $container.children('.job-card');

      // Sort by match percentage
      $cards.sort(function (a, b) {
          var aVal = parseInt($(a).find('.match-score').text()); // "20% Match" → 20
          var bVal = parseInt($(b).find('.match-score').text());

          return bVal - aVal; // High to Low (swap if you want Low → High)
      });

      // Re-append in sorted order
      $container.html($cards);
    }

    if(value == 'highest_salary'){
      var $container = $('.job-listings');   // wrapper div of all job cards
      var $cards = $container.children('.job-card');

      $cards.sort(function (a, b) {
          // Extract numeric salary
          var aSalary = parseInt($(a).find('.salary').text().replace(/[^0-9]/g, ''));
          var bSalary = parseInt($(b).find('.salary').text().replace(/[^0-9]/g, ''));

          return bSalary - aSalary; // High → Low
      });

      $container.html($cards); // re-render sorted order
    }

    if(value == 'nearest_location'){
      ensureLatLng(function () {
        getCurrentLocation(function (coords) {
          sortJobsByProximity(coords);
        });
      });
    }
  }

 $(document).ready(function() {
  $("#keywords").on("keyup", function () {
    var value = $(this).val().toLowerCase().trim();
    var $jobs = $(".job-listings .job-card");
    var hasResults = false;

    if (value === "") {
      // If input empty → show all jobs, hide no jobs box
      $jobs.show();
      $("#no-jobs-box").hide();
      $(".pagination").show();
      return;
    }

    $jobs.each(function () {
      let match = $(this).text().toLowerCase().indexOf(value) > -1;
      $(this).toggle(match);
      if (match) hasResults = true;
    });

    if (!hasResults) {
      $(".no-jobs-box").show();
      $(".pagination").hide(); // hide pagination when no jobs
    } else {
      $(".no-jobs-box").hide();
      $(".pagination").show();
      
    }
  });
});


 let allLocations = [...new Set($('.location').map(function () {
    return $(this).text().trim();
}).get())];

// 2. Get all values from existing checkboxes
let checkboxLocations = $('.location-checkbox').map(function () {
    return $(this).val().trim();
}).get();

// 3. Filter out locations that are already in checkboxes
let remainingLocations = allLocations.filter(loc => !checkboxLocations.includes(loc));

console.log("Remaining Locations:", remainingLocations);

  // Append options to dropdown
  let $dropdown = $('.location_boxes');
  remainingLocations.forEach(function(loc) {
      $dropdown.append('<label><input type="checkbox" class="location-checkbox" value="'+loc+'"> '+loc+'</label>');
  });

 function filterJobs() {
    // Get all checked locations
    let selectedLocations = $('.location-checkbox:checked').map(function () {
        return $(this).val().trim();
    }).get();

    if (selectedLocations.length === 0) {
        // If nothing is checked → show all jobs
        $('.job-card').show();
        return;
    }

    // Loop through job cards
    $('.job-card').each(function () {
        let jobLocation = $(this).find('.location').text().trim();

        if (selectedLocations.includes(jobLocation)) {
            $(this).show(); // match → show
        } else {
            $(this).hide(); // not match → hide
        }
    });

    // Update dropdown display text
    updateSelectedLocationsBox();
    checkIfNoJobs(); // ✅ check if all are hidden
}

function checkIfNoJobs() {
    if ($('.job-card:visible').length === 0) {
        $('#no-jobs').show();
    } else {
        $('#no-jobs').hide();
    }
}

// Run when checkboxes change
$(document).on('change', '.location-checkbox', filterJobs);

// Run once on page load (for auto-checked locations)
$(document).ready(filterJobs);

function updateSelectedLocationsBox() {
    let selected = $('.location-checkbox:checked').map(function () {
        return $(this).val().trim();
    }).get();

    if (selected.length > 0) {
        $('.select-box').text(selected.join(', '));
    } else {
        $('.select-box').text('Select Location');
    }
}


  //For Agency
  let uniqueAgency = [...new Set($('.job-role').map(function() {
    return $(this).text().trim();
  }).get())];

  console.log("uniqueAgency",uniqueAgency);

  // Append options to dropdown
  let $dropdown_agency = $('#agency');
  uniqueAgency.forEach(function(agency) {
    $dropdown_agency.append('<option value="'+ agency +'">'+ agency +'</option>');
  });

  $('#agency').on('change', function() {
    let selectedAgency = $(this).val().trim();

    // Show all jobs if no location selected
    if (selectedAgency === "") {
        $('.job-card').show();
        return;
    }

    // Loop through each job card
    $('.job-card').each(function() {
        let jobAgency = $(this).find('.job-role').text().trim();

        if (jobAgency === selectedAgency) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });
  });

  var selected = [];
  $(".location-checkbox:checked").each(function () {
      selected.push($(this).val());
  });

  console.log(selected); 


  $("#toggleRegisteredPreferences").click(function(){
    if ($("#toggleRegisteredPreferences").is(":checked")) {
      
      $(".auto_fill_message").show();
      $(".auto_empty_message").hide();
    } else {
      
      $(".auto_fill_message").hide();
      $(".auto_empty_message").show();
    }
  }); 


$('#toggleUpdatePreferences').on('change', function() {
    if($(this).is(':checked')) {
        // Update tooltip text for ON
        $(this).parent()
            .attr('data-bs-original-title', 'Your current filter choices are saved in your Work Preferences & Flexibility section. Your preferences are updated for future job matching')
            .tooltip('show');
    } else {
        // Update tooltip text for OFF
        $(this).parent()
            .attr('data-bs-original-title', 'Temporary filtering, your current filter choices are not saved')
            .tooltip('show');
    }

    // Auto hide after 4s (optional)
    setTimeout(() => {
        $(this).parent().tooltip('hide');
    }, 4000);
});

$('.dropdown-toggle').on('click', function() {
  $(this).next('.dropdown-menu').toggle();
});

// Close dropdown if clicked outside
$(document).on('click', function(e) {
  if (!$(e.target).closest('.dropdown').length) {
    $('.dropdown-menu').hide();
  }
});
// Toggle dropdown
$('.select-box').on('click', function() {
  $(this).siblings('.checkbox-options').toggle();
});

// Close when clicking outside
$(document).on('click', function(e) {
  if (!$(e.target).closest('.custom-multiselect').length) {
    $('.checkbox-options').hide();
  }
});

// Handle checkbox selection
$('.checkbox-options input[type="checkbox"]').on('change', function() {
  let selected = [];
  $(this).closest('.checkbox-options')
         .find('input[type="checkbox"]:checked')
         .each(function() {
            selected.push($(this).val());
         });

  // Update display text
  let displayText = selected.length > 0 ? selected.join(', ') : "Select Location";
  $(this).closest('.custom-multiselect').find('.select-box').text(displayText);

  // Update hidden field
  $('#selectedLocations').val(selected.join(','));
});


    // Get all checked values
    var selected = $(".location-checkbox:checked").map(function () {
        return $(this).val();
    }).get();

    if (selected.length === 0) {
        // If nothing selected, show all jobs
        $(".job-card").show();
    } else {
        // Otherwise, filter
        $(".job-card").each(function () {
            var jobLocation = $(this).data("location");
            if (selected.includes(jobLocation)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

    function applyNow(user_id,job_id){
      $.ajax({
        type: "POST",
        url: "{{ url('/nurse/applyJobs') }}",
        data: {user_id:user_id,job_id:job_id,_token:'{{ csrf_token() }}'},
        cache: false,
        success: function(data){
          //console.log("data",data);
          if(data == 1){
            let btn = $('.apply-btn-'+job_id);

            // simulate successful apply (you can call AJAX here)
            btn.text('Applied');
            btn.addClass('applied');
            btn.prop('disabled', true); // optional: disable after applying
          }
        }  
      });
    }

$(document).ready(function () {
  var itemsPerPage = 2;
  var currentPage = 1;

  // Get filtered jobs based on location + keyword
    function getFilteredItems() {
      var selectedLocations = $(".location-checkbox:checked")
        .map(function () {
          return $(this).val();
        })
        .get();

      var selectedAgency = $("#agency").val().trim();
      var keyword = $("#keywords").val().toLowerCase().trim();

      return $(".job-card.item").filter(function () {
        var matchesLocation =
          selectedLocations.length === 0 ||
          selectedLocations.includes($(this).data("location"));

        var jobAgency = $(this).find(".job-role").text().trim();
        var matchesAgency =
          selectedAgency === "" || jobAgency === selectedAgency;

        var matchesKeyword =
          keyword === "" || $(this).text().toLowerCase().indexOf(keyword) > -1;

        return matchesLocation && matchesAgency && matchesKeyword;
      });
    }

  function showPage(page) {
    var items = getFilteredItems();
    var totalPages = Math.ceil(items.length / itemsPerPage);
    if (page < 1) page = 1;
    if (page > totalPages) page = totalPages;

    currentPage = page;
    $(".job-card.item").hide();

    var start = (page - 1) * itemsPerPage;
    var end = start + itemsPerPage;
    items.slice(start, end).show();

    $(".pagination button.page").removeClass("active");
    $(".pagination button.page[data-page='" + page + "']").addClass("active");

    $(".pagination button.prev").prop("disabled", page === 1);
    $(".pagination button.next").prop("disabled", page === totalPages);
  }

  function buildPagination() {
    var items = getFilteredItems();
    var totalPages = Math.ceil(items.length / itemsPerPage);
    $(".pagination").empty();

    if (items.length === 0) {
      $(".pagination").html("<p>No jobs found</p>");
      return;
    }

    if (totalPages > 1) {
      $(".pagination").append("<button class='prev'>&laquo;</button>");
      for (var i = 1; i <= totalPages; i++) {
        $(".pagination").append(
          "<button class='page' data-page='" + i + "'>" + i + "</button>"
        );
      }
      $(".pagination").append("<button class='next'>&raquo;</button>");
    }
    showPage(1);
  }



  // Pagination click events
  $(".pagination").on("click", "button.page", function () {
    showPage($(this).data("page"));
  });

  $(".pagination").on("click", "button.prev", function () {
    showPage(currentPage - 1);
  });

  $(".pagination").on("click", "button.next", function () {
    showPage(currentPage + 1);
  });

  // Checkbox filter change
  $(document).on("change", ".location-checkbox", function () {
    buildPagination();
  });

  $("#keywords").on("keyup", function () {
    buildPagination();
  });

  $("#agency").on("change", function () {
    buildPagination();
  });

  // Initial load
  buildPagination();

  // Accordion toggle (only when clicking the header text, not buttons)
$(document).on("click", ".accordion-header", function(e) {
  if ($(e.target).is("button")) return; // ignore if button clicked
  $(this).next(".accordion-content").slideToggle();
});

// Select All
// $(document).on("click", ".select-all", function(e) {
//   e.stopPropagation(); // prevent toggle
//   var target = $(this).data("target");
//   $("#" + target + " .sector_checkbox").prop("checked", true);
// });

// Clear All
// $(document).on("click", ".clear-all", function(e) {
//   e.stopPropagation(); // prevent toggle
//   var target = $(this).data("target");
//   $("#" + target + " .sector_checkbox").prop("checked", false);
// });

});
// 📌 Haversine formula (distance in km)
function getDistance(lat1, lon1, lat2, lon2) {
  var R = 6371; // Earth radius in km
  var dLat = (lat2 - lat1) * Math.PI / 180;
  var dLon = (lon2 - lon1) * Math.PI / 180;
  var a =
    Math.sin(dLat / 2) * Math.sin(dLat / 2) +
    Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
    Math.sin(dLon / 2) * Math.sin(dLon / 2);
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
  return R * c;
}

// 📌 Get current user location (via browser)
function getCurrentLocation(callback) {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function (position) {
      callback({
        lat: position.coords.latitude,
        lng: position.coords.longitude
      });
    }, function () {
      alert("Unable to fetch your location. Please enable GPS.");
    });
  } else {
    alert("Geolocation is not supported by this browser.");
  }
}

// 📌 Fetch lat/lng using Nominatim if missing
function fetchLatLng(address, $jobCard, callback) {
  $.get("https://nominatim.openstreetmap.org/search", {
    q: address,
    format: "json",
    limit: 1
  }, function (data) {
    if (data && data.length > 0) {
      $jobCard.attr("data-lat", data[0].lat);
      $jobCard.attr("data-lng", data[0].lon);
    }
    if (callback) callback();
  });
}

// 📌 Ensure all jobs have lat/lng before sorting
function ensureLatLng(callback) {
  var $jobs = $(".job-card.item");
  var remaining = $jobs.length;

  $jobs.each(function () {
    var $job = $(this);
    var lat = $job.attr("data-lat");
    var lng = $job.attr("data-lng");

    if (!lat || !lng) {
      var address = $job.data("location");
      fetchLatLng(address, $job, function () {
        if (--remaining === 0) callback();
      });
    } else {
      if (--remaining === 0) callback();
    }
  });
}

// 📌 Sort jobs by proximity to current location
function sortJobsByProximity(userCoords) {
  var $jobs = $(".job-card.item");

  $jobs.sort(function (a, b) {
    var distA = getDistance(userCoords.lat, userCoords.lng,
      $(a).data("lat"), $(a).data("lng"));
    var distB = getDistance(userCoords.lat, userCoords.lng,
      $(b).data("lat"), $(b).data("lng"));
    return distA - distB;
  });

  $(".job-listings").html($jobs); // Re-render sorted jobs
}



</script>
@endsection