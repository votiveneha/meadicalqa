@extends('nurse.layouts.layout')
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


            <div class="box-nav-tabs nav-tavs-profile mb-5 p-0">
              <ul class="nav" role="tablist">
                <li><a class="btn btn-border aboutus-icon mb-20 active" href="#tab-my-profile" data-bs-toggle="tab" role="tab" aria-controls="tab-my-profile" aria-selected="true">My Profile</a></li>
                <li><a class="btn btn-border recruitment-icon mb-20" href="#tab-my-profile-setting" data-bs-toggle="tab" role="tab" aria-controls="tab-my-profile-setting" aria-selected="false">Setting</a></li>
               <li><a class="btn btn-border recruitment-icon mb-20" onclick="coming_soon()"  data-bs-toggle="tab" role="tab" aria-controls="tab-my-jobs" aria-selected="false">Profession</a></li>
                <li><a class="btn btn-border recruitment-icon mb-20"  onclick="coming_soon()" data-bs-toggle="tab" role="tab" aria-controls="tab-myclearance-jobs" aria-selected="false">Clearance</a></li>
                <li><a class="btn btn-border people-icon mb-20" onclick="coming_soon()" data-bs-toggle="tab" role="tab" aria-controls="tab-saved-jobs" aria-selected="false">Education</a></li>
                <li><a class="btn btn-border aboutus-icon mb-20" onclick="coming_soon()" data-bs-toggle="tab" role="tab" aria-controls="tab-my-menu4" aria-selected="true">Experience</a></li>
                <li><a class="btn btn-border recruitment-icon mb-20" onclick="coming_soon()" data-bs-toggle="tab" role="tab" aria-controls="tab-my-menu5" aria-selected="false">Contacts</a></li>
                <li><a class="btn btn-border people-icon mb-20" onclick="coming_soon()" data-bs-toggle="tab" role="tab" aria-controls="tab-saved-menu6" aria-selected="false">Banks</a></li>
                <!-- <li><a class="btn btn-border recruitment-icon mb-20" href="#tab-my-profile-setting" data-bs-toggle="tab" role="tab" aria-controls="tab-my-profile-setting" aria-selected="false">Setting</a></li> -->


                <!-- <li><a class="btn btn-border recruitment-icon mb-20" href="#tab-my-jobs" data-bs-toggle="tab" role="tab" aria-controls="tab-my-jobs" aria-selected="false">Profession</a></li>
                <li><a class="btn btn-border recruitment-icon mb-20" href="#tab-myclearance-jobs" data-bs-toggle="tab" role="tab" aria-controls="tab-myclearance-jobs" aria-selected="false">Clearance</a></li> -->
                <!--<li><a class="btn btn-border people-icon mb-20" href="#tab-saved-jobs" data-bs-toggle="tab" role="tab" aria-controls="tab-saved-jobs" aria-selected="false">Education</a></li>-->
                <!--<li><a class="btn btn-border aboutus-icon mb-20" href="#tab-my-menu4" data-bs-toggle="tab" role="tab" aria-controls="tab-my-menu4" aria-selected="true">Experience</a></li>-->
                <!--<li><a class="btn btn-border recruitment-icon mb-20" href="#tab-my-menu5" data-bs-toggle="tab" role="tab" aria-controls="tab-my-menu5" aria-selected="false">Contacts</a></li>-->
                <!--<li><a class="btn btn-border people-icon mb-20" href="#tab-saved-menu6" data-bs-toggle="tab" role="tab" aria-controls="tab-saved-menu6" aria-selected="false">Banks</a></li>-->
              </ul>
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


              <div class="tab-pane fade show active" id="tab-my-profile" role="tabpanel" aria-labelledby="tab-my-profile">
                <h3 class="mt-30 mb-15 color-brand-1">My Account</h3><a class="font-md color-text-paragraph-2" href="#">Update your profile</a>
                <div class="mt-35 mb-40 box-info-profie d-flex align-items-center">
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
                  <div class="col-lg-6 col-md-12">
                    <form class="" id="EditProfile" onsubmit="return editedprofile()" method="POST">
                      @csrf

                      <div class="form-group">
                        <label class="font-sm color-text-mutted mb-10">First Name *</label>
                        <input class="form-control" type="text" name="fullname" id="firstNameI" placeholder="Steven Job" value="{{  Auth::guard('nurse_middle')->user()->name }}">
                      </div>
                      <div class="form-group">
                        <label class="font-sm color-text-mutted mb-10">Last Name *</label>
                        <input class="form-control" type="text" name="lastname" id="lastNameI" placeholder="Enter Your Last name" value="{{  Auth::guard('nurse_middle')->user()->lastname }}">
                      </div>
                      <div class="form-group">
                        <label class="font-sm color-text-mutted mb-10">Email *</label>
                        <input class="form-control" type="text" name="email" id="emailI" readonly value="{{  Auth::guard('nurse_middle')->user()->email }}">
                      </div>
                      <div class="form-group">
                        <label class="form-label" for="input-3">Mobile Number *</label>

                        <div class="row">
                          <div class="col-md-3">
                            <select name="countryCode" id="countryCode" class="form-control" placeholder="C. Code" aria-label="Default select example">
                              @php $country_phone_code = country_phone_code();@endphp
                              @forelse($country_phone_code as $cpc)
                              @if($cpc->phonecode!='0')
                              <!-- <option data-countryCode="GB" {{ Auth::guard('nurse_middle')->user()->country_code == $cpc->phonecode ? 'selected' : '' }} value="{{ $cpc->phonecode }}">(+{{ $cpc->phonecode }})</option> -->
                              <option data-countryCode="GB" {{ Auth::guard('nurse_middle')->user()->country_code == $cpc->phonecode ? 'selected' : '' }} value="{{ $cpc->phonecode }}">{{ $cpc->phonecode }}</option>
                              @endif
                              @empty
                              @endforelse
                            </select>
                          </div>
                          <div class="col-md-9">
                            <input class="form-control numbers" type="text" required="" name="contact" id="contactI" value="{{  Auth::guard('nurse_middle')->user()->phone }}" placeholder="1234567890">
                            <span id="reqTxtcontactI" class="reqError text-danger valley"></span>
                          </div>
                        </div>



                      </div>
                      <div class="form-group">
                        <label class="font-sm color-text-mutted mb-10">Bio</label>
                        <textarea class="form-control" rows="4" name="bio">{{ Auth::guard('nurse_middle')->user()->bio }}</textarea>
                      </div>
                      <div class="form-group">
                        <label class="font-sm color-text-mutted mb-10">Personal website</label>
                        <input class="form-control" type="url" name="website" value="{{  Auth::guard('nurse_middle')->user()->personal_website }}">
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
                            <select class="form-control form-select ps-5" name="state" id="stateI" id="stateI">
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
                            <label class="font-sm color-text-mutted mb-10">Zip code</label>
                            <input class="form-control" type="text" name="post_code" value="{{  Auth::guard('nurse_middle')->user()->post_code }}">
                          </div>
                        </div>
                        <div class="box-button mt-15">
                          <button class="btn btn-apply-big font-md font-bold"@if(!email_verified())  disabled  @endif type="submit" id="submitfrm">Save Changes</button>
                        </div>
                      </div>
                    </form>
                  </div>

                  <div class="col-lg-6 col-md-12">
                    <!-- <div class="border-bottom pt-10 pb-10 mb-30"></div> -->
                    <h6 class="color-orange mb-20">Change your password</h6>
                    <form class="" id="ChangePassword" onsubmit="return ChangePassword()" method="POST">
                      @csrf
                      <div class="row">

                        <div class="form-group mb-3">

                          <label for="exampleInputEmail1" class="form-label">Old Password</label>

                          <input type="password" name="old_password" id="old_password" class="form-control readonly-field" placeholder="">

                        </div>


                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="font-sm color-text-mutted mb-10">Password</label>
                            <input class="form-control" type="password" name="password" id="password" class="form-control readonly-field" placeholder="">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="font-sm color-text-mutted mb-10">Re-Password *</label>
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

              <div class="tab-pane fade" id="tab-my-jobs" role="tabpanel" aria-labelledby="tab-my-jobs">


                <div class="card shadow-sm border-0 p-4 mt-30">
                  <h3 class="mt-0 color-brand-1 mb-2">Profession</h3>
                  <a class="font-md color-text-paragraph-2" href="#">Add your profession/s here, and any relevant registrations and qualifications</a>
                  <form id="multi-step-form" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label class="form-label" for="input-1">Profession</label>
                      <select class="form-control" name="profession" id="specialtyId">

                        <option value="">Select</option>
                        @php
                        $profession_data =profession_data();
                        $specialty = specialty();
                        $spcl=$specialty[0]->id;
                        $valspecial=Auth::guard('nurse_middle')->user()->profession;

                        @endphp

                        <?php

                        if ($profession_data != 'null') {
                          $valspecial = $profession_data->profession;
                        }
                        ?>
                        @foreach($specialty as $spl)
                        <option value="{{ $spl->id }}" {{ $valspecial == $spl->id ? 'selected' : '' }}>{{ $spl->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <span id="reqTxtspecialtyId" class="reqError text-danger valley"></span>

                    @php $sub_specialty = sub_specialty($spcl); $count=count($sub_specialty);@endphp


                    @if($count > 0)
                    @php
                    $profession_data =profession_data();
                    $valspecialpractitioner_type=Auth::guard('nurse_middle')->user()->practitionertype;
                    @endphp

                    <?php

                    if ($profession_data != 'null') {
                      $valspecialpractitioner_type = $profession_data->practitioner_type;
                    }
                    ?>


                    <div class="form-group" id="subspecialtyGroup">
                      <label class="form-label" for="input-1">Practitioner Type</label>
                      <select class="form-control" name="practitioner_type" id="subspecialtyId">
                        @foreach($sub_specialty as $sspl)
                        <option value="{{ $sspl->id }}" {{ $valspecialpractitioner_type == $sspl->id ? 'selected' : '' }}>{{ $sspl->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <span id="reqsubspecialtyId" class="reqError text-danger valley"></span>
                    @endif





                    <div class="form-group">
                      <label class="form-label" for="input-1">Year Level</label>
                      <!-- <input class="form-control" type="text" required="" name="fullname" placeholder="Steven Job"> -->
                      <select class="form-control " name="assistent_level" id="assistent_level">
                        @php $year_level = year_level();@endphp
                        @php
                        $profession_data =profession_data();
                        $valyear_level=Auth::guard('nurse_middle')->user()->assistent_level;
                        @endphp
                        <?php

                        if ($profession_data != 'null') {
                          $valyear_level = $profession_data->year_level;
                        }
                        ?>
                        <option value="">Select</option>
                        @foreach($year_level as $yl)
                        <option value="{{ $yl->name }}" {{ $valyear_level == $yl->name ? 'selected' : '' }}>{{ $yl->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <span id="reqassistent_level" class="reqError text-danger valley"></span>



                    <div class="form-group">
                      <label class="form-label" for="input-1">Evidence Type</label>
                      <!-- <input class="form-control" type="text" required="" name="fullname" placeholder="Steven Job"> -->
                      <select class="form-control" name="evidence_type" id="evidence_type">
                        @php $evidence_list = evidence_list();@endphp
                        <?php
                        $valsevidence_type = '';
                        if ($profession_data != 'null') {
                          $valsevidence_type = $profession_data->evidence_type;
                        }
                        ?>
                        <option value="">Select</option>
                        @foreach($evidence_list as $el)
                        <option value="{{ $el->id }}" {{ $valsevidence_type == $el->id ? 'selected' : '' }}>{{ $el->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <span id="reqevidence_type" class="reqError text-danger valley"></span>


                    <div class="form-group">
                      <label class="form-label" for="input-1">Evidence of year level</label> <?php
                                                                                              if ($profession_data != 'null') {
                                                                                                $valspecialimage = $profession_data->evidence_of_year_level;
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
                      <input type="file" name="image_evidence" id="image_evidenceI" class="form-control h-100" accept="image/*">
                      <?php
                      if ($profession_data != 'null') {
                        $valspecialimage = $profession_data->evidence_of_year_level;
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


                    <span id="reqaimage_evidence" class="reqError text-danger valley"></span>

                    <?php
                    if ($profession_data != 'null') {
                      $status = $profession_data->status;
                      if ($status == '2') {

                        echo  '<br> Status:  <span class="btn-danger badge badge-danger">Rejected</span>';
                    ?>
                        <input type="hidden" name="action" value="1">
                        <div class="alert alert-danger mt-2" role="alert">Reason : Your Detail has been rejectd due
                          <b> {{ $profession_data->reason }} </b> . Please Resubmit the details.
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                          <button onclick="doprofession()" class="btn btn-default px-5 py-8  rounded-2 mb-0 submit-btn-120" type="submit"><span class="resetpassword">Re-Submit</span>
                            <div class="spinner-border submit-btn-1" role="status" style="display:none;">
                              <span class="sr-only">Loading...</span>
                            </div>
                          </button>
                        </div>
                      <?php    } elseif ($status == '0') {
                        echo  ' Status: <span class="btn-warning badge badge-warning">Pending</span>';
                        echo ' <div class="alert alert-warning mt-2 " role="alert">
                                     Your request has been successfully submitted.Its in pending state, We will back to you as soon as possible.
                            </div>';
                      } elseif ($status == '1') {
                        echo  'Status: <span class="btn-success badge badge-success">Approved</span>';
                      } else {
                      ?>


                        <div class="d-flex align-items-center justify-content-between">
                          <button onclick="doprofession()" @if(!email_verified())  disabled  @endif class="btn btn-default px-5 py-8  rounded-2 mb-0 submit-btn-120" type="submit"><span class="resetpassword">Submit</span>
                            <div class="spinner-border submit-btn-1" role="status" style="display:none;">
                              <span class="sr-only">Loading...</span>
                            </div>
                          </button>
                        </div><?php
                            }
                          } else {
                              ?>
                      <input type="hidden" name="action" value="0">
                      <div class="d-flex align-items-center justify-content-between">
                        <button onclick="doprofession()" @if(!email_verified())  disabled  @endif class="btn btn-default px-5 py-8  rounded-2 mb-0 submit-btn-120" type="submit"><span class="resetpassword">Submit</span>
                          <div class="spinner-border submit-btn-1" role="status" style="display:none;">
                            <span class="sr-only">Loading...</span>
                          </div>
                        </button>
                      </div>
                    <?php

                          }
                    ?>
                  </form>
                </div>
                <!--==========-->
                <!--REGISTRATION-->
                <!--==========-->
                <div class="card shadow-sm border-0 p-4 mt-30">
                  <h3 class="mt-0 color-brand-1 mb-2">REGISTRATION</h3>
                  <a class="font-md color-text-paragraph-2" href="#">If your practitioner type requires a registration, provide it here</a>
                  <form id="multi-step-form-registration" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                      <div class="col-md-3">
                        <select name="ahpra_code" id="ahpra_codeI" class="form-control" placeholder="C. Code" aria-label="Default select example">
                          <option data-countryCode="NMW" {{ Auth::guard('nurse_middle')->user()->ahpra_code =='NMW' ? 'selected' : '' }} value="NMW">NMW</option>
                          <option data-countryCode="MED" {{ Auth::guard('nurse_middle')->user()->ahpra_code =='MED' ? 'selected' : '' }} value="MED">MED</option>
                        </select>
                      </div>
                      <div class="col-md-6">
                        <input class="form-control numbers" type="text" required="" name="ahpra_number" id="ahpra_numberI" value="{{  Auth::guard('nurse_middle')->user()->ahpra_number }}" placeholder="00000000000">
                        <span id="reqTxtahpra_numberI" class="reqError text-danger valley"></span>
                      </div>

                      <div class="col-md-3">
                        <div class="d-flex align-items-center justify-content-between">
                          <button onclick="doprofessionregistration()" @if(!email_verified())  disabled  @endif class="btn btn-default px-5 py-8  rounded-2 mb-0 submit-btn-120" type="submit"><span class="resetpassword">Submit</span>
                            <div class="spinner-border submit-btn-1" role="status" style="display:none;">
                              <span class="sr-only">Loading...</span>
                            </div>
                          </button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>


              </div>
              <div class="tab-pane fade" id="tab-myclearance-jobs" role="tabpanel" aria-labelledby="tab-myclearance-jobs">


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

                      <?php
                      if ($profession_data != 'null') {
                        $status = $profession_data->status;

                      ?>
                        <input type="hidden" name="action" value="0">
                        <div class="d-flex align-items-center justify-content-between">
                          <button onclick="doeligibility_to_work()" class="btn btn-default px-5 py-8  rounded-2 mb-0 submit-btn-120" type="submit"><span class="resetpassword">Submit</span>
                            <div class="spinner-border submit-btn-1" role="status" style="display:none;">
                              <span class="sr-only">Loading...</span>
                            </div>
                          </button>
                        </div>
                      <?php

                      }
                      ?>
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
                    <div class="form-group">
                      <label class="font-sm color-text-mutted mb-10">Bio</label>
                      <textarea class="form-control" rows="4">We are AliThemes , a creative and dedicated group of individuals who love web development almost as much as we love our customers. We are passionate team with the mission for achieving the perfection in web design.</textarea>
                    </div>
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
                  <label class="form-check-label  mt-3" for="availableNow">
                 <h6> Profile Status: </h6>
                      </label>
                  <div class="form-check  mt-1  mb-2">
                      <input class="form-check-input" type="checkbox" value="1" id="availableNow" name="profile_status"   {{ Auth::guard('nurse_middle')->user()->profile_status=='Yes' ? 'checked' : '' }} >
                      <label class="form-check-label" for="availableNow">
                          Available Now
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
            
      
          </div>
        </div>
      </div>
    </div>
  </section>

</main>


@endsection
@section('js')
<script type="text/javascript">
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