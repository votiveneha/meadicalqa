
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
        <div class="tab-content-edit active" id="tab3">
            <div class="form-group level-drp">
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
            </div>
        </div>
        <div class="tab-content-edit" id="tab4">
            <div class="form-group level-drp">
                <label for="alert-frequency">Frequency</label>
                <select id="alert-frequency" class="form-control" name="edit_alert_frequency">
                    <option>Off</option>
                    <option>Realtime</option>
                    <option>Daily</option>
                    <option>Weekly</option>
                </select>
            </div>
            <div class="form-group level-drp">
                <label>Delivery</label>
                <select id="alert-delivery" class="form-control" name="edit_alert_frequency">
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
                <input type="time" id="quiet-start" class="form-control" name="edit_quiet_start"> - <input type="time" id="quiet-end" class="form-control" name="quiet_end">
            </div>
        </div>
        <div class="tab-content-edit" id="tab5">
            <div class="form-group level-drp">
                <label>Name</label>
                <input type="text" id="search-name" class="form-control" name="edit_search_name">
            </div>
            <div class="form-group level-drp">
                <label>Notes</label>
                <input type="text" id="search-notes" class="form-control" name="edit_search_notes">
            </div>
        </div>
        <div class="buttons">
            <button class="btn-cancel" id="drawer-cancel">Cancel</button>
            <button class="btn-save" id="drawer-save">Save Changes</button>
        </div>
    </div>
</div>
<script>
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
                Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Save Search Added Successfully',
                }).then(function() {
                 $('#submitSavedSearches').text('Save');  
                 $('#save-search-modal').fadeOut(200); 
                //window.location.href = "{{ route('nurse.language_skills') }}?page=language_skills";
                });
            } else {
                Swal.fire({
                icon: 'error',
                title: 'Error',
                text: res.message,
                })
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
</script>