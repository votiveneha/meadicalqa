@extends('nurse.layouts.layout')

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/css/intlTelInput.css" rel="stylesheet" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ url('/public') }}/nurse/assets/css/jquery.ui.datepicker.monthyearpicker.css">
<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.5.1/uicons-regular-rounded/css/uicons-regular-rounded.css'>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

<style type="text/css">
.file-item {
    display: flex;
    align-items: unset;
    margin-bottom: 10px;
}

.file-item a {
    text-decoration: none;
    color: #333;
    margin-right: 10px;
    display: flex;
    align-items: center;
}

.file-item .fa-file {
    margin-right: 5px;
}

.file-item .close_btn.close_btn-0 {
    margin-left: 0;
}

i.fa.fa-file {
    position: relative;
    left: 0px;
    font-size: 14px;
    line-height: 25px;
    margin-right: 5px;
    color: #000000;
}
.close_btn i {
    display: block;
    position: relative;
    left: 0px;
    font-size: 14px;
    line-height: 25px;
    margin-right: 5px;
    color: #000000;
    top: 14px;
}


.change_clr option:hover {
        background-color: black !important; 
        color: white !important; 
    }
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
                <li><a href="{{ route('nurse.my-profile', ['page' => 'profession']) }}"  class="btn btn-border recruitment-icon mb-20 profile_tabs" aria-controls="tab-my-jobs" aria-selected="false"><i class="fi fi-rr-employee-man"></i> Profession</a></li>

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
                  <form id="profession_form" method="POST" >
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
                  
                  <form id="vaccination_form" method="POST" onsubmit="return vaccinationForm()" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                      <div class="col-md-12">
                        <p class="">Please upload all your vaccination records as required for your desired roles and state. You may also add non-mandatory vaccines and any additional vaccinations not listed. Keeping your vaccinations up to date will help maintain your eligibility for your role.</p>
                        <p class="mt-2">To ensure your evidence is compliant, please refer to our guide <strong>Vaccination Compliance and Evidence Requirements by State.</strong></p>
                        
                        <div class="form-group level-drp">
                          <label class="form-label" for="input-1">Vaccination Records</label>
                          @php
                            $vacc = []; 
                          @endphp

                          @if(!empty($vaccinationData))
                              @foreach($vaccinationData as $vcdata)
                                  @php $vacc[] = $vcdata->vaccination_id; @endphp
                              @endforeach
                          @endif
                          <input type="hidden" name="vaccination_r" class="vaccination_r" value="{{ json_encode($vacc) }}">

                          
                          <ul id="vaccination_record" style="display:none;">
                            @foreach($vaccination_record as $v_record)
                            <li data-value="{{ $v_record->id }}" data-id="{{ $v_record->name }}">{{ $v_record->name }}</li>
                            @endforeach
                          </ul>
                          <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="vaccination_record" name="vaccination_record[]" multiple="multiple"></select>
                          <span id="reqempsdate" class="reqError text-danger valley"></span>
                        </div>

                        <div class="vacc_rec_div"></div>
                        

                        <!--[ADD OTHER VACCINE START]-->
                        <div class="row" id="vaccine-section-container">
                        <h6>Other Vaccination </h6>
                        @php $ci = 1; @endphp
                              @if($other_vaccine)
                              @foreach($other_vaccine as $other)  
                            <div class="vaccine-section">
                              <div class="col-md-12">
                                <input type="hidden" name="other_id[]" value="{{$other->id}}">
                                <h6>Vaccination {{$ci}}</h6>
                                  <div class="form-group level-drp">
                                      <label class="form-label" for="input-1">Vaccination Name </label>
                                      <input class="form-control  vaccination-name" type="text" name="vaccination_name[]" value="{{$other->vaccination_name}}">
                                      <span class="reqError text-danger valley"></span>
                                  </div>

                                  <div class="form-group level-drp">
                                      <label class="form-label" for="input-1">Immunization Status</label>
                                      <select class="form-input mr-10 change_clr select-active immunization-status" name="immunization_status[]">
                                          <option value="" disabled selected>Immunization Status</option>
                                          <?php
                                          $get_imm_status = DB::table("imm_status")->get();
                                          foreach ($get_imm_status as $status) { ?>
                                              <option value="<?= $status->id ?>" {{$other->immunization_status==$status->id?'selected':''}}><?= htmlspecialchars($status->name) ?></option>
                                          <?php } ?>
                                      </select>
                                      <span class="reqError text-danger valley"></span>
                                  </div>

                                  <div class="form-group level-drp">
                                      <label class="form-label" for="input-1">Evidence Type</label>
                                      <select class="form-input mr-10 change_clr select-active evidence-type" name="evidence_type[]">
                                          <option value="" disabled selected>Evidence type</option>
                                          <option value="Immunization Certificate" {{$other->evidence_type=='Immunization Certificate'?'selected':''}}>Immunization Certificate</option>
                                          <option value="Vaccination Card/Record" {{$other->evidence_type=='Vaccination Card/Record'?'selected':''}}>Vaccination Card/Record</option>
                                          <option value="Medical Letter or Certificate from GP" {{$other->evidence_type=='Medical Letter or Certificate from GP'?'selected':''}}>Medical Letter or Certificate from GP</option>
                                          <option value="Vaccination Record from My Health Record" {{$other->evidence_type=='Vaccination Record from My Health Record'?'selected':''}}>Vaccination Record from My Health Record</option>
                                          <option value="Serology Test Results" {{$other->evidence_type=='Serology Test Results'?'selected':''}}>Serology Test Results</option>
                                          <option value="Immunization History Statement from the Australian Immunisation Register (AIR)" {{$other->evidence_type=='Immunization History Statement from the Australian Immunisation Register (AIR)'?'selected':''}}>Immunization History Statement from the Australian Immunisation Register (AIR)</option>
                                          <option value="Employer or Facility Letter" {{$other->evidence_type=='Employer or Facility Letter'?'selected':''}}>Employer or Facility Letter</option>
                                      </select>
                                      <span class="reqError text-danger valley"></span>
                                  </div>

                                  <div class="form-group level-drp">
                                      <label class="form-label" for="input-1">Upload Evidence</label>
                                      <input class="form-control" type="file" name="evidence_file[]">
                                      <span class="reqError text-danger valley"></span>
                                  </div>
                              </div>
                              <div class="add_new_certification_div mb-3 mt-3">
                                <a style="cursor: pointer;" class="remove-vaccine" other_id="{{$other->id}}">- Delete Vaccine</a>
                              </div>
                          </div>
                          @php $ci++; @endphp
                          @endforeach
                          @endif
                          </div>
                          <div class="add_new_certification_div mb-3 mt-3">
                            <a style="cursor: pointer;" id="add-vaccine">+ Add Another Vaccine</a>
                          </div>
                          <!--[ADD OTHER VACCINE END]-->

                          <!----[Vaccination Compliance Start]---->
                          <div class="row" >
                            <h6>Vaccination Compliance and Evidence Requirements by State:</h6>
                            <span>Please select States and Territories that you are looking to work to check vaccination compliance: </span>

                            <div class="form-group level-drp">
                              <label class="form-label" for="input-1">States</label>
                                <ul id="state_record" style="display:none;">
                                  @foreach($state_record as $s_record)
                                  <li data-value="{{ $s_record->id }}" data-id="{{ $s_record->state_name }}">{{ $s_record->state_name }}</li>
                                  @endforeach
                                </ul>
                              <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="state_record" name="state_record[]" multiple="multiple"></select>
                              <span id="reqempsdate" class="reqError text-danger valley"></span>
                            </div>
                            <div id="contentDisplay" class="content-display">
                                              
                            </div>
                          </div>
                        <!----[Vaccination Compliance End]---->
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

