
<div class="modal-overlay" id="save-search-modal" style="display: none;">
    <div class="modal-content">
        <h3 id="modal-title">Save Search</h3>
        <form method="post" id="add_saved_searches" method="POST" onsubmit="return add_saved_searches()">
        @csrf
        <div class="form-group level-drp">
            <label for="search-name">Search Name</label>              
            <input type="text" id="search-name" name="search_name" class="form-control" placeholder="Enter a name"> 
            <span id='reqsearch-name' class='reqError text-danger valley'></span>
        </div>                  
        
        <div class="form-group level-drp">
            <label for="alert-frequency">Alert Frequency</label>
            <select id="alert-frequency" name="alert_frequency" class="form-control">
                <option value="">Select</option>
                <option value="Off">Off</option>
                <option value="Realtime">Realtime</option>
                <option value="Daily">Daily</option>
                <option value="Weekly">Weekly</option>
            </select>
            <span id='reqalert-frequency' class='reqError text-danger valley'></span>
        </div>
        <div class="form-group level-drp">
            <label for="delivery-method">Delivery Method</label>
            <select id="delivery-method" name="delivery_method" class="form-control">
                <option value="">Select</option>
                <option value="Email">Email</option>
                <option value="In-app">In-app</option>
                <option value="SMS">SMS</option>
            </select>
            <span id='reqdelivery-method' class='reqError text-danger valley'></span>
        </div>
        <div class="modal-actions">
            <button type="button" class="btn-cancel">Cancel</button>
            <button type="submit" id="submitSavedSearches" class="btn-save">Save</button>
        </div>
        </form>
    </div>
</div>
<!-- DELETE CONFIRM MODAL -->
<div class="modal-overlay" id="delete-modal" style="display: none;">
    <div class="modal-content">
        <p>This action cannot be undone. Are you sure?</p>
        <button class="modal-cancel" id="delete-cancel">Cancel</button>
        <button class="modal-confirm" id="delete-confirm">Delete</button>
    </div>
</div>
<!-- Rename Modal -->
<div id="renameModal" class="modal-overlay" style="display:none;">
  <div class="modal-content">
    <h3>Rename Saved Search</h3>
    <input type="text" id="renameInput" class="form-control" placeholder="Enter new name">
    <div class="modal-actions">
      <button class="btn-cancel" id="renameCancel">Cancel</button>
      <button class="btn-save" id="renameSave">Save</button>
    </div>
  </div>
