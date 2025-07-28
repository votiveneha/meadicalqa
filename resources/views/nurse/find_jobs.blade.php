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
      background-color: #0066ff;
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
      padding: 15px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }

    .filters h4 {
      margin-top: 20px;
      margin-bottom: 10px;
      font-size: 15px;
      color: #333;
    }

    .filters label {
      display: block;
      margin-bottom: 5px;
      font-size: 14px;
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
      background: white;
      padding: 15px 20px;
      border-radius: 8px;
      margin-bottom: 15px;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
      position: relative;
    }

    .job-title {
      font-weight: bold;
      font-size: 16px;
      margin-bottom: 5px;
    }

    .job-location {
      font-size: 13px;
      color: #666;
      margin-bottom: 10px;
    }

    .job-tags {
      font-size: 12px;
      margin-bottom: 10px;
      color: #555;
    }

    .job-tags span {
      background-color: #eef3ff;
      padding: 3px 8px;
      border-radius: 5px;
      margin-right: 5px;
    }

    .match-percentage {
      position: absolute;
      top: 20px;
      right: 100px;
      background: #e7f6ec;
      color: #2e7d32;
      padding: 5px 10px;
      border-radius: 6px;
      font-weight: bold;
      font-size: 14px;
    }

    .apply-btn {
      position: absolute;
      top: 20px;
      right: 20px;
      background: #007bff;
      color: white;
      padding: 6px 12px;
      border: none;
      border-radius: 5px;
      font-size: 14px;
      cursor: pointer;
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
  margin-left: 10px;
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
  background-color: #2196F3;
}

/* Checked position of the slider circle */
.switch input:checked + .slider:before {
  transform: translateX(20px);
}

/* Rounded style */
.slider.round {
  border-radius: 34px;
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
                    <div class="toggle-container">
                        <label for="toggleRegisteredPreferences" class="toggle-label">Use My Registered Preferences</label>&nbsp;
                        <label class="switch">
                            <input type="checkbox" id="toggleRegisteredPreferences" checked>
                            <span class="slider round"></span>
                        </label>
                        
                    </div>
                    <div class="toggle-container">
                        <label for="toggleRegisteredPreferences" class="toggle-label">Update My Preferences</label>&nbsp;
                        <label class="switch">
                            <input type="checkbox" id="toggleRegisteredPreferences" checked>
                            <span class="slider round"></span>
                        </label>
                        
                    </div>

                    <h4>Employment Type</h4>
                    <label><input type="checkbox"> Part-Time</label>
                    <label><input type="checkbox"> Casual</label>

                    <h4>Shift Type</h4>
                    <label><input type="checkbox"> Night</label>
                    <label><input type="checkbox"> Day</label>

                    <h4>Specialties</h4>
                    <label><input type="checkbox"> Aged Care</label>
                    <label><input type="checkbox"> ICU</label>

                    <h4>Location</h4>
                    <label><input type="checkbox" checked> Melbourne, VIC</label>

                    <h4>Work-Life Balance</h4>
                    <label><input type="checkbox"> Auto-filled</label>
                    <label><input type="checkbox"> Custom</label>
                </div>
                <!-- Job Listings -->
                <div class="job-listings col-md-8">
                <div class="job-card">
                    <div class="job-title">Registered Nurse</div>
                    <div class="job-location">Melbourne, VIC</div>
                    <div class="job-tags">
                    <span>Auto-filled</span><span>Shift Fit</span><span>Shortcut</span><span>Local</span>
                    </div>
                    <div class="match-percentage">85%</div>
                    <button class="apply-btn">Apply Now</button>
                </div>

                <div class="job-card">
                    <div class="job-title">Aged Care Nurse</div>
                    <div class="job-location">Melbourne, VIC</div>
                    <div class="job-tags">
                    <span>Part-Time</span><span>Night</span><span>Shortcut</span><span>Local</span>
                    </div>
                    <div class="match-percentage">78%</div>
                    <button class="apply-btn">Apply Now</button>
                </div>

                <div class="job-card">
                    <div class="job-title">Emergency Nurse</div>
                    <div class="job-location">Melbourne, VIC</div>
                    <div class="job-tags">
                    <span>Casual</span><span>Rotating Shift</span><span>Shortcut</span><span>Local</span>
                    </div>
                    <div class="match-percentage">82%</div>
                    <button class="apply-btn">Apply Now</button>
                </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection