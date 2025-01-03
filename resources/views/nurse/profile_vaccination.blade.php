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
</style>
@endsection

@section('content')
<main class="main">
  <section class="section-box mt-0">
    <div class="">
      <div class="row m-0 profile-wrapper">
        <div class="col-lg-3 col-md-4 col-sm-12 p-0 left_menu">
          <!--<div id="preloader-active" style="display:none;"> <div class="preloader d-flex align-items-center justify-content-center"> <div class="preloader-inner position-relative"> <div class="text-center"><img src="https://nextjs.webwiders.in/mediqa/public/nurse/assets/imgs/template/loading.gif" alt="jobBox"></div> </div> </div> </div>-->
          <div class="sidebar_profile">
            <div class="box-company-profile mb-20">
              <div class="image-compay-rel">
                <img alt="{{  Auth::guard('nurse_middle')->user()->lastname }}" src="{{ asset( Auth::guard('nurse_middle')->user()->profile_img)}}">
              </div>
              <div class="row mt-10">
                <div class="text-center">
                  <h5 class="f-18">{{ Auth::guard('nurse_middle')->user()->preferred }}</h5>
                  @if(Auth::guard('nurse_middle')->user()->state)
                  <span class="card-location font-regular">{{ state_name(Auth::guard('nurse_middle')->user()->state) }} , {{ country_name(Auth::guard('nurse_middle')->user()->country) }}</span>
                  @endif
                  <p class="mt-0 font-md color-text-paragraph-2 mb-15">{{ specialty_name_by_id(1) }}, 2 years</p>
                </div>
              </div>
            </div>

            <div class="profile-chklst">
              <span>Profile basics</span>
              <?php
              $get_myprofile_status = DB::table("users")->where("id", Auth::guard('nurse_middle')->user()->id)->first();
              $get_educert_status = DB::table("user_education_cerification")->where("user_id", Auth::guard('nurse_middle')->user()->id)->first();

              if (!empty($get_educert_status)) {
                $get_educert_status1 = $get_educert_status->complete_status;
              } else {
                $get_educert_status1 = 0;
              }

              $get_experience_status = DB::table("user_experience")->where("user_id", Auth::guard('nurse_middle')->user()->id)->first();

              if (!empty($get_experience_status)) {
                $get_experience_status1 = $get_experience_status->complete_status;
              } else {
                $get_experience_status1 = 0;
              }

              $get_profile_status = $get_myprofile_status->basic_info_status + $get_myprofile_status->professional_info_status + $get_educert_status1 + $get_experience_status1;
              $get_progress_status = round($get_profile_status / 14 * 100);

              ?>
              <div class="chart" id="graph1" data-percent="<?php echo $get_progress_status; ?>" data-color="#000"></div>
            </div>



            <div class="box-nav-tabs nav-tavs-profile mb-5 p-0 profile-icns">
              <ul class="nav" role="tablist">
                <li><a class="btn btn-border aboutus-icon mb-20 active profile_tabs" href="{{ route('nurse.my-profile', ['page' => 'my_profile']) }}" aria-controls="tab-my-profile" aria-selected="true"><i class="fi fi-rr-user"></i> My Profile</a></li>
                <li><a class="btn btn-border recruitment-icon mb-20 profile_tabs" href="{{ route('nurse.my-profile', ['page' => 'settings']) }}" aria-controls="tab-my-profile-setting" aria-selected="false"><i class="fi fi-rr-settings"></i> Setting</a></li>
                <li><a href="{{ route('nurse.my-profile', ['page' => 'profession']) }}" class="btn btn-border recruitment-icon mb-20 profile_tabs" aria-controls="tab-my-jobs" aria-selected="false"><i class="fi fi-rr-employee-man"></i> Profession</a></li>

                <li><a href="{{ route('nurse.my-profile', ['page' => 'educert']) }}" class="btn btn-border people-icon mb-20" aria-controls="tab-saved-jobs" aria-selected="false"><i class="fi fi-rr-graduation-cap"></i> Education and Certifications</a></li>
                <li><a href="{{ route('nurse.my-profile', ['page' => 'mandatory_training']) }}" class="btn btn-border aboutus-icon mb-20" aria-controls="tab-my-menu4" aria-selected="true"><i class="fi fi-rr-chart-user"></i>Mandatory Training and Continuing Education</a></li>
                <li><a href="{{ route('nurse.my-profile', ['page' => 'experience_info']) }}" class="btn btn-border aboutus-icon mb-20" aria-controls="tab-my-menu4" aria-selected="true"><i class="fi fi-rr-suitcase-alt"></i> Experience</a></li>
                <li><a href="{{ route('nurse.my-profile', ['page' => 'reference_info']) }}" class="btn btn-border aboutus-icon mb-20" aria-controls="tab-my-menu4" aria-selected="true"><i class="fi fi-rr-suitcase-alt"></i> References</a></li>
                <!-- <li><a href="#experience" id="experience_info" class="btn btn-border aboutus-icon mb-20" data-bs-toggle="tab" role="tab" aria-controls="tab-my-menu4" aria-selected="true"><i class="fi fi-rr-chart-histogram"></i>  Financial Details</a></li> -->

                <li><a href="{{ route('nurse.profileVaccination', ['page' => 'vaccinations']) }}" class="btn btn-border aboutus-icon mb-20 active" aria-controls="tab-my-menu4" aria-selected="true"><i class="fi fi-rr-chart-user"></i> Vaccinations</a></li>
                <li><a href="{{ route('nurse.my-profile', ['page' => 'work_clearances']) }}" class="btn btn-border recruitment-icon mb-20" aria-controls="tab-myclearance-jobs" aria-selected="false"><i class="fi fi-rr-briefcase-arrow-right"></i> Work Clearances</a></li>
                <li><a href="{{ route('nurse.my-profile', ['page' => 'professional_membership']) }}" class="btn btn-border recruitment-icon mb-20" aria-controls="tab-myclearance-jobs" aria-selected="false"><i class="fi fi-rr-membership-vip"></i> Professional Memberships</a></li>
                <li><a href="{{ route('nurse.my-profile', ['page' => 'interview_references']) }}" class="btn btn-border recruitment-icon mb-20" aria-controls="tab-myclearance-jobs" aria-selected="false"><i class="fi fi-rr-refer-arrow"></i> Interview</a></li>
                <li><a href="{{ route('nurse.my-profile', ['page' => 'personal_preferences']) }}" class="btn btn-border recruitment-icon mb-20" aria-controls="tab-myclearance-jobs" aria-selected="false"><i class="fi fi-rr-id-badge"></i> Personal Preferences</a></li>

                <li><a href="{{ route('nurse.my-profile', ['page' => 'work_preferences']) }}" id="work_preferences" class="btn btn-border recruitment-icon mb-20" data-bs-toggle="tab" role="tab" aria-controls="tab-myclearance-jobs" aria-selected="false"><i class="fi fi-rr-magnifying-glass-wave"></i>Job Search Preferences</a></li>
                <li><a href="{{ route('nurse.my-profile', ['page' => 'testimonial_reviews']) }}" id="testimonial_reviews" class="btn btn-border recruitment-icon mb-20" data-bs-toggle="tab" role="tab" aria-controls="tab-myclearance-jobs" aria-selected="false"><i class="fi fi-rr-feedback-review"></i> Testimonials and Reviews</a></li>
                <li><a href="{{ route('nurse.my-profile', ['page' => 'additional_info']) }}" id="additional_info" class="btn btn-border recruitment-icon mb-20" data-bs-toggle="tab" role="tab" aria-controls="tab-myclearance-jobs" aria-selected="false"><i class="fi fi-rr-guide-alt"></i> Additional Information</a></li>
                <div class="mt-0 mb-20 logout-line"><a class="link-red font-md" href="{{ route('nurse.logout') }}"><i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Log Out</a></div>
              </ul>
            </div>
          </div>
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
            @if(!email_verified())
            <div class="alert alert-success mt-2" role="alert">
              <span class="d-flex align-items-center justify-content-center ">Please verify your email first to access your account </span>
            </div>
            @endif

            <div class="bbb">

              <div class="tab-pane fade" id="tab-my-jobs" role="tabpanel" aria-labelledby="tab-my-jobs" style="display: none">
                <div class="card shadow-sm border-0 p-4 mt-30">
                  <form id="profession_form" method="POST">
                    <div class="condition_set">
                      <div class="form-group drp--clr">
                        <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="specialties" name="specialties[]" multiple="multiple"></select>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <?php
              $user_id = Auth::guard('nurse_middle')->user()->id;
              $i = 1;
              ?>
              <div class="tab-pane fade" id="tab-educert" role="tabpanel" aria-labelledby="tab-educert" style="display: none">
                <div class="card shadow-sm border-0 p-4 mt-30">
                  <h3 class="mt-0 color-brand-1 mb-20">Education and Certifications</h3>
                  <h6 class="emergency_text">
                    Educational Background
                  </h6>

                </div>
              </div>


              <!--vaccinaion start-->
              <div class="tab-pane fade" id="tab-vaccination">
                <div class="card shadow-sm border-0 p-4 mt-30">
                  <h3 class="mt-0 color-brand-1 mb-20">Vaccinations</h3>
                  <?php
                  $vaccinationData = DB::table("vaccination_front")->where("user_id", Auth::guard('nurse_middle')->user()->id)->first();
                  ?>
                  <form id="vaccination_form" method="POST" onsubmit="return vaccinationForm()">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::guard('nurse_middle')->user()->id }}">
                    <div class="row">
                      <div class="col-md-12">
                        <p class="">Please upload all your vaccination records as required for your desired roles and state. You may also add non-mandatory vaccines and any additional vaccinations not listed. Keeping your vaccinations up to date will help maintain your eligibility for your role.</p>
                        <p class="mt-2">To ensure your evidence is compliant, please refer to our guide <strong>Vaccination Compliance and Evidence Requirements by State.</strong></p>
                        <div class="form-group level-drp">
                          <label class="form-label" for="input-1">Vaccination Records</label>
                          <input type="hidden" name="vaccination_r" class="vaccination_r" value="@if(!empty($vaccinationData)){{ $vaccinationData->vaccination_records }}@endif">
                          <?php
                          $vaccination_record = DB::table("vaccination")->get();
                          ?>
                          <ul id="vaccination_record" style="display:none;">
                            @foreach($vaccination_record as $v_record)
                            <li data-value="{{ $v_record->id }}" data-id="{{ $v_record->name }}">{{ $v_record->name }}</li>
                            @endforeach
                          </ul>
                          <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="vaccination_record" name="vaccination_record[]" multiple="multiple"></select>
                          <span id="reqempsdate" class="reqError text-danger valley"></span>
                        </div>
                        <div class="vacc_rec_div"></div>
                        <div class="form-group level-drp">
                          <label class="form-label" for="input-1">Immunization Status </label>
                          <!-- <input class="form-control" type="text" required="" name="fullname" placeholder="Steven Job"> -->
                          <select class="form-input mr-10 select-active" name="immunization_status">
                            <option value="">Immunization Status</option>
                            <option value="Up-to-date" @if(!empty($vaccinationData)) @if($vaccinationData->immunization_status == "Up-to-date") selected @endif @endif>Up-to-date</option>
                            <option value="Pending" @if(!empty($vaccinationData)) @if($vaccinationData->immunization_status == "Pending") selected @endif @endif>Pending</option>
                          </select>
                        </div>
                        <div class="box-button mt-15">
                          <button class="btn btn-apply-big font-md font-bold" type="submitVaccination" id="submitVaccination">Save Changes</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--footer-- class="footer pt-0" style="margin: 0 11px;">
          <div class="container">
            <div class="footer-bottom ">
              <div class="row footer_profile_cls">
                <div class="col-md-6"><span class="font-xs color-text-paragraph">Copyright © 2024. Mediqa all right reserved</span></div>
                <div class="col-md-6 text-md-end text-start privacy_option">
                  <div class="footer-social"><a class="font-xs color-text-paragraph" href="#">Privacy Policy</a><a class="font-xs color-text-paragraph mr-30 ml-30" href="#">Terms &amp; Conditions</a></div>
                </div>
              </div>
            </div>
          </div>
        </!--footer-->
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

