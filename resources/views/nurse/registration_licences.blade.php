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

  form#register_licenses_form ul.select2-selection__rendered {
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

 .switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide the default checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* Style for the slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  transition: 0.4s;
  border-radius: 34px;
}

/* The circle inside the slider */
.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  border-radius: 50%;
  left: 4px;
  bottom: 4px;
  background-color: white;
  transition: 0.4s;
}

/* When the checkbox is checked, move the slider */
input:checked + .slider {
  background-color: black; /* Green */
}

/* When the checkbox is checked, move the circle */
input:checked + .slider:before {
  transform: translateX(26px);
}

.alert-info {
  background-color: #e7f3fe;
  border-left: 6px solid #2196F3;
  padding: 12px;
  margin-top: 10px;
  margin-bottom: 10px;
}

.alert-helper {
  background-color: #f9fbe7;
  border-left: 6px solid #cddc39;
  padding: 12px;
  margin-top: 10px;
  margin-bottom: 10px;
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

    
                      <form id="register_licenses_form" method="POST" onsubmit="return update_register_licenses()">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::guard('nurse_middle')->user()->id }}">
                        <div class="form-group level-drp">
                          <label class="form-label" for="input-1">What is your current AHPRA registration status?</label>
                          <select id="registration-status" name="ahpra_registration_status" class="form-control">
                            <option value="">-- Select Registration Status --</option>
                            <option value="RN" @if(!empty($licenses_data) && $licenses_data->ahpra_registration_status == "RN") selected @endif>Registered Nurse (RN)</option>
                            <option value="RM" @if(!empty($licenses_data) && $licenses_data->ahpra_registration_status == "RM") selected @endif>Registered Midwife (RM)</option>
                            <option value="RN_RM" @if(!empty($licenses_data) && $licenses_data->ahpra_registration_status == "RN_RM") selected @endif>Registered Nurse and Midwife (RN/RM)</option>
                            <option value="NP" @if(!empty($licenses_data) && $licenses_data->ahpra_registration_status == "NP") selected @endif>Nurse Practitioner (NP) (as endorsed under RN)</option>
                            <option value="Graduate_RN" @if(!empty($licenses_data) && $licenses_data->ahpra_registration_status == "Graduate_RN") selected @endif>Graduate Nurse – Transitional Authorisation</option>
                            <option value="Graduate_RM" @if(!empty($licenses_data) && $licenses_data->ahpra_registration_status == "Graduate_RM") selected @endif>Graduate Midwife – Transitional Authorisation</option>
                            <option value="Student_Nurse" @if(!empty($licenses_data) && $licenses_data->ahpra_registration_status == "Student_Nurse") selected @endif>Student Nurse – AHPRA-registered (NMBA-approved course)</option>
                            <option value="Student_Midwife" @if(!empty($licenses_data) && $licenses_data->ahpra_registration_status == "Student_Midwife") selected @endif>Student Midwife – AHPRA-registered (NMBA-approved course)</option>
                            <option value="Overseas" @if(!empty($licenses_data) && $licenses_data->ahpra_registration_status == "Overseas") selected @endif>Overseas-Qualified Nurses and Midwives not currently registered with AHPRA</option>
                            <option value="Not_Registered" @if(!empty($licenses_data) && $licenses_data->ahpra_registration_status == "Not_Registered") selected @endif>Not currently registered with AHPRA</option>
                          </select>
                        </div>
                        <!-- Conditional AHPRA Input Group -->
                        
                        <div id="ahpra-details-group" style="display: none;">
                          <div class="form-group level-drp" id="ahpra-number">
                            <!-- AHPRA Number -->
                            <label for="ahpra-number"><strong>Please Enter your AHPRA Registration Number:</strong></label>
                            <input class="form-control ahpra_number" type="text" name="ahpra_number" pattern="^NMW\d{10}$"
                                  placeholder="e.g. NMW0001234567" value="@if(!empty($licenses_data)){{ $licenses_data->aphra_registration_no }}@endif"/>
                            <small style="color: gray;">Format: NMW followed by 10 digits (e.g., NMW0001234567)</small>
                          </div>  
                          <!-- Consent Checkbox -->
                          <div class="declaration_box">
                            <label>
                              <input type="checkbox" name="ahpra_consent" id="ahpra-consent" @if(!empty($licenses_data) && $licenses_data->aphra_verifying_checkbox == "1") checked @endif/>
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
                            <div class="form-group level-drp" id="ahpra-number">
                            <!-- AHPRA Number -->
                            <label for="ahpra-number">Division:</label>
                            <select class="form-control" id="division" name="division">
                              <option value="">Select Division</option>
                              <option value="RN" @if(!empty($licenses_data) && $licenses_data->register_division == "RN") selected @endif>Registered Nurse (RN)</option>
                              <option value="EN" @if(!empty($licenses_data) && $licenses_data->register_division == "EN") selected @endif>Enrolled Nurse (EN)</option>
                              <option value="RM" @if(!empty($licenses_data) && $licenses_data->register_division == "RM") selected @endif>Registered Midwife (RM)</option>
                              <option value="RN+RM" @if(!empty($licenses_data) && $licenses_data->register_division == "RN+RM") selected @endif>Registered Nurse and Midwife (RN+RM)</option>
                            </select>
                          </div>  
                          <div class="form-group level-drp" id="ahpra-number">
                            <!-- AHPRA Number -->
                            <label for="endorsements" class="form-label">Endorsements:</label>
                            <select class="form-control" id="endorsements" name="endorsements">
                              <option value="">Select Endorsement</option>
                              <option value="NP" @if(!empty($licenses_data) && $licenses_data->register_endorsements == "NP") selected @endif>Nurse Practitioner (NP)</option>
                              <option value="MidwifeMeds" @if(!empty($licenses_data) && $licenses_data->register_endorsements == "MidwifeMeds") selected @endif>Scheduled Medicines – Midwife</option>
                              <option value="RIPRN" @if(!empty($licenses_data) && $licenses_data->register_endorsements == "RIPRN") selected @endif>Scheduled Medicines – RN (Rural and Isolated Practice)</option>
                              <option value="NP+Midwife" @if(!empty($licenses_data) && $licenses_data->register_endorsements == "NP+Midwife") selected @endif>Both NP and Endorsed Midwife</option>
                              <option value="IVs" @if(!empty($licenses_data) && $licenses_data->register_endorsements == "IVs") selected @endif>IV Endorsed - Enrolled Nurse (IVs)</option>
                              <option value="meds" @if(!empty($licenses_data) && $licenses_data->register_endorsements == "meds") selected @endif>Medication Endorsed - Enrolled Nurse (meds)</option>
                              <option value="none" @if(!empty($licenses_data) && $licenses_data->register_endorsements == "none") selected @endif>No endorsed status</option>
                            </select>
                          </div>  
                          <div class="form-group level-drp" id="ahpra-number">
                            <!-- AHPRA Number -->
                            <label for="regType" class="form-label">Registration Type:</label>
                            <select class="form-control" id="regType" name="reg_registration_type">
                              <option value="">Select Registration Type</option>
                              <option value="General" @if(!empty($licenses_data) && $licenses_data->register_reg_type == "General") selected @endif>General</option>
                              <option value="Limited" @if(!empty($licenses_data) && $licenses_data->register_reg_type == "Limited") selected @endif>Limited</option>
                              <option value="Provisional" @if(!empty($licenses_data) && $licenses_data->register_reg_type == "Provisional") selected @endif>Provisional</option>
                              <option value="Student Nurse" @if(!empty($licenses_data) && $licenses_data->register_reg_type == "Student Nurse") selected @endif>Student Nurse</option>
                              <option value="Student Midwife" @if(!empty($licenses_data) && $licenses_data->register_reg_type == "Student Midwife") selected @endif>Student Midwife</option>
                              <option value="Non-practising" @if(!empty($licenses_data) && $licenses_data->register_reg_type == "Non-practising") selected @endif>Non-practising</option>
                            </select>
                          </div>  
                          <div class="form-group level-drp" id="ahpra-number">
                            <!-- AHPRA Number -->
                            <label for="regStatus" class="form-label">Registration Status:</label>
                            <select class="form-control" id="regStatus" name="reg_registration_status">
                              <option value="">Select Registration Status</option>
                              <option value="Current" @if(!empty($licenses_data) && $licenses_data->register_reg_status == "Current") selected @endif>Current</option>
                              <option value="Suspended" @if(!empty($licenses_data) && $licenses_data->register_reg_status == "Suspended") selected @endif>Suspended</option>
                              <option value="Cancelled" @if(!empty($licenses_data) && $licenses_data->register_reg_status == "Cancelled") selected @endif>Cancelled</option>
                              <option value="Inactive" @if(!empty($licenses_data) && $licenses_data->register_reg_status == "Inactive") selected @endif>Inactive</option>
                              <option value="Ineligible" @if(!empty($licenses_data) && $licenses_data->register_reg_status == "Ineligible") selected @endif>Ineligible</option>
                              <option value="Lapsed" @if(!empty($licenses_data) && $licenses_data->register_reg_status == "Lapsed") selected @endif>Lapsed</option>
                              <option value="Expired" @if(!empty($licenses_data) && $licenses_data->register_reg_status == "Expired") selected @endif>Expired</option>
                              <option value="Not registered" @if(!empty($licenses_data) && $licenses_data->register_reg_status == "Not registered") selected @endif>Not currently registered</option>
                            </select>
                          </div>  
                          <div class="form-group level-drp">
                            <label class="form-label" for="negotiable">Do you have any notations on your AHPRA registration? </label><br>
                            <label class="switch">
                              <input type="checkbox" id="toggleCheckbox" name="negotiable_salary" @if(!empty($licenses_data) && $licenses_data->register_notations != NULL) checked @endif>
                              <span class="slider"></span>
                              
                            </label>
                          </div>
                          <?php
                            if(!empty($licenses_data) && $licenses_data->register_notations != NULL){
                              $register_notations = json_decode($licenses_data->register_notations);
                            }else{
                              $register_notations = [];
                            }
                          ?>
                            <!-- Conditional Notations Field (Hidden by Default) -->
                          <div id="notationsSection" style="display: none;">
                            <div class="mb-3">
                              <label class="form-label">Notations:</label>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="notations[]" value="Must practise under supervision" @if(in_array("Must practise under supervision", $register_notations) == true) checked @endif id="notation1">
                                <label class="form-check-label" for="notation1">Must practise under supervision</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="notations[]" value="May not administer medications" @if(in_array("May not administer medications", $register_notations) == true) checked @endif id="notation2">
                                <label class="form-check-label" for="notation2">May not administer medications</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="notations[]" value="Authorised as a student" @if(in_array("Authorised as a student", $register_notations) == true) checked @endif id="notation3">
                                <label class="form-check-label" for="notation3">Authorised as a student</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="notations[]" value="Endorsed as a midwife — may prescribe under certain conditions" @if(in_array("Endorsed as a midwife — may prescribe under certain conditions", $register_notations) == true) checked @endif id="notation4">
                                <label class="form-check-label" for="notation4">Endorsed as a midwife — may prescribe under certain conditions</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="notations[]" value="May only practise in area of approved qualification" @if(in_array("May only practise in area of approved qualification", $register_notations) == true) checked @endif id="notation5">
                                <label class="form-check-label" for="notation5">May only practise in area of approved qualification</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="notations[]" value="May not work in high-risk settings" @if(in_array("May not work in high-risk settings", $register_notations) == true) checked @endif id="notation6">
                                <label class="form-check-label" for="notation6">May not work in high-risk settings</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="notations[]" value="Other" @if(in_array("Other", $register_notations) == true) checked @endif id="notationOther">
                                <label class="form-check-label" for="notationOther">Other</label>
                              </div>
                            </div>
                            <!-- Conditional Other Notation Text Input -->
                            <div class="mb-3" id="otherNotationText" style="display: none;">
                              <label for="otherNotation" class="form-label">Please specify:</label>
                              <input type="text" class="form-control" id="otherNotation" name="other_notation" placeholder="Enter your other notation" value="@if(!empty($licenses_data)){{ $licenses_data->register_other_notation_reason }}@endif">
                            </div>
                          </div>
                        
                          <div class="form-group level-drp">
                            <label class="form-label" for="negotiable">Do you have any AHPRA-imposed conditions on your registration? </label><br>
                            <label class="switch">
                              <input type="checkbox" id="toggleCheckbox_conditions"  name="negotiable_salary" @if(!empty($licenses_data) && $licenses_data->register_conditions != NULL) checked @endif>
                              <span class="slider"></span>
                              
                            </label>
                          </div>
                          <?php
                            if(!empty($licenses_data) && $licenses_data->register_conditions != NULL){
                              $register_conditions = json_decode($licenses_data->register_conditions);
                            }else{
                              $register_conditions = [];
                            }
                          ?>
                          <!-- Conditional Conditions List -->
                          <div id="conditionsSection" style="display: none;">
                            <div class="mb-3">
                              <label class="form-label">Conditions:</label>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="conditions[]" value="Must practise under supervision" id="condition1" @if(in_array("Must practise under supervision", $register_conditions) == true) checked @endif>
                                <label class="form-check-label" for="condition1">Must practise under supervision</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="conditions[]" value="Restricted to specific clinical area" id="condition2" @if(in_array("Restricted to specific clinical area", $register_conditions) == true) checked @endif>
                                <label class="form-check-label" for="condition2">Restricted to specific clinical area</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="conditions[]" value="Must not administer medications" id="condition3" @if(in_array("Must not administer medications", $register_conditions) == true) checked @endif>
                                <label class="form-check-label" for="condition3">Must not administer medications</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="conditions[]" value="Must complete a supervised practice program" id="condition4" @if(in_array("Must complete a supervised practice program", $register_conditions) == true) checked @endif>
                                <label class="form-check-label" for="condition4">Must complete a supervised practice program</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="conditions[]" value="Must complete education or training" id="condition5" @if(in_array("Must complete education or training", $register_conditions) == true) checked @endif>
                                <label class="form-check-label" for="condition5">Must complete education or training</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="conditions[]" value="Must not work as a sole practitioner" id="condition6" @if(in_array("Must not work as a sole practitioner", $register_conditions) == true) checked @endif>
                                <label class="form-check-label" for="condition6">Must not work as a sole practitioner</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="conditions[]" value="Must not practise in a high-risk setting" id="condition7" @if(in_array("Must not practise in a high-risk setting", $register_conditions) == true) checked @endif>
                                <label class="form-check-label" for="condition7">Must not practise in a high-risk setting</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="conditions[]" value="Must attend health/therapy or monitoring program" id="condition8" @if(in_array("Must attend health/therapy or monitoring program", $register_conditions) == true) checked @endif>
                                <label class="form-check-label" for="condition8">Must attend health/therapy or monitoring program</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="conditions[]" value="May only practise with employer notification to AHPRA" id="condition9" @if(in_array("May only practise with employer notification to AHPRA", $register_conditions) == true) checked @endif>
                                <label class="form-check-label" for="condition9">May only practise with employer notification to AHPRA</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="conditions[]" value="Cannot supervise students or junior staff" id="condition10" @if(in_array("Cannot supervise students or junior staff", $register_conditions) == true) checked @endif>
                                <label class="form-check-label" for="condition10">Cannot supervise students or junior staff</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="conditions[]" value="Must undergo regular performance review" id="condition11" @if(in_array("Must undergo regular performance review", $register_conditions) == true) checked @endif>
                                <label class="form-check-label" for="condition11">Must undergo regular performance review</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="conditions[]" value="Must not prescribe medications" id="condition12" @if(in_array("Must not prescribe medications", $register_conditions) == true) checked @endif>
                                <label class="form-check-label" for="condition12">Must not prescribe medications</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="conditions[]" value="Practice hours must be logged and submitted" id="condition13" @if(in_array("Practice hours must be logged and submitted", $register_conditions) == true) checked @endif>
                                <label class="form-check-label" for="condition13">Practice hours must be logged and submitted</label>
                              </div>
                            </div>
                            <div class="form-group level-drp" id="ahpra-number">
                              <label for="expiryDate" class="form-label">Expiry:</label>
                              <input type="date" class="form-control" id="expiryDate" name="expiry_date" value="@if(!empty($licenses_data)){{ $licenses_data->register_expiry }}@endif">
                              </div>  
                              
                            </div>
                            <div class="form-group level-drp" id="ahpra-number">
                                <label for="principalPractice" class="form-label">Principal Place of Practice:</label>
                                <select class="form-control" id="principalPractice" name="principal_place">
                                  <option value="">-- Select a State --</option>
                                  <option value="NSW" @if(!empty($licenses_data) && $licenses_data->register_principal_place =="NSW") selected @endif>New South Wales (NSW)</option>
                                  <option value="VIC" @if(!empty($licenses_data) && $licenses_data->register_principal_place =="VIC") selected @endif>Victoria (VIC)</option>
                                  <option value="QLD" @if(!empty($licenses_data) && $licenses_data->register_principal_place =="QLD") selected @endif>Queensland (QLD)</option>
                                  <option value="WA" @if(!empty($licenses_data) && $licenses_data->register_principal_place =="WA") selected @endif>Western Australia (WA)</option>
                                  <option value="SA" @if(!empty($licenses_data) && $licenses_data->register_principal_place =="SA") selected @endif>South Australia (SA)</option>
                                  <option value="TAS" @if(!empty($licenses_data) && $licenses_data->register_principal_place =="TAS") selected @endif>Tasmania (TAS)</option>
                                  <option value="ACT" @if(!empty($licenses_data) && $licenses_data->register_principal_place =="ACT") selected @endif>Australian Capital Territory (ACT)</option>
                                  <option value="NT" @if(!empty($licenses_data) && $licenses_data->register_principal_place =="NT") selected @endif>Northern Territory (NT)</option>
                                </select>
                            </div>  
                            <div class="form-group drp--clr">
                                <label class="form-label" for="input-1">Other Places of Practice:</label>
                                
                                <input type="hidden" name="register_other_place" class="register_other_place" value="@if(!empty($licenses_data)) {{ $licenses_data->register_other_place }} @endif">
                                <ul id="other_places" style="display:none;">
                                  <li data-value="">select</li>
                                  <li data-value="NSW">New South Wales (NSW)</li>
                                  <li data-value="VIC">Victoria (VIC)</li>
                                  <li data-value="QLD">Queensland (QLD)</li>
                                  <li data-value="WA">Western Australia (WA)</li>
                                  <li data-value="SA">South Australia (SA)</li>
                                  <li data-value="TAS">Tasmania (TAS)</li>
                                  <li data-value="ACT">Australian Capital Territory (ACT)</li>
                                  <li data-value="NT">Northern Territory (NT)</li>
                                </ul>
                                <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="other_places" name="other_places[]" multiple="multiple"></select>
                                {{-- <span id="any_help" class="reqError text-danger valley"></span> --}}
                            </div>
                            <div class="form-group level-drp">
                              <label class="form-label" for="input-1">Upload Evidence</label>
                              <input type="hidden" name="specialized_lang_skills[evidence_imgs]" class="specialized_lang_skills">
                              <?php
                                $user_id = Auth::guard('nurse_middle')->user()->id;
                              ?>
                              <input class="form-control upload_evidence" type="file" name="" onchange="changeEvidenceImg({{ $user_id }},'group1')" multiple="">
                              <div class="evidence-reg">
                                <?php
                                  if(!empty($licenses_data) && $licenses_data->register_upload_evidence != NULL){
                                    $evidence_imgs = (array)json_decode($licenses_data->register_upload_evidence);
                                    $i = 0;
                                  ?>
                                    @if (!empty($evidence_imgs))
                                      @foreach ($evidence_imgs as $ev_img)
                                      <div class="trans_img trans_img-{{ $i+1 }}">
                                        <a href="{{ url("/public") }}/uploads/education_degree/{{ $ev_img }}" target="_blank"><i class="fa fa-file" aria-hidden="true"></i>{{ $ev_img }}</a>
                                        <div class="close_btn close_btn-' + i + '" onclick="deleteEvidenceImg({{ $i+1 }},{{ $user_id }},'{{ $ev_img }}','group1')" style="cursor: pointer;"><i class="fa fa-close" aria-hidden="true"></i></div>
                                      </div>    
                                      <?php
                                        $i++;
                                      ?>                                    
                                      @endforeach
                                    @endif
                                  <?php  

                                  }  
                                ?>
                              </div>
                            </div>
                            <div class="alert alert-info d-flex justify-content-between align-items-center" role="alert" style="background-color: #e6f2ff; border-left: 5px solid #3399ff;">
                              <div>
                                <strong>Please stay actively compliant.</strong><br>
                                To ensure your profile remains up to date and match-ready, re-verify your professional registration regularly, especially during key events like job applications or expiring certifications.
                                <br><br>
                                <strong>Last verified:</strong> <span id="lastVerified">13-05-2025 – 12:34</span>
                              </div>
                              <div>
                                <button id="reverifyBtn" class="btn btn-primary">Re-verify now</button>
                              </div>
                            </div>      
                            <!-- Manual Entry Section -->
                            <div id="manualAHPRAFields" style="display: none;">

                              <div class="mb-3">
                                <label for="ahpraNumber" class="form-label">Please Enter your AHPRA Registration Number:</label>
                                <input type="text" class="form-control" id="ahpraNumber" name="graduate_ahpra_number" placeholder="e.g. NMW0001234567" pattern="^NMW\d{10}$">
                                <div class="form-text">Your AHPRA number was issued when you enrolled in your approved program.</div>
                              </div>

                              <!-- Division -->
                              <div class="mb-3">
                                <label class="form-label">Division:</label>
                                <select class="form-select" name="division">
                                  <option value="RN">Registered Nurse (RN)</option>
                                  <option value="EN">Enrolled Nurse (EN)</option>
                                  <option value="RM">Registered Midwife (RM)</option>
                                  <option value="RN+RM">Registered Nurse and Midwife (RN+RM)</option>
                                </select>
                              </div>

                              <!-- Registration Type -->
                              <div class="mb-3">
                                <label class="form-label">Registration Type:</label>
                                <select class="form-select" name="registration_type">
                                  <option value="general">General</option>
                                  <option value="limited">Limited</option>
                                  <option value="provisional">Provisional</option>
                                  <option value="student_nurse">Student Nurse</option>
                                  <option value="student_midwife">Student Midwife</option>
                                  <option value="non_practising">Non-practising</option>
                                </select>
                              </div>

                              <!-- Registration Status -->
                              <div class="mb-3">
                                <label class="form-label">Registration Status:</label>
                                <select class="form-select" name="registration_status">
                                  <option value="current">Current</option>
                                  <option value="suspended">Suspended</option>
                                  <option value="cancelled">Cancelled</option>
                                  <option value="inactive">Inactive</option>
                                  <option value="ineligible">Ineligible</option>
                                  <option value="lapsed">Lapsed</option>
                                  <option value="expired">Expired</option>
                                  <option value="not_registered">Not currently registered</option>
                                </select>
                              </div>

                              

                            </div>
                          </div>
                        </div>

                        
                        <!-- Expected Graduation Date -->
                        <div class="mb-3" id="graduationDateGroup" style="display: none;">
                          <label class="form-label">What is your expected graduation date?</label>
                          <input type="date" class="form-control" name="graduation_date">
                        </div>

                        <!-- Upload Evidence -->
                        <div class="mb-3" id="uploadEvidenceGroup" style="display: none;">
                          <label class="form-label">Upload evidence</label>
                          <input type="file" class="form-control" name="grad_evidence" accept=".pdf,.jpg,.jpeg,.png">
                        </div>

                        <!-- Overseas Qualified Section -->
                        <div id="overseasQualifiedSection" style="display: none;">
                          <div class="overseas_block">
                            <label class="form-label">Please specify:</label>
                            
                            <ul id="overseas_qualified" style="display:none;">
                              <li data-value="">select</li>
                              <li data-value="recently_migrated">I recently migrated to Australia and am preparing to apply for AHPRA</li>
                              <li data-value="aphra_app">I have submitted my AHPRA application and am awaiting outcome</li>
                              <li data-value="aphra_assessment">I am preparing documentation for AHPRA assessment</li>
                              <li data-value="aphra_bridge">I am studying to meet AHPRA bridging/re-entry requirements</li>
                              <li data-value="other">Other</li>
                              
                            </ul>
                            <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="overseas_qualified" name="overseas_qualified[]" multiple="multiple"></select>
                          </div>
                          <div class="other_text_block">
                            <div id="overseasOtherText" class="mt-2" style="display: none;">
                              <label class="form-check-label">Other Reason</label>
                              <input type="text" class="form-control" name="overseas_other_text" placeholder="Please specify">
                            </div>
                            <!-- Upload -->
                            <div class="mb-3 mt-3">
                              <label class="form-label">Upload evidence</label>
                              <input type="file" class="form-control" name="overseas_evidence" accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                          </div>
                          
                        </div>
                        
                        <div class="not_registered" style="display: none;">
                          <label class="form-label">Why you're not currently registered with AHPRA:</label>
                            
                            <ul id="not_registered_div" style="display:none;">
                              <li data-value="">select</li>
                              <li data-value="education_related">Education-Related Reasons</li>
                              <li data-value="returning_practice">Returning to Practice</li>
                              <li data-value="personal_career">Personal or Career Reasons</li>
                              <li data-value="other">Other</li>
                              
                            </ul>
                            <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="not_registered_div" name="overseas_qualified[]" multiple="multiple"></select>
                        </div>
                        <div class="edu_related_reasons" style="display:none;">
                          <label class="form-label">Education-Related Reasons:</label>
                            
                          <ul id="education_related" style="display:none;">
                            <li data-value="">select</li>
                            <li data-value="startProgram">I am about to begin an AHPRA-approved nursing/midwifery program</li>
                            <li data-value="waitingAssessment">I have completed my studies and am waiting for AHPRA assessment</li>
                            <li data-value="studiedOutside">I completed my studies outside Australia and have not applied yet</li>
                            <li data-value="didNotComplete">I did not complete my nursing/midwifery qualification</li>
                            
                          </ul>
                          <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="education_related" name="overseas_qualified[]" multiple="multiple"></select>
                        </div>
                        <div class="returning_to_practice" style="display:none;">
                          <label class="form-label">Returning to Practice:</label>
                            
                          <ul id="returning_practice" style="display:none;">
                            <li data-value="">select</li>
                            <li data-value="lapsed">I previously held registration but let it lapse</li>
                            <li data-value="reentryProgram">I am currently completing a re-entry to practice program</li>
                            <li data-value="waitingPlacement">I am waiting for supervised practice placement approval</li>
                            <li data-value="nonPractisingToGeneral">I am transitioning from non-practising to general registration</li>
                            
                          </ul>
                          <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="returning_practice" name="overseas_qualified[]" multiple="multiple"></select>
                        </div>
                        <div class="personal_career_reasons" style="display:none;">
                          <label class="form-label">Personal or Career Reasons:</label>
                            
                          <ul id="personal_career" style="display:none;">
                            <li data-value="">select</li>
                            <li data-value="maternityLeave">On maternity or extended personal leave</li>
                            <li data-value="careerBreak">Taking a career break</li>
                            <li data-value="nonClinical">Working in a non-clinical healthcare role (e.g. admin, education)</li>
                            <li data-value="overseasPractice">Practising in another country</li>
                            <li data-value="nonHealth">Working in a non-healthcare sector</li>
                            <li data-value="notReturning">I do not intend to practise again</li>
                          </ul>
                          <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="personal_career" name="overseas_qualified[]" multiple="multiple"></select>
                        </div>
                        <div class="other_text_block_registered">
                          <div id="registeredOtherText" class="mt-2" style="display: none;">
                            <label class="form-check-label">Other Reason</label>
                            <input type="text" class="form-control" name="overseas_other_text" placeholder="Please specify">
                          </div>
                          <!-- Upload -->
                          <div class="mb-3 mt-3 registered_evidence" style="display: none;">
                            <label class="form-label">Upload evidence</label>
                            <input type="file" class="form-control" name="registered_evidence" accept=".pdf,.jpg,.jpeg,.png">
                          </div>
                        </div>
                        <div class="ndis_main_div">
                          <div class="level-drp">
                            <label class="form-label" for="input-1">What is your NDIS status?</label>
                            <div class="form-check  mt-1  mb-2">
                              <input class="form-check-input" type="radio" value="registered" id="availableNow" name="ndis_status">
                              <label class="form-check-label" for="availableNow">
                                I am an NDIS-registered provider
                              </label>
                            </div>
                            <div class="form-check  mt-1  mb-2">
                              <input class="form-check-input" type="radio" value="compliant" id="availableNow" name="ndis_status">
                              <label class="form-check-label" for="availableNow">
                                 I am NDIS-compliant, but not registered
                              </label>
                            </div>
                            <div class="form-check  mt-1  mb-2">
                              <input class="form-check-input" type="radio" value="not_compliant" id="availableNow" name="ndis_status">
                              <label class="form-check-label" for="availableNow">
                                 I am not NDIS-compliant
                              </label>
                            </div>
                            
                          </div>    
                        </div>
                        <!-- Registered Provider Section -->
                        <div id="ndis_registered_fields" class="ndis-section" style="display:none;">
                          <div class="alert-info">
                            <strong>NDIS Scope of Work:</strong> Agency-managed, Plan-managed, and Self-managed clients
                          </div>

                          <label for="ndis_number">NDIS Registration Number <span style="color:red">*</span></label>
                          <input type="text" id="ndis_number" name="ndis_number"><br><br>

                          <label>Upload Registration Evidence:</label>
                          <input type="file" name="ndis_registration_evidence"><br><br>

                          <div class="alert-helper">
                            You can showcase your skills and qualifications in <strong>Profession</strong> under <em>Specialties → Community</em>.<br>
                            Please add your Orientation Module and other relevant NDIS training under <strong>Mandatory Training</strong>, and your Screening Check under <strong>Checks and Clearances</strong>.
                          </div>
                        </div>
                        <!-- Compliant but Not Registered Section -->
                        <div id="ndis_compliant_fields" class="ndis-section" style="display:none;">
                          <div class="alert-info">
                            <strong>NDIS Scope of Work:</strong> Self-managed and Plan-managed clients
                          </div>

                          <div class="alert-helper">
                            You can showcase your skills and qualifications in <strong>Profession</strong> under <em>Specialties → Community</em>.<br>
                            Please add your Orientation Module under <strong>Mandatory Training</strong> and your Screening Check under <strong>Checks and Clearances</strong>.
                          </div>
                        </div>
                        <!-- Not Compliant Section -->
                        <div id="ndis_not_compliant_fields" class="ndis-section" style="display:none;">
                          <div class="alert-info">
                            <strong>NDIS Scope of Work:</strong> You are not currently eligible to deliver NDIS-funded services.
                          </div>

                          <p>
                            To begin working with NDIS participants, you must complete both the <strong>NDIS Worker Orientation Module</strong> and the <strong>NDIS Worker Screening Check</strong>.<br>
                            Once compliant, you may work with plan-managed and self-managed clients.<br>
                            You can then choose to become an NDIS-registered provider if you wish to work with agency-managed clients.<br>
                            <a href="https://www.ndis.gov.au/providers/becoming-ndis-provider/how-register" target="_blank">
                              Learn how to register as an NDIS provider
                            </a>
                          </p>
                        </div>
                        <div class="box-button mt-15">
                          <button class="btn btn-apply-big font-md font-bold" type="submit" id="submitRegistrationLicenses" @if(!email_verified()) disabled  @endif>Save Changes</button>
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

    
    if ($(".register_other_place").val() != "") {
      var register_other_place = JSON.parse($(".register_other_place").val());
      console.log("register_other_place",register_other_place);
      $('.js-example-basic-multiple[data-list-id="other_places"]').select2().val(register_other_place).trigger('change');
      
    }
    

    $('#toggleCheckbox').click(function(){
      if ($('#toggleCheckbox').is(':checked')) {
        // Checkbox is checked
        console.log('Checked!');
        $("#notationsSection").show();
      } else {
        // Checkbox is not checked
        console.log('Not checked!');
        $("#notationsSection").hide();
      }
    });

    if ($('#toggleCheckbox').is(':checked')) {
      // Checkbox is checked
      console.log('Checked!');
      $("#notationsSection").show();
    } else {
      // Checkbox is not checked
      console.log('Not checked!');
      $("#notationsSection").hide();
    }

    $('#toggleCheckbox_conditions').click(function(){
      if ($('#toggleCheckbox_conditions').is(':checked')) {
        // Checkbox is checked
        console.log('Checked!');
        $("#conditionsSection").show();
      } else {
        // Checkbox is not checked
        console.log('Not checked!');
        $("#conditionsSection").hide();
      }
    });
    
    if ($('#toggleCheckbox_conditions').is(':checked')) {
        // Checkbox is checked
        console.log('Checked!');
        $("#conditionsSection").show();
      } else {
        // Checkbox is not checked
        console.log('Not checked!');
        $("#conditionsSection").hide();
      }
  
    document.getElementById('reverifyBtn').addEventListener('click', function () {
    // Simulate re-verification process (replace this with your actual logic, API, etc.)
    const now = new Date();
    const formatted = now.toLocaleDateString('en-GB') + ' – ' + now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

    // Overwrite the stored last verified date (UI + backend)
    document.getElementById('lastVerified').innerText = formatted;

    // TODO: Add AJAX call or form submission to update the backend
    // Example:
    /*
    fetch('/update-verification', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ nurse_id: 123, last_verified: now.toISOString() })
    }).then(...);
    */

    alert('Your AHPRA registration has been re-verified.');
  });
    
  const registrationStatus = document.getElementById("registration-status");
  const ahpraGroup = document.getElementById("ahpra-details-group");
  const ahpraGroup_group2 = document.getElementById("manualAHPRAFields");
  const graduation_date = document.getElementById("graduationDateGroup");
  const upload_graduation_evidence = document.getElementById("uploadEvidenceGroup");
  const ahpraGroup_overseas = document.getElementById("overseasQualifiedSection");
  const ahpraotherbox = document.getElementById("overseasOtherText");
  const not_registered = document.getElementsByClassName("not_registered");

  const allowedStatuses = ["RN", "RM", "RN_RM", "NP"];

  const allowedStatuses_group2 = ["Graduate_RN", "Graduate_RM", "Student_Nurse", "Student_Midwife"];

  const allowedStatuses_group3 = ["Overseas"];

  const allowedStatuses_group4 = ["Not_Registered"];
  
  const allowedStatuses_graduate = ["Graduate_RN", "Graduate_RM"];
  

  registrationStatus.addEventListener("change", function () {
    console.log("registrationStatus",registrationStatus.value);
    if (allowedStatuses.includes(this.value)) {
      
      ahpraGroup.style.display = "block";
    } else {
      
      ahpraGroup.style.display = "none";
    }

    if (allowedStatuses_group2.includes(this.value)) {
      
      if(allowedStatuses_graduate.includes(this.value)){
        ahpraGroup_group2.style.display = "block";
        graduation_date.style.display = "block";
        upload_graduation_evidence.style.display = "block";
      }else{
        ahpraGroup_group2.style.display = "block";
        graduation_date.style.display = "none";
        upload_graduation_evidence.style.display = "none";
      }
      
    } else {
      
      ahpraGroup_group2.style.display = "none";
    }

    if (allowedStatuses_group3.includes(this.value)) {
      
      ahpraGroup_overseas.style.display = "block";
    } else {
      
      ahpraGroup_overseas.style.display = "none";
    }

    if (allowedStatuses_group4.includes(this.value)) {
      
      $(".not_registered").show();
    } else {
      
      $(".not_registered").hide();
    }
    
    
  });

  $('input[name="ndis_status"]').on('change', function () {
      const value = $(this).val();

      $('.ndis-section').hide(); // hide all sections

      if (value === 'registered') {
          $('#ndis_registered_fields').show();
      } else if (value === 'compliant') {
          $('#ndis_compliant_fields').show();
      } else if (value === 'not_compliant') {
          $('#ndis_not_compliant_fields').show();
      }
  });

  $('.js-example-basic-multiple[data-list-id="overseas_qualified"]').on('change', function() {
    let selectedValues = $(this).val();
    console.log("selectedValues",selectedValues);

    if(selectedValues.includes("other")){
      $("#overseasOtherText").show();
    }else{
      $("#overseasOtherText").hide();
    }
  });

  $('.js-example-basic-multiple[data-list-id="not_registered_div"]').on('change', function() {
    let selectedValues = $(this).val();
    console.log("selectedValues",selectedValues);

    if(selectedValues.includes("education_related")){
      $(".edu_related_reasons").show();
    }else{
      $(".edu_related_reasons").hide();
    }

    if(selectedValues.includes("returning_practice")){
      $(".returning_to_practice").show();
    }else{
      $(".returning_to_practice").hide();
    }

    if(selectedValues.includes("personal_career")){
      $(".personal_career_reasons").show();
    }else{
      $(".personal_career_reasons").hide();
    }

    if(selectedValues.includes("other")){
      $("#registeredOtherText").show();
      $(".register_evidence").show();
    }else{
      $("#registeredOtherText").hide();
      $(".register_evidence").hide();
    }
  });

  // Show/hide "Other" notation input field
  document.getElementById('notationOther').addEventListener('change', (e) => {
    const otherText = document.getElementById('otherNotationText');
    otherText.style.display = e.target.checked ? 'block' : 'none';
  });

    if ($('#notationOther').is(':checked')) {
      // Checkbox is checked
      console.log('Checked!');
      $("#otherNotationText").show();
    } else {
      // Checkbox is not checked
      console.log('Not checked!');
      $("#otherNotationText").hide();
    }



    $("#lookup-ahpra-btn").click(function(){
      var ahpraNumber = $(".ahpra_number").val();
      console.log("ahpraNumber",ahpraNumber);
      
      
      $.ajax({
        url: "{{ route('nurse.ahepra_lookup') }}",
        type: "GET",
        cache: false,
        data: {ahpraNumber:ahpraNumber},
        success: function(res) {
          console.log("res",res.division);
          $("#ahpra-lookup-result").show();
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
      var division = $("#division").html();
          var endorsements = $("#endorsements").html();
          var reg_type = $("#reg_type").html();
          var reg_status = $("#reg_status").html();
          var notations = $("#notations").html();
          var conditions = $("#conditions").html();
          var expiry = $("#expiry").html();
          var principal_practice = $("#principal_practice").html();
          var other_practices = $("#other_practices").html();
          //alert(division);
      if(division == '' && endorsements == '' && reg_type == '' && reg_status == '' && notations == '' && conditions == '' && expiry == '' && principal_practice == '' && other_practices == ''){
        $("#ahpra-lookup-result").hide();
        $("#manual_ahpra_lookup").show();
      }
   });

   var reg_status = $("#registration-status").val();
   console.log("reg_status",reg_status);

   if(reg_status == "RN" || reg_status == "RM" || reg_status == "RN_RM" || reg_status == "NP"){
    $("#ahpra-details-group").show();
   }else{
    $("#ahpra-details-group").hide();
   }

   let selectedLicensesFiles = [];

   function changeEvidenceImg(user_id,group_name){
    if (!selectedLicensesFiles) {
        selectedLicensesFiles = [];
      }


      const newFiles = Array.from($('.upload_evidence')[0].files);

      newFiles.forEach(file => {
        const exists = selectedLicensesFiles.some(f => f.name === file.name && f.lastModified === file.lastModified);
        if (!exists) {
            selectedLicensesFiles.push(file);
        }
      });

        console.log("selectedFiles",selectedLicensesFiles);

        const count = selectedLicensesFiles.length;
          console.log("evidence_count", count);
    
      // var files = $('.upload_evidence-'+language_id)[0].files;
      // console.log("files", files);
      var form_data = "";
      form_data = new FormData();

      for (var i = 0; i < selectedLicensesFiles.length; i++) {
        form_data.append("register_upload_evi[]", selectedLicensesFiles[i], selectedLicensesFiles[i]['name']);
      }

      form_data.append("user_id", user_id);
      
      form_data.append("img_field", group_name);
      form_data.append("_token", '{{ csrf_token() }}');
      
      $.ajax({
        type: "post",
        url: "{{ route('nurse.uploadLicensesEvidenceImgs') }}",
        cache: false,
        contentType: false,
        processData: false,
        async: true,
        data: form_data,

        success: function(data) {
          //$("."+name_arr+"-"+language_id).val(data);
          var image_array = JSON.parse(data);
          console.log("evidence_imgs", data);
          var htmlData = '';
          for (var i = 0; i < image_array.length; i++) {
            //console.log("degree_transcript", image_array[i]);
            var img_name = image_array[i];
            var img_field = "group1";
            console.log("img_name", 'deleteImg(' + (i + 1) + ',' + user_id + ',"' + img_name + '")');
            htmlData += '<div class="trans_img trans_img-' + (i + 1) + '"><a href="{{ url("/public") }}/uploads/education_degree/' + img_name + '" target="_blank"><i class="fa fa-file" aria-hidden="true"></i>' + image_array[i] + '</a><div class="close_btn close_btn-' + i + '" onclick="deleteEvidenceImg(' + (i + 1) + ',' + user_id + ',\'' + img_name + '\',\''+img_field+'\')" style="cursor: pointer;"><i class="fa fa-close" aria-hidden="true"></i></div></div>';
          }
          $(".evidence-reg").html(htmlData);

          
        }
      });
   }

   function deleteEvidenceImg(i,user_id,img,group_name){
    $.ajax({
        type: "post",
        url: "{{ route('nurse.deleteLicensesEvidenceImg') }}",
        data: {
          user_id: user_id,
          img: img,
          img_field: group_name,
          _token: '{{ csrf_token() }}'
        },
        cache: false,
        success: function(data) {
          if (data == 1) {
            // var old_files = JSON.parse($("."+name_arr+"-"+language_id).val());
            // console.log("old_files",old_files);
            // const itemToRemove = img;

            // const result = old_files.filter(item => item !== itemToRemove);

            // console.log(result); // [1, 2, 4, 5]
            //$("."+name_arr+"-"+language_id).val(JSON.stringify(result));
            $(".evidence-reg .trans_img-"+i).remove();

            
          }
        }
      });
   }

   function update_register_licenses(){
    

    $.ajax({
      url: "{{ route('nurse.update_registration_licenses') }}",
      type: "POST",
      cache: false,
      contentType: false,
      processData: false,
      data: new FormData($('#register_licenses_form')[0]),
      dataType: 'json',
      beforeSend: function() {
        $('#submitRegistrationLicenses').prop('disabled', true);
        $('#submitRegistrationLicenses').text('Process....');
      },
      success: function(res) {
        if (res.status == '1') {
          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Registration & Licenses Information Updated Successfully',
          }).then(function() {
            window.location.href = "{{ route('nurse.registration_licences') }}?page=registration_licences";
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
        $('#submitRegistrationLicenses').prop('disabled', false);
        $('#submitRegistrationLicenses').text('Save Changes');
        console.log("errorss", errorss);
        for (var err in errorss.responseJSON.errors) {
          $("#submitRegistrationLicenses").find("[name='" + err + "']").after("<div class='text-danger'>" + errorss.responseJSON.errors[err] + "</div>");
        }
      }
    
    });

    return false;
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