<script>
  $(document).ready(function () {
    // Function to remove error on user interaction
    $(document).on('input', '.vaccination-name', function () {
        if ($(this).val().trim() !== '') {
            $(this).next('.reqError').text('');
        }
    });

    $(document).on('change', '.immunization-status', function () {
        if ($(this).val().trim() !== '') {
            $(this).next('.reqError').text('');
        }
    });

    $(document).on('change', '.evidence-type', function () {
        if ($(this).val().trim() !== '') {
            $(this).next('.reqError').text('');
        }
    });

    $(document).on('change', '.evidence-file', function () {
        if ($(this).val().trim() !== '') {
            $(this).next('.reqError').text('');
        }
    });
});
    $(document).ready(function () {
        // Function to add a new vaccine section
        let i = <?php echo count($other_vaccine)+1 ?>;
        $('#add-vaccine').click(function () {
          
            $('#vaccine-section-container').append(`<div class="vaccine-section">
                              <div class="col-md-12">
                              <h6>Vaccination ${i}</h6>
                                  <div class="form-group level-drp">
                                      <label class="form-label" for="input-1">Vaccination Name</label>
                                      <input class="form-control vaccination-name" type="text" name="vaccination_name[]" value="">
                                      <span class="reqError text-danger valley"></span>
                                  </div>

                                  <div class="form-group level-drp">
                                      <label class="form-label" for="input-1">Immunization Status</label>
                                      <select class="form-input mr-10 change_clr immunization-status" name="immunization_status[]">
                                          <option value="" disabled selected>Select Immunization Status</option>
                                          <?php
                                          $get_imm_status = DB::table("imm_status")->get();
                                          foreach ($get_imm_status as $status) { ?>
                                              <option value="<?= $status->id ?>" ><?= htmlspecialchars($status->name) ?></option>
                                          <?php } ?>
                                      </select>
                                      <span class="reqError text-danger valley"></span>
                                  </div>

                                  <div class="form-group level-drp">
                                      <label class="form-label" for="input-1">Evidence Type</label>
                                      <select class="form-input mr-10 change_clr evidence-type" name="evidence_type[]">
                                          <option value="" disabled selected>Select Evidence type</option>
                                          <option value="Immunization Certificate" >Immunization Certificate</option>
                                          <option value="Vaccination Card/Record" >Vaccination Card/Record</option>
                                          <option value="Medical Letter or Certificate from GP" >Medical Letter or Certificate from GP</option>
                                          <option value="Vaccination Record from My Health Record" >Vaccination Record from My Health Record</option>
                                          <option value="Serology Test Results" >Serology Test Results</option>
                                          <option value="Immunization History Statement from the Australian Immunisation Register (AIR)" >Immunization History Statement from the Australian Immunisation Register (AIR)</option>
                                          <option value="Employer or Facility Letter" >Employer or Facility Letter</option>
                                      </select>
                                      <span class="reqError text-danger valley"></span>
                                  </div>

                                  <div class="form-group level-drp">
                                      <label class="form-label" for="input-1">Upload Evidence</label>
                                      <input class="form-control evidence-file" type="file" name="evidence_file[]">
                                      <span class="reqError text-danger valley"></span>
                                  </div>
                              </div>
                              <div class="add_new_certification_div mb-3 mt-3">
                                <a style="cursor: pointer;" class="remove-vaccine">- Delete Vaccine</a>
                              </div>
                              
                          </div>`);
                          i++;
        });

        // Function to remove a vaccine section
        $(document).on('click', '.remove-vaccine', function () {
          
          const otherId = $(this).attr('other_id');

          if (otherId) 
          {
        
            $.ajax({
              url: "{{ url('/nurse') }}/removeVaccine", 
                type: 'POST',
                data: {
                  _token: "{{ csrf_token() }}", 
                    id: otherId 
                },
                success: function (response) 
                {
                    if (response.success) {
                        // On successful deletion from the database, remove the HTML
                        alert('Vaccine removed successfully!');
                        $(this).closest('.vaccine-section').remove();
                    } else {
                        alert('Failed to remove vaccine. Please try again.');
                    }
                }.bind(this), // Bind `this` to refer to the button element
                error: function () {
                    alert('An error occurred. Please try again.');
                }
            });
        } else {
            // If `other_id` is not present, just remove the HTML
            $(this).closest('.vaccine-section').remove();
        }
  });    
        
    });
