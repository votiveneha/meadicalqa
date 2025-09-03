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
      margin-bottom: 10px;
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

</style>
@endsection

@section('content')
<main class="main find_job_div">
    <section class="section-box mt-30">
        <div class="container">
            
            <div id="oneTimeMessage" class="alert alert-info" 
                style="display:none;margin:10px 0; font-size:14px; padding:12px 40px 12px 12px; 
                        border-radius:6px; background:#e8f4fd; border:1px solid #b6e0fe; color:#084298; 
                        position:relative;">

              <span>
                <strong>Info!</strong> This alert box could indicate a neutral informative change or action.
              </span>

              <!-- Cancel Button (right aligned) -->
              <button id="dismissMessage" class="close" data-dismiss="alert" aria-label="close" 
                      style="position:absolute; top:8px; right:10px; background:none; 
                            border:none; font-size:16px; font-weight:bold; 
                            color:#084298; cursor:pointer;">
                ×
              </button>
            </div>

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
                  @foreach($jobs as $job)
                  <div class="job-card">
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
                                $nurse_arr[] = $nurse_type->name;
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
                                
                                $speciality_arr[] = $speciality_data->name;
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
                    </div>
                    <?php
                        $sector_percent = ($work_preferences_data->sector_preferences == $job->sector) ? 1 : 0;

                        $emp_type = (array)json_decode($work_preferences_data->emptype_preferences);
                        $mainIndex = array_key_first($emp_type);
                        $ids = $emp_type[$mainIndex];
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
                          if (array_key_exists($shiftKey, (array)json_decode($work_preferences_data->work_shift_preferences))) {
                            $shift_percent = 1;
                          } else {
                            $shift_percent = 0;
                          }
                        }

                        $match_percent_add = $sector_percent + $getEmp + $shift_percent;

                        $total_percent = $match_percent_add * 100/10;

                        

                        $workEnvPrefs = (array)json_decode($work_preferences_data->work_environment_preferences);

                        


                        
                        //print_r($names);
                    ?>        
                    <!-- Footer: Match & Apply -->
                    <div class="job-footer">
                      <div class="match-score">{{ $total_percent }}% Match</div>
                      <button class="apply-btn">Apply Now</button>
                    </div>
                  </div>
                  @endforeach
                </div>
            </div>
        </div>
        @include('nurse.job_modals')
        
    </section>
</main>
<script>
  $(document).ready(function () {
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
  });
  function sortBy(value){
    if(value == 'most_recent'){
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
  }

  function toggleMessage() {
    if ($("#toggleRegisteredPreferences").is(":checked")) {
      $(".auto_fill_message").show();
      $(".auto_empty_message").hide();
    } else {
      $(".auto_fill_message").hide();
      $(".auto_empty_message").show();
    }
  }

  toggleMessage(); // on page load

  // var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  // var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  //   return new bootstrap.Tooltip(tooltipTriggerEl)
  // })

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



  // On toggle change
  //togglePref.addEventListener("change", updateTooltip);

</script>
@endsection
