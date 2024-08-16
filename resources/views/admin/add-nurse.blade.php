@extends('admin.layouts.layout')
@section('content')
<style>

  span.select2.select2-container {
    padding: 5px !important;
    width: 100% !important;
  }
  .d-none {
    display: none !important;
  }


  .select2-container--default .select2-selection--multiple {
    /* background-color: white !important; */
    /* border: 1px solid #0000 !important; */
    border-radius: 4px !important;
    cursor: text !important;
  }

  .select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #000 !important;
    border: 1px solid #000 !important;
    /* border-radius: 4px !important; */
    /* cursor: default !important;
    color: #fff !important; */
  /* float: left; */
    /* padding: 0;
    padding-right: 0.75rem;
    margin-top: calc(0.375rem - 2px);
    margin-right: 0.375rem;
  padding-bottom: 0px;
  white-space: normal;
    line-height: 20px; */
  }

  /* .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: #fff !important;
    font-size: 20px !important;
  float: left;
    padding-right: 3px;
    padding-left: 3px;
    margin-right: 1px;
    margin-left: 3px;
    font-weight: 700;
  line-height: 20px; */
  /* }     */

</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />

    <div class="container-fluid">
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Add Nurse</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-muted " href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item" aria-current="page">Add Nurse</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-3">
                        <div class="text-center mb-n5">
                            <img src="{{ asset('admin/dist/images/breadcrumb/ChatBc.png') }}" alt=""
                                class="img-fluid" style="height: 125px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-pills nav-fill mt-4 tabs-feat" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-bs-toggle="tab" href="#navpill-111" role="tab"
                            aria-selected="true">
                            <span>Basic Details</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#navpill-222" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span>Professional Information</span>
                        </a>
                    </li>
                    <li class="nav-item disabled" role="presentation">
                        <a class="nav-link disabled" data-bs-toggle="tab" href="#navpill-333" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span>Education and Certifications</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link disabled" data-bs-toggle="tab" href="#navpill-444" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span>Experience</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link disabled" data-bs-toggle="tab" href="#navpill-555" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span>Financial Details</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link disabled" data-bs-toggle="tab" href="#navpill-555" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span>Mandatory Training</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link disabled" data-bs-toggle="tab" href="#navpill-555" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span>Vaccinations</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link disabled" data-bs-toggle="tab" href="#navpill-555" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span>Work Clearances</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link disabled" data-bs-toggle="tab" href="#navpill-555" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span>Professional Memberships</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link disabled" data-bs-toggle="tab" href="#navpill-555" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span>Interview and References</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link disabled" data-bs-toggle="tab" href="#navpill-555" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span>Personal Preferences</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link disabled" data-bs-toggle="tab" href="#navpill-555" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span>Find Work Preferences</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link disabled" data-bs-toggle="tab" href="#navpill-555" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span>Testimonials and Reviews</span>
                        </a>
                    </li>
                    
                </ul>
                <form method="post" enctype="multipart/form-data" id="AddNurse">
                <!-- Tab panes -->
                <div class="tab-content border mt-2">
                    <div class="tab-pane p-3 active show" id="navpill-111" role="tabpanel">
                        <div class="row">
                            <div class=" w-100  overflow-hidden">
                                <div class="card-body p-3 px-md-4 pb-0">
                                    <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Basic Details </h3>
                                </div>
                                <div class="card-body p-3 px-md-4">
                                    <div class="col-md-12">
                                        <div class="row">
											<div class="upload-pic">
												<div class="mt-35 mb-40 box-info-profie d-flex align-items-center upload_image">
					  
												  <div class="image-profile">
													<img alt=""  id="profileImage" style="object-fit:cover;border-radius: 16px;display: block;width: 85px;height: 85px;" src="{{asset('assets/admin/dist/images/profile/nurse06.png')}}"> 
													<div class="position-relative overflow-hidden">
														<a class="btn btn-apply" id="uploadButton">Upload Avatar</a>
													  
														<input type="file" name="profile_image" id="profile_image" class="position-absolute h-100" accept="image/*" style="top: 0;left: 0;opacity: 0;cursor: pointer;">

														<i class="fa fa-spinner fa-spin" id="preloadeer-active" style="display:none" aria-hidden="true"></i>
														
													</div>
													</div>
												</div>
											<span id="profile_image_error" class="text-danger"></span>
											</div>
                                            <div class="col-md-6 mt-3">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>First Name</strong></label>
                                                    <input type="text" class="form-control" placeholder="First Name" name="first_name" id="first_name">
                                                    <span id="first_name_error" class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Last Name</strong></label>
                                                    <input type="text" class="form-control" placeholder="Last Name" name="last_name" id="last_name">
                                                    <span id="last_name_error" class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Email Address</strong></label>
                                                    <input type="text" class="form-control" placeholder="Email Address" name="email" id="email">
                                                    <span id="email_error" class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-3 phone--drpdwns">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Phone Number</strong></label>
                                                    <input type="hidden" value="" name="country_code" id="country_code_phone">
                                                    <input type="hidden" value="" name="country_name" id="country_name_phone">
                                                    <input type="hidden" value="" name="country_iso" id="country_iso_phone">
                                                    <input class="form-control numbers" type="tel" required="" name="contact" id="contact" placeholder="1234567890" placeholder="1234567890" maxlength="10" pattern="[0-9]{4}" style="width: ">
                                                    <span id="contact_error" class="text-danger"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mt-3">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Date of Birth</strong></label>
                                                    <input type="date" class="form-control" placeholder="Date of Birth" name="dob" id="dob">
                                                    <span id="date_error" class="text-danger"></span>
                                                </div>
                                            </div>
                    
                                            {{-- <div class="col-md-6 mt-3">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Nationality</strong></label>
                                                    <input type="text" class="form-control" placeholder="Nationality" name="skill" id="skill">
                                                    <span id="skillErr" class="text-danger"></span>
                                                </div>
                                            </div> --}}
                    
                    
                                            <div class="col-md-6 mt-3">
                                                <div class="form-group">
                                                    <label for="gender" class="d-flex gap-3 flex-wrap"><strong>Gender</strong></label>
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="gender" id="genderMale" value="male">
                                                            <label class="form-check-label" for="genderMale">
                                                                Male
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="female">
                                                            <label class="form-check-label" for="genderFemale">
                                                                Female
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <span id="genderErr" class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Personal website</strong></label>
                                                    <input class="form-control" type="url" required="" name="per_website" id="per_website" placeholder="Personal website">
                                                    <span id="per_website_error" class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Country</strong></label>
                                                    <select class="form-control form-select ps-5" name="country" id="countryI">
                                                        <option value="">Select Country</option>
                                                        @php $country_data=country_name_from_db();@endphp
                                                        @foreach ($country_data as $data)
                                                        <option value="{{$data->iso2}}" <?= isset(Auth::guard('nurse_middle')->user()->country) &&  Auth::guard('nurse_middle')->user()->country == $data->iso2 ? 'selected' : '' ?>> {{$data->name}} </option>
                                                        @endforeach


                                                    </select>
                                                    <span id="country_error" class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>State</strong></label>
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
                                                    <span id="state_error" class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>City</strong></label>
                                                    <input class="form-control" type="text" required="" name="city" id="city" placeholder="City">
                                                    <span id="city_error" class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Zip code</strong></label>
                                                    <input class="form-control" type="text" required="" name="zip_code" id="zip_code" placeholder="Zip code">
                                                    <span id="zip_code_error" class="text-danger"></span>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6 mt-3">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Home Address</strong></label>
                                                    <input class="form-control" type="text" required="" name="home_address" id="home_address" placeholder="Home Address">
                                                    <span id="home_address_error" class="text-danger"></span>
                                                </div>
                                            </div>
                                            <h4 class="mt-3">Emergency Contact Information</h4>
                                            <div class="col-md-6 mt-3 phone--drpdwns">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Mobile No</strong></label>
                                                    <input type="hidden" value="" name="emr_county_code" id="country_code_mobile">
                                                    <input type="hidden" value="" name="emr_country_name" id="country_name_mobile">
                                                    <input type="hidden" value="" name="emr_country_iso" id="country_iso_mobile">
                                                    <input class="form-control numbers" type="tel" required="" name="emrg_contact" id="emrg_contact" placeholder="1234567890" placeholder="1234567890" maxlength="10" pattern="[0-9]{4}" style="width: ">
                                                    <span id="emrg_contact_error" class="text-danger"></span>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6 mt-3">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Email</strong></label>
                                                   <input type="text" class="form-control" id="emrg_email" name="emrg_email" placeholder="Email" accept="image/*">
                                                    <span id="emrg_email_error" class="text-danger"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-3">
                                            <button type="button" class="btn btn-default next-step align-items-center justify-content-between" data-target="#navpill-222">Next</button>
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <!-- PROGRESSBAR START -->
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 12%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100">12%</div>
                                        </div>
                                        <!-- PROGRESSBAR END -->
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane p-3" id="navpill-222" role="tabpanel">
                        <div class="row">
                            <div class=" w-100  overflow-hidden">
                                <div class="card-body p-3 px-md-4 pb-0">
                                    <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Professional Information 
                                    </h3>
                                </div>
                                <div class="card-body p-3 px-md-4">
                                    <div class="col-md-12">                             
                                            <div class="row">
                                                    <div class="col-md-12 mt-3">
                                                        <div class="form-group">
                                                            <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Type of Nurse</strong></label>
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
                                                            <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="type-of-nurse" name="states[]" multiple="multiple"></select>
                                                            <span id="photo_id" class="text-danger"></span>
                                                        </div>
                                                    </div>
                                                
                                                    @php $specialty = specialty();$spcl=$specialty[0]->id;@endphp
                                                        <?php
                                                            $i = 1;
                                                        ?>
                                                        @foreach($specialty as $spl)
                                                        <?php
                                                            $nursing_data = DB::table("practitioner_type")->where('parent', $spl->id)->get();
                                                        ?>
                                                    <div class="col-md-12 mt-3">
                                                    <input type="hidden" name="nursing_result" class="nursing_result-{{ $i }}" value="{{ $spl->id }}">
                                                    <div class="form-group d-none" id="nursing_level-{{ $i }}">
                                                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>{{ $spl->name }}</strong></label>
                                                            <ul id="nursing_entry-{{ $i }}" style="display:none;">
                                                                @foreach($nursing_data as $nd)
                                                                <li data-value="{{ $nd->id }}">{{ $nd->name }}</li>
                                                                
                                                                @endforeach
                                                                <!-- Add more list items as needed -->
                                                            </ul>
                                                            <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="nursing_entry-{{ $i }}" name="states[]" multiple="multiple"></select>
                                                        <span id="photo_id" class="text-danger"></span>
                                                    </div>
                                                     <?php
                                                        $i++;
                                                    ?>
                                                    </div>
                                                    @endforeach
                                                    <div class="col-md-12 mt-3 np_submenu d-none">
                                                        <div class="form-group">
                                                            <?php
                                                                $np_data = DB::table("practitioner_type")->where('parent', '179')->get();
                                                            ?>
                                                            <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Nurse Practitioner (NP):</strong></label>
                                                            <ul id="nurse_practitioner_menu" style="display:none;">
                                                                @foreach($np_data as $nd)
                                                                <li data-value="{{ $nd->id }}">{{ $nd->name }}</li>
                                                                @endforeach
                                                                
                                                            </ul>
                                                            <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="nurse_practitioner_menu" name="nurse_practitioner_menu[]" multiple="multiple"></select>
                                                            <span id="photo_id" class="text-danger"></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 mt-3">
                                                        <div class="form-group">
                                                            <input type="hidden" name="sub_speciality_value" class="sub_speciality_value" value="">
                                                            <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Specialties :</strong></label>
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
                                                            <span id="reqspecialties" class="reqError valley"></span>
                                                        </div>
                                                    </div>

                                                    {{-- <div class="col-md-12 mt-3">
                                                        <?php
                                                            $l = 1;
                                                        ?>
                                                        @foreach($JobSpecialties as $ptl)
                                                        <?php
                                                            $speciality_data = DB::table("speciality")->where('parent', $ptl->id)->get();
                                                        ?>
                                                        <div class="form-group">
                                                            <?php
                                                                $np_data = DB::table("practitioner_type")->where('parent', '179')->get();
                                                            ?>
                                                            <input type="hidden" name="sub_speciality_value" class="sub_speciality_value" value="">
                                                            <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Specialties :</strong></label>
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
                                                            <span id="reqspecialties" class="reqError valley"></span>
                                                        </div>
                                                        <?php
                                                            $l++;
                                                        ?>
                                                        @endforeach
                                                    </div> --}}
                                                
                                                
                                                     
                                            </div>
                                        
                                            
                                            
                                       
                                        
                    
                                    </div>
                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane p-3" id="navpill-333" role="tabpanel">
                        <div class="row">
                            <div class=" w-100  overflow-hidden">
                                <div class="card-body p-3 px-md-4 pb-0">
                                    <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center "> Police Check Verification 
                                    </h3>
                                </div>
                                <div class="card-body p-3 px-md-4">
                                    <div class="col-md-12">
                                        @if($policeCheckVerificationData)
                                            <div class="row">
                                                @if(isset($policeCheckVerificationData->date) && $policeCheckVerificationData->date)
                                                <div class="col-md-12 mt-3">
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <strong>Date : </strong><span>{{ $policeCheckVerificationData->date}}</span>
                                                    </div>
                                                </div>
                                                @endif
                                                @if(isset($policeCheckVerificationData->image) && $policeCheckVerificationData->image)
                                                <div class="col-md-12 mt-3">
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <strong>Image : </strong>
                                                        <a href="{{ asset($policeCheckVerificationData->image)}}" target="_blank">
                                                            <img src="{{ asset($policeCheckVerificationData->image)}}" alt="" style="height:50px;width:50px">
                                                        </a>                                                    
                                                    </div>
                                                </div>
                                                @endif
                                                @if(isset($policeCheckVerificationData->status) && $policeCheckVerificationData->status)
                                                <div class="col-md-12 mt-3">
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <strong>Status : </strong>
                                                        @if($policeCheckVerificationData->status == 1)
                                                        <span class="badge bg-success">Approved</span>
                                                        @elseif($policeCheckVerificationData->status == 2)
                                                        <span class="badge bg-danger">Rejected</span>
                                                        @else 
                                                        @endif
                                                  
                                                    </div>
                                                </div>
                                                @endif
                                                @if(isset($policeCheckVerificationData->status) && $policeCheckVerificationData->status == 2)
                                                <div class="col-md-6 mt-3">
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <strong>Reason : </strong>
                                                        <span>{{$policeCheckVerificationData->reason}}</span>
                                                    </div>
                                                </div>
                                                @endif
                        
                                            </div>
                                            @else
                                            <div class="col-md-12">
                                                <div class="text-center text-danger fs-5">No data found</div>
                                            </div>
                                            
                                            @endif
                                        
                    
                                    </div>
                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane p-3" id="navpill-444" role="tabpanel">
                        <div class="row">
                            <div class=" w-100  overflow-hidden">
                                <div class="card-body p-3 px-md-4 pb-0">
                                    <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Eligibility For Work</h3>
                                </div>
                                <div class="card-body p-3 px-md-4">
                                    <div class="col-md-12">
                                            @if($eligibilityToWorkData)
                                                <div class="row">
                                                    @if(isset($eligibilityToWorkData->residency) && $eligibilityToWorkData->residency)
                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Residency : </strong><span>{{ $eligibilityToWorkData->residency}}</span>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    @if(isset($eligibilityToWorkData->support_document) && $eligibilityToWorkData->support_document)
                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Support Document:</strong>
                                                            <a href="{{ asset($eligibilityToWorkData->support_document) }}" target="_blank">
                                                                <span class="text-success">View Document</span>
                                                            </a>
                                                        </div>
                                                        
                                                    </div>
                                                    @endif

                                                    @if(isset($eligibilityToWorkData->visa_subclass_number) && $eligibilityToWorkData->visa_subclass_number)
                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Visa Subclass Number : </strong>
                                                            <span>{{$eligibilityToWorkData->visa_subclass_number}}</span>
                                                        </div>
                                                    </div>
                                                    @endif

                                                    @if(isset($eligibilityToWorkData->passport_number) && $eligibilityToWorkData->passport_number)
                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Passport Number : </strong>
                                                            <span>{{$eligibilityToWorkData->passport_number}}</span>
                                                        </div>
                                                    </div>
                                                    @endif


                                                    @if(isset($eligibilityToWorkData->visa_grant_number) && $eligibilityToWorkData->visa_grant_number)
                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Visa grant number: </strong>
                                                            <span>{{$eligibilityToWorkData->visa_grant_number}}</span>
                                                        </div>
                                                    </div>
                                                    @endif

                                                    @if(isset($eligibilityToWorkData->passport_country_of_Issue) && $eligibilityToWorkData->passport_country_of_Issue)
                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Passport Country Of Issue: </strong>
                                                            <span>{{country_name($eligibilityToWorkData->passport_country_of_Issue)}}</span>
                                                        </div>
                                                    </div>
                                                    @endif

                                                    @if(isset($eligibilityToWorkData->expiry_date) && $eligibilityToWorkData->expiry_date)
                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Expiry Date: </strong>
                                                            <span>{{$eligibilityToWorkData->expiry_date}}</span>
                                                        </div>
                                                    </div>
                                                    @endif
                            
                                                </div>
                                                @else
                                                <div class="col-md-12">
                                                    <div class="text-center text-danger fs-5">No data found</div>
                                                </div>
                                                
                                                @endif
                                            
                    
                                    </div>
                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane p-3" id="navpill-555" role="tabpanel">
                        <div class="row">
                            <div class=" w-100  overflow-hidden">
                                <div class="card-body p-3 px-md-4 pb-0">
                                    <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Children Work</h3>
                                </div>
                                <div class="card-body p-3 px-md-4">
                                    <div class="col-md-12">
                                        @if($workingChildrenCheckData)
                                        <div class="row">
                                            @if(isset($workingChildrenCheckData->clearance_number) && $workingChildrenCheckData->clearance_number)
                                            <div class="col-md-6 mt-3">
                                                <div class="d-flex gap-3 flex-wrap">
                                                    <strong>Clearance Number : </strong><span>{{ $workingChildrenCheckData->clearance_number}}</span>
                                                </div>
                                            </div>
                                            @endif
                                            @if(isset($workingChildrenCheckData->state) && $workingChildrenCheckData->state)
                                            <div class="col-md-6 mt-3">
                                                <div class="d-flex gap-3 flex-wrap">
                                                    <strong>State: </strong><span>{{ state_name($workingChildrenCheckData->state)}}</span>
                                                </div>
                                                
                                            </div>
                                            @endif

                                            @if(isset($workingChildrenCheckData->expiry_date) && $workingChildrenCheckData->expiry_date)
                                            <div class="col-md-6 mt-3">
                                                <div class="d-flex gap-3 flex-wrap">
                                                    <strong>Expiry Date: </strong>
                                                    <span>{{$workingChildrenCheckData->expiry_date}}</span>
                                                </div>
                                            </div>
                                            @endif

                                           
                                        </div>
                                    @else
                                    <div class="col-md-12">
                                        <div class="text-center text-danger fs-5">No data found</div>
                                    </div>
                                    
                                    @endif
                    
                                    </div>
                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>

    </div>
@endsection
@section('js')
    <script type="text/javascript"
        src="https://nextjs.webwiders.in/pindrow/public/advertiser/dist/libs/owl.carousel/dist/owl.carousel.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
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

        $('.next-step').on('click', function() { 
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

        $.ajax({
                url: "{{ route('admin.add_nurse_post') }}",
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
    
@endsection