</script>
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
 /*
  if ($(".state_r").val() != "") {
    var state_record = JSON.parse($(".state_r").val());
    $('.js-example-basic-multiple[data-list-id="state_record"]').select2().val(state_record).trigger('change');
  } */
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

<script>
  $(document).ready(function () {
    // Listen to changes in State and Vaccine dropdowns
    const updateContent = () => {
      let selectedStates = $('.js-example-basic-multiple[data-list-id="state_record"]').val();
      let selectedVaccines = $('.js-example-basic-multiple[data-list-id="vaccination_record"]').val();

      // Check if both States and Vaccines are selected
      if (selectedStates.length > 0 && selectedVaccines.length > 0) {
        // Make an AJAX request to fetch content for the selected combinations
        $.ajax({
          url: "{{ url('/nurse') }}/getContent",
          type: "POST",
          data: {
            states: selectedStates,
            vaccines: selectedVaccines,
            _token: '{{ csrf_token() }}', // Include CSRF token for Laravel
          },
          success: function (response) {
            // Populate the content in the `#contentDisplay` div
            $('#contentDisplay').html(response);
          },
          error: function () {
            console.error("Error fetching content.");
          },
        });
      } else {
        // Clear the display if no selections
        $('#contentDisplay').html("<p>Please select both states and vaccines.</p>");
      }
    };

    // Trigger content update on change
    $('.js-example-basic-multiple[data-list-id="state_record"], .js-example-basic-multiple[data-list-id="vaccination_record"]').on('change', updateContent);
  });
