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

            <div class="">
              

              <div class="tab-pane fade" id="tab-my-jobs" role="tabpanel" aria-labelledby="tab-my-jobs" style="display: none">


                <div class="card shadow-sm border-0 p-4 mt-30">
                  <h3 class="mt-0 color-brand-1 mb-2">Profession</h3>
                  
                  
                  <form id="profession_form" method="POST" >
                    @csrf
                    <div class="condition_set">
                      <div class="form-group drp--clr">
                        <label class="form-label" for="input-1">Type of Nurse?</label>
                        <input type="hidden" name="user_id" class="user_id" value="{{ Auth::guard('nurse_middle')->user()->id }}">
                        <input type="hidden" name="ntype" class="ntype" value="{{ Auth::guard('nurse_middle')->user()->nurseType }}">
                        <ul id="type-of-nurse" style="display:none;">
                          @php $specialty = specialty();$spcl=$specialty[0]->id;@endphp
                          <?php
                          $j = 1;
                          ?>
                          @foreach($specialty as $spl)
                          <li id="nursing_menus-{{ $j }}" data-value="{{ $spl->id }}">{{ $spl->name }}</li>
                          <?php
                          $j++;
                          ?>
                          @endforeach
                        </ul>

                        <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="type-of-nurse" name="nurseType[]" id="nurse_type" multiple="multiple"></select>
                      </div>
                      <span id="reqnurseTypeId" class="reqError text-danger valley"></span>
                    </div>


                    <div class="result--show ">
                      <div class="container p-0">
                        <div class="row g-2">
                          @php $specialty = specialty();$spcl=$specialty[0]->id;@endphp
                          <?php
                          $i = 1;
                          ?>
                          <input type="hidden" name="nursing_result_one" class="nursing_result_one" value="{{ Auth::guard('nurse_middle')->user()->entry_level_nursing }}">
                          <input type="hidden" name="nursing_result_two" class="nursing_result_two" value="{{ Auth::guard('nurse_middle')->user()->registered_nurses }}">
                          <input type="hidden" name="nursing_result_three" class="nursing_result_three" value="{{ Auth::guard('nurse_middle')->user()->advanced_practioner }}">
                          <input type="hidden" name="np_result" class="np_result" value="{{ Auth::guard('nurse_middle')->user()->nurse_prac }}">
                          <input type="hidden" name="specialties_result" class="specialties_result" value="{{ Auth::guard('nurse_middle')->user()->specialties }}">
                          <input type="hidden" name="adults_result" class="adults_result" value="{{ Auth::guard('nurse_middle')->user()->adults }}">
                          <input type="hidden" name="maternity_result" class="maternity_result" value="{{ Auth::guard('nurse_middle')->user()->maternity }}">
                          <input type="hidden" name="padneonatal_result" class="padneonatal_result" value="{{ Auth::guard('nurse_middle')->user()->paediatrics_neonatal }}">
                          <input type="hidden" name="community_result" class="community_result" value="{{ Auth::guard('nurse_middle')->user()->community }}">
                          <input type="hidden" name="surgical_preoperative_result" class="surgical_preoperative_result" value="{{ Auth::guard('nurse_middle')->user()->surgical_preoperative }}">
                          <input type="hidden" name="operatingroom_result" class="operatingroom_result" value="{{ Auth::guard('nurse_middle')->user()->operating_room }}">
                          <input type="hidden" name="operatingscout_result" class="operatingscout_result" value="{{ Auth::guard('nurse_middle')->user()->operating_room_scout }}">
                          <input type="hidden" name="operatingscrub_result" class="operatingscrub_result" value="{{ Auth::guard('nurse_middle')->user()->operating_room_scrub }}">
                          <input type="hidden" name="surgical_ob_result" class="surgical_ob_result" value="{{ Auth::guard('nurse_middle')->user()->surgical_obstrics_gynacology }}">
                          <input type="hidden" name="neonatal_care_result" class="neonatal_care_result" value="{{ Auth::guard('nurse_middle')->user()->neonatal_care }}">
                          <input type="hidden" name="paedia_surgical_result" class="paedia_surgical_result" value="{{ Auth::guard('nurse_middle')->user()->paedia_surgical_preoperative }}">
                          <input type="hidden" name="pad_op_room_result" class="pad_op_room_result" value="{{ Auth::guard('nurse_middle')->user()->pad_op_room }}">
                          <input type="hidden" name="pad_qr_scout_result" class="pad_qr_scout_result" value="{{ Auth::guard('nurse_middle')->user()->pad_qr_scout }}">
                          <input type="hidden" name="pad_qr_scrub_result" class="pad_qr_scrub_result" value="{{ Auth::guard('nurse_middle')->user()->pad_qr_scrub }}">
                          <input type="hidden" name="nurse_degree" class="nurse_degree" value="{{ Auth::guard('nurse_middle')->user()->degree }}">
                          @foreach($specialty as $spl)
                          <?php
                          $nursing_data = DB::table("practitioner_type")->where('parent', $spl->id)->orderBy('name')->get();
                          ?>
                          <input type="hidden" name="nursing_result" class="nursing_result-{{ $i }}" value="{{ $spl->id }}">
                          <div class="nursing_data form-group drp--clr col-md-4 d-none drpdown-set nursing_{{ $spl->id }}" id="nursing_level-{{ $i }}">
                            <label class="form-label" for="input-2">{{ $spl->name }}</label>
                            <ul id="nursing_entry-{{ $i }}" style="display:none;">
                              @foreach($nursing_data as $nd)
                              <li data-value="{{ $nd->id }}">{{ $nd->name }}</li>

                              @endforeach
                              <!-- Add more list items as needed -->
                            </ul>
                            <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="nursing_entry-{{ $i }}" name="nursing_type_{{ $i }}[]" multiple="multiple"></select>
                          </div>
                          <?php
                          $i++;
                          ?>
                          @endforeach
                        </div>

                      </div>
                    </div>
                    <div class="np_submenu d-none">

                      <div class="form-group drp--clr">
                        <?php
                        $np_data = DB::table("practitioner_type")->where('parent', '179')->get();
                        ?>

                        <label class="form-label" for="input-1">Nurse Practitioner (NP):</label>
                        <ul id="nurse_practitioner_menu" style="display:none;">
                          @foreach($np_data as $nd)
                          <li data-value="{{ $nd->id }}">{{ $nd->name }}</li>
                          @endforeach

                        </ul>
                        <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="nurse_practitioner_menu" name="nurse_practitioner_menu[]" multiple="multiple"></select>

                      </div>

                    </div>
                    <div class="condition_set">
                      <div class="form-group drp--clr">
                        <input type="hidden" name="sub_speciality_value" class="sub_speciality_value" value="">
                        <label class="form-label" for="input-1">Specialties</label>
                        <ul id="specialties" style="display:none;">
                          @php $JobSpecialties = JobSpecialties(); @endphp
                          <?php
                          $k = 1;
                          ?>
                          @foreach($JobSpecialties as $ptl)
                          <li id="nursing_menus-{{ $k }}" data-value="{{ $ptl->id }}">{{ $ptl->name }}</li>
                          <?php
                          $k++;
                          ?>
                          @endforeach

                        </ul>
                        <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="specialties" name="specialties[]" multiple="multiple"></select>
                      </div>
                      <span id="reqspecialties" class="reqError text-danger valley"></span>
                    </div>
                    <div class="speciality_boxes row result--show">
                      <?php
                      $l = 1;
                      ?>
                      @foreach($JobSpecialties as $ptl)
                      <?php
                      $speciality_data = DB::table("speciality")->where('parent', $ptl->id)->get();
                      ?>
                      <input type="hidden" name="speciality_result" class="speciality_result-{{ $l }}" value="{{ $ptl->id }}">
                      <div class="speciality_data form-group drp--clr drpdown-set d-none col-md-6 speciality_{{ $ptl->id }}" id="specility_level-{{ $l }}">
                        <label class="form-label" for="input-2">{{ $ptl->name }}</label>
                        <ul id="speciality_entry-{{ $l }}" style="display:none;">
                          @foreach($speciality_data as $sd)
                          <li data-value="{{ $sd->id }}">{{ $sd->name }}</li>

                          @endforeach
                          <!-- Add more list items as needed -->
                        </ul>
                        <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="speciality_entry-{{ $l }}" name="speciality_entry_{{ $l }}[]" multiple="multiple"></select>
                      </div>
                      <?php
                      $l++;
                      ?>
                      @endforeach
                    </div>
                    <div class="surgical_div">

                      <div class="surgical_row_data form-group drp--clr d-none col-md-12">
                        <label class="form-label" for="input-1">Surgical Preoperative and Postoperative Care:</label>
                        <?php
                        $speciality_surgicalrow_data = DB::table("speciality")->where('parent', '96')->get();
                        $r = 1;
                        ?>
                        <ul id="surgical_row_box" style="display:none;">
                          @foreach($speciality_surgicalrow_data as $ssrd)
                          <li data-value="{{ $ssrd->id }}">{{ $ssrd->name }}</li>
                          @endforeach
                        </ul>
                        <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="surgical_row_box" name="surgical_row_box[]" multiple="multiple"></select>
                      </div>
                    </div>
                    <div class="paediatric_surgical_div">

                      <div class="surgicalpad_row_data form-group drp--clr d-none col-md-12">
                        <label class="form-label" for="input-1">Paediatric Surgical Preop. and Postop. Care:
                        </label>
                        <?php
                        $speciality_padsurgicalrow_data = DB::table("speciality")->where('parent', '285')->get();
                        $r = 1;
                        ?>
                        <ul id="surgical_rowpad_box" style="display:none;">
                          @foreach($speciality_padsurgicalrow_data as $ssrd)
                          <li data-value="{{ $ssrd->id }}">{{ $ssrd->name }}</li>
                          @endforeach
                        </ul>
                        <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="surgical_rowpad_box" name="surgical_rowpad_box[]" multiple="multiple"></select>
                      </div>
                    </div>
                    
                    
                    

                    
                    
                    
                    
                    
                    
                    
                  </form>
                </div>



              </div>

              <div class="tab-pane fade" id="tab-educert" role="tabpanel" aria-labelledby="tab-educert" style="display: none">
                <div class="card shadow-sm border-0 p-4 mt-30">
                  <h3 class="mt-0 color-brand-1 mb-20">Education and Certifications</h3>
                  <h6 class="emergency_text">
                    Educational Background
                  </h6>
                  <form id="educert_form" method="POST" novalidate onsubmit="return educert()">
                    @csrf
                    <?php
                    $educationData = DB::table("user_education_cerification")->where("user_id", Auth::guard('nurse_middle')->user()->id)->first();

                    if ($educationData && $educationData->acls_data) {
                      $acls_data1 = json_decode($educationData->acls_data);
                      $a_data_arr = array();
                      foreach ($acls_data1 as $a_data) {
                        $a_data_arr[] = $a_data->acls_certification_id;
                      }
                      $a_data_json = json_encode($a_data_arr);
                    } else {
                      $acls_data1 = "";
                      $a_data_json = "";
                    }

                    if ($educationData && $educationData->bls_data) {
                      $bls_data1 = json_decode($educationData->bls_data);
                      $b_data_arr = array();
                      foreach ($bls_data1 as $b_data) {
                        $b_data_arr[] = $b_data->bls_certification_id;
                      }
                      $b_data_json = json_encode($b_data_arr);
                    } else {
                      $bls_data1 = "";
                      $b_data_json = "";
                    }

                    if ($educationData && $educationData->cpr_data) {
                      $cpr_data1 = json_decode($educationData->cpr_data);
                      $c_data_arr = array();
                      foreach ($cpr_data1 as $c_data) {
                        $c_data_arr[] = $c_data->cpr_certification_id;
                      }
                      $c_data_json = json_encode($c_data_arr);
                    } else {
                      $cpr_data1 = "";
                      $c_data_json = "";
                    }

                    if ($educationData && $educationData->nrp_data) {
                      $nrp_data1 = json_decode($educationData->nrp_data);
                      $n_data_arr = array();
                      foreach ($nrp_data1 as $n_data) {
                        $n_data_arr[] = $n_data->nrp_certification_id;
                      }
                      $n_data_json = json_encode($n_data_arr);
                    } else {
                      $nrp_data1 = "";
                      $n_data_json = "";
                    }

                    if ($educationData && $educationData->pals_data) {
                      $pls_data1 = json_decode($educationData->pals_data);
                      $p_data_arr = array();
                      foreach ($pls_data1 as $p_data) {
                        $p_data_arr[] = $p_data->pls_certification_id;
                      }
                      $p_data_json = json_encode($p_data_arr);
                    } else {
                      $pls_data1 = "";
                      $p_data_json = "";
                    }

                    if ($educationData && $educationData->rn_data) {
                      $rn_data1 = json_decode($educationData->rn_data);
                      $r_data_arr = array();
                      foreach ($rn_data1 as $r_data) {
                        $r_data_arr[] = $r_data->rn_certification_id;
                      }
                      $r_data_json = json_encode($r_data_arr);
                    } else {
                      $rn_data1 = "";
                      $r_data_json = "";
                    }

                    if ($educationData && $educationData->np_data) {
                      $np_data1 = json_decode($educationData->np_data);
                      $n_data_arr = array();
                      foreach ($np_data1 as $n_data) {
                        $n_data_arr[] = $n_data->np_certification_id;
                      }
                      $np_data_json = json_encode($n_data_arr);
                    } else {
                      $np_data1 = "";
                      $np_data_json = "";
                    }

                    if ($educationData && $educationData->cna_data) {
                      $cna_data1 = json_decode($educationData->cna_data);
                      $cn_data_arr = array();
                      foreach ($cna_data1 as $cn_data) {
                        $cn_data_arr[] = $cn_data->cn_certification_id;
                      }
                      $cna_data_json = json_encode($cn_data_arr);
                    } else {
                      $cna_data1 = "";
                      $cna_data_json = "";
                    }

                    if ($educationData && $educationData->lpn_data) {
                      $lpn_data1 = json_decode($educationData->lpn_data);
                      $lpn_data_arr = array();
                      foreach ($lpn_data1 as $lpn_data) {
                        $lpn_data_arr[] = $lpn_data->lpn_certification_id;
                      }
                      $lpn_data_json = json_encode($lpn_data_arr);
                    } else {
                      $lpn_data1 = "";
                      $lpn_data_json = "";
                    }

                    if ($educationData && $educationData->crna_data) {
                      $crna_data1 = json_decode($educationData->crna_data);
                      $crna_data_arr = array();
                      foreach ($crna_data1 as $crna_data) {
                        $crna_data_arr[] = $crna_data->crna_certification_id;
                      }
                      $crna_data_json = json_encode($crna_data_arr);
                    } else {
                      $crna_data1 = "";
                      $crna_data_json = "";
                    }

                    if ($educationData && $educationData->cnm_data) {
                      $cnm_data1 = json_decode($educationData->cnm_data);
                      $cnm_data_arr = array();
                      foreach ($cnm_data1 as $cnm_data) {
                        $cnm_data_arr[] = $cnm_data->cnm_certification_id;
                      }
                      $cnm_data_json = json_encode($cnm_data_arr);
                    } else {
                      $cnm_data1 = "";
                      $cnm_data_json = "";
                    }

                    if ($educationData && $educationData->ons_data) {
                      $ons_data1 = json_decode($educationData->ons_data);
                      $ons_data_arr = array();
                      foreach ($ons_data1 as $ons_data) {
                        $ons_data_arr[] = $ons_data->ons_certification_id;
                      }
                      $ons_data_json = json_encode($ons_data_arr);
                    } else {
                      $ons_data1 = "";
                      $ons_data_json = "";
                    }

                    if ($educationData && $educationData->msw_data) {
                      $msw_data1 = json_decode($educationData->msw_data);
                      $msw_data_arr = array();
                      foreach ($msw_data1 as $msw_data) {
                        $msw_data_arr[] = $msw_data->msw_certification_id;
                      }
                      $msw_data_json = json_encode($msw_data_arr);
                    } else {
                      $msw_data1 = "";
                      $msw_data_json = "";
                    }

                    if ($educationData && $educationData->ain_data) {
                      $ain_data1 = json_decode($educationData->ain_data);
                      $ain_data_arr = array();
                      foreach ($ain_data1 as $ain_data) {
                        $ain_data_arr[] = $ain_data->ain_certification_id;
                      }
                      $ain_data_json = json_encode($ain_data_arr);
                    } else {
                      $ain_data1 = "";
                      $ain_data_json = "";
                    }

                    if ($educationData && $educationData->rpn_data) {
                      $rpn_data1 = json_decode($educationData->rpn_data);
                      $rpn_data_arr = array();
                      foreach ($rpn_data1 as $rpn_data) {
                        $rpn_data_arr[] = $rpn_data->rpn_certification_id;
                      }
                      $rpn_data_json = json_encode($rpn_data_arr);
                    } else {
                      $rpn_data1 = "";
                      $rpn_data_json = "";
                    }

                    if ($educationData && $educationData->nl_data) {
                      $nl_data_new = $educationData->nl_data;
                    } else {

                      $nl_data_new = "";
                    }

                    ?>
                    <div class="form-group">
                      <div class="" id="mid_select">
                        <div class="form-group drp--clr drpdown-set">
                          <input type="hidden" name="user_id" value="{{ Auth::guard('nurse_middle')->user()->id }}">
                          <input type="hidden" name="nurse_degree_one" class="nurse_degree_one" value="{{ Auth::guard('nurse_middle')->user()->degree }}">
                          <label class="form-label" for="input-1">Nurse & Midwife degree</label>
                          <?php
                          $nurse_midwife_degree = DB::table("degree")->where('status', '1')->orderBy('name')->get();
                          ?>
                          <ul id="ndegree" style="display:none;">
                            @foreach($nurse_midwife_degree as $ptl)
                            <li data-value="{{ $ptl->id }}">{{ $ptl->name }}</li>

                            @endforeach
                          </ul>
                          <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="ndegree" name="ndegree[]" multiple="multiple"></select>
                        </div>
                        <span id="reqdegree" class="reqError text-danger valley"></span>
                      </div>
                    </div>

                    <div class="form-group level-drp">
                      <label class="form-label" for="input-1">Institutions (Please start with the most relevant)</label>
                      <input class="form-control" type="text" name="institution" value="@if(!empty($educationData)){{ $educationData->institution }}@endif">
                      <span id="reqinstitute" class="reqError text-danger valley"></span>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group level-drp">
                          <label class="form-label" for="input-1">Graduation Date</label>
                          <input class="form-control graduation_start_date" type="date" name="graduation_start_date" value="@if(!empty($educationData)){{ $educationData->graduate_start_date }}@endif" onchange="changeDate(event);">
                          <span id="reqstartdate" class="reqError text-danger valley"></span>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group level-drp">
                          <label class="form-label" for="input-1">Upload Degree & Transcript</label>
                          <?php
                          $user_id = Auth::guard('nurse_middle')->user()->id;
                          ?>
                          <input class="form-control degree_transcript" type="file" name="degree_transcript[]" onchange="changeImg('{{ $user_id }}')" multiple="">
                          <div class="degree_transcript_imgs">
                            @if(!empty($educationData) && $educationData->degree_transcript)
                            <?php
                            $dtran_img = json_decode($educationData->degree_transcript);
                            //print_r($dtran_img);
                            $i = 1;
                            $user_id = Auth::guard('nurse_middle')->user()->id;
                            ?>

                            @if(!empty($dtran_img))
                            @foreach($dtran_img as $tranimg)
                            <div class="trans_img trans_img-{{ $i }}">
                              <a href="{{ url('/public/uploads/education_degree') }}/{{ $tranimg }}" target="_blank"><i class="fa fa-file"></i>{{ $tranimg }}</a>
                              <div class="close_btn close_btn-{{ $i }}" onclick="deleteImg('{{ $i }}','{{ $user_id }}','{{ $tranimg }}')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
                            </div>
                            <?php
                            $i++;
                            ?>
                            @endforeach
                            @endif

                            @endif
                          </div>
                          <span id="reqdegreetranscript" class="reqError text-danger valley"></span>
                        </div>
                      </div>

                    </div>
                    <h6 class="emergency_text">
                      General Certifications/Licences:
                    </h6>
                    <div class="form-group level-drp">
                      <input type="hidden" name="prof_cert_new" class="prof_cert_new" value="@if(!empty($educationData)){{ $educationData->professional_certifications }}@endif">
                      <label class="form-label" for="input-1">Please select all that apply</label>
                      <?php
                      $certificates = DB::table("professional_certificate")->orderBy("ordering_id", "asc")->get();
                      ?>
                      <ul id="profess_cert" style="display:none;">
                        @foreach($certificates as $cert)
                        <li data-value="{{ $cert->id }}">{{ $cert->name }}</li>
                        @endforeach

                      </ul>
                      <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="profess_cert" name="professional_certification[]" multiple="multiple"></select>
                    </div>
                    <span id="reqcertificate" class="reqError text-danger valley"></span>
                    <?php
                    $education_data = DB::table("user_education_cerification")->where("user_id", Auth::guard('nurse_middle')->user()->id)->first();
                    //echo $education_data->acls_data;
                    ?>
                    <div class="professional_certification_div">


                      <div class="form-group level-drp @if($educationData && $educationData->acls_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdiv">
                        <input type="hidden" name="pro_cert_acls" class="pro_cert_acls" value="@if(!empty($educationData)){{ $a_data_json }}@endif">
                        <label class="form-label" for="input-1">ACLS (Advanced Cardiovascular Life Support)</label>
                        <?php
                        $acls_data = DB::table("professional_certificate_table")->where("cert_id", "6")->get();
                        ?>
                        <ul id="acls_data" style="display:none;">
                          @foreach($acls_data as $data)
                          <li data-value="{{ $data->name }}">{{ $data->name }}</li>
                          @endforeach

                        </ul>
                        <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="acls_data" name="acls_data[]" multiple="multiple"></select>
                        <span id="reqaclsvalid" class="reqError text-danger valley"></span>
                      </div>

                      <div class="acls_certification_div">
                        <?php
                        $i = 0;
                        ?>
                        @if(!empty($acls_data1))
                        @foreach($acls_data1 as $a_data)
                        <?php
                        $acls_first_word = strtok($a_data->acls_certification_id, " ");;

                        $acls_first_word_one = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $acls_first_word));
                        ?>

                        <div class="acls_{{ $acls_first_word_one }}">
                          <h6>{{ $a_data->acls_certification_id }}</h6>
                          <div class="license_number_div row license_number_acls">

                            <div class="form-group col-md-6">
                              <label class="form-label" for="input-1">Certification/Licence Number</label>
                              <input type="hidden" name="aclsnamearr[]" class="acls_input_{{ $a_data->acls_certification_id }}" value="{{ $a_data->acls_certification_id }}">
                              <input class="form-control acls_license_number acls_license_number-{{ $i }}" type="text" name="acls_license_number[]" value="{{ $a_data->acls_license_number }}">
                              <span id="reqaclslicencevalid-{{ $i }}" class="reqError text-danger valley"></span>
                            </div>
                            <div class="form-group col-md-6">
                              <label class="form-label" for="input-1">Expiry</label>
                              <input class="form-control aclsexpiry aclsexpiry-{{ $i }}" type="date" name="acls_expiry[]" value="{{ $a_data->acls_expiry }}">
                              <span id="reqaclsexpiryvalid-{{ $i }}" class="reqError text-danger valley"></span>
                            </div>
                            <div class="form-group col-md-6">
                              <label class="form-label" for="input-1">Upload your certification/Licence</label>
                              <input class="form-control acls_imgs_{{ $acls_first_word_one }} acls_upload_certification-{{ $i }}" type="file" name="acls_upload_certification[{{ $i }}][]" onchange="changeImg1('{{ $user_id }}','{{ $i }}','acls_imgs','{{ $acls_first_word_one }}')" multiple="">
                              <span id="reqaclsuploadvalid-{{ $i }}" class="reqError text-danger valley"></span>
                              <?php
                              $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();

                              if (!empty($getedufieldsdata)) {
                                $acls_img = (array)json_decode($getedufieldsdata->acls_imgs);
                              } else {
                                $acls_img = '';
                              }


                              if (!empty($acls_img)) {
                                $acls_img_data = json_decode($acls_img[$acls_first_word_one]);
                              } else {
                                $acls_img_data = "";
                              }
                              //print_r($acls_img[$acls_first_word_one]);


                              //print_r($dtran_img);
                              $l = 1;
                              $user_id = Auth::guard('nurse_middle')->user()->id;
                              ?>
                              <div class="acls_imgs{{ $acls_first_word_one }}">
                                @if(!empty($acls_img_data))
                                @foreach($acls_img_data as $tranimg)
                                <div class="trans_img trans_img-{{ $i }} trans_imgacls_imgs{{ $acls_first_word_one }}{{ $l }}">
                                  <a href="{{ url('/public/uploads/education_degree') }}/{{ $tranimg }}"><i class="fa fa-file"></i>{{ $tranimg }}</a>
                                  <div class="close_btn close_btn-{{ $i }}" onclick="deleteImg1('{{ $l }}','{{ $user_id }}','{{ $tranimg }}','{{ $acls_first_word_one }}','acls_imgs')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
                                </div>
                                <?php
                                $l++;
                                ?>
                                @endforeach
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php
                        $i++;
                        ?>
                        @endforeach
                        @endif
                      </div>

                      <div class="form-group level-drp  @if($education_data && $education_data->bls_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdivone">
                        <input type="hidden" name="pro_cert_bls" class="pro_cert_bls" value="@if(!empty($educationData)){{ $b_data_json }}@endif">
                        <label class="form-label" for="input-1">BLS (Basic Life Support)</label>
                        <?php
                        $bls_data = DB::table("professional_certificate_table")->where("cert_id", "7")->get();
                        ?>
                        <ul id="bls_data" style="display:none;">
                          @foreach($bls_data as $data)
                          <li data-value="{{ $data->name }}">{{ $data->name }}</li>
                          @endforeach

                        </ul>
                        <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="bls_data" name="bls_data[]" multiple="multiple"></select>
                        <span id="reqblsvalid" class="reqError text-danger valley"></span>
                      </div>

                      <div class="bls_certification_div">
                        @if(!empty($bls_data1))
                        <?php
                        $i = 0;
                        ?>
                        @foreach($bls_data1 as $b_data)
                        <?php
                        $bls_first_word = strtok($b_data->bls_certification_id, " ");;

                        $bls_first_word_one = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $bls_first_word));
                        ?>

                        <div class="bls_{{ $bls_first_word_one }}">
                          <h6>{{ $b_data->bls_certification_id }}</h6>
                          <div class="license_number_div row license_number_bls">

                            <div class="form-group col-md-6">
                              <label class="form-label" for="input-1">Certification/Licence Number</label>
                              <input type="hidden" name="blsnamearr[]" class="bls_input_{{ $b_data->bls_certification_id }}" value="{{ $b_data->bls_certification_id }}">
                              <input class="form-control bls_license_number bls_license_number-{{ $i }}" type="text" name="bls_license_number[]" value="{{ $b_data->bls_license_number }}">
                              <span id="reqblslicencevalid-{{ $i }}" class="reqError text-danger valley"></span>
                            </div>
                            <div class="form-group col-md-6">
                              <label class="form-label" for="input-1">Expiry</label>
                              <input class="form-control blsexpiry blsexpiry-{{ $i }}" type="date" name="bls_expiry[]" value="{{ $b_data->bls_expiry }}">
                              <span id="reqblsexpiryvalid-{{ $i }}" class="reqError text-danger valley"></span>
                            </div>
                            <div class="form-group col-md-6">
                              <label class="form-label" for="input-1">Upload your certification/Licence</label>
                              <input class="form-control degree_transcript bls_imgs_{{ $bls_first_word_one }} bls_upload_certification bls_upload_certification-{{ $i }}" type="file" name="bls_upload_certification[{{ $i }}][]" onchange="changeImg1('{{ $user_id }}','{{ $i }}','bls_imgs','{{ $bls_first_word_one }}')" multiple="">
                              <span id="reqblsuploadvalid-{{ $i }}" class="reqError text-danger valley"></span>
                              <?php
                              $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();

                              if (!empty($getedufieldsdata)) {
                                $bls_img = (array)json_decode($getedufieldsdata->bls_imgs);
                              } else {
                                $bls_img = '';
                              }


                              if (!empty($bls_img)) {
                                $bls_img_data = json_decode($bls_img[$bls_first_word_one]);
                              } else {
                                $bls_img_data = "";
                              }
                              //print_r($acls_img[$acls_first_word_one]);


                              //print_r($dtran_img);
                              $l = 1;
                              $user_id = Auth::guard('nurse_middle')->user()->id;
                              ?>
                              <div class="bls_imgs{{ $bls_first_word_one }}">
                                @if(!empty($bls_img_data))
                                @foreach($bls_img_data as $tranimg)
                                <div class="trans_img trans_img-{{ $i }} trans_imgbls_imgs{{ $bls_first_word_one }}{{ $l }}">
                                  <a href="{{ url('/public/uploads/education_degree') }}/{{ $tranimg }}"><i class="fa fa-file"></i>{{ $tranimg }}</a>
                                  <div class="close_btn close_btn-{{ $i }}" onclick="deleteImg1('{{ $l }}','{{ $user_id }}','{{ $tranimg }}','{{ $bls_first_word_one }}','bls_imgs')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
                                </div>

                                <?php
                                $l++;
                                ?>
                                @endforeach
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php
                        $i++;
                        ?>
                        @endforeach
                        @endif
                      </div>
                      <div class="form-group level-drp @if($education_data && $education_data->cpr_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdivtwo">
                        <input type="hidden" name="pro_cert_cpr" class="pro_cert_cpr" value="@if(!empty($educationData)){{ $c_data_json }}@endif">
                        <label class="form-label" for="input-1">CPR (Cardiopulmonary Resuscitation)</label>
                        <?php
                        $cpr_data = DB::table("professional_certificate_table")->where("cert_id", "8")->get();
                        ?>
                        <ul id="cpr_data" style="display:none;">
                          @foreach($cpr_data as $data)
                          <li data-value="{{ $data->name }}">{{ $data->name }}</li>
                          @endforeach

                        </ul>
                        <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="cpr_data" name="cpr_data[]" multiple="multiple"></select>
                        <span id="reqcprvalid" class="reqError text-danger valley"></span>
                      </div>

                      <div class="cpr_certification_div">
                        @if(!empty($cpr_data1))
                        <?php
                        $i = 0;
                        ?>
                        @foreach($cpr_data1 as $c_data)
                        <?php
                        $cpr_first_word = strtok($c_data->cpr_certification_id, " ");;

                        $cpr_first_word_one = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $cpr_first_word));
                        ?>

                        <div class="cpr_{{ $cpr_first_word_one }}">
                          <h6>{{ $c_data->cpr_certification_id }}</h6>
                          <div class="license_number_div row license_number_cpr">

                            <div class="form-group col-md-6">
                              <label class="form-label" for="input-1">Certification/Licence Number</label>
                              <input type="hidden" name="cprnamearr[]" class="cpr_input_{{ $c_data->cpr_certification_id }}" value="{{ $c_data->cpr_certification_id }}">
                              <input class="form-control cpr_license_number cpr_license_number-{{ $i }}" type="text" name="cpr_license_number[]" value="{{ $c_data->cpr_license_number }}">
                              <span id="reqcprlicencevalid-{{ $i }}" class="reqError text-danger valley"></span>
                            </div>
                            <div class="form-group col-md-6">
                              <label class="form-label" for="input-1">Expiry</label>
                              <input class="form-control cprexpiry cprexpiry-{{ $i }}" type="date" name="cpr_expiry[]" value="{{ $c_data->cpr_expiry }}">
                              <span id="reqcprexpiryvalid-{{ $i }}" class="reqError text-danger valley"></span>
                            </div>
                            <div class="form-group col-md-6">
                              <label class="form-label" for="input-1">Upload your certification/Licence</label>
                              <input class="form-control degree_transcript cpr_imgs_{{ $cpr_first_word_one }} cpr_upload_certification cpr_upload_certification-{{ $i }}" type="file" name="cpr_upload_certification[{{ $i }}][]" onchange="changeImg1('{{ $user_id }}','{{ $i }}','cpr_imgs','{{ $cpr_first_word_one }}')" multiple>
                              <span id="reqcpruploadvalid-{{ $i }}" class="reqError text-danger valley"></span>
                              <?php
                              $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();

                              if (!empty($getedufieldsdata)) {
                                $cpr_img = (array)json_decode($getedufieldsdata->cpr_imgs);
                              } else {
                                $cpr_img = '';
                              }



                              if (!empty($cpr_img)) {
                                $cpr_img_data = json_decode($cpr_img[$cpr_first_word_one]);
                              } else {
                                $cpr_img_data = "";
                              }
                              //print_r($acls_img[$acls_first_word_one]);


                              //print_r($dtran_img);
                              $l = 1;
                              $user_id = Auth::guard('nurse_middle')->user()->id;
                              ?>
                              <div class="cpr_imgs{{ $cpr_first_word_one }}">
                                @if(!empty($cpr_img_data))
                                @foreach($cpr_img_data as $tranimg)
                                <div class="trans_img trans_img-{{ $i }} trans_imgcpr_imgs{{ $cpr_first_word_one }}{{ $l }}">
                                  <a href="{{ url('/public/uploads/education_degree') }}/{{ $tranimg }}"><i class="fa fa-file"></i>{{ $tranimg }}</a>
                                  <div class="close_btn close_btn-{{ $i }}" onclick="deleteImg1('{{ $l }}','{{ $user_id }}','{{ $tranimg }}','{{ $cpr_first_word_one }}','cpr_imgs')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
                                </div>

                                <?php
                                $l++;
                                ?>
                                @endforeach
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php
                        $i++;
                        ?>
                        @endforeach
                        @endif
                      </div>
                      <div class="form-group level-drp @if($education_data && $education_data->nrp_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdivthree">
                        <input type="hidden" name="pro_cert_nrp" class="pro_cert_nrp" value="@if(!empty($educationData)){{ $n_data_json }}@endif">
                        <label class="form-label" for="input-1">NRP (Neonatal Resuscitation Program)</label>
                        <?php
                        $nrp_data = DB::table("professional_certificate_table")->where("cert_id", "9")->get();
                        ?>
                        <ul id="nrp_data" style="display:none;">
                          @foreach($nrp_data as $data)
                          <li data-value="{{ $data->name }}">{{ $data->name }}</li>
                          @endforeach

                        </ul>
                        <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="nrp_data" name="nrp_data[]" multiple="multiple"></select>
                        <span id="reqnrpvalid" class="reqError text-danger valley"></span>
                      </div>

                      <div class="nrp_certification_div">
                        @if(!empty($nrp_data1))
                        <?php
                        $i = 0;
                        ?>
                        @foreach($nrp_data1 as $n_data)
                        <?php
                        $nrp_first_word = strtok($n_data->nrp_certification_id, " ");;

                        $nrp_first_word_one = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $nrp_first_word));
                        ?>

                        <div class="nrp_{{ $nrp_first_word_one }}">
                          <h6>{{ $n_data->nrp_certification_id }}</h6>
                          <div class="license_number_div row license_number_nrp">

                            <div class="form-group col-md-6">
                              <label class="form-label" for="input-1">Certification/Licence Number</label>
                              <input type="hidden" name="nrpnamearr[]" class="nrp_input_{{ $n_data->nrp_certification_id }}" value="{{ $n_data->nrp_certification_id }}">
                              <input class="form-control nrp_license_number nrp_license_number-{{ $i }}" type="text" name="nrp_license_number[]" value="{{ $n_data->nrp_license_number }}">
                              <span id="reqnrplicencevalid-{{ $i }}" class="reqError text-danger valley"></span>
                            </div>
                            <div class="form-group col-md-6">
                              <label class="form-label" for="input-1">Expiry</label>
                              <input class="form-control nrpexpiry nrpexpiry-{{ $i }}" type="date" name="nrp_expiry[]" value="{{ $n_data->nrp_expiry }}">
                              <span id="reqnrpexpiryvalid-{{ $i }}" class="reqError text-danger valley"></span>
                            </div>
                            <div class="form-group col-md-6">
                              <label class="form-label" for="input-1">Upload your certification/Licence</label>
                              <input class="form-control degree_transcript nrp_imgs_{{ $nrp_first_word_one }} nrp_upload_certification nrp_upload_certification-{{ $i }}" type="file" name="nrp_upload_certification[{{ $i }}][]" onchange="changeImg1('{{ $user_id }}','{{ $i }}','nrp_imgs','{{ $nrp_first_word_one }}')" multiple="">
                              <span id="reqnrpuploadvalid-{{ $i }}" class="reqError text-danger valley"></span>
                              <?php
                              $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();

                              if (!empty($getedufieldsdata)) {
                                $nrp_img = (array)json_decode($getedufieldsdata->nrp_imgs);
                              } else {
                                $nrp_img = '';
                              }

                              if (!empty($nrp_img)) {
                                $nrp_img_data = json_decode($nrp_img[$nrp_first_word_one]);
                              } else {
                                $nrp_img_data = "";
                              }
                              //print_r($acls_img[$acls_first_word_one]);


                              //print_r($dtran_img);
                              $l = 1;
                              $user_id = Auth::guard('nurse_middle')->user()->id;
                              ?>
                              <div class="nrp_imgs{{ $nrp_first_word_one }}">
                                @if(!empty($nrp_img_data))
                                @foreach($nrp_img_data as $tranimg)
                                <div class="trans_img trans_img-{{ $i }} trans_imgnrp_imgs{{ $nrp_first_word_one }}{{ $l }}">
                                  <a href="{{ url('/public/uploads/education_degree') }}/{{ $tranimg }}"><i class="fa fa-file"></i>{{ $tranimg }}</a>
                                  <div class="close_btn close_btn-{{ $i }}" onclick="deleteImg1('{{ $l }}','{{ $user_id }}','{{ $tranimg }}','{{ $nrp_first_word_one }}','nrp_imgs')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
                                </div>
                                <?php
                                $l++;
                                ?>
                                @endforeach
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php
                        $i++;
                        ?>
                        @endforeach
                        @endif
                      </div>
                      <div class="form-group level-drp @if($education_data && $education_data->pals_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdivfour">
                        <input type="hidden" name="pro_cert_pals" class="pro_cert_pals" value="@if(!empty($educationData)){{ $p_data_json }}@endif">
                        <label class="form-label" for="input-1">PALS (Pediatric Advanced Life Support)</label>
                        <?php
                        $pls_data = DB::table("professional_certificate_table")->where("cert_id", "10")->get();
                        ?>
                        <ul id="pls_data" style="display:none;">
                          @foreach($pls_data as $data)
                          <li data-value="{{ $data->name }}">{{ $data->name }}</li>
                          @endforeach

                        </ul>
                        <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="pls_data" name="pls_data[]" multiple="multiple"></select>
                        <span id="reqplsvalid" class="reqError text-danger valley"></span>
                      </div>
                      <div class="pls_certification_div">
                        @if(!empty($pls_data1))
                        <?php
                        $i = 0;
                        ?>
                        @foreach($pls_data1 as $p_data)
                        <?php
                        $pls_first_word = strtok($p_data->pls_certification_id, " ");;

                        $pls_first_word_one = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $pls_first_word));
                        ?>

                        <div class="pls_{{ $pls_first_word_one }}">
                          <h6>{{ $p_data->pls_certification_id }}</h6>
                          <div class="license_number_div row license_number_pls">

                            <div class="form-group col-md-6">
                              <label class="form-label" for="input-1">Certification/Licence Number</label>
                              <input type="hidden" name="plsnamearr[]" class="pls_input_{{ $p_data->pls_certification_id }}" value="{{ $p_data->pls_certification_id }}">
                              <input class="form-control pls_license_number pls_license_number-{{ $i }}" type="text" name="pls_license_number[]" value="{{ $p_data->pls_license_number }}">
                              <span id="reqplslicencevalid-{{ $i }}" class="reqError text-danger valley"></span>
                            </div>
                            <div class="form-group col-md-6">
                              <label class="form-label" for="input-1">Expiry</label>
                              <input class="form-control plsexpiry plsexpiry-{{ $i }}" type="date" name="pls_expiry[]" value="{{ $p_data->pls_expiry }}">
                            </div>
                            <div class="form-group col-md-6">
                              <label class="form-label" for="input-1">Upload your certification/Licence</label>
                              <input class="form-control degree_transcript pls_imgs_{{ $pls_first_word_one }} pls_upload_certification pls_upload_certification-{{ $i }}" type="file" name="pls_upload_certification[{{ $i }}][]" onchange="changeImg1('{{ $user_id }}','{{ $i }}','pls_imgs','{{ $pls_first_word_one }}')" multiple="">
                              <?php
                              $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();

                              if (!empty($getedufieldsdata)) {
                                $pls_img = (array)json_decode($getedufieldsdata->pls_imgs);
                              } else {
                                $pls_img = '';
                              }

                              if (!empty($pls_img)) {
                                $pls_img_data = json_decode($pls_img[$pls_first_word_one]);
                              } else {
                                $pls_img_data = "";
                              }
                              //print_r($acls_img[$acls_first_word_one]);


                              //print_r($dtran_img);
                              $l = 1;
                              $user_id = Auth::guard('nurse_middle')->user()->id;
                              ?>
                              <div class="pls_imgs{{ $pls_first_word_one }}">
                                @if(!empty($pls_img_data))
                                @foreach($pls_img_data as $tranimg)
                                <div class="trans_img trans_img-{{ $i }} trans_imgpls_imgs{{ $pls_first_word_one }}{{ $l }}">
                                  <a href="{{ url('/public/uploads/education_degree') }}/{{ $tranimg }}"><i class="fa fa-file"></i>{{ $tranimg }}</a>
                                  <div class="close_btn close_btn-{{ $i }}" onclick="deleteImg1('{{ $l }}','{{ $user_id }}','{{ $tranimg }}','{{ $pls_first_word_one }}','pls_imgs')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
                                </div>
                                <?php
                                $l++;
                                ?>
                                @endforeach
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php
                        $i++;
                        ?>
                        @endforeach
                        @endif
                      </div>
                      <div class="form-group level-drp @if($education_data && $education_data->rn_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdivfive">
                        <input type="hidden" name="pro_cert_rn" class="pro_cert_rn" value="@if(!empty($educationData)){{ $r_data_json }}@endif">
                        <label class="form-label" for="input-1">RN (Registered Nurse)</label>
                        <?php
                        $rn_data = DB::table("professional_certificate_table")->where("cert_id", "11")->get();
                        ?>
                        <ul id="rn_data" style="display:none;">
                          @foreach($rn_data as $data)
                          <li data-value="{{ $data->name }}">{{ $data->name }}</li>
                          @endforeach

                        </ul>
                        <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="rn_data" name="rn_data[]" multiple="multiple"></select>
                        <span id="reqrnvalid" class="reqError text-danger valley"></span>
                      </div>
                      <div class="rn_certification_div">
                        @if(!empty($rn_data1))
                        <?php
                        $i = 0;
                        ?>
                        @foreach($rn_data1 as $r_data)
                        <?php
                        $rn_first_word = strtok($r_data->rn_certification_id, " ");;

                        $rn_first_word_one = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $rn_first_word));
                        ?>

                        <div class="rn_{{ $rn_first_word_one }}">
                          <h6>{{ $r_data->rn_certification_id }}</h6>
                          <div class="license_number_div row license_number_rn">

                            <div class="form-group col-md-6">
                              <label class="form-label" for="input-1">Certification/Licence Number</label>
                              <input type="hidden" name="rnnamearr[]" class="rn_input_{{ $r_data->rn_certification_id }}" value="{{ $r_data->rn_certification_id }}">
                              <input class="form-control rn_license_number rn_license_number-{{ $i }}" type="text" name="rn_license_number[]" value="{{ $r_data->rn_license_number }}">
                              <span id="reqrnlicencevalid-{{ $i }}" class="reqError text-danger valley"></span>
                            </div>
                            <div class="form-group col-md-6">
                              <label class="form-label" for="input-1">Expiry</label>
                              <input class="form-control rnexpiry rnexpiry-{{ $i }}" type="date" name="rn_expiry[]" value="{{ $r_data->rn_expiry }}">
                              <span id="reqrnexpiryvalid-{{ $i }}" class="reqError text-danger valley"></span>
                            </div>
                            <div class="form-group col-md-6">
                              <label class="form-label" for="input-1">Upload your certification/Licence</label>
                              <input class="form-control degree_transcript rn_imgs_{{ $rn_first_word_one }} rn_upload_certification rn_upload_certification-{{ $i }}" type="file" name="rn_upload_certification[{{ $i }}][]" onchange="changeImg1('{{ $user_id }}','{{ $i }}','rn_imgs','{{ $rn_first_word_one }}')" multiple="">
                              <span id="reqrnuploadvalid-{{ $i }}" class="reqError text-danger valley"></span>
                              <?php
                              $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();

                              if (!empty($getedufieldsdata)) {
                                $rn_img = (array)json_decode($getedufieldsdata->rn_imgs);
                              } else {
                                $rn_img = '';
                              }

                              if (!empty($rn_img)) {
                                $rn_img_data = json_decode($rn_img[$rn_first_word_one]);
                              } else {
                                $rn_img_data = "";
                              }
                              //print_r($acls_img[$acls_first_word_one]);


                              //print_r($dtran_img);
                              $l = 1;
                              $user_id = Auth::guard('nurse_middle')->user()->id;
                              ?>
                              <div class="rn_imgs{{ $rn_first_word_one }}">
                                @if(!empty($rn_img_data))
                                @foreach($rn_img_data as $tranimg)
                                <div class="trans_img trans_img-{{ $i }} trans_imgrn_imgs{{ $rn_first_word_one }}{{ $l }}">
                                  <a href="{{ url('/public/uploads/education_degree') }}/{{ $tranimg }}"><i class="fa fa-file"></i>{{ $tranimg }}</a>
                                  <div class="close_btn close_btn-{{ $i }}" onclick="deleteImg1('{{ $l }}','{{ $user_id }}','{{ $tranimg }}','{{ $rn_first_word_one }}','rn_imgs')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
                                </div>
                                <?php
                                $l++;
                                ?>
                                @endforeach
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php $i++; ?>
                        @endforeach
                        @endif
                      </div>
                      <div class="form-group level-drp @if($education_data && $education_data->np_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdivtwelfth">
                        <input type="hidden" name="pro_cert_np" class="pro_cert_np" value="@if(!empty($educationData)){{ $np_data_json }}@endif">
                        <label class="form-label" for="input-1">NP (Nurse Practioner) / (APRN) Advanced Practice Registered Nurse</label>
                        <?php
                        $np_data = DB::table("professional_certificate_table")->where("cert_id", "18")->get();
                        ?>
                        <ul id="np_data" style="display:none;">
                          @foreach($np_data as $data)
                          <li data-value="{{ $data->name }}">{{ $data->name }}</li>
                          @endforeach

                        </ul>
                        <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="np_data" name="np_data[]" multiple="multiple"></select>
                        <span id="reqnpvalid" class="reqError text-danger valley"></span>
                      </div>
                      <div class="np_certification_div">
                        @if(!empty($np_data1))
                        @foreach($np_data1 as $n_data)
                        <?php
                        $np_first_word = strtok($n_data->np_certification_id, " ");;

                        $np_first_word_one = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $np_first_word));
                        ?>

                        <div class="np_{{ $np_first_word_one }}">
                          <h6>{{ $n_data->np_certification_id }}</h6>
                          <div class="license_number_div row license_number_np">

                            <div class="form-group col-md-6">
                              <label class="form-label" for="input-1">Certification/Licence Number</label>
                              <input type="hidden" name="npnamearr[]" class="np_input_{{ $n_data->np_certification_id }}" value="{{ $n_data->np_certification_id }}">
                              <input class="form-control np_license_number np_license_number-{{ $i }}" type="text" name="np_license_number[]" value="{{ $n_data->np_license_number }}">
                              <span id="reqnplicencevalid-{{ $i }}" class="reqError text-danger valley"></span>
                            </div>
                            <div class="form-group col-md-6">
                              <label class="form-label" for="input-1">Expiry</label>
                              <input class="form-control npexpiry npexpiry-{{ $i }}" type="date" name="np_expiry[]" value="{{ $n_data->np_expiry }}">
                            </div>
                            <div class="form-group col-md-6">
                              <label class="form-label" for="input-1">Upload your certification/Licence</label>
                              <input class="form-control degree_transcript np_imgs_{{ $np_first_word_one }} np_upload_certification np_upload_certification-{{ $i }}" type="file" name="np_upload_certification[{{ $i }}][]" onchange="changeImg1('{{ $user_id }}','{{ $i }}','np_imgs','{{ $np_first_word_one }}')" multiple="">
                              <span id="reqnpuploadvalid-{{ $i }}" class="reqError text-danger valley"></span>
                              <?php
                              $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();

                              if (!empty($getedufieldsdata)) {
                                $np_img = (array)json_decode($getedufieldsdata->np_imgs);
                              } else {
                                $np_img = '';
                              }

                              if (!empty($np_img)) {
                                $np_img_data = json_decode($np_img[$np_first_word_one]);
                              } else {
                                $np_img_data = "";
                              }
                              //print_r($acls_img[$acls_first_word_one]);


                              //print_r($dtran_img);
                              $l = 1;
                              $user_id = Auth::guard('nurse_middle')->user()->id;
                              ?>
                              <div class="np_imgs{{ $np_first_word_one }}">
                                @if(!empty($np_img_data))
                                @foreach($np_img_data as $tranimg)
                                <div class="trans_img trans_img-{{ $i }} trans_imgnp_imgs{{ $np_first_word_one }}{{ $l }}">
                                  <a href="{{ url('/public/uploads/education_degree') }}/{{ $tranimg }}"><i class="fa fa-file"></i>{{ $tranimg }}</a>
                                  <div class="close_btn close_btn-{{ $i }}" onclick="deleteImg1('{{ $l }}','{{ $user_id }}','{{ $tranimg }}','{{ $np_first_word_one }}','np_imgs')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
                                </div>
                                <?php
                                $l++;
                                ?>
                                @endforeach
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                        @endforeach
                        @endif
                      </div>


                      <div class="form-group level-drp @if($education_data && $education_data->cna_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdivsix">
                        <input type="hidden" name="pro_cert_cna" class="pro_cert_cna" value="@if(!empty($educationData)){{ $cna_data_json }}@endif">
                        <label class="form-label" for="input-1">CNA (Certified Nursing Assistant) / EN (Enrolled Nurse)</label>
                        <?php
                        $cn_data = DB::table("professional_certificate_table")->where("cert_id", "12")->get();
                        ?>
                        <ul id="cn_data" style="display:none;">
                          @foreach($cn_data as $data)
                          <li data-value="{{ $data->name }}">{{ $data->name }}</li>
                          @endforeach

                        </ul>
                        <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="cn_data" name="cn_data[]" multiple="multiple"></select>
                        <span id="reqcnvalid" class="reqError text-danger valley"></span>
                      </div>
                      <div class="cna_certification_div">
                        @if(!empty($cna_data1))
                        <?php
                        $i = 0;
                        ?>
                        @foreach($cna_data1 as $cn_data)
                        <?php
                        $cna_first_word = strtok($cn_data->cn_certification_id, " ");

                        $cna_first_word_one = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $cna_first_word));
                        ?>

                        <div class="cna_{{ $cna_first_word_one }}">
                          <h6>{{ $cn_data->cn_certification_id }}</h6>
                          <div class="license_number_div row license_number_cna">

                            <div class="form-group col-md-6">
                              <label class="form-label" for="input-1">Certification/Licence Number</label>
                              <input type="hidden" name="cnnamearr[]" class="cn_input_{{ $cn_data->cn_certification_id }}" value="{{ $cn_data->cn_certification_id }}">
                              <input class="form-control cn_license_number cn_license_number-{{ $i }}" type="text" name="cn_license_number[]" value="{{ $cn_data->cn_license_number }}">
                              <span id="reqcnlicencevalid-{{ $i }}" class="reqError text-danger valley"></span>
                            </div>
                            <div class="form-group col-md-6">
                              <label class="form-label" for="input-1">Expiry</label>
                              <input class="form-control cnexpiry cnexpiry-{{ $i }}" type="date" name="cn_expiry[]" value="{{ $cn_data->cn_expiry }}">
                              <span id="reqcnexpiryvalid-{{ $i }}" class="reqError text-danger valley"></span>
                            </div>
                            <div class="form-group col-md-6">
                              <label class="form-label" for="input-1">Upload your certification/Licence</label>
                              <input class="form-control degree_transcript cn_imgs_{{ $cna_first_word_one }} cn_upload_certification cn_upload_certification-{{ $i }}" type="file" name="cn_upload_certification[{{ $i }}][]" onchange="changeImg1('{{ $user_id }}','{{ $i }}','cn_imgs','{{ $cna_first_word_one }}')" multiple="">
                              <span id="reqcnuploadvalid-{{ $i }}" class="reqError text-danger valley"></span>
                              <?php
                              $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();

                              if (!empty($getedufieldsdata)) {
                                $cn_img = (array)json_decode($getedufieldsdata->cn_imgs);
                              } else {
                                $cn_img = '';
                              }

                              if (!empty($cn_img)) {
                                $cn_img_data = json_decode($cn_img[$cna_first_word_one]);
                              } else {
                                $cn_img_data = "";
                              }
                              //print_r($acls_img[$acls_first_word_one]);


                              //print_r($dtran_img);
                              $l = 1;
                              $user_id = Auth::guard('nurse_middle')->user()->id;
                              ?>
                              <div class="cn_imgs{{ $cna_first_word_one }}">
                                @if(!empty($cn_img_data))
                                @foreach($cn_img_data as $tranimg)
                                <div class="trans_img trans_img-{{ $i }} trans_imgcn_imgs{{ $cn_first_word_one }}{{ $l }}">
                                  <a href="{{ url('/public/uploads/education_degree') }}/{{ $tranimg }}"><i class="fa fa-file"></i>{{ $tranimg }}</a>
                                  <div class="close_btn close_btn-{{ $i }}" onclick="deleteImg1('{{ $l }}','{{ $user_id }}','{{ $tranimg }}','{{ $cn_first_word_one }}','cn_imgs')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
                                </div>
                                <?php
                                $l++;
                                ?>
                                @endforeach
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php
                        $i++;
                        ?>
                        @endforeach
                        @endif
                      </div>
                      <div class="form-group level-drp @if($education_data && $education_data->lpn_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdivseven">
                        <input type="hidden" name="pro_cert_lpn" class="pro_cert_lpn" value="@if(!empty($educationData)){{ $lpn_data_json }}@endif">
                        <label class="form-label" for="input-1">LPN (Licensed Practical Nurse) / LVN (Licensed Vocational Nurse)</label>
                        <?php
                        $lpn_data = DB::table("professional_certificate_table")->where("cert_id", "13")->get();
                        ?>
                        <ul id="lpn_data" style="display:none;">
                          @foreach($lpn_data as $data)
                          <li data-value="{{ $data->name }}">{{ $data->name }}</li>
                          @endforeach

                        </ul>
                        <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="lpn_data" name="lpn_data[]" multiple="multiple"></select>
                        <span id="reqlpnvalid" class="reqError text-danger valley"></span>
                      </div>
                      <div class="lpn_certification_div">
                        @if(!empty($lpn_data1))
                        <?php
                        $i = 0;
                        ?>
                        @foreach($lpn_data1 as $l_data)
                        <?php
                        $lpn_first_word = strtok($l_data->lpn_certification_id, " ");;

                        $lpn_first_word_one = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $lpn_first_word));
                        ?>

                        <div class="lpn_{{ $lpn_first_word_one }}">
                          <h6>{{ $l_data->lpn_certification_id }}</h6>
                          <div class="license_number_div row license_number_lpn">

                            <div class="form-group col-md-6">
                              <label class="form-label" for="input-1">Certification/Licence Number</label>
                              <input type="hidden" name="lpnnamearr[]" class="lpn_input_{{ $l_data->lpn_certification_id }}" value="{{ $l_data->lpn_certification_id }}">
                              <input class="form-control lpn_license_number lpn_license_number-{{ $i }}" type="text" name="lpn_license_number[]" value="{{ $l_data->lpn_license_number }}">
                              <span id="reqlpnlicencevalid-{{ $i }}" class="reqError text-danger valley"></span>
                            </div>
                            <div class="form-group col-md-6">
                              <label class="form-label" for="input-1">Expiry</label>
                              <input class="form-control lpnexpiry lpnexpiry-{{ $i }}" type="date" name="lpn_expiry[]" value="{{ $l_data->lpn_expiry }}">
                              <span id="reqlpnexpiryvalid-{{ $i }}" class="reqError text-danger valley"></span>
                            </div>
                            <div class="form-group col-md-6">
                              <label class="form-label" for="input-1">Upload your certification/Licence</label>
                              <input class="form-control degree_transcript lpn_imgs_{{ $lpn_first_word_one }} lpn_upload_certification lpn_upload_certification-{{ $i }}" type="file" name="lpn_upload_certification[{{ $i }}][]" onchange="changeImg1('{{ $user_id }}','{{ $i }}','lpn_imgs','{{ $lpn_first_word_one }}')" multiple="">
                              <span id="reqlpnuploadvalid-{{ $i }}" class="reqError text-danger valley"></span>
                              <?php
                              $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();

                              if (!empty($getedufieldsdata)) {
                                $lpn_img = (array)json_decode($getedufieldsdata->lpn_imgs);
                              } else {
                                $lpn_img = '';
                              }

                              if (!empty($lpn_img)) {
                                $lpn_img_data = json_decode($lpn_img[$lpn_first_word_one]);
                              } else {
                                $lpn_img_data = "";
                              }
                              //print_r($acls_img[$acls_first_word_one]);


                              //print_r($dtran_img);
                              $l = 1;
                              $user_id = Auth::guard('nurse_middle')->user()->id;
                              ?>
                              <div class="lpn_imgs{{ $lpn_first_word_one }}">
                                @if(!empty($lpn_img_data))
                                @foreach($lpn_img_data as $tranimg)
                                <div class="trans_img trans_img-{{ $i }} trans_imglpn_imgs{{ $lpn_first_word_one }}{{ $l }}">
                                  <a href="{{ url('/public/uploads/education_degree') }}/{{ $tranimg }}"><i class="fa fa-file"></i>{{ $tranimg }}</a>
                                  <div class="close_btn close_btn-{{ $i }}" onclick="deleteImg1('{{ $l }}','{{ $user_id }}','{{ $tranimg }}','{{ $lpn_first_word_one }}','lpn_imgs')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
                                </div>
                                <?php
                                $l++;
                                ?>
                                @endforeach
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php
                        $i++;
                        ?>
                        @endforeach
                        @endif
                      </div>
                      <div class="form-group level-drp @if($education_data && $education_data->crna_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdiveight">
                        <input type="hidden" name="pro_cert_crna" class="pro_cert_crna" value="@if(!empty($educationData)){{ $crna_data_json }}@endif">
                        <label class="form-label" for="input-1">CRNA (Certified Registered Nurse Anesthetist)</label>
                        <?php
                        $crn_data = DB::table("professional_certificate_table")->where("cert_id", "14")->get();
                        ?>
                        <ul id="crn_data" style="display:none;">
                          @foreach($crn_data as $data)
                          <li data-value="{{ $data->name }}">{{ $data->name }}</li>
                          @endforeach

                        </ul>
                        <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="crn_data" name="crn_data[]" multiple="multiple"></select>
                        <span id="reqcrnavalid" class="reqError text-danger valley"></span>
                      </div>
                      <div class="crna_certification_div">
                        @if(!empty($crna_data1))
                        <?php
                        $i = 0;
                        ?>
                        @foreach($crna_data1 as $crna_data)
                        <?php
                        $crna_first_word = strtok($crna_data->crna_certification_id, " ");;

                        $crna_first_word_one = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $crna_first_word));
                        ?>

                        <div class="crna_{{ $crna_first_word_one }}">
                          <h6>{{ $crna_data->crna_certification_id }}</h6>
                          <div class="license_number_div row license_number_crna">

                            <div class="form-group col-md-6">
                              <label class="form-label" for="input-1">Certification/Licence Number</label>
                              <input type="hidden" name="crnanamearr[]" class="crna_input_{{ $crna_data->crna_certification_id }}" value="{{ $crna_data->crna_certification_id }}">
                              <input class="form-control crna_license_number crna_license_number-{{ $i }}" type="text" name="crna_license_number[]" value="{{ $crna_data->crna_license_number }}">
                              <span id="reqcrnalicencevalid-{{ $i }}" class="reqError text-danger valley"></span>
                            </div>
                            <div class="form-group col-md-6">
                              <label class="form-label" for="input-1">Expiry</label>
                              <input class="form-control crnaexpiry crnaexpiry-{{ $i }}" type="date" name="crna_expiry[]" value="{{ $crna_data->crna_expiry }}">
                              <span id="reqcrnaexpiryvalid-{{ $i }}" class="reqError text-danger valley"></span>
                            </div>
                            <div class="form-group col-md-6">
                              <label class="form-label" for="input-1">Upload your certification/Licence</label>
                              <input class="form-control degree_transcript crna_imgs_{{ $crna_first_word_one }} crna_upload_certification crna_upload_certification-{{ $i }}" type="file" name="crna_upload_certification[{{ $i }}][]" onchange="changeImg1('{{ $user_id }}','{{ $i }}','crna_imgs','{{ $crna_first_word_one }}')" multiple="">
                              <span id="reqcrnauploadvalid-{{ $i }}" class="reqError text-danger valley"></span>
                              <?php
                              $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();

                              if (!empty($getedufieldsdata)) {
                                $crna_img = (array)json_decode($getedufieldsdata->crna_imgs);
                              } else {
                                $crna_img = '';
                              }

                              if (!empty($crna_img)) {
                                $crna_img_data = json_decode($crna_img[$crna_first_word_one]);
                              } else {
                                $crna_img_data = "";
                              }
                              //print_r($acls_img[$acls_first_word_one]);


                              //print_r($dtran_img);
                              $l = 1;
                              $user_id = Auth::guard('nurse_middle')->user()->id;
                              ?>
                              <div class="crna_imgs{{ $crna_first_word_one }}">
                                @if(!empty($crna_img_data))
                                @foreach($crna_img_data as $tranimg)
                                <div class="trans_img trans_img-{{ $i }} trans_imgcrna_imgs{{ $crna_first_word_one }}{{ $l }}">
                                  <a href="{{ url('/public/uploads/education_degree') }}/{{ $tranimg }}"><i class="fa fa-file"></i>{{ $tranimg }}</a>
                                  <div class="close_btn close_btn-{{ $i }}" onclick="deleteImg1('{{ $l }}','{{ $user_id }}','{{ $tranimg }}','{{ $crna_first_word_one }}','crna_imgs')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
                                </div>
                                <?php
                                $l++;
                                ?>
                                @endforeach
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php
                        $i++;
                        ?>
                        @endforeach
                        @endif
                      </div>
                      <div class="form-group level-drp @if($education_data && $education_data->cnm_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdivnine">
                        <input type="hidden" name="pro_cert_cnm" class="pro_cert_cnm" value="@if(!empty($educationData)){{ $cnm_data_json }}@endif">
                        <label class="form-label" for="input-1">CNM (Certified Nurse Midwife)</label>
                        <?php
                        $cnm_data = DB::table("professional_certificate_table")->where("cert_id", "15")->get();
                        ?>
                        <ul id="cnm_data" style="display:none;">
                          @foreach($cnm_data as $data)
                          <li data-value="{{ $data->name }}">{{ $data->name }}</li>
                          @endforeach

                        </ul>
                        <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="cnm_data" name="cnm_data[]" multiple="multiple"></select>
                        <span id="reqcnmvalid" class="reqError text-danger valley"></span>
                      </div>
                      <div class="cnm_certification_div">
                        @if(!empty($cnm_data1))
                        <?php
                        $i = 0;
                        ?>
                        @foreach($cnm_data1 as $cnm_data)
                        <?php
                        $cnm_first_word = strtok($cnm_data->cnm_certification_id, " ");;

                        $cnm_first_word_one = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $cnm_first_word));
                        ?>

                        <div class="cnm_{{ $cnm_first_word_one }}">
                          <h6>{{ $cnm_data->cnm_certification_id }}</h6>
                          <div class="license_number_div row license_number_cnm">

                            <div class="form-group col-md-6">
                              <label class="form-label" for="input-1">Certification/Licence Number</label>
                              <input type="hidden" name="cnmnamearr[]" class="cnm_input_{{ $cnm_data->cnm_certification_id }}" value="{{ $cnm_data->cnm_certification_id }}">
                              <input class="form-control cnm_license_number cnm_license_number-{{ $i }}" type="text" name="cnm_license_number[]" value="{{ $cnm_data->cnm_license_number }}">
                              <span id="reqcnmlicencevalid-{{ $i }}" class="reqError text-danger valley"></span>
                            </div>
                            <div class="form-group col-md-6">
                              <label class="form-label" for="input-1">Expiry</label>
                              <input class="form-control cnmexpiry cnmexpiry-{{ $i }}" type="date" name="cnm_expiry[]" value="{{ $cnm_data->cnm_expiry }}">
                              <span id="reqcnmexpiryvalid-{{ $i }}" class="reqError text-danger valley"></span>
                            </div>
                            <div class="form-group col-md-6">
                              <label class="form-label" for="input-1">Upload your certification/Licence</label>
                              <input class="form-control degree_transcript cnm_imgs_{{ $cnm_first_word_one }} cnm_upload_certification cnm_upload_certification-{{ $i }}" type="file" name="cnm_upload_certification[{{ $i }}][]" onchange="changeImg1('{{ $user_id }}','{{ $i }}','cnm_imgs','{{ $cnm_first_word_one }}')" multiple="">
                              <span id="reqcnmuploadvalid-{{ $i }}" class="reqError text-danger valley"></span>
                              <?php
                              $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();

                              if (!empty($getedufieldsdata)) {
                                $cnm_img = (array)json_decode($getedufieldsdata->cnm_imgs);
                              } else {
                                $cnm_img = '';
                              }

                              if (!empty($cnm_img)) {
                                $cnm_img_data = json_decode($cnm_img[$cnm_first_word_one]);
                              } else {
                                $cnm_img_data = "";
                              }
                              //print_r($acls_img[$acls_first_word_one]);


                              //print_r($dtran_img);
                              $l = 1;
                              $user_id = Auth::guard('nurse_middle')->user()->id;
                              ?>
                              <div class="cnm_imgs{{ $cnm_first_word_one }}">
                                @if(!empty($cnm_img_data))
                                @foreach($cnm_img_data as $tranimg)
                                <div class="trans_img trans_img-{{ $i }} trans_imgcnm_imgs{{ $cnm_first_word_one }}{{ $l }}">
                                  <a href="{{ url('/public/uploads/education_degree') }}/{{ $tranimg }}"><i class="fa fa-file"></i>{{ $tranimg }}</a>
                                  <div class="close_btn close_btn-{{ $i }}" onclick="deleteImg1('{{ $l }}','{{ $user_id }}','{{ $tranimg }}','{{ $cnm_first_word_one }}','cnm_imgs')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
                                </div>
                                <?php
                                $l++;
                                ?>
                                @endforeach
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php
                        $i++;
                        ?>
                        @endforeach
                        @endif
                      </div>
                      <div class="form-group level-drp @if($education_data && $education_data->ons_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdivten">
                        <input type="hidden" name="pro_cert_ons" class="pro_cert_ons" value="@if(!empty($educationData)){{ $ons_data_json }}@endif">
                        <label class="form-label" for="input-1">ONS/ONCC (Oncology Nursing Society/Oncology Nursing Certification Corporation)</label>
                        <?php
                        $ons_data = DB::table("professional_certificate_table")->where("cert_id", "16")->get();
                        ?>
                        <ul id="ons_data" style="display:none;">
                          @foreach($ons_data as $data)
                          <li data-value="{{ $data->name }}">{{ $data->name }}</li>
                          @endforeach

                        </ul>
                        <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="ons_data" name="ons_data[]" multiple="multiple"></select>
                        <span id="reqonsvalid" class="reqError text-danger valley"></span>
                      </div>
                      <div class="ons_certification_div">
                        @if(!empty($ons_data1))
                        <?php
                        $i = 0;
                        ?>
                        @foreach($ons_data1 as $ons_data)
                        <?php
                        $ons_first_word = strtok($ons_data->ons_certification_id, " ");;

                        $ons_first_word_one = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $ons_first_word));
                        ?>

                        <div class="ons_{{ $ons_first_word_one }}">
                          <h6>{{ $ons_data->ons_certification_id }}</h6>
                          <div class="license_number_div row license_number_ons">

                            <div class="form-group col-md-6">
                              <label class="form-label" for="input-1">Certification/Licence Number</label>
                              <input type="hidden" name="onsnamearr[]" class="ons_input_{{ $ons_data->ons_certification_id }}" value="{{ $ons_data->ons_certification_id }}">
                              <input class="form-control ons_license_number ons_license_number-{{ $i }}" type="text" name="ons_license_number[]" value="{{ $ons_data->ons_license_number }}">
                              <span id="reqonslicencevalid-{{ $i }}" class="reqError text-danger valley"></span>
                            </div>
                            <div class="form-group col-md-6">
                              <label class="form-label" for="input-1">Expiry</label>
                              <input class="form-control onsexpiry onsexpiry-{{ $i }}" type="date" name="ons_expiry[]" value="{{ $ons_data->ons_expiry }}">
                              <span id="reqonsexpiryvalid-{{ $i }}" class="reqError text-danger valley"></span>
                            </div>
                            <div class="form-group col-md-6">
                              <label class="form-label" for="input-1">Upload your certification/Licence</label>
                              <input class="form-control degree_transcript ons_imgs_{{ $ons_first_word_one }} ons_upload_certification ons_upload_certification-{{ $i }}" type="file" name="ons_upload_certification[{{ $i }}][]" onchange="changeImg1('{{ $user_id }}','{{ $i }}','ons_imgs','{{ $ons_first_word_one }}')" multiple="">
                              <span id="reqonsuploadvalid-{{ $i }}" class="reqError text-danger valley"></span>
                              <?php
                              $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();

                              if (!empty($getedufieldsdata)) {
                                $ons_img = (array)json_decode($getedufieldsdata->ons_imgs);
                              } else {
                                $ons_img = '';
                              }

                              if (!empty($ons_img)) {
                                $ons_img_data = json_decode($ons_img[$ons_first_word_one]);
                              } else {
                                $ons_img_data = "";
                              }
                              //print_r($acls_img[$acls_first_word_one]);


                              //print_r($dtran_img);
                              $l = 1;
                              $user_id = Auth::guard('nurse_middle')->user()->id;
                              ?>
                              <div class="ons_imgs{{ $ons_first_word_one }}">
                                @if(!empty($ons_img_data))
                                @foreach($ons_img_data as $tranimg)
                                <div class="trans_img trans_img-{{ $i }} trans_imgons_imgs{{ $ons_first_word_one }}{{ $l }}">
                                  <a href="{{ url('/public/uploads/education_degree') }}/{{ $tranimg }}"><i class="fa fa-file"></i>{{ $tranimg }}</a>
                                  <div class="close_btn close_btn-{{ $i }}" onclick="deleteImg1('{{ $l }}','{{ $user_id }}','{{ $tranimg }}','{{ $ons_first_word_one }}','ons_imgs')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
                                </div>
                                <?php
                                $l++;
                                ?>
                                @endforeach
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php
                        $i++;
                        ?>
                        @endforeach
                        @endif
                      </div>
                      <div class="form-group level-drp @if($education_data && $education_data->msw_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdiveleven">
                        <input type="hidden" name="pro_cert_msw" class="pro_cert_msw" value="@if(!empty($educationData)){{ $msw_data_json }}@endif">
                        <label class="form-label" for="input-1">MSW/AiM (Maternity Support Worker/Assistant in Midwifery ) / Midwife Assistant</label>
                        <?php
                        $msw_data = DB::table("professional_certificate_table")->where("cert_id", "17")->get();
                        ?>
                        <ul id="msw_data" style="display:none;">
                          @foreach($msw_data as $data)
                          <li data-value="{{ $data->name }}">{{ $data->name }}</li>
                          @endforeach

                        </ul>
                        <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="msw_data" name="msw_data[]" multiple="multiple"></select>
                        <span id="reqmswvalid" class="reqError text-danger valley"></span>
                      </div>
                      <div class="msw_certification_div">
                        @if(!empty($msw_data1))
                        <?php
                        $i = 0;
                        ?>
                        @foreach($msw_data1 as $msw_data)
                        <?php
                        $msw_first_word = strtok($msw_data->msw_certification_id, " ");;

                        $msw_first_word_one = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $msw_first_word));
                        ?>

                        <div class="msw_{{ $msw_first_word_one }}">
                          <h6>{{ $msw_data->msw_certification_id }}</h6>
                          <div class="license_number_div row license_number_msw">

                            <div class="form-group col-md-6">
                              <label class="form-label" for="input-1">Certification/Licence Number</label>
                              <input type="hidden" name="mswnamearr[]" class="msw_input_{{ $msw_data->msw_certification_id }}" value="{{ $msw_data->msw_certification_id }}">
                              <input class="form-control msw_license_number msw_license_number-{{ $i }}" type="text" name="msw_license_number[]" value="{{ $msw_data->msw_license_number }}">
                              <span id="reqmswlicencevalid-{{ $i }}" class="reqError text-danger valley"></span>
                            </div>
                            <div class="form-group col-md-6">
                              <label class="form-label" for="input-1">Expiry</label>
                              <input class="form-control mswexpiry mswexpiry-{{ $i }}" type="date" name="msw_expiry[]" value="{{ $msw_data->msw_expiry }}">
                              <span id="reqmswexpiryvalid-{{ $i }}" class="reqError text-danger valley"></span>
                            </div>
                            <div class="form-group col-md-6">
                              <label class="form-label" for="input-1">Upload your certification/Licence</label>
                              <input class="form-control degree_transcript msw_imgs_{{ $msw_first_word_one }} msw_upload_certification msw_upload_certification-{{ $i }}" type="file" name="msw_upload_certification[{{ $i }}][]" onchange="changeImg1('{{ $user_id }}','{{ $i }}','msw_imgs','{{ $msw_first_word_one }}')" multiple>
                              <span id="reqmswuploadvalid-{{ $i }}" class="reqError text-danger valley"></span>
                              <?php
                              $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();

                              if (!empty($getedufieldsdata)) {
                                $msw_img = (array)json_decode($getedufieldsdata->msw_imgs);
                              } else {
                                $msw_img = '';
                              }

                              if (!empty($msw_img)) {
                                $msw_img_data = json_decode($msw_img[$msw_first_word_one]);
                              } else {
                                $msw_img_data = "";
                              }
                              //print_r($acls_img[$acls_first_word_one]);


                              //print_r($dtran_img);
                              $l = 1;
                              $user_id = Auth::guard('nurse_middle')->user()->id;
                              ?>
                              <div class="msw_imgs{{ $msw_first_word_one }}">
                                @if(!empty($msw_img_data))
                                @foreach($msw_img_data as $tranimg)
                                <div class="trans_img trans_img-{{ $i }} trans_imgacls_imgs{{ $acls_first_word_one }}{{ $l }}">
                                  <a href="{{ url('/public/uploads/education_degree') }}/{{ $tranimg }}"><i class="fa fa-file"></i>{{ $tranimg }}</a>
                                  <div class="close_btn close_btn-{{ $i }}" onclick="deleteImg1('{{ $l }}','{{ $user_id }}','{{ $tranimg }}','{{ $msw_first_word_one }}','msw_imgs')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
                                </div>
                                <?php
                                $l++;
                                ?>
                                @endforeach
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                        @endforeach
                        <?php
                        $i++;
                        ?>
                        @endif
                      </div>
                      <div class="form-group level-drp @if($education_data && $education_data->ain_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdivthirteen">
                        <input type="hidden" name="pro_cert_ain" class="pro_cert_ain" value="@if(!empty($educationData)){{ $ain_data_json }}@endif">
                        <label class="form-label" for="input-1">AIN (Assistant in Nursing) / NA (Nurse Associate) / HCA (Healthcare Assistant)</label>
                        <?php
                        $msw_data = DB::table("professional_certificate_table")->where("cert_id", "19")->get();
                        ?>
                        <ul id="ain_data" style="display:none;">
                          @foreach($msw_data as $data)
                          <li data-value="{{ $data->name }}">{{ $data->name }}</li>
                          @endforeach

                        </ul>
                        <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="ain_data" name="ain_data[]" multiple="multiple"></select>
                        <span id="reqainvalid" class="reqError text-danger valley"></span>
                      </div>
                      <div class="ain_certification_div">
                        @if(!empty($ain_data1))
                        <?php
                        $i = 0;
                        ?>
                        @foreach($ain_data1 as $ain_data)
                        <?php
                        $ain_first_word = strtok($ain_data->ain_certification_id, " ");;

                        $ain_first_word_one = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $ain_first_word));
                        ?>

                        <div class="ain_{{ $ain_first_word_one }}">
                          <h6>{{ $ain_data->ain_certification_id }}</h6>
                          <div class="license_number_div row license_number_ain">
                            <div class="form-group col-md-6">
                              <label class="form-label" for="input-1">Certification/Licence Number</label>
                              <input type="hidden" name="ainnamearr[]" class="ain_input_{{ $ain_data->ain_certification_id }}" value="{{ $ain_data->ain_certification_id }}">
                              <input class="form-control ain_license_number ain_license_number-{{ $i }}" type="text" name="ain_license_number[]" value="{{ $ain_data->ain_license_number }}">
                              <span id="reqainlicencevalid-{{ $i }}" class="reqError text-danger valley"></span>
                            </div>
                            <div class="form-group col-md-6">
                              <label class="form-label" for="input-1">Expiry</label>
                              <input class="form-control ainexpiry ainexpiry-{{ $i }}" type="date" name="ain_expiry[]" value="{{ $ain_data->ain_expiry }}">
                              <span id="reqainexpiryvalid-{{ $i }}" class="reqError text-danger valley"></span>
                            </div>
                            <div class="form-group col-md-6">
                              <label class="form-label" for="input-1">Upload your certification/Licence</label>
                              <input class="form-control degree_transcript ain_imgs_{{ $ain_first_word_one }} ain_upload_certification ain_upload_certification-{{ $i }}" type="file" name="ain_upload_certification[{{ $i }}][]" onchange="changeImg1('{{ $user_id }}','{{ $i }}','ain_imgs','{{ $ain_first_word_one }}')" multiple="">
                              <span id="reqainuploadvalid-{{ $i }}" class="reqError text-danger valley"></span>
                              <?php
                              $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();

                              if (!empty($getedufieldsdata)) {
                                $ain_img = (array)json_decode($getedufieldsdata->ain_imgs);
                              } else {
                                $ain_img = '';
                              }

                              if (!empty($ain_img)) {
                                $ain_img_data = json_decode($ain_img[$ain_first_word_one]);
                              } else {
                                $ain_img_data = "";
                              }
                              //print_r($acls_img[$acls_first_word_one]);


                              //print_r($dtran_img);
                              $l = 1;
                              $user_id = Auth::guard('nurse_middle')->user()->id;
                              ?>
                              <div class="ain_imgs{{ $ain_first_word_one }}">
                                @if(!empty($ain_img_data))
                                @foreach($ain_img_data as $tranimg)
                                <div class="trans_img trans_img-{{ $i }} trans_imgain_imgs{{ $ain_first_word_one }}{{ $l }}">
                                  <a href="{{ url('/public/uploads/education_degree') }}/{{ $tranimg }}"><i class="fa fa-file"></i>{{ $tranimg }}</a>
                                  <div class="close_btn close_btn-{{ $i }}" onclick="deleteImg1('{{ $l }}','{{ $user_id }}','{{ $tranimg }}','{{ $ain_first_word_one }}','ain_imgs')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
                                </div>
                                <?php
                                $l++;
                                ?>
                                @endforeach
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php
                        $i++;
                        ?>
                        @endforeach
                        @endif
                      </div>
                      <div class="form-group level-drp @if($education_data && $education_data->rpn_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdivfourteen">
                        <input type="hidden" name="pro_cert_rpn" class="pro_cert_rpn" value="@if(!empty($educationData)){{ $rpn_data_json }}@endif">
                        <label class="form-label" for="input-1">RPN (Registered Practical Nurse) / RGN (Registered General Nurse)</label>
                        <?php
                        $msw_data = DB::table("professional_certificate_table")->where("cert_id", "20")->get();
                        ?>
                        <ul id="rpn_data" style="display:none;">
                          @foreach($msw_data as $data)
                          <li data-value="{{ $data->name }}">{{ $data->name }}</li>
                          @endforeach

                        </ul>
                        <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="rpn_data" name="rpn_data[]" multiple="multiple"></select>
                        <span id="reqrpnvalid" class="reqError text-danger valley"></span>
                      </div>
                      <div class="rpn_certification_div">
                        @if(!empty($rpn_data1))
                        <?php
                        $i = 0;
                        ?>
                        @foreach($rpn_data1 as $rpn_data)
                        <?php
                        $rpn_first_word = strtok($rpn_data->rpn_certification_id, " ");;

                        $rpn_first_word_one = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $rpn_first_word));
                        ?>

                        <div class="rpn_{{ $rpn_first_word_one }}">
                          <h6>{{ $rpn_data->rpn_certification_id }}</h6>
                          <div class="license_number_div row license_number_rpn">

                            <div class="form-group col-md-6">
                              <label class="form-label" for="input-1">Certification/Licence Number</label>
                              <input type="hidden" name="rpnnamearr[]" class="rpn_input_{{ $rpn_data->rpn_certification_id }}" value="{{ $rpn_data->rpn_certification_id }}">
                              <input class="form-control rpn_license_number rpn_license_number-{{ $i }}" type="text" name="rpn_license_number[]" value="{{ $rpn_data->rpn_license_number }}">
                              <span id="reqrpnlicencevalid-{{ $i }}" class="reqError text-danger valley"></span>
                            </div>
                            <div class="form-group col-md-6">
                              <label class="form-label" for="input-1">Expiry</label>
                              <input class="form-control rpnexpiry rpnexpiry-{{ $i }}" type="date" name="rpn_expiry[]" value="{{ $rpn_data->rpn_expiry }}">
                              <span id="reqrpnexpiryvalid-{{ $i }}" class="reqError text-danger valley"></span>
                            </div>
                            <div class="form-group col-md-6">
                              <label class="form-label" for="input-1">Upload your certification/Licence</label>
                              <input class="form-control degree_transcript rpn_imgs_{{ $rpn_first_word_one }} rpn_upload_certification rpn_upload_certification-{{ $i }}" type="file" name="rpn_upload_certification[{{ $i }}][]" onchange="changeImg1('{{ $user_id }}','{{ $i }}','rpn_imgs','{{ $rpn_first_word_one }}')" multiple="">
                              <span id="reqrpnuploadvalid-{{ $i }}" class="reqError text-danger valley"></span>
                              <?php
                              $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();

                              if (!empty($getedufieldsdata)) {
                                $rpn_img = (array)json_decode($getedufieldsdata->rpn_imgs);
                              } else {
                                $rpn_img = '';
                              }

                              if (!empty($rpn_img)) {
                                $rpn_img_data = json_decode($rpn_img[$rpn_first_word_one]);
                              } else {
                                $rpn_img_data = "";
                              }
                              //print_r($acls_img[$acls_first_word_one]);

                              //print_r($dtran_img);
                              $l = 1;
                              $user_id = Auth::guard('nurse_middle')->user()->id;
                              ?>
                              <div class="rpn_imgs{{ $rpn_first_word_one }}">
                                @if(!empty($rpn_img_data))
                                @foreach($rpn_img_data as $tranimg)
                                <div class="trans_img trans_img-{{ $i }} trans_imgrpn_imgs{{ $rpn_first_word_one }}{{ $l }}">
                                  <a href="{{ url('/public/uploads/education_degree') }}/{{ $tranimg }}"><i class="fa fa-file"></i>{{ $tranimg }}</a>
                                  <div class="close_btn close_btn-{{ $i }}" onclick="deleteImg1('{{ $l }}','{{ $user_id }}','{{ $tranimg }}','{{ $rpn_first_word_one }}','rpn_imgs')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
                                </div>
                                <?php
                                $l++;
                                ?>
                                @endforeach
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php
                        $i++;
                        ?>
                        @endforeach
                        @endif
                      </div>
                      <div class="form-group level-drp @if($education_data && $education_data->nl_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdivfiveteen">
                        <input type="hidden" name="pro_cert_nl" class="pro_cert_nl" value="@if(!empty($educationData)){{ $nl_data_new }}@endif">
                        <label class="form-label" for="input-1">No License/Certification</label>
                        <?php
                        $nlc_data = DB::table("professional_certificate_table")->where("cert_id", "21")->get();
                        ?>
                        <ul id="nlc_data" style="display:none;">
                          @foreach($nlc_data as $data)
                          <li data-value="{{ $data->professionalcert_id }}">{{ $data->name }}</li>
                          @endforeach
                        </ul>
                        <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="nlc_data" name="nl_data[]" multiple="multiple"></select>
                      </div>
                    </div>
                    <div class="another_certifications">
                      <h6 class="emergency_text">
                        Other certifications
                      </h6>
                      <?php
                      if (!empty($educationData)) {
                        $additional_certificate = json_decode($educationData->additional_certification);
                      } else {
                        $additional_certificate = "";
                      }
                      $i = 1;
                      $l = 0;
                      ?>

                      @if(!empty($additional_certificate))
                      @foreach($additional_certificate as $c_data)
                      <div class="license_number_div license_number_div_{{ $i }} row license_number_anothercertifications">
                        <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Certificate {{ $i }}</label>
                          <input class="form-control additional_certificate_field additional_certificate_field-{{ $i }}" type="text" name="training_certificate[]" value="@if(!empty($educationData)){{ $c_data->training_certificate }}@endif">
                          <span id="reqcertname-{{ $i }}" class="reqError text-danger valley"></span>
                        </div>
                        <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Certification/Licence Number</label>
                          <input class="form-control cert_licence_num cert_licence_num-{{ $i }}" type="text" name="certificate_license_number[]" value="@if(!empty($educationData)){{ $c_data->certificate_license_number }}@endif">
                          <span id="reqcertlicense-{{ $i }}" class="reqError text-danger valley"></span>
                        </div>
                        <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Expiry</label>
                          <input class="form-control cert_expiry cert_expiry-{{ $i }}" type="date" name="certificate_expiry[]" value="@if(!empty($educationData)){{ $c_data->certificate_expiry }}@endif">
                          <span id="reqcertexpiry-{{ $i }}" class="reqError text-danger valley"></span>
                        </div>
                        <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Regulating Body</label>
                          <input class="form-control additional_regulating_body additional_regulating_body-{{ $i }}" type="text" name="regulating_body[]" value="@if(!empty($educationData)){{ $c_data->regulating_body }}@endif">
                          <span id="reqcertregulating_body-{{ $i }}" class="reqError text-danger valley"></span>
                        </div>
                        <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Upload your certification/Licence</label>
                          <input class="form-control ano_certifi_imgs_certifi_{{$i}}" type="file" name="certificate_upload_certification[]" onchange="changeAnoImg('{{ $user_id }}','{{ $l }}','ano_certifi_imgs','certifi_{{$i}}')" multiple="">
                          <?php
                          $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();

                          if (!empty($getedufieldsdata)) {
                            $ano_certifi_img = (array)json_decode($getedufieldsdata->ano_certifi_imgs);
                          } else {
                            $ano_certifi_img = '';
                          }


                          if (!empty($ano_certifi_img)) {
                            // $ano_certifi_img_data = json_decode($ano_certifi_img["certifi_$i"]);
                            $key = "certifi_$i";
                            $ano_certifi_img_data = isset($ano_certifi_img[$key]) ? json_decode($ano_certifi_img[$key], true) : [];
                          } else {
                            $ano_certifi_img_data = "";
                          }
                          //print_r($acls_img[$acls_first_word_one]);
                          //print_r($dtran_img);
                          $user_id = Auth::guard('nurse_middle')->user()->id;
                          ?>
                          <div class="ano_certifi_imgscertifi_{{ $i }}">
                            @if(!empty($ano_certifi_img_data))
                            @foreach($ano_certifi_img_data as $ano_img)
                            <div class="trans_img edu_img-{{ $i }} edu_imgano_certifi_imgscertifi_{{ $l }}">
                              <a href="{{ url('/public/uploads/education_degree') }}/{{ $ano_img }}"><i class="fa fa-file"></i>{{ $ano_img }}</a>
                              <div class="close_btn close_btn-{{ $i }}" onclick="deleteanoImg1('{{ $l }}','{{ $user_id }}','{{ $ano_img }}','certifi_{{$i}}','ano_certifi_imgs')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
                            </div>
                            <?php
                            $l++;
                            ?>
                            @endforeach
                            @endif
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="add_new_certification_div mb-3 mt-3"><a style="cursor: pointer;" onclick="delete_certification('{{ $i }}','{{ $user_id }}','{{ $c_data->certificate_id }}')">- Delete certification/Licence</a></div>
                        </div>
                      </div>
                      <?php
                      $i++;
                      ?>
                      @endforeach

                      @endif
                    </div>
                    <div class="add_new_certification_div mb-3 mt-3">
                      <a style="cursor: pointer;" onclick="add_listcertfication()">+ Add another certification/Licence</a>
                    </div>

                    

                    <span id="reqcertificate" class="reqError text-danger valley"></span>

                    
                    {{-- CORRECT BY HARSHITA --}}
                    {{-- </div> --}}
                    <span id="reqcertificate" class="reqError text-danger valley"></span>
                    
                    <div class="declaration_box">
                      <input type="checkbox" name="declare_information_edu" class="declare_information_edu" value="1" @if(!empty($educationData)) @if($educationData->declaration_status == 1) checked @endif @endif>
                      <label for="declare_information1">I declare that the information provided is true and correct</label>
                    </div>
                    <span id="reqdeclare_information1" class="reqError text-danger valley"></span>

                    <div class="box-button mt-15">
                      <button class="btn btn-apply-big font-md font-bold" type="submit" id="submitEducation">Save Changes</button>
                    </div>
                  </form>
                </div>
              </div>
              
              <div class="tab-pane fade" id="tab-experience" role="tabpanel" aria-labelledby="tab-educert" style="display: none">
                <div class="card shadow-sm border-0 p-4 mt-30">
                  <h3 class="mt-0 color-brand-1 mb-2">Experience</h3>
                  <h6>Please add your full nursing work experience to strengthen your profile and get hired faster. Please keep update as your experience grows:</h6>
                  <?php
                  $experienceData = DB::table("user_experience")->where("user_id", Auth::guard('nurse_middle')->user()->id)->get();
                  $d1 = 'test';
                  // print_r($experienceData);
                  // die;
                  ?>
                  <form id="experience_form" method="POST" novalidate onsubmit="return updateExperience()">
                    @csrf
                    <div class="form-group level-drp">
                      <!-- <label class="form-label" for="input-1">Total Year of Experience</label> -->
                      <input type="hidden" name="user_id" value="{{ Auth::guard('nurse_middle')->user()->id }}">
                      <!-- <input class="form-control" type="text" required="" name="year_experience" value="@if(!empty($educationData))@endif"> -->
                      <input type="hidden" name="np_result_experience" class="np_result_experience" value="{{ Auth::guard('nurse_middle')->user()->nurse_prac }}">
                      <input type="hidden" name="specialties_result_experience" class="specialties_result_experience" value="{{ Auth::guard('nurse_middle')->user()->specialties }}">
                      <input type="hidden" name="adults_result_experience" class="adults_result_experience" value="{{ Auth::guard('nurse_middle')->user()->adults }}">
                      <input type="hidden" name="maternity_result_experience" class="maternity_result_experience" value="{{ Auth::guard('nurse_middle')->user()->maternity }}">
                      <input type="hidden" name="padneonatal_result_experience" class="padneonatal_result_experience" value="{{ Auth::guard('nurse_middle')->user()->paediatrics_neonatal }}">
                      <input type="hidden" name="community_result_experience" class="community_result_experience" value="{{ Auth::guard('nurse_middle')->user()->community }}">
                      <input type="hidden" name="surgical_preoperative_result_experience" class="surgical_preoperative_result_experience" value="{{ Auth::guard('nurse_middle')->user()->surgical_preoperative }}">
                      <input type="hidden" name="operatingroom_result_experience" class="operatingroom_result_experience" value="{{ Auth::guard('nurse_middle')->user()->operating_room }}">
                      <input type="hidden" name="operatingscout_result_experience" class="operatingscout_result_experience" value="{{ Auth::guard('nurse_middle')->user()->operating_room_scout }}">
                      <input type="hidden" name="operatingscrub_result_experience" class="operatingscrub_result_experience" value="{{ Auth::guard('nurse_middle')->user()->operating_room_scrub }}">
                      <input type="hidden" name="surgical_ob_result_experience" class="surgical_ob_result_experience" value="{{ Auth::guard('nurse_middle')->user()->surgical_obstrics_gynacology }}">
                      <input type="hidden" name="neonatal_care_result_experience" class="neonatal_care_result_experience" value="{{ Auth::guard('nurse_middle')->user()->neonatal_care }}">
                      <input type="hidden" name="paedia_surgical_result_experience" class="paedia_surgical_result_experience" value="{{ Auth::guard('nurse_middle')->user()->paedia_surgical_preoperative }}">
                      <input type="hidden" name="pad_op_room_result_experience" class="pad_op_room_result_experience" value="{{ Auth::guard('nurse_middle')->user()->pad_op_room }}">
                      <input type="hidden" name="pad_qr_scout_result_experience" class="pad_qr_scout_result_experience" value="{{ Auth::guard('nurse_middle')->user()->pad_qr_scout }}">
                      <input type="hidden" name="pad_qr_scrub_result_experience" class="pad_qr_scrub_result_experience" value="{{ Auth::guard('nurse_middle')->user()->pad_qr_scrub }}">
                      <input type="hidden" name="nursing_result_two_experience" class="nursing_result_two_experience" value="{{ Auth::guard('nurse_middle')->user()->registered_nurses }}">
                      <input type="hidden" name="nursing_result_three_experience" class="nursing_result_three_experience" value="{{ Auth::guard('nurse_middle')->user()->advanced_practioner }}">

                    </div>
                    <span id="reqlevelexpereience" class="reqError text-danger valley"></span>
                    <?php
                    ?>
                    <div class="previous_employeers">
                      <?php
                      $i = 1;
                      ?>
                      @if($experienceData->isNotEmpty())
                      @foreach($experienceData as $data)
                      <div class="exp_tab exp_tab-{{$i}}">
                        <h6 class="emergency_text">
                          Work Experience {{ $i }}
                        </h6>
                        <div class="form-group drp--clr nurse_exp_type nurse_exp_type-{{ $i }}">
                          <label class="form-label" for="input-1">Type of Nurse?</label>
                          <input type="hidden" name="user_id" class="user_id" value="{{ Auth::guard('nurse_middle')->user()->id }}">
                          <input type="hidden" name="type_nurse" class="type_nurse_ep-{{ $i }}" value="{{ $data->nurseType }}">
                          <ul id="type-of-nurse-experience-{{$i}}" style="display:none;">
                            @php $specialty = specialty();$spcl=$specialty[0]->id;@endphp
                            <?php
                            $j = 1;
                            ?>
                            @foreach($specialty as $spl)
                            <li id="nursing_menus-{{ $j }}" data-value="{{ $spl->id }}">{{ $spl->name }}</li>
                            <?php
                            $j++;
                            ?>
                            @endforeach
                          </ul>
                          <select class="js-example-basic-multiple addAll_removeAll_btn nurse_level_ep" data-list-id="type-of-nurse-experience-{{1}}" name="nurseType[$i][]" id="nurse_type_exp-{{ $i }}" multiple="multiple"></select>
                        </div>
                        <div class="result--show nurse-res-rex nurse-res-rex-{{ $i }}">
                          <input type="hidden" name="nursing_result_one_experience" class="nursing_result_one_experience_{{$i}}" value="{{$data->entry_level_nursing }}">
                          <div class="container p-0">
                            <div class="row g-2">
                              @php $specialty = specialty();$spcl=$specialty[0]->id;@endphp
                              <?php
                              $a = 1;
                              ?>
                              @foreach($specialty as $spl)
                              <?php
                              $nursing_data = DB::table("practitioner_type")->where('parent', $spl->id)->orderBy('name')->get();
                              ?>
                              <!-- <input type="hidden" name="nursing_result_two_experience" class="nursing_result_two_experience" value="{{ Auth::guard('nurse_middle')->user()->registered_nurses }}">
                              <input type="hidden" name="nursing_result_three_experience" class="nursing_result_three_experience" value="{{Auth::guard('nurse_middle')->user()->advanced_practioner}}"> -->
                              <input type="hidden" name="nursing_result_experience" class="nursing_result_experience-{{ $a }}" value="{{ $spl->id }}">
                              <div class="nursing_data form-group drp--clr col-md-12 {{ in_array($spl->id, json_decode($data->nurseType)) ? '' : 'd-none' }} drpdown-set nursing_exp_{{ $spl->id }}" id="nursing_level_experience-{{ $a }}">
                                <label class="form-label" for="input-2">{{ $spl->name }}</label>
                                <ul id="nursing_entry_experience-{{ $a }}" style="display:none;">
                                  @foreach($nursing_data as $nd)
                                  <li data-value="{{ $nd->id }}">{{ $nd->name }}</li>
                                  @endforeach
                                </ul>
                                <select class="js-example-basic-multiple addAll_removeAll_btn nur_exp_res_{{ $spl->id }}_{{$i}}" data-list-id="nursing_entry_experience-{{ $a }}" name="nursing_type_{{ $a }}[1][]" multiple="multiple"></select>
                              </div>
                              <?php
                              $a++;
                              ?>
                              @endforeach
                            </div>
                          </div>
                        </div>

                        <?php
                        $i++;
                        ?>
                        @endforeach
                        @else
                        <div class="condition_set">
                          <h6 class="emergency_text previous_employeers_head">
                            Work Experience 1
                          </h6>
                          <div class="form-group drp--clr">
                            <label class="form-label" for="input-1">Type of Nurse?</label>
                            <input type="hidden" name="user_id" class="user_id" value="{{ Auth::guard('nurse_middle')->user()->id }}">
                            <ul id="type-of-nurse-experience" style="display:none;">
                              @php $specialty = specialty();$spcl=$specialty[0]->id;@endphp
                              <?php
                              $j = 1;
                              ?>
                              @foreach($specialty as $spl)
                              <li id="nursing_menus-{{ $j }}" data-value="{{ $spl->id }}">{{ $spl->name }}</li>
                              <?php
                              $j++;
                              ?>
                              @endforeach
                            </ul>
                            <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="type-of-nurse-experience" name="nurseType[1][]" id="nurse_type_experience" multiple="multiple"></select>
                          </div>
                          <span id="reqnurseTypeId" class="reqError text-danger valley"></span>
                        </div>
                        <div class="result--show">
                          <div class="container p-0">
                            <div class="row g-2">
                              @php $specialty = specialty();$spcl=$specialty[0]->id;@endphp
                              <?php
                              $i = 1;
                              ?>
                              @foreach($specialty as $spl)
                              <?php
                              $nursing_data = DB::table("practitioner_type")->where('parent', $spl->id)->orderBy('name')->get();
                              ?>
                              <input type="hidden" name="nursing_result_experience2" class="nursing_result_experience-{{ $i }}" value="{{ $spl->id }}">
                              <div class="nursing_data form-group drp--clr col-md-12 d-none drpdown-set nursing_exp_{{ $spl->id }}" id="nursing_level_experience-{{ $i }}">
                                <label class="form-label" for="input-2">{{ $spl->name }}</label>
                                <ul id="nursing_entry_experience-{{ $i }}" style="display:none;">
                                  @foreach($nursing_data as $nd)
                                  <li data-value="{{ $nd->id }}">{{ $nd->name }}</li>
                                  @endforeach
                                </ul>
                                <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="nursing_entry_experience-{{ $i }}" name="nursing_type_{{ $i }}[1][]" multiple="multiple"></select>
                              </div>
                              <?php
                              $i++;
                              ?>
                              @endforeach
                            </div>
                          </div>
                        </div>
                        <div class="np_submenu_experience d-none">
                          <div class="form-group drp--clr">
                            <?php
                            $np_data = DB::table("practitioner_type")->where('parent', '179')->get();
                            ?>
                            <label class="form-label" for="input-1">Nurse Practitioner (NP):</label>
                            <ul id="nurse_practitioner_menu_experience" style="display:none;">
                              @foreach($np_data as $nd)
                              <li data-value="{{ $nd->id }}">{{ $nd->name }}</li>
                              @endforeach
                            </ul>
                            <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="nurse_practitioner_menu_experience" name="nurse_practitioner_menu_experience[1][]" multiple="multiple"></select>
                          </div>
                        </div>
                        <div class="condition_set">
                          <div class="form-group drp--clr">
                            <input type="hidden" name="sub_speciality_value" class="sub_speciality_value" value="">
                            <label class="form-label" for="input-1">Specialties</label>
                            <ul id="specialties_experience" style="display:none;">
                              @php $JobSpecialties = JobSpecialties(); @endphp
                              <?php
                              $k = 1;
                              ?>
                              @foreach($JobSpecialties as $ptl)
                              <li id="nursing_menus-{{ $k }}" data-value="{{ $ptl->id }}">{{ $ptl->name }}</li>
                              <?php
                              $k++;
                              ?>
                              @endforeach

                            </ul>
                            <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="specialties_experience" name="specialties_experience[1][]" multiple="multiple"></select>
                          </div>
                          <span id="reqspecialties" class="reqError text-danger valley"></span>
                        </div>
                        <div class="speciality_boxes row result--show">
                          <?php
                          $l = 1;
                          ?>
                          @foreach($JobSpecialties as $ptl)
                          <?php
                          $speciality_data = DB::table("speciality")->where('parent', $ptl->id)->get();
                          ?>
                          <input type="hidden" name="speciality_result" class="speciality_result_experience-{{ $l }}" value="{{ $ptl->id }}">
                          <div class="speciality_data form-group drp--clr drpdown-set d-none col-md-6 speciality_{{ $ptl->id }}" id="specility_level_experience-{{ $l }}">
                            <label class="form-label" for="input-2">{{ $ptl->name }}</label>
                            <ul id="speciality_entry_experience-{{ $l }}" style="display:none;">
                              @foreach($speciality_data as $sd)
                              <li data-value="{{ $sd->id }}">{{ $sd->name }}</li>

                              @endforeach
                            </ul>
                            <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="speciality_entry_experience-{{ $l }}" name="speciality_entry_experience_{{ $l }}[1][]" multiple="multiple"></select>

                          </div>
                          <?php
                          $l++;
                          ?>
                          @endforeach
                        </div>
                        <div class="specialty_entry_one_experience"></div>
                        <div class="specialty_entry_two_experience"></div>
                        <div class="surgical_div_experience">
                          <div class="surgical_row_data_experience form-group drp--clr d-none col-md-12">
                            <label class="form-label" for="input-1">Surgical Preoperative and Postoperative Care:</label>
                            <?php
                            $speciality_surgicalrow_data = DB::table("speciality")->where('parent', '96')->get();
                            $r = 1;
                            ?>
                            <ul id="surgical_row_box_experience" style="display:none;">
                              @foreach($speciality_surgicalrow_data as $ssrd)
                              <li data-value="{{ $ssrd->id }}">{{ $ssrd->name }}</li>
                              @endforeach
                            </ul>
                            <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="surgical_row_box_experience" name="surgical_row_box_experience[1][]" multiple="multiple"></select>
                          </div>
                        </div>
                        <div class="paediatric_surgical_div_experience">
                          <div class="surgicalpad_row_data_experience form-group drp--clr d-none col-md-12">
                            <label class="form-label" for="input-1">Paediatric Surgical Preop. and Postop. Care:
                            </label>
                            <?php
                            $speciality_padsurgicalrow_data = DB::table("speciality")->where('parent', '285')->get();
                            $r = 1;
                            ?>
                            <ul id="surgical_rowpad_box_experience" style="display:none;">
                              @foreach($speciality_padsurgicalrow_data as $ssrd)
                              <li data-value="{{ $ssrd->id }}">{{ $ssrd->name }}</li>
                              @endforeach
                            </ul>
                            <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="surgical_rowpad_box_experience" name="surgical_rowpad_box_experience[1][]" multiple="multiple"></select>
                          </div>
                        </div>
                        <div class="specialty_sub_boxes_experience row">
                          <?php
                          $speciality_surgical_data = DB::table("speciality")->where('parent', '96')->get();
                          $w = 1;
                          ?>
                          @foreach($speciality_surgical_data as $ssd)
                          <input type="hidden" name="speciality_result" class="speciality_surgical_result_experience-{{ $w }}" value="{{ $ssd->id }}">
                          <div class="surgical_row_experience-{{ $w }} surgicalopcboxes-{{ $ssd->id }} form-group drp--clr d-none drpdown-set">
                            <label class="form-label" for="input-1">{{ $ssd->name }}</label>
                            <?php
                            $speciality_surgicalsub_data = DB::table("speciality")->where('parent', $ssd->id)->get();
                            ?>
                            <ul id="surgical_operative_care_experience-{{ $w }}" style="display:none;">
                              @foreach($speciality_surgicalsub_data as $sssd)
                              <li data-value="{{ $sssd->id }}">{{ $sssd->name }}</li>
                              @endforeach
                            </ul>
                            <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="surgical_operative_care_experience-{{ $w }}" name="surgical_operative_care_exp_{{ $w }}[1][]" multiple="multiple"></select>
                            @foreach($speciality_surgicalsub_data as $sssd)


                            <div class="d-none form-group level-drp level_id-{{ $sssd->id }}">
                              <label class="form-label" for="input-1">What is your Level of experience in {{ $sssd->name }}:

                              </label>
                              <!-- <input class="form-control" type="text" required="" name="fullname" placeholder="Steven Job"> -->
                              <select class="form-input mr-10 select-active" name="assistent_level[1][]">

                                @for($i = 1; $i <= 30; $i++) <option value="{{ $i }}" @if(Auth::guard('nurse_middle')->user()->assistent_level == $i) selected @endif>{{ $i }}{{ $i == 1 ? 'st' : ($i == 2 ? 'nd' : ($i == 3 ? 'rd' : 'th')) }} Year</option>
                                  @endfor
                              </select>
                            </div>

                            @endforeach
                          </div>
                          <?php
                          $w++;
                          ?>

                          @endforeach
                          <div class="surgical_operative_care_level_experience"></div>
                          <div class="surgical_operative_care_level_experience_two"></div>
                          <div class="surgical_operative_care_level_experience_three"></div>
                          <?php
                          $speciality_surgical_datamater = DB::table("speciality")->where('parent', '233')->get();
                          $p = 1;
                          ?>
                          <div class="surgicalobs_row_experience form-group drp--clr d-none drpdown-set col-md-12">
                            <label class="form-label" for="input-1">Surgical Obstetrics and Gynecology (OB/GYN):</label>

                            <ul id="surgicalobs_row_data_experience" style="display:none;">
                              @foreach($speciality_surgical_datamater as $ssd)
                              <li data-value="{{ $ssd->id }}">{{ $ssd->name }}</li>
                              @endforeach
                            </ul>
                            <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="surgicalobs_row_data_experience" name="surgical_obs_care_exp[1][]" multiple="multiple"></select>
                          </div>
                          <?php
                          $speciality_surgical_datamater = DB::table("speciality")->where('parent', '250')->get();

                          ?>
                          <div class="neonatal_row_experience form-group drp--clr drpdown-set d-none col-md-12">
                            <label class="form-label" for="input-1">Neonatal Care:</label>

                            <ul id="neonatal_care_experience" style="display:none;">
                              @foreach($speciality_surgical_datamater as $ssd)
                              <li data-value="{{ $ssd->id }}">{{ $ssd->name }}</li>
                              @endforeach
                            </ul>
                            <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="neonatal_care_experience" name="neonatal_care_experience[1][]" multiple="multiple"></select>
                          </div>
                          <div class="neonatal_care_experience_level"></div>
                          <?php
                          $speciality_surgical_datap = DB::table("speciality")->where('parent', '285')->get();
                          $q = 1;
                          ?>
                          @foreach($speciality_surgical_datap as $ssd)
                          <input type="hidden" name="speciality_result" class="surgical_rowp_result_experience-{{ $q }}" value="{{ $ssd->id }}">
                          <div class="surgical_rowp_experience surgicalpad_row_experience-{{ $ssd->id }} surgical_rowp_experience-{{ $q }} form-group drp--clr d-none drpdown-set col-md-4">
                            <label class="form-label" for="input-1">{{ $ssd->name }}</label>
                            <?php
                            $speciality_surgicalsub_data = DB::table("speciality")->where('parent', $ssd->id)->orderBy('name')->get();
                            ?>
                            <ul id="surgical_operative_carep_experience-{{ $q }}" style="display:none;">
                              @foreach($speciality_surgicalsub_data as $sssd)
                              <li data-value="{{ $sssd->id }}">{{ $sssd->name }}</li>
                              @endforeach
                            </ul>
                            <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="surgical_operative_carep_experience-{{ $q }}" name="surgical_operative_carep_experience_{{ $q }}[1][]" multiple="multiple"></select>
                          </div>
                          <?php
                          $q++;
                          ?>
                          @endforeach
                          <div class="surgical_operative_carep_level_one"></div>
                          <div class="surgical_operative_carep_level_two"></div>
                          <div class="surgical_operative_carep_level_three"></div>
                        </div>
                        <div class="form-group level-drp">
                          <label class="form-label" for="input-1">What is your Level of experience in this specialty?
                          </label>
                          <select class="form-input mr-10 select-active" name="exper_assistent_level[1]">

                            @for($i = 1; $i <= 30; $i++) <option value="{{ $i }}">{{ $i }}{{ $i == 1 ? 'st' : ($i == 2 ? 'nd' : ($i == 3 ? 'rd' : 'th')) }} Year</option>
                              @endfor
                          </select>
                        </div>
                        <div class="form-group level-drp">


                          <div class="form-group level-drp">
                            <label class="form-label" for="input-1">Position Held</label>
                            <select class="form-control" name="positions_held[1]">
                              <option value="">select</option>
                              <option value="Team Member">Team Member</option>
                              <option value="Team Leader">Team Leader</option>
                              <option value="Educator">Educator</option>
                              <option value="Manager">Manager</option>
                              <option value="Clinical Specialist">Clinical Specialist</option>
                              <option value="Charge Nurse">Charge Nurse</option>
                              <option value="Nurse Supervisor">Nurse Supervisor</option>
                              <option value="Nursing Director">Nursing Director</option>
                              <option value="Assistant Director of Nursing">Assistant Director of Nursing</option>
                              <option value="Head Nurse">Head Nurse</option>
                              <option value="Nurse Coordinator">Nurse Coordinator</option>
                              <option value="Staff Nurse">Staff Nurse</option>
                            </select>
                            <span id="reqpositionheld" class="reqError text-danger valley"></span>
                          </div>
                        </div>
                        <span id="reqpositionheld" class="reqError text-danger valley"></span>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group level-drp">
                              <label class="form-label" for="input-1">Employment Start Date</label>
                              <input class="form-control employeement_start_date employeement_start_date-1" type="date" name="start_date[1]" onchange="changeEmployeementEndDate(1)" onkeydown="return false">
                              <span id="reqempsdate" class="reqError text-danger valley"></span>
                            </div>
                            <div class="declaration_box">
                              <input class="currently_position currently_position-1" type="checkbox" name="present_box[1]" value="1" onclick="currently_position(1)">I am currently in this position at the moment
                            </div>
                          </div>
                          <div class="col-md-6 empl_end_date-1">
                            <div class="form-group level-drp">
                              <label class="form-label" for="input-1">Employment End Date</label>
                              <input class="form-control employeement_end_date employeement_end_date-1" type="date" name="end_date[1]" onkeydown="return false">
                              <span id="reqemployeementenddate-1" class="reqError text-danger valley"></span>
                            </div>
                          </div>
                        </div>
                        <br>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group level-drp">
                              <label class="form-label" for="input-1">Employment type</label>
                              <select class="form-control" name="employeement_type[1]" onchange="ExpEmpStatus(this.value)">
                                <option value="">select</option>
                                <option value="Permanent" @if(Auth::guard('nurse_middle')->user()->current_employee_status == "Permanent") selected @endif>Permanent</option>
                                <option value="Temporary" @if(Auth::guard('nurse_middle')->user()->current_employee_status == "Temporary") selected @endif>Temporary</option>
                              </select>
                              <span id="reqemptype" class="reqError text-danger valley"></span>
                            </div>
                          </div>
                        </div>
                        <div class="exp_permanent" @if(Auth::guard('nurse_middle')->user()->permanent_status == NULL) style="display: none;" @endif>
                          <div class="form-group col-md-12">
                            <label class="form-label" for="input-1">Permanent</label>
                            <!-- <input class="form-control" type="text" required="" name="fullname" placeholder="Steven Job"> -->
                            <select class="form-input mr-10 select-active" name="permanent_status[1]">
                              <option value="">Select</option>
                              <option value="Full-time" @if(Auth::guard('nurse_middle')->user()->permanent_status == "Full-time") selected @endif>Full-time</option>
                              <option value="Part-time" @if(Auth::guard('nurse_middle')->user()->permanent_status == "Part-time") selected @endif>Part-time</option>
                              <option value="Agency Nurse/Midwife" @if(Auth::guard('nurse_middle')->user()->permanent_status == "Agency Nurse/Midwife") selected @endif>Agency Nurse/Midwife</option>
                              <option value="Freelance" @if(Auth::guard('nurse_middle')->user()->permanent_status == "Freelance") selected @endif>Freelance</option>
                              <option value="Local" @if(Auth::guard('nurse_middle')->user()->permanent_status == "Local") selected @endif>Local</option>
                              <option value="Volunteer" @if(Auth::guard('nurse_middle')->user()->permanent_status == "Volunteer") selected @endif>Volunteer</option>

                            </select>
                          </div>
                          <span id="reqemployee_status" class="reqError text-danger valley"></span>
                        </div>
                        <div class="exp_temporary" @if(Auth::guard('nurse_middle')->user()->temporary_status == NULL) style="display: none;" @endif>
                          <div class="form-group col-md-12">
                            <label class="form-label" for="input-1">Temporary</label>
                            <!-- <input class="form-control" type="text" required="" name="fullname" placeholder="Steven Job"> -->
                            <select class="form-input mr-10 select-active" name="temporary_status[1]">
                              <option value="">Select</option>
                              <option value="Temporary" @if(Auth::guard('nurse_middle')->user()->temporary_status == "Temporary") selected @endif>Temporary</option>
                              <option value="Contract" @if(Auth::guard('nurse_middle')->user()->temporary_status == "Contract") selected @endif>Contract</option>
                              <option value="Term Contract" @if(Auth::guard('nurse_middle')->user()->temporary_status == "Term Contract") selected @endif>Term Contract</option>
                              <option value="Travel" @if(Auth::guard('nurse_middle')->user()->temporary_status == "Travel") selected @endif>Travel</option>
                              <option value="Per Diem" @if(Auth::guard('nurse_middle')->user()->temporary_status == "Per Diem") selected @endif>Per Diem</option>
                              <option value="Local" @if(Auth::guard('nurse_middle')->user()->temporary_status == "Local") selected @endif>Local</option>
                              <option value="On-Call" @if(Auth::guard('nurse_middle')->user()->temporary_status == "On-Call") selected @endif>On-Call</option>
                              <option value="PRN (Pro Re Nata)" @if(Auth::guard('nurse_middle')->user()->temporary_status == "PRN (Pro Re Nata)") selected @endif>PRN (Pro Re Nata)</option>
                              <option value="Casual" @if(Auth::guard('nurse_middle')->user()->temporary_status == "Casual") selected @endif>Casual</option>
                              <option value="Locum tenens (temporary substitute)" @if(Auth::guard('nurse_middle')->user()->temporary_status == "Locum tenens (temporary substitute)") selected @endif>Locum tenens (temporary substitute)</option>
                              <option value="Agency Nurse/Midwife" @if(Auth::guard('nurse_middle')->user()->temporary_status == "Agency Nurse/Midwife") selected @endif>Agency Nurse/Midwife</option>
                              <option value="Seasonal" @if(Auth::guard('nurse_middle')->user()->temporary_status == "Seasonal") selected @endif>Seasonal</option>
                              <option value="Freelance" @if(Auth::guard('nurse_middle')->user()->temporary_status == "Freelance") selected @endif>Freelance</option>
                              <option value="Internship" @if(Auth::guard('nurse_middle')->user()->temporary_status == "Internship") selected @endif>Internship</option>
                              <option value="Apprenticeship" @if(Auth::guard('nurse_middle')->user()->temporary_status == "Apprenticeship") selected @endif>Apprenticeship</option>
                              <option value="Residency" @if(Auth::guard('nurse_middle')->user()->temporary_status == "Residency") selected @endif>Residency</option>
                              <option value="Volunteer" @if(Auth::guard('nurse_middle')->user()->temporary_status == "Volunteer") selected @endif>Volunteer</option>


                            </select>
                          </div>
                          <span id="reqemployee_status" class="reqError text-danger valley"></span>
                        </div>
                        <h6 class="emergency_text">
                          Detailed Job Descriptions
                        </h6>
                        <div class="form-group level-drp">
                          <label class="form-label" for="input-1">Responsibilities</label>
                          <textarea class="form-control" name="job_responeblities[1]"></textarea>
                          <span id="reqresposiblities" class="reqError text-danger valley"></span>
                        </div>
                        <div class="form-group level-drp">
                          <label class="form-label" for="input-1">Achievements</label>
                          <textarea class="form-control" name="achievements[1]"></textarea>
                          <span id="reqachievements" class="reqError text-danger valley"></span>
                        </div>

                        <h6 class="emergency_text">
                          Areas of Expertise
                        </h6>
                        <div class="form-group level-drp">

                          <label class="form-label" for="input-1">Specific skills and competencies</label>
                          <?php
                          $skills = DB::table("skills")->where("parent_id", "1")->get();
                          ?>
                          <ul id="skills_compantancies" style="display:none;">
                            @foreach($skills as $cert)
                            <li data-value="{{ $cert->id }}">{{ $cert->name }}</li>
                            @endforeach
                          </ul>
                          <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="skills_compantancies" name="skills_compantancies[1][]" multiple="multiple"></select>
                        </div>
                        <span id="reqexpertise" class="reqError text-danger valley"></span>
                        <div class="skills_compantancies_dropdowns"></div>
                        <div class="form-group level-drp">
                          <label class="form-label" for="input-1">Type of evidence</label>
                          <?php
                          $skills = DB::table("skills")->get();
                          ?>
                          <ul id="type_of_evidence" style="display:none;">

                            <li data-value="Statement of Service">Statement of Service</li>
                            <li data-value="Statutory Declaration">Statutory Declaration</li>
                            <li data-value="Award">Award</li>
                            <li data-value="Transcript">Transcript</li>
                            <li data-value="Certificate">Certificate</li>
                          </ul>
                          <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="type_of_evidence" name="type_of_evidence[1][]" multiple="multiple"></select>
                          <span id="reqtype_evidence" class="reqError text-danger valley"></span>
                        </div>
                        <div class="form-group level-drp">
                          <label class="form-label" for="input-1">Upload evidence</label>

                          <input class="form-control" type="file" name="upload_evidence">

                          <!-- <span id="reqachievements" class="reqError text-danger valley"></span> -->
                        </div>
                      </div>
                      <div class="add_new_certification_div awe mb-3 mt-4">
                        <a style="cursor: pointer;" onclick="add_work_experience()">+ Add another work experience</a>
                      </div>
                      <div class="declaration_box">
                        <input type="checkbox" name="exp_declare_information" class="exp_declare_information" value="1">
                        <label for="declare_information">I declare that the information provided is true and correct</label>
                      </div>
                      <div class="box-button mt-15">
                        <button class="btn btn-apply-big font-md font-bold" type="submit" id="submitExperience">Save Changes</button>
                      </div>
                  </form>
                </div>
                @endif
                
              </div>
              
              
              
              
              
              <div class="tab-pane fade" id="tab-work-preferences" role="tabpanel" aria-labelledby="tab-interview-references" style="display: none">
                <h3 class="mt-30 color-brand-1 mb-50">Job Search Preferences</h3>
                <?php
                $workpreferenceData = DB::table("work_preferences")->where("user_id", Auth::guard('nurse_middle')->user()->id)->first();
                ?>
                <form id="workpreference_form" method="POST" onsubmit="return updateWorkPreference()">
                  @csrf
                  <input type="hidden" name="user_id" value="{{ Auth::guard('nurse_middle')->user()->id }}">
                  <div class="form-group level-drp">
                    <label class="form-label" for="input-1">Desired Job Roles </label>
                    <input type="hidden" name="desired_job_roles" class="desired_job_roles" value="@if(!empty($workpreferenceData)){{ $workpreferenceData->desired_job_role }}@endif">
                    <?php
                    $practitioner_type = DB::table("practitioner_type")->get();
                    ?>
                    <ul id="des_job_role" style="display:none;">
                      @foreach($practitioner_type as $cert)
                      <li data-value="{{ $cert->id }}">{{ $cert->name }}</li>
                      @endforeach

                    </ul>
                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="des_job_role" name="des_job_role[]" multiple="multiple"></select>

                  </div>
                  <span id="reqjobroles" class="reqError text-danger valley"></span>
                  <div class="form-group level-drp">
                    <label class="form-label" for="input-1">Salary Expectations</label>
                    <input type="text" name="salary_expectation" class="form-control" value="@if(!empty($workpreferenceData)){{ $workpreferenceData->salary_expectations }}@endif">
                    <span id="reqsalaryexp" class="reqError text-danger valley"></span>
                  </div>
                  <div class="form-group level-drp">
                    <label class="form-label" for="input-1">Benefits Preferences </label>
                    <input type="hidden" name="benefit_preferences" class="benefit_preferences" value="@if(!empty($workpreferenceData)){{ $workpreferenceData->benefits_preferences }}@endif">

                    <ul id="benefit_prefer" style="display:none;">
                      <li data-value="Health insurance">Health insurance</li>
                      <li data-value="Retirement plans">Retirement plans</li>
                    </ul>
                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="benefit_prefer" name="benefit_prefer[]" multiple="multiple"></select>

                  </div>
                  <span id="reqbenefitsprefer" class="reqError text-danger valley"></span>
                  <div class="box-button mt-15">
                    <button class="btn btn-apply-big font-md font-bold" type="submit" id="submitWorkPreferences">Save Changes</button>
                  </div>
                </form>
              </div>
              
              <div class="tab-pane fade" id="tab-professional-membership" role="tabpanel" aria-labelledby="tab-interview-references" style="display: none">

                <div class="card shadow-sm border-0 p-4 mt-30">
                  <h3 class="mt-0 color-brand-1 mb-2">Professional Memberships</h3>
                  <?php
                  $MembershipData = DB::table("professional_membership")->where("user_id", Auth::guard('nurse_middle')->user()->id)->first();
                  ?>
                  <form id="professional_memb_form" method="POST" >
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::guard('nurse_middle')->user()->id }}">
                    <div class="form-group level-drp">
                      <label class="form-label" for="input-1">Professional Associations </label>

                      <input type="hidden" name="professional_as" class="professional_as" value="@if(!empty($MembershipData)){{ $MembershipData->des_profession_association }}@endif">
                      <ul id="des_profession_association" style="display:none;">

                        <li data-value="ANA">ANA</li>
                        <li data-value="ENA">ENA</li>

                      </ul>
                      <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="des_profession_association" name="des_profession_association[]" multiple="multiple"></select>
                      <span id="reqprofessassociation" class="reqError text-danger valley"></span>
                    </div>
                    <div class="form-group level-drp">
                      <label class="form-label" for="input-1">Membership Numbers</label>
                      <input type="text" name="prof_membership_numbers" class="form-control" value="@if(!empty($MembershipData)){{ $MembershipData->membership_numbers }}@endif">
                      <span id="reqmembernumbers" class="reqError text-danger valley"></span>
                    </div>
                    <div class="form-group level-drp">
                      <label class="form-label" for="input-1">Status</label>
                      <select class="form-control" name="prof_membership_status" id="language-picker-select">
                        <option value="">Select Status</option>
                        <option value="Active" @if(!empty($MembershipData) && $MembershipData->membership_status == "Active") selected @endif>Active</option>
                        <option value="Lapsed" @if(!empty($MembershipData) && $MembershipData->membership_status == "Lapsed") selected @endif>Lapsed</option>

                      </select>
                      <span id="reqmemberstatus" class="reqError text-danger valley"></span>
                    </div>
                    <div class="box-button mt-15">
                      <button class="btn btn-apply-big font-md font-bold" type="submit" id="submitProfessionalMembership">Save Changes</button>
                    </div>
                  </form>
                </div>
              </div>
              
              <div class="tab-pane fade" id="tab-vaccination">
                <div class="card shadow-sm border-0 p-4 mt-30">
                  <h3 class="mt-0 color-brand-1 mb-20">Vaccinations</h3>
                  <?php
                  $vaccinationData = DB::table("vaccination_front")->where("user_id", Auth::guard('nurse_middle')->user()->id)->first();
                  //print_r($vaccinationData);
                  ?>
                  <form id="vaccination_form" method="POST" onsubmit="return vaccinationForm()">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::guard('nurse_middle')->user()->id }}">
                    <div class="row">
                      <div class="col-md-12">
                        <p class="">Please upload all your vaccination records as required for your desired roles and state. You may also add non-mandatory vaccines and any additional vaccinations not listed. Keeping your vaccinations up to date will help maintain your eligibility for your role.</p>
                        <p class="mt-2">To ensure your evidence is compliant, please refer to our guide Vaccination Compliance and Evidence Requirements by State.</p>
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
        <footer class="footer pt-0" style="margin: 0 11px;">

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

        </footer>
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


