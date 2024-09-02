    
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
            var neonatal_care = specialtiest_10.val();surgical_rowpad_box

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
        formData.append('operating_room_scrub	', surgical_operative_care_3);
        formData.append('maternity', speciality_entry_2);
        formData.append('surgical_obstrics_gynacology', surgical_obs_care);
        formData.append('paediatrics_neonatal', speciality_entry_3);
        formData.append('neonatal_care', neonatal_care);
        formData.append('paedia_surgical_preoperative', surgical_rowpad_box);
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
        // second form        
        $('.next-step-3').on('click', function() { 
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
            var neonatal_care = specialtiest_10.val();surgical_rowpad_box

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
        formData.append('operating_room_scrub	', surgical_operative_care_3);
        formData.append('maternity', speciality_entry_2);
        formData.append('surgical_obstrics_gynacology', surgical_obs_care);
        formData.append('paediatrics_neonatal', speciality_entry_3);
        formData.append('neonatal_care', neonatal_care);
        formData.append('paedia_surgical_preoperative', surgical_rowpad_box);
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
    