@extends('nurse.layouts.layout')

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/css/intlTelInput.css" rel="stylesheet" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ url('/public') }}/nurse/assets/css/jquery.ui.datepicker.monthyearpicker.css">
<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.5.1/uicons-regular-rounded/css/uicons-regular-rounded.css'>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

<style type="text/css">
  .hide_profile_image{
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
      <div class="row m-0">
        <div class="col-lg-3 col-md-4 col-sm-12 p-0">
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
				<div class="circ-progress">
					<div class="progress blue">
                <span class="progress-left">
                    <span class="progress-bar"></span>
                </span>
                <span class="progress-right">
                    <span class="progress-bar"></span>
                </span>
                <div class="progress-value">0/5</div>
            </div>
				</div>
			</div>
			
      <div class="basic_profile dropdowns--set">
        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="preferences-profile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Profile
          </button>
          <div class="dropdown-menu" aria-labelledby="preferences-profile">
            <a class="dropdown-item" style="cursor: pointer;" id="my_profile">Basic Information</a>
            <a class="dropdown-item" style="cursor: pointer;" id="settings">Setting</a>
          </div>
        </div>
      </div>

			<div class="prof-profile dropdowns--set">
				<div class="dropdown">
				  <button class="btn btn-secondary dropdown-toggle" type="button" id="prof-profile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Professional Profile
				  </button>
				  <div class="dropdown-menu" aria-labelledby="prof-profile">
					<a class="dropdown-item" id="my_profession" style="cursor: pointer;">Profession</a>
          <a class="dropdown-item" id="educert" style="cursor: pointer;">Education and Certifications</a>
					<a class="dropdown-item" id="experience_info" style="cursor: pointer;">Experience</a>
					<a class="dropdown-item" id="financial_details" style="cursor: pointer;">Financial Details</a>
					<a class="dropdown-item" id="mand_training" style="cursor: pointer;">Mandatory Training</a>
					<a class="dropdown-item" id="vaccinations" style="cursor: pointer;">Vaccinations</a>
					<a class="dropdown-item" id="work_clearances" style="cursor: pointer;">Work Clearances</a>
					<a class="dropdown-item" id="professional_membership" style="cursor: pointer;">Memberships</a>
					<a class="dropdown-item" id="interview_references" style="cursor: pointer;">Interview and References</a>
          <a class="dropdown-item" id="additional_information" style="cursor: pointer;">Additional Information</a>
				  </div>
				</div>
			</div>
			<div class="preferences-profile dropdowns--set">
				<div class="dropdown">
				  <button class="btn btn-secondary dropdown-toggle" type="button" id="preferences-profile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Preferences
				  </button>
				  <div class="dropdown-menu" aria-labelledby="preferences-profile">
  					<a class="dropdown-item" style="cursor: pointer;" id="work_preferences">Find Work Preferences</a>
            <a class="dropdown-item" style="cursor: pointer;" id="personal_preferences">Personal Preferences</a>
				  </div>
				</div>
			</div>
			<div class="testimonials-profile dropdowns--set">
				<div class="dropdown">
				  <button class="btn btn-secondary dropdown-toggle" type="button" id="testimonials-profile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Testimonials
				  </button>
				  <div class="dropdown-menu" id="testimonial_reviews" aria-labelledby="testimonials-profile">
					<a class="dropdown-item" href="#">Testimonials and Reviews</a>
				  </div>
				</div>
			</div>

            <div class="box-nav-tabs nav-tavs-profile mb-5 p-0 profile-icns">
              <!-- <ul class="nav" role="tablist">
                <li><a class="btn btn-border aboutus-icon mb-20 active profile_tabs" href="#tab-my-profile" id="my_profile" data-bs-toggle="tab" role="tab" aria-controls="tab-my-profile" aria-selected="true"><i class="fi fi-rr-user"></i> My Profile</a></li>
                <li><a class="btn btn-border recruitment-icon mb-20 profile_tabs" id="settings" href="#tab-my-profile-setting" data-bs-toggle="tab" role="tab" aria-controls="tab-my-profile-setting" aria-selected="false"><i class="fi fi-rr-settings"></i> Setting</a></li>
               <li><a href="#tab-my-jobs" class="btn btn-border recruitment-icon mb-20 profile_tabs" data-bs-toggle="tab" role="tab" aria-controls="tab-my-jobs" aria-selected="false"><i class="fi fi-rr-employee-man"></i> Profession</a></li>
                
                <li><a class="btn btn-border people-icon mb-20" id="educert"  data-bs-toggle="tab" role="tab" aria-controls="tab-saved-jobs" aria-selected="false"><i class="fi fi-rr-graduation-cap"></i> Education and Certification</a></li>
                <li><a href="#experience" class="btn btn-border aboutus-icon mb-20" data-bs-toggle="tab" role="tab" aria-controls="tab-my-menu4" aria-selected="true"><i class="fi fi-rr-suitcase-alt"></i> Experience</a></li>
                <li><a href="#experience" id="experience_info" class="btn btn-border aboutus-icon mb-20" data-bs-toggle="tab" role="tab" aria-controls="tab-my-menu4" aria-selected="true"><i class="fi fi-rr-chart-histogram"></i>  Financial Details</a></li>
                <li><a href="#mand_training" id="mand_training" class="btn btn-border aboutus-icon mb-20" data-bs-toggle="tab" role="tab" aria-controls="tab-my-menu4" aria-selected="true"><i class="fi fi-rr-chart-user"></i> Mandatory Training</a></li>
                <li><a href="#vaccinations" id="vaccinations" class="btn btn-border aboutus-icon mb-20" data-bs-toggle="tab" role="tab" aria-controls="tab-my-menu4" aria-selected="true"><i class="fi fi-rr-chart-user"></i> Vaccinations</a></li>
                <li><a href="#work_clearances" id="work_clearances" class="btn btn-border recruitment-icon mb-20" data-bs-toggle="tab" role="tab" aria-controls="tab-myclearance-jobs" aria-selected="false"><i class="fi fi-rr-briefcase-arrow-right"></i> Work Clearances</a></li>
                <li><a href="#work_clearances" id="work_clearances" class="btn btn-border recruitment-icon mb-20" data-bs-toggle="tab" role="tab" aria-controls="tab-myclearance-jobs" aria-selected="false"><i class="fi fi-rr-membership-vip"></i> Professional Memberships</a></li>
                <li><a href="#interview_references" id="interview_references" class="btn btn-border recruitment-icon mb-20" data-bs-toggle="tab" role="tab" aria-controls="tab-myclearance-jobs" aria-selected="false"><i class="fi fi-rr-refer-arrow"></i> Interview and References</a></li>
                <li><a href="#personal_preferences" id="personal_preferences" class="btn btn-border recruitment-icon mb-20" data-bs-toggle="tab" role="tab" aria-controls="tab-myclearance-jobs" aria-selected="false"><i class="fi fi-rr-id-badge"></i> Personal Preferences</a></li>
                <li><a href="#work_preferences" id="work_preferences" class="btn btn-border recruitment-icon mb-20" data-bs-toggle="tab" role="tab" aria-controls="tab-myclearance-jobs" aria-selected="false"><i class="fi fi-rr-magnifying-glass-wave"></i> Find Work Preferences</a></li>
                <li><a href="#work_clearances" id="work_clearances" class="btn btn-border recruitment-icon mb-20" data-bs-toggle="tab" role="tab" aria-controls="tab-myclearance-jobs" aria-selected="false"><i class="fi fi-rr-feedback-review"></i> Testimonials and Reviews</a></li>
                <li><a href="#work_clearances" id="work_clearances" class="btn btn-border recruitment-icon mb-20" data-bs-toggle="tab" role="tab" aria-controls="tab-myclearance-jobs" aria-selected="false"><i class="fi fi-rr-guide-alt"></i> Additional Information</a></li>
                
              </ul> -->
              <div class="border-bottom pt-10 pb-10"></div>
              <div class="mt-20 mb-20"><a class="link-red font-md" href="{{ route("nurse.logout") }}"><i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Log Out</a></div>
            </div>

          </div>


        </div>





        <div class="col-lg-9 col-md-8 col-sm-12 col-12 mb-50">
          <div class="content-single content_profile">
          @if(!email_verified())
          
          <div class="alert alert-success mt-2" role="alert">
            <span class="d-flex align-items-center justify-content-center ">Please verify your email first to access your account </span>
          </div>
          @endif 
          
            <div class="tab-content">


              <div class="tab-pane fade show active" id="tab-my-profile" role="tabpanel" aria-labelledby="tab-my-profile" style="display: none">
			  <div class="card shadow-sm border-0 p-4 mt-30">
                <h3 class="mt-0 mb-15 color-brand-1">My Account</h3>
                <div class="profile_update_heading">
                  <a class="font-md color-text-paragraph-2" href="#">Update your profile</a>
                </div>
                
                <div class="mt-35 mb-40 box-info-profie d-flex align-items-center upload_image">
                  
                  <div class="image-profile">
                    
                    <form id="upload_profileimage" method="post" onsubmit="return upload_profileimage(event)">
                      <img alt="{{  Auth::guard('nurse_middle')->user()->name }}" style="object-fit:cover;border-radius: 16px;display: block;width: 85px;height: 85px;" src="{{ asset( Auth::guard('nurse_middle')->user()->profile_img)}}">


                  </div>
                  <div class="position-relative overflow-hidden">
                    <a class="btn btn-apply">Upload Avatar </a>
                    @if(email_verified())
                    <input type="file" name="image" id="fileInputs" class="position-absolute h-100" onchange="$('#upload_profileimage').submit()" accept="image/*" style="top: 0;left: 0;opacity: 0;cursor: pointer;">
                    @endif
                    <i class="fa fa-spinner fa-spin" id="preloadeer-active" style="display:none" aria-hidden="true"></i>

                  </div>
                  <!--<a class="btn btn-link">Delete</a>-->
                  </form>
                </div>
                <div class="row form-contact">
                  <div class="col-lg-12 col-md-12 update_profile">
                    <form class="" id="EditProfile" onsubmit="return editedprofile()" method="POST">
                      @csrf
                      <div class="row">
                        <div class="form-group col-md-6">
                          <label class="font-sm color-text-mutted mb-10">First Name *</label>
                          <input class="form-control" type="text" name="fullname" id="firstNameI" placeholder="Steven Job" value="{{  Auth::guard('nurse_middle')->user()->name }}">
                        </div>
                        <div class="form-group col-md-6">
                          <label class="font-sm color-text-mutted mb-10">Last Name *</label>
                          <input class="form-control" type="text" name="lastname" id="lastNameI" placeholder="Enter Your Last name" value="{{  Auth::guard('nurse_middle')->user()->lastname }}">
                        </div>
                        <div class="form-group col-md-6">
                          <label class="font-sm color-text-mutted mb-10">Email *</label>
                          <input class="form-control" type="text" name="email" id="emailI" readonly value="{{  Auth::guard('nurse_middle')->user()->email }}">
                        </div>
                        <div class="form-group col-md-6">
                          <label class="form-label" for="input-3">Mobile Number *</label>

                          <div class="row">
                            <!-- <div class="col-md-3">
                              <select name="countryCode" id="countryCode" class="form-control" placeholder="C. Code" aria-label="Default select example">
                                @php $country_phone_code = country_phone_code();@endphp
                                @forelse($country_phone_code as $cpc)
                                @if($cpc->phonecode!='0')
                                <option data-countryCode="GB" {{ Auth::guard('nurse_middle')->user()->country_code == $cpc->phonecode ? 'selected' : '' }} value="{{ $cpc->phonecode }}">(+{{ $cpc->phonecode }})</option>
                                <option data-countryCode="GB" {{ Auth::guard('nurse_middle')->user()->country_code == $cpc->phonecode ? 'selected' : '' }} value="{{ $cpc->phonecode }}">{{ $cpc->phonecode }}</option>
                                @endif
                                @empty
                                @endforelse
                              </select>
                            </div> -->
                            <div class="col-md-12 mob-adj">
                              <input type="hidden" name="countryCode" id="countryCode">
                              <input type="hidden" name="countryiso" id="country_iso" value="{{  Auth::guard('nurse_middle')->user()->country_iso }}">
                              <input class="form-control numbers" type="tel" required="" name="contact" id="contactI" value="{{  Auth::guard('nurse_middle')->user()->phone }}"  maxlength="10">
                              <span id="reqTxtcontactI" class="reqError text-danger valley"></span>
                            </div>
                          </div>



                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="font-sm color-text-mutted mb-10">Date Of Birth</label>
                            <input class="form-control" type="date" name="date_of_birth" id="date_of_birth" value="{{ Auth::guard('nurse_middle')->user()->date_of_birth }}">
                          </div>
                        </div>
                         <div class="col-lg-6">
                          <div class="">
                            <label class="font-sm color-text-mutted mb-10">Gender</label>
							<div class="gender_set">
                            <div class="form-check">
                              <input type="radio" class="" id="gender" name="gender" value="Male" @if(Auth::guard("nurse_middle")->user()->gender == "Male") checked @endif>
                              <label class="form-check-label" for="radio1">Male</label>
                            </div>
                            <div class="form-check">
                              <input type="radio" class="" id="gender" name="gender" value="Female" @if(Auth::guard('nurse_middle')->user()->gender == "Female") checked @endif>
                              <label class="form-check-label" for="radio1">Female</label>
                            </div>
							</div>
                            
                          </div>
                        </div>
                        <!-- <div class="form-group col-md-12">
                          <label class="font-sm color-text-mutted mb-10">Bio</label>
                          <textarea class="form-control" rows="4" name="bio">{{ Auth::guard('nurse_middle')->user()->bio }}</textarea>
                        </div> -->
                        <div class="form-group">
                          <label class="font-sm color-text-mutted mb-10">Personal website</label>
                          <input class="form-control" type="url" name="website" value="{{  Auth::guard('nurse_middle')->user()->personal_website }}">
                        </div>
                      </div>
                      
                      
                      
                      
                      <div class="row">
                        <!--<div class="col-lg-6">-->
                        <!--  <div class="form-group">-->
                        <!--    <label class="font-sm color-text-mutted mb-10">Country</label>-->
                        <!--    <input class="form-control" type="text"  name="country" value="United States">-->
                        <!--  </div>-->
                        <!--</div>-->
                        <div class="form-group position-relative">
                          <!-- <textarea type="text" class="form-control ps-5" placeholder="Address"></textarea> -->
                          <label class="font-sm color-text-mutted mb-10">Country</label>
                          <select class="form-control form-select ps-5" name="country" id="countryI">
                            <option value="">Select Country</option>
                            @php $country_data=country_name_from_db();@endphp
                            @foreach ($country_data as $data)
                            <option value="{{$data->iso2}}" <?= isset(Auth::guard('nurse_middle')->user()->country) &&  Auth::guard('nurse_middle')->user()->country == $data->iso2 ? 'selected' : '' ?>> {{$data->name}} </option>
                            @endforeach


                          </select>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group position-relative">
                            <!-- <textarea type="text" class="form-control ps-5" placeholder="Address"></textarea> -->
                            <label>State *</label>
                            <select class="form-control form-select ps-5" name="state" id="stateI">
                              @php
                              if(isset( Auth::guard('nurse_middle')->user()->country)){
                              $state_data =state_name_array( Auth::guard('nurse_middle')->user()->country);
                              }else{
                              $state_data = '';
                              }
                              @endphp

                              @if(isset($state_data) && !empty($state_data))
                              @foreach ($state_data as $data_state)
                              <option value="{{$data_state->id}}" <?= isset(Auth::guard('nurse_middle')->user()->state) &&  Auth::guard('nurse_middle')->user()->state  == $data_state->id ? 'selected' : '' ?>> {{$data_state->name}} </option>
                              @endforeach
                              @endif

                            </select>
                            <!--<i class="fa-solid fa-location-dot position-absolute  start-0 translate-middle-y ms-3 fs-5 text-primary" style="    top: 25px!important;"></i>-->
                          </div>
                          <span id="reqTxtstateI" class="reqError text-danger valley"></span>
                        </div>

                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="font-sm color-text-mutted mb-10">City</label>
                            <input class="form-control" type="text" name="city" value="{{  Auth::guard('nurse_middle')->user()->city }}">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="font-sm color-text-mutted mb-10">Post code</label>
                            <input class="form-control post_code" type="text" name="post_code" value="{{  Auth::guard('nurse_middle')->user()->post_code }}" maxlength="10">
                          </div>
                        </div>
                        
                       
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="font-sm color-text-mutted mb-10">Home Address</label>
                            <input class="form-control" type="text" name="home_address" value="{{ Auth::guard('nurse_middle')->user()->home_address }}">
                          </div>
                        </div>
                        <h6 class="emergency_text">
                          Emergency Contact Information
                        </h6>
                        <div class="col-lg-6 row">
                          <div class="form-group">
                            <label class="font-sm color-text-mutted mb-10">Mobile No</label>
                            
                            <div class="col-md-12 mob-adj">
                              <input type="hidden" name="emergency_countryCode" id="emergency_countryCode">
                              <input type="hidden" name="emergency_countryiso" id="emergency_country_iso">
                              <input class="form-control numbers" type="text" required="" name="emergency_conact_numeber" id="contactI_emergency" value="{{ Auth::guard('nurse_middle')->user()->emergency_conact_numeber }}" maxlength="10">
                              <span id="reqTxtcontactI" class="reqError valley"></span>
                            </div>
                            
                          </div>
                        </div>
                        <div class="col-lg-6 row">
                          <div class="form-group">
                            <label class="font-sm color-text-mutted mb-10">Email*</label>
                            
                            <div class="col-md-12">
                              
                              <input class="form-control" type="email" required="" name="emergergency_contact_email" id="emergergency_contact_email" placeholder="Email" value="{{ Auth::guard('nurse_middle')->user()->emergergency_contact_email }}">
                              
                            </div>
                            
                          </div>
                        </div>
                        <div class="box-button mt-15">
                          <button class="btn btn-apply-big font-md font-bold"@if(!email_verified())  disabled  @endif type="submit" id="submitfrm">Save Changes</button>
                        </div>
                      </div>
                    </form>
                  </div>

                  <div class="col-lg-12 col-md-12 change_password_div" style="display: none;">
                    <!-- <div class="border-bottom pt-10 pb-10 mb-30"></div> -->
                    <h6 class="mb-20">Change your password</h6>
                    <form class="" id="ChangePassword" onsubmit="return ChangePassword()" method="POST">
                      @csrf
                      <div class="row">

                        <div class="form-group mb-3">

                          <label for="exampleInputEmail1" class="form-label">Old Password *</label>

                          <input type="password" name="old_password" id="old_password" class="form-control readonly-field" placeholder="">

                        </div>


                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-label">New Password *</label>
                            <input class="form-control" type="password" name="password" id="password" class="form-control readonly-field" placeholder="">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-label">Confirm New Password *</label>
                            <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" class="form-control readonly-field" placeholder="">
                          </div>
                        </div>
                      </div>
                      <div class="border-bottom pt-10 pb-10"></div>

                      <div class="box-button mt-15">
                        <button class="btn btn-apply-big font-md font-bold" @if(!email_verified())  disabled  @endif>Update Password</button>
                      </div>
                    </form>
                  </div>
                  <!--<div class="col-lg-6 col-md-12">-->
                  <!--  <div class="box-skills">-->
                  <!--    <h5 class="mt-0 color-brand-1">Skills</h5>-->
                  <!--    <div class="form-contact">-->
                  <!--      <div class="form-group">-->
                  <!--        <input class="form-control search-icon" type="text" value="" placeholder="E.g. Angular, Laravel...">-->
                  <!--      </div>-->
                  <!--    </div>-->
                  <!--    <div class="box-tags mt-30"><a class="btn btn-grey-small mr-10">Figma<span class="close-icon"></span></a><a class="btn btn-grey-small mr-10">Adobe XD<span class="close-icon"></span></a><a class="btn btn-grey-small mr-10">NextJS<span class="close-icon"></span></a><a class="btn btn-grey-small mr-10">React<span class="close-icon"></span></a><a class="btn btn-grey-small mr-10">App<span class="close-icon"></span></a><a class="btn btn-grey-small mr-10">Digital<span class="close-icon"></span></a><a class="btn btn-grey-small mr-10">NodeJS<span class="close-icon"></span></a></div>-->
                  <!--    <div class="mt-40"> <span class="card-info font-sm color-text-paragraph-2">You can add up to 15 skills</span></div>-->
                  <!--  </div>-->
                  <!--</div>-->
                </div>
              </div>
			  </div>

              <div class="tab-pane fade" id="tab-my-jobs" role="tabpanel" aria-labelledby="tab-my-jobs" style="display: none">


                <div class="card shadow-sm border-0 p-4 mt-30">
                  <h3 class="mt-0 color-brand-1 mb-2">Profession</h3>
                  <!-- <a class="font-md color-text-paragraph-2" href="#">Add your profession/s here, and any relevant registrations and qualifications</a> -->
                  <form id="profession_form" method="POST" onsubmit="return myFunction1()">
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
<div class="specialty_sub_boxes row">
    <?php
        $speciality_surgical_data = DB::table("speciality")->where('parent', '96')->get();
        $w = 1;
    ?>
    @foreach($speciality_surgical_data as $ssd)
    <input type="hidden" name="speciality_result" class="speciality_surgical_result-{{ $w }}" value="{{ $ssd->id }}">
    <div class="surgical_row-{{ $w }} surgicalopcboxes-{{ $ssd->id }} form-group drp--clr d-none drpdown-set col-md-4">
        <label class="form-label" for="input-1">{{ $ssd->name }}</label>
           <?php
            $speciality_surgicalsub_data = DB::table("speciality")->where('parent', $ssd->id)->get();
           ?>
            <ul id="surgical_operative_care-{{ $w }}" style="display:none;">
                @foreach($speciality_surgicalsub_data as $sssd)
                <li data-value="{{ $sssd->id }}">{{ $sssd->name }}</li>
                @endforeach
            </ul>
        <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="surgical_operative_care-{{ $w }}" name="surgical_operative_care_{{ $w }}[]" multiple="multiple"></select>
    </div>
    <?php
        $w++;
    ?>
    @endforeach
    <?php
        $speciality_surgical_datamater = DB::table("speciality")->where('parent', '233')->get();
        $p = 1;
    ?>
    
    <div class="surgicalobs_row form-group drp--clr d-none drpdown-set col-md-12">
        <label class="form-label" for="input-1">Surgical Obstetrics and Gynecology (OB/GYN):</label>
           
            <ul id="surgical_obs_care" style="display:none;">
               @foreach($speciality_surgical_datamater as $ssd)
                <li data-value="{{ $ssd->id }}">{{ $ssd->name }}</li>
                 @endforeach
            </ul>
        <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="surgical_obs_care" name="surgical_obs_care[]" multiple="multiple"></select>
    </div>
    <?php
        $speciality_surgical_datamater = DB::table("speciality")->where('parent', '250')->get();
        
    ?>
    <div class="neonatal_row form-group drp--clr drpdown-set d-none col-md-12">
        <label class="form-label" for="input-1">Neonatal Care:</label>
           
            <ul id="neonatal_care" style="display:none;">
               @foreach($speciality_surgical_datamater as $ssd)
                <li data-value="{{ $ssd->id }}">{{ $ssd->name }}</li>
                 @endforeach
            </ul>
        <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="neonatal_care" name="neonatal_care[]" multiple="multiple"></select>
    </div>
    <?php
        $speciality_surgical_datap = DB::table("speciality")->where('parent', '285')->get();
        $q = 1;
    ?>
    @foreach($speciality_surgical_datap as $ssd)
     <input type="hidden" name="speciality_result" class="surgical_rowp_result-{{ $q }}" value="{{ $ssd->id }}">
    <div class="surgical_rowp surgicalpad_row-{{ $ssd->id }} surgical_rowp-{{ $q }} form-group drp--clr d-none drpdown-set col-md-4">
        <label class="form-label" for="input-1">{{ $ssd->name }}</label>
           <?php
            $speciality_surgicalsub_data = DB::table("speciality")->where('parent', $ssd->id)->orderBy('name')->get();
           ?>
            <ul id="surgical_operative_carep-{{ $q }}" style="display:none;">
                @foreach($speciality_surgicalsub_data as $sssd)
                <li data-value="{{ $sssd->id }}">{{ $sssd->name }}</li>
                @endforeach
            </ul>
        <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="surgical_operative_carep-{{ $q }}" name="surgical_operative_carep_{{ $q }}[]" multiple="multiple"></select>
    </div>
    <?php
        $q++;
    ?>
    @endforeach
</div>
<div class="form-group level-drp">
                    <label class="form-label" for="input-1">What is your level of experience?</label>
                    <!-- <input class="form-control" type="text" required="" name="fullname" placeholder="Steven Job"> -->
                    <select class="form-input mr-10 select-active" name="assistent_level">
                      
                      @for($i = 1; $i <= 30; $i++) <option value="{{ $i }}" @if(Auth::guard('nurse_middle')->user()->assistent_level == $i) selected @endif>{{ $i }}{{ $i == 1 ? 'st' : ($i == 2 ? 'nd' : ($i == 3 ? 'rd' : 'th')) }} Year</option>
                        @endfor
                    </select>
                  </div>
                  <!-- <div class="" id="mid_select">
                    <div class="form-group drp--clr drpdown-set">
                      
                      <label class="form-label" for="input-1">Nurse & Midwife degree</label>
                       <?php
                        $nurse_midwife_degree = DB::table("degree")->where('status', '1')->orderBy('name')->get();
                       ?>
                        <ul id="nurse_degree" style="display:none;">
                             @foreach($nurse_midwife_degree as $ptl)
                              <li data-value="{{ $ptl->id }}">{{ $ptl->name }}</li>
                              
                              @endforeach
                        </ul>
                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="nurse_degree" name="degree[]" multiple="multiple"></select>
                    </div>
                    <span id="reqdegree" class="reqError text-danger valley"></span>
                  </div>    -->
                  <div class="professional_bio">
                    <div class="form-group col-md-12">
                      <label class="font-sm color-text-mutted mb-10">Professional Bio</label>
                      <textarea class="form-control" rows="4" name="bio">{{ Auth::guard('nurse_middle')->user()->bio }}</textarea>
                    </div>
                    <span id="reqprofessional_bio" class="reqError text-danger valley"></span>
                  </div>   
                  <div class="professional_bio">
                    <div class="form-group col-md-12">
                      <label class="form-label" for="input-1">Current Employment Status</label>
                    <!-- <input class="form-control" type="text" required="" name="fullname" placeholder="Steven Job"> -->
                    <select class="form-input mr-10 select-active" name="employee_status">
                      <option value="">Select Employee Status</option>
                      <option value="Permanent Full-Time" @if(Auth::guard('nurse_middle')->user()->current_employee_status == "Permanent Full-Time") selected @endif>Permanent Full-Time</option>
                      <option value="Permanent Part-Time" @if(Auth::guard('nurse_middle')->user()->current_employee_status == "Permanent Part-Time") selected @endif>Permanent Part-Time</option>
                      <option value="Temporary / Contract" @if(Auth::guard('nurse_middle')->user()->current_employee_status == "Temporary / Contract") selected @endif>Temporary / Contract</option>
                      <option value="Travel" @if(Auth::guard('nurse_middle')->user()->current_employee_status == "Travel") selected @endif>Travel</option>
                      <option value="Per Diem / Local" @if(Auth::guard('nurse_middle')->user()->current_employee_status == "Per Diem / Local") selected @endif>Per Diem / Local</option>
                      <option value="On-Call / PRN (Pro Re Nata)" @if(Auth::guard('nurse_middle')->user()->current_employee_status == "On-Call / PRN (Pro Re Nata)") selected @endif>On-Call / PRN (Pro Re Nata)</option>
                      <option value="Casual" @if(Auth::guard('nurse_middle')->user()->current_employee_status == "Casual") selected @endif>Casual</option>
                      <option value="Agency / Staffing Agency" @if(Auth::guard('nurse_middle')->user()->current_employee_status == "Agency / Staffing Agency") selected @endif>Agency / Staffing Agency</option>
                      <option value="Seasonal" @if(Auth::guard('nurse_middle')->user()->current_employee_status == "Seasonal") selected @endif>Seasonal</option>
                      <option value="Intern / Residency" @if(Auth::guard('nurse_middle')->user()->current_employee_status == "Intern / Residency") selected @endif>Intern / Residency</option>
                      <option value="Self-Employed / Private Practice" @if(Auth::guard('nurse_middle')->user()->current_employee_status == "Self-Employed / Private Practice") selected @endif>Self-Employed / Private Practice</option>
                      <option value="Volunteer" @if(Auth::guard('nurse_middle')->user()->current_employee_status == "Volunteer") selected @endif>Volunteer</option>
                      <option value="Unemployed" @if(Auth::guard('nurse_middle')->user()->current_employee_status == "Unemployed") selected @endif>Unemployed</option>
                    </select>
                    </div>
                    <span id="reqemployee_status" class="reqError text-danger valley"></span>
                  </div>      
                  <div class="confirmation_checkbox">
                    <input type="checkbox" name="declare_box" @if(Auth::guard('nurse_middle')->user()->confirmation_box == 1) checked @endif><label for="confirmation_box">I declare that the information provided is true and correct</label>
                  </div>
                  <div class="box-button mt-15">
                          <button class="btn btn-apply-big font-md font-bold" type="submit" id="submitProfession" @if(Auth::guard('nurse_middle')->user()->basic_info_status != 1)disabled="" @endif>Save Changes</button>
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
                <form id="educert_form" method="POST" onsubmit="return educert()">
                  @csrf
                  <?php
                    $educationData = DB::table("user_education_cerification")->where("user_id",Auth::guard('nurse_middle')->user()->id)->first();
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
                    <label class="form-label" for="input-1">Institutions</label>
                    <input class="form-control" type="text" name="institution" value="@if(!empty($educationData)){{ $educationData->institution }}@endif">
                    <span id="reqinstitute" class="reqError text-danger valley"></span>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group level-drp">
                        <label class="form-label" for="input-1">Graduation Start Date</label>
                        <input class="form-control" type="date" name="graduation_start_date" value="@if(!empty($educationData)){{ $educationData->graduate_start_date }}@endif">
                        <span id="reqstartdate" class="reqError text-danger valley"></span>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group level-drp">
                        <label class="form-label" for="input-1">Graduation End Date</label>
                        <input class="form-control" type="date" name="graduation_end_date" value="@if(!empty($educationData)){{ $educationData->graduate_end_date }}@endif">
                        <span id="reqenddate" class="reqError text-danger valley"></span>
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
                              $certificates = DB::table("professional_certificate")->get();
                            ?>
                            <ul id="profess_cert" style="display:none;">
                                @foreach($certificates as $cert)
                                <li data-value="{{ $cert->id }}">{{ $cert->name }}</li>
                                @endforeach
                                
                            </ul>
                        <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="profess_cert" name="professional_certification[]" multiple="multiple"></select>
                      </div>
                      <div class="professional_certification_fields">
                        <div class="row">
                          <div class="col-md-6 acls_field" style="display: none;">
                            <div class="form-group level-drp"><label class=form-label for=input-1>ACLS (Advanced Cardiovascular Life Support)</label><ul id=profess_cert_acls style=display:none><li data-value="1">Australia: ALS (Advanced Life Support) - Australian Resuscitation Council (ARC)</li><li data-value="2">Canada: ACLS - Heart and Stroke Foundation of Canada (HSFC)</li><li data-value="3">Hong Kong: ACLS - Hong Kong College of Cardiology (HKCC)</li><li data-value="4">Ireland: ACLS/ALS - Irish Heart Foundation</li><li data-value="5">Jamaica: ACLS - Heart Foundation of Jamaica</li><li data-value="6">New Zealand: ALS (Advanced Life Support) - New Zealand Resuscitation Council (NZRC)</li><li data-value="7">Singapore: ACLS - Singapore Resuscitation and First Aid Council (SRFAC)</li><li data-value="8">South Africa: ACLS - Resuscitation Council of Southern Africa (RCSA)</li><li data-value="9">UK: ALS (Advanced Life Support) - Resuscitation Council UK (RCUK)</li><li data-value="10">USA: ACLS (Advanced Cardiovascular Life Support) - American Heart Association (AHA)</li></ul><select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id=profess_cert_acls name=profess_cert_acls[] multiple></select></div>
                          </div>
                          <div class="col-md-6 bls_field" style="display: none;">
                            <div class="form-group level-drp">
<label class=form-label for=input-1>BLS (Basic Life Support)</label>
<ul id=profess_cert_bls style=display:none>
<li data-value="1">Australia: BLS (Basic Life Support) - Australian Resuscitation Council (ARC)</li>
<li data-value="2">Canada: BLS - Heart and Stroke Foundation of Canada (HSFC)</li>
<li data-value="3">Hong Kong: BLS - Hong Kong College of Cardiology (HKCC)</li>

<li data-value="4">Ireland: BLS - Irish Heart Foundation</li>
<li data-value="5">Jamaica: BLS - Heart Foundation of Jamaica</li>
<li data-value="6">New Zealand: BLS (Basic Life Support) - New Zealand Resuscitation Council (NZRC)</li>
<li data-value="7">Singapore: BLS - Singapore Resuscitation and First Aid Council (SRFAC)</li>
<li data-value="8">South Africa: BLS - Resuscitation Council of Southern Africa (RCSA)</li>
<li data-value="9">UK: BLS (Basic Life Support) - Resuscitation Council UK (RCUK)</li>
<li data-value="10">USA: BLS (Basic Life Support) - American Heart Association (AHA)</li>
</ul>
<select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id=profess_cert_acls name=profess_cert_acls[] multiple></select>
</div>
                          </div>
                          <div class="col-md-6 cpr_field" style="display: none;">
                            <div class="form-group level-drp">
<label class=form-label for=input-1>CPR (Cardiopulmonary Resuscitation)</label>
<ul id=profess_cert_bls style=display:none>
<li data-value="1">Australia: CPR - Australian Resuscitation Council (ARC)</li>
<li data-value="2">Canada: CPR - Heart and Stroke Foundation of Canada (HSFC), Canadian Red Cross</li>
<li data-value="3">Hong Kong: CPR - Hong Kong College of Cardiology (HKCC), Hong Kong Red Cross</li>

<li data-value="4">Ireland: CPR - Irish Heart Foundation</li>
<li data-value="5">Jamaica: CPR - Heart Foundation of Jamaica</li>
<li data-value="6">New Zealand: CPR - New Zealand Resuscitation Council (NZRC)</li>

<li data-value="7">Singapore: CPR - Singapore Red Cross, Singapore Resuscitation and First Aid Council (SRFAC)</li>
<li data-value="8">South Africa: CPR - Resuscitation Council of Southern Africa (RCSA)</li>
<li data-value="9">UK: CPR - Resuscitation Council UK (RCUK), British Red Cross</li>
<li data-value="10">USA: CPR - American Heart Association (AHA), American Red Cross</li>
</ul>
<select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id=profess_cert_acls name=profess_cert_acls[] multiple></select>
</div>
                          </div>
                        </div>
                        
                      </div>
                      <span id="reqcertificate" class="reqError text-danger valley"></span>
                      <div class="gen"></div>
                      <h6 class="emergency_text">
                          Licenses Information 
                        </h6>
                        <div class="form-group level-drp">
                          <label class="form-label" for="input-1">License Number</label>
                          <input class="form-control" type="text" name="license_number" value="@if(!empty($educationData)){{ $educationData->licence_number }}@endif">
                          <span id="reqlicensenum" class="reqError text-danger valley"></span>
                        </div>
                        <div class="row state-row">
                        <div class="form-group position-relative col-md-6">
                          <!-- <textarea type="text" class="form-control ps-5" placeholder="Address"></textarea> -->
                          <label class="font-sm color-text-mutted mb-10">Country</label>
                          <select class="form-control form-select ps-5" name="country" id="countryLicense">
                            <option value="">Select Country</option>
                            @php $country_data=country_name_from_db();@endphp
                            <?php
                              $user_edudata = DB::table("user_education_cerification")->where("user_id",Auth::guard('nurse_middle')->user()->id)->first();
                            ?>
                            @foreach ($country_data as $data)
                            <option value="{{$data->iso2}}" @if(!empty($educationData))@if($user_edudata->country == $data->iso2) selected @endif @endif> {{$data->name}} </option>
                            @endforeach


                          </select>
                          <span id="reqcountry" class="reqError text-danger valley"></span>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group position-relative">
                            <!-- <textarea type="text" class="form-control ps-5" placeholder="Address"></textarea> -->
                            <label>State *</label>
                            <select class="form-control form-select ps-5" name="state" id="stateLicense">
                              @php
                              if(isset( $educationData->country)){
                              $state_data =state_name_array($educationData->country);
                              }else{
                              $state_data = '';
                              }
                              @endphp

                              @if(isset($state_data) && !empty($state_data))
                              @foreach ($state_data as $data_state)
                              <option value="{{$data_state->id}}" <?= isset(Auth::guard('nurse_middle')->user()->state) &&  Auth::guard('nurse_middle')->user()->state  == $data_state->id ? 'selected' : '' ?>> {{$data_state->name}} </option>
                              @endforeach
                              @endif

                            </select>
                            <!--<i class="fa-solid fa-location-dot position-absolute  start-0 translate-middle-y ms-3 fs-5 text-primary" style="    top: 25px!important;"></i>-->
                          </div>
                          <span id="reqTxtstateI" class="reqError text-danger valley"></span>
                        </div>
                        </div>
                        <div class="form-group level-drp">
                          <label class="form-label" for="input-1">Expiration Date</label>
                          <input class="form-control" type="date" name="expiration_date" value="@if(!empty($educationData)){{ $educationData->expiration_date }}@endif">
                          <span id="reqexpiration_date" class="reqError text-danger valley"></span>
                        </div>
                        <h6 class="emergency_text">
                          Additional Training 
                        </h6>
                        <div class="row">
                          <div class="col-md-6">
                             <div class="form-group level-drp">
                                <input type="hidden" name="training_course" class="training_course" value="@if(!empty($educationData)){{ $educationData->training_courses }}@endif">
                                <label class="form-label" for="input-1">Select Courses</label>
                                  <?php
                                    $courses = DB::table("additional_training")->where("type","Course")->get();
                                  ?>
                                  <ul id="training_courses" style="display:none;">
                                      @foreach($courses as $c)
                                      <li data-value="{{ $c->id }}">{{ $c->name }}</li>
                                      @endforeach
                                      
                                  </ul>
                              <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="training_courses" name="training_courses[]" multiple="multiple"></select>
                            </div>
                            <span id="reqaddtraining" class="reqError text-danger valley"></span>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group level-drp">
                                <input type="hidden" name="training_workshops" class="training_workshops" value="@if(!empty($educationData)){{ $educationData->training_workshops }}@endif">
                                <label class="form-label" for="input-1">Select Workshops</label>
                                  <?php
                                    $workshop = DB::table("additional_training")->where("type","workshop")->get();
                                  ?>
                                  <ul id="training_workshop" style="display:none;">
                                      @foreach($workshop as $c)
                                      <li data-value="{{ $c->id }}">{{ $c->name }}</li>
                                      @endforeach
                                      
                                  </ul>
                              <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="training_workshop" name="training_workshop[]" multiple="multiple"></select>
                            </div>
                            <span id="reqaddworkshops" class="reqError text-danger valley"></span>
                          </div>
                        </div>
                  <div class="box-button mt-15">
                    <button class="btn btn-apply-big font-md font-bold" type="submit" id="submitEducation" @if(Auth::guard('nurse_middle')->user()->professional_info_status != 1) disabled @endif>Save Changes</button>
                  </div>          
                </form>
              </div>
			  </div>
			  <div class="tab-pane fade" id="tab-experience" role="tabpanel" aria-labelledby="tab-educert" style="display: none">
                <div class="card shadow-sm border-0 p-4 mt-30">
                  <h3 class="mt-0 color-brand-1 mb-2">Experience</h3>
                  <?php
                    $experienceData = DB::table("user_experience")->where("user_id",Auth::guard('nurse_middle')->user()->id)->first();
                  ?>
                  <form id="experience_form" method="POST" onsubmit="return updateExperience()">
                  @csrf
                  <div class="form-group level-drp">
                    <!-- <label class="form-label" for="input-1">Total Year of Experience</label> -->
                    <input type="hidden" name="user_id" value="{{ Auth::guard('nurse_middle')->user()->id }}">
                    <!-- <input class="form-control" type="text" required="" name="year_experience" value="@if(!empty($educationData))@endif"> -->
                    
                  </div>
                  <div class="form-group level-drp">
                    <label class="form-label" for="input-1">What is your level of experience?</label>
                    <!-- <input class="form-control" type="text" required="" name="fullname" placeholder="Steven Job"> -->
                    <select class="form-input mr-10 select-active" name="assistent_level">
                      
                      @for($i = 1; $i <= 30; $i++) <option value="{{ $i }}" @if(Auth::guard('nurse_middle')->user()->assistent_level == $i) selected @endif>{{ $i }}{{ $i == 1 ? 'st' : ($i == 2 ? 'nd' : ($i == 3 ? 'rd' : 'th')) }} Year</option>
                        @endfor
                    </select>
                  </div>
                  <span id="reqlevelexpereience" class="reqError text-danger valley"></span>
                  <h6 class="emergency_text">
                    Previous Employers 
                  </h6>
                  <div class="form-group level-drp">
                    <label class="form-label" for="input-1">Names</label>
                    <input class="form-control" type="text" name="previous_employer_name" value="@if(!empty($experienceData)) {{$experienceData->employer_name}}@endif">
                    <span id="reqnames" class="reqError text-danger valley"></span>
                  </div>
                  <div class="form-group level-drp">
                    <label class="form-label" for="input-1">Position Held</label>
                    <input type="hidden" name="position_held" class="position_held" value="@if(!empty($experienceData)){{ $experienceData->position_held }}@endif">
                    <?php
                        $practitioner_type = DB::table("practitioner_type")->get();
                      ?>
                    <ul id="positions_held" style="display:none;">
                        @foreach($practitioner_type as $cert)
                        <li data-value="{{ $cert->id }}">{{ $cert->name }}</li>
                        @endforeach
                        
                    </ul>
                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="positions_held" name="positions_held[]" multiple="multiple"></select>
                    
                  </div>
                  <span id="reqpositionheld" class="reqError text-danger valley"></span>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group level-drp">
                        <label class="form-label" for="input-1">Employment Start Date</label>
                        <input class="form-control" type="date" name="start_date" value="@if(!empty($experienceData)){{ $experienceData->employeement_start_date }}@endif">
                        <span id="reqempsdate" class="reqError text-danger valley"></span>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group level-drp">
                        <label class="form-label" for="input-1">Employment End Date</label>
                        <input class="form-control" type="date" name="end_date" value="@if(!empty($experienceData)){{ $experienceData->employeement_end_date }}@endif">
                        
                      </div>
                      <div class="present_check">
                        <input type="checkbox" name="present_box" value="1" @if(!empty($experienceData))@if(!empty($experienceData->present_status == 1 )) checked @endif @endif>Present Here
                      </div>
                    </div>
                    
                  </div>
                  <h6 class="emergency_text">
                    Detailed Job Descriptions  
                  </h6>
                  <div class="form-group level-drp">
                    <label class="form-label" for="input-1">Responsibilities</label>
                    <textarea class="form-control" name="job_responeblities">@if(!empty($experienceData)) {{ $experienceData->responsiblities }}@endif</textarea>
                    <span id="reqresposiblities" class="reqError text-danger valley"></span>
                  </div>
                  <div class="form-group level-drp">
                    <label class="form-label" for="input-1">Achievements</label>
                    <textarea class="form-control" name="achievements">@if(!empty($experienceData)){{ $experienceData->achievements }}@endif</textarea>
                    <span id="reqachievements" class="reqError text-danger valley"></span>
                  </div>
                  <h6 class="emergency_text">
                    Areas of Expertise  
                  </h6>
                  <div class="form-group level-drp">
                    <input type="hidden" name="skills_comp" class="skills_comp" value="@if(!empty($experienceData)) {{ $experienceData->skills_compantancies }}@endif">
                    <label class="form-label" for="input-1">Specific skills and competencies</label>
                      <?php
                        $skills = DB::table("skills")->get();
                      ?>
                      <ul id="skills_compantancies" style="display:none;">
                          @foreach($skills as $cert)
                          <li data-value="{{ $cert->id }}">{{ $cert->name }}</li>
                          @endforeach
                          
                      </ul>
                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="skills_compantancies" name="skills_compantancies[]" multiple="multiple"></select>
                  </div>
                  <span id="reqexpertise" class="reqError text-danger valley"></span>
                  <div class="box-button mt-15">
                    <button class="btn btn-apply-big font-md font-bold" type="submit" id="submitExperience" @if(!empty($educationData)) @if($educationData->complete_status != 1) disabled @endif @endif>Save Changes</button>
                  </div>    
                  </form>
                </div>
              </div>
              <div class="tab-pane fade" id="tab-mandtraining" role="tabpanel" aria-labelledby="tab-educert" style="display: none">
                <div class="card shadow-sm border-0 p-4 mt-30">
                  <h3 class="mt-0 color-brand-1 mb-20">Mandatory Training</h3>
                  <h6 class="emergency_text">
                    Completed training programs
                  </h6>
                  <?php
                    $trainingData = DB::table("mandatory_training")->where("user_id",Auth::guard('nurse_middle')->user()->id)->first();
                  ?>
                  <form id="training_form" method="POST" onsubmit="return updateTraining()">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::guard('nurse_middle')->user()->id }}">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group level-drp">
                          <label class="form-label" for="input-1">Training Start Date</label>
                          <input class="form-control" type="date" name="start_date" value="@if(!empty($trainingData)){{ $trainingData->start_date }}@endif">
                          <span id="reqempsdate" class="reqError text-danger valley"></span>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group level-drp">
                          <label class="form-label" for="input-1">Training End Date</label>
                          <input class="form-control" type="date" name="end_date" value="@if(!empty($trainingData)){{ $trainingData->end_date }}@endif">
                          
                        </div>
                        
                      </div>
                      <div class="form-group level-drp">
                          <label class="form-label" for="input-1">Institution</label>
                          <input class="form-control" type="text" name="institution" value="@if(!empty($trainingData)){{ $trainingData->institutions }}@endif">
                          
                        </div>
                        
                        <div class="form-group level-drp">
                           <label class="form-label" for="input-1">Mandatory Continuing Education</label>
                           <select class="form-control form-select ps-5" name="mand_continue_education" id="mand_continue_education">
                            <option value="">Select mandatory continuing education</option>
                            
                            
                            <option value="Ongoing" @if(!empty($trainingData)) @if(!empty($trainingData->continuing_education == "Ongoing")) selected @endif @endif>Ongoing</option>
                            <option value="Completed" @if(!empty($trainingData)) @if(!empty($trainingData->continuing_education == "Completed")) selected @endif @endif>Completed</option>


                          </select>
                          
                        </div>
                        <div class="box-button mt-15">
                          <button class="btn btn-apply-big font-md font-bold" type="submitTraining" id="submitTraining" @if(!empty($experienceData)) @if($experienceData->complete_status != 1) disabled @endif @endif>Save Changes</button>
                        </div>  
                    </div>
                  </form>
                </div>
              </div>  
              <div class="tab-pane fade" id="tab-interview-references" role="tabpanel" aria-labelledby="tab-interview-references" style="display: none">
                <h3 class="mt-30 color-brand-1 mb-50">Interview and References</h3>
                <?php
                    $interviewReferenceData = DB::table("interview_references")->where("user_id",Auth::guard('nurse_middle')->user()->id)->first();
                  ?>
                <form id="interview_form" method="POST" onsubmit="return updateInterview()">
                  @csrf
                  <input type="hidden" name="user_id" value="{{ Auth::guard('nurse_middle')->user()->id }}">
                  <div class="form-group level-drp">
                    <label class="form-label" for="input-1">Interview Availability </label>
                    <input type="datetime-local" name="interview_availablity" class="form-control" value="@if(!empty($interviewReferenceData)){{ $interviewReferenceData->interview_availablity }}@endif">
                    <span id="reqinterviewdate" class="reqError text-danger valley"></span>
                  </div>
                  <h6 class="emergency_text">
                    Professional References
                  </h6>
                  <div class="form-group level-drp">
                    <label class="form-label" for="input-1">Names</label>
                    <input type="text" name="reference_name" class="form-control" value="@if(!empty($interviewReferenceData)){{ $interviewReferenceData->reference_name }}@endif">
                    <span id="reqprofessionalnames" class="reqError text-danger valley"></span>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group level-drp">
                        <label class="form-label" for="input-1">Email</label>
                        <input type="text" name="reference_email" class="form-control" value="@if(!empty($interviewReferenceData)){{ $interviewReferenceData->reference_email }}@endif">
                        <span id="reqprofessionalemail" class="reqError text-danger valley"></span>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="input-3">Mobile Number *</label>

                          <div class="row">
                            
                            <div class="col-md-12 mob-adj">
                              <input type="hidden" name="reference_countryCode" id="reference_countryCode">
                              <input type="hidden" name="reference_countryiso" id="reference_countryiso" value="">
                              <input class="form-control numbers" type="tel" name="reference_contact" id="reference_contactI" value="@if(!empty($interviewReferenceData)){{ $interviewReferenceData->reference_contact }}@endif"  maxlength="10">
                              <span id="reqTxtreferencecontactI" class="reqError text-danger valley"></span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group level-drp">
                        <label class="form-label" for="input-1">Relationship</label>
                        <select class="form-control form-select ps-5" name="reference_relationship" id="reference_relationship">
                            <option value="">Select Relationship</option>
                            
                            
                            <option value="Mother" @if(!empty($interviewReferenceData)) @if(!empty($interviewReferenceData->reference_relationship == "Mother")) selected @endif @endif>Mother</option>
                            <option value="Father" @if(!empty($interviewReferenceData)) @if(!empty($interviewReferenceData->reference_relationship == "Father")) selected @endif @endif>Father</option>
                            <option value="Brother" @if(!empty($interviewReferenceData)) @if(!empty($interviewReferenceData->reference_relationship == "Brother")) selected @endif @endif>Brother</option>
                            <option value="Sister" @if(!empty($interviewReferenceData)) @if(!empty($interviewReferenceData->reference_relationship == "Sister")) selected @endif @endif>Sister</option>
                            <option value="Cousin" @if(!empty($interviewReferenceData)) @if(!empty($interviewReferenceData->reference_relationship == "Cousin")) selected @endif @endif>Cousin</option>
                            <option value="Uncle" @if(!empty($interviewReferenceData)) @if(!empty($interviewReferenceData->reference_relationship == "Uncle")) selected @endif @endif>Uncle</option>
                            <option value="Aunt" @if(!empty($interviewReferenceData)) @if(!empty($interviewReferenceData->reference_relationship == "Aunt")) selected @endif @endif>Aunt</option>
                          </select>
                          <span id="reqprofessionalrelationship" class="reqError text-danger valley"></span>
                      </div>
                      <div class="box-button mt-15">
                          <button class="btn btn-apply-big font-md font-bold" type="submit" id="submitInterview">Save Changes</button>
                        </div>
                    </form>
              </div>
              <div class="tab-pane fade" id="tab-personal-preferences" role="tabpanel" aria-labelledby="tab-interview-references" style="display: none">
                <?php
                    $preferenceData = DB::table("personal_preferences")->where("user_id",Auth::guard('nurse_middle')->user()->id)->first();
                  ?>
                <h3 class="mt-30 color-brand-1 mb-50">Personal Preferences</h3>
                <form id="preferences_form" method="POST" onsubmit="return updatePreferences()">
                  @csrf
                  <input type="hidden" name="user_id" value="{{ Auth::guard('nurse_middle')->user()->id }}">
                  <div class="form-group level-drp">
                    <label class="form-label" for="input-1">Preferred Work Schedule</label>
                    <select class="form-control form-select ps-5" name="preferred_work_schedule" id="preferred_work_schedule">
                      <option value="">Select preferred work schedule</option>
                      <option value="Full-time" @if(!empty($preferenceData)) @if(!empty($preferenceData->preferred_work_schedule == "Full-time")) selected @endif @endif>Full-time</option>
                      <option value="Part-time" @if(!empty($preferenceData)) @if(!empty($preferenceData->preferred_work_schedule == "Part-time")) selected @endif @endif>Part-time</option>
                      <option value="Shift preferences" @if(!empty($preferenceData)) @if(!empty($preferenceData->preferred_work_schedule == "Shift preferences")) selected @endif @endif>Shift preferences</option>
                      
                    </select>
                    <span id="reqpreferecschedule" class="reqError text-danger valley"></span>
                  </div>
                  <h6 class="emergency_text">
                    Preferred Work Locations 
                  </h6>
                  <div class="row state-row">
                  <div class="form-group position-relative col-md-6">
                    <!-- <textarea type="text" class="form-control ps-5" placeholder="Address"></textarea> -->
                    <label class="font-sm color-text-mutted mb-10">Country</label>
                    <select class="form-control form-select ps-5" name="country" id="countryworkprefer">
                      <option value="">Select Country</option>
                      @php $country_data=country_name_from_db();@endphp
                      
                      @foreach ($country_data as $data)
                      <option value="{{$data->iso2}}" @if(!empty($preferenceData))@if($preferenceData->country == $data->iso2) selected @endif @endif> {{$data->name}} </option>
                      @endforeach


                    </select>
                    <span id="reqprecountry" class="reqError text-danger valley"></span>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group position-relative">
                      <!-- <textarea type="text" class="form-control ps-5" placeholder="Address"></textarea> -->
                      <label>State *</label>
                      <select class="form-control form-select ps-5" name="state" id="stateworkprefer">
                        @php
                        if(isset( $preferenceData->country)){
                        $state_data =state_name_array($preferenceData->country);
                        }else{
                        $state_data = '';
                        }
                        @endphp

                        @if(isset($state_data) && !empty($state_data))
                        @foreach ($state_data as $data_state)
                        <option value="{{$data_state->id}}" <?= isset(Auth::guard('nurse_middle')->user()->state) &&  Auth::guard('nurse_middle')->user()->state  == $data_state->id ? 'selected' : '' ?>> {{$data_state->name}} </option>
                        @endforeach
                        @endif

                      </select>
                      <!--<i class="fa-solid fa-location-dot position-absolute  start-0 translate-middle-y ms-3 fs-5 text-primary" style="    top: 25px!important;"></i>-->
                    </div>
                    <span id="reqprestateI" class="reqError text-danger valley"></span>
                  </div>
                  </div>
                  <div class="form-group position-relative">
                      <!-- <textarea type="text" class="form-control ps-5" placeholder="Address"></textarea> -->
                      <label>Specific Facilities</label>
                      <textarea name="specific_facilities" class="form-control">@if(!empty($preferenceData)){{ $preferenceData->specific_facilities }}@endif</textarea>
                      <span id="reqspecificfacilities" class="reqError text-danger valley"></span>
                  </div>    
                  <div class="form-group position-relative">
                      <label>Work Environment Preferences </label>
                      <select class="form-control form-select ps-5" name="work_environment" id="work_environment">
                        <option value="">Select Work Environment Preferences</option>
                        <option value="Hospital" @if(!empty($preferenceData)) @if(!empty($preferenceData->work_environment == "Hospital")) selected @endif @endif>Hospital</option>
                        <option value="Clinic" @if(!empty($preferenceData)) @if(!empty($preferenceData->work_environment == "Clinic")) selected @endif @endif>Clinic</option>
                        <option value="Home Health" @if(!empty($preferenceData)) @if(!empty($preferenceData->work_environment == "Home Healt")) selected @endif @endif>Home Health</option>
                      </select>
                      <span id="reqworkenvironement" class="reqError text-danger valley"></span>
                  </div>
                  <div class="form-group position-relative">
                      <label>Shift Preferences</label>
                      <select class="form-control form-select ps-5" name="shift_preferences" id="shift_preferences">
                        <option value="">Select Shift Preferences</option>
                        <option value="Day" @if(!empty($preferenceData)) @if(!empty($preferenceData->shift_preferences == "Day")) selected @endif @endif>Day</option>
                        <option value="Clinic" @if(!empty($preferenceData)) @if(!empty($preferenceData->shift_preferences == "Evening")) selected @endif @endif>Evening</option>
                        <option value="Night" @if(!empty($preferenceData)) @if(!empty($preferenceData->shift_preferences == "Night")) selected @endif @endif>Night</option>
                      </select>
                      <span id="reqshiftpreferences" class="reqError text-danger valley"></span>
                  </div>
                  <div class="box-button mt-15">
                    <button class="btn btn-apply-big font-md font-bold" type="submit" id="submitPersonalPreferences">Save Changes</button>
                  </div>
                </form>
              </div>  
              <div class="tab-pane fade" id="tab-work-preferences" role="tabpanel" aria-labelledby="tab-interview-references" style="display: none">
                <h3 class="mt-30 color-brand-1 mb-50">Find Work Preferences</h3>
                <?php
                    $workpreferenceData = DB::table("work_preferences")->where("user_id",Auth::guard('nurse_middle')->user()->id)->first();
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
              
              <div class="tab-pane fade" id="tab-my-profile-setting" role="tabpanel" aria-labelledby="tab-my-profile-setting">
              
            @if(email_verified())
            @if(!account_verified())
          
          <div class="alert alert-success mt-2" role="alert">
            <span class="d-flex align-items-center justify-content-center ">Your profile is in under review, Generally, it takes 2-3 business days. Until you can not make chnages in your profile setting. </span>
          </div>
          @endif 
          @endif 
            <div class="card shadow-sm border-0 p-4 mt-30">
                <h3 class="mt-0 color-brand-1 mb-2">Profile Setting</h3>
             
                <a class="font-md color-text-paragraph-2" href="#">You can make your profile visible for :</a>
                
               
                <form id="multi-step-form-nurseProfileForm" enctype="multipart/form-data">
                  @csrf
                  <!-- Other form fields -->

                  <div class="form-check mt-3">
                    <input class="form-check-input" type="checkbox" value="1" id="visibleToMedicalFacilities" 
                          {{ Auth::guard('nurse_middle')->user()->medical_facilities=='Yes' ? 'checked' : '' }} name="medical_facilities">
                    <label class="form-check-label" for="visibleToMedicalFacilities">
                        Visible to Medical Facilities
                    </label>
                </div>

                  <div class="form-check mt-3">
                      <input class="form-check-input" type="checkbox" value="1"   {{ Auth::guard('nurse_middle')->user()->agencies =='Yes'? 'checked' : '' }}  id="visibleToAgencies" name="agencies">
                      <label class="form-check-label" for="visibleToAgencies">
                          Visible to Agencies
                      </label>
                  </div>
                  <div class="form-check mt-3">
                      <input class="form-check-input" type="checkbox" value="1"   {{ Auth::guard('nurse_middle')->user()->agencies =='Yes'? 'checked' : '' }}  id="visibleToIndividuals" name="individuals">
                      <label class="form-check-label" for="visibleToAgencies">
                          Visible to Individuals (Nurse care at home)
                      </label>
                  </div>
                  <label class="form-check-label  mt-3" for="availableNow">
                 <h6> Profile Status: </h6>
                      </label>
                  <div class="form-check  mt-1  mb-2">
                      <input class="form-check-input" type="checkbox" value="1" id="availableNow" name="profile_status"   {{ Auth::guard('nurse_middle')->user()->profile_status=='Yes' ? 'checked' : '' }} >
                      <label class="form-check-label" for="availableNow">
                          Available Now
                      </label>
                  </div>
                  <div class="form-check  mt-1  mb-2">
                      <input class="form-check-input" type="checkbox" value="1" id="unavailableNow" name="profile_status_unavailable"   {{ Auth::guard('nurse_middle')->user()->profile_status=='Yes' ? 'checked' : '' }} >
                      <label class="form-check-label" for="unavailableNow">
                          Unavailable for now
                      </label>
                  </div>
                 
                  <div class="d-flex align-items-center justify-content-between">
                        <button onclick="doprofessionSeting_update()" @if(!email_verified())  disabled  @elseif(!account_verified())  disabled  @endif  class="btn btn-default px-5 py-8  rounded-2 mb-0 submit-btn-120" type="submit"><span class="resetpassword">Update Setting</span>
                          <div class="spinner-border submit-btn-1" role="status" style="display:none;">
                            <span class="sr-only">Loading...</span>
                          </div>
                        </button>
                      </div>
              </form>


              </div>

              </div>
              <div class="tab-pane fade" id="tab-vaccination" role="tabpanel" aria-labelledby="tab-educert" style="display: none">
                <div class="card shadow-sm border-0 p-4 mt-30">
                  <h3 class="mt-0 color-brand-1 mb-20">Vaccinations</h3>
                  
                  <?php
                    $vaccinationData = DB::table("vaccination_front")->where("user_id",Auth::guard('nurse_middle')->user()->id)->first();
                    //print_r($vaccinationData);
                  ?>
                  <form id="vaccination_form" method="POST" onsubmit="return vaccinationForm()">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::guard('nurse_middle')->user()->id }}">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group level-drp">
                          
                              <label class="form-label" for="input-1">Vaccination Records</label>
                                <input type="hidden" name="vaccination_r" class="vaccination_r" value="@if(!empty($vaccinationData)){{ $vaccinationData->vaccination_records }}@endif">
                                 <?php
                                  $vaccination_record = DB::table("vaccination")->get();
                                 ?>
                                  <ul id="vaccination_record" style="display:none;">
                                     @foreach($vaccination_record as $v_record)
                                      <li data-value="{{ $v_record->id }}">{{ $v_record->name }}</li>
                                       @endforeach
                                  </ul>
                              <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="vaccination_record" name="vaccination_record[]" multiple="multiple"></select>
                          
                          <span id="reqempsdate" class="reqError text-danger valley"></span>
                        </div>
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
                          <button class="btn btn-apply-big font-md font-bold" type="submitVaccination" id="submitVaccination" @if(!empty($experienceData)) @if($experienceData->complete_status != 1) disabled @endif @endif>Save Changes</button>
                        </div>  
                    </div>
                  </div>
                  </form>
                </div>
              </div>  
               <div class="tab-pane fade" id="tab-myclearance-jobs" role="tabpanel" aria-labelledby="tab-myclearance-jobs" style="display: none">


                <div class="card shadow-sm border-0 p-4 mt-30">
        
                  <h3 class="mt-0 color-brand-1 mb-2">Work Clearances</h3>
                  <a class="font-md color-text-paragraph-2" href="#">Please provide your work clearances, as required for the roles you want to apply to. Find work you want, to learn what’s required. Keep your work clearances up-to-date to maintain your eligibility for jobs</a>
                  <h6 class="mt-0 color-brand-1 mb-2">Eligibility To Work</h6>
                  <a class="font-md color-text-paragraph-2" href="#">{{ env('APP_NAME') }} does not yet connect talent to sponsorship opportunities</a>
                  <form id="multi-step-form-eligibility" enctype="multipart/form-data">
                    @csrf
                    @php
                    $clearances_data =clearances_data();

                    @endphp

                    <?php $valesidency = '';
                    if ($clearances_data != 'null') $valesidency = $clearances_data->residency; ?>
                    <div class="form-group mt-3">
                      <label class="form-label" for="input-1">Residency</label>
                      <select class="form-control" name="residency" id="residencyId">
                        <option value="">Select</option>
                        <option value="Citizen" {{ $valesidency == "Citizen" ? 'selected' : '' }}>Citizen</option>
                        <option value="Permanent Resident" {{ $valesidency == "Permanent Resident" ? 'selected' : '' }}>Permanent Resident</option>
                        <option value="Visa Holder" {{ $valesidency == "Visa Holder" ? 'selected' : '' }}>Visa Holder</option>

                      </select>
                    </div>
                    <span id="reqTxtresidencyId" class="reqError text-danger valley"></span>

                    <div id="passport_detail" @if($valesidency=='Citizen' ) style="display:none;" @endif>
                      <div class="form-group ">
                        <?php $valvisa_subclass_numbery = '';
                        if ($clearances_data != 'null') $valvisa_subclass_numbery = $clearances_data->visa_subclass_number; ?>
                        <label class="font-sm color-text-mutted mb-10">Visa Subclass Number *</label>
                        <input class="form-control" type="text" name="visa_subclass_number" id="visa_subclass_numberI" placeholder="" value="{{$valvisa_subclass_numbery }}">
                      </div>


                      <span id="reqTxtvisa_subclass_numberId" class="reqError text-danger valley"></span>
                      <div class="form-group ">
                        <?php $passport_number = '';
                        if ($clearances_data != 'null') $passport_number = $clearances_data->passport_number; ?>
                        <label class="font-sm color-text-mutted mb-10">Passport Number *</label>
                        <input class="form-control" type="text" name="passport_number" id="passport_numberI" placeholder="" value="{{ $passport_number }}">
                      </div>


                      <span id="reqTxtpassport_numberI" class="reqError text-danger valley"></span>


                      <div class="form-group position-relative">
                        <!-- <textarea type="text" class="form-control ps-5" placeholder="Address"></textarea> -->
                        <select class="form-control form-select ps-5" name="passport_country_of_Issue" id="passportcountryI">
                          <option value="">Select Country</option>
                          <?php $countryumber = Auth::guard('nurse_middle')->user()->country;
                          if ($clearances_data != 'null') $countryumber = $clearances_data->passport_country_of_Issue; ?>
                          @php $country_data=country_name_from_db();@endphp
                          @foreach ($country_data as $data)
                          <option value="{{$data->id}}" <?= $countryumber == $data->id ? 'selected' : '' ?>> {{$data->name}} </option>
                          @endforeach


                        </select>
                        <span id="reqTxtpassportcountryI" class="reqError text-danger valley"></span>
                      </div>



                      <div class="form-group ">
                        <?php $visa_grant_number = '';
                        if ($clearances_data != 'null') $visa_grant_number = $clearances_data->visa_grant_number; ?>
                        <label class="font-sm color-text-mutted mb-10">Visa Grant Number*</label>
                        <input class="form-control" type="text" name="visa_grant_number" id="visa_grant_numberI" placeholder="" value="{{ $visa_grant_number }}">
                      </div>


                      <span id="reqTxtvisa_grant_number" class="reqError text-danger valley"></span>

                    </div>
                    <div id="passport_detail_date" @if($valesidency !='Visa Holder' ) style="display:none;" @endif>
                      <div class="form-group ">
                        <?php $expiry_data = '';
                        if ($clearances_data != 'null') $expiry_data = $clearances_data->expiry_date; ?>
                        <label class="font-sm color-text-mutted mb-10">Expiry Date*</label>
                        <input class="form-control" type="date" name="expiry_date" id="expiry_dataI" value="{{ $expiry_data }}" min="{{ date('Y-m-d') }}">
                      </div>
                      <span id="reqTxtexpiry_dataI" class="reqError text-danger valley"></span>
                    </div>
                    <div class="form-group">
                      <div class="form-group">
                        <label class="form-label" for="input-1">Support Document</label>
                        <?php
                        if ($clearances_data != 'null') {
                          $valspecialimage = $clearances_data->support_document;
                          if ($valspecialimage != 'null' && $valspecialimage != '') {
                        ?>

                            <a href="{{ asset($valspecialimage) }}" target="_blank">

                              <span class="btn-primary badge badge-primary">Show</span>
                            </a>

                        <?php
                          }
                        } else {
                          $valspecialimage = '/nurse/assets/imgs/evidence_of_year_level1712557746.png';
                        }
                        ?>
                        <input type="file" name="image_support_document" id="image_support_documentI" class="form-control h-100" accept="image/*">
                        <?php
                        if ($clearances_data != 'null') {
                          $valspecialimage = $clearances_data->support_document;
                          if ($valspecialimage != 'null' && $valspecialimage != '') {
                        ?>

                            <a href="{{ asset($valspecialimage) }}" target="_blank" class="mt-2">
                              <img src="{{ asset($valspecialimage) }}" width="50px;" height="50px" />

                            </a>

                        <?php
                          }
                        } else {
                          $valspecialimage = '/nurse/assets/imgs/evidence_of_year_level1712557746.png';
                        }
                        ?>
                      </div>


                      <span id="reqasupport_document" class="reqError text-danger valley"></span>

                      <div class="d-flex align-items-center justify-content-between">
                            <button onclick="doeligibility_to_work()" @if(!email_verified())  disabled  @endif class="btn btn-default px-5 py-8  rounded-2 mb-0 submit-btn-120" type="submit"><span class="resetpassword">Submit</span>
                              <div class="spinner-border submit-btn-1" role="status" style="display:none;">
                                <span class="sr-only">Loading...</span>
                              </div>
                            </button>

                          </div>
                      
                  </form>
                </div>
                <!--==========-->
                <!--Working With Children Check-->
                <!--==========-->
                <div class="card shadow-sm border-0 p-4 mt-30">
                  <h3 class="mt-0 color-brand-1 mb-2">Working With Children Check</h3>
                  <a class="font-md color-text-paragraph-2" href="#">Add your state specific working with children clearance/s as required. Refer to your profile checklist</a>
                  <div><span class="btn-dark badge badge-dark">Optional</span> </div>
                  <form id="multi-step-form-children" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                      @php
                      $working_data =working_data();

                      @endphp
                      <div class="form-group ">
                        <?php $clearance_number = '';
                        if ($working_data != 'null') $clearance_number = $working_data->clearance_number; ?>
                        <label class="font-sm color-text-mutted mb-10">Clearance Number*</label>
                        <input class="form-control" type="text" name="clearance_number" id="clearance_numberI" placeholder="" value="{{ $clearance_number }}">
                      </div>
                      <span id="reqTxtclearance_numberI" class="reqError text-danger valley"></span>

                      <div class="col-md-12">
                        <div class="form-group position-relative">
                          <!-- <textarea type="text" class="form-control ps-5" placeholder="Address"></textarea> -->
                          <label>State *</label>
                          <select class="form-control form-select" name="clearance_state" id="clearancestateI" id="stateI">
                            @php
                            if(isset( Auth::guard('nurse_middle')->user()->country)){
                            $state_data =state_name_array( Auth::guard('nurse_middle')->user()->country);
                            }else{
                            $state_data = '';
                            }
                            @endphp
                            <?php $state_data_child = Auth::guard('nurse_middle')->user()->state;
                            if ($working_data != 'null') $state_data_child = $working_data->expiry_date; ?>
                            @if(isset($state_data) && !empty($state_data))
                            @foreach ($state_data as $data_state)
                            <option value="{{$data_state->id}}" <?= $state_data_child  == $data_state->id ? 'selected' : '' ?>> {{$data_state->name}} </option>
                            @endforeach
                            @endif

                          </select>
                          <!--<i class="fa-solid fa-location-dot position-absolute  start-0 translate-middle-y ms-3 fs-5 text-primary" style="    top: 25px!important;"></i>-->
                        </div>
                        <span id="reqTxtclearancestateI" class="reqError text-danger valley"></span>
                      </div>

                      <div class="form-group ">
                        <?php $workingexpiry_data = '';
                        if ($working_data != 'null') $workingexpiry_data = $working_data->expiry_date; ?>
                        <label class="font-sm color-text-mutted mb-10">Expiry Date*</label>
                        <input class="form-control" type="date" name="clearance_expiry_date" id="clearance_expiry_dataI" value="{{ $workingexpiry_data }}" min="{{ date('Y-m-d') }}">
                      </div>
                      <span id="reqTxtclearance_expiry_dataI" class="reqError text-danger valley"></span>

                      <div class="col-md-3">
                        <div class="d-flex align-items-center justify-content-between">
                          <button onclick="do_children_check()" @if(!email_verified())  disabled  @endif class="btn btn-default px-5 py-8  rounded-2 mb-0 submit-btn-120" type="submit"><span class="resetpassword">Submit</span>
                            <div class="spinner-border submit-btn-1" role="status" style="display:none;">
                              <span class="sr-only">Loading...</span>
                            </div>
                          </button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
                <!--==========-->
                <!-- Police check -->
                <!--==========-->
                <div class="card shadow-sm border-0 p-4 mt-30">
                  <h3 class="mt-0 color-brand-1 mb-2">Police check</h3>
                  <a class="font-md color-text-paragraph-2" href="#">Add your national police check certificate, if you have one already. The recency of the check required, will depend on the role you want. Find work you want, to learn what’s required. The check must be for employment purposes. Volunteer checks will not be accepted</a>
                  <div><span class="btn-dark badge badge-dark">Optional</span> </div>
                  <div class=""><span class="btn-light badge badge-dark">Get new police check</span> <i class="fi fi-rr-info" onclick="get_new_plice_check()"></i></div>
                  <div class="">
                    <a href="https://secure.policecheckexpress.com.au/intercheck/landing/1389/507997" target="_blank">
                      <span class="btn-secondary badge badge-secondary" target="_blank"><i class="fi fi-rr-info"></i> Get new police check </span>
                    </a>
                  </div>
                  <form id="multi-step-form-police-check" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                      @php
                      $police_check_data =police_check_data();

                      @endphp



                      <div class="form-group ">
                        <?php $date_acquired = '';
                        if ($police_check_data != 'null') $date_acquired = $police_check_data->date; ?>
                        <label class="font-sm color-text-mutted mb-10">Date Acquired*</label>
                        <input class="form-control" type="date" name="date_acquired" id="date_acquiredI" value="{{ $date_acquired }}" max="{{ date('Y-m-d') }}">
                      </div>
                      <span id="reqTxtdate_acquiredI" class="reqError text-danger valley"></span>

                      <div class="form-group">
                        <label class="form-label" for="input-1">Police Check</label>
                        <?php
                        if ($police_check_data != 'null') {
                          $check_image = $police_check_data->image;
                          if ($check_image != 'null' && $check_image != '') {
                        ?>

                            <a href="{{ asset($check_image) }}" target="_blank">

                              <span class="btn-primary badge badge-primary">Show</span>
                            </a>

                        <?php
                          }
                        } else {
                          $check_image = '/nurse/assets/imgs/evidence_of_year_level1712557746.png';
                        }
                        ?>
                        <input type="file" name="image_support_document_police" id="image_support_document_policeI" class="form-control" accept="image/*">
                        <?php
                        if ($police_check_data != 'null') {
                          $check_image = $police_check_data->image;
                          if ($check_image != 'null' && $check_image != '') {
                        ?>

                            <a href="{{ asset($check_image) }}" target="_blank" class="mt-2">
                              <img src="{{ asset($check_image) }}" width="50px;" height="50px" />

                            </a>

                        <?php
                          }
                        } else {
                          $check_image = '/nurse/assets/imgs/evidence_of_year_level1712557746.png';
                        }
                        ?>
                      </div>

                      <span id="reqTxtimage_support_documentI" class="reqError text-danger valley"></span>



                      <?php
                      if ($police_check_data != 'null') {
                        $status = $police_check_data->status;
                        if ($status == '2') {

                          echo  '<br> <div>Status:  <span class="btn-danger badge badge-danger">Rejected</span></div>';
                      ?>
                          <input type="hidden" name="action" value="1">
                          <div class="alert alert-danger mt-2" role="alert">Reason : Your Detail has been rejectd due
                            <b> {{ $police_check_data->reason }} </b> . Please Resubmit the details.
                          </div>
                          <div class="col-lg-12 col-md-12">
                            <label class="ml-20">
                              <input class="float-start mr-5 mt-6" type="checkbox" id="confirmationCheckboxPoliceCheck"> Since I obtained this National Police Check, I confirm that there have been no changes to my criminal history, and that I have not been charged with an offence punishable by 12 months imprisonment or more, or convicted, pleaded guilty to, or found guilty of an offence punishable by imprisonment in Australia and/or overseas.
                            </label>
                            <span id="reqTxtconfirmationCheckboxPoliceCheckI" class="reqError text-danger valley"></span>
                            <div class="d-flex align-items-center justify-content-between">
                              <button onclick="do_police_check()" class="btn btn-default px-5 py-8  rounded-2 mb-0 submit-btn-120" type="submit"><span class="resetpassword">Re-Submit</span>
                                <div class="spinner-border submit-btn-1" role="status" style="display:none;">
                                  <span class="sr-only">Loading...</span>
                                </div>
                              </button>

                            </div>
                          </div>
                        <?php    } elseif ($status == '0') {
                          echo  '<div> Status: <span class="btn-warning badge badge-warning">Pending</span> </div>';
                          echo ' <div class="alert alert-warning mt-2 " role="alert">
                                     Your request has been successfully submitted.Its in pending state, We will back to you as soon as possible.
                            </div>';
                        } elseif ($status == '1') {
                          echo  '<div>Status: <span class="btn-success badge badge-success">Approved</span> </div>';
                        } else {
                        ?>


                          <div class="d-flex align-items-center justify-content-between">
                            <button onclick="doprofession()" @if(!email_verified())  disabled  @endif  class="btn btn-default px-5 py-8  rounded-2 mb-0 submit-btn-120" type="submit"><span class="resetpassword">Submit</span>
                              <div class="spinner-border submit-btn-1" role="status" style="display:none;">
                                <span class="sr-only">Loading...</span>
                              </div>
                            </button>
                          </div><?php
                              }
                            } else {
                                ?>
                        <div class="col-lg-12 col-md-12">
                          <label class="ml-20">
                            <input class="float-start mr-5 mt-6" type="checkbox" id="confirmationCheckboxPoliceCheck"> Since I obtained this National Police Check, I confirm that there have been no changes to my criminal history, and that I have not been charged with an offence punishable by 12 months imprisonment or more, or convicted, pleaded guilty to, or found guilty of an offence punishable by imprisonment in Australia and/or overseas.
                          </label>
                          <span id="reqTxtconfirmationCheckboxPoliceCheckI" class="reqError text-danger valley"></span>
                          <div class="d-flex align-items-center justify-content-between">
                            <button onclick="do_police_check()" @if(!email_verified())  disabled  @endif class="btn btn-default px-5 py-8  rounded-2 mb-0 submit-btn-120" type="submit"><span class="resetpassword">Submit</span>
                              <div class="spinner-border submit-btn-1" role="status" style="display:none;">
                                <span class="sr-only">Loading...</span>
                              </div>
                            </button>

                          </div>
                        </div>
                      <?php

                            }
                      ?>




                    </div>
                  </form>
                </div>


              </div>

              <div class="tab-pane fade" id="tab-saved-jobs" role="tabpanel" aria-labelledby="tab-saved-jobs">
                <h3 class="mt-30 color-brand-1 mb-50">Menu 3</h3>

                <div class="row form-contact">
                  <div class="col-lg-6 col-md-12">

                    <h6 class="color-orange mb-20">Change your password</h6>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="font-sm color-text-mutted mb-10">Password</label>
                          <input class="form-control" type="password" value="123456789">
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="font-sm color-text-mutted mb-10">Re-Password *</label>
                          <input class="form-control" type="password" value="123456789">
                        </div>
                      </div>
                    </div>
                    <div class="border-bottom pt-10 pb-10"></div>
                    <div class="box-agree mt-30">
                      <label class="lbl-agree font-xs color-text-paragraph-2">
                        <input class="lbl-checkbox" type="checkbox" value="1">Available for freelancers
                      </label>
                    </div>
                    <div class="box-button mt-15">
                      <button class="btn btn-apply-big font-md font-bold">Save All Changes</button>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-12">
                    <div class="box-skills">
                      <h5 class="mt-0 color-brand-1">Speciality</h5>
                      <div class="form-contact">
                        <div class="form-group">
                          <input class="form-control search-icon" type="text" value="" placeholder="E.g. Angular, Laravel...">
                        </div>
                      </div>
                      <div class="box-tags mt-30">
                        <a class="btn btn-grey-small mr-10">Gen<span class="close-icon"></span></a>
                        <a class="btn btn-grey-small mr-10">Gen Surg<span class="close-icon"></span></a>
                        <a class="btn btn-grey-small mr-10">Gen Paeds<span class="close-icon"></span></a>
                        <a class="btn btn-grey-small mr-10">Resp<span class="close-icon"></span></a>
                        <a class="btn btn-grey-small mr-10">Cardio<span class="close-icon"></span></a>
                        <a class="btn btn-grey-small mr-10">Gastro<span class="close-icon"></span></a>
                        <a class="btn btn-grey-small mr-10">Surg<span class="close-icon"></span></a>
                      </div>
                      <div class="mt-40"> <span class="card-info font-sm color-text-paragraph-2">You can add up to 15 skills</span></div>
                    </div>
                  </div>
                </div>
              </div>


              <div class="tab-pane fade" id="tab-my-menu4" role="tabpanel" aria-labelledby="tab-my-menu4">
                <h3 class="mt-30 mb-15 color-brand-1">My Account</h3><a class="font-md color-text-paragraph-2" href="#">Update your profile</a>
                <div class="mt-35 mb-40 box-info-profie">
                  <div class="image-profile"><img src="assets/imgs/nurse6.png" alt="jobbox"></div><a class="btn btn-apply">Upload Avatar</a><a class="btn btn-link">Delete</a>
                </div>
                <div class="row form-contact">
                  <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                      <label class="font-sm color-text-mutted mb-10">Full Name *</label>
                      <input class="form-control" type="text" value="Steven Job">
                    </div>
                    <div class="form-group">
                      <label class="font-sm color-text-mutted mb-10">Email *</label>
                      <input class="form-control" type="text" value="stevenjob@gmail.com">
                    </div>
                    <div class="form-group">
                      <label class="font-sm color-text-mutted mb-10">Contact number</label>
                      <input class="form-control" type="text" value="01 - 234 567 89">
                    </div>
                    <!-- <div class="form-group">
                      <label class="font-sm color-text-mutted mb-10">Bio</label>
                      <textarea class="form-control" rows="4">We are AliThemes , a creative and dedicated group of individuals who love web development almost as much as we love our customers. We are passionate team with the mission for achieving the perfection in web design.</textarea>
                    </div> -->
                    <div class="form-group">
                      <label class="font-sm color-text-mutted mb-10">Personal website</label>
                      <input class="form-control" type="url" value="https://alithemes.com/">
                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="font-sm color-text-mutted mb-10">Country</label>
                          <input class="form-control" type="text" value="United States">
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="font-sm color-text-mutted mb-10">State</label>
                          <input class="form-control" type="text" value="New York">
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="font-sm color-text-mutted mb-10">City</label>
                          <input class="form-control" type="text" value="Mcallen">
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="font-sm color-text-mutted mb-10">Zip code</label>
                          <input class="form-control" type="text" value="82356">
                        </div>
                      </div>
                    </div>
                    <!-- <div class="border-bottom pt-10 pb-10 mb-30"></div> -->
                    <h6 class="color-orange mb-20">Change your password</h6>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="font-sm color-text-mutted mb-10">Password</label>
                          <input class="form-control" type="password" value="123456789">
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="font-sm color-text-mutted mb-10">Re-Password *</label>
                          <input class="form-control" type="password" value="123456789">
                        </div>
                      </div>
                    </div>
                    <div class="border-bottom pt-10 pb-10"></div>
                    <div class="box-agree mt-30">
                      <label class="lbl-agree font-xs color-text-paragraph-2">
                        <input class="lbl-checkbox" type="checkbox" value="1">Available for freelancers
                      </label>
                    </div>
                    <div class="box-button mt-15">
                      <button class="btn btn-apply-big font-md font-bold">Save All Changes</button>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-12">
                    <div class="box-skills">
                      <h5 class="mt-0 color-brand-1">Skills</h5>
                      <div class="form-contact">
                        <div class="form-group">
                          <input class="form-control search-icon" type="text" value="" placeholder="E.g. Angular, Laravel...">
                        </div>
                      </div>
                      <div class="box-tags mt-30"><a class="btn btn-grey-small mr-10">Figma<span class="close-icon"></span></a><a class="btn btn-grey-small mr-10">Adobe XD<span class="close-icon"></span></a><a class="btn btn-grey-small mr-10">NextJS<span class="close-icon"></span></a><a class="btn btn-grey-small mr-10">React<span class="close-icon"></span></a><a class="btn btn-grey-small mr-10">App<span class="close-icon"></span></a><a class="btn btn-grey-small mr-10">Digital<span class="close-icon"></span></a><a class="btn btn-grey-small mr-10">NodeJS<span class="close-icon"></span></a></div>
                      <div class="mt-40"> <span class="card-info font-sm color-text-paragraph-2">You can add up to 15 skills</span></div>
                    </div>
                  </div>
                </div>
              </div>



              <div class="tab-pane fade" id="tab-my-menu5" role="tabpanel" aria-labelledby="tab-my-menu5">


                <div class="card shadow-sm border-0 p-4">
                  <h3 class="mt-0 color-brand-1 mb-2">My Table</h3>
                  <a class="font-md color-text-paragraph-2" href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</a>

                  <table class="table table-hover mt-30">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                      </tr>
                      <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                      </tr>
                      <tr>
                        <th scope="row">3</th>
                        <td>Larry the Bird</td>
                        <td>@twitter</td>
                      </tr>
                    </tbody>
                  </table>
                </div>

              </div>




              <div class="tab-pane fade" id="tab-saved-menu6" role="tabpanel" aria-labelledby="tab-saved-menu6">
                <h3 class="mt-30 color-brand-1 mb-50">Menu 3</h3>

                <div class="row form-contact">
                  <div class="col-lg-6 col-md-12">

                    <h6 class="color-orange mb-20">Change your password</h6>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="font-sm color-text-mutted mb-10">Password</label>
                          <input class="form-control" type="password" value="123456789">
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="font-sm color-text-mutted mb-10">Re-Password *</label>
                          <input class="form-control" type="password" value="123456789">
                        </div>
                      </div>
                    </div>
                    <div class="border-bottom pt-10 pb-10"></div>
                    <div class="box-agree mt-30">
                      <label class="lbl-agree font-xs color-text-paragraph-2">
                        <input class="lbl-checkbox" type="checkbox" value="1">Available for freelancers
                      </label>
                    </div>
                    <div class="box-button mt-15">
                      <button class="btn btn-apply-big font-md font-bold">Save All Changes</button>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-12">
                    <div class="box-skills">
                      <h5 class="mt-0 color-brand-1">Speciality</h5>
                      <div class="form-contact">
                        <div class="form-group">
                          <input class="form-control search-icon" type="text" value="" placeholder="E.g. Angular, Laravel...">
                        </div>
                      </div>
                      <div class="box-tags mt-30">
                        <a class="btn btn-grey-small mr-10">Gen<span class="close-icon"></span></a>
                        <a class="btn btn-grey-small mr-10">Gen Surg<span class="close-icon"></span></a>
                        <a class="btn btn-grey-small mr-10">Gen Paeds<span class="close-icon"></span></a>
                        <a class="btn btn-grey-small mr-10">Resp<span class="close-icon"></span></a>
                        <a class="btn btn-grey-small mr-10">Cardio<span class="close-icon"></span></a>
                        <a class="btn btn-grey-small mr-10">Gastro<span class="close-icon"></span></a>
                        <a class="btn btn-grey-small mr-10">Surg<span class="close-icon"></span></a>
                      </div>
                      <div class="mt-40"> <span class="card-info font-sm color-text-paragraph-2">You can add up to 15 skills</span></div>
                    </div>
                  </div>
                </div>
              </div>


              </div> 
			  
            

            
            
      
          </div>
        </div>
      </div>
    </div>
  </section>

