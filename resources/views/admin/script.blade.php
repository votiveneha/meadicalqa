    
    <script>
        $(document).ready(function() {

            // Add an additional search box to the dropdown
            $('.js-example-basic-multiple').on('select2:open', function() {
                var searchBoxHtml = `
                    <div class="extra-search-container">
                        <input type="text" class="extra-search-box" placeholder="Search...">
                        <button class="clear-button" type="button">&times;</button>
                    </div>`;
                
                if ($('.select2-results').find('.extra-search-container').length === 0) {
                    $('.select2-results').prepend(searchBoxHtml);
                }

                var $searchBox = $('.extra-search-box');
                var $clearButton = $('.clear-button');

                $searchBox.on('input', function() {

                    var searchTerm = $(this).val().toLowerCase();
                    $('.select2-results__option').each(function() {
                        var text = $(this).text().toLowerCase();
                        if (text.includes(searchTerm)) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });

                    $clearButton.toggle($searchBox.val().length > 0);
                });

                $clearButton.on('click', function() {
                    $searchBox.val('');
                    $searchBox.trigger('input');
                });
            });
        });
    </script>
    <script>
    $(document).ready(function() {

        // Add an additional search box and extra buttons to the dropdown
        $('.addAll_removeAll_btn').on('select2:open', function() {
            var $dropdown = $(this);
            var searchBoxHtml = `
                
                <div class="extra-buttons">
                    <button class="select-all-button" type="button">Select All</button>
                    <button class="remove-all-button" type="button">Remove All</button>
                </div>`;

            // Remove any existing extra buttons before adding new ones
            $('.select2-results .extra-search-container').remove();
            $('.select2-results .extra-buttons').remove();

            // Append the new extra buttons and search box
            $('.select2-results').prepend(searchBoxHtml);

            // Handle Select All button for the current dropdown
            $('.select-all-button').on('click', function() {
                var $currentDropdown = $dropdown;
                var allValues = $currentDropdown.find('option').map(function() {
                    return $(this).val();
                }).get();
                $currentDropdown.val(allValues).trigger('change');
            });

            // Handle Remove All button for the current dropdown
            $('.remove-all-button').on('click', function() {
                var $currentDropdown = $dropdown;
                $currentDropdown.val(null).trigger('change');
            });
        });

    });
    </script>
    <script>

    $(document).ready(function() {
    // Initialize Select2 for each select element with class .js-example-basic-multiple
    $('.js-example-basic-multiple').each(function() {
        let listId = $(this).data('list-id');

        let items = [];
        console.log("listId",listId);
        $('#' + listId + ' li').each(function() {
            console.log("value",$(this).data('value'));
            items.push({ id: $(this).data('value'), text: $(this).text() });
        });
        console.log("items",items);
        $(this).select2({
            data: items
        });
    });
    var nurse_array = [];
    // Show corresponding job lists when an option is selected in the first select
    $('.js-example-basic-multiple[data-list-id="type-of-nurse"]').on('change', function() {
        let selectedValues = $(this).val();
        //alert("hello");
        var nurse_len = $("#type-of-nurse li").length;
        console.log("nurse_len",nurse_len);
         
        //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

        console.log("selectedValues",selectedValues);
        //$('.result--show .form-group').addClass('d-none');

        for(var i = 1;i<=nurse_len;i++){
            var nurse_result_val = $(".nursing_result-"+i).val();
            //alert(nurse_result_val);
            if(selectedValues.includes(nurse_result_val)){

                $('#nursing_level-'+i).removeClass('d-none');
            }else{
                $('#nursing_level-'+i).addClass('d-none');
            }
        }
    
        // }
    });

    $('.js-example-basic-multiple[data-list-id="nursing_entry-3"]').on('change', function() {
        let selectedValues = $(this).val();
        //alert("hello");
        var nurse_len = $("#type-of-nurse li").length;
        console.log("nurse_len",nurse_len);

        //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));
        if(selectedValues.includes("179")){
            $('.np_submenu').removeClass('d-none');
            console.log("selectedValues",selectedValues);
        }else{
            $('.np_submenu').addClass('d-none');
            $('.js-example-basic-multiple[data-list-id="nurse_practitioner_menu"]').select2().val(null).trigger('change');
        }
        
        
        
    });

     $('.js-example-basic-multiple[data-list-id="specialties"]').on('change', function() {
        let selectedValues = $(this).val();
        //alert("hello");
        var speciality_len = $("#specialties li").length;
        console.log("speciality_len",speciality_len);

        //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

        console.log("selectedValues",selectedValues);
        //$('.result--show .form-group').addClass('d-none');

        for(var k = 1;k<=speciality_len;k++){
            var speciality_result_val = $(".speciality_result-"+k).val();
            //alert(speciality_result_val);
            if(selectedValues.includes(speciality_result_val)){

                $('#specility_level-'+k).removeClass('d-none');
                //$(".sub_speciality_value").val(k);
                
            }else{
                $('#specility_level-'+k).addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="speciality_entry-'+k+'"]').select2().val(null).trigger('change');
            }
        }

        if(selectedValues.includes("1") == false){
          $('.surgical_row').addClass('d-none');
          $('.surgical_row_data').addClass('d-none');
          $('.js-example-basic-multiple[data-list-id="surgical_row_box"]').select2().val(null).trigger('change');
        }
        if(selectedValues.includes("2") == false){
          
          $('.surgicalobs_row').addClass('d-none');
          $('.js-example-basic-multiple[data-list-id="surgicalobs_row_data"]').select2().val(null).trigger('change');
        }

        if(selectedValues.includes("3") == false){
          
          $('.surgicalpad_row_data').addClass('d-none');
          $('.surgical_rowp_data').addClass('d-none');
          $('.neonatal_row').addClass('d-none');
          $('.js-example-basic-multiple[data-list-id="surgicalobs_row_data"]').select2().val(null).trigger('change');
        }
        
        
    });

    var sub_specialty_data_val =  $(".sub_speciality_value").val();
    console.log("specialty_data_len",sub_specialty_data_val);

    $('.js-example-basic-multiple[data-list-id="speciality_entry-1"]').on('change', function() {
        let selectedValues = $(this).val();
       
        var speciality_entry = $("#speciality_entry-1 li").length;
        console.log("speciality_entry",speciality_entry);
        // $(".surgical_row").wrapAll("<div class='col-md-12 row surgical_row_data'>");
        $(".surgical_row_data").insertAfter("#specility_level-1");
        //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

        console.log("selectedValues",selectedValues.includes("96"));
        //$('.result--show .form-group').addClass('d-none');

        if(selectedValues.includes("96")){
            $('.surgical_row_data').removeClass('d-none');
        }else{
            $('.surgical_row_data').addClass('d-none');
            $('.js-example-basic-multiple[data-list-id="surgical_row_box"]').select2().val(null).trigger('change');
        }

        if(selectedValues.includes("96") == false){
          $('.surgical_row').addClass('d-none');
          $('.js-example-basic-multiple[data-list-id="surgical_row_box"]').select2().val(null).trigger('change');
        }

        

        // for(var k = 1;k<=speciality_entry;k++){
        //     var speciality_result_val = $(".speciality_result-"+k).val();
        //     //alert(speciality_result_val);
        //     if(selectedValues.includes(speciality_result_val)){

        //         $('#specility_level-'+k).removeClass('d-none');
                
        //     }else{
        //         $('#specility_level-'+k).addClass('d-none');
        //     }
        // }
    });
    $('.js-example-basic-multiple[data-list-id="surgical_row_box"]').on('change', function() {
        let selectedValues = $(this).val();
        //alert("hello");
        var speciality_entry = $("#surgical_row_box li").length;
        console.log("speciality_entry",speciality_entry);
        // $(".surgical_row").wrapAll("<div class='col-md-12 row surgical_row_data'>");
        $(".specialty_sub_boxes").insertAfter(".surgical_row_data");
        //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

        console.log("selectedValues",selectedValues);
        //$('.result--show .form-group').addClass('d-none');

        // if(selectedValues.includes("97")){
        //     $('.surgical_row').removeClass('d-none');
        // }else{
        //     $('.surgical_row').addClass('d-none');
        // }

        

        for(var k = 1;k<=speciality_entry;k++){
            var speciality_result_val = $(".speciality_surgical_result-"+k).val();
            
            if(selectedValues.includes(speciality_result_val)){
                
                $('.surgical_row-'+k).removeClass('d-none');
                
            }else{
                $('.surgical_row-'+k).addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="surgical_operative_care-'+k+'"]').select2().val(null).trigger('change');
            }
        }
    });

    $('.js-example-basic-multiple[data-list-id="speciality_entry-3"]').on('change', function() {
        let selectedValues = $(this).val();
        //alert("hello");
        var speciality_entry = $("#speciality_entry-3 li").length;
        console.log("speciality_entry",speciality_entry);
        $(".surgical_rowp").wrapAll("<div class='col-md-12 row surgical_rowp_data'>");
        $(".paediatric_surgical_div").insertAfter("#specility_level-3");

        
        //     $(".neonatal_row").wrapAll("<div class='col-md-12 row neonatal_row_data'>");
        $(".neonatal_row").insertAfter("#specility_level-3");

        //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

        console.log("selectedValues",selectedValues);
        //$('.result--show .form-group').addClass('d-none');

        if(selectedValues.includes('250')){
            $('.neonatal_row').removeClass('d-none');
        }else{
            $('.neonatal_row').addClass('d-none');
            $('.js-example-basic-multiple[data-list-id="neonatal_care"]').select2().val(null).trigger('change');
        }

        if(selectedValues.includes('285')){
            $('.surgicalpad_row_data').removeClass('d-none');
        }else{
            $('.surgicalpad_row_data').addClass('d-none');
            $('.js-example-basic-multiple[data-list-id="surgical_rowpad_box"]').select2().val(null).trigger('change');
        }

        if(selectedValues.includes("285") == false){
          $('.surgical_rowp_data').addClass('d-none');
          $('.js-example-basic-multiple[data-list-id="surgical_row_box"]').select2().val(null).trigger('change');
        }

        // for(var k = 1;k<=speciality_entry;k++){
        //     var speciality_result_val = $(".speciality_result-"+k).val();
        //     //alert(speciality_result_val);
        //     if(selectedValues.includes(speciality_result_val)){

        //         $('#specility_level-'+k).removeClass('d-none');
                
        //     }else{
        //         $('#specility_level-'+k).addClass('d-none');
        //     }
        // }
    });

    $('.js-example-basic-multiple[data-list-id="surgical_rowpad_box"]').on('change', function() {
        let selectedValues = $(this).val();
        //alert("hello");
        var speciality_entry = $("#surgical_rowpad_box li").length;
        console.log("speciality_entry",speciality_entry);
        // $(".surgical_rowp").wrapAll("<div class='col-md-12 row surgical_rowp_data'>");
        $(".surgical_rowp_data").insertAfter(".surgicalpad_row_data");

        
        //     $(".neonatal_row").wrapAll("<div class='col-md-12 row neonatal_row_data'>");
        //     $(".neonatal_row_data").insertAfter("#specility_level-3");

        //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

        console.log("selectedValues",selectedValues);
        //$('.result--show .form-group').addClass('d-none');

        

        for(var k = 1;k<=speciality_entry;k++){
            var speciality_result_val = $(".surgical_rowp_result-"+k).val();
            //alert(speciality_result_val);
            if(selectedValues.includes(speciality_result_val)){

                $('.surgical_rowp-'+k).removeClass('d-none');
                
            }else{
                $('.surgical_rowp-'+k).addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="surgical_operative_carep-'+k+'"]').select2().val(null).trigger('change');
            }
        }
    });

    $('.js-example-basic-multiple[data-list-id="speciality_entry-2"]').on('change', function() {
        let selectedValues = $(this).val();
        //alert("hello");
        var speciality_entry = $("#speciality_entry-1 li").length;
        console.log("speciality_entry",speciality_entry);
        // $(".surgicalobs_row").wrapAll("<div class='col-md-12 row surgicalobs_row_data'>");
        $(".surgicalobs_row").insertAfter("#specility_level-2");

        //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

        console.log("selectedValues",selectedValues);
        //$('.result--show .form-group').addClass('d-none');

        if(selectedValues.includes("233")){
            $('.surgicalobs_row').removeClass('d-none');
        }else{
            $('.surgicalobs_row').addClass('d-none');
            $('.js-example-basic-multiple[data-list-id="surgical_obs_care"]').select2().val(null).trigger('change');
        }

        // for(var k = 1;k<=speciality_entry;k++){
        //     var speciality_result_val = $(".speciality_result-"+k).val();
        //     //alert(speciality_result_val);
        //     if(selectedValues.includes(speciality_result_val)){

        //         $('#specility_level-'+k).removeClass('d-none');
                
        //     }else{
        //         $('#specility_level-'+k).addClass('d-none');
        //     }
        // }
    });

});
</script>