</script>

<script>
  //This will add vaccination record 
   $(document).ready(function() {
        $('.js-example-basic-multiple[data-list-id="vaccination_record"]').on('change', function() {
            let selectedValues = $(this).val(); // Get selected values (IDs)
            console.log('selectedValues', selectedValues);

            let processedIds = new Set(); // Track already processed IDs
            $(".vacc_rec_div").empty(); // Clear the current contents of the vaccination record container

            // Add new <h6> elements for IDs in selectedValues
            selectedValues.forEach(function(id, i) {
                if (!processedIds.has(id)) {
                    processedIds.add(id); // Mark this ID as processed

                    // Find the associated text using the `data-value` attribute
                    let datatext = $('#vaccination_record li').filter(function() {
                        return $(this).data('value') == id; // Compare the current `data-value` with the ID
                    }).text(); // Get the text content of the matched element

                    // Check if datatext is valid before appending
                    if (datatext) {
                        $(".vacc_rec_div").append(`
                    <div class="vacc_rec_${id}">
                        <h6 class="vacc_rec_head_${id}" data-id="${id}">${datatext}</h6>
                        <input type="hidden" name="vaccination_id[]" class="vacc_rec_input_${id}" value="${id}">

                        <div class="row vacc_rec_institution">
                            <!-- Level of Requirement -->
                            <div class="form-group col-md-12">
                                <label class="form-label" for="level_req-${i}">Level of Requirement</label>
                                <div class="testing">
                                
                                  ${<?php echo json_encode(DB::table("vcc_level_req")->get()); ?>.map((data1, index) => {
                                  const adjustedIndexs = 1; 
                                if (data1.type == id) {
                                    return `<label for="level_req-${adjustedIndexs}-${i}">${data1.level_req}</label><br>`;
                                    }
                                    return "";
                                    adjustedIndexs++ ;
                                }).join('')}  
                                </div>
                                <span id="level_req-${i}" class="reqError text-danger valley"></span>
                            </div>

                            <!-- Immunization Status -->
                            <div class="form-group col-md-12">
                                <label class="form-label" for="imm_status_status-${i}">Immunization Status</label>
                                <select class="form-control mid_spe_status imm_status_status-${i}" name="imm_status_status[${id}][]">
                                  <option value="">Select Immunization Status</option>
                                    <?php
                                    $get_imm_status = DB::table("imm_status")->get();
                                    foreach ($get_imm_status as $status) { ?>
                                        <option value="<?= htmlspecialchars($status->id) ?>"><?= htmlspecialchars($status->name) ?></option>
                                    <?php } ?>
                                </select>
                                <span id="imm_status_statusvalid-${i}" class="reqError text-danger valley"></span>
                            </div>

                            <!-- Dose -->
                            <div class="form-group col-md-12" style="display: ${id == 12 ? 'block' : 'none'}">
                                <label class="form-label" for="dose-${i}">How many doses of a TGA-recognised COVID-19 vaccine have you received?</label>
                                <select class="form-control mid_spe_status covid_dose-${i}" name="covid_dose[${id}]"  onchange="handleDoseChange(this, ${id})">
                                    <option value="None">None</option>
                                    <option value="1">1 dose</option>
                                    <option value="2">2 dose</option>
                                    <option value="3">3 dose</option> 
                                    <option value="4">4 dose</option>
                                    <option value="5">5 dose</option>
                                    <option value="6">6 dose</option>
                                </select>
                                <span id="coviddosevalid-${i}" class="reqError text-danger valley"></span>
                            </div>

                           <!-- Evidence required --> 
                            <div class="col-md-12" style="display: ${id == 12 ? 'none' : 'block'}">
                                <label class="form-label" for="evidence_required-${i}">Evidence Required:</label>
                                <div>
                                  ${<?php echo json_encode(DB::table("evidence_type")->get()); ?>.map((data, index) => {
                                  const adjustedIndex = 1; 
                                if (data.type === id) {
                                    return `
                                        <input type="radio" id="evidence_re-${adjustedIndex}-${i}" name="evidence_required[${id}][]" value="${data.id}">
                                        <label for="evidence_re-${adjustedIndex}-${i}">${data.name}</label><br>
                                    `;
                                    }
                                    return '';
                                    adjustedIndex++ ;
                                }).join('')}  
                                </div>
                                <div class="hep-b mt-2" style="display: none;">
                                    <p>If vaccination records are missing, a <a href="https://www.health.nsw.gov.au/immunisation/Documents/Occupational/appendix-9-declaration.pdf" target="_blank">NSW Health Hepatitis B Vaccination Declaration form</a>, signed by an approved assessor, may be accepted in certain cases. However, it is not sufficient by itself; additional evidence, such as serology results showing immunity, is usually required for full compliance
                                    </p>
                                </div>
                                <span id="evidence_requiredvalid-${i}" class="reqError text-danger valley"></span>
                            </div>

                            <!-- Evidence required --> 
                            <div class="col-md-12" id="evidence_required_container-${id}" style="display: none;">
                                <label class="form-label" for="evidence_requiredeee-${id}">Evidence Required:</label>
                                <div id="evidence_div_${id}">
                                    
                                </div>
                                <span id="evidence_requiredvalid-${i}" class="reqError text-danger valley"></span>
                            </div>


                            <!-- Evidence Upload required --> 
                            <div class="form-group col-md-12">
                             <label class="form-label" for="input-1">Upload Evidence</label>
                             <input class="form-control fileInput" type="file" id="fileInput${id}" name="evidancefile${id}[]" multiple>
                             <span class="reqError text-danger valley"></span>
                             <div id="fileList${id}" class="file-list"></div>
                            </div>
                        </div>
                    </div>
                `);
                    } else {
                        console.log(`No matching text found for ID: ${id}`);
                    }
                }
            });
            initializeFileUpload();
        });

        // Dynamically generated checkbox selectors based on adjusted index
        $(document).on('click', 'input[id^="evidence_re-1-0"]', function() {
            // Check the value of the clicked checkbox
            const checkboxId = $(this).attr('id');
            const adjustedIndex = checkboxId.split('-')[1]; // Extract the index from the ID
            var checkboxValue = $(this).val();

            // If the checkbox is checked, show the hep-b message
            if (checkboxValue == 'NSW Health Hepatitis B Vaccination Declaration form' && $(this).prop('checked')) {
                $(".hep-b").show();
            } else {
                $(".hep-b").hide(); // Hide the .hep-b element if not checked
            }

        });

    })

    // Handle change event for dose selection
    function handleDoseChange(selectElement, i) {

        const selectedDose = selectElement.value; // Get selected dose value
        const evidenceRequiredContainer = $(`#evidence_required_container-${i}`);
        const evidenceRequiredDiv = $(`#evidence_div_${i}`);

        // If selected dose is "None", hide evidence section
        if (selectedDose === "None") {
            evidenceRequiredContainer.hide(); // Hide the evidence section
            evidenceRequiredDiv.html(''); // Clear the evidence options
        } else {
            // Show the evidence section
            evidenceRequiredContainer.show();

            // Get the evidence types related to the selected dose
            const evidenceTypes = <?php echo json_encode(DB::table("evidence_type")->where('type', 12)->get()); ?>;

            // Clear previous evidence before appending new ones
            evidenceRequiredDiv.html('');

            // Populate the evidence section dynamically based on the selected dose
            $.each(evidenceTypes, function(index, data) {
                // Ensure that data.dose exists and matches the selected dose
                if (data.dose == selectedDose) { // Use '==' to compare as strings and numbers might differ
                    evidenceRequiredDiv.append(`
                    <input type="radio" id="evidence_re-${index}-${i}" name="evidence_required[${data.type}][]" value="${data.id}">
                    <label for="evidence_re-${index}-${i}">${data.name}</label><br>
                `);
                }
            });

            // If no evidence found, add a message
            if (evidenceRequiredDiv.html() === '') {
                evidenceRequiredDiv.append('<p>No evidence required for this dose.</p>');
            }
        }
    }
    //add remove file in the list of view
    function initializeFileUpload() {
    $(".fileInput").each(function () {
        const fileInput = $(this);
        const fileList = $(`#fileList${fileInput.attr("id").replace("fileInput", "")}`);
        const selectedFiles = new DataTransfer();

        fileInput.off("change").on("change", function (event) {
            Array.from(event.target.files).forEach((file) => {
                selectedFiles.items.add(file);

                // Create a file item container
                const fileDiv = $("<div>").addClass("file-item");

                // Create a link to the file with the file name
                const fileLink = $("<a>")
                    .attr("href", URL.createObjectURL(file))  // Use Blob URL to link the file
                    .attr("target", "_blank")
                    .html(`<i class="fa fa-file" aria-hidden="true"></i> ${file.name}`);

                // Create the close button
                const closeButton = $("<div>").addClass("close_btn close_btn-0").css("cursor", "pointer");
                const closeIcon = $("<i>").addClass("fa fa-close").attr("aria-hidden", "true");

                // Append the close icon to the close button
                closeButton.append(closeIcon);

                // Add event listener to remove the file item when clicked
                closeButton.on("click", function () {
                    for (let i = 0; i < selectedFiles.items.length; i++) {
                        if (selectedFiles.items[i].getAsFile().name === file.name) {
                            selectedFiles.items.remove(i);
                            break;
                        }
                    }
                    fileInput[0].files = selectedFiles.files;

                    // Remove the file div from the list
                    fileDiv.remove();
                });

                // Append the link and close button to the file div
                fileDiv.append(fileLink).append(closeButton);

                // Append the file div to the file list container
                fileList.append(fileDiv);
            });

            // Update the file input with the modified FileList
            fileInput[0].files = selectedFiles.files;
        });
    });
}




    //This will submmit the complete vaccination form
    function vaccinationForm() 
    {
    let isValid = true;

    // Validate Vaccination Name
    $('.vaccination-name').each(function () {
        if ($(this).val().trim() === '') {
            isValid = false;
            $(this).next('.reqError').text('Vaccination name is required');
        } else {
            $(this).next('.reqError').text('');
        }
    });

    // Validate Immunization Status
    $('.immunization-status').each(function () {
        if ($(this).val() === null || $(this).val().trim() === '') {
            isValid = false;
            $(this).next('.reqError').text('Please select an immunization status');
        } else {
            $(this).next('.reqError').text('');
        }
    });

    // Validate Evidence Type
    $('.evidence-type').each(function () {
        if ($(this).val() === null || $(this).val().trim() === '') {
            isValid = false;
            $(this).next('.reqError').text('Please select an evidence type');
        } else {
            $(this).next('.reqError').text('');
        }
    });
    
    $('.evidence-file').each(function () {
        if ($(this).val().trim() === '') {
            isValid = false;
            $(this).next('.reqError').text('Please upload an evidence file');
        } else {
            $(this).next('.reqError').text('');
        }
    });

    // If validation fails, return false to prevent form submission
    if (!isValid) {
        return false;
    }

    //return true;

    $.ajax({
      url: "{{ route('nurse.vaccinationForm') }}",
      type: "POST",
      cache: false,
      contentType: false,
      processData: false,
      data: new FormData($('#vaccination_form')[0]),
      dataType: 'json',
      beforeSend: function() {
        $('#submitVaccination').prop('disabled', true);
        $('#submitVaccination').text('Process....');
      },
      success: function(res) {
        $('#submitVaccination').prop('disabled', false);
        $('#submitVaccination').text('Save Changes');

        if (res.status == '1') {
          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Vaccination Information Updated Successfully',
          }).then(function() {
            window.location.href = "{{ route('nurse.profileVaccination') }}?page=vaccinations";
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
        $('#submitProfession').prop('disabled', false);
        $('#submitProfession').text('Save Changes');
        for (var err in errorss.responseJSON.errors) {
          $("#submitProfession").find("[name='" + err + "']").after("<div class='text-danger'>" + errorss.responseJSON.errors[err] + "</div>");
        }
      }
    });
    return false;
  }

  </script>
@endsection