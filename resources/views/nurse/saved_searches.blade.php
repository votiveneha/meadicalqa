
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
                    <div class="subpagedata">
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
                    <div class="subpagedata">
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
                    <div class="subpagedata">
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
                    <div class="subpagedata">
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
                        <span>Location Preferences</span>
                        <span class="icon">&#8250;</span>
                    </div>
                    
                </div>
                <div class="filter-section">
                    <div class="filter-title">
                        <span>Type of nurse</span>
                        <span class="icon">&#8250;</span>
                    </div>
                    
                </div>
                <div class="filter-section">
                    <div class="filter-title">
                        <span>Specialty</span>
                        <span class="icon">&#8250;</span>
                    </div>
                    
                </div>
                <div class="filter-section">
                    <div class="filter-title">
                        <span>Years of Experience</span>
                        <span class="icon">&#8250;</span>
                    </div>
                    
                </div>
                <div class="filter-section">
                    <div class="filter-title">
                        <span>Salary Range</span>
                        <span class="icon">&#8250;</span>
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

    // Handle click on first-level filters
    $(document).on("click", ".sub-heading[data-value]", function (e) {
        const $this = $(this);
        const id = $this.data("value");
        const filterType = $this.data("filter"); // 'employment_type' or 'work_shift'
        const filterName = $this.data("name");

        // Only proceed when checkbox is checked
        if (!$this.find('input[type="checkbox"]').prop('checked')) return;

        fetchAndBuildSubPage(filterName, filterType, id);
    });

    /**
     * Fetch data from Laravel and build subpage
     */
    function fetchAndBuildSubPage(filterName, filterType, id) {
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
                if (!data.main) {
                    showToast("No data found for this filter.");
                    return;
                }

                buildSubPage(data, filterType);
            },
            error: function (xhr) {
                console.error("Error:", xhr.responseText);
            }
        });
    }

    /**
     * Recursively build subpages based on returned data
     */
    function buildSubPage(filterData, filterType) {
        const mainId = filterData.main.id;

        // If subpage already exists, just show it
        if ($(".subpage-" + mainId).length) {
            $(".subpage-" + mainId).addClass("active");
            return;
        }

        let subOptions = '';

        if (filterData.subtypes && filterData.subtypes.length > 0) {
            filterData.subtypes.forEach(function (sub) {
                subOptions += `
                    <label class="sub-heading sub-heading-${sub.id}" 
                           data-name="${sub.name}" 
                           data-filter="${filterType}" 
                           data-value="${sub.id}">
                        <input type="checkbox" value="${sub.name}"> ${sub.name}
                    </label>
                `;
            });
            

            // Create new subpage dynamically
            const subpageHTML = `
                <div class="subpage subpage-${mainId}">
                    <div class="subpage-header">
                        <span class="back-btn">&#8249;</span>
                        <h4>${filterData.main.name}</h4>
                    </div>
                    <div class="subpage-content">
                        ${subOptions}
                    </div>
                </div>
            `;

            $(".subpagedata").append(subpageHTML);

        } else {
            subOptions = `<p class="no-options">No sub-options available.</p>`;
        }
        

        // Activate this page
        $(".subpage-" + mainId).addClass("active");

        // Handle back navigation
        $(".subpage-" + mainId + " .back-btn").on("click", function () {
            $(this).closest(".subpage").removeClass("active").remove();
        });

        // Bind event for dynamically generated nested subtypes
        $(".subpage-" + mainId + " .sub-heading input[type='checkbox']").off('change').on('change', function () {
            const parentLabel = $(this).closest('.sub-heading');
            const subId = parentLabel.data("value");
            const subName = parentLabel.data("name");
            const subFilterType = parentLabel.data("filter");

            if (this.checked) {
                fetchAndBuildSubPage(subName, subFilterType, subId);
            }
        });
    }


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

        if (isValid == true) {
            
            $.ajax({
            url: "{{ route('nurse.addSavedSearches') }}",
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData($('#update_saved_searches')[0]),
            dataType: 'json',
            beforeSend: function() {
            $('#drawer-save').prop('disabled', true);
            $('#drawer-save').text('Process....');
            },
            success: function(res) {
                if (res.status == '1') {
                    
                    showToast("Search Updated Successfully");
                } else {
                    showToast(res.message);
                    
                }
                $(".edit_side_drawer").hide();

            },
            error: function(errorss) {
            $('#drawer-save').prop('disabled', false);
            $('#drawer-save').text('Save Changes');
            console.log("errorss", errorss);
            for (var err in errorss.responseJSON.errors) {
                $("#drawer-save").find("[name='" + err + "']").after("<div class='text-danger'>" + errorss.responseJSON.errors[err] + "</div>");
            }
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