{{-- country,state, city onchange  --}}
<script>
    $('#countryI').on('change', function() {

      var idCountry = this.value;

      $("#stateI").html('');

      $.ajax({

        url: "{{url('fetch-provinces')}}",

        type: "POST",

        data: {

          country_id: idCountry,

          _token: '{{csrf_token()}}'

        },

        dataType: 'json',

        success: function(result) {

          $('#stateI').html('<option value=""> Select  State</option>');

          $.each(result.province, function(key, value) {

            $("#stateI").append('<option value="' + value

              .id + '">' + value.name + '</option>');

          });

          $('#cityI').html('<option value=""> Select City </option>');
               
        }

      });
      

    });



    /*------------------------------------------

    --------------------------------------------

    State Dropdown Change Event 

    --------------------------------------------

    --------------------------------------------*/

    $('#stateI').on('change', function() {

      var idState = this.value;

      $("#cityI").html('');

      $.ajax({

        url: "{{url('fetch-ville')}}",

        type: "POST",

        data: {

          province_id: idState,

          _token: '{{csrf_token()}}'

        },

        dataType: 'json',

        success: function(res) {

          $('#cityI').html('<option value=""> Select City </option>');

          $.each(res.ville, function(key, value) {

            $("#cityI").append('<option value="' + value

              .id + '">' + value.name + '</option>');

          });

        }

      });

    });
</script>
{{-- phone number,emrgencu contact --}}
<script>

$(document).ready(function() {
      $('#contact').keypress(function (e) {    
    
        var charCode = (e.which) ? e.which : event.keyCode    

        if (String.fromCharCode(charCode).match(/[^0-9]/g))    

            return false;                        

      });   

      $('#emrg_contact').keypress(function (e) {    
    
        var charCode = (e.which) ? e.which : event.keyCode    

        if (String.fromCharCode(charCode).match(/[^0-9]/g))    

            return false;                        

      });
    // Function to initialize intl-tel-input and set up event listeners
    function initializeIntlTelInput(inputSelector, countyCodeInputSelector, countryNameInputSelector, countryIsoInputSelector) {
        const input = document.querySelector(inputSelector);
        const countyCodeInput = document.querySelector(countyCodeInputSelector);
        const countryNameInput = document.querySelector(countryNameInputSelector);
        const countryIsoInput = document.querySelector(countryIsoInputSelector);

        const iti = window.intlTelInput(input, {
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
            initialCountry: "AU", // Automatically detect the user's country
            hiddenInput: "full_number",
            // localizedCountries: { 'de': 'Deutschland' },
            // nationalMode: false,
            // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
            // placeholderNumberType: "MOBILE",
            preferredCountries: ['AU'],
            geoIpLookup: function(callback) {
                fetch('https://ipinfo.io/json')
                    .then(response => response.json())
                    .then(data => callback(data.country || 'us')) // Fallback to 'us' if detection fails
                    .catch(() => callback('us')); // Fallback to 'us' if there's an error
            }
        });

        // Function to update hidden fields with selected country data
        function updateCountryData() {
            const countryData = iti.getSelectedCountryData();
            countyCodeInput.value = countryData.dialCode;
            countryNameInput.value = countryData.name;
            countryIsoInput.value = countryData.iso2; // ISO code of the country
        }

        // Ensure country data is set on initialization
        updateCountryData();

        // Event listener for country change
        input.addEventListener("countrychange", function() {
            updateCountryData();
        });

        // Validate input on blur
        input.addEventListener('blur', function() {
            const errorSpan = document.querySelector(`${inputSelector}_error`);
            if (iti.isValidNumber()) {
                errorSpan.textContent = "";
            } else {
                // errorSpan.textContent = "Invalid phone number.";
            }
        });

        return iti;
    }

    // Initialize intl-tel-input for Mobile No
    initializeIntlTelInput(
        "#emrg_contact", 
        "#country_code_mobile", 
        "#country_name_mobile", 
        "#country_iso_mobile"
    );

    // Initialize intl-tel-input for Phone Number
    initializeIntlTelInput(
        "#contact", 
        "#country_code_phone", 
        "#country_name_phone", 
        "#country_iso_phone"
    );
});


</script>
{{-- Image preview --}}
<script>
// $(document).ready(function() {
//     $('#profile_image').change(function(e) {
//         const file = e.target.files[0];
//         if (file) {
//             const reader = new FileReader();
//             reader.onload = function(e) {
//                 $('.image-profile img').attr('src', e.target.result);
//             };
//             reader.readAsDataURL(file);
//         }
//     });
// });
</script>