</main>

<?php
    if(!empty($interviewReferenceData)){
      $country_iso = $interviewReferenceData->contact_country_iso;
    }else{
      $country_iso = "au";
    }
?>
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/intlTelInput.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>
  <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
  <script src="{{ url('/public') }}/nurse/assets/js/jquery.ui.datepicker.monthyearpicker.js"></script>
   <script src= 
"https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"> 
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
  $('.post_code').keypress(function (e) {    
    
                var charCode = (e.which) ? e.which : event.keyCode    
    
                if (String.fromCharCode(charCode).match(/[^0-9]/g))    
    
                    return false;                        
    
            });    
  $('#contactI').keypress(function (e) {    
    
                var charCode = (e.which) ? e.which : event.keyCode    
    
                if (String.fromCharCode(charCode).match(/[^0-9]/g))    
    
                    return false;                        
    
            });    
  $('#emergency_country_iso').keypress(function (e) {    
    
                var charCode = (e.which) ? e.which : event.keyCode    
    
                if (String.fromCharCode(charCode).match(/[^0-9]/g))    
    
                    return false;                        
    
            });    
  $('.js-example-basic-multiple').each(function() {
        let listId = $(this).data('list-id');
        //alert(listId);
        let items = [];
        console.log("listId1",listId);
        $('#' + listId + ' li').each(function() {
            console.log("value1",$(this).text());
            items.push({ id: $(this).data('value'), text: $(this).text() });
        });
        console.log("items1",items);
        $(this).select2({
            data: items
        });

          //$("#type-of-nurse").select2({'val': 3});
          
    });
  //$("#type-of-nurse").val([1,2,3], null, false);
  //$("#type-of-nurse").select2().select 2("val", [1,2,3]);
  if($(".ntype").val() != ""){
    var nurse_type = JSON.parse($(".ntype").val());
    $('#nurse_type').select2().val(nurse_type).trigger('change');
  }

  if($(".nursing_result_one").val() != ""){
    var entry_level = JSON.parse($(".nursing_result_one").val());
    $('.js-example-basic-multiple[data-list-id="nursing_entry-1"]').select2().val(entry_level).trigger('change');
  }

  if($(".nursing_result_two").val() != ""){
    var registered_nurses = JSON.parse($(".nursing_result_two").val());
    $('.js-example-basic-multiple[data-list-id="nursing_entry-2"]').select2().val(registered_nurses).trigger('change');
  }
  
  if($(".nursing_result_three").val() != ""){
    var advanced_practioner = JSON.parse($(".nursing_result_three").val());
    $('.js-example-basic-multiple[data-list-id="nursing_entry-3"]').select2().val(advanced_practioner).trigger('change');
  }

  if($(".np_result").val() != ""){
    var nurse_prac = JSON.parse($(".np_result").val());
    $('.js-example-basic-multiple[data-list-id="nurse_practitioner_menu"]').select2().val(nurse_prac).trigger('change');
  }

  if($(".specialties_result").val() != ""){
    var specialties = JSON.parse($(".specialties_result").val());
    $('.js-example-basic-multiple[data-list-id="specialties"]').select2().val(specialties).trigger('change');
  }

  if($(".adults_result").val() != ""){
    var adults = JSON.parse($(".adults_result").val());
    $('.js-example-basic-multiple[data-list-id="speciality_entry-1"]').select2().val(adults).trigger('change');
  }

  if($(".maternity_result").val() != ""){
    var maternity = JSON.parse($(".maternity_result").val());
    $('.js-example-basic-multiple[data-list-id="speciality_entry-2"]').select2().val(maternity).trigger('change');
  }

  if($(".padneonatal_result").val() != ""){
    var paediatrics_neonatal = JSON.parse($(".padneonatal_result").val());
    $('.js-example-basic-multiple[data-list-id="speciality_entry-3"]').select2().val(paediatrics_neonatal).trigger('change');
  }
  
  if($(".community_result").val() != ""){
    var community = JSON.parse($(".community_result").val());
    $('.js-example-basic-multiple[data-list-id="speciality_entry-4"]').select2().val(community).trigger('change');
  }
  
  if($(".surgical_preoperative_result").val() != ""){
    var surgical_preoperative = JSON.parse($(".surgical_preoperative_result").val());
    $('.js-example-basic-multiple[data-list-id="surgical_row_box"]').select2().val(surgical_preoperative).trigger('change');
  }

  if($(".operatingroom_result").val() != ""){
    var operating_room = JSON.parse($(".operatingroom_result").val());
    $('.js-example-basic-multiple[data-list-id="surgical_operative_care-1"]').select2().val(operating_room).trigger('change');
  }

  if($(".operatingscout_result").val() != ""){
    var operating_room_scout = JSON.parse($(".operatingscout_result").val());
    $('.js-example-basic-multiple[data-list-id="surgical_operative_care-2"]').select2().val(operating_room_scout).trigger('change');
  }

  if($(".operatingscrub_result").val() != ""){
    var operating_room_scrub = JSON.parse($(".operatingscrub_result").val());
    $('.js-example-basic-multiple[data-list-id="surgical_operative_care-3"]').select2().val(operating_room_scrub).trigger('change');
  }

  if($(".surgical_ob_result").val() != ""){
    var surgical_obstrics_gynacology = JSON.parse($(".surgical_ob_result").val());
    $('.js-example-basic-multiple[data-list-id="surgical_obs_care"]').select2().val(surgical_obstrics_gynacology).trigger('change');
  }

  if($(".neonatal_care_result").val() != ""){
    var neonatal_care = JSON.parse($(".neonatal_care_result").val());
    $('.js-example-basic-multiple[data-list-id="neonatal_care"]').select2().val(neonatal_care).trigger('change');
  }

  if($(".paedia_surgical_result").val() != ""){
    var paedia_surgical_preoperative = JSON.parse($(".paedia_surgical_result").val());
    $('.js-example-basic-multiple[data-list-id="surgical_rowpad_box"]').select2().val(paedia_surgical_preoperative).trigger('change');
  }

  if($(".pad_op_room_result").val() != ""){
    var pad_op_room = JSON.parse($(".pad_op_room_result").val());
    $('.js-example-basic-multiple[data-list-id="surgical_operative_carep-1"]').select2().val(pad_op_room).trigger('change');
  }

  if($(".pad_qr_scout_result").val() != ""){
    var pad_qr_scout = JSON.parse($(".pad_qr_scout_result").val());
    $('.js-example-basic-multiple[data-list-id="surgical_operative_carep-2"]').select2().val(pad_qr_scout).trigger('change');
  }

  if($(".pad_qr_scrub_result").val() != ""){
    var pad_qr_scrub = JSON.parse($(".pad_qr_scrub_result").val());
    $('.js-example-basic-multiple[data-list-id="surgical_operative_carep-3"]').select2().val(pad_qr_scrub).trigger('change');
  }
  
  if($(".nurse_degree_one").val() != ""){
    var nurse_degree = JSON.parse($(".nurse_degree_one").val());
    $('.js-example-basic-multiple[data-list-id="ndegree"]').select2().val(nurse_degree).trigger('change');
  }

  if($(".prof_cert_new").val() != ""){
    var prof_cert_new = JSON.parse($(".prof_cert_new").val());
    $('.js-example-basic-multiple[data-list-id="profess_cert"]').select2().val(prof_cert_new).trigger('change');
  }

  if($(".training_course").val() != ""){
    var training_course = JSON.parse($(".training_course").val());
    $('.js-example-basic-multiple[data-list-id="training_courses"]').select2().val(training_course).trigger('change');
  }

  if($(".training_workshops").val() != ""){
    var training_workshops = JSON.parse($(".training_workshops").val());
    $('.js-example-basic-multiple[data-list-id="training_workshop"]').select2().val(training_workshops).trigger('change');
  }

  if($(".position_held").val() != ""){
    var position_held = JSON.parse($(".position_held").val());
    $('.js-example-basic-multiple[data-list-id="positions_held"]').select2().val(position_held).trigger('change');
  }

  if($(".skills_comp").val() != ""){
    var skills_comp = JSON.parse($(".skills_comp").val());
    $('.js-example-basic-multiple[data-list-id="skills_compantancies"]').select2().val(skills_comp).trigger('change');
  }

  if($(".desired_job_roles").val() != ""){
    var desired_job_roles = JSON.parse($(".desired_job_roles").val());
    $('.js-example-basic-multiple[data-list-id="des_job_role"]').select2().val(desired_job_roles).trigger('change');
  }

  if($(".benefit_preferences").val() != ""){
    var benefit_preferences = JSON.parse($(".benefit_preferences").val());
    $('.js-example-basic-multiple[data-list-id="benefit_prefer"]').select2().val(benefit_preferences).trigger('change');
  }

  if($(".vaccination_r").val() != ""){
    var vaccination_record = JSON.parse($(".vaccination_r").val());
    $('.js-example-basic-multiple[data-list-id="vaccination_record"]').select2().val(vaccination_record).trigger('change');
  }
  
  $(".surgical_row_data").insertAfter("#specility_level-1");
  $(".specialty_sub_boxes").insertAfter(".surgical_row_data");
  $(".surgicalobs_row").insertAfter("#specility_level-2");
  $(".surgical_rowp").wrapAll("<div class='col-md-12 row surgical_rowp_data'>");
  $(".paediatric_surgical_div").insertAfter("#specility_level-3");
  $(".neonatal_row").insertAfter("#specility_level-3");
  $(".surgical_rowp_data").insertAfter(".surgicalpad_row_data");

  console.log("nurse_type1",$('#nurse_type').select2("data"));

  var nurse_type_list = $('#nurse_type').select2("data");

  for(var x=0;x<nurse_type_list.length;x++){
    $(".nursing_"+nurse_type_list[x].id).removeClass('d-none');
  }

  var advancedpractioner_list = $('.js-example-basic-multiple[data-list-id="nursing_entry-3"]').select2("data");
  console.log("advancedpractioner_list",advancedpractioner_list);
  for(var a = 0;a<advancedpractioner_list.length;a++){
    if(advancedpractioner_list[a].id == "179"){
      $(".np_submenu").removeClass('d-none');
    }
  }
  

  var specialties = $('.js-example-basic-multiple[data-list-id="specialties"]').select2("data");

  var adults_list = $('.js-example-basic-multiple[data-list-id="speciality_entry-1"]').select2("data");
  for(var b = 0;b<adults_list.length;b++){
    if(adults_list[b].id == "96"){
      $(".surgical_row_data").removeClass('d-none');
    }
  }
  
  

  for(var y=0;y<specialties.length;y++){
    $(".speciality_"+specialties[y].id).removeClass('d-none');
  }

  var maternity_list = $('.js-example-basic-multiple[data-list-id="speciality_entry-2"]').select2("data");

  for(var b = 0;b<maternity_list.length;b++){
    if(maternity_list[b].id == "233"){
      $(".surgicalobs_row").removeClass('d-none');
    }
  }
  

  var padneonatal_list = $('.js-example-basic-multiple[data-list-id="speciality_entry-3"]').select2("data");
  for(var c = 0;c<padneonatal_list.length;c++){
    if(padneonatal_list[c].id == "250"){
      $(".neonatal_row").removeClass('d-none');
    }

    if(padneonatal_list[c].id == "285"){
      $(".surgicalpad_row_data").removeClass('d-none');
    }
  }
  
  
  

  var padneonatalsurgical_list = $('.js-example-basic-multiple[data-list-id="surgical_rowpad_box"]').select2("data");

  for(var l=0;l<padneonatalsurgical_list.length;l++){
    $(".surgicalpad_row-"+padneonatalsurgical_list[l].id).removeClass('d-none');
  }

 




  var surgicalpcare_list = $('.js-example-basic-multiple[data-list-id="surgical_row_box"]').select2("data");
  console.log("surgicalpcare_list",surgicalpcare_list); 
  for(var k=0;k<surgicalpcare_list.length;k++){
    $(".surgicalopcboxes-"+surgicalpcare_list[k].id).removeClass('d-none');
  }

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
                $('.js-example-basic-multiple[data-list-id="nursing_entry-'+i+'"]').select2().val(null).trigger('change');
            }
        }

        if(selectedValues.includes("3") == false){
          $('.np_submenu').addClass('d-none');
          //$('.js-example-basic-multiple[data-list-id="nursing_entry-3"]').select2().val(null).trigger('change');
          $('.js-example-basic-multiple[data-list-id="nurse_practitioner_menu"]').select2().val(null).trigger('change');
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
          //$('.js-example-basic-multiple[data-list-id="surgicalobs_row_data"]').select2().val(null).trigger('change');
        }
        
        
    });

    var sub_specialty_data_val =  $(".sub_speciality_value").val();
    console.log("specialty_data_len",sub_specialty_data_val);

    $('.js-example-basic-multiple[data-list-id="speciality_entry-1"]').on('change', function() {
        let selectedValues = $(this).val();
        //alert("hello");
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

    $('.js-example-basic-multiple[data-list-id="profess_cert"]').on('change', function() {
        let selectedValues = $(this).val();
        console.log("selectedValues",selectedValues);

        if(selectedValues.includes("6")){
          $(".acls_field").show();
        }else{
          $(".acls_field").hide();
        }

        if(selectedValues.includes("7")){
          $(".bls_field").show();
        }else{
          $(".bls_field").hide();
        }
        
    });    

  $(".change_password_link").click(function(){

    window.history.replaceState(null, null, "?page=change_password");

    var url_string = window.location.href; 
    var url = new URL(url_string);
    var c = url.searchParams.get("page");
    console.log(c);

    if(c == "change_password"){
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

    if(c == "change_password"){
      $(".upload_image").addClass("hide_profile_image");
      $(".profile_update_heading").hide();
      $(".update_profile").hide();
      $(".change_password_div").show();
    }

    $("#my_profession").click(function(e){
    //alert("hello");
    e.stopPropagation();
    // $(".prof-profile .dropdown").addClass("show");
    //   $(".prof-profile .dropdown-menu").addClass("show");
    window.history.replaceState(null, null, "?page=profession");

    var url_string = window.location.href; 
    var url = new URL(url_string);
    var c = url.searchParams.get("page");
    console.log(c);

    if(c == "profession"){
      $(".tab-pane").hide();
      $("#tab-my-jobs").css("opacity","1");
      $("#tab-my-jobs").show();
      
    }

  });

    $("#my_profile").click(function(e){
     e.stopPropagation();
    window.history.replaceState(null, null, "?page=my_profile");

    var url_string = window.location.href; 
    var url = new URL(url_string);
    var c = url.searchParams.get("page");
    console.log(c);

    if(c == "my_profile"){
      $(".tab-pane").hide();
      
      $("#tab-my-profile").show();
    }

  });

    $("#settings").click(function(e){
     e.stopPropagation();
    window.history.replaceState(null, null, "?page=settings");

    var url_string = window.location.href; 
    var url = new URL(url_string);
    var c = url.searchParams.get("page");
    console.log(c);

    if(c == "settings"){
      $(".tab-pane").hide();
      $("#tab-my-profile-setting").css("opacity","1");
      $("#tab-my-profile-setting").show();
    }

  });
    $("#experience_info").click(function(e){
     e.stopPropagation();
      window.history.replaceState(null, null, "?page=experience_info");

      var url_string = window.location.href; 
      var url = new URL(url_string);
      var c = url.searchParams.get("page");
      console.log(c);

      if(c == "experience_info"){
        $(".tab-pane").hide();
        $("#tab-experience").css("opacity","1");
        $("#tab-experience").show();
      }

    });
    $("#educert").click(function(e){
      e.stopPropagation();
      window.history.replaceState(null, null, "?page=educert");

      var url_string = window.location.href; 
      var url = new URL(url_string);
      var c = url.searchParams.get("page");
      console.log(c);

      if(c == "educert"){
        $(".tab-pane").hide();
        $("#tab-educert").css("opacity","1");
        $("#tab-educert").show();
      }

    });

    $("#mand_training").click(function(e){
      e.stopPropagation();
      window.history.replaceState(null, null, "?page=mandatory_training");

      var url_string = window.location.href; 
      var url = new URL(url_string);
      var c = url.searchParams.get("page");
      console.log(c);

      if(c == "mandatory_training"){
        $(".tab-pane").hide();
        $("#tab-mandtraining").css("opacity","1");
        $("#tab-mandtraining").show();
      }

    });

    $("#work_clearances").click(function(e){
      e.stopPropagation();
      window.history.replaceState(null, null, "?page=work_clearances");

      var url_string = window.location.href; 
      var url = new URL(url_string);
      var c = url.searchParams.get("page");
      console.log(c);

      if(c == "work_clearances"){
        $(".tab-pane").hide();
        $("#tab-myclearance-jobs").css("opacity","1");
        $("#tab-myclearance-jobs").show();
      }

    });
    $("#interview_references").click(function(e){
      e.stopPropagation();
      window.history.replaceState(null, null, "?page=interview_references");

      var url_string = window.location.href; 
      var url = new URL(url_string);
      var c = url.searchParams.get("page");
      console.log(c);

      if(c == "interview_references"){

        $(".tab-pane").hide();
        $("#tab-interview-references").css("opacity","1");
        $("#tab-interview-references").show();
      }

    });

    $("#personal_preferences").click(function(e){
      e.stopPropagation();
      window.history.replaceState(null, null, "?page=personal_preferences");

      var url_string = window.location.href; 
      var url = new URL(url_string);
      var c = url.searchParams.get("page");
      console.log(c);

      if(c == "personal_preferences"){

        $(".tab-pane").hide();
        $("#tab-personal-preferences").css("opacity","1");
        $("#tab-personal-preferences").show();
      }

    });
    $("#work_preferences").click(function(e){
      e.stopPropagation();
      window.history.replaceState(null, null, "?page=work_preferences");

      var url_string = window.location.href; 
      var url = new URL(url_string);
      var c = url.searchParams.get("page");
      console.log(c);

      if(c == "work_preferences"){

        $(".tab-pane").hide();
        $("#tab-work-preferences").css("opacity","1");
        $("#tab-work-preferences").show();
      }

    });

    $("#vaccinations").click(function(e){
      e.stopPropagation();
      window.history.replaceState(null, null, "?page=vaccinations");

      var url_string = window.location.href; 
      var url = new URL(url_string);
      var c = url.searchParams.get("page");
      console.log(c);

      if(c == "vaccinations"){

        $(".tab-pane").hide();
        $("#tab-vaccination").css("opacity","1");
        $("#tab-vaccination").show();
      }

    });

  var url_string = window.location.href; 
    var url = new URL(url_string);
    var c = url.searchParams.get("page");
    console.log(c);

    if(c == "profession"){
      $("#tab-my-profile").hide();
      $("#tab-my-jobs").css("opacity","1");
      $("#tab-my-jobs").show();
      $(".profile_tabs").removeClass("active");
      $("#my_profession").addClass("active");

      $(".prof-profile .dropdown").addClass("show");
      $(".prof-profile .dropdown-menu").addClass("show");

    }

    if(c == "settings"){
      $(".tab-pane").hide();
      $("#tab-my-profile-setting").css("opacity","1");
      $("#tab-my-profile-setting").show();
      $(".profile_tabs").removeClass("active");
      $("#settings").addClass("active");
      $(".prof-profile .dropdown").addClass("show");
      $(".prof-profile .dropdown-menu").addClass("show");
    }

    if(c == "my_profile"){
      $(".tab-pane").hide();
      $("#tab-my-profile").css("opacity","1");
      $("#tab-my-profile").show();
      $(".profile_tabs").removeClass("active");
      $("#my_profile").addClass("active");
      $(".prof-profile .dropdown").addClass("show");
      $(".prof-profile .dropdown-menu").addClass("show");
    }

    if(c == "educert"){
        $(".tab-pane").hide();
        $("#tab-educert").css("opacity","1");
        $("#tab-educert").show();
        $(".profile_tabs").removeClass("active");
        $("#educert").addClass("active");
        $(".prof-profile .dropdown").addClass("show");
        $(".prof-profile .dropdown-menu").addClass("show");
      }

      if(c == "experience_info"){
        $(".tab-pane").hide();
        $("#tab-experience").css("opacity","1");
        $("#tab-experience").show();
        $(".profile_tabs").removeClass("active");
        $("#experience_info").addClass("active");
        $(".prof-profile .dropdown").addClass("show");
        $(".prof-profile .dropdown-menu").addClass("show");
      }

      if(c == "mandatory_training"){
        $(".tab-pane").hide();
        $("#tab-mandtraining").css("opacity","1");
        $("#tab-mandtraining").show();
        $(".prof-profile .dropdown").addClass("show");
        $(".prof-profile .dropdown-menu").addClass("show");
      }

      if(c == "work_clearances"){
        $(".tab-pane").hide();
        $("#tab-myclearance-jobs").css("opacity","1");
        $("#tab-myclearance-jobs").show();
        $(".profile_tabs").removeClass("active");
        $("#work_clearances").addClass("active");
      }

      if(c == "interview_references"){
        $(".tab-pane").hide();
        $("#tab-interview-references").css("opacity","1");
        $("#tab-interview-references").show();
        $(".profile_tabs").removeClass("active");
        $("#interview_references").addClass("active");
      }

      if(c == "personal_preferences"){

        $(".tab-pane").hide();
        $("#tab-personal-preferences").css("opacity","1");
        $("#tab-personal-preferences").show();
        $(".profile_tabs").removeClass("active");
        $("#personal_preferences").addClass("active");
        $(".preferences-profile .dropdown").addClass("show");
        $(".preferences-profile .dropdown-menu").addClass("show");

      }

      if(c == "work_preferences"){

        $(".tab-pane").hide();
        $("#tab-work-preferences").css("opacity","1");
        $("#tab-work-preferences").show();
        $(".profile_tabs").removeClass("active");
        $("#work_preferences").addClass("active");
        $(".preferences-profile .dropdown").addClass("show");
        $(".preferences-profile .dropdown-menu").addClass("show");
      }

      if(c == "vaccinations"){

        $(".tab-pane").hide();
        $("#tab-vaccination").css("opacity","1");
        $("#tab-vaccination").show();
        $(".profile_tabs").removeClass("active");
        $("#vaccinations").addClass("active");
        $(".prof-profile .dropdown").addClass("show");
        $(".prof-profile .dropdown-menu").addClass("show");
      }

    var phoneInputID = "#contactI_emergency";
  var input = document.querySelector(phoneInputID);
  var iti = window.intlTelInput(input, {
    // allowDropdown: false,
    // autoHideDialCode: false,
    // autoPlaceholder: "off",
    // dropdownContainer: document.body,
    // excludeCountries: ["us"],
    formatOnDisplay: false,
    // geoIpLookup: function(callback) {
    //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
    //     var countryCode = (resp && resp.country) ? resp.country : "";
    //     callback(countryCode);
    //   });
    // },
    hiddenInput: "full_number",
    initialCountry: "{{ Auth::guard('nurse_middle')->user()->emergency_country_iso }}",
    // localizedCountries: { 'de': 'Deutschland' },
    // nationalMode: false,
    // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
    // placeholderNumberType: "MOBILE",
    preferredCountries: ['AU'],
    // separateDialCode: true,
    utilsScript: ""
  });

  $(phoneInputID).on("countrychange", function(event) {

    // Get the selected country data to know which country is selected.
    var selectedCountryData = iti.getSelectedCountryData();
    console.log("selectedCountryData",selectedCountryData.dialCode);
    $("#emergency_countryCode").val(selectedCountryData.dialCode);
    $("#emergency_country_iso").val(selectedCountryData.iso2);
    //alert($("#contactI").intlTelInput("getSelectedCountryData").dialCode);
    // Get an example number for the selected country to use as placeholder.
    // newPlaceholder = intlTelInputUtils.getExampleNumber(selectedCountryData.iso2, true, intlTelInputUtils.numberFormat.INTERNATIONAL),

    //   // Reset the phone number input.
    //   iti.setNumber("");

    // // Convert placeholder as exploitable mask by replacing all 1-9 numbers with 0s
    // mask = newPlaceholder.replace(/[1-9]/g, "0");

    // // Apply the new mask for the input
    // $(this).mask(mask);
  });


  // When the plugin loads for the first time, we have to trigger the "countrychange" event manually, 
  // but after making sure that the plugin is fully loaded by associating handler to the promise of the 
  // plugin instance.

  iti.promise.then(function() {
    $(phoneInputID).trigger("countrychange");
  });

  var phoneInputID1 = "#contactI";
  var input1 = document.querySelector(phoneInputID1);
  var iti1 = window.intlTelInput(input1, {
    // // allowDropdown: false,
    autoHideDialCode: false,
    // // autoPlaceholder: "off",
    // // dropdownContainer: document.body,
    // // excludeCountries: ["us"],
    formatOnDisplay: false,
    // // geoIpLookup: function(callback) {
    //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
    //     var countryCode = (resp && resp.country) ? resp.country : "";
    //     callback(countryCode);
    //   });
    // },
    // hiddenInput: "full_number",
    initialCountry: "{{ Auth::guard('nurse_middle')->user()->country_iso }}",
    // // localizedCountries: { 'de': 'Deutschland' },
    nationalMode: false,
    // // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
    // // placeholderNumberType: "MOBILE",
    // preferredCountries: ['AU'],
    //separateDialCode: true,
    // utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.14/js/utils.js"
  });

  $(phoneInputID1).on("countrychange", function(event) {

    // Get the selected country data to know which country is selected.
    var selectedCountryData = iti1.getSelectedCountryData();
    console.log("selectedCountryData",selectedCountryData.dialCode);
    $("#countryCode").val(selectedCountryData.dialCode);
    $("#country_iso").val(selectedCountryData.iso2);
    //alert($("#contactI").intlTelInput("getSelectedCountryData").dialCode);
    // Get an example number for the selected country to use as placeholder.
    // newPlaceholder = intlTelInputUtils.getExampleNumber(selectedCountryData.iso2, true, intlTelInputUtils.numberFormat.INTERNATIONAL),

    //   // Reset the phone number input.
    //   iti.setNumber("");

    // // Convert placeholder as exploitable mask by replacing all 1-9 numbers with 0s
    // mask = newPlaceholder.replace(/[1-9]/g, "0");

    // // Apply the new mask for the input
    // $(this).mask(mask);
  });


  // When the plugin loads for the first time, we have to trigger the "countrychange" event manually, 
  // but after making sure that the plugin is fully loaded by associating handler to the promise of the 
  // plugin instance.

  iti1.promise.then(function() {
    $(phoneInputID1).trigger("countrychange");
  });

  var phoneInputID2 = "#reference_contactI";
  var input2 = document.querySelector(phoneInputID2);
  var iti2 = window.intlTelInput(input2, {
    // allowDropdown: false,
    // autoHideDialCode: false,
    // autoPlaceholder: "off",
    // dropdownContainer: document.body,
    // excludeCountries: ["us"],
    formatOnDisplay: false,
    // geoIpLookup: function(callback) {
    //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
    //     var countryCode = (resp && resp.country) ? resp.country : "";
    //     callback(countryCode);
    //   });
    // },
    hiddenInput: "full_number",
    initialCountry: "<?php echo $country_iso; ?>",
    // localizedCountries: { 'de': 'Deutschland' },
    // nationalMode: false,
    // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
    // placeholderNumberType: "MOBILE",
    preferredCountries: ['AU'],
    // separateDialCode: true,
    utilsScript: ""
  });

  $(phoneInputID2).on("countrychange", function(event) {

    // Get the selected country data to know which country is selected.
    var selectedCountryData = iti2.getSelectedCountryData();
    console.log("selectedCountryData",selectedCountryData.dialCode);
    $("#reference_countryCode").val(selectedCountryData.dialCode);
    $("#reference_countryiso").val(selectedCountryData.iso2);
    //alert($("#contactI").intlTelInput("getSelectedCountryData").dialCode);
    // Get an example number for the selected country to use as placeholder.
    // newPlaceholder = intlTelInputUtils.getExampleNumber(selectedCountryData.iso2, true, intlTelInputUtils.numberFormat.INTERNATIONAL),

    //   // Reset the phone number input.
    //   iti.setNumber("");

    // // Convert placeholder as exploitable mask by replacing all 1-9 numbers with 0s
    // mask = newPlaceholder.replace(/[1-9]/g, "0");

    // // Apply the new mask for the input
    // $(this).mask(mask);
  });


  // When the plugin loads for the first time, we have to trigger the "countrychange" event manually, 
  // but after making sure that the plugin is fully loaded by associating handler to the promise of the 
  // plugin instance.

  iti2.promise.then(function() {
    $(phoneInputID2).trigger("countrychange");
  });

  
  
  $(document).ready(function() {
    $('#specialtyId').change(function() {
      var specialtyId = $(this).val();
      if (specialtyId !== '') {
        // Show the subspecialty select input group

        // Fetch the subspecialties based on the selected specialty
        $.ajax({
          url: '{{ route("nurse.fetch-subspecialty")}}',
          method: 'GET',
          data: {
            specialty_id: specialtyId
          },
          success: function(response) {
            // Clear existing options
            $('#subspecialtyId').empty();
            // Check if there are subspecialties available
            if (response.subspecialty.length > 0) {
              // If there are subspecialties available, show the subspecialty select input group
              $('#subspecialtyGroup').show();
              // Add new options
              $.each(response.subspecialty, function(index, subspecialty) {
                $('#subspecialtyId').append('<option value="' + subspecialty.id + '">' + subspecialty.name + '</option>');
              });
            } else {
              // If no subspecialties are available, hide the subspecialty select input group
              $('#subspecialtyGroup').hide();
            }

          },
          error: function(xhr, status, error) {
            console.error(error);
          }
        });
      } else {
        // If no specialty is selected, hide the subspecialty select input group

        // Clear options of subspecialty select input
        $('#subspecialtyId').empty();

        // Hide the subspecialty select input group
        $('#subspecialtyGroup').hide();
      }
    });
  });
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

  function doprofessionregistration() {

    event.preventDefault();

    $(".valley").html("");

    $('.submit-btn-120').prop('disabled', true);

    $('.submit-btn-1').show();

    $('.resetpassword').hide();

    var returnValue;

    var ahpra_numberI = document.getElementById("ahpra_numberI").value;

    returnValue = true;

    if (ahpra_numberI.trim() == "") {

      document.getElementById("reqTxtahpra_numberI").innerHTML = "* Please Enter the AHPRA Registration number.";

      returnValue = false;

    }

    if (returnValue == false) {

      $('.submit-btn-120').prop('disabled', false);

      $('.submit-btn-1').hide();

      $('.resetpassword').show();

    }



    if (returnValue == true) {

      let formData = new FormData($('#multi-step-form-registration')[0]);



      $.ajax({

        type: 'POST',

        url: "{{route('nurse.update-profession-user-ahpra_numberI')}}",

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

            $('#multi-step-form-registration')[0].reset();



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

  function doprofessionSeting_update() {

    event.preventDefault();

    $(".valley").html("");

    $('.submit-btn-120').prop('disabled', true);

    $('.submit-btn-1').show();

    $('.resetpassword').hide();

      let formData = new FormData($('#multi-step-form-nurseProfileForm')[0]);
      $.ajax({

        type: 'POST',

        url: "{{route('nurse.update-profession-profile-setting')}}",

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

            $('#multi-step-form')[0].reset();



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
  function doprofession() {

    event.preventDefault();

    $(".valley").html("");

    $('.submit-btn-120').prop('disabled', true);

    $('.submit-btn-1').show();

    $('.resetpassword').hide();

    var returnValue;

    var specialtyId = document.getElementById("specialtyId").value;
    var subspecialtyId = document.getElementById("subspecialtyId").value;
    var assistent_level = document.getElementById("assistent_level").value;
    var evidence_type = document.getElementById("evidence_type").value;
    var image_evidenceI = document.getElementById("image_evidenceI").value;





    returnValue = true;

    if (specialtyId.trim() == "") {

      document.getElementById("reqTxtspecialtyId").innerHTML = "* Please Select Profession.";

      returnValue = false;

    }
    if (subspecialtyId.trim() == "") {

      document.getElementById("reqsubspecialtyId").innerHTML = "* Please Select Practitioner Type  .";

      returnValue = false;

    }
    if (assistent_level.trim() == "") {

      document.getElementById("reqassistent_level").innerHTML = "* Please Select the Year Level.";

      returnValue = false;

    }
    if (evidence_type.trim() == "") {

      document.getElementById("reqevidence_type").innerHTML = "* Please Select the Evidence Type.";

      returnValue = false;

    }

    if (image_evidenceI.trim() == "") {
      document.getElementById("reqaimage_evidence").textContent = "* Please Upload the Evidence of year level.";
      returnValue = false;
    }

    if (returnValue == false) {

      $('.submit-btn-120').prop('disabled', false);

      $('.submit-btn-1').hide();

      $('.resetpassword').show();

    }



    if (returnValue == true) {

      let formData = new FormData($('#multi-step-form')[0]);



      $.ajax({

        type: 'POST',

        url: "{{route('nurse.update-profession')}}",

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

            $('#multi-step-form')[0].reset();



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
@endsection