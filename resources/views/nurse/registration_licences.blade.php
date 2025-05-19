@extends('nurse.layouts.layout')

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/css/intlTelInput.css" rel="stylesheet" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ url('/public') }}/nurse/assets/css/jquery.ui.datepicker.monthyearpicker.css">
<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.5.1/uicons-regular-rounded/css/uicons-regular-rounded.css'>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

<style type="text/css">
  .hide_profile_image {
    display: none !important;
  }

  span.select2.select2-container {
    padding: 5px !important;
    width: 100% !important;
  }

  .select2-container--default .select2-selection--multiple {
    background-color: white !important;
    border: 1px solid #0000 !important;
    border-radius: 4px !important;
    cursor: text !important;
  }

  .select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #000 !important;
    border: 1px solid #000 !important;
    border-radius: 4px !important;
    cursor: default !important;
    color: #fff !important;
    float: left;
    padding: 0;
    padding-right: 0.75rem;
    margin-top: calc(0.375rem - 2px);
    margin-right: 0.375rem;
    padding-bottom: 2px;
    white-space: normal;
    line-height: 20px;
  }

  .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: #fff !important;
    font-size: 20px !important;
    float: left;
    padding-right: 3px;
    padding-left: 3px;
    margin-right: 1px;
    margin-left: 3px;
    font-weight: 700;
    line-height: 20px;
  }

  .registration_progress {
    font-weight: 900;
    background-color: black;
    color: #fff;
  }

  form#language_skills_form ul.select2-selection__rendered {
    box-shadow: none;
    max-height: inherit;
    border: none;
    position: relative;
  }

  .sublang_main_div select{
    padding: 5px;
    border: 1px solid #dddddd;
    height: 50px;
  }

  .custom-select-wrapper {
  position: relative;
  width: 100%;
}

.custom-select {
  width: 100%;
  padding: 10px;
  appearance: none; /* Remove native arrow */
  -webkit-appearance: none;
  -moz-appearance: none;
  background: white;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 16px;
}

/* Custom arrow */
.custom-select-wrapper::after {
  content: "▼";
  position: absolute;
  top: 76%;
  right: 10px;
  transform: translateY(-50%);
  pointer-events: none;
  color: black;
  height: 36px !important;
  width: 20px;
}

</style>
@endsection

