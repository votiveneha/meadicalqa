@extends('admin.layouts.layout')
@section('content')
<style>

  span.select2.select2-container {
    padding: 5px !important;
    width: 100% !important;
  }
  .d-none {
    display: none !important;
    /* visibility: hidden !important;; */
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
                        <a class="nav-link active" data-bs-toggle="tab" href="#navpill-1" role="tab"
                            aria-selected="true">
                            <span>Basic Details</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link disabled" data-bs-toggle="tab" href="#navpill-2" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span>Profession</span>
                        </a>
                    </li>
                    <li class="nav-item disabled" role="presentation">
                        <a class="nav-link disabled" data-bs-toggle="tab" href="#navpill-3" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span>Education and Certifications</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link disabled" data-bs-toggle="tab" href="#navpill-4" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span>Experience</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link disabled" data-bs-toggle="tab" href="#navpill-5" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span>Financial Details</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link disabled" data-bs-toggle="tab" href="#navpill-6" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span>Mandatory Training</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link disabled" data-bs-toggle="tab" href="#navpill-7" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span>Vaccinations</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link disabled" data-bs-toggle="tab" href="#navpill-8" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span>Work Clearances</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link disabled" data-bs-toggle="tab" href="#navpill-9" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span>Professional Memberships</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link disabled" data-bs-toggle="tab" href="#navpill-10" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span>Interview and References</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link disabled" data-bs-toggle="tab" href="#navpill-11" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span>Personal Preferences</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link disabled" data-bs-toggle="tab" href="#navpill-12" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span>Find Work Preferences</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link disabled" data-bs-toggle="tab" href="#navpill-13" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span>Testimonials and Reviews</span>
                        </a>
                    </li>
                    
                </ul>
                <form method="post" enctype="multipart/form-data" id="AddNurse">
                <!-- Tab panes -->
                <div class="tab-content border mt-2">
                    <div class="tab-pane p-3 active show" id="navpill-1" role="tabpanel">
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
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Nationality</strong></label>
                                                    <select name="nationality" class="form-control form-select ps-5" id="nationality">
                                                        <option value="">Select Nationality</option>
                                                        @php $country_data=country_name_from_db();@endphp
                                                        @foreach ($country_data as $data)
                                                        <option value="{{ $data->id }}" <?= isset(Auth::guard('nurse_middle')->user()->nationality) &&  Auth::guard('nurse_middle')->user()->nationality == $data->id ? 'selected' : '' ?>>{{ $data->nationality }}</option>
                                                        @endforeach
                                                    </select>
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
                                            <button type="button" class="btn btn-default next-step-1 align-items-center justify-content-between" data-target="#navpill-2">Next</button>
                                        </div>
                                    </div>

                                    {{-- <div class="mt-3">
                                        <!-- PROGRESSBAR START -->
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 12%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100">12%</div>
                                        </div>
                                        <!-- PROGRESSBAR END -->
                                    </div> --}}
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane p-3" id="navpill-2" role="tabpanel">
                        <div class="row">
                            <div class=" w-100  overflow-hidden">
                                <div class="card-body p-3 px-md-4 pb-0">
                                    <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Profession 
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
                                                            <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="type-of-nurse" name="states[]" multiple="multiple" id="type_nurse"></select>
                                                            <span id="type_nurse_error" class="text-danger"></span>
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
                                                    <div class="">
                                                    <input type="hidden" name="nursing_result" class="nursing_result-{{ $i }}" value="{{ $spl->id }}">
                                                    <div class="form-group d-none col-md-12 mt-3" id="nursing_level-{{ $i }}">
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
                                                    <div class="">
                                                        <div class="form-group col-md-12 mt-3 np_submenu d-none">
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
                                                            <span id="specialties_error" class="text-danger"></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 mt-3  result--show speciality_boxes">
                                                        <?php
                                                            $l = 1;
                                                        ?>
                                                        @foreach($JobSpecialties as $ptl)
                                                        <?php
                                                            $speciality_data = DB::table("speciality")->where('parent', $ptl->id)->get();
                                                        ?>
                                                        <input type="hidden" name="speciality_result" class="speciality_result-{{ $l }}" value="{{ $ptl->id }}">
                                                        <div class="speciality_data form-group d-none drpdown-set drp--clr"  id="specility_level-{{ $l }}">
                                                    
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
                                            
                                                        <div class="surgical_row_data form-group d-none drp--clr col-md-12 mt-3">
                                                    
                                                           <label class="form-label" for="input-2">Surgical Preoperative and Postoperative Care:</label>
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
                                                    
                                                    <div class="specialty_sub_boxes">

                                                        <?php
                                                            $speciality_surgical_data = DB::table("speciality")->where('parent', '96')->get();
                                                            $w = 1;
                                                        ?>
                                                         @foreach($speciality_surgical_data as $ssd)
                                                        <input type="hidden" name="speciality_result" class="speciality_surgical_result-{{ $w }}" value="{{ $ssd->id }}">
                                                        <div class="col-md-12 mt-3 surgical_row surgical_row-{{ $w }} form-group d-none drp--clr">                            
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
                                                    </div> 
                                                    
                                                    <div class="paediatric_surgical_div">
                                                        <div class="col-md-12 mt-3 surgicalpad_row_data form-group drp--clr d-none">
                                                            <input type="hidden" name="sub_speciality_value" class="sub_speciality_value" value="">
                                                            <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Paediatric Surgical Preop. and Postop. Care :</strong></label>
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

                                                    <?php
                                                        $speciality_surgical_datamater = DB::table("speciality")->where('parent', '250')->get();                                                        
                                                    ?>
                                                    <div class="">
                                                        <div class="col-md-12 mt-3 d-none neonatal_row drp--clr drpdown-set form-group">
                                                            <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Neonatal Care :</strong></label>
                                                            <ul id="neonatal_care" style="display:none;">
                                                               @foreach($speciality_surgical_datamater as $ssd)
                                                                <li data-value="{{ $ssd->id }}">{{ $ssd->name }}</li>
                                                                @endforeach
                                                            </ul>
                                                            <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="neonatal_care" name="neonatal_care[]" multiple="multiple"></select>
                                                        </div>
                                                    </div>

                                                    <?php
                                                        $speciality_surgical_datamater = DB::table("speciality")->where('parent', '233')->get();
                                                        $p = 1;
                                                    ?>
                                                    <div class="">
                                                        <div class="col-md-12 mt-3 d-none surgicalobs_row drp--clr drpdown-set form-group">
                                                            <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Surgical Obstetrics and Gynecology (OB/GYN) :</strong></label>
                                                            <ul id="surgical_obs_care" style="display:none;">
                                                            @foreach($speciality_surgical_datamater as $ssd)
                                                                <li data-value="{{ $ssd->id }}">{{ $ssd->name }}</li>
                                                                @endforeach
                                                            </ul>
                                                            <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="surgical_obs_care" name="surgical_obs_care[]" multiple="multiple"></select>
                                                        </div>
                                                    </div>

                                                    <?php
                                                        $speciality_surgical_datap = DB::table("speciality")->where('parent', '285')->get();
                                                        $q = 1;
                                                    ?>
                                                    @foreach($speciality_surgical_datap as $ssd)
                                                    <input type="hidden" name="speciality_result" class="surgical_rowp_result-{{ $q }}" value="{{ $ssd->id }}">
                                                    <div class="">
                                                        <div class="col-md-12 mt-3 surgical_rowp surgical_rowp-{{ $q }} drp--clr drpdown-set form-group drp--clr drpdown-set d-none">
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
                                                    </div>
                                                    <?php
                                                      $q++;
                                                    ?>
                                                    @endforeach

                                                    <div class="col-md-12 mt-2">
                                                        <div class="form-group">
                                                            <label for="skill" class="d-flex gap-3 flex-wrap"><strong>What is your level of experience?</strong></label>
                                                            <select class="form-control mr-10 select-active" name="assistent_level" id="assistent_level">                      
                                                            @for($i = 1; $i <= 30; $i++) <option value="{{ $i }}"  >{{ $i }}{{ $i == 1 ? 'st' : ($i == 2 ? 'nd' : ($i == 3 ? 'rd' : 'th')) }} Year</option>
                                                                @endfor
                                                            </select>
                                                            <span id="experience_error" class="text-danger"></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 mt-2">
                                                        <div class="form-group">
                                                            <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Current Employment Status</strong></label>
                                                            <select class="form-control mr-10 select-active" name="employee_status" id="employee_status">
                                                            <option value="">Select Employee Status</option>
                                                            <option value="Permanent Full-Time" >Permanent Full-Time</option>
                                                            <option value="Permanent Part-Time">Permanent Part-Time</option>
                                                            <option value="Temporary / Contract">Temporary / Contract</option>
                                                            <option value="Travel">Travel</option>
                                                            <option value="Per Diem / Local">Per Diem / Local</option>
                                                            <option value="On-Call / PRN (Pro Re Nata)">On-Call / PRN (Pro Re Nata)</option>
                                                            <option value="Casual">Casual</option> 
                                                            <option value="Agency / Staffing Agency">Agency / Staffing Agency</option>
                                                            <option value="Seasonal">Seasonal</option>
                                                            <option value="Intern / Residency">Intern / Residency</option>
                                                            <option value="Self-Employed / Private Practice" >Self-Employed / Private Practice</option>
                                                            <option value="Volunteer" >Volunteer</option>
                                                            <option value="Unemployed" >Unemployed</option>
                                                            </select>
                                                            <span id="status_error" class="text-danger"></span>
                                                        </div>

                                                        <div class="col-md-12 mt-2">
                                                            <div class="form-group">
                                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Professional Bio</strong></label>
                                                                <textarea class="form-control" rows="4" name="bio" id="bio"></textarea>
                                                                <span id="bio_error" class="text-danger"></span>
                                                            </div>
                                                        </div>

                                                        <div class="declaration_box  mt-3">
                                                            <input type="checkbox" name="declare_information" class="declare_information" id="declare_information">
                                                            <label for="declare_information">I declare that the information provided is true and correct</label>
                                                            <span id="diclare_error" class="text-danger"></span>
                                                        </div>
                                                        <div class="d-flex align-items-center justify-content-between mt-3">
                                                            <button type="button" class="btn btn-default next-step-2 align-items-center justify-content-between" data-target="#navpill-3">Next</button>
                                                        </div>  
                                                    </div>
                                            </div>
                                    </div>
                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane p-3" id="navpill-3" role="tabpanel">
                        <div class="row">
                            <div class=" w-100  overflow-hidden">
                                <div class="card-body p-3 px-md-4 pb-0">
                                    <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center "> Education and Certification 
                                    </h3>
                                </div>
                                <div class="card-body p-3 px-md-4">
                                    <div class="col-md-12">
                                        @if($policeCheckVerificationData)
                                            <div class="row">
                                                {{-- @if(isset($policeCheckVerificationData->date) && $policeCheckVerificationData->date)
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
                                                @endif --}}
                        
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
                    <div class="tab-pane p-3" id="navpill-4" role="tabpanel">
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
                                                            {{-- <span>{{country_name($eligibilityToWorkData->passport_country_of_Issue)}}</span> --}}
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
                    <div class="tab-pane p-3" id="navpill-5" role="tabpanel">
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
    
    
@include('admin.script');
    
@endsection
