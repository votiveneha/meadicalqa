@extends('admin.layouts.layout')
@section('content')
<div class="container-fluid">
    <div class="back_arrow" onclick="history.back()" title="Go Back">
        <i class="fa fa-arrow-left"></i>
    </div>
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8"> View Profile </h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted " href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page">View Profile</li>
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
    <div class="card w-100  overflow-hidden">
        <div class="card-body p-3 px-md-4 pb-0">
            <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Personal Detail @if ($profileData->status == 1)
                <span class="badge bg-success ms-2">Unblock</span>
                @else
                <span class="badge bg-danger ms-2">Blocked</span>
                @endif
            </h3>
        </div>
        <div class="card-body p-3 px-md-4">
            <div class="row align-items-center justify-content-between">
                <div class="col ">
                    <div class="d-flex align-items-md-center gap-4 flex-column flex-md-row">
                        <div class="d-flex  mb-2 ">
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center "
                                style="width: 144px; height: 144px;" ;>
                                <div class="border rounded-circle border-3 border-white d-flex align-items-center justify-content-center  overflow-hidden btn-light commingsoon"
                                    data-bs-toggle="modal" data-bs-target="#commingsoonModel"
                                    style="width: 140px; height: 140px;" ;>
                                    <img src="{{ asset($profileData->profile_img) }}" alt=""
                                        class="w-100 h-100">
                                </div>

                            </div>
                        </div>
                        <div class="w-100">
                            <div class="d-flex justify-content-between">
                                <h5 class="fs-5 mb-2 fw-bolder"> {{ ucwords($profileData->name)." ".ucwords($profileData->lastname) }} </h5>
                                <h5 class="fs-5 mb-2 fw-bolder"> </h5>

                            </div>
                            @if ($profileData->phone != '')
                            <p class="d-flex text-dark align-items-center gap-2 mb-1">
                                <i class="ti ti-phone fs-4"></i><strong> +{{ $profileData->country_code }}
                                    {{ $profileData->phone }}
                                </strong>
                            </p>
                            @endif
                            <div class="d-md-flex align-items-center gap-3 mb-2">
                                <p class="mb-0 d-flex text-dark align-items-center gap-2">
                                    <i class="ti ti-mail fs-4"></i>{{ $profileData->email }}
                                </p>

                            </div>
                            <div class="d-md-flex align-items-center gap-3 mb-2">
                                @if ($profileData->post_code != '')
                                <p class="fs-3 mb-0 fw-bolder">Post Code : {{ $profileData->post_code }}</p>
                                @endif
                                <h5 class="fs-5 mb-0 fw-bolder"> </h5>

                            </div>
                            <div class="d-md-flex align-items-center gap-3 mb-2">
                                @if ($profileData->preferred != '')
                                <p class="fs-3 mb-0 fw-bolder">Preferred Name : {{ $profileData->preferred }}</p>
                                @endif
                                <h5 class="fs-5 mb-0 fw-bolder"> </h5>

                            </div>
                            <div class="d-md-flex align-items-center gap-3 mb-">
                                @if ($profileData->store_url != '')
                                <p class="fs-3 mb-0 fw-bolder">Store URL: {{ $profileData->store_url }}</p>
                                @endif
                                <h5 class="fs-5 mb-0 fw-bolder"> </h5>

                            </div>


                        </div>
                    </div>
                </div>



            </div>

        </div>
    </div>
    <div class="card list-drpdwns-set">
        <div class="card-body">
            @include("admin.layouts.edit_nurse_tabs")
            <div class="tab-content border mt-2">
                <div class="tab-pane p-3 active show" id="tab-1" role="tabpanel">
                    <div class="row">
                        <div class=" w-100  overflow-hidden">
                            <div class="card-body p-3 px-md-4 pb-0">
                                <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Basic Details</h3>
                            </div>
                            <div class="card-body p-3 px-md-4">
                                <div class="col-md-12">
                                    <div class="row">
                                        <input type="hidden" value="{{isset($profileData->id)? $profileData->id : ''}}" id="nurse_id">
                                        <div class="upload-pic">
                                            <div class="mt-35 mb-40 box-info-profie d-flex align-items-center upload_image">

                                                <div class="image-profile">
                                                    <img alt="" id="profileImage" style="object-fit: cover; border-radius: 16px; display: block; width: 85px; height: 85px;"
                                                        src="{{ isset($profileData->profile_img) ? asset($profileData->profile_img) : asset('assets/admin/dist/images/profile/nurse06.png') }}">
                                                    <div class="position-relative overflow-hidden">
                                                        <a class="btn btn-apply" id="uploadeditButton">Upload Avatar</a>
                                                        <input type="file" name="profile_image" id="update_profile_image" class="position-absolute h-100" accept="image/*" style="top: 0;left: 0;opacity: 0;cursor: pointer;">
                                                        <i class="fa fa-spinner fa-spin" id="preloadeer-active" style="display:none" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <span id="profile_image_error" class="text-danger valley"></span>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>First Name</strong></label>
                                                <input type="text" class="form-control" placeholder="First Name" name="first_name" id="first_name" value="{{isset($profileData->name)? $profileData->name : ''}}">
                                                <span id="first_name_error" class="text-danger valley"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Last Name</strong></label>
                                                <input type="text" class="form-control" placeholder="Last Name" name="last_name" id="last_name" value="{{isset($profileData->lastname)? $profileData->lastname : ''}}">
                                                <span id="last_name_error" class="text-danger valley"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Email Address</strong></label>
                                                <input type="text" class="form-control" placeholder="Email Address" name="email" id="email" value="{{isset($profileData->email )? $profileData->email  : ''}}">
                                                <span id="email_error" class="text-danger valley"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3 phone--drpdwns">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Phone Number</strong></label>
                                                <input type="hidden" value="" name="country_code" id="country_code_phone">
                                                <input type="hidden" value="" name="country_name" id="country_name_phone">
                                                <input type="hidden" value="" name="country_iso" id="country_iso_phone" value="{{isset($profileData->country_iso )? $profileData->country_iso  : ''}}">
                                                <input class="form-control numbers" type="tel" required="" name="contact" id="contact" placeholder="1234567890" placeholder="1234567890" maxlength="10" pattern="[0-9]{4}" style="width:" value="{{isset($profileData->phone )? $profileData->phone  : ''}}">
                                                <span id="contact_error" class="text-danger valley"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Date of Birth</strong></label>
                                                <input type="date" class="form-control" placeholder="Date of Birth" name="dob" id="dob" value="{{isset($profileData->date_of_birth )? $profileData->date_of_birth  : ''}}">
                                                <span id="date_error" class="text-danger valley"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="gender" class="d-flex gap-3 flex-wrap"><strong>Gender</strong></label>
                                                <div class="d-flex gap-3 flex-wrap">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="gender" id="genderMale" value="Male" @if($profileData->gender == "Male") checked @endif>
                                                        <label class="form-check-label" for="genderMale">
                                                            Male
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="Female" @if($profileData->gender == "Female") checked @endif>
                                                        <label class="form-check-label" for="genderFemale">
                                                            Female
                                                        </label>
                                                    </div>
                                                </div>
                                                <span id="genderErr" class="text-danger valley"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Nationality</strong></label>
                                                <select name="nationality" class="form-control form-select ps-5" id="nationality">
                                                    <option value="">Select Nationality</option>
                                                    @php $country_data=country_name_from_db();@endphp
                                                    @foreach ($country_data as $data)
                                                    <option value="{{ $data->id }}" <?= isset($profileData->nationality) &&  $profileData->nationality == $data->id ? 'selected' : '' ?>>{{ $data->nationality }}</option>
                                                    @endforeach
                                                </select>
                                                <span id="nationality_error" class="text-danger valley"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Personal website</strong></label>
                                                <input class="form-control" type="url" required="" name="per_website" id="per_website" placeholder="Personal website" value="{{isset($profileData->personal_website )? $profileData->personal_website  : ''}}">
                                                <span id="per_website_error" class="text-danger valley"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Country</strong></label>
                                                <select class="form-control form-select ps-5" name="country" id="countryI">
                                                    <option value="">Select Country</option>
                                                    @php $country_data=country_name_from_db();@endphp
                                                    @foreach ($country_data as $data)
                                                    <option value="{{$data->iso2}}" <?= isset($profileData->country) &&  $profileData->country == $data->iso2 ? 'selected' : '' ?>> {{$data->name}} </option>
                                                    @endforeach
                                                </select>
                                                <span id="country_error" class="text-danger valley"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>State</strong></label>
                                                <select class="form-control form-select ps-5" name="state" id="stateI" id="stateI">
                                                    @php
                                                    if(isset( $profileData->country)){
                                                    $state_data = state_list();
                                                    }else{
                                                    $state_data = '';
                                                    }
                                                    @endphp

                                                    @if(isset($state_data) && !empty($state_data))
                                                    @foreach ($state_data as $data_state)
                                                    <option value="{{$data_state->id}}" <?= isset($profileData->state) &&  $profileData->state  == $data_state->id ? 'selected' : '' ?>> {{$data_state->name}} </option>
                                                    @endforeach
                                                    @endif

                                                </select>
                                                <span id="state_error" class="text-danger valley"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>City</strong></label>
                                                <input class="form-control" type="text" required="" name="city" id="city" placeholder="City" value="{{isset($profileData->city )? $profileData->city  : ''}}">
                                                <span id="city_error" class="text-danger valley"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Zip code</strong></label>
                                                <input class="form-control" type="text" required="" name="zip_code" id="zip_code" placeholder="Zip code" value="{{isset($profileData->post_code )? $profileData->post_code  : ''}}">
                                                <span id="zip_code_error" class="text-danger valley"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Home Address</strong></label>
                                                <input class="form-control" type="text" required="" name="home_address" id="home_address" placeholder="Home Address" value="{{isset($profileData->home_address )? $profileData->home_address  : ''}}">
                                                <span id="home_address_error" class="text-danger valley"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Password</strong></label>
                                                <input class="form-control" type="password" required="" name="password" id="passwordI" placeholder="">
                                                <span id="reqTxtpasswordI" class="reqError valley text-danger"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Confirm Password *</strong></label>
                                                <input class="form-control" type="password" required="" id="confirm_passwordI" name="confirm_password" placeholder="">
                                                <span id="reqTxtconfirm_passwordI" class="reqError valley text-danger"></span>
                                            </div>
                                        </div>

                                        <h4 class="mt-3">Emergency Contact Information</h4>
                                        <div class="col-md-6 mt-3 phone--drpdwns">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Mobile No</strong></label>
                                                <input type="hidden" value="" name="emr_county_code" id="country_code_mobile" value="{{isset($profileData->emegency_country_code )? $profileData->emegency_country_code  : ''}}">
                                                <input type="hidden" value="" name="emr_country_name" id="country_name_mobile">
                                                <input type="hidden" value="" name="emr_country_iso" id="country_iso_mobile" value="{{isset($profileData->emergency_country_iso )? $profileData->emergency_country_iso  : ''}}">
                                                <input class="form-control numbers" type="tel" required="" name="emrg_contact" id="emrg_contact" placeholder="1234567890" placeholder="1234567890" maxlength="10" pattern="[0-9]{4}" style="width: " value="{{isset($profileData->emergency_conact_numeber )? $profileData->emergency_conact_numeber  : ''}}">
                                                <span id="emrg_contact_error" class="text-danger valley"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Email</strong></label>
                                                <input type="text" class="form-control" id="emrg_email" name="emrg_email" placeholder="Email" value="{{isset($profileData->emergergency_contact_email )? $profileData->emergergency_contact_email  : ''}}">
                                                <span id="emrg_email_error" class="text-danger valley"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-3">
                                        <button type="button" class="btn btn-default edit-form-1 align-items-center justify-content-between" data-target="#tab-1">Save</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script type="text/javascript"
    src="https://nextjs.webwiders.in/pindrow/public/advertiser/dist/libs/owl.carousel/dist/owl.carousel.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
@include('admin.edit_script');
@endsection