@section('content')
<main class="main">
  <section class="section-box mt-0">
    <div class="">
      <div class="row m-0 profile-wrapper">
        <div class="col-lg-3 col-md-4 col-sm-12 p-0 left_menu">

        @include('nurse.sidebar_profile')
        </div>
        <div class="col-lg-9 col-md-8 col-sm-12 col-12 right_content">
          <div class="content-single content_profile">
            @if(!email_verified())
            <div class="container-fluid">
              <div class="alert alert-warning mt-2" role="alert">
                <span class="d-flex align-items-center justify-content-center "><img src="{{ asset('nurse/assets/imgs/info.png') }}" width="25px;" alt="info" class="mx-2"> Thank you for signing up with us. To get full access, please verify your email first. If you didn't receive the email, <a href="javascript:void(0);" class="link-opacity-100 mx-1" style="color: black;text-decoration-line: underline;
                  text-decoration-style: straight;" onclick="return resendEmailLink()"><b> click here to resend it.</b></a></span>
              </div>
            </div>
            @endif
            @if(!account_verified())
            <div class="container-fluid">
              <div class="alert alert-warning mt-2" role="alert">
                <span class="d-flex align-items-center justify-content-center "><img src="{{ asset('nurse/assets/imgs/info.png') }}" width="25px;" alt="info" class="mx-2">Thank you for verifying your email!<br>Please complete your profile, and once approved, you will be able to apply for jobs and make your profile visible.
                </span>
              </div>
            </div>
            @endif
            @if(!completeProfile())
            <div class="container-fluid">
              <div class="alert alert-warning mt-2" role="alert">
                <span class="d-flex align-items-center justify-content-center "><img src="{{ asset('nurse/assets/imgs/info.png') }}" width="25px;" alt="info" class="mx-2">Thank you for completing your profile.<br>We are currently reviewing your details and will get in touch with you shortly.
                </span>
              </div>
            </div>
            @endif
            @if(!approvedProfile())
            <div class="container-fluid">
              <div class="alert alert-warning mt-2" role="alert">
                <span class="d-flex align-items-center justify-content-center "><img src="{{ asset('nurse/assets/imgs/info.png') }}" width="25px;" alt="info" class="mx-2">Congratulations! Your profile has been successfully approved.<br>You can now apply for jobs, connect with employers, and receive interview requests.
                </span>
              </div>
            </div>
            @endif
            {{-- @if(!email_verified())
            <div class="alert alert-success mt-2" role="alert">
              <span class="d-flex align-items-center justify-content-center ">Please verify your email first to access your account </span>
            </div>
            @endif --}}

            <div class="tab-content">
                <?php $user_id=''; $i = 0;?>

                <div class="tab-pane fade" id="tab-my-profile-setting" style="display: block;opacity:1;">

                    
                    <div class="card shadow-sm border-0 p-4 mt-30">
                      <h3 class="mt-0 color-brand-1 mb-2">Registrations and Licences</h3>

                      <div class="licences_content">
                        <h6>AHPRA Registration Status</h6>
                        <p>The Australian Health Practitioner Regulation Agency (AHPRA) provides a public Register of Practitioners. We need to insert AHPRA Automatic Lookup:</p>
                        <p>Backend Integration: AHPRA Register of Practitioners is available at:
                        <a href="https://www.ahpra.gov.au/Registration/Registers-of-Practitioners.aspx">https://www.ahpra.gov.au/Registration/Registers-of-Practitioners.aspx</a>
                        </p>
                        <p>It seems there is no official public API, but can you use a backend scraper with HTML parsing</p>
                      </div>
                      
    
                      <form id="language_skills_form" method="POST" onsubmit="return update_language_skills()">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::guard('nurse_middle')->user()->id }}">
                        <div class="form-group level-drp">
                          <label class="form-label" for="input-1">What is your current AHPRA registration status?</label>
                          <select id="registration-status" name="registration_status" class="form-control">
                            <option value="">-- Select Registration Status --</option>
                            <option value="RN">Registered Nurse (RN)</option>
                            <option value="RM">Registered Midwife (RM)</option>
                            <option value="RN_RM">Registered Nurse and Midwife (RN/RM)</option>
                            <option value="NP">Nurse Practitioner (NP) (as endorsed under RN)</option>
                            <option value="Graduate_RN">Graduate Nurse – Transitional Authorisation</option>
                            <option value="Graduate_RM">Graduate Midwife – Transitional Authorisation</option>
                            <option value="Student_Nurse">Student Nurse – AHPRA-registered (NMBA-approved course)</option>
                            <option value="Student_Midwife">Student Midwife – AHPRA-registered (NMBA-approved course)</option>
                            <option value="Overseas">Overseas-Qualified Nurses and Midwives not currently registered with AHPRA</option>
                            <option value="Not_Registered">Not currently registered with AHPRA</option>
                          </select>
                        </div>
                        <!-- Conditional AHPRA Input Group -->
                        <div id="ahpra-details-group" style="display: none;">
                          <div class="form-group level-drp" id="ahpra-number">
                            <!-- AHPRA Number -->
                            <label for="ahpra-number"><strong>Please Enter your AHPRA Registration Number:</strong></label>
                            <input class="form-control ahpra_number" type="text" name="ahpra_number" pattern="^NMW\d{10}$"
                                  placeholder="e.g. NMW0001234567" required/>
                            <small style="color: gray;">Format: NMW followed by 10 digits (e.g., NMW0001234567)</small>
                          </div>  
                          <!-- Consent Checkbox -->
                          <div class="declaration_box">
                            <label>
                              <input type="checkbox" id="ahpra-consent" required />
                              I consent to Mediqa verifying my AHPRA registration via the public AHPRA register.
                            </label>
                          </div>
                          <div class="add_new_certification_div mb-3 mt-3">
                            <a style="cursor: pointer;" id="lookup-ahpra-btn">Lookup AHPRA Registration</a>
                          </div>
                          
                          <div class="ahpra-lookup">
                            <div id="ahpra-lookup-result" style="margin-top: 30px; display: none; border-top: 1px solid #ccc; padding-top: 20px;">
                              <h6>AHPRA Registration Details</h6>
                              <div><strong>Division:</strong> <span id="division"></span></div>
                              <div><strong>Endorsements:</strong> <span id="endorsements"></span></div>
                              <div><strong>Registration Type:</strong> <span id="reg_type"></span></div>
                              <div><strong>Registration Status:</strong> <span id="reg_status"></span></div>
                              <div><strong>Notations:</strong> <span id="notations"></span></div>
                              <div><strong>Conditions:</strong> <span id="conditions"></span></div>
                              <div><strong>Expiry:</strong> <span id="expiry"></span></div>
                              <div><strong>Principal Place of Practice:</strong> <span id="principal_practice"></span></div>
                              <div><strong>Other Places of Practice:</strong> <span id="other_practices"></span></div>

                              <!-- Confirmation of Source -->
                              <div>
                                Data retrieved from <strong>AHPRA’s public register</strong>.
                              </div>
                            </div>
                            <div class="manual_ahpra_lookup">
                              <div style="background-color: #fff3cd; border-left: 5px solid #ffecb5; padding: 15px; margin-top: 20px; border-radius: 5px;">
                                <strong>We couldn't verify your AHPRA registration automatically.</strong><br>
                                Please complete the fields manually and upload your registration certificate as evidence of your current professional status.
                              </div>
                            </div>
                          </div>
                        </div>

                        
                        
                        </div>
                        
                        <div class="box-button mt-15">
                          <button class="btn btn-apply-big font-md font-bold" type="submit" id="submitLanguageSkills" @if(!email_verified()) disabled  @endif>Save Changes</button>
                        </div>
                      </form>
    
    
                    </div>
    
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>