</div>
<div class="drawer-overlay"></div>
<div class="edit_side_drawer">
    <!-- SIDE DRAWER -->
    <div class="drawer" id="drawer">
        <h3 id="drawer-title">Edit Search</h3>
        <div class="tabs">
            <ul class="tab-nav-edit">
                <li class="active" data-tab="tab3">Filters</li>
                <li data-tab="tab4">Alerts</li>
                <li data-tab="tab5">Name & Notes</li>
            </ul>
            
        </div>
        <form method="post" id="update_saved_searches" method="POST" onsubmit="return update_saved_searches()">
            @csrf
            <input type="hidden" name="search_id" id="search_id">
            <div class="tab-content-edit active" id="tab3">
                <div class="filter-section">
                    <div class="filter-title">
                        <span>Sector</span>
                        <span class="icon">&#8250;</span>
                    </div>
                    <div class="filter-options">
                        <label><input type="radio" class="edit_sector_radio" name="edit_sector" value="Public & Government"> Public & Government </label>
                        <label><input type="radio" class="edit_sector_radio" name="edit_sector" value="Private"> Private </label>
                        <label><input type="radio" class="edit_sector_radio" name="edit_sector" value="Public Government & Private"> Public Government & Private</label>
                    </div>
                </div>
                <div class="filter-section">
                    <div class="filter-title">
                        <span>Employment Type</span>
                        <span class="icon">&#8250;</span>
                    </div>
                    <div class="filter-options">
                        @foreach($employeement_type_data as $emp_data)
                        <label class="sub-heading emp-type-{{ $emp_data->emp_prefer_id }}" data-name="Employment Type" data-filter="employment_type" data-value="{{ $emp_data->emp_prefer_id }}"><input type="checkbox" value="{{ $emp_data->emp_type }}"> {{ $emp_data->emp_type }}</label>
                        
                        @endforeach
                        
                    </div>
                    <div class="subpagedata-employment_type">
                        <!-- <div class="subpage-header">
                        <span class="back-btn">&#8249;</span><h4>Permanent</h4>
                        </div>
                        <div class="subpage-content">
                        <p style="font-size:14px;color:#555;">Detailed options for <b>Permanent</b> roles can appear here.</p>
                        <label><input type="checkbox"> Full Time</label>
                        <label><input type="checkbox"> Part Time</label>
                        </div> -->
                    </div>
                </div>
                <div class="filter-section">
                    <div class="filter-title">
                        <span>Shift Type</span>
                        <span class="icon">&#8250;</span>
                    </div>
                    <div class="filter-options">
                        @foreach($work_shift_data as $work_shift)
                        <label class="sub-heading shift-type-{{ $work_shift->work_shift_id }}" data-filter="work_shift"
                            data-value="{{ $work_shift->work_shift_id }}"
                            data-name="Shift Type">
                            <input type="checkbox" value="{{ $work_shift->shift_name }}"> {{ $work_shift->shift_name }}</label>
                        
                        @endforeach
                        
                    </div>
                    <div class="subpagedata-work_shift">
                        <!-- <div class="subpage-header">
                        <span class="back-btn">&#8249;</span><h4>Permanent</h4>
                        </div>
                        <div class="subpage-content">
                        <p style="font-size:14px;color:#555;">Detailed options for <b>Permanent</b> roles can appear here.</p>
                        <label><input type="checkbox"> Full Time</label>
                        <label><input type="checkbox"> Part Time</label>
                        </div> -->
                    </div>
                </div>
                <div class="filter-section">
                    <div class="filter-title">
                        <span>Work Environment</span>
                        <span class="icon">&#8250;</span>
                    </div>
                    <div class="filter-options">
                        @foreach($work_environment_data as $work_environment)
                        <label class="sub-heading work-environment-{{ $work_environment->prefer_id }}" 
                            data-name="Work Environment" 
                            data-filter="work_environment" 
                            data-value="{{ $work_environment->prefer_id }}">
                            <input type="checkbox" value="{{ $work_environment->env_name }}"> {{ $work_environment->env_name }}
                        </label>
                        @endforeach

                        
                    </div>
                    <div class="subpagedata-work_environment">
                        <!-- <div class="subpage-header">
                        <span class="back-btn">&#8249;</span><h4>Permanent</h4>
                        </div>
                        <div class="subpage-content">
                        <p style="font-size:14px;color:#555;">Detailed options for <b>Permanent</b> roles can appear here.</p>
                        <label><input type="checkbox"> Full Time</label>
                        <label><input type="checkbox"> Part Time</label>
                        </div> -->
                    </div>
                </div>
                <div class="filter-section">
                    <div class="filter-title">
                        <span>Position</span>
                        <span class="icon">&#8250;</span>
                    </div>
                    <div class="filter-options">
                        @foreach($employee_positions as $emp_pos)
                        <label class="sub-heading work-environment-{{ $emp_pos->position_id }}" 
                            data-name="Employee Positions" 
                            data-filter="employee_positions" 
                            data-value="{{ $emp_pos->position_id }}">
                            <input type="checkbox" value="{{ $emp_pos->position_name }}"> {{ $emp_pos->position_name }}
                        </label>
                        @endforeach

                        
                    </div>
                    <div class="subpagedata-employee_positions">
                        <!-- <div class="subpage-header">
                        <span class="back-btn">&#8249;</span><h4>Permanent</h4>
                        </div>
                        <div class="subpage-content">
                        <p style="font-size:14px;color:#555;">Detailed options for <b>Permanent</b> roles can appear here.</p>
                        <label><input type="checkbox"> Full Time</label>
                        <label><input type="checkbox"> Part Time</label>
                        </div> -->
                    </div>
                    
                </div>
                <div class="filter-section">
                    <div class="filter-title">
                        <span>Benefits</span>
                        <span class="icon">&#8250;</span>
                    </div>
                    <div class="filter-options">
                        @foreach($benefits_preferences as $benprefer)
                        <label class="sub-heading benefits_preferences-{{ $benprefer->benefits_id }}" 
                            data-name="Benefit Preferences" 
                            data-filter="benefits_preferences" 
                            data-value="{{ $benprefer->benefits_id }}">
                            <input type="checkbox" value="{{ $benprefer->benefits_name }}"> {{ $benprefer->benefits_name }}
                        </label>
                        @endforeach

                        
                    </div>
                    <div class="subpagedata-benefits_preferences">
                        
                    </div>
                </div>
                <div class="filter-section">
                    <div class="filter-title">
                        <span>Location Preferences</span>
                        <span class="icon">&#8250;</span>
                    </div>
                    <div class="filter-options">
                        <label><input type="radio" class="edit_location_radio" name="edit_location" value="Current Location (Auto-detect optional)"> Current Location (Auto-detect optional) </label>
                        <label><input type="radio" class="edit_location_radio" name="edit_location" value="Multiple Locations"> Multiple Locations </label>
                        <label><input type="radio" class="edit_location_radio" name="edit_location" value="International"> International</label>
                    </div>
                    <div class="subpagedata">
                        <div class="subpage subpage-current">
                            <div class="subpage-header">
                                <span class="back-btn">&#8249;</span>
                                <h4>Current Location</h4>
                            </div>
                            <div class="subpage-content">
                                <div id="preferredLocationInput" class="mb-3">
                                    <label class="form-label fw-bold">Preferred Location</label>
                                    <input type="text" id="locationSearch" class="form-control" value="{{ $work_preferences_data->prefered_location_current }}" placeholder="Search city / postcode / hospital">
                                    <div id="locationTags" class="mt-2"></div>
                                </div>

                                <!-- Travel Distance Slider -->
                                <div id="travelDistanceContainer" class="mb-3">
                                    <label class="form-label fw-bold">Maximum Travel Distance</label>
                                    <input type="range" id="travelDistance" min="5" max="100" step="5" value="20" class="form-range">
                                    <span id="distanceValue" class="fw-semibold">20 km</span>
                                </div>
                            </div>
                        </div>
                        <div class="subpage subpage-multiple">
                            <div class="subpage-header">
                                <span class="back-btn">&#8249;</span>
                                <h4>Multiple Location</h4>
                            </div>
                            <div class="subpage-content">
                                <div id="preferredLocationInput" class="mb-3">
                                    <label class="form-label fw-bold">Preferred Location</label>
                                    <input type="text" id="locationSearch" class="form-control" value="{{ $work_preferences_data->prefered_location_current }}" placeholder="Search city / postcode / hospital">
                                    <div id="locationTags" class="mt-2"></div>
                                </div>

                            </div>
                        </div>
                        <div class="subpage subpage-international">
                            <div class="subpage-header">
                                <span class="back-btn">&#8249;</span>
                                <h4>International Location</h4>
                            </div>
                            <div class="subpage-content">
                                <div class="row">
                                    <div class="col-6 col-md-4">
                                    <div class="form-check"><input type="checkbox" class="form-check-input"> Canada</div>
                                    <div class="form-check"><input type="checkbox" class="form-check-input"> Hong Kong</div>
                                    <div class="form-check"><input type="checkbox" class="form-check-input"> Ireland</div>
                                    <div class="form-check"><input type="checkbox" class="form-check-input"> Jamaica</div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                    <div class="form-check"><input type="checkbox" class="form-check-input"> New Zealand</div>
                                    <div class="form-check"><input type="checkbox" class="form-check-input"> Singapore</div>
                                    <div class="form-check"><input type="checkbox" class="form-check-input"> South Africa</div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                    <div class="form-check"><input type="checkbox" class="form-check-input"> United Kingdom</div>
                                    <div class="form-check"><input type="checkbox" class="form-check-input"> United States</div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="filter-section">
                    <div class="filter-title">
                        <span>Type of nurse</span>
                        <span class="icon">&#8250;</span>
                    </div>
                    <div class="filter-options">
                        @foreach($type_of_nurse as $nurse_type)
                        <label class="sub-heading nurse-type-{{ $nurse_type->id }}" data-name="Nurse Type" data-filter="nurse_type" data-value="{{ $nurse_type->id }}"><input type="checkbox" value="{{ $nurse_type->name }}"> {{ $nurse_type->name }}</label>
                        
                        @endforeach
                        
                    </div>
                    <div class="subpagedata-nurse_type">
                        <!-- <div class="subpage-header">
                        <span class="back-btn">&#8249;</span><h4>Permanent</h4>
                        </div>
                        <div class="subpage-content">
                        <p style="font-size:14px;color:#555;">Detailed options for <b>Permanent</b> roles can appear here.</p>
                        <label><input type="checkbox"> Full Time</label>
                        <label><input type="checkbox"> Part Time</label>
                        </div> -->
                    </div>
                    
                </div>
                <div class="filter-section">
                    <div class="filter-title">
                        <span>Specialty</span>
                        <span class="icon">&#8250;</span>
                    </div>
                    <div class="filter-options">
                        @foreach($speciality as $spec)
                        <label class="sub-heading nurse-type-{{ $spec->id }}" data-name="Speciality" data-filter="speciality" data-value="{{ $spec->id }}"><input type="checkbox" value="{{ $spec->name }}"> {{ $spec->name }}</label>
                        
                        @endforeach
                        
                    </div>
                    <div class="subpagedata-speciality">
                        <!-- <div class="subpage-header">
                        <span class="back-btn">&#8249;</span><h4>Permanent</h4>
                        </div>
                        <div class="subpage-content">
                        <p style="font-size:14px;color:#555;">Detailed options for <b>Permanent</b> roles can appear here.</p>
                        <label><input type="checkbox"> Full Time</label>
                        <label><input type="checkbox"> Part Time</label>
                        </div> -->
                    </div>
                </div>
                <div class="filter-section">
                    <div class="filter-title">
                        <span>Years of Experience</span>
                        <span class="icon">&#8250;</span>
                    </div>
                    <div class="filter-options">
                        <div class="form-group level-drp">
                            <label>Experience(In Year)</label>
                            <input type="number" id="year_experience" class="form-control" name="year_experience">
                        </div>
                        
                    </div>
                </div>
                <div class="filter-section">
                    <div class="filter-title">
                        <span>Salary Range</span>
                        <span class="icon">&#8250;</span>
                    </div>
                    <div class="filter-options">
                        <div class="salary-range-wrapper">
                            <label class="filter-label">Salary Range</label>
                            <div class="range-container">
                                <div class="slider-track"></div>
                                <input type="range" id="minSalary1" min="0" max="200000" step="1000" value="30000">
                                <input type="range" id="maxSalary1" min="0" max="200000" step="1000" value="120000">
                            </div>
                            <div class="salary-values">
                                <span id="minSalaryValue1">₹30,000</span> - 
                                <span id="maxSalaryValue1">₹1,20,000</span>
                            </div>
                        </div>


                        
                    </div>
                </div>
                
                <!-- <div class="form-group level-drp">
                    <label for="filter-location">Location</label>
                    <input type="text" name="edit_filter_location" id="filter-location" class="form-control">
                </div>
                <div class="form-group level-drp">
                    <label for="filter-shift">Shift</label>
                    <select id="filter-shift" name="edit_filter_shift" class="form-control">
                        <option>Day</option>
                        <option>Evening</option>
                        <option>Night</option>
                    </select>
                </div>
                <div class="form-group level-drp">
                    <label for="filter-preview">Preview Count</label>
                    <input type="number" name="edit_filter_preview" id="filter-preview" class="form-control" min="0">
                </div> -->
            </div>
            <div class="tab-content-edit" id="tab4">
                <div class="form-group level-drp">
                    <label for="alert-frequency">Frequency</label>
                    <select id="edit-alert-frequency" class="form-control" name="alert_frequency">
                        <option value="Off">Off</option>
                        <option value="Realtime">Realtime</option>
                        <option value="Daily">Daily</option>
                        <option value="Weekly">Weekly</option>
                    </select>
                </div>
                <div class="form-group level-drp">
                    <label>Delivery</label>
                    <select id="edit-alert-delivery" class="form-control" name="delivery_method">
                        <option>Email</option>
                        <option>In-app</option>
                        <option>SMS</option>
                    </select>
                </div>    
                <div class="form-group level-drp">
                    <label>Daily Cap</label>
                    <input type="number" id="alert-cap" class="form-control" name="edit_alert_cap" min="0">
                </div>
                <div class="form-group level-drp">
                    <label>Quiet Hours</label>
                    <input type="time" id="quiet-start" class="form-control" name="edit_quiet_start"> - <input type="time" id="quiet-end" class="form-control" name="edit_quiet_end">
                </div>
            </div>
            <div class="tab-content-edit" id="tab5">
                <div class="form-group level-drp">
                    <label>Name</label>
                    <input type="text" id="edit-search-name" class="form-control" name="search_name">
                </div>
                <div class="form-group level-drp">
                    <label>Notes</label>
                    <input type="text" id="search-notes" class="form-control" name="edit_search_notes">
                </div>
            </div>
            <div class="buttons">
                <button type="button" class="btn-cancel" id="drawer-cancel">Cancel</button>
                <button type="submit" class="btn-save" id="drawer-save">Save Changes</button>
            </div>
        </form>
    </div>