{{-- for add Nurse script --}}
<script>      
    $(document).ready(function() {
        // Initially deactivate all tabs except the first one
        // $('.nav-pills .nav-link').not('.active').addClass('disabled');

        // // Function to enable the next tab
        // function enableNextTab(targetTab) {
        //     $('a[href="' + targetTab + '"]').removeClass('disabled').tab('show');
        // }

         $('#uploadButton').on('click', function() {
            $('#profile_image').click();
        });

        $('#profile_image').on('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#profileImage').attr('src', e.target.result);
                };
                reader.readAsDataURL(file);
            }
        });

        $('.next-step-1').on('click', function() { 
            // alert($('#stateI').val());     
             var targetTab            = $(this).data('target');     
             var first_name          =  $('#first_name').val();
             var last_name           =  $('#last_name').val();  
             var email               =  $('#email').val();  
            // Get the value of the selected radio button
            var selectedGender = $('input[name="gender"]:checked').val();
             var contact             =  $('#contact').val(); 
             var profile_image = $('#profile_image')[0].files[0]; 
            //  alert(profile_image);
             var profile_image             =  $('#profile_image').val();  
             var dob                 =  $('#dob').val();  
             var per_website         =  $('#per_website').val();  
             var countryI            =  $('#countryI').val(); 
             var stateI              =  $('#stateI').val();  
             var city                =  $('#city').val(); 
             var zip_code            =  $('#zip_code').val();  
             var home_address        =  $('#home_address').val(); 
             var emrg_contact        =  $('#emrg_contact').val();  
             var emrg_email          =  $('#emrg_email').val();
             

             let hasErrors = false;

             // Function to show error message
        // function showError(element, message) {
        //     $('#' + element).text(message);
        //     hasErrors = true;
        // }

        // // Function to clear error message
        // function clearError(element) {
        //     $('#' + element).text("");
        // }

        // // Validate each field
        // if (first_name === "") {
        //     showError('first_name_error', "First name is required.");
        // } else {
        //     clearError('first_name_error');
        // }

        // if (last_name === "") {
        //     showError('last_name_error', "Last name is required.");
        // } else {
        //     clearError('last_name_error');
        // }

        // if (email === "") {
        //     showError('email_error', "Email is required.");
        // } else {
        //     clearError('email_error');
        // }

        // if (!selectedGender) {
        //     showError('genderErr', "Please select a gender.");
        // } else {
        //     clearError('genderErr');
        // }

        // if (contact === "") {
        //     showError('contact_error', "Mobile Number is required.");
        // } else {
        //     clearError('contact_error');
        // }

        // if (dob === "") {
        //     showError('date_error', "Date of Birth is required.");
        // } else {
        //     clearError('date_error');
        // }

        // if (per_website === "") {
        //     showError('per_website_error', "Personal website is required.");
        // } else {
        //     clearError('per_website_error');
        // }

        // if (countryI === "") {
        //     showError('country_error', "Country is required.");
        // } else {
        //     clearError('country_error');
        // }

        // if (stateI === "") {
        //     showError('state_error', "State is required.");
        // } else {
        //     clearError('state_error');
        // }

        // if (city === "") {
        //     showError('city_error', "City is required.");
        // } else {
        //     clearError('city_error');
        // }

        // if (zip_code === "") {
        //     showError('zip_code_error', "Zip Code is required.");
        // } else {
        //     clearError('zip_code_error');
        // }

        // if (home_address === "") {
        //     showError('home_address_error', "Home address is required.");
        // } else {
        //     clearError('home_address_error');
        // }

        // if (emrg_contact === "") {
        //     showError('emrg_contact_error', "Mobile number is required.");
        // } else {
        //     clearError('emrg_contact_error');
        // }

        // if (emrg_email === "") {
        //     showError('emrg_email_error', "Email is required.");
        // } else {
        //     clearError('emrg_email_error');
        // }

        // if (profile_image === "") {
        //     showError('profile_image_error', "Profile Image is required.");
        // } else {
        //     clearError('profile_image_error');
        // }

        // Gather form data
        // var formData = {
        //     first_name: $('#first_name').val(),
        //     last_name: $('#last_name').val(),
        //     email: $('#email').val(),
        //     gender: $('input[name="gender"]:checked').val(),
        //     contact: $('#contact').val(),
        //     country_code_phone: $('#country_code_phone').val(),
        //     country_iso_phone: $('#country_iso_phone').val(),
        //     profile_image: profile_image,
        //     dob: $('#dob').val(),
        //     per_website: $('#per_website').val(),
        //     country: countryI,
        //     state: stateI,
        //     city: $('#city').val(),
        //     zip_code: $('#zip_code').val(),
        //     home_address: $('#home_address').val(),
        //     emrg_contact: $('#emrg_contact').val(),
        //     emrg_email: $('#emrg_email').val(),
        //     country_code_mobile: $('#country_code_mobile').val(),
        //     country_iso_mobile: $('#country_iso_mobile').val(),
        //     // _token: '{{ csrf_token() }}', // Add CSRF token
        //     tab:'tab1'
            
        // };
        // Create a new FormData object
        var formData = new FormData();
        
        // if(targetTab ==  '#navpill-2'){
        // Append form fields to the FormData object
        formData.append('first_name', $('#first_name').val());
        formData.append('last_name', $('#last_name').val());
        formData.append('email', $('#email').val());
        formData.append('gender', $('input[name="gender"]:checked').val());
        formData.append('contact', $('#contact').val());
        formData.append('country_code_phone', $('#country_code_phone').val());
        formData.append('country_iso_phone', $('#country_iso_phone').val());
        
        // Append the file
        var profile_image = $('#profile_image')[0].files[0];
        
        if (profile_image) {
            formData.append('profile_image', profile_image);
        }
        
        formData.append('dob', $('#dob').val());
        formData.append('per_website', $('#per_website').val());
        formData.append('country', countryI);
        formData.append('state', stateI);
        formData.append('city', $('#city').val());
        formData.append('zip_code', $('#zip_code').val());
        formData.append('home_address', $('#home_address').val());
        formData.append('emrg_contact', $('#emrg_contact').val());
        formData.append('emrg_email', $('#emrg_email').val());
        formData.append('country_code_mobile', $('#country_code_mobile').val());
        formData.append('country_iso_mobile', $('#country_iso_mobile').val());
        formData.append('tab', 'tab1');
        formData.append('nationality', $('#nationality').val());
        
        $.ajax({
                url: "{{ route('admin.add_nurse_post_1') }}",
                type: "POST",
                data: formData,
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token for security
                },
                success: function(res) {
                    console.log(res.type);

                     if (res.status == '2') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: res.message,
                        }).then(function() {
                            $('a[href="' + targetTab + '"]').tab('show');
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: res.message,
                        });
                    }
                    // Show the target tab
                },
                error: function(error) {
                // if(targetTab ==  '#navpill-2'){
                  if (error.responseJSON.errors) {
                        if (error.responseJSON.errors.first_name) {
                            $('#first_name_error').text(error.responseJSON.errors.first_name[0]);
                        } else {
                            $('#first_name_error').text('');
                        }

                        if (error.responseJSON.errors.last_name) {
                            $('#last_name_error').text(error.responseJSON.errors.last_name[0]);
                           
                        } else {
                            $('#last_name_error').text('');
                        }

                        if (error.responseJSON.errors.contact) {
                            $('#contact_error').text(error.responseJSON.errors.contact[0]);
                           
                        } else {
                            $('#contact_error').text('');
                        }

                        if (error.responseJSON.errors.email) {
                            $('#email_error').text(error.responseJSON.errors.email[0]);
                           
                        } else {
                            $('#email_error').text('');
                        }

                        if(error.responseJSON.errors.gender) {
                            $('#genderErr').text(error.responseJSON.errors.gender[0]);
                           
                        }else{
                            $('#genderErr').text('');
                        }

                        if(error.responseJSON.errors.dob) {
                            $('#date_error').text(error.responseJSON.errors.dob[0]);
                           
                        }else{
                            $('#date_error').text('');
                        }

                        if(error.responseJSON.errors.per_website) {
                            $('#per_website_error').text(error.responseJSON.errors.per_website[0]);
                           
                        }else{
                            $('#per_website_error').text('');
                        }

                        if(error.responseJSON.errors.country) {
                            $('#country_error').text(error.responseJSON.errors.country[0]);
                           
                        }else{
                            $('#country_error').text('');
                        }

                        if(error.responseJSON.errors.state) {
                            $('#state_error').text(error.responseJSON.errors.state[0]);
                           
                        }else{
                            $('#state_error').text('');
                        }

                        if(error.responseJSON.errors.city) {
                            $('#city_error').text(error.responseJSON.errors.city[0]);
                           
                        }else{
                            $('#city_error').text('');
                        }

                        if(error.responseJSON.errors.zip_code) {
                            $('#zip_code_error').text(error.responseJSON.errors.zip_code[0]);
                           
                        }else{
                            $('#zip_code_error').text('');
                        }

                        if(error.responseJSON.errors.home_address) {
                            $('#home_address_error').text(error.responseJSON.errors.home_address[0]);
                           
                        }else{
                            $('#home_address_error').text('');
                        }

                        if(error.responseJSON.errors.emrg_contact) {
                            $('#emrg_contact_error').text(error.responseJSON.errors.emrg_contact[0]);
                           
                        }else{
                            $('#emrg_contact_error').text('');
                        }

                        if(error.responseJSON.errors.emrg_email) {
                            $('#emrg_email_error').text(error.responseJSON.errors.emrg_email[0]);
                           
                        }else{
                            $('#emrg_email_error').text('');
                        }


                        if(error.responseJSON.errors.home_address) {
                            $('#home_address_error').text(error.responseJSON.errors.zip_code[0]);
                           
                        }else{
                            $('#home_address_error').text('');
                        }

                        if(error.responseJSON.errors.profile_image) {
                            $('#profile_image_error').text(error.responseJSON.errors.profile_image[0]);
                           
                        }else{
                            $('#profile_image_error').text('');
                        }
                    // }
                        
                    }
                }
            });

        // if (!hasErrors) {
        //     $('a[href="' + targetTab + '"]').tab('show'); // Show the target tab
        // }
           
        });


        // second form        
        $('.next-step-2').on('click', function() { 
               var targetTab = $(this).data('target'); 
            // Initially deactivate all tabs except the first one
                // $('.nav-pills .nav-link').not('.active').addClass('disabled');

                // Function to enable the next tab
                function enableNextTab(targetTab) {
                    $('a[href="' + targetTab + '"]').removeClass('disabled').tab('show');
                }
         
            // TYPE OF NURSE
            var selectElement = $('select[data-list-id="type-of-nurse"]');        
            // Get the selected value(s) from the Select2 element
            var type_nurse = selectElement.val();  
            
            var selectElement1 = $('select[data-list-id="nursing_entry-1"]');        
            // Get the selected value(s) from the Select2 element
            var nursing_entry_first = selectElement1.val();  

            var selectElement2 = $('select[data-list-id="nursing_entry-2"]');       
            // Get the selected value(s) from the Select2 element
            var nursing_entry_sec = selectElement2.val(); 
            

            var selectElement3 = $('select[data-list-id="nursing_entry-3"]');        
            // Get the selected value(s) from the Select2 element
            var nursing_entry_thired = selectElement3.val(); 

            var selectElement4 = $('select[data-list-id="nurse_practitioner_menu"]');        
            // Get the selected value(s) from the Select2 element
            var nurse_practitioner_menu = selectElement4.val(); 

            // Specialties 
            var specialtiest_1 = $('select[data-list-id="specialties"]');        
            // Get the selected value(s) from the Select2 element
            var specialties = specialtiest_1.val();
            
            var specialtiest_2 = $('select[data-list-id="speciality_entry-1"]');        
            // Get the selected value(s) from the Select2 element
            var adults = specialtiest_2.val(); 

            var specialtiest_3 = $('select[data-list-id="surgical_row_box"]');        
            // Get the selected value(s) from the Select2 element
            var surgical_data = specialtiest_3.val(); 

            var specialtiest_4 = $('select[data-list-id="surgical_operative_care-1"]');        
            // Get the selected value(s) from the Select2 element
            var surgical_operative_care_1 = specialtiest_4.val(); 

            var specialtiest_5 = $('select[data-list-id="surgical_operative_care-2"]');        
            // Get the selected value(s) from the Select2 element
            var surgical_operative_care_2 = specialtiest_5.val(); 
            
            
            var specialtiest_6 = $('select[data-list-id="surgical_operative_care-3"]');        
            // Get the selected value(s) from the Select2 element
            var surgical_operative_care_3 = specialtiest_6.val(); 

            var specialtiest_7 = $('select[data-list-id="speciality_entry-2"]');        
            // Get the selected value(s) from the Select2 element
            var speciality_entry_2 = specialtiest_7.val();

            var specialtiest_8 = $('select[data-list-id="surgical_obs_care"]');        
            // Get the selected value(s) from the Select2 element
            var surgical_obs_care = specialtiest_8.val();
           
            var specialtiest_9 = $('select[data-list-id="speciality_entry-3"]');        
            // Get the selected value(s) from the Select2 element
            var speciality_entry_3 = specialtiest_9.val();

            var specialtiest_10 = $('select[data-list-id="neonatal_care"]');        
            // Get the selected value(s) from the Select2 element
            var neonatal_care = specialtiest_10.val();

            var specialtiest_11 = $('select[data-list-id="surgical_rowpad_box"]');        
            // Get the selected value(s) from the Select2 element
            var surgical_rowpad_box = specialtiest_11.val();

            var specialtiest_12 = $('select[data-list-id="surgical_operative_carep-1"]');        
            // Get the selected value(s) from the Select2 element
            var surgical_operative_carep_1 = specialtiest_12.val();

            var specialtiest_13 = $('select[data-list-id="surgical_operative_carep-2"]');        
            // Get the selected value(s) from the Select2 element
            var surgical_operative_carep_2 = specialtiest_13.val();

            var specialtiest_14 = $('select[data-list-id="surgical_operative_carep-3"]');        
            // Get the selected value(s) from the Select2 element
            var surgical_operative_carep_3 = specialtiest_14.val();

            var specialtiest_15 = $('select[data-list-id="speciality_entry-4"]');        
            // Get the selected value(s) from the Select2 element
            var speciality_entry_4 = specialtiest_15.val();

            var employee_status = $('#employee_status').val();

            var bio = $('#bio').val();

            var assistent_level = $('#assistent_level').val();

            var declare_information = $('#declare_information').val();


             let hasErrors = false;

         
        // Create a new FormData object
        var formData = new FormData();
        
        // if(targetTab ==  '#navpill-2'){
      
        formData.append('states',type_nurse);
        formData.append('entry_level_nursing',nursing_entry_first);
        formData.append('registered_nurses', nursing_entry_sec);
        formData.append('advanced_practioner', nursing_entry_thired);
        formData.append('nurse_prac', nurse_practitioner_menu);
        formData.append('specialties', specialties);     
        formData.append('adults', adults);
        formData.append('surgical_preoperative', surgical_data);
        formData.append('operating_room', surgical_operative_care_1);
        formData.append('operating_room_scout', surgical_operative_care_2);
        formData.append('operating_room_scrub', surgical_operative_care_3);
        formData.append('maternity', speciality_entry_2);
        formData.append('surgical_obstrics_gynacology', surgical_obs_care);
        formData.append('paediatrics_neonatal', speciality_entry_3);
        formData.append('neonatal_care', neonatal_care);
        formData.append('paedia_surgical_preoperative',surgical_rowpad_box);
        formData.append('pad_op_room', surgical_operative_carep_1);
        formData.append('tab', 'tab2');
        formData.append('pad_qr_scout',surgical_operative_carep_2);
        formData.append('pad_qr_scrub', surgical_operative_carep_3);
        formData.append('community', speciality_entry_4);
        formData.append('current_employee_status', employee_status);
        formData.append('bio', bio);
        formData.append('assistent_level',assistent_level);
        formData.append('declare_information',declare_information);
        
        $.ajax({
                url: "{{ route('admin.add_nurse_post_2') }}",
                type: "POST",
                data: formData,
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token for security
                },
                success: function(res) {
                    console.log(res.type);

                     if (res.status == '2') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: res.message,
                        }).then(function() {
                            $('a[href="' + targetTab + '"]').tab('show');
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: res.message,
                        });
                    }
                      // Show the target tab
                },
                error: function(error) {
                // if(targetTab ==  '#navpill-2'){
                  if (error.responseJSON.errors) {
                        if (error.responseJSON.errors.states) {
                            $('#type_nurse_error').text(error.responseJSON.errors.states[0]);
                        } else {
                            $('#type_nurse_error').text('');
                        }

                        if (error.responseJSON.errors.specialties) {
                            $('#specialties_error').text(error.responseJSON.errors.specialties[0]);
                           
                        } else {
                            $('#specialties_error').text('');
                        }

                        if (error.responseJSON.errors.bio) {
                            $('#bio_error').text(error.responseJSON.errors.bio[0]);
                           
                        } else {
                            $('#bio_error').text('');
                        }

                        if (error.responseJSON.errors.declare_information) {
                            $('#diclare_error').text(error.responseJSON.errors.declare_information[0]);
                           
                        } else {
                            $('#diclare_error').text('');
                        }

                        
                    // }                        
                    }
                }
            });

        // if (!hasErrors) {
        //     $('a[href="' + targetTab + '"]').tab('show'); // Show the target tab
        // }
           
        });
        

        
    });
    </script>

    <script> 
        // thired form        
        $('.next-step-3').on('click', function(event) { 
            event.preventDefault(); // Prevent default form submission

               var targetTab = $(this).data('target'); 
            // Initially deactivate all tabs except the first one
                // $('.nav-pills .nav-link').not('.active').addClass('disabled');

            // Function to enable the next tab
            function enableNextTab(targetTab) {
                $('a[href="' + targetTab + '"]').removeClass('disabled').tab('show');
            }
         
            // Create a new FormData object
            var formData = new FormData();

            var selectElement = $('select[data-list-id="ndegree"]');        
            var ndegree = selectElement.val();  
            
            var selectElement1 = $('select[data-list-id="profess_cert"]');        
            var profess_cert = selectElement1.val(); 

            // if(profess_cert == ''){
            //    $('#profess_cert_error').text('This field is required.')
            // }else{
            //   $('#profess_cert_error').text('')
            // }
    

            var selectElement2 = $('select[data-list-id="acls_data"]');       
            var acls_data = selectElement2.val(); 

            var acls_license_number = $('#acls_license_number').val();

            var acls_expiry = $('#acls_expiry').val();

            // Append the file
            var acls_upload_certification = $('#acls_upload_certification')[0].files[0];


            var selectElement3 = $('select[data-list-id="bls_data"]');        
            // Get the selected value(s) from the Select2 element
            var bls_data = selectElement3.val(); 


            var bls_license_number = $('#bls_license_number').val();

            var bls_expiry = $('#bls_expiry').val();

            // Append the file
            var bls_upload_certification = $('#bls_upload_certification')[0].files[0];

            var selectElement4 = $('select[data-list-id="cpr_data"]');        
            // Get the selected value(s) from the Select2 element
            var cpr_data = selectElement4.val(); 

            var cpr_license_number = $('#cpr_license_number').val();

            var cpr_expiry = $('#cpr_expiry').val();

            // Append the file
            var cpr_upload_certification = $('#cpr1_upload_certification')[0].files[0];

            // Specialties cpr_upload_certification
            var selectElement5 = $('select[data-list-id="nrp_data"]');        
            // Get the selected value(s) from the Select2 element
            var nrp_data = selectElement5.val();

            var nrp_license_number = $('#nrp_license_number').val();

            var nrp_expiry = $('#nrp_expiry').val();

            // Append the file
            var nrp_upload_certification = $('#nrp_upload_certification')[0].files[0];
            
            var selectElement6 = $('select[data-list-id="pals_data"]');        
            // Get the selected value(s) from the Select2 element
            var pals_data = selectElement6.val(); 

            var pals_license_number = $('#pals_license_number').val();

            var pals_expiry = $('#pals_expiry').val();

            // Append the file
            var pals_upload_certification = $('#pals_upload_certification')[0].files[0];

            var selectElement7 = $('select[data-list-id="rn_data"]');        
            // Get the selected value(s) from the Select2 element
            var rn_data = selectElement7.val(); 

            var rn_license_number = $('#rn_license_number').val();
            var rn_expiry = $('#rn_expiry').val();

            // Append the file
            var rn_upload_certification = $('#rn_upload_certification')[0].files[0];

            var selectElement8 = $('select[data-list-id="np_data"]');        
            // Get the selected value(s) from the Select2 element
            var np_data = selectElement8.val(); 

            var np_license_number = $('#np_license_number').val();

            var np_expiry = $('#np_expiry').val();

            // Append the file
            var np_upload_certification = $('#np_upload_certification')[0].files[0];

            var selectElement9= $('select[data-list-id="rn_data"]');        
            // Get the selected value(s) from the Select2 element
            var rn_data = selectElement9.val(); 

            var rn_license_number = $('#rn_license_number').val();

            var rn_expiry = $('#rn_expiry').val();

            // Append the file
            var rn_upload_certification = $('#rn_upload_certification')[0].files[0];
            
            
            var selectElement10 = $('select[data-list-id="cn_data"]');        
            // Get the selected value(s) from the Select2 element
            var cn_data = selectElement10.val(); 

            var cn_license_number = $('#cn_license_number').val();

            var cn_expiry = $('#cn_expiry').val();

            // Append the file
            var cn_upload_certification = $('#cn_upload_certification')[0].files[0];

            var selectElement11 = $('select[data-list-id="lpn_data"]');        
            // Get the selected value(s) from the Select2 element
            var lpn_data = selectElement11.val();

            var lpn_license_number = $('#lpn_license_number').val();

            var lpn_expiry = $('#lpn_expiry').val();

            // Append the file
            var lpn_upload_certification = $('#lpn_upload_certification')[0].files[0];

            var selectElement12 = $('select[data-list-id="crn_data"]');        
            // Get the selected value(s) from the Select2 element
            var crn_data = selectElement12.val();

            var crn_license_number = $('#crn_license_number').val();

            var crn_expiry = $('#crn_expiry').val();

            // Append the file
            var crn_upload_certification = $('#lpn_upload_certification')[0].files[0];

            var selectElement13 = $('select[data-list-id="cnm_data"]');        
            // Get the selected value(s) from the Select2 element
            var cnm_data = selectElement13.val();

            var cnm_license_number = $('#cnm_license_number').val();

            var cnm_expiry = $('#cnm_expiry').val();

            // Append the file
            var cnm_upload_certification = $('#cnm_upload_certification')[0].files[0];

            var selectElement14= $('select[data-list-id="ons_data"]');        
            // Get the selected value(s) from the Select2 element
            var ons_data = selectElement14.val();

            var ons_license_number = $('#ons_license_number').val();

            var ons_expiry = $('#ons_expiry').val();

            // Append the file
            var ons_upload_certification = $('#ons_upload_certification')[0].files[0];

            var selectElement15 = $('select[data-list-id="msw_data"]');        
            // Get the selected value(s) from the Select2 element
            var msw_data = selectElement15.val();

            var msw_license_number = $('#msw_license_number').val();

            var msw_expiry = $('#msw_expiry').val();

            // Append the file
            var msw_upload_certification = $('#msw_upload_certification')[0].files[0];

            var selectElement16 = $('select[data-list-id="ain_data"]');        
            // Get the selected value(s) from the Select2 element
            var ain_data = selectElement16.val();

            var ain_license_number = $('#ain_license_number').val();

            var ain_expiry = $('#ain_expiry').val();

            // Append the file
            var ain_upload_certification = $('#ain_upload_certification')[0].files[0];

            var selectElement17 = $('select[data-list-id="rpn_data"]');        
            // Get the selected value(s) from the Select2 element
            var rpn_data = selectElement17.val();

            var rpn_license_number = $('#rpn_license_number').val();

            var rpn_expiry = $('#rpn_expiry').val();

            // Append the file
            var rpn_upload_certification = $('#rpn_upload_certification')[0].files[0];

            var selectElement18 = $('select[data-list-id="nlc_data"]');        
            // Get the selected value(s) from the Select2 element
            var nlc_data = selectElement18.val();

            var nlc_license_number = $('#nlc_license_number').val();

            var nlc_expiry = $('#nlc_expiry').val();

            // Append the file
            var nlc_upload_certification = $('#nlc_upload_certification')[0].files[0];

            var selectElement19 = $('select[data-list-id="training_courses"]');        
            // Get the selected value(s) from the Select2 element
            var training_courses = selectElement19.val();

            // var selectElement20 = $('select[data-list-id="training_workshop"]');        
            // // Get the selected value(s) from the Select2 element
            // var training_workshop = selectElement20.val();
      
            var institution = $('#institution').val();
            var most_relevant = $('#most_relevant').val();

            var graduation_start_date = $('#graduation_start_date').val();

            var graduation_end_date = $('#graduation_end_date').val();


            let hasErrors = false;

            // if(targetTab ==  '#navpill-2'){
        //   alert(JSON.stringify(profess_cert));
            formData.append('ndegree',JSON.stringify(ndegree));
            formData.append('institution',institution);
            formData.append('most_relevant', most_relevant);     
            formData.append('graduation_start_date', graduation_start_date);
            formData.append('graduation_end_date', graduation_end_date);
            formData.append('professional_certification',JSON.stringify(profess_cert));
            formData.append('acls_data', JSON.stringify(acls_data));
            formData.append('acls_license_number', acls_license_number);
            formData.append('acls_expiry',acls_expiry);
            formData.append('acls_upload_certification',acls_upload_certification);

            formData.append('bls_data', JSON.stringify(bls_data));
            formData.append('bls_license_number', bls_license_number);
            formData.append('bls_expiry', bls_expiry);
            formData.append('bls_upload_certification', bls_upload_certification);

            formData.append('cpr_data', JSON.stringify(cpr_data));
            formData.append('cpr_license_number', cpr_license_number);
            formData.append('cpr_expiry', cpr_expiry);
            formData.append('cpr_upload_certification', cpr_upload_certification);

            formData.append('tab', 'tab3');

            formData.append('nrp_data',JSON.stringify(nrp_data));
            formData.append('nrp_license_number', nrp_license_number);
            formData.append('nrp_expiry', nrp_expiry );
            formData.append('nrp_upload_certification', nrp_upload_certification);

            formData.append('pals_data', JSON.stringify(pals_data));
            formData.append('pals_license_number',pals_license_number);
            formData.append('pals_expiry',pals_expiry );
            formData.append('pals_upload_certification',pals_upload_certification);

            formData.append('rn_data', JSON.stringify(rn_data));
            formData.append('rn_license_number', rn_license_number);
            formData.append('rn_expiry', rn_expiry);
            formData.append('rn_upload_certification', rn_upload_certification);

            formData.append('np_data',JSON.stringify(np_data));
            formData.append('np_license_number', np_license_number);
            formData.append('np_expiry', np_expiry);
            formData.append('np_upload_certification', np_upload_certification);

            formData.append('cn_data',JSON.stringify(cn_data));
            formData.append('cn_license_number',cn_license_number);
            formData.append('cn_expiry',cn_expiry);
            formData.append('cn_upload_certification',cn_upload_certification);


            formData.append('lpn_data',JSON.stringify(lpn_data));
            formData.append('lpn_license_number',lpn_license_number);
            formData.append('lpn_expiry',lpn_expiry);
            formData.append('lpn_upload_certification', lpn_upload_certification);

            formData.append('crn_data',JSON.stringify(crn_data));
            formData.append('crn_license_number', crn_license_number);
            formData.append('crn_expiry', crn_expiry );
            formData.append('crn_upload_certification  ', crn_upload_certification);

            formData.append('cnm_data',JSON.stringify(cnm_data));
            formData.append('cnm_license_number', cnm_license_number);
            formData.append('cnm_expiry', cnm_expiry);
            formData.append('cnm_upload_certification', cnm_upload_certification);

            formData.append('ons_data',JSON.stringify(ons_data));
            formData.append('ons_license_number', ons_license_number);
            formData.append('ons_expiry', ons_expiry);
            formData.append('ons_upload_certification ',ons_upload_certification);


            formData.append('msw_data',JSON.stringify(msw_data));
            formData.append('msw_license_number', msw_license_number);
            formData.append('msw_expiry', msw_expiry);
            formData.append('msw_upload_certification', msw_upload_certification);

            formData.append('ain_data',JSON.stringify(ain_data));
            formData.append('ain_license_number', ain_license_number);
            formData.append('ain_expiry', ain_expiry );
            formData.append('ain_upload_certification', ain_upload_certification);

            formData.append('rpn_data',JSON.stringify(rpn_data));
            formData.append('rpn_license_number  ', rpn_license_number );
            formData.append('rpn_expiry', rpn_expiry);
            formData.append('rpn_upload_certification', rpn_upload_certification);

            formData.append('nlc_data',JSON.stringify(nlc_data));
            formData.append('nlc_license_number', nlc_license_number);
            formData.append('nlc_expiry', nlc_expiry );
            formData.append('nlc_upload_certification', nlc_upload_certification  );

            formData.append('training_courses',JSON.stringify(training_courses));
            // formData.append('training_workshop',JSON.stringify(training_workshop));
            
            $.ajax({
                    url: "{{ route('admin.add_nurse_post_3') }}",
                    type: "POST",
                    data: formData,
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token for security
                    },
                    success: function(res) {
                        console.log(res.type);

                        if (res.status == '2') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: res.message,
                            }).then(function() {
                                $('a[href="' + targetTab + '"]').tab('show');
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: res.message,
                            });
                        }
                        // Show the target tab
                    },
                    error: function(error) {
                    // if(targetTab ==  '#navpill-2'){
                    if (error.responseJSON.errors) {
                            if(error.responseJSON.errors.ndegree){
                                $('#ndegree_error').text(error.responseJSON.errors.ndegree[0]);
                            } else {
                                $('#ndegree_error').text('');
                            }

                            if (error.responseJSON.errors.institution) {
                                $('#institution_error').text(error.responseJSON.errors.institution[0]);                           
                            } else {
                                $('#institution_error').text('');
                            }

                            if (error.responseJSON.errors.most_relevant) {
                                $('#relevant_error').text(error.responseJSON.errors.most_relevant[0]);                           
                            } else {
                                $('#relevant_error').text('');
                            }

                            if (error.responseJSON.errors.graduation_start_date) {
                                $('#gra_start_date_error').text(error.responseJSON.errors.graduation_start_date[0]);                           
                            } else {
                                $('#gra_start_date_error').text('');
                            }

                            if (error.responseJSON.errors.graduation_end_date) {
                                $('#gra_end_date_error').text(error.responseJSON.errors.graduation_end_date[0]);                           
                            } else {
                                $('#gra_end_date_error').text('');
                            }
                            

                            if (error.responseJSON.errors.professional_certification) {
                                $('#profess_cert_error').text(error.responseJSON.errors.professional_certification[0]);                           
                            } else {
                                $('#profess_cert_error').text('');
                            }

                            if (error.responseJSON.errors.training_courses) {
                                $('#training_course_error').text(error.responseJSON.errors.training_courses[0]);                           
                            } else {
                                $('#training_course_error').text('');
                            }

                            // if (error.responseJSON.errors.training_workshop) {
                            //     $('#training_workshop_error').text(error.responseJSON.errors.training_workshop[0]);                           
                            // } else {
                            //     $('#training_workshop_error').text('');
                            // }

                        // }                        
                        }
                    }
            }   );

        // if (!hasErrors) {
        //     $('a[href="' + targetTab + '"]').tab('show'); // Show the target tab
        // }
           
        });
    </script>

    <script>
    // thired form        
    $('.next-step-4').on('click', function(event) {
        event.preventDefault(); // Prevent default form submission

        var targetTab = $(this).data('target');
        // Initially deactivate all tabs except the first one
        // $('.nav-pills .nav-link').not('.active').addClass('disabled');

        // Function to enable the next tab
        function enableNextTab(targetTab) {
            $('a[href="' + targetTab + '"]').removeClass('disabled').tab('show');
        }

        // Create a new FormData object
        var formData = new FormData();

        var selectElement = $('select[id="assistent_level"]');
        var assistent_level = selectElement.val();

        var previous_employer_name = $('#previous_employer_name').val();

        var selectElement1 = $('select[data-list-id="positions_held"]');
        var positions_held = selectElement1.val();

        var start_date = $('#start_date').val();

        var end_date  = $('#end_date').val();

        var present_box  = $('#present_box').val();

        var job_responeblities  = $('#job_responeblities').val();

        var achievements  = $('#achievements').val();

        var selectElement2 = $('select[data-list-id="skills_compantancies"]');
        var skills_compantancies = selectElement2.val();

    
        let hasErrors = false;

        formData.append('assistent_level', JSON.stringify(assistent_level));
        formData.append('previous_employer_name', previous_employer_name);
        formData.append('start_date', start_date);
        formData.append('end_date', end_date);
        formData.append('present_box', present_box);
        formData.append('job_responeblities', job_responeblities);
        formData.append('positions_held',JSON.stringify(positions_held));
        formData.append('achievements', achievements);
        formData.append('skills_compantancies', JSON.stringify(skills_compantancies));

        formData.append('tab', 'tab4');

        $.ajax({
            url: "{{ route('admin.add_nurse_post_4') }}",
            type: "POST",
            data: formData,
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token for security
            },
            success: function(res) {
                console.log(res.type);

                if (res.status == '2') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: res.message,
                    }).then(function() {
                        $('a[href="' + targetTab + '"]').tab('show');
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: res.message,
                    });
                }
                // Show the target tab
            },
            error: function(error) {
                // if(targetTab ==  '#navpill-2'){
                if (error.responseJSON.errors) {
                    if (error.responseJSON.errors.previous_employer_name) {
                        $('#previous_employer_name_error').text(error.responseJSON.errors.previous_employer_name[0]);
                    } else {
                        $('#previous_employer_name_error').text('');
                    }

                    if (error.responseJSON.errors.positions_held) {
                        $('#positions_held_error').text(error.responseJSON.errors.positions_held[0]);
                    } else {
                        $('#positions_held_error').text('');
                    }

                    if (error.responseJSON.errors.start_date) {
                        $('#start_date_error').text(error.responseJSON.errors.start_date[0]);
                    } else {
                        $('#start_date_error').text('');
                    }

                    if (error.responseJSON.errors.end_date) {
                        $('#end_date_error').text(error.responseJSON.errors.end_date[0]);
                    } else {
                        $('#end_date_error').text('');
                    }

                    if (error.responseJSON.errors.job_responeblities) {
                        $('#job_responeblities_error').text(error.responseJSON.errors.job_responeblities[0]);
                    } else {
                        $('#job_responeblities_error').text('');
                    }


                    if (error.responseJSON.errors.achievements) {
                        $('#achievements_error').text(error.responseJSON.errors.achievements[0]);
                    } else {
                        $('#achievements_error').text('');
                    }

                    if (error.responseJSON.errors.skills_compantancies) {
                        $('#skills_compantancies_error').text(error.responseJSON.errors.skills_compantancies[0]);
                    } else {
                        $('#skills_compantancies_error').text('');
                    }

                    if (error.responseJSON.errors.present_box) {
                        $('#present_box_error').text(error.responseJSON.errors.present_box[0]);                           
                    } else {
                        $('#present_box_error').text('');
                    }

                    // }                        
                }
            }
        });

        // if (!hasErrors) {
        //     $('a[href="' + targetTab + '"]').tab('show'); // Show the target tab
        // }

    }); 
    </script>

    <script>
    //four form        
    $('.next-step-5').on('click', function(event) {
        event.preventDefault(); // Prevent default form submission

        var targetTab = $(this).data('target');
        // Initially deactivate all tabs except the first one
        // $('.nav-pills .nav-link').not('.active').addClass('disabled');

        // Function to enable the next tab
        function enableNextTab(targetTab) {
            $('a[href="' + targetTab + '"]').removeClass('disabled').tab('show');
        }

        // Create a new FormData object
        var formData = new FormData();

        var tra_start_date = $('#tra_start_date').val();
        var tra_end_date = $('#tra_end_date').val();

        var selectElement1 = $('select[id="mand_continue_education"]');
        var mand_continue_education = selectElement1.val();
     
        var institution1 = $('#institution1').val();

        let hasErrors = false;

        formData.append('tra_start_date',tra_start_date);
        formData.append('tra_end_date', tra_end_date);
        formData.append('mand_continue_education', mand_continue_education);
        formData.append('institution1',institution1);
        formData.append('tab', 'tab5');

        $.ajax({
            url: "{{ route('admin.add_nurse_post_5') }}",
            type: "POST",
            data: formData,
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token for security
            },
            success: function(res) {
                console.log(res.type);

                if (res.status == '2') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: res.message,
                    }).then(function() {
                        $('a[href="' + targetTab + '"]').tab('show');
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: res.message,
                    });
                }
                // Show the target tab
            },
            error: function(error) {
                // if(targetTab ==  '#navpill-2'){
                if (error.responseJSON.errors) {
                    if (error.responseJSON.errors.tra_start_date) {
                        $('#tra_start_date_error').text(error.responseJSON.errors.tra_start_date[0]);
                    } else {
                        $('#tra_start_date_error').text('');
                    }

                    if (error.responseJSON.errors.tra_end_date) {
                        $('#tra_end_date_error').text(error.responseJSON.errors.tra_end_date[0]);
                    } else {
                        $('#tra_end_date_error').text('');
                    }

                    if (error.responseJSON.errors.start_date) {
                        $('#start_date_error').text(error.responseJSON.errors.start_date[0]);
                    } else {
                        $('#start_date_error').text('');
                    }

                    if (error.responseJSON.errors.institution1) {
                        $('#institution_error_2').text(error.responseJSON.errors.institution1[0]);
                    } else {
                        $('#institution_error_2').text('');
                    }

                    if (error.responseJSON.errors.mand_continue_education) {
                        $('#mand_continue_education_error').text(error.responseJSON.errors.mand_continue_education[0]);
                    } else {
                        $('#mand_continue_education_error').text('');
                    }
                     
                }
            }
        });

        // if (!hasErrors) {
        //     $('a[href="' + targetTab + '"]').tab('show'); // Show the target tab
        // }

    }); 
    </script>

    <script>
    //six form        
    $('.next-step-6').on('click', function(event) {
        event.preventDefault(); // Prevent default form submission

        var targetTab = $(this).data('target');
        // Initially deactivate all tabs except the first one
        // $('.nav-pills .nav-link').not('.active').addClass('disabled');

        // Function to enable the next tab
        function enableNextTab(targetTab) {
            $('a[href="' + targetTab + '"]').removeClass('disabled').tab('show');
        }

        // Create a new FormData object
        var formData = new FormData();

        var selectElement1 = $('select[data-list-id="vaccination_record"]');
        var vaccination_record = selectElement1.val();

        var selectElement2 = $('select[id="immunization_status"]');
        var immunization_status = selectElement2.val();
     


        let hasErrors = false;

        formData.append('vaccination_record',JSON.stringify(vaccination_record));
        formData.append('immunization_status', immunization_status);
        formData.append('tab', 'tab6');

        $.ajax({
            url: "{{ route('admin.add_nurse_post_6') }}",
            type: "POST",
            data: formData,
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token for security
            },
            success: function(res) {
                console.log(res.type);

                if (res.status == '2') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: res.message,
                    }).then(function() {
                        $('a[href="' + targetTab + '"]').tab('show');
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: res.message,
                    });
                }
                // Show the target tab
            },
            error: function(error) {
                // if(targetTab ==  '#navpill-2'){
                if (error.responseJSON.errors) {
                    if (error.responseJSON.errors.vaccination_record) {
                        $('#vaccination_error').text(error.responseJSON.errors.vaccination_record[0]);
                    } else {
                        $('#vaccination_error').text('');
                    }

                    if (error.responseJSON.errors.immunization_status) {
                        $('#immunization_status_error').text(error.responseJSON.errors.immunization_status[0]);
                    } else {
                        $('#immunization_status_error').text('');
                    }

                 
                }
            }
        });

        // if (!hasErrors) {
        //     $('a[href="' + targetTab + '"]').tab('show'); // Show the target tab
        // }

    }); 
    </script>

    <script>
    //seven form        
    $('.eligibility_work').on('click', function(event){
        event.preventDefault(); // Prevent default form submission

        var targetTab = $(this).data('target');

        // // Function to enable the next tab
        // function enableNextTab(targetTab) {
        //     $('a[href="' + targetTab + '"]').removeClass('disabled').tab('show');
        // }
        var returnValue = true;
        $(".valley").html("");

        var residencyId = $("#residencyId").val();
        var image_support_documentI = $("#image_support_documentI").val();
        var visa_subclass_numberI = $("#visa_subclass_numberI").val();
        var passport_numberI = $("#passport_numberI").val();
        var passportcountryI = $("#passportcountryI").val();
        var visa_grant_numberI = $("#visa_grant_numberI").val();
        var expiry_dataI = $("#expiry_dataI").val();

        if (residencyId.trim() === "") {
            $("#residency_error").html("* Please Select the Residency.");
            returnValue = false;
        }

        if (residencyId.trim() !== 'Citizen') {
            if (visa_subclass_numberI.trim() === "") {
                $("#visa_subclass_error").html("* Please Enter the Subclass Number.");
                returnValue = false;
            }
            if (passport_numberI.trim() === "") {
                $("#passport_number_error").html("* Please Enter the Passport Number.");
                returnValue = false;
            }
            if (passportcountryI.trim() === "") {
                $("#passport_country_error").html("* Please Select the Passport Country.");
                returnValue = false;
            }
            if (visa_grant_numberI.trim() === "") {
                $("#visa_grant_error").html("* Please Enter the Passport Number.");
                returnValue = false;
            }
            if (residencyId.trim() === 'Visa Holder') {
                if (expiry_dataI.trim() === "") {
                    $("#expiry_date_error").html("* Please Select the Expiry Date.");
                    returnValue = false;
                }
            }
        }

        if (image_support_documentI.trim() === "") {
            $("#image_support_error").html("* Please Upload the Support Document.");
            returnValue = false;
        }

        if (!returnValue) {
            // $('.submit-btn-120').prop('disabled', false);
            // $('.submit-btn-1').hide();
            // $('.resetpassword').show();
            return false;
        }

        if (returnValue) {

        // Create a new FormData object
        var formData = new FormData();

       // Append the file
        var image_support_documentI = $('#image_support_documentI')[0].files[0];
     
        formData.append('residencyId',residencyId);
        formData.append('image_support_documentI', image_support_documentI);
        formData.append('visa_subclass_numberI', visa_subclass_numberI);
        formData.append('passport_numberI', passport_numberI);
        formData.append('passportcountryI', passportcountryI );
        formData.append('visa_grant_numberI', visa_grant_numberI);
        formData.append('expiry_dataI', expiry_dataI);
        formData.append('type','eligibility_work');

        formData.append('tab', 'tab7');

        $.ajax({
            url: "{{ route('admin.add_nurse_post_7') }}",
            type: "POST",
            data: formData,
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token for security
            },
            success: function(res) {
                console.log(res.type);

                if (res.status == '2') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: res.message,
                    }).then(function() {
                        $('a[href="' + targetTab + '"]').tab('show');
                    });
                } else {
                    Swal.fire({
                        icon:  'error',
                        title: 'Error',
                        text: res.message,
                    });
                }
                // Show the target tab
            },
            error: function(error) {

            }
        });

    }
    }); 

    $('.children_check').on('click', function(event){
        event.preventDefault(); // Prevent default form submission

        var targetTab = $(this).data('target');

        // // Function to enable the next tab
        // function enableNextTab(targetTab) {
        //     $('a[href="' + targetTab + '"]').removeClass('disabled').tab('show');
        // }
        var returnValue = true;
        $(".valley").html("");

        var clearance_numberI = $("#clearance_numberI").val();
        var clearancestateI = $("#clearancestateI").val();
        var clearance_expiry_dataI = $("#clearance_expiry_dataI").val();
        if (clearance_numberI.trim() == "") {

        document.getElementById("reqTxtclearance_numberI").innerHTML = "* Please Enter the Clearance Number.";

        returnValue = false;

        }

        if (clearancestateI.trim() == "") {

        document.getElementById("reqTxtclearancestateI").innerHTML = "* Please Select  the state.";

        returnValue = false;

        }
        if (clearance_expiry_dataI.trim() == "") {

        document.getElementById("reqTxtclearance_expiry_dataI").innerHTML = "* Please Select the Expiry Date.";

        returnValue = false;


        }


        if (!returnValue) {
            // $('.submit-btn-120').prop('disabled', false);
            // $('.submit-btn-1').hide();
            // $('.resetpassword').show();
            return false;
        }

        if (returnValue) {

        // Create a new FormData object
        var formData = new FormData();
     
        formData.append('clearance_numberI',clearance_numberI);
        formData.append('clearance_expiry_dataI', clearance_expiry_dataI);
        formData.append('clearancestateI', clearancestateI);
        formData.append('type','children_check');

        formData.append('tab', 'tab7');

        $.ajax({
            url: "{{ route('admin.add_nurse_post_7') }}",
            type: "POST",
            data: formData,
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token for security
            },
            success: function(res) {
                console.log(res.type);

                if (res.status == '2') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: res.message,
                    }).then(function() {
                        $('a[href="' + targetTab + '"]').tab('show');
                    });
                } else {
                    Swal.fire({
                        icon:  'error',
                        title: 'Error',
                        text: res.message,
                    });
                }
                // Show the target tab
            },
            error: function(error) {

            }
        });

    }
    });
    
    $('.police_check').on('click', function(event){
        event.preventDefault(); // Prevent default form submission

        var targetTab = $(this).data('target');

        // // Function to enable the next tab
        // function enableNextTab(targetTab) {
        //     $('a[href="' + targetTab + '"]').removeClass('disabled').tab('show');
        // }
        var returnValue = true;

        $(".valley").html("");

        var date_acquiredI = $("#date_acquiredI").val();
        var image_support_document_policeI = $("#image_support_document_policeI").val();
        var checkbox = $("#confirmationCheckboxPoliceCheck");


        if (date_acquiredI.trim() == "") {

        document.getElementById("reqTxtdate_acquiredI").innerHTML = "* Please Select  the date of  Acquired.";

        returnValue = false;

        }

        if (image_support_document_policeI.trim() == "") {

        document.getElementById("reqTxtimage_support_documentI").innerHTML = "* Please Upload the Police Check File.";

        returnValue = false;

        }
        if (!checkbox.is(':checked')) {
            alert('Please confirm your action.');
            document.getElementById("reqTxtconfirmationCheckboxPoliceCheckI").innerHTML = "Required field: Confirmation required.";
            returnValue = false;
        }


        if (!returnValue) {
            // $('.submit-btn-120').prop('disabled', false);
            // $('.submit-btn-1').hide();
            // $('.resetpassword').show();
            return false;
        }

        if (returnValue) {

        // Create a new FormData object
        var formData = new FormData();
        var image_support_document_policeI = $('#image_support_document_policeI')[0].files[0];
        formData.append('date_acquiredI',date_acquiredI);
        formData.append('confirmationCheckboxPoliceCheck', confirmationCheckboxPoliceCheck);
        formData.append('image_support_document_policeI', image_support_document_policeI);
        formData.append('type','police_check');

        formData.append('tab', 'tab7');

        $.ajax({
            url: "{{ route('admin.add_nurse_post_7') }}",
            type: "POST",
            data: formData,
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token for security
            },
            success: function(res) {
                console.log(res.type);

                if (res.status == '2') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: res.message,
                    }).then(function() {
                        $('a[href="' + targetTab + '"]').tab('show');
                    });
                } else {
                    Swal.fire({
                        icon:  'error',
                        title: 'Error',
                        text: res.message,
                    });
                }
                // Show the target tab
            },
            error: function(error) {

            }
        });

    }
    });
    </script>

    

    <script>
    $('.js-example-basic-multiple[data-list-id="profess_cert"]').on('change', function() {
        let selectedValues = $(this).val();
        
        console.log("selectedValues",selectedValues);
        //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));
        if(selectedValues.includes("6")){
            $('.procertdiv').removeClass('d-none');
            $('.license_number_acls').removeClass('d-none');
        }else{
            $('.procertdiv').addClass('d-none');
            $('.license_number_acls').addClass('d-none');
        }
        if(selectedValues.includes("7")){
            $('.procertdivone').removeClass('d-none');
            $('.license_number_bls').removeClass('d-none');
        }else{
            $('.procertdivone').addClass('d-none');
            $('.license_number_bls').addClass('d-none');
        }
        if(selectedValues.includes("8")){
            $('.procertdivtwo').removeClass('d-none');
            $('.license_number_cpr').removeClass('d-none');
        }else{
            $('.procertdivtwo').addClass('d-none');
            $('.license_number_cpr').addClass('d-none');
        }
        if(selectedValues.includes("9")){
            $('.procertdivthree').removeClass('d-none');
            $('.license_number_nrp').removeClass('d-none');
            
        }else{
            $('.procertdivthree').addClass('d-none');
            $('.license_number_nrp').addClass('d-none');
            
        }
        if(selectedValues.includes("10")){
            $('.procertdivfour').removeClass('d-none');
            $('.license_number_pals').removeClass('d-none');
            
        }else{
            $('.procertdivfour').addClass('d-none');
            $('.license_number_pals').addClass('d-none');   
        }
        if(selectedValues.includes("11")){
            $('.procertdivfive').removeClass('d-none');
            $('.license_number_rn').removeClass('d-none');
        }else{
            $('.procertdivfive').addClass('d-none');
            $('.license_number_rn').addClass('d-none'); 
        }
        if(selectedValues.includes("12")){
            $('.procertdivsix').removeClass('d-none');
            $('.license_number_cn').removeClass('d-none');
        }else{
            $('.procertdivsix').addClass('d-none');
            $('.license_number_cn').addClass('d-none');
        }

        if(selectedValues.includes("13")){
            $('.procertdivseven').removeClass('d-none');
            $('.license_number_lpn').removeClass('d-none');
        }else{
            $('.procertdivseven').addClass('d-none');
            $('.license_number_lpn').addClass('d-none');
        }
        if(selectedValues.includes("14")){
            $('.procertdiveight').removeClass('d-none');
            $('.license_number_crn').removeClass('d-none');
        }else{
            $('.procertdiveight').addClass('d-none');
            $('.license_number_crn').addClass('d-none');
        }
        if(selectedValues.includes("15")){
            $('.procertdivnine').removeClass('d-none');
            $('.license_number_cnm').removeClass('d-none');
        }else{
            $('.procertdivnine').addClass('d-none');
            $('.license_number_cnm').addClass('d-none');
        }
        if(selectedValues.includes("16")){
            $('.procertdivten').removeClass('d-none');
            $('.license_number_ons').removeClass('d-none');
        }else{
            $('.procertdivten').addClass('d-none');
            $('.license_number_ons').addClass('d-none');
        }
        if(selectedValues.includes("17")){
            $('.procertdiveleven').removeClass('d-none');
            $('.license_number_msw').removeClass('d-none');
        }else{
            $('.procertdiveleven').addClass('d-none');
            $('.license_number_msw').addClass('d-none');
        }
        if(selectedValues.includes("18")){
            $('.procertdivtwelfth').removeClass('d-none');
            $('.license_number_np').removeClass('d-none');
        }else{
            $('.procertdivtwelfth').addClass('d-none');
            $('.license_number_np').addClass('d-none');
        }
        if(selectedValues.includes("19")){
            $('.procertdivthirteen').removeClass('d-none');
            $('.license_number_ain').removeClass('d-none');
        }else{
            $('.procertdivthirteen').addClass('d-none');
            $('.license_number_ain').addClass('d-none');
        }
        if(selectedValues.includes("20")){
            $('.procertdivfourteen').removeClass('d-none');
            $('.license_number_rpn').removeClass('d-none');
        }else{
            $('.procertdivfourteen').addClass('d-none');
            $('.license_number_rpn').addClass('d-none');
        }
        if(selectedValues.includes("21")){
            $('.procertdivfiveteen').removeClass('d-none');
            $('.license_number_nlc').removeClass('d-none');
        }else{
            $('.procertdivfiveteen').addClass('d-none');
            $('.license_number_nlc').addClass('d-none');
        }          
    });
    </script>

    <script>
    $(document).ready(function() {
    $('#residencyId').change(function() {
      var residencyId = $(this).val();
      $('#passport_detail_date').hide();
      $('#passport_detail').hide();
      if (residencyId !== 'Citizen') {
        if (residencyId == 'Visa Holder') {
          $('#passport_detail_date').show();
        }
        $('#passport_detail').show();

      }
    });
  });

    function get_new_plice_check() {
    $('#get_new_plice_checkModel').modal('show');
    }
    </script>
    