@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/intlTelInput.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>
<script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
<script src="{{ url('/public') }}/nurse/assets/js/jquery.ui.datepicker.monthyearpicker.js"></script>
@include('nurse.front_profile_js');
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js">
</script>
<script>
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

    $('.js-example-basic-multiple').select2();

    // Dynamically add the clear button
    const clearButton = $('<span class="clear-btn">✖</span>');
    $('.select2-container').append(clearButton);

    // Handle the visibility of the clear button
    function toggleClearButton() {

        const selectedOptions = $('.js-example-basic-multiple').val();
        if (selectedOptions && selectedOptions.length > 0) {
            clearButton.show();
        } else {
            clearButton.hide();
        }
    }

    // Attach change event to select2
    $('.js-example-basic-multiple').on('change', toggleClearButton);

    // Clear button click event
    clearButton.click(function() {

        $('.js-example-basic-multiple').val(null).trigger('change');
        toggleClearButton();
    });

    // Initial check
    toggleClearButton();
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

    
  const registrationStatus = document.getElementById("registration-status");
  const ahpraGroup = document.getElementById("ahpra-details-group");

  const allowedStatuses = ["RN", "RM", "RN_RM", "NP"];

  

  registrationStatus.addEventListener("change", function () {
    console.log("registrationStatus",registrationStatus.value);
    if (allowedStatuses.includes(this.value)) {
      
      ahpraGroup.style.display = "block";
    } else {
      
      ahpraGroup.style.display = "none";
    }
  });

    $("#lookup-ahpra-btn").click(function(){
      var ahpraNumber = $(".ahpra_number").val();
      console.log("ahpraNumber",ahpraNumber);
      $("#ahpra-lookup-result").show();
      $.ajax({
        url: "{{ route('nurse.ahepra_lookup') }}",
        type: "GET",
        cache: false,
        data: {ahpraNumber:ahpraNumber},
        success: function(res) {
          console.log("res",res.division);
          
          $("#division").html(res.division);
          $("#endorsements").html(res.endorsements);
          $("#reg_type").html(res.registration_type);
          $("#reg_status").html(res.registration_status);
          $("#notations").html(res.notations);
          $("#conditions").html(res.conditions);
          $("#expiry").html(res.expiry);
          $("#principal_practice").html(res.principal_place);
          $("#other_practices").html(res.other_places);

          
        }
      });      
   });


</script>
<script>

    function printErrorMsg(msg) {
      $(".print-error-msg").find("ul").html('');
      $(".print-error-msg").css('display', 'block');
      $(".error").remove();
      $.each(msg, function(key, value) {
        $('#district_id').after('<span class="error">' + value + '</span>');
        $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
      });
    }
  </script>
  
  <script>
    jQuery(document).ready(function() {
  
      var el;
      var options;
      var canvas;
      var span;
      var ctx;
      var radius;
  
      var createCanvasVariable = function(id) { // get canvas
        el = document.getElementById(id);
      };
  
      var createAllVariables = function() {
        options = {
          percent: el.getAttribute('data-percent') || 25,
          size: el.getAttribute('data-size') || 165,
          lineWidth: el.getAttribute('data-line') || 10,
          rotate: el.getAttribute('data-rotate') || 0,
          color: el.getAttribute('data-color')
        };
  
        canvas = document.createElement('canvas');
        span = document.createElement('span');
        span.textContent = options.percent + '%';
  
        if (typeof(G_vmlCanvasManager) !== 'undefined') {
          G_vmlCanvasManager.initElement(canvas);
        }
  
        ctx = canvas.getContext('2d');
        canvas.width = canvas.height = options.size;
  
        el.appendChild(span);
        el.appendChild(canvas);
  
        ctx.translate(options.size / 2, options.size / 2); // change center
        ctx.rotate((-1 / 2 + options.rotate / 180) * Math.PI); // rotate -90 deg
  
        radius = (options.size - options.lineWidth) / 2;
      };
      var drawCircle = function(color, lineWidth, percent) {
        percent = Math.min(Math.max(0, percent || 1), 1);
        ctx.beginPath();
        ctx.arc(0, 0, radius, 0, Math.PI * 2 * percent, false);
        ctx.strokeStyle = color;
        ctx.lineCap = 'square'; // butt, round or square
        ctx.lineWidth = lineWidth;
        ctx.stroke();
      };
      var drawNewGraph = function(id) {
        el = document.getElementById(id);
        createAllVariables();
        drawCircle('#efefef', options.lineWidth, 100 / 100);
        drawCircle(options.color, options.lineWidth, options.percent / 100);
      };
      drawNewGraph('graph1');
    });
  
  </script>
@endsection