<!-- Add All button & Remove all button code End -->

<!-- <script>
        $(document).ready(function() {
            // Initialize Select2
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
        });
    </script> -->
<script type="text/javascript">
  $('.post_code').keypress(function(e) {

    var charCode = (e.which) ? e.which : event.keyCode

    if (String.fromCharCode(charCode).match(/[^0-9]/g))

      return false;

  });
  $('#contactI').keypress(function(e) {

    var charCode = (e.which) ? e.which : event.keyCode

    if (String.fromCharCode(charCode).match(/[^0-9]/g))

      return false;

  });
  $('#emergency_country_iso').keypress(function(e) {

    var charCode = (e.which) ? e.which : event.keyCode

    if (String.fromCharCode(charCode).match(/[^0-9]/g))

      return false;

  });
  $('.js-example-basic-multiple').each(function() {
    let listId = $(this).data('list-id');
    //alert(listId);
    let items = [];
    console.log("listId1", listId);
    $('#' + listId + ' li').each(function() {
      console.log("value1", $(this).text());
      items.push({
        id: $(this).data('value'),
        text: $(this).text()
      });
    });
    console.log("items1", items);
    $(this).select2({
      data: items
    });
    //$("#type-of-nurse").select2({'val': 3});          
  });
  //$("#type-of-nurse").val([1,2,3], null, false);
  //$("#type-of-nurse").select2().select 2("val", [1,2,3]);
  if ($(".ntype").val() != "") {
    var nurse_type = JSON.parse($(".ntype").val());
    $('#nurse_type').select2().val(nurse_type).trigger('change');
  }

  if ($(".nursing_result_one").val() != "") {
    var entry_level = JSON.parse($(".nursing_result_one").val());
    $('.js-example-basic-multiple[data-list-id="nursing_entry-1"]').select2().val(entry_level).trigger('change');
  }


  if ($(".nursing_result_two").val() != "") {
    var registered_nurses = JSON.parse($(".nursing_result_two").val());
    $('.js-example-basic-multiple[data-list-id="nursing_entry-2"]').select2().val(registered_nurses).trigger('change');
  }

  // if ($(".nursing_result_two_experience").val() != "") {
  //   var registered_nurses = JSON.parse($(".nursing_result_two_experience").val());
  //   $('.js-example-basic-multiple[data-list-id="nursing_entry_experience-2"]').select2().val(registered_nurses).trigger('change');
  // }

  if ($(".nursing_result_three").val() != "") {
    var advanced_practioner = JSON.parse($(".nursing_result_three").val());
    $('.js-example-basic-multiple[data-list-id="nursing_entry-3"]').select2().val(advanced_practioner).trigger('change');
  }

  // if ($(".nursing_result_three_experience").val() != "") {
  //   var advanced_practioner = JSON.parse($(".nursing_result_three_experience").val());
  //   $('.js-example-basic-multiple[data-list-id="nursing_entry_experience-3"]').select2().val(advanced_practioner).trigger('change');
  // }

  if ($(".np_result").val() != "") {
    var nurse_prac = JSON.parse($(".np_result").val());
    $('.js-example-basic-multiple[data-list-id="nurse_practitioner_menu"]').select2().val(nurse_prac).trigger('change');
  }

  if ($(".np_result_experience").val() != "") {
    var nurse_prac = JSON.parse($(".np_result_experience").val());
    $('.js-example-basic-multiple[data-list-id="nurse_practitioner_menu_experience"]').select2().val(nurse_prac).trigger('change');
  }

  if ($(".specialties_result").val() != "") {
    var specialties = JSON.parse($(".specialties_result").val());
    $('.js-example-basic-multiple[data-list-id="specialties"]').select2().val(specialties).trigger('change');
  }

  if ($(".specialties_result_experience").val() != "") {
    var specialties = JSON.parse($(".specialties_result_experience").val());
    $('.js-example-basic-multiple[data-list-id="specialties_experience"]').select2().val(specialties).trigger('change');
  }

  if ($(".adults_result").val() != "") {
    var adults = JSON.parse($(".adults_result").val());
    $('.js-example-basic-multiple[data-list-id="speciality_entry-1"]').select2().val(adults).trigger('change');
  }

  if ($(".maternity_result").val() != "") {
    var maternity = JSON.parse($(".maternity_result").val());
    $('.js-example-basic-multiple[data-list-id="speciality_entry-2"]').select2().val(maternity).trigger('change');
  }

  if ($(".padneonatal_result").val() != "") {
    var paediatrics_neonatal = JSON.parse($(".padneonatal_result").val());
    $('.js-example-basic-multiple[data-list-id="speciality_entry-3"]').select2().val(paediatrics_neonatal).trigger('change');
  }

  if ($(".community_result").val() != "") {
    var community = JSON.parse($(".community_result").val());
    $('.js-example-basic-multiple[data-list-id="speciality_entry-4"]').select2().val(community).trigger('change');
  }

  if ($(".adults_result_experience").val() != "") {
    var adults = JSON.parse($(".adults_result_experience").val());
    $('.js-example-basic-multiple[data-list-id="speciality_entry_experience-1"]').select2().val(adults).trigger('change');
  }

  if ($(".maternity_result_experience").val() != "") {
    var maternity = JSON.parse($(".maternity_result_experience").val());
    $('.js-example-basic-multiple[data-list-id="speciality_entry_experience-2"]').select2().val(maternity).trigger('change');
  }

  if ($(".padneonatal_result_experience").val() != "") {
    var paediatrics_neonatal = JSON.parse($(".padneonatal_result_experience").val());
    $('.js-example-basic-multiple[data-list-id="speciality_entry_experience-3"]').select2().val(paediatrics_neonatal).trigger('change');
  }

  if ($(".community_result_experience").val() != "") {
    var community = JSON.parse($(".community_result_experience").val());
    $('.js-example-basic-multiple[data-list-id="speciality_entry_experience-4"]').select2().val(community).trigger('change');
  }

  if ($(".surgical_preoperative_result").val() != "") {
    var surgical_preoperative = JSON.parse($(".surgical_preoperative_result").val());
    $('.js-example-basic-multiple[data-list-id="surgical_row_box"]').select2().val(surgical_preoperative).trigger('change');
  }

  if ($(".surgical_preoperative_result_experience").val() != "") {
    var surgical_preoperative = JSON.parse($(".surgical_preoperative_result_experience").val());
    $('.js-example-basic-multiple[data-list-id="surgical_row_box_experience"]').select2().val(surgical_preoperative).trigger('change');
  }

  if ($(".operatingroom_result").val() != "") {
    var operating_room = JSON.parse($(".operatingroom_result").val());
    $('.js-example-basic-multiple[data-list-id="surgical_operative_care-1"]').select2().val(operating_room).trigger('change');
  }

  if ($(".operatingroom_result_experience").val() != "") {
    var operating_room = JSON.parse($(".operatingroom_result_experience").val());
    $('.js-example-basic-multiple[data-list-id="surgical_operative_care_experience-1"]').select2().val(operating_room).trigger('change');
  }

  if ($(".operatingscout_result").val() != "") {
    var operating_room_scout = JSON.parse($(".operatingscout_result").val());
    $('.js-example-basic-multiple[data-list-id="surgical_operative_care-2"]').select2().val(operating_room_scout).trigger('change');
  }

  if ($(".operatingscout_result_experience").val() != "") {
    var operating_room_scout = JSON.parse($(".operatingscout_result_experience").val());
    $('.js-example-basic-multiple[data-list-id="surgical_operative_care_experience-2"]').select2().val(operating_room_scout).trigger('change');
  }

  if ($(".operatingscrub_result").val() != "") {
    var operating_room_scrub = JSON.parse($(".operatingscrub_result").val());
    $('.js-example-basic-multiple[data-list-id="surgical_operative_care-3"]').select2().val(operating_room_scrub).trigger('change');
  }

  if ($(".operatingscrub_result_experience").val() != "") {
    var operating_room_scrub = JSON.parse($(".operatingscrub_result_experience").val());
    $('.js-example-basic-multiple[data-list-id="surgical_operative_care_experience-3"]').select2().val(operating_room_scrub).trigger('change');
  }

  if ($(".surgical_ob_result").val() != "") {
    var surgical_obstrics_gynacology = JSON.parse($(".surgical_ob_result").val());
    $('.js-example-basic-multiple[data-list-id="surgical_obs_care"]').select2().val(surgical_obstrics_gynacology).trigger('change');
  }

  if ($(".neonatal_care_result").val() != "") {
    var neonatal_care = JSON.parse($(".neonatal_care_result").val());
    $('.js-example-basic-multiple[data-list-id="neonatal_care"]').select2().val(neonatal_care).trigger('change');
  }

  if ($(".neonatal_care_result_experience").val() != "") {
    var neonatal_care = JSON.parse($(".neonatal_care_result_experience").val());
    $('.js-example-basic-multiple[data-list-id="neonatal_care_experience"]').select2().val(neonatal_care).trigger('change');
  }

  if ($(".paedia_surgical_result").val() != "") {
    var paedia_surgical_preoperative = JSON.parse($(".paedia_surgical_result").val());
    $('.js-example-basic-multiple[data-list-id="surgical_rowpad_box"]').select2().val(paedia_surgical_preoperative).trigger('change');
  }

  if ($(".paedia_surgical_result_experience").val() != "") {
    var paedia_surgical_preoperative = JSON.parse($(".paedia_surgical_result_experience").val());
    $('.js-example-basic-multiple[data-list-id="surgical_rowpad_box_experience"]').select2().val(paedia_surgical_preoperative).trigger('change');
  }

  if ($(".pad_op_room_result").val() != "") {
    var pad_op_room = JSON.parse($(".pad_op_room_result").val());
    $('.js-example-basic-multiple[data-list-id="surgical_operative_carep-1"]').select2().val(pad_op_room).trigger('change');
  }

  if ($(".pad_qr_scout_result").val() != "") {
    var pad_qr_scout = JSON.parse($(".pad_qr_scout_result").val());
    $('.js-example-basic-multiple[data-list-id="surgical_operative_carep-2"]').select2().val(pad_qr_scout).trigger('change');
  }

  if ($(".pad_qr_scrub_result").val() != "") {
    var pad_qr_scrub = JSON.parse($(".pad_qr_scrub_result").val());
    $('.js-example-basic-multiple[data-list-id="surgical_operative_carep-3"]').select2().val(pad_qr_scrub).trigger('change');
  }

  if ($(".pad_op_room_result_experience").val() != "") {
    var pad_op_room = JSON.parse($(".pad_op_room_result_experience").val());
    console.log("pad_op_room", pad_op_room);
    $('.js-example-basic-multiple[data-list-id="surgical_operative_carep_experience-1"]').select2().val(pad_op_room).trigger('change');
  }

  if ($(".pad_qr_scout_result_experience").val() != "") {
    var pad_qr_scout = JSON.parse($(".pad_qr_scout_result_experience").val());
    console.log("pad_qr_scout", pad_qr_scout);
    $('.js-example-basic-multiple[data-list-id="surgical_operative_carep_experience-2"]').select2().val(pad_qr_scout).trigger('change');
  }

  if ($(".pad_qr_scrub_result_experience").val() != "") {
    var pad_qr_scrub = JSON.parse($(".pad_qr_scrub_result_experience").val());
    $('.js-example-basic-multiple[data-list-id="surgical_operative_carep_experience-3"]').select2().val(pad_qr_scrub).trigger('change');
  }

  if ($(".nurse_degree_one").val() != "") {
    var nurse_degree = JSON.parse($(".nurse_degree_one").val());
    $('.js-example-basic-multiple[data-list-id="ndegree"]').select2().val(nurse_degree).trigger('change');
  }

  if ($(".prof_cert_new").val() != "") {
    var prof_cert_new = JSON.parse($(".prof_cert_new").val());
    $('.js-example-basic-multiple[data-list-id="profess_cert"]').select2().val(prof_cert_new).trigger('change');
  }

  

  if ($(".desired_job_roles").val() != "") {
    var desired_job_roles = JSON.parse($(".desired_job_roles").val());
    $('.js-example-basic-multiple[data-list-id="des_job_role"]').select2().val(desired_job_roles).trigger('change');
  }

  if ($(".benefit_preferences").val() != "") {
    var benefit_preferences = JSON.parse($(".benefit_preferences").val());
    $('.js-example-basic-multiple[data-list-id="benefit_prefer"]').select2().val(benefit_preferences).trigger('change');
  }

  if ($(".vaccination_r").val() != "") {
    var vaccination_record = JSON.parse($(".vaccination_r").val());
    $('.js-example-basic-multiple[data-list-id="vaccination_record"]').select2().val(vaccination_record).trigger('change');
  }

  if ($(".pro_cert_acls").val() != "") {
    var pro_cert_acls = JSON.parse($(".pro_cert_acls").val());
    console.log("pro_cert_acls", pro_cert_acls);
    $('.js-example-basic-multiple[data-list-id="acls_data"]').select2().val(pro_cert_acls).trigger('change');
  }

  if ($(".pro_cert_bls").val() != "") {
    var pro_cert_bls = JSON.parse($(".pro_cert_bls").val());
    console.log("pro_cert_bls", pro_cert_bls);
    $('.js-example-basic-multiple[data-list-id="bls_data"]').select2().val(pro_cert_bls).trigger('change');
  }

  if ($(".pro_cert_cpr").val() != "") {
    var pro_cert_cpr = JSON.parse($(".pro_cert_cpr").val());
    console.log("pro_cert_bls", pro_cert_cpr);
    $('.js-example-basic-multiple[data-list-id="cpr_data"]').select2().val(pro_cert_cpr).trigger('change');
  }

  if ($(".pro_cert_nrp").val() != "") {
    var pro_cert_nrp = JSON.parse($(".pro_cert_nrp").val());
    console.log("pro_cert_bls", pro_cert_nrp);
    $('.js-example-basic-multiple[data-list-id="nrp_data"]').select2().val(pro_cert_nrp).trigger('change');
  }

  if ($(".pro_cert_pals").val() != "") {
    var pro_cert_pals = JSON.parse($(".pro_cert_pals").val());
    console.log("pro_cert_bls", pro_cert_pals);
    $('.js-example-basic-multiple[data-list-id="pls_data"]').select2().val(pro_cert_pals).trigger('change');
  }

  if ($(".pro_cert_rn").val() != "") {
    var pro_cert_rn = JSON.parse($(".pro_cert_rn").val());
    console.log("pro_cert_bls", pro_cert_rn);
    $('.js-example-basic-multiple[data-list-id="rn_data"]').select2().val(pro_cert_rn).trigger('change');
  }

  if ($(".pro_cert_np").val() != "") {
    var pro_cert_np = JSON.parse($(".pro_cert_np").val());
    console.log("pro_cert_bls", pro_cert_np);
    $('.js-example-basic-multiple[data-list-id="np_data"]').select2().val(pro_cert_np).trigger('change');
  }

  if ($(".pro_cert_cna").val() != "") {
    var pro_cert_cna = JSON.parse($(".pro_cert_cna").val());
    console.log("pro_cert_bls", pro_cert_cna);
    $('.js-example-basic-multiple[data-list-id="cn_data"]').select2().val(pro_cert_cna).trigger('change');
  }

  if ($(".pro_cert_lpn").val() != "") {
    var pro_cert_lpn = JSON.parse($(".pro_cert_lpn").val());
    console.log("pro_cert_bls", pro_cert_lpn);
    $('.js-example-basic-multiple[data-list-id="lpn_data"]').select2().val(pro_cert_lpn).trigger('change');
  }

  if ($(".pro_cert_crna").val() != "") {
    var pro_cert_crna = JSON.parse($(".pro_cert_crna").val());
    console.log("pro_cert_bls", pro_cert_crna);
    $('.js-example-basic-multiple[data-list-id="crn_data"]').select2().val(pro_cert_crna).trigger('change');
  }

  if ($(".pro_cert_cnm").val() != "") {
    var pro_cert_cnm = JSON.parse($(".pro_cert_cnm").val());
    console.log("pro_cert_bls", pro_cert_cnm);
    $('.js-example-basic-multiple[data-list-id="cnm_data"]').select2().val(pro_cert_cnm).trigger('change');
  }

  if ($(".pro_cert_ons").val() != "") {
    var pro_cert_ons = JSON.parse($(".pro_cert_ons").val());
    console.log("pro_cert_bls", pro_cert_ons);
    $('.js-example-basic-multiple[data-list-id="ons_data"]').select2().val(pro_cert_ons).trigger('change');
  }

  if ($(".pro_cert_msw").val() != "") {
    var pro_cert_msw = JSON.parse($(".pro_cert_msw").val());
    console.log("pro_cert_bls", pro_cert_msw);
    $('.js-example-basic-multiple[data-list-id="msw_data"]').select2().val(pro_cert_msw).trigger('change');
  }

  if ($(".pro_cert_ain").val() != "") {
    var pro_cert_ain = JSON.parse($(".pro_cert_ain").val());
    console.log("pro_cert_bls", pro_cert_ain);
    $('.js-example-basic-multiple[data-list-id="ain_data"]').select2().val(pro_cert_ain).trigger('change');
  }

  if ($(".pro_cert_rpn").val() != "") {
    var pro_cert_rpn = JSON.parse($(".pro_cert_rpn").val());
    console.log("pro_cert_bls", pro_cert_rpn);
    $('.js-example-basic-multiple[data-list-id="rpn_data"]').select2().val(pro_cert_rpn).trigger('change');
  }

  if ($(".pro_cert_nl").val() != "") {
    var pro_cert_nl = JSON.parse($(".pro_cert_nl").val());
    console.log("pro_cert_bls", pro_cert_nl);
    $('.js-example-basic-multiple[data-list-id="nlc_data"]').select2().val(pro_cert_nl).trigger('change');
  }

  if ($(".professional_as").val() != "") {
    var professional_as = JSON.parse($(".professional_as").val());
    console.log("professional_as", professional_as);
    $('.js-example-basic-multiple[data-list-id="des_profession_association"]').select2().val(professional_as).trigger('change');
  }


  

  









  var specialties = $('.js-example-basic-multiple[data-list-id="specialties"]').select2("data");

  var adults_list = $('.js-example-basic-multiple[data-list-id="speciality_entry-1"]').select2("data");
  for (var b = 0; b < adults_list.length; b++) {
    if (adults_list[b].id == "96") {
      $(".surgical_row_data").removeClass('d-none');
    }
  }



  for (var y = 0; y < specialties.length; y++) {
    $(".speciality_" + specialties[y].id).removeClass('d-none');
  }

  var maternity_list = $('.js-example-basic-multiple[data-list-id="speciality_entry-2"]').select2("data");

  for (var b = 0; b < maternity_list.length; b++) {
    if (maternity_list[b].id == "233") {
      $(".surgicalobs_row").removeClass('d-none');
    }
  }


  var padneonatal_list = $('.js-example-basic-multiple[data-list-id="speciality_entry-3"]').select2("data");
  for (var c = 0; c < padneonatal_list.length; c++) {
    if (padneonatal_list[c].id == "250") {
      $(".neonatal_row").removeClass('d-none');
    }

    if (padneonatal_list[c].id == "285") {
     // $(".surgicalpad_row_data").removeClass('d-none');
    }
  }




  var padneonatalsurgical_list = $('.js-example-basic-multiple[data-list-id="surgical_rowpad_box"]').select2("data");

  for (var l = 0; l < padneonatalsurgical_list.length; l++) {
    $(".surgicalpad_row-" + padneonatalsurgical_list[l].id).removeClass('d-none');
  }









   $("#tab-vaccination").insertAfter("#tab-educert");


  var nurse_array = [];
  
  // Show corresponding job lists when an option is selected in the first select
  $('.js-example-basic-multiple[data-list-id="type-of-nurse"]').on('change', function() {
    let selectedValues = $(this).val();
    //alert("hello");
    var nurse_len = $("#type-of-nurse li").length;
    console.log("nurse_len", nurse_len);

    //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

    console.log("selectedValues", selectedValues);
    //$('.result--show .form-group').addClass('d-none');

    for (var i = 1; i <= nurse_len; i++) {
      var nurse_result_val = $(".nursing_result-" + i).val();
      //alert(nurse_result_val);
      if (selectedValues.includes(nurse_result_val)) {

        $('#nursing_level-' + i).removeClass('d-none');
      } else {
        $('#nursing_level-' + i).addClass('d-none');
        $('.js-example-basic-multiple[data-list-id="nursing_entry-' + i + '"]').select2().val(null).trigger('change');
      }
    }

    if (selectedValues.includes("3") == false) {
      $('.np_submenu').addClass('d-none');
      //$('.js-example-basic-multiple[data-list-id="nursing_entry-3"]').select2().val(null).trigger('change');
      $('.js-example-basic-multiple[data-list-id="nurse_practitioner_menu"]').select2().val(null).trigger('change');
    }



  
  });

  

  $('.js-example-basic-multiple[data-list-id="skills_compantancies"]').on('change', function() {
    // Get selected values from the main category dropdown
    let selectedValues = $(this).val();

    // Keep track of existing dropdowns
    let existingDropdowns = [];
    $('.skills_compantancies_dropdowns .js-example-basic-multiple1').each(function() {
      existingDropdowns.push($(this).data('list-id'));
    });

    // Loop through selected values
    selectedValues.forEach(function(value) {
      // Check if the dropdown for this ID already exists
      if (!existingDropdowns.includes(`skills_compantancies-${value}`)) {
        // Fetch submenu data for new IDs
        $.ajax({
          type: "POST",
          url: "{{ url('/nurse') }}/getSkillsData",
          data: {
            id: value,
            _token: "{{ csrf_token() }}"
          },
          cache: false,
          success: function(data) {
            var skills = JSON.parse(data);
            var skills_data = '';
            skills.forEach(function(skill) {
              skills_data += '<li data-value="' + skill.id + '">' + skill.name + '</li>';
            });

            // Create submenu HTML
            var dropdownHtml = `
            <div class="form-group level-drp">
              <label class="form-label" for="input-1">${skills[0].parent_name}</label>
              <ul id="skills_compantancies-${skills[0].parent_id}" style="display:none;">
                ${skills_data}
              </ul>
              <select class="js-example-basic-multiple1 addAll_removeAll_btn" 
                      data-list-id="skills_compantancies-${skills[0].parent_id}" 
                      name="sub_skills_compantancies[1][]" multiple="multiple">
              </select>
            </div>
          `;

            // Append the new dropdown
            $(".skills_compantancies_dropdowns").append(dropdownHtml);

            // Populate the new dropdown with options
            let listId = `skills_compantancies-${skills[0].parent_id}`;
            let items = [];

            $('#' + listId + ' li').each(function() {
              items.push({
                id: $(this).data('value'),
                text: $(this).text()
              });
            });

            let $newDropdown = $(`[data-list-id="${listId}"]`);
            $newDropdown.select2({
              data: items
            });

            // Add select all/remove all functionality
            initializeSelect2($newDropdown);
          }
        });
      }
    });

    // Remove dropdowns for deselected IDs
    if (selectedValues && selectedValues.length > 0) {
      $('.skills_compantancies_dropdowns .js-example-basic-multiple1').each(function() {
        let listId = $(this).data('list-id');
        let id = listId.replace('skills_compantancies-', '');
        if (!selectedValues.includes(id)) {
          $(this).closest('.form-group').remove();
        }
      });
    }
  });

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

  $('.js-example-basic-multiple[data-list-id="type-of-nurse-experience"]').on('change', function() {

    let selectedValues = $(this).val();

    var nurse_len = $("#type-of-nurse-experience li").length;
    console.log("nurse_len", nurse_len);

    //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

    console.log("selectedValues", selectedValues);
    //$('.result--show .form-group').addClass('d-none');

    for (var i = 1; i <= nurse_len; i++) {
      var nurse_result_val = $(".nursing_result_experience-" + i).val();
      //alert(nurse_result_val);
      if (selectedValues.includes(nurse_result_val)) {
        $('#nursing_level_experience-' + i).removeClass('d-none');
      } else {
        $('#nursing_level_experience-' + i).addClass('d-none');
        $('.js-example-basic-multiple[data-list-id="nursing_entry_experience-' + i + '"]').select2().val(null).trigger('change');
      }
    }

    if (selectedValues.includes("3") == false) {
      $('.np_submenu_experience').addClass('d-none');
      //$('.js-example-basic-multiple[data-list-id="nursing_entry-3"]').select2().val(null).trigger('change');
      $('.js-example-basic-multiple[data-list-id="nurse_practitioner_menu_experience"]').select2().val(null).trigger('change');
    }



    // if (selectedValues.includes("Entry level nursing")) {
    //     $('#elnj').removeClass('d-none');
    // }
    // if (selectedValues.includes("Registered Nurses (RNs)")) {
    //     $('#rns').removeClass('d-none');
    // }
    // if (selectedValues.includes("Advanced Practice Registered Nurses (APRNs)")) {
    //     $('#aprns').removeClass('d-none');
    // }
  });

  $('.js-example-basic-multiple[data-list-id="nursing_entry-3"]').on('change', function() {
    let selectedValues = $(this).val();
    //alert("hello");
    var nurse_len = $("#type-of-nurse li").length;
    console.log("nurse_len", nurse_len);

    //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));
    if (selectedValues.includes("179")) {
      $('.np_submenu').removeClass('d-none');
      console.log("selectedValues", selectedValues);
    } else {
      $('.np_submenu').addClass('d-none');
      $('.js-example-basic-multiple[data-list-id="nurse_practitioner_menu"]').select2().val(null).trigger('change');
    }



  });

  $('.js-example-basic-multiple[data-list-id="specialties"]').on('change', function() {
    let selectedValues = $(this).val();
    //alert("hello");
    var speciality_len = $("#specialties li").length;
    console.log("speciality_len", speciality_len);

    //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

    console.log("selectedValues", selectedValues);
    //$('.result--show .form-group').addClass('d-none');

    for (var k = 1; k <= speciality_len; k++) {
      var speciality_result_val = $(".speciality_result-" + k).val();
      //alert(speciality_result_val);
      if (selectedValues.includes(speciality_result_val)) {

        $('#specility_level-' + k).removeClass('d-none');
        //$(".sub_speciality_value").val(k);

      } else {
        $('#specility_level-' + k).addClass('d-none');
        $('.js-example-basic-multiple[data-list-id="speciality_entry-' + k + '"]').select2().val(null).trigger('change');
      }
    }

    if (selectedValues.includes("1") == false) {
      $('.surgical_row').addClass('d-none');
      $('.surgical_row_data').addClass('d-none');
      $('.js-example-basic-multiple[data-list-id="surgical_row_box"]').select2().val(null).trigger('change');
    }
    if (selectedValues.includes("2") == false) {

      $('.surgicalobs_row').addClass('d-none');
      $('.js-example-basic-multiple[data-list-id="surgicalobs_row_data"]').select2().val(null).trigger('change');
    }

    if (selectedValues.includes("3") == false) {

     // $('.surgicalpad_row_data').addClass('d-none');
      $('.surgical_rowp_data').addClass('d-none');
      $('.neonatal_row').addClass('d-none');
      //$('.js-example-basic-multiple[data-list-id="surgicalobs_row_data"]').select2().val(null).trigger('change');
    }


  });

  $('.js-example-basic-multiple[data-list-id="specialties_experience"]').on('change', function() {
    let selectedValues = $(this).val();
    var speciality_len = $("#specialties_experience li").length;
    console.log("speciality_len", speciality_len);

    //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));
    console.log("selectedValues", selectedValues);
    //$('.result--show .form-group').addClass('d-none');

    for (var k = 1; k <= speciality_len; k++) {
      var speciality_result_val = $(".speciality_result_experience-" + k).val();
      //alert(speciality_result_val);
      if (selectedValues.includes(speciality_result_val)) {

        $('#specility_level_experience-' + k).removeClass('d-none');
        //$(".sub_speciality_value").val(k);
        console.log('1');
      } else {
        console.log('2');
        $('#specility_level_experience-' + k).addClass('d-none');
        $('.js-example-basic-multiple[data-list-id="speciality_entry_experience-' + k + '"]').select2().val(null).trigger('change');
      }
    }

    if (selectedValues.includes("1") == false) {

      $('.surgical_row_experience').addClass('d-none');
      $('.surgical_row_data_experience').addClass('d-none');
      $('.js-example-basic-multiple[data-list-id="surgical_row_box_experience"]').select2().val(null).trigger('change');
    }
    if (selectedValues.includes("2") == false) {

      $('.surgicalobs_row_experience').addClass('d-none');
      $('.js-example-basic-multiple[data-list-id="surgicalobs_row_data_experience"]').select2().val(null).trigger('change');
    }

    if (selectedValues.includes("3") == false) {
      console.log('5');
      $('.surgicalpad_row_data_experience').addClass('d-none');
      $('.surgical_rowp_data_experience').addClass('d-none');
      $('.neonatal_row_experience').addClass('d-none');
      //$('.js-example-basic-multiple[data-list-id="surgicalobs_row_data"]').select2().val(null).trigger('change');
    }


  });

  $('.js-example-basic-multiple[data-list-id="nursing_entry_experience-3"]').on('change', function() {
    let selectedValues = $(this).val();
    //alert("hello");
    var nurse_len = $("#type-of-nurse li").length;
    console.log("nurse_len", nurse_len);

    //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));
    if (selectedValues.includes("179")) {
      $('.np_submenu_experience').removeClass('d-none');
      console.log("selectedValues", selectedValues);
    } else {
      $('.np_submenu_experience').addClass('d-none');
      $('.js-example-basic-multiple[data-list-id="nurse_practitioner_menu_experience"]').select2().val(null).trigger('change');
    }



  });

  var sub_specialty_data_val = $(".sub_speciality_value").val();
  console.log("specialty_data_len", sub_specialty_data_val);

  $('.js-example-basic-multiple[data-list-id="speciality_entry-1"]').on('change', function() {
    let selectedValues = $(this).val();
    //alert("hello");
    var speciality_entry = $("#speciality_entry-1 li").length;
    console.log("speciality_entry", speciality_entry);
    // $(".surgical_row").wrapAll("<div class='col-md-12 row surgical_row_data'>");
    $(".surgical_row_data").insertAfter("#specility_level-1");
    //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

    console.log("selectedValues", selectedValues.includes("96"));
    //$('.result--show .form-group').addClass('d-none');

    if (selectedValues.includes("96")) {
      $('.surgical_row_data').removeClass('d-none');
    } else {
      $('.surgical_row_data').addClass('d-none');
      $('.js-example-basic-multiple[data-list-id="surgical_row_box"]').select2().val(null).trigger('change');
    }

    if (selectedValues.includes("96") == false) {
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

  $('.js-example-basic-multiple[data-list-id="speciality_entry_experience-1"]').on('change', function() {
    let selectedValues = $(this).val();
    //alert("hello");
    var speciality_entry = $("#speciality_entry_experience-1 li").length;
    console.log("speciality_entry", speciality_entry);
    // $(".surgical_row").wrapAll("<div class='col-md-12 row surgical_row_data'>");
    $(".surgical_row_data_experience").insertAfter("#specility_level_experience-1");
    //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

    console.log("selectedValues", selectedValues.includes("96"));
    //$('.result--show .form-group').addClass('d-none');

    if (selectedValues.includes("96")) {
      $('.surgical_row_data_experience').removeClass('d-none');
    } else {
      $('.surgical_row_data_experience').addClass('d-none');
      $('.js-example-basic-multiple[data-list-id="surgical_row_box_experience"]').select2().val(null).trigger('change');
    }

    if (selectedValues.includes("96") == false) {
      $('.surgical_row_experience').addClass('d-none');
      $('.js-example-basic-multiple[data-list-id="surgical_row_box_experience"]').select2().val(null).trigger('change');
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

  $('.js-example-basic-multiple[data-list-id="speciality_entry_experience-2"]').on('change', function() {
    let selectedValues = $(this).val();

    var speciality_entry = $("#speciality_entry-1 li").length;
    console.log("speciality_entry", speciality_entry);
    // $(".surgicalobs_row").wrapAll("<div class='col-md-12 row surgicalobs_row_data'>");
    $(".surgicalobs_row_experience").insertAfter("#specility_level_experience-2");

    //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

    console.log("selectedValues", selectedValues);
    //$('.result--show .form-group').addClass('d-none');

    if (selectedValues.includes("233")) {
      $('.surgicalobs_row_experience').removeClass('d-none');
    } else {
      $('.surgicalobs_row_experience').addClass('d-none');
      $('.js-example-basic-multiple[data-list-id="surgicalobs_row_data_experience"]').select2().val(null).trigger('change');
    }
  });

  $('.js-example-basic-multiple[data-list-id="surgical_row_box"]').on('change', function() {
    let selectedValues = $(this).val();
    //alert("hello");
    var speciality_entry = $("#surgical_row_box li").length;
    console.log("speciality_entry", speciality_entry);
    // $(".surgical_row").wrapAll("<div class='col-md-12 row surgical_row_data'>");
    $(".specialty_sub_boxes").insertAfter(".surgical_row_data");
    //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

    console.log("selectedValues", selectedValues);
    //$('.result--show .form-group').addClass('d-none');

    // if(selectedValues.includes("97")){
    //     $('.surgical_row').removeClass('d-none');
    // }else{
    //     $('.surgical_row').addClass('d-none');
    // }



    for (var k = 1; k <= speciality_entry; k++) {
      var speciality_result_val = $(".speciality_surgical_result-" + k).val();

      if (selectedValues.includes(speciality_result_val)) {

        $('.surgical_row-' + k).removeClass('d-none');

      } else {
        $('.surgical_row-' + k).addClass('d-none');
        $('.js-example-basic-multiple[data-list-id="surgical_operative_care-' + k + '"]').select2().val(null).trigger('change');
      }
    }
  });

  
  $('.js-example-basic-multiple[data-list-id="np_data"]').on('change', function() {
    let selectedValues = $(this).val();
    var np_certification_array = [];
    $('.np_certification_div').removeClass('d-none');
    $(".np_certification_div h6").each(function() {
      var text = $(this).text();

      if (selectedValues.includes(text) == false) {
        let res = text.split(' ')[0];
        let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
        console.log("res_one", res_one);

        $(".np_" + res_one).remove();
        var user_id = "{{ $user_id }}";
        deleteDatabaseImgs(user_id, "np_imgs");
      }

      np_certification_array.push(text);
    });
    console.log("selectedValues", selectedValues);

    //$(".bls_certification_div").empty();
    for (var i = 0; i < selectedValues.length; i++) {
      var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
      let res = selectedValues[i].split(' ')[0];
      let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
      console.log("res_one", res_one);
      if (np_certification_array.includes(selectedValues[i]) == false) {
        var user_id = "{{ $user_id }}";
        var img_text = "np_imgs";

        $(".np_certification_div").append('<div class="np_' + res_one + ' cert_div_' + selected_text + '"><h6 class="cert_head_' + selected_text + '">' + selectedValues[i] + '</h6><input type="hidden" name="npnamearr[]" class="np_input_' + selectedValues[i] + '" value="' + selectedValues[i] + '"><div class="license_number_div row license_number_additional"><div class="form-group col-md-12"><label class="form-label" for="input-1">Certification/Licence Number</label><input class="form-control np_license_number np_license_number-' + i + '" type="text" name="np_license_number[]"><span id="reqnplicencevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control npexpiry npexpiry-' + i + '" type="date" name="np_expiry[]"><span id="reqnpexpiryvalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload your certification/Licence</label><input class="form-control degree_transcript np_imgs_' + res_one + ' np_upload_certification np_upload_certification-' + i + '" type="file" name="np_upload_certification[' + i + '][]" onchange="changeImg1(' + user_id + ',' + i + ',\'' + img_text + '\',\'' + res_one + '\')" multiple><div class="np_imgs' + res_one + '"></div><span id="reqnpuploadvalid-' + i + '" class="reqError text-danger valley"></span></div></div></div>');


      }
    }


  });
  $('.js-example-basic-multiple[data-list-id="cn_data"]').on('change', function() {
    let selectedValues = $(this).val();
    var cn_certification_array = [];
    $('.cna_certification_div').removeClass('d-none');
    $(".cna_certification_div h6").each(function() {
      var text = $(this).text();

      if (selectedValues.includes(text) == false) {
        let res = text.split(' ')[0];
        let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
        console.log("res_one", res_one);

        $(".cna_" + res_one).remove();
        var user_id = "{{ $user_id }}";
        deleteDatabaseImgs(user_id, "cn_imgs");
      }

      cn_certification_array.push(text);
    });
    console.log("selectedValues", selectedValues);

    //$(".bls_certification_div").empty();
    for (var i = 0; i < selectedValues.length; i++) {
      var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
      let res = selectedValues[i].split(' ')[0];
      let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
      console.log("res_one", res_one);
      if (cn_certification_array.includes(selectedValues[i]) == false) {
        var user_id = "{{ $user_id }}";
        var img_text = "cn_imgs";

        $(".cna_certification_div").append('<div class="cn_' + res_one + ' cert_div_' + selected_text + '"><h6 class="cert_head_' + selected_text + '">' + selectedValues[i] + '</h6><input type="hidden" name="cnnamearr[]" class="cn_input_' + selectedValues[i] + '" value="' + selectedValues[i] + '"><div class="license_number_div row license_number_additional"><div class="form-group col-md-12"><label class="form-label" for="input-1">Certification/Licence Number</label><input class="form-control cn_license_number cn_license_number-' + i + '" type="text" name="cn_license_number[]"><span id="reqcnlicencevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control cnexpiry cnexpiry-' + i + '" type="date" name="cn_expiry[]"><span id="reqcnexpiryvalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload your certification/Licence</label><input class="form-control degree_transcript cn_imgs_' + res_one + ' cn_upload_certification cn_upload_certification-' + i + '" type="file" name="cn_upload_certification[' + i + '][]" onchange="changeImg1(' + user_id + ',' + i + ',\'' + img_text + '\',\'' + res_one + '\')" multiple><div class="cn_imgs' + res_one + '"></div><span id="reqcnuploadvalid-' + i + '" class="reqError text-danger valley"></span></div></div></div>');


      }
    }


  });
  $('.js-example-basic-multiple[data-list-id="lpn_data"]').on('change', function() {
    let selectedValues = $(this).val();
    var lpn_certification_array = [];
    $('.lpn_certification_div').removeClass('d-none');
    $(".lpn_certification_div h6").each(function() {
      var text = $(this).text();

      if (selectedValues.includes(text) == false) {
        let res = text.split(' ')[0];
        let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
        console.log("res_one", res_one);

        $(".lpn_" + res_one).remove();
        var user_id = "{{ $user_id }}";
        deleteDatabaseImgs(user_id, "lpn_imgs");
      }

      lpn_certification_array.push(text);
    });
    console.log("selectedValues", selectedValues);

    //$(".bls_certification_div").empty();
    for (var i = 0; i < selectedValues.length; i++) {
      var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
      let res = selectedValues[i].split(' ')[0];
      let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
      console.log("res_one", res_one);
      if (lpn_certification_array.includes(selectedValues[i]) == false) {
        var user_id = "{{ $user_id }}";
        var img_text = "lpn_imgs";

        $(".lpn_certification_div").append('<div class="lpn_' + res_one + ' cert_div_' + selected_text + '"><h6 class="cert_head_' + selected_text + '">' + selectedValues[i] + '</h6><input type="hidden" name="lpnnamearr[]" class="lpn_input_' + selectedValues[i] + '" value="' + selectedValues[i] + '"><div class="license_number_div row license_number_additional"><div class="form-group col-md-12"><label class="form-label" for="input-1">Certification/Licence Number</label><input class="form-control lpn_license_number lpn_license_number-' + i + '" type="text" name="lpn_license_number[]"><span id="reqlpnlicencevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control lpnexpiry lpnexpiry-' + i + '" type="date" name="lpn_expiry[]"><span id="reqlpnexpiryvalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload your certification/Licence</label><input class="form-control lpn_upload_certification degree_transcript lpn_imgs_' + res_one + ' lpn_upload_certification-' + i + '" type="file" name="lpn_upload_certification[' + i + '][]" onchange="changeImg1(' + user_id + ',' + i + ',\'' + img_text + '\',\'' + res_one + '\')" multiple><div class="lpn_imgs' + res_one + '"></div><span id="reqlpnuploadvalid-' + i + '" class="reqError text-danger valley"></span></div></div></div>');


      }
    }


  });
  $('.js-example-basic-multiple[data-list-id="crn_data"]').on('change', function() {
    let selectedValues = $(this).val();
    var crna_certification_array = [];
    $('.crna_certification_div').removeClass('d-none');
    $(".crna_certification_div h6").each(function() {
      var text = $(this).text();

      if (selectedValues.includes(text) == false) {
        let res = text.split(' ')[0];
        let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
        console.log("res_one", res_one);

        $(".crna_" + res_one).remove();
        var user_id = "{{ $user_id }}";
        deleteDatabaseImgs(user_id, "crna_imgs");

      }

      crna_certification_array.push(text);
    });
    console.log("selectedValues", selectedValues);

    //$(".bls_certification_div").empty();
    for (var i = 0; i < selectedValues.length; i++) {
      var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
      let res = selectedValues[i].split(' ')[0];
      let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
      console.log("res_one", res_one);
      if (crna_certification_array.includes(selectedValues[i]) == false) {
        var user_id = "{{ $user_id }}";
        var img_text = "crna_imgs";

        $(".crna_certification_div").append('<div class="crna_' + res_one + ' cert_div_' + selected_text + '"><h6 class="cert_head_' + selected_text + '">' + selectedValues[i] + '</h6><input type="hidden" name="crnanamearr[]" class="lpn_input_' + selectedValues[i] + '" value="' + selectedValues[i] + '"><div class="license_number_div row license_number_additional"><div class="form-group col-md-12"><label class="form-label" for="input-1">Certification/Licence Number</label><input class="form-control crna_license_number crna_license_number-' + i + '" type="text" name="crna_license_number[]"><span id="reqcrnalicencevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control crnaexpiry crnaexpiry-' + i + '" type="date" name="crna_expiry[]"><span id="reqcrnaexpiryvalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload your certification/Licence</label><input class="form-control degree_transcript crna_imgs_' + res_one + ' crna_upload_certification crna_upload_certification-' + i + '" type="file" name="crna_upload_certification[' + i + '][]" onchange="changeImg1(' + user_id + ',' + i + ',\'' + img_text + '\',\'' + res_one + '\')" multiple><div class="crna_imgs' + res_one + '"></div><span id="reqcrnauploadvalid-' + i + '" class="reqError text-danger valley"></span></div></div></div>');


      }
    }


  });

  $('.js-example-basic-multiple[data-list-id="cnm_data"]').on('change', function() {
    let selectedValues = $(this).val();
    var cnm_certification_array = [];
    $('.cnm_certification_div').removeClass('d-none');
    $(".cnm_certification_div h6").each(function() {
      var text = $(this).text();

      if (selectedValues.includes(text) == false) {
        let res = text.split(' ')[0];
        let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
        console.log("res_one", res_one);

        $(".cnm_" + res_one).remove();
        var user_id = "{{ $user_id }}";
        deleteDatabaseImgs(user_id, "cnm_imgs");
      }

      cnm_certification_array.push(text);
    });
    console.log("selectedValues", selectedValues);

    //$(".bls_certification_div").empty();
    for (var i = 0; i < selectedValues.length; i++) {
      var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
      let res = selectedValues[i].split(' ')[0];
      let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
      console.log("res_one", res_one);
      if (cnm_certification_array.includes(selectedValues[i]) == false) {
        var user_id = "{{ $user_id }}";
        var img_text = "cnm_imgs";

        $(".cnm_certification_div").append('<div class="cnm_' + res_one + ' cert_div_' + selected_text + '"><h6 class="cert_head_' + selected_text + '">' + selectedValues[i] + '</h6><input type="hidden" name="cnmnamearr[]" class="cnm_input_' + selectedValues[i] + '" value="' + selectedValues[i] + '"><div class="license_number_div row license_number_additional"><div class="form-group col-md-12"><label class="form-label" for="input-1">Certification/Licence Number</label><input class="form-control cnm_license_number cnm_license_number-' + i + '" type="text" name="cnm_license_number[]"><span id="reqcnmlicencevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control cnmexpiry cnmexpiry-' + i + '" type="date" name="cnm_expiry[]"><span id="reqcnmexpiryvalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload your certification/Licence</label><input class="form-control degree_transcript cnm_imgs_' + res_one + '" type="file" name="cnm_upload_certification[' + i + '][]" onchange="changeImg1(' + user_id + ',' + i + ',\'' + img_text + '\',\'' + res_one + '\')" multiple><div class="cnm_imgs' + res_one + '"></div><span id="reqcnmuploadvalid-' + i + '" class="reqError text-danger valley"></span></div></div></div>');


      }
    }


  });

  $('.js-example-basic-multiple[data-list-id="ons_data"]').on('change', function() {
    let selectedValues = $(this).val();
    var ons_certification_array = [];
    $('.ons_certification_div').removeClass('d-none');
    $(".ons_certification_div h6").each(function() {
      var text = $(this).text();

      if (selectedValues.includes(text) == false) {
        let res = text.split(' ')[0];
        let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
        console.log("res_one", res_one);

        $(".ons_" + res_one).remove();
        var user_id = "{{ $user_id }}";
        deleteDatabaseImgs(user_id, "ons_imgs");
      }

      ons_certification_array.push(text);
    });
    console.log("selectedValues", selectedValues);

    //$(".bls_certification_div").empty();
    for (var i = 0; i < selectedValues.length; i++) {
      var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
      let res = selectedValues[i].split(' ')[0];
      let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
      console.log("res_one", res_one);
      if (ons_certification_array.includes(selectedValues[i]) == false) {
        var user_id = "{{ $user_id }}";
        var img_text = "ons_imgs";

        $(".ons_certification_div").append('<div class="ons_' + res_one + ' cert_div_' + selected_text + '"><h6 class="cert_head_' + selected_text + '">' + selectedValues[i] + '</h6><input type="hidden" name="onsnamearr[]" class="ons_input_' + selectedValues[i] + '" value="' + selectedValues[i] + '"><div class="license_number_div row license_number_additional"><div class="form-group col-md-12"><label class="form-label" for="input-1">Certification/Licence Number</label><input class="form-control ons_license_number ons_license_number-' + i + '" type="text" name="ons_license_number[]"><span id="reqonslicencevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control onsexpiry onsexpiry-' + i + '" type="date" name="ons_expiry[]"><span id="reqonsexpiryvalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload your certification/Licence</label><input class="form-control degree_transcript ons_imgs_' + res_one + '" type="file" name="ons_upload_certification[' + i + '][]" onchange="changeImg1(' + user_id + ',' + i + ',\'' + img_text + '\',\'' + res_one + '\')" multiple><div class="ons_imgs' + res_one + '"></div><span id="reqonsuploadvalid-' + i + '" class="reqError text-danger valley"></span></div></div></div>');


      }
    }


  });

  $('.js-example-basic-multiple[data-list-id="msw_data"]').on('change', function() {
    let selectedValues = $(this).val();
    var msw_certification_array = [];
    $('.msw_certification_div').removeClass('d-none');
    $(".msw_certification_div h6").each(function() {
      var text = $(this).text();

      if (selectedValues.includes(text) == false) {
        let res = text.split(' ')[0];
        let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
        console.log("res_one", res_one);

        $(".msw_" + res_one).remove();
        var user_id = "{{ $user_id }}";
        deleteDatabaseImgs(user_id, "msw_imgs");
      }

      msw_certification_array.push(text);
    });
    console.log("selectedValues", selectedValues);

    //$(".bls_certification_div").empty();
    for (var i = 0; i < selectedValues.length; i++) {
      var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
      let res = selectedValues[i].split(' ')[0];
      let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
      console.log("res_one", res_one);

      if (msw_certification_array.includes(selectedValues[i]) == false) {
        var user_id = "{{ $user_id }}";
        var img_text = "msw_imgs";

        $(".msw_certification_div").append('<div class="msw_' + res_one + ' cert_div_' + selected_text + '"><h6 class="cert_head_' + selected_text + '">' + selectedValues[i] + '</h6><input type="hidden" name="mswnamearr[]" class="msw_input_' + selectedValues[i] + '" value="' + selectedValues[i] + '"><div class="license_number_div row license_number_additional"><div class="form-group col-md-12"><label class="form-label" for="input-1">Certification/Licence Number</label><input class="form-control msw_license_number msw_license_number-' + i + '" type="text" name="msw_license_number[]"><span id="reqmswlicencevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control mswexpiry mswexpiry-' + i + '" type="date" name="msw_expiry[]"><span id="reqmswexpiryvalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload your certification/Licence</label><input class="form-control degree_transcript msw_imgs_' + res_one + ' msw_upload_certification msw_upload_certification-' + i + '" type="file" name="msw_upload_certification[' + i + '][]" onchange="changeImg1(' + user_id + ',' + i + ',\'' + img_text + '\',\'' + res_one + '\')" multiple><div class="msw_imgs' + res_one + '"></div><span id="reqmswuploadvalid-' + i + '" class="reqError text-danger valley"></span></div></div></div>');


      }
    }


  });

  $('.js-example-basic-multiple[data-list-id="ain_data"]').on('change', function() {
    let selectedValues = $(this).val();
    var ain_certification_array = [];
    $('.ain_certification_div').removeClass('d-none');
    $(".ain_certification_div h6").each(function() {
      var text = $(this).text();

      if (selectedValues.includes(text) == false) {
        let res = text.split(' ')[0];
        let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
        console.log("res_one", res_one);

        $(".ain_" + res_one).remove();
        var user_id = "{{ $user_id }}";
        deleteDatabaseImgs(user_id, "ain_imgs");
      }

      ain_certification_array.push(text);
    });
    console.log("selectedValues", selectedValues);

    //$(".bls_certification_div").empty();
    for (var i = 0; i < selectedValues.length; i++) {
      var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
      let res = selectedValues[i].split(' ')[0];
      let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
      console.log("res_one", res_one);
      if (ain_certification_array.includes(selectedValues[i]) == false) {
        var user_id = "{{ $user_id }}";
        var img_text = "ain_imgs";

        $(".ain_certification_div").append('<div class="ain_' + res_one + ' cert_div_' + selected_text + '"><h6 class="cert_head_' + selected_text + '">' + selectedValues[i] + '</h6><input type="hidden" name="ainnamearr[]" class="ain_input_' + selectedValues[i] + '" value="' + selectedValues[i] + '"><div class="license_number_div row license_number_additional"><div class="form-group col-md-12"><label class="form-label" for="input-1">Certification/Licence Number</label><input class="form-control ain_license_number ain_license_number-' + i + '" type="text" name="ain_license_number[]"><span id="reqainlicencevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control ainexpiry ainexpiry-' + i + '" type="date" name="ain_expiry[]"><span id="reqainexpiryvalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload your certification/Licence</label><input class="form-control degree_transcript ain_imgs_' + res_one + ' ain_upload_certification ain_upload_certification-' + i + '" type="file" name="ain_upload_certification[' + i + '][]" onchange="changeImg1(' + user_id + ',' + i + ',\'' + img_text + '\',\'' + res_one + '\')" multiple><div class="ain_imgs' + res_one + '"></div><span id="reqainuploadvalid-' + i + '" class="reqError text-danger valley"></span></div></div></div>');


      }
    }


  });

  $('.js-example-basic-multiple[data-list-id="rpn_data"]').on('change', function() {
    let selectedValues = $(this).val();
    var rpn_certification_array = [];
    $('.rpn_certification_div').removeClass('d-none');
    $(".rpn_certification_div h6").each(function() {
      var text = $(this).text();

      if (selectedValues.includes(text) == false) {
        let res = text.split(' ')[0];
        let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
        console.log("res_one", res_one);

        $(".rpn_" + res_one).remove();
        var user_id = "{{ $user_id }}";
        deleteDatabaseImgs(user_id, "rpn_imgs");
      }

      rpn_certification_array.push(text);
    });
    console.log("selectedValues", selectedValues);

    //$(".bls_certification_div").empty();
    for (var i = 0; i < selectedValues.length; i++) {
      var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
      let res = selectedValues[i].split(' ')[0];
      let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
      console.log("res_one", res_one);
      if (rpn_certification_array.includes(selectedValues[i]) == false) {
        var user_id = "{{ $user_id }}";
        var img_text = "rpn_imgs";

        $(".rpn_certification_div").append('<div class="rpn_' + res_one + ' cert_div_' + selected_text + '"><h6 class="cert_head_' + selected_text + '">' + selectedValues[i] + '</h6><input type="hidden" name="rpnnamearr[]" class="rpn_input_' + selectedValues[i] + '" value="' + selectedValues[i] + '"><div class="license_number_div row license_number_additional"><div class="form-group col-md-12"><label class="form-label" for="input-1">Certification/Licence Number</label><input class="form-control rpn_license_number rpn_license_number-' + i + '" type="text" name="rpn_license_number[]"><span id="reqrpnlicencevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control rpnexpiry rpnexpiry-' + i + '" type="date" name="rpn_expiry[]"><span id="reqrpnexpiryvalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload your certification/Licence</label><input class="form-control degree_transcript rpn_imgs_' + res_one + ' rpn_upload_certification rpn_upload_certification-' + i + '" type="file" name="rpn_upload_certification[' + i + '][]" onchange="changeImg1(' + user_id + ',' + i + ',\'' + img_text + '\',\'' + res_one + '\')" multiple><div class="rpn_imgs' + res_one + '"></div><span id="reqrpnuploadvalid-' + i + '" class="reqError text-danger valley"></span></div></div></div>');


      }
    }


  });

  $(".change_password_link").click(function() {

    window.history.replaceState(null, null, "?page=change_password");

    var url_string = window.location.href;
    var url = new URL(url_string);
    var c = url.searchParams.get("page");
    console.log(c);

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
  console.log(c);

  if (c == "change_password") {
    $(".upload_image").addClass("hide_profile_image");
    $(".profile_update_heading").hide();
    $(".update_profile").hide();
    $(".change_password_div").show();
  }

  $("#my_profession").click(function(e) {
    //alert("hello");
    e.stopPropagation();
    // $(".prof-profile .dropdown").addClass("show");
    //   $(".prof-profile .dropdown-menu").addClass("show");
    window.history.replaceState(null, null, "?page=profession");

    var url_string = window.location.href;
    var url = new URL(url_string);
    var c = url.searchParams.get("page");
    console.log(c);

    if (c == "profession") {
      $(".tab-pane").hide();
      $("#tab-my-jobs").css("opacity", "1");
      $("#tab-my-jobs").show();

    }

  });

  $("#my_profile").click(function(e) {
    e.stopPropagation();
    window.history.replaceState(null, null, "?page=my_profile");

    var url_string = window.location.href;
    var url = new URL(url_string);
    var c = url.searchParams.get("page");
    console.log(c);

    if (c == "my_profile") {
      $(".tab-pane").hide();

      $("#tab-my-profile").show();
    }

  });

  $("#settings").click(function(e) {
    e.stopPropagation();
    window.history.replaceState(null, null, "?page=settings");

    var url_string = window.location.href;
    var url = new URL(url_string);
    var c = url.searchParams.get("page");
    console.log(c);

    if (c == "settings") {
      $(".tab-pane").hide();
      $("#tab-my-profile-setting").css("opacity", "1");
      $("#tab-my-profile-setting").show();
    }

  });
  $("#experience_info").click(function(e) {
    e.stopPropagation();
    window.history.replaceState(null, null, "?page=experience_info");

    var url_string = window.location.href;
    var url = new URL(url_string);
    var c = url.searchParams.get("page");
    console.log(c);

    if (c == "experience_info") {
      $(".tab-pane").hide();
      $("#tab-experience").css("opacity", "1");
      $("#tab-experience").show();
    }

  });
  $("#additional_info").click(function(e) {
    e.stopPropagation();
    window.history.replaceState(null, null, "?page=additional_info");

    var url_string = window.location.href;
    var url = new URL(url_string);
    var c = url.searchParams.get("page");
    console.log(c);

    if (c == "additional_info") {
      $(".tab-pane").hide();
      $("#tab-addition-information").css("opacity", "1");
      $("#tab-addition-information").show();
    }

  });
  $("#educert").click(function(e) {
    e.stopPropagation();
    window.history.replaceState(null, null, "?page=educert");

    var url_string = window.location.href;
    var url = new URL(url_string);
    var c = url.searchParams.get("page");
    console.log(c);

    if (c == "educert") {
      $(".tab-pane").hide();
      $("#tab-educert").css("opacity", "1");
      $("#tab-educert").show();
    }

  });

  $("#mand_training").click(function(e) {
    e.stopPropagation();
    window.history.replaceState(null, null, "?page=mandatory_training");

    var url_string = window.location.href;
    var url = new URL(url_string);
    var c = url.searchParams.get("page");
    console.log(c);

    if (c == "mandatory_training") {
      $(".tab-pane").hide();
      $("#tab-mandtraining").css("opacity", "1");
      $("#tab-mandtraining").show();
    }

  });

  $("#reference_info").click(function(e) {
    e.stopPropagation();
    window.history.replaceState(null, null, "?page=reference_info");

    var url_string = window.location.href;
    var url = new URL(url_string);
    var c = url.searchParams.get("page");
    console.log(c);

    if (c == "reference_info") {
      $(".tab-pane").hide();
      $("#tab-references").css("opacity", "1");
      $("#tab-references").show();
    }

  });

  $("#work_clearances").click(function(e) {
    e.stopPropagation();
    window.history.replaceState(null, null, "?page=work_clearances");

    var url_string = window.location.href;
    var url = new URL(url_string);
    var c = url.searchParams.get("page");
    console.log(c);

    if (c == "work_clearances") {
      $(".tab-pane").hide();
      $("#tab-myclearance-jobs").css("opacity", "1");
      $("#tab-myclearance-jobs").show();
    }

  });
  $("#interview_references").click(function(e) {
    e.stopPropagation();
    window.history.replaceState(null, null, "?page=interview_references");

    var url_string = window.location.href;
    var url = new URL(url_string);
    var c = url.searchParams.get("page");
    console.log(c);

    if (c == "interview_references") {

      $(".tab-pane").hide();
      $("#tab-interview-references").css("opacity", "1");
      $("#tab-interview-references").show();
    }

  });




 



  var url_string = window.location.href;
  var url = new URL(url_string);
  var c = url.searchParams.get("page");
  console.log(c);

  

  if (c == "vaccinations") {

    $(".tab-pane").hide();
    $("#tab-vaccination").css("opacity", "1");
    $("#tab-vaccination").show();
    $(".profile_tabs").removeClass("active");
    $("#vaccinations").addClass("active");
    $(".prof-profile .dropdown").addClass("show");
    $(".prof-profile .dropdown-menu").addClass("show");
  }

 

  

  


  // When the plugin loads for the first time, we have to trigger the "countrychange" event manually, 
  // but after making sure that the plugin is fully loaded by associating handler to the promise of the 
  // plugin instance.

 















  

</script>
<script>
  function do_police_check() {

    event.preventDefault();

    $(".valley").html("");

    $('.submit-btn-120').prop('disabled', true);

    $('.submit-btn-1').show();

    $('.resetpassword').hide();

    var returnValue;

    var date_acquiredI = document.getElementById("date_acquiredI").value;
    var image_support_document_policeI = document.getElementById("image_support_document_policeI").value;

    var checkbox = document.getElementById('confirmationCheckboxPoliceCheck');


    returnValue = true;

    if (date_acquiredI.trim() == "") {

      document.getElementById("reqTxtdate_acquiredI").innerHTML = "* Please Select  the date of  Acquired.";

      returnValue = false;

    }

    if (image_support_document_policeI.trim() == "") {

      document.getElementById("reqTxtimage_support_documentI").innerHTML = "* Please Upload the Police Check File.";

      returnValue = false;

    }

    if (!checkbox.checked) {
      alert('Please confirm your action.');
      document.getElementById("reqTxtconfirmationCheckboxPoliceCheckI").innerHTML = "Required field: Confirmation required.";

      returnValue = false;
    }

    if (returnValue == false) {

      $('.submit-btn-120').prop('disabled', false);

      $('.submit-btn-1').hide();

      $('.resetpassword').show();

    }



    if (returnValue == true) {

      let formData = new FormData($('#multi-step-form-police-check')[0]);



      $.ajax({

        type: 'POST',

        url: "{{route('nurse.update-profession-user-police-check')}}",

        data: formData,

        dataType: 'JSON',

        processData: false,

        contentType: false,

        cache: false,

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        },

        beforeSend: function() {

          $('.submit-btn-120').prop('disabled', true);

          $('.submit-btn-1').show();

          $('.resetpassword').hide();



        },

        success: function(resp) {



          if (resp.status == 1) {

            $('.submit-btn-120').prop('disabled', false);

            $('.submit-btn-1').hide();

            $('.resetpassword').show();

            // $('#multi-step-form-police-check')[0].reset();



            Swal.fire({

              icon: 'success',

              title: 'Successfully!',

              text: resp.message,

            }).then(function() {

              window.location = resp.url;

            });



          } else {

            $('.submit-btn-120').prop('disabled', false);

            $('.submit-btn-1').hide();

            $('.resetpassword').show();

            Swal.fire({

              'icon': 'error',

              'title': 'Error',

              'text': resp.message

            });

            printErrorMsg(resp.validation);

          }

        }

      });

      return false;

    }



  }

  function do_children_check() {

    event.preventDefault();

    $(".valley").html("");

    $('.submit-btn-120').prop('disabled', true);

    $('.submit-btn-1').show();

    $('.resetpassword').hide();

    var returnValue;

    var clearance_numberI = document.getElementById("clearance_numberI").value;
    var clearancestateI = document.getElementById("clearancestateI").value;
    var clearance_expiry_dataI = document.getElementById("clearance_expiry_dataI").value;

    returnValue = true;

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


    if (returnValue == false) {

      $('.submit-btn-120').prop('disabled', false);

      $('.submit-btn-1').hide();

      $('.resetpassword').show();

    }



    if (returnValue == true) {

      let formData = new FormData($('#multi-step-form-children')[0]);



      $.ajax({

        type: 'POST',

        url: "{{route('nurse.update-profession-user-children')}}",

        data: formData,

        dataType: 'JSON',

        processData: false,

        contentType: false,

        cache: false,

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        },

        beforeSend: function() {

          $('.submit-btn-120').prop('disabled', true);

          $('.submit-btn-1').show();

          $('.resetpassword').hide();



        },

        success: function(resp) {



          if (resp.status == 1) {

            $('.submit-btn-120').prop('disabled', false);

            $('.submit-btn-1').hide();

            $('.resetpassword').show();

            // $('#multi-step-form-children')[0].reset();



            Swal.fire({

              icon: 'success',

              title: 'Successfully!',

              text: resp.message,

            }).then(function() {

              // window.location = resp.url;

            });



          } else {

            $('.submit-btn-120').prop('disabled', false);

            $('.submit-btn-1').hide();

            $('.resetpassword').show();

            Swal.fire({

              'icon': 'error',

              'title': 'Error',

              'text': resp.message

            });

            printErrorMsg(resp.validation);

          }

        }

      });

      return false;

    }



  }

  function doeligibility_to_work() {
    event.preventDefault();

    $(".valley").html("");

    $('.submit-btn-120').prop('disabled', true);

    $('.submit-btn-1').show();

    $('.resetpassword').hide();

    var returnValue;

    var residencyId = document.getElementById("residencyId").value;
    var image_support_documentI = document.getElementById("image_support_documentI").value;

    var visa_subclass_numberI = document.getElementById("visa_subclass_numberI").value;
    var passport_numberI = document.getElementById("passport_numberI").value;
    var passportcountryI = document.getElementById("passportcountryI").value;
    var visa_grant_numberI = document.getElementById("visa_grant_numberI").value;

    var expiry_dataI = document.getElementById("expiry_dataI").value;

    returnValue = true;

    if (residencyId.trim() == "") {

      document.getElementById("reqTxtresidencyId").innerHTML = "* Please Select the Residency.";

      returnValue = false;

    }
    if (residencyId.trim() != 'Citizen') {
      if (visa_subclass_numberI.trim() == "") {

        document.getElementById("reqTxtvisa_subclass_numberId").innerHTML = "* Please Enter  the Subclass Number.";

        returnValue = false;

      }
      if (passport_numberI.trim() == "") {

        document.getElementById("reqTxtpassport_numberI").innerHTML = "* Please Enter  the Passport Number .";

        returnValue = false;

      }
      if (passportcountryI.trim() == "") {

        document.getElementById("reqTxtpassportcountryI").innerHTML = "* Please Select the Passport Country .";

        returnValue = false;

      }
      if (visa_grant_numberI.trim() == "") {

        document.getElementById("reqTxtvisa_grant_number").innerHTML = "* Please Enter  the Passport Number .";

        returnValue = false;

      }
      if (residencyId.trim() == 'Visa Holder') {

        if (expiry_dataI.trim() == "") {

          document.getElementById("reqTxtexpiry_dataI").innerHTML = "* Please Select the Expiry Date.";

          returnValue = false;

        }
      }

    }



    if (image_support_documentI.trim() == "") {
      document.getElementById("reqasupport_document").innerHTML = "* Please Upload the Support Document.";
      returnValue = false;
    }

    if (returnValue == false) {
      $('.submit-btn-120').prop('disabled', false);
      $('.submit-btn-1').hide();
      $('.resetpassword').show();
    }



    if (returnValue == true) {
      let formData = new FormData($('#multi-step-form-eligibility')[0]);

      $.ajax({

        type: 'POST',

        url: "{{route('nurse.update-profession-user-eligibility')}}",

        data: formData,

        dataType: 'JSON',

        processData: false,

        contentType: false,

        cache: false,

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        },

        beforeSend: function() {

          $('.submit-btn-120').prop('disabled', true);

          $('.submit-btn-1').show();

          $('.resetpassword').hide();

        },

        success: function(resp) {

          if (resp.status == 1) {

            $('.submit-btn-120').prop('disabled', false);

            $('.submit-btn-1').hide();

            $('.resetpassword').show();

            $('#multi-step-form-eligibility')[0].reset();

            Swal.fire({

              icon: 'success',

              title: 'Successfully!',

              text: resp.message,

            }).then(function() {

              window.location = resp.url;

            });

          } else {

            $('.submit-btn-120').prop('disabled', false);

            $('.submit-btn-1').hide();

            $('.resetpassword').show();

            Swal.fire({

              'icon': 'error',

              'title': 'Error',

              'text': resp.message

            });

            printErrorMsg(resp.validation);

          }

        }

      });

      return false;

    }



  }

  

  

  

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