<script type="text/javascript">
  $('.js-example-basic-multiple').each(function() {
    let listId = $(this).data('list-id');

    let items = [];

    $('#' + listId + ' li').each(function() {

      items.push({
        id: $(this).data('value'),
        text: $(this).text()
      });
    });

    $(this).select2({
      data: items
    });

  });

  if ($(".vaccination_r").val() != "") {
    var vaccination_record = JSON.parse($(".vaccination_r").val());
    $('.js-example-basic-multiple[data-list-id="vaccination_record"]').select2().val(vaccination_record).trigger('change');
  }

  $("#tab-vaccination").insertAfter("#tab-educert");

  // Function to initialize Select2 for dynamically created select elements
  function initializeSelect2($dropdown) {
    $dropdown.on('select2:open', function() {
      var $currentDropdown = $(this);
      var searchBoxHtml = `
      <div class="extra-buttons">
        <button class="select-all-button" type="button">Select All</button>
        <button class="remove-all-button" type="button">Remove All</button>
      </div>`;

      // Add select all/remove all buttons
      $('.select2-results').prepend(searchBoxHtml);

      $('.select-all-button').on('click', function() {
        var allValues = $currentDropdown.find('option').map(function() {
          return $(this).val();
        }).get();
        $currentDropdown.val(allValues).trigger('change');
      });

      $('.remove-all-button').on('click', function() {
        $currentDropdown.val(null).trigger('change');
      });
    });
  }


  $(".change_password_link").click(function() {

    window.history.replaceState(null, null, "?page=change_password");

    var url_string = window.location.href;
    var url = new URL(url_string);
    var c = url.searchParams.get("page");


    if (c == "change_password") {
      $(".upload_image").addClass("hide_profile_image");
      $(".profile_update_heading").hide();
      $(".update_profile").hide();
      $(".change_password_div").show();
    }

  });
  var url_string = window.location.href;
  var url = new URL(url_string);
  var c = url.searchParams.get("page");


  if (c == "change_password") {
    $(".upload_image").addClass("hide_profile_image");
    $(".profile_update_heading").hide();
    $(".update_profile").hide();
    $(".change_password_div").show();
  }

  var url_string = window.location.href;
  var url = new URL(url_string);
  var c = url.searchParams.get("page");


  if (c == "vaccinations") {

    $(".tab-pane").hide();
    $("#tab-vaccination").css("opacity", "1");
    $("#tab-vaccination").show();
    $(".profile_tabs").removeClass("active");
    $("#vaccinations").addClass("active");
    $(".prof-profile .dropdown").addClass("show");
    $(".prof-profile .dropdown-menu").addClass("show");
  }
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
<script
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB_csTJjYCU5V2Fk4jE4XSqgsc3T-FrtVU&callback=initAutocomplete&libraries=places&v=weekly"
  defer></script>
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