</div>
<script>
   $(document).ready(function () {

    // Toggle filter sections
    $('.filter-title').click(function () {
        $(this).toggleClass('active');
        $(this).next('.filter-options').slideToggle(200);
    });

    const subpageStack = []; // Track navigation history

    // Handle first-level filter click
    $(document).on("click", ".sub-heading[data-value]", function (e) {
        const $this = $(this);
        const id = $this.data("value");
        const filterType = $this.data("filter");
        const filterName = $this.data("name");

        // Only trigger if checkbox is checked
        if (!$this.find('input[type="checkbox"]').prop('checked')) return;

        //const uniqueKey = `${filterType}-${id}`;
        fetchAndBuildSubPage(filterName, filterType, id);
    });


    function fetchAndBuildSubPage(filterName, filterType, id) {
        const uniqueKey = `${filterType}-${id}`; // 👈 unique per filterType + id

        $.ajax({
            type: "GET",
            url: "{{ url('/nurse/getEmpDataSearch') }}",
            data: {
                filter_name: filterName,
                sub_prefer_id: id,
                filter_type: filterType
            },
            cache: false,
            success: function (data) {
                if (!data.main || !data.subtypes || data.subtypes.length === 0) {
                    showToast("No data found for this filter.");
                    return;
                }
                buildSubPage(data, filterType, uniqueKey);
            },
            error: function (xhr) {
                console.error("Error:", xhr.responseText);
            }
        });
    }

    function buildSubPage(filterData, filterType, uniqueKey) {
        const mainId = filterData.main.id;
        const mainName = filterData.main.name;

        // Hide current active page (if any)
        const $activePage = $(".subpage.active");
        if ($activePage.length) {
            subpageStack.push($activePage);
            $activePage.removeClass("active");
        }

        // Avoid duplicates
        if ($(".subpage-" + uniqueKey).length) {
            $(".subpage-" + uniqueKey).addClass("active");
            return;
        }

        // Build sub-options
        let subOptions = '';
        filterData.subtypes.forEach(function (sub) {
            subOptions += `
                <label class="sub-heading sub-heading-${filterType}-${sub.id}" 
                    data-name="${sub.name}" 
                    data-filter="${filterType}" 
                    data-value="${sub.id}">
                    <input type="checkbox" value="${sub.name}" name="${filterType}[]"> ${sub.name}
                </label>`;
        });

        // Create new subpage (with uniqueKey)
        const subpageHTML = `
            <div class="subpage subpage-${uniqueKey}">
                <div class="subpage-header">
                    <span class="back-btn">&#8249;</span>
                    <h4>${mainName}</h4>
                </div>
                <div class="subpage-content">
                    ${subOptions}
                </div>
            </div>`;

        // Append to its specific drawer
        $(".subpagedata-" + filterType).append(subpageHTML);

        const $newPage = $(".subpage-" + uniqueKey);
        $newPage.addClass("active");

        // Back button handler
        $newPage.find(".back-btn").on("click", function () {
            $newPage.removeClass("active");

            if (subpageStack.length > 0) {
                const $prevPage = subpageStack.pop();
                $prevPage.addClass("active");
            }
        });

        // Nested checkbox subtypes
        $newPage.find(".sub-heading input[type='checkbox']").off('change').on('change', function () {
            const $label = $(this).closest('.sub-heading');
            const subId = $label.data("value");
            const subName = $label.data("name");
            const subFilterType = $label.data("filter");

            if (this.checked) {
                fetchAndBuildSubPage(subName, subFilterType, subId);
            }
        });
    }


        const $min = $('#minSalary1');
        const $max = $('#maxSalary1');
        const $minVal = $('#minSalaryValue1');
        const $maxVal = $('#maxSalaryValue1');
        const $track = $('.slider-track');

        const minLimit = parseInt($min.attr('min'));
        const maxLimit = parseInt($max.attr('max'));

        function formatCurrency(value) {
        return '₹' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        function updateValues() {
            let min = parseInt($min.val());
            let max = parseInt($max.val());
            
            if (min > max - 1000) {
                min = max - 1000;
                $min.val(min);
            }

            const percent1 = ((min - minLimit) / (maxLimit - minLimit)) * 100;
            const percent2 = ((max - minLimit) / (maxLimit - minLimit)) * 100;

            $track.css({
                background: `linear-gradient(to right, #ccc ${percent1}%, #e63946 ${percent1}%, #e63946 ${percent2}%, #ccc ${percent2}%)`
            });

            $minVal.text(formatCurrency(min));
            $maxVal.text(formatCurrency(max));
        }

        $('input[type="range"]').on('input change', updateValues);
        updateValues();

        $('.edit_location_radio').on('change', function () {
            const selected = $(this).val();
            // Show drawer based on selected radio
            if (selected === 'Current Location (Auto-detect optional)') {
                $('.subpage-current').addClass("active");
            } else if (selected === 'Multiple Locations') {
                $('.subpage-multiple').addClass("active");
            } else if (selected === 'International') {
                $('.subpage-international').addClass("active");
            }
            
        });
        $(".subpage .back-btn").on("click", function () {
            $(this).closest(".subpage").removeClass("active").remove();
        });

    });

    function add_saved_searches() {
        var isValid = true;

        if ($('[name="search_name"]').val() == '') {

            document.getElementById("reqsearch-name").innerHTML = "* Please enter the Search Name";
            isValid = false;

        }

        if ($('[name="alert_frequency"]').val() == '') {

            document.getElementById("reqalert-frequency").innerHTML = "* Please select the Alert Frequency";
            isValid = false;

        }

        if ($('[name="delivery_method"]').val() == '') {

            document.getElementById("reqdelivery-method").innerHTML = "* Please select the Delivery Method";
            isValid = false;

        }

        if (isValid == true) {
            const name = $('#search-name').val().trim() || 'New Search';
            const alert_frequency = $('#alert-frequency').val();
            const delivery = $('#delivery-method').val();
            const newId = Date.now();
            addSearchToUI(newId, name, alert_frequency, delivery);
            $.ajax({
            url: "{{ route('nurse.addSavedSearches') }}",
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData($('#add_saved_searches')[0]),
            dataType: 'json',
            beforeSend: function() {
            $('#submitSavedSearches').prop('disabled', true);
            $('#submitSavedSearches').text('Process....');
            },
            success: function(res) {
            if (res.status == '1') {
                $('#savedSearchTable tr').each(function() {
                    if ($(this).is('[data-value]') == false) {
                        $(this).attr('data-value', res.id);
                    }
                });
                $('#submitSavedSearches').text('Save');
                $('#save-search-modal').hide();
                showToast('Save Search Added Successfully');
                
            } else {
                showToast(res.message);
                
            }
            },
            error: function(errorss) {
            $('#submitSavedSearches').prop('disabled', false);
            $('#submitSavedSearches').text('Save Changes');
            console.log("errorss", errorss);
            for (var err in errorss.responseJSON.errors) {
                $("#submitSavedSearches").find("[name='" + err + "']").after("<div class='text-danger'>" + errorss.responseJSON.errors[err] + "</div>");
            }
            }
        
            });
        }
        return false;
    }

    function update_saved_searches() {
        var isValid = true;

        // if ($('[name="search_name"]').val() == '') {

        //     document.getElementById("reqsearch-name").innerHTML = "* Please enter the Search Name";
        //     isValid = false;

        // }

        // if ($('[name="alert_frequency"]').val() == '') {

        //     document.getElementById("reqalert-frequency").innerHTML = "* Please select the Alert Frequency";
        //     isValid = false;

        // }

        // if ($('[name="delivery_method"]').val() == '') {

        //     document.getElementById("reqdelivery-method").innerHTML = "* Please select the Delivery Method";
        //     isValid = false;

        // }

        let filterData = {};

        // 1️⃣ SECTOR (radio)
        const selectedSector = $('input[name="edit_sector"]:checked').val();
        if (selectedSector) filterData['sector'] = selectedSector;

        // 2️⃣ EMPLOYMENT TYPE (checkboxes)
        const empTypes = [];
        $('[data-filter="employment_type"] input[type="checkbox"]:checked, .emp-type input[type="checkbox"]').each(function () {
            if ($(this).is(':checked')) empTypes.push($(this).val());
        });
        if (empTypes.length) filterData['employment_type'] = empTypes;

        // 3️⃣ WORK SHIFT
        const workShifts = [];
        $('[data-filter="work_shift"] input[type="checkbox"]:checked').each(function () {
            workShifts.push($(this).val());
        });
        if (workShifts.length) filterData['work_shift'] = workShifts;

        // 4️⃣ WORK ENVIRONMENT
        const workEnvs = [];
        $('[data-filter="work_environment"] input[type="checkbox"]:checked').each(function () {
            workEnvs.push($(this).val());
        });
        if (workEnvs.length) filterData['work_environment'] = workEnvs;

        // 5️⃣ POSITION
        const positions = [];
        $('[data-filter="employee_positions"] input[type="checkbox"]:checked').each(function () {
            positions.push($(this).val());
        });
        if (positions.length) filterData['employee_positions'] = positions;

        // 6️⃣ BENEFITS
        const benefits = [];
        $('[data-filter="benefits_preferences"] input[type="checkbox"]:checked').each(function () {
            benefits.push($(this).val());
        });
        if (benefits.length) filterData['benefits_preferences'] = benefits;

        // 7️⃣ LOCATION PREFERENCE (radio)
        const locationType = $('input[name="edit_location"]:checked').val();
        if (locationType) {
            filterData['location_type'] = locationType;

            // Handle sub-drawers for each location type
            if (locationType.includes('Current Location')) {
                filterData['preferred_location'] = $('#locationSearch').val() || '';
                filterData['max_travel_distance'] = $('#travelDistance').val() + ' km';
            }
            else if (locationType.includes('Multiple')) {
                filterData['preferred_locations'] = $('#locationSearch').val() || '';
            }
            else if (locationType.includes('International')) {
                const countries = [];
                $('.subpage-international input[type="checkbox"]:checked').each(function () {
                    countries.push($(this).parent().text().trim());
                });
                filterData['international_countries'] = countries;
            }
        }

        // 8️⃣ TYPE OF NURSE
        const nurseTypes = [];
        $('[data-filter="nurse_type"] input[type="checkbox"]:checked').each(function () {
            nurseTypes.push($(this).val());
        });
        if (nurseTypes.length) filterData['nurse_type'] = nurseTypes;

        // 9️⃣ SPECIALTY
        const specialties = [];
        $('[data-filter="speciality"] input[type="checkbox"]:checked').each(function () {
            specialties.push($(this).val());
        });
        if (specialties.length) filterData['speciality'] = specialties;

        // 🔟 YEARS OF EXPERIENCE
        const experience = $('#year_experience').val();
        if (experience) filterData['years_of_experience'] = experience;

        // 1️⃣1️⃣ SALARY RANGE
        const minSalary = $('#minSalary1').val();
        const maxSalary = $('#maxSalary1').val();
        filterData['salary_range'] = {
            min: parseInt(minSalary),
            max: parseInt(maxSalary)
        };

        // ✅ OUTPUT JSON
        console.log("FILTER JSON:", filterData);
        console.log("JSON STRING:", JSON.stringify(filterData, null, 2));

        let formData = new FormData($('#update_saved_searches')[0]);

        // Make sure you add the filters JSON
        formData.append('filters', JSON.stringify(filterData));

        // Log all data before sending (to verify)
        for (let pair of formData.entries()) {
        console.log(pair[0] + ':', pair[1]);
        }

        if (isValid) {
            $.ajax({
                url: "{{ route('nurse.addSavedSearches') }}",
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                dataType: 'json',
                beforeSend: function() {
                $('#drawer-save').prop('disabled', true).text('Processing...');
                },
                success: function(res) {
                if (res.status == '1') {
                    showToast("Search Updated Successfully");
                } else {
                    showToast(res.message);
                }
                $(".drawer-overlay, .edit_side_drawer").hide();
                },
                error: function(errorss) {
                $('#drawer-save').prop('disabled', false).text('Save Changes');
                console.log("errorss", errorss);
                }
            });
        }


        return false;
    }

    function showToast(msg, error = false) {
        const t = $('#toast');
        t.stop(true, true) // stop any ongoing animations
        .text(msg)
        .removeClass('error')
        .toggleClass('error', error)
        .css('opacity', '1')
        .fadeIn(200); // quick appear
        setTimeout(() => t.fadeOut(400), 2000);
    }
</script>