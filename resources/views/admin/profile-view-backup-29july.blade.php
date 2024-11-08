@extends('admin.layouts.layout')
@section('content')
     <style>
        .dropdown-list {
            background-color: white;
            color:white;
            max-height: 200px; /* Adjust the height as needed */
            overflow-y: auto; /* Add scrollbar if content overflows */
            padding: 0;
            list-style: none;
            margin: 0;
            border: 1px solid #f1f1f1;
            border-radius: 4px;
            background-color: #ffffff;
            padding: 11px 15px 13px 15px;
            width: 100%;
            color: #A0ABB8;

        }
        .dropdown-item-custom {
            padding: 10px; /* Add padding to list items */
            color: black;
            text-decoration: none;
            display: block;
        }
        .dropdown-item-custom:hover {
            background-color: white; /* Change the hover background color */
        }
    </style>
    <div class="container-fluid">
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
                <ul class="nav nav-pills nav-fill mt-4 tabs-feat" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-bs-toggle="tab" href="#navpill-1" role="tab"
                            aria-selected="true">
                            <span>Basic Details</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#navpill-2" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span>Professional Information</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#navpill-3" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span>Education and Certifications</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#navpill-4" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span>Experience</span>
                        </a>
                    </li>
                    {{-- <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#navpill-5" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span>Financial Details</span>
                        </a>
                    </li> --}}
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#navpill-5" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span>Mandatory Training</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#navpill-6" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span>Vaccinations</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#navpill-7" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span>Work Clearances</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#navpill-8" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span>Professional Memberships</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#navpill-9" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span>Interview and References</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#navpill-10" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span>Personal Preferences</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#navpill-11" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span>Find Work Preferences</span>
                        </a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content border mt-2">
                    <div class="tab-pane p-3 active show" id="navpill-1" role="tabpanel">
                        <div class="row">
                            <div class=" w-100  overflow-hidden">
                                <div class="card-body p-3 px-md-4 pb-0">
                                    <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Basic Details</h3>
                                </div>
                                <div class="card-body p-3 px-md-4">
                                    <div class="col-md-12">
                                        <div class="row">
                                        @if($profileData->date_of_birth && $profileData->gender && $profileData->state && $profileData->city
                                        && $profileData->personal_website && $profileData->home_address && $profileData->emergency_conact_numeber)    
                                            @if($profileData->date_of_birth)
                                            <div class="col-md-6 mt-3">
                                                <div class="d-flex gap-3 flex-wrap">
                                                    {{-- <strong>Do you have work rights in Austrailia? : </strong>
                                                    <span>{{ $profileData->work_right == 0 ? 'No' : 'Yes' }}</span> --}}
                                                    <strong>Date of Birth : </strong>
                                                    <span>{{ \Carbon\Carbon::parse($profileData->date_of_birth)->format('d/m/Y') }}</span>
                                                </div>
                                            </div>
                                            @endif
                                            @if($profileData->gender)
                                            <div class="col-md-6 mt-3">
                                                <div class="d-flex gap-3 flex-wrap">
                                                <!-- specialty_name_by_id -->
                                                    <strong>Gender: </strong><span>{{ $profileData->gender }}</span>
                                                </div>
                                            </div>
                                            @endif
                                            {{-- <div class="col-md-6 mt-3">
                                                <div class="d-flex gap-3 flex-wrap">
                                                    <strong>Nationality: </strong>
                                                    <!-- specialty_name_by_id -->
                                                   <span> - - -  </span>
                                                </div>
                                            </div> --}}
                    
                    
                                            {{-- <div class="col-md-6 mt-3">
                                                <div class="d-flex gap-3 flex-wrap">
                                                    <strong> Home Address : </strong> <span> - - -  </span>
                                                </div>
                                            </div> --}}
                                            
                                            @if($profileData->state)
                                                <div class="col-md-6 mt-3">
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <strong> State  : </strong> <span>{{ state_name($profileData->state)}}</span>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($profileData->city)
                                                <div class="col-md-6 mt-3">
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <strong> City   : </strong> <span>{{ $profileData->city }}</span>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($profileData->personal_website)
                                                <div class="col-md-6 mt-3">
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <strong> Personal website   : </strong> <span>{{ $profileData->personal_website }}</span>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($profileData->home_address)
                                                <div class="col-md-6 mt-3">
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <strong>Home Address   : </strong> <span>{{ $profileData->home_address }}</span>
                                                    </div>
                                                </div>
                                            @endif
                                            {{-- @if($profileData->bio)
                                                <div class="col-md-12 mt-3">
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <strong>Bio   : </strong> <span>{{ $profileData->bio }}</span>
                                                    </div>
                                                </div>
                                            @endif --}}
                                            <h4 class="fw-bolder fs-6 lh-base d-flex align-items-center  mt-3">Emergency Contact Information : </h4>
                                            @if($profileData->emergency_conact_numeber)
                                                <div class="col-md-6 mt-3">
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <strong>Mobile No  :</strong> <span>
                                                             +{{ $profileData->emegency_country_code }}{{ " "}}
                                                             {{ $profileData->emergency_conact_numeber }}
                                                        </span>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($profileData->emergergency_contact_email)
                                                <div class="col-md-6 mt-3">
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <strong>Email  :</strong> <span>
                                                             {{ $profileData->emergergency_contact_email }}
                                                        </span>
                                                    </div>
                                                </div>
                                            @endif
                                            
                    
                                            {{-- @if ($profileData->specialty != 'null')
                                                @php $subspecialty=json_decode($profileData->specialty); @endphp
                                                @if (is_array($subspecialty))
                                                    <div class="col-md-12 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong> Specialty : </strong>
                                                            @forelse($subspecialty as $key => $ubspecialty)
                                                            <span>{{ practitioner_type_by_id($ubspecialty) }} , </span>@empty
                                                            @endforelse
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif --}}
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
                    <div class="tab-pane p-3" id="navpill-2" role="tabpanel">
                        <div class="row">
                            <div class=" w-100  overflow-hidden">
                                <div class="card-body p-3 px-md-4 pb-0">
                                    <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Professional Information
                                    </h3>
                                </div>
                                <div class="card-body p-3 px-md-4">
                                    <div class="col-md-12">

                                        @if($profileData->nurseType && $profileData->specialties)
                                            <div class="row">
                                                
                                                @if ($profileData->nurseType != 'null')
                                                @php $nurseType=json_decode($profileData->nurseType); @endphp
                                                @if (is_array($nurseType))
                                                    <div class="col-md-12 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong> Profession : </strong>
                                                            <ul class="dropdown-list">
                                                                @forelse($nurseType as $key => $ubspecialty)
                                                                    <li><span class="dropdown-item-custom">{{ specialty_name_by_id_NEW($ubspecialty) }} , </span></li>
                                                                @empty
                                                                    <li><a href="#" class="dropdown-item-custom">No specialties available</a></li>
                                                                @endforelse
                                                            </ul>
                                                        </div>
                                                    </div>
                                                @endif
                                                @endif                                                
                                                @if ($profileData->nurseType != 'null')
                                                    @php
                                                        $nurseType = json_decode($profileData->nurseType);

                                                        // Ensure $nurseType is an array
                                                        $nurseType = is_array($nurseType) ? $nurseType : [];
                                                        $nursepra = [];
                                                    
                                                    @endphp

                                                    @foreach($nurseType as $key => $ubspecialty)
                                                        @php
                                                           
                                                            $specialtyName = specialty_name_by_id_NEW($ubspecialty);
                                                           
                                                            $normalizedSpecialty = strtolower(str_replace('_', ' ', $specialtyName));

                                                            // Define strings to compare
                                                            $string1 = 'entry level nursing';
                                                            $string2 = 'registered nurses';
                                                            $string3 = 'advanced practitioner';

                                                            // Extract words from normalized specialty
                                                            $words = explode(' ', $normalizedSpecialty);
                                                            $firstWord = isset($words[0]) ? strtolower($words[0]) : '';
                                                            $secondWord = isset($words[1]) ? strtolower($words[1]) : '';
                                                            $firstTwoWords = $firstWord . ' ' . $secondWord;

                                                            // Determine the correct nurse sub-job type
                                                            if ($normalizedSpecialty === $string1) {
                                                                $nursesubjobType = json_decode($profileData->entry_level_nursing);
                                            
                                                            } elseif ($firstTwoWords === strtolower($string2)) {
                                                                $nursesubjobType = json_decode($profileData->registered_nurses);
                                                            } elseif ($firstWord === 'advanced') {
                                                                $nursepra = $profileData->advanced_practioner;
                                                                $nursesubjobType = json_decode($profileData->advanced_practioner);
                                                            } else {
                                                                $nursesubjobType = json_decode($profileData->advanced_practioner); // Default case
                                                            }

                                                            // Ensure $nursesubjobType is an array
                                                            $nursesubjobType = is_array($nursesubjobType) ? $nursesubjobType : [];
                                                        @endphp

                                                        <div class="col-md-12 mt-3">
                                                            <div class="d-flex gap-3 flex-wrap">
                                                                <strong>{{ $specialtyName }}:</strong>
                                     
                                                                {{-- @forelse($nursesubjobType as $key => $subtype)
                                                                     
                                                                    <span>{{ specialty_name_by_id($subtype) }} ,</span>
                                                                @empty
                                                                    <span>No sub-job types found</span>
                                                                @endforelse --}}
                                                                <ul class="dropdown-list">
                                                                @forelse($nursesubjobType as $key => $subtype)

                                                                    <li><span class="dropdown-item-custom">{{ specialty_name_by_id_NEW($subtype) }} , </span></li>

                                                                @empty
                                                                    <li><a href="#" class="dropdown-item-custom"></a></li>
                                                                @endforelse
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                                                                                                     
                                                <?php 
                                                // Decode the JSON strings to associative arrays
                                                // $nursepraArray = json_decode($nursepra, true); // `true` to return an associative array
                                                 $nursepraArray = is_string($nursepra) ? json_decode($nursepra, true) : (is_array($nursepra) ? $nursepra : []);

                                                // Ensure $profileData is not null and has the required properties
                                                $profileData = $profileData ?? new stdClass();
                                                // $nurse_prac = isset($profileData->nurse_prac) ? json_decode($profileData->nurse_prac, true) : [];
                                                $nurse_prac = isset($profileData->nurse_prac) 
                                                    ? (is_string($profileData->nurse_prac) 
                                                        ? json_decode($profileData->nurse_prac, true) 
                                                        : (is_array($profileData->nurse_prac) 
                                                            ? $profileData->nurse_prac 
                                                            : []))
                                                    : [];
                                                   ?>
                                               
                                                @if(is_array($nursepraArray) && in_array(179, $nursepraArray))
                                                <div class="col-md-12 mt-3">
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <strong> Nurse Practitioner (NP) : </strong> 
                                                        {{-- @forelse($nurse_prac as $key => $ubspecialty)
                                                        <span>{{ specialty_name_by_id_NEW($ubspecialty) }} , </span>
                                                        @empty
                                                        <span></span>
                                                        @endforelse --}}

                                                        <ul class="dropdown-list">
                                                            @forelse($nurse_prac as $key => $subtype)
                                                                <li><span class="dropdown-item-custom">{{ specialty_name_by_id_NEW($subtype) }} , </span></li>
                                                            @empty
                                                                <li><a href="#" class="dropdown-item-custom"></a></li>
                                                            @endforelse
                                                        </ul>
                                                    </div>
                                                </div>
                                                @endif

                                                @if ($profileData->specialties != 'null')
                                                @php $specialties=json_decode($profileData->specialties); @endphp
                                                @if (is_array($specialties))
                                                    <div class="col-md-12 mt-4">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong> Specialties : </strong>
                                                            {{-- @forelse($specialties as $key => $ubspecialty)
                                                            <span>{{ practitioner_type_by_id($ubspecialty) }} , </span>@empty
                                                            @endforelse --}}
                                                            <ul class="dropdown-list">
                                                                @forelse($specialties as $key => $subtype)
                                                                    <li><span class="dropdown-item-custom">{{ practitioner_type_by_id($subtype) }} , </span></li>
                                                                @empty
                                                                    <li><a href="#" class="dropdown-item-custom"></a></li>
                                                                @endforelse
                                                            </ul>
                                                        </div>
                                                    </div>
                                                @endif
                                                @endif

                                                @if ($profileData->specialties != 'null')
                                                    @php
                                                        $specialties = json_decode($profileData->specialties);
                                                    
                                                        // Ensure $nurseType is an array
                                                        $specialties = is_array($specialties) ? $specialties : [];
                                                        $surgical_preoperative        = [];
                                                        $surgical_obstrics_gynacology = [];
                                                        $neonatal_care = [];
                                                        $paedia_surgical_preoperative = [];
                                                        $i= 1;
                                                    @endphp
                                         
                                                    @foreach($specialties as $key => $ubspecialty)
                                                        @php
                                                        
                                                            $specialtyName = practitioner_type_by_id($ubspecialty);

                                                            $normalizedSpecialty = strtolower(str_replace('_', ' ', $specialtyName));

                                                            // Define strings to compare
                                                            $string1 = 'adults';
                                                            $string2 = 'maternity';
                                                            $string3 = 'paediatrics neonatal';
                                                            $string4 = 'community';

                                                            // Extract words from normalized specialty
                                                            $words = explode(' ', $normalizedSpecialty);
                                                            $firstWord = isset($words[0]) ? strtolower($words[0]) : '';
                                                            $secondWord = isset($words[1]) ? strtolower($words[1]) : '';
                                                            $firstTwoWords = $firstWord . ' ' . $secondWord;

                                                            // Determine the correct nurse sub-job type
                                                            if ($normalizedSpecialty === $string1) {
                                                                $surgical_preoperative = $profileData->adults;
                                                                $specsubType = json_decode($profileData->adults);
                                                            } elseif ($firstWord  === strtolower($string2)) {
                                                                  $surgical_obstrics_gynacology = $profileData->maternity;
                                                                $specsubType = json_decode($profileData->maternity);
                                                            } elseif ($firstTwoWords === strtolower($string3)) {
                                                                $neonatal_care = $profileData->paediatrics_neonatal;
                                                                $paedia_surgical_preoperative = $profileData->paediatrics_neonatal;
                                                                $specsubType = json_decode($profileData->paediatrics_neonatal);
                                                            } elseif ($firstWord === strtolower($string4)) {

                                                               
                                                                $specsubType = json_decode($profileData->community);
                                                            }else {
                                                                $specsubType = json_decode($profileData->community); // Default case
                                                            }

                                                            // Ensure $nursesubjobType is an array
                                                            $specsubType = is_array($specsubType) ? $specsubType : [];
                                                        @endphp

                                                        <div class="col-md-12 mt-4" id="cat_{{ $i}}">
                                                            <div class="d-flex gap-3 flex-wrap">
                                                                <strong>{{ $specialtyName }}:</strong>
                                     
                                                                {{-- @forelse($specsubType as $key => $subtype)
                                                                     
                                                                    <span>{{ practitioner_type_by_id($subtype) ;}} ,</span>
                                                                @empty
                                                                    <span></span>
                                                                @endforelse --}}
                                                                
                                                                <ul class="dropdown-list">
                                                                @forelse($specsubType as $key => $subtype)
                                                                    <li><span class="dropdown-item-custom">{{ practitioner_type_by_id($subtype) }} , </span></li>
                                                                @empty
                                                                    <li><a href="#" class="dropdown-item-custom"></a></li>
                                                                @endforelse
                                                            </ul>
                                                            
                                                            </div>
                                                        </div>
                                                        <?php $i++ ;?>
                                                    @endforeach

                                                @endif

                                                <?php 
                                               
                                               
                                                $surgicalArray = is_string($surgical_preoperative) ? json_decode($surgical_preoperative, true) : (is_array($surgical_preoperative) ? $surgical_preoperative : []);
                                               
                                                $profileData = $profileData ?? new stdClass();
                                                $sargicaldata = isset($profileData->surgical_preoperative) ? json_decode($profileData->surgical_preoperative, true) : [];
                                                $operating_room = isset($profileData->operating_room) ? json_decode($profileData->operating_room, true) : [];
                                                $operating_room_scout = isset($profileData->operating_room_scout) ? json_decode($profileData->operating_room_scout, true) : [];
                                                 $operating_room_scrub = isset($profileData->operating_room_scrub) ? json_decode($profileData->operating_room_scrub, true) : [];
                                                ?>
                                               
                                                @if(is_array($surgicalArray) && in_array(96, $surgicalArray)) 
                                                <div class="col-md-12 mt-3" id="sugical_care">
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <strong> Surgical Preoperative and Postoperative Care : </strong> 
                                                        {{-- @forelse($sargicaldata as $key => $ubspecialty)
                                                        <span>{{ practitioner_type_by_id($ubspecialty) }} , </span>
                                                        @empty
                                                        <span></span>
                                                        @endforelse --}}

                                                        <ul class="dropdown-list">
                                                            @forelse($sargicaldata as $key => $ubspecialty)
                                                                <li><span class="dropdown-item-custom">{{ practitioner_type_by_id($ubspecialty) }} , </span></li>
                                                            @empty
                                                                <li><a href="#" class="dropdown-item-custom"></a></li>
                                                            @endforelse
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mt-3" id="Operating_Room">
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <strong> Operating Room (OR) : </strong> 
                                                        {{-- @forelse($operating_room as $key => $operating_rooms)
                                                        <span>{{ practitioner_type_by_id($operating_rooms) }} , </span>
                                                        @empty
                                                        <span></span>
                                                        @endforelse --}}
                                                        <ul class="dropdown-list">
                                                            @forelse($operating_room as $key => $operating_rooms)
                                                                <li><span class="dropdown-item-custom">{{ practitioner_type_by_id($operating_rooms) }} , </span></li>
                                                            @empty
                                                                <li><a href="#" class="dropdown-item-custom"></a></li>
                                                            @endforelse
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mt-3" id="paediatric_oR">
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <strong>Paediatric OR: Scout (Circulating Nurse) : </strong> 
                                                        {{-- @forelse($operating_room_scout as $key => $operating_room_scouts)
                                                        <span>{{ practitioner_type_by_id($operating_room_scouts) }} , </span>
                                                        @empty
                                                        <span></span>
                                                        @endforelse --}}
                                                        <ul class="dropdown-list">
                                                            @forelse($operating_room_scout as $key => $operating_room_scouts)
                                                                <li><span class="dropdown-item-custom">{{ practitioner_type_by_id($operating_room_scouts) }} , </span></li>
                                                            @empty
                                                                <li><a href="#" class="dropdown-item-custom"></a></li>
                                                            @endforelse
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mt-3">
                                                    <div class="d-flex gap-3 flex-wrap" id="Technician_Nurse">
                                                        <strong> Paediatric OR: Scrub (Technician Nurse) : </strong> 
                                                        {{-- @forelse($operating_room_scrub as $key => $operating_room_scrubs)
                                                        <span>{{ practitioner_type_by_id($operating_room_scrubs) }} , </span>
                                                        @empty
                                                        <span></span>
                                                        @endforelse --}}
                                                        <ul class="dropdown-list">
                                                            @forelse($operating_room_scrub as $key => $operating_room_scrubs)
                                                                <li><span class="dropdown-item-custom">{{ practitioner_type_by_id($operating_room_scrubs) }} , </span></li>
                                                            @empty
                                                                <li><a href="#" class="dropdown-item-custom"></a></li>
                                                            @endforelse
                                                        </ul>
                                                    </div>
                                                </div>

                                                 @endif

                                                <?php 
                                               
                                                $gynacologyArray = is_string($surgical_obstrics_gynacology) ? json_decode($surgical_obstrics_gynacology, true) : (is_array($surgical_obstrics_gynacology) ? $surgical_obstrics_gynacology : []);
                                                
                                                $profileData = $profileData ?? new stdClass();
                                                $surgical_preoperative = isset($profileData->surgical_obstrics_gynacology) ? json_decode($profileData->surgical_obstrics_gynacology, true) : [];
                                                   ?>
                                               
                                                @if(is_array($gynacologyArray) && in_array(233, $gynacologyArray))
                                                <div class="col-md-12 mt-3" id="Surgical_Obstetrics"> 
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <strong> Surgical Obstetrics and Gynecology (OB/GYN) : </strong> 
                                                        {{-- @forelse($surgical_preoperative as $key => $subtype)
                                                        <span>{{ practitioner_type_by_id($subtype) }} , </span>
                                                        @empty
                                                        <span></span>
                                                        @endforelse --}}
                                                        <ul class="dropdown-list">
                                                            @forelse($surgical_preoperative as $key => $subtype)
                                                                <li><span class="dropdown-item-custom">{{ practitioner_type_by_id($subtype) }} , </span></li>
                                                            @empty
                                                                <li><a href="#" class="dropdown-item-custom"></a></li>
                                                            @endforelse
                                                        </ul>
                                                    </div>
                                                </div>
                                                @endif

                                                <?php 
                                                $neonatalcareArray = is_string($neonatal_care) ? json_decode($neonatal_care, true) : (is_array($neonatal_care) ? $neonatal_care : []);
                                                $profileData = $profileData ?? new stdClass();
                                                $neonatal_care = isset($profileData->neonatal_care) ? json_decode($profileData->neonatal_care, true) : [];
                                                   ?>
                                               
                                                @if(is_array($neonatalcareArray) && in_array(250, $neonatalcareArray))
                                                <div class="col-md-12 mt-3" id="Neonatal_Care">
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <strong> Neonatal Care : </strong> 
                                                        {{-- @forelse($neonatal_care as $key => $neonatal_careS)
                                                        <span>{{ practitioner_type_by_id($neonatal_careS) }} , </span>
                                                        @empty
                                                        <span></span>
                                                        @endforelse --}}
                                                        <ul class="dropdown-list">
                                                            @forelse($neonatal_care as $key => $subtype)
                                                                <li><span class="dropdown-item-custom">{{ practitioner_type_by_id($subtype) }} , </span></li>
                                                            @empty
                                                                <li><a href="#" class="dropdown-item-custom"></a></li>
                                                            @endforelse
                                                        </ul>
                                                    </div>
                                                </div>
                                                @endif

                                                <?php 
                                                $paediaArray = is_string($paedia_surgical_preoperative) ? json_decode($paedia_surgical_preoperative, true) : (is_array($paedia_surgical_preoperative) ? $paedia_surgical_preoperative : []);
                                                $profileData = $profileData ?? new stdClass();
                                                $paedia_surgical_preoperative = isset($profileData->paedia_surgical_preoperative) ? json_decode($profileData->paedia_surgical_preoperative, true) : [];
                                                $pad_op_room = isset($profileData->pad_op_room) ? json_decode($profileData->pad_op_room, true) : [];
                                                $pad_qr_scout = isset($profileData->pad_qr_scout) ? json_decode($profileData->pad_qr_scout, true) : [];
                                                 $pad_qr_scrub = isset($profileData->pad_qr_scrub) ? json_decode($profileData->pad_qr_scrub, true) : [];
                                                ?>
                                               
                                                @if(is_array($paediaArray) && in_array(285, $paediaArray))
                                                <div class="col-md-12 mt-3" id="Surgical_Preop">
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <strong> Paediatric Surgical Preop. and Postop. Care : </strong> 
                                                        {{-- @forelse($paedia_surgical_preoperative as $key => $ubspecialty)
                                                        <span>{{ practitioner_type_by_id($ubspecialty) }} , </span>
                                                        @empty
                                                        <span></span>
                                                        @endforelse --}}
                                                        <ul class="dropdown-list">
                                                            @forelse($paedia_surgical_preoperative as $key => $subtype)
                                                                <li><span class="dropdown-item-custom">{{ practitioner_type_by_id($subtype) }} , </span></li>
                                                            @empty
                                                                <li><a href="#" class="dropdown-item-custom"></a></li>
                                                            @endforelse
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mt-3" id="Paediatric_Operating">
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <strong> Paediatric Operating Room (OR) : </strong> 
                                                        {{-- @forelse($pad_op_room as $key => $pad_op_rooms)
                                                        <span>{{ practitioner_type_by_id($pad_op_rooms) }} , </span>
                                                        @empty
                                                        <span></span>
                                                        @endforelse --}}
                                                        <ul class="dropdown-list">
                                                            @forelse($pad_op_room as $key => $subtype)
                                                                <li><span class="dropdown-item-custom">{{ practitioner_type_by_id($subtype) }} , </span></li>
                                                            @empty
                                                                <li><a href="#" class="dropdown-item-custom"></a></li>
                                                            @endforelse
                                                        </ul>
                                                    </div>
                                                </div>

                                                 <div class="col-md-12 mt-3" id="Paediatric_Operating_Scout">
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <strong>Paediatric OR: Scout (Circulating Nurse) : </strong> 
                                                        {{-- @forelse($pad_qr_scout as $key => $pad_qr_scouts)
                                                        <span>{{ practitioner_type_by_id($pad_qr_scouts) }} , </span>
                                                        @empty
                                                        <span></span>
                                                        @endforelse --}}
                                                        <ul class="dropdown-list">
                                                            @forelse($pad_qr_scout as $key => $subtype)
                                                                <li><span class="dropdown-item-custom">{{ practitioner_type_by_id($subtype) }} , </span></li>
                                                            @empty
                                                                <li><a href="#" class="dropdown-item-custom"></a></li>
                                                            @endforelse
                                                        </ul>
                                                    </div>
                                                </div> 

                                                <div class="col-md-12 mt-3"  id="Paediatric_Operating_Scrub">
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <strong> Paediatric OR: Scrub (Technician Nurse) : </strong> 
                                                        <ul class="dropdown-list">
                                                            @forelse($pad_qr_scrub as $key => $subtype)
                                                                <li><span class="dropdown-item-custom">{{ practitioner_type_by_id($subtype) }} , </span></li>
                                                            @empty
                                                                <li><a href="#" class="dropdown-item-custom"></a></li>
                                                            @endforelse
                                                        </ul>
                                                    </div>
                                                </div>

                                                @endif

                                                @if($profileData->bio)
                                                <div class="col-md-12 mt-3">
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <strong>Professional Bio   : </strong> <span>{{ $profileData->bio }}</span>
                                                    </div>
                                                </div>
                                                @endif

                                                @if($profileData->current_employee_status)
                                                <div class="col-md-12 mt-3">
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <strong>Current Employee Status   : </strong> <span>{{ $profileData->current_employee_status }}</span>
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
                    <div class="tab-pane p-3" id="navpill-3" role="tabpanel">
                        <div class="row">
                            <div class=" w-100  overflow-hidden">
                                <div class="card-body p-3 px-md-4 pb-0">
                                    <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center "> Education and Certifications 
                                    </h3>
                                </div>
                                <div class="card-body p-3 px-md-4">
                                    <div class="col-md-12">
                                        @if($educationData && $profileData)
                                            <div class="row">
                                                
                                               <h4  class="mt-4 fw-bolder fs-6 lh-base d-flex align-items-center">Educational Background : </h4>
                                               @if ($profileData->degree != 'null')
                                                @php $degree = json_decode($profileData->degree); 
                                                // print_r($degree);die;
                                                @endphp
                                                <div class="col-md-12 mt-3">
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <strong>Nurse & Midwife degree: </strong>
                                                        <ul class="dropdown-list">
                                                            @forelse($degree as $key => $value)
                                                                <li><span class="dropdown-item-custom">{{ nurse_midwife_degree_by_id($value) }} , </span></li>
                                                            @empty
                                                                <li><a href="#" class="dropdown-item-custom"></a></li>
                                                            @endforelse
                                                        </ul>
                                                    </div>
                                                </div>
                                                @endif
                                                @if(isset($educationData->institution) && $educationData->institution)
                                                <div class="col-md-12 mt-3">
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <strong>Institution : </strong>
                                                        <span class="">{{ $educationData->institution }}</span>                                                  
                                                    </div>
                                                </div>
                                                @endif
                                                @if(isset($educationData->graduate_start_date) && $educationData->graduate_start_date)
                                                <div class="col-md-6 mt-3">
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <strong>Graduation Start Date : </strong>
                                                        <span class="">{{ \Carbon\Carbon::parse($educationData->graduate_start_date)->format('d/m/Y') }}</span>                                                  
                                                    </div>
                                                </div>
                                                @endif
                                                @if(isset($educationData->graduate_end_date) && $educationData->graduate_end_date)
                                                <div class="col-md-6 mt-3">
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <strong>Graduation End Date : </strong>
                                                        <span class="">{{ \Carbon\Carbon::parse($educationData->graduate_end_date)->format('d/m/Y') }}</span>                                                  
                                                    </div>
                                                </div>
                                                @endif
                                                @if ($educationData->professional_certifications != 'null')
                                                @php $certifications = json_decode($educationData->professional_certifications); 
                                                @endphp
                                                
                                                <div class="col-md-12 mt-3">
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <strong>Professional Certifications :</strong>
                                                        <?php
                                                        $certificates = DB::table("professional_certificate")->orderBy("ordering_id", "asc")->get();
                                                        ?>
                                                       
                                                        <ul class="dropdown-list">
                                                            @forelse($certificates as $certificate)
                                                                @if(in_array($certificate->id,$certifications))
                                                                    <li><span class="dropdown-item-custom">{{ $certificate->name }} , </span></li>
                                                                @endif
                                                            @empty
                                                                <li><a href="#" class="dropdown-item-custom">No certifications found</a></li>
                                                            @endforelse
                                                        </ul>
                                                    </div>
                                                </div>
                                                @endif

                                                @if($educationData->acls_data && $educationData->acls_data != 'null')
                                                    @php 
                                                        $acls_cert_ids = json_decode($educationData->acls_data, true); // Decode the acls_data field into an array
                                                        // Decode the 'acls_data' string into an array
                                                        $aclsData = json_decode($acls_cert_ids['acls_data'], true);
                                                        //   dd($acls_cert_ids['acls_licence_expiry']);
                                                        $acls_licence_num = $acls_cert_ids['acls_licence_num'];
                                                        $acls_licence_expiry = $acls_cert_ids['acls_licence_expiry'];
                                                      
                                                        $acls_file = $acls_cert_ids['acls_file'];
                                                    @endphp
                                                    
                                                     <div class="col-md-12 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>ACLS (Advanced Cardiovascular Life Support) :</strong>
                                                            <?php
                                                                $acls_datas = DB::table("professional_certificate_table")
                                                                                ->where("cert_id", "6")
                                                                                ->get();
                                                            ?>
                                                            <ul class="dropdown-list">
                                                                @forelse($acls_datas as $acls_data)
                                                                    @if(is_array($acls_cert_ids) && in_array($acls_data->professionalcert_id,$aclsData))
                                                                        <li><span class="dropdown-item-custom">{{ $acls_data->name }} , </span></li>
                                                                    @endif
                                                                @empty
                                                                    <li><a href="#" class="dropdown-item-custom">No certifications found</a></li>
                                                                @endforelse
                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Certification/Licence Number :</strong>
                                                             <span class="">{{ $acls_licence_num }}</span>                                                  
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Expiry :</strong>
                                                             <span class="">{{ $acls_licence_expiry }}</span>                                                  
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Certification/Licence Image :</strong>
                                                             @if($acls_file)
                                                            <a href="{{ asset('uploads/'.$acls_file) }}" target="_blank">
                                                                <span class="text-success">View Image</span>
                                                            </a> 
                                                            @else   
                                                            <span class="text-success">View Image</span>
                                                            @endif                                            
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($educationData->bls_data && $educationData->bls_data != 'null')
                                                    @php 
                                                        $bls_data_ids = json_decode($educationData->bls_data, true); // Decode the acls_data field into an array
                                                        // Decode the 'acls_data' string into an array
                                                        $blsData = json_decode($bls_data_ids['bls_data'], true);
                                                        //   dd($acls_cert_ids['acls_licence_expiry']);
                                                        $bls_licence_num = $bls_data_ids['bls_licence_num'];
                                                        $bls_licence_expiry = $bls_data_ids['bls_licence_expiry'];
                                                      
                                                        $bls_file = $bls_data_ids['bls_file'];
                                                    @endphp
                                                    
                                                     <div class="col-md-12 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>BLS (Basic Life Support) :</strong>
                                                            <?php
                                                                $bls_datas = DB::table("professional_certificate_table")
                                                                                ->where("cert_id", "7")
                                                                                ->get();
                                                            ?>
                                                            <ul class="dropdown-list">
                                                                @forelse($bls_datas as $bls_data)
                                                                    @if(is_array($bls_data_ids) && in_array($bls_data->professionalcert_id,$blsData))
                                                                        <li><span class="dropdown-item-custom">{{ $bls_data->name }} , </span></li>
                                                                    @endif
                                                                @empty
                                                                    <li><a href="#" class="dropdown-item-custom">No certifications found</a></li>
                                                                @endforelse
                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Certification/Licence Number :</strong>
                                                             <span class="">{{ $bls_licence_num }}</span>                                                  
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Expiry :</strong>
                                                             <span class="">{{ $bls_licence_expiry }}</span>                                                  
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Certification/Licence Image :</strong>
                                                            @if($bls_file)
                                                            <a href="{{ asset('uploads/'.$bls_file) }}" target="_blank">
                                                                <span class="text-success">View Image</span>
                                                            </a> 
                                                            @else
                                                            <span class="text-success">No Image</span>
                                                            @endif

                                                        </div>
                                                    </div>
                                                @endif

                                                @if($educationData->cpr_data && $educationData->cpr_data != 'null')
                                                    @php 
                                                        $cpr_data_ids = json_decode($educationData->cpr_data, true); // Decode the acls_data field into an array
                                                        // Decode the 'acls_data' string into an array
                                                        $cprData = json_decode($cpr_data_ids['cpr_data'], true);
                                                        //   dd($acls_cert_ids['acls_licence_expiry']);
                                                        $cpr_licence_num = $cpr_data_ids['cpr_licence_num'];
                                                        $cpr_licence_expiry = $cpr_data_ids['cpr_licence_expiry'];
                                                      
                                                        $cpr_file = $cpr_data_ids['cpr_file'];
                                                    @endphp
                                                    
                                                     <div class="col-md-12 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>CPR (Cardiopulmonary Resuscitation) :</strong>
                                                            <?php
                                                                $cpr_datas = DB::table("professional_certificate_table")
                                                                                ->where("cert_id", "8")
                                                                                ->get();
                                                            ?>
                                                            <ul class="dropdown-list">
                                                                @forelse($cpr_datas as $cpr_data)
                                                                    @if(is_array($cpr_data_ids) && in_array($cpr_data->professionalcert_id,$cprData))
                                                                        <li><span class="dropdown-item-custom">{{ $cpr_data->name }} , </span></li>
                                                                    @endif
                                                                @empty
                                                                    <li><a href="#" class="dropdown-item-custom">No Data found</a></li>
                                                                @endforelse
                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Certification/Licence Number :</strong>
                                                             <span class="">{{ $cpr_licence_num }}</span>                                                  
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Expiry :</strong>
                                                             <span class="">{{ $cpr_licence_expiry }}</span>                                                  
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Certification/Licence Image :</strong>
                                                            @if($cpr_file)
                                                            <a href="{{ asset('uploads/'.$cpr_file) }}" target="_blank">
                                                                <span class="text-success">View Image</span>
                                                            </a>  
                                                            @else  
                                                            <span class="">No Image</span> 
                                                            @endif                                           
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($educationData->nrp_data && $educationData->nrp_data != 'null')
                                                    @php 
                                                        $nrp_data_ids = json_decode($educationData->nrp_data, true); // Decode the acls_data field into an array
                                                        // Decode the 'acls_data' string into an array
                                                        $nrpData = json_decode($nrp_data_ids['nrp_data'], true);
                                                        //   dd($acls_cert_ids['acls_licence_expiry']);
                                                        $nrp_licence_num = $nrp_data_ids['nrp_licence_num'];
                                                        $nrp_licence_expiry = $nrp_data_ids['nrp_licence_expiry'];                                      
                                                        $nrp_file = $nrp_data_ids['nrp_file'];
                                                    @endphp
                                                    
                                                     <div class="col-md-12 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>NRP (Neonatal Resuscitation Program) :</strong>
                                                            <?php
                                                                $nrp_datas = DB::table("professional_certificate_table")
                                                                                ->where("cert_id", "9")
                                                                                ->get();
                                                            ?>
                                                            <ul class="dropdown-list">
                                                                @forelse($nrp_datas as $nrp_data)
                                                                    @if(is_array($nrp_data_ids) && in_array($nrp_data->professionalcert_id,$nrpData))
                                                                        <li><span class="dropdown-item-custom">{{ $nrp_data->name }} , </span></li>
                                                                    @endif
                                                                @empty
                                                                    <li><a href="#" class="dropdown-item-custom">No Data found</a></li>
                                                                @endforelse
                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Certification/Licence Number :</strong>
                                                             <span class="">{{ $nrp_licence_num }}</span>                                                  
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Expiry :</strong>
                                                             <span class="">{{ $nrp_licence_expiry }}</span>                                                  
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Certification/Licence Image :</strong>
                                                            @if($nrp_file)
                                                            <a href="{{ asset('uploads/'.$nrp_file) }}" target="_blank">
                                                                <span class="text-success">View Image</span>
                                                            </a>  
                                                            @else  
                                                            <span class="">No Image</span> 
                                                            @endif                                           
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($educationData->pals_data && $educationData->pals_data != 'null')
                                                    @php 
                                                        $pals_data_ids = json_decode($educationData->pals_data, true); // Decode the acls_data field into an array
                                                        $palsData = json_decode($pals_data_ids['pals_data'], true);
                                                        $pals_licence_num = $pals_data_ids['pals_licence_num'];
                                                        $pals_licence_expiry = $pals_data_ids['pals_licence_expiry'];                                      
                                                        $pals_file = $pals_data_ids['pals_file'];
                                                    @endphp
                                                    
                                                     <div class="col-md-12 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>PALS (Pediatric Advanced Life Support) :</strong>
                                                            @if($palsData)
                                                            <?php
                                                                $pals_datas = DB::table("professional_certificate_table")
                                                                                ->where("cert_id", "10")
                                                                                ->get();
                                                            ?>
                                                            <ul class="dropdown-list">
                                                                @forelse($pals_datas as $pals_data)
                                                                    @if(is_array($pals_data_ids) && in_array($pals_data->professionalcert_id,$palsData))
                                                                        <li><span class="dropdown-item-custom">{{ $pals_data->name }} , </span></li>
                                                                    @endif
                                                                @empty
                                                                    <li><a href="#" class="dropdown-item-custom">No Data found</a></li>
                                                                @endforelse
                                                            </ul>
                                                            @else
                                                            <ul class="dropdown-list">
                                                               
                                                                    <li><a href="#" class="dropdown-item-custom">No Data found</a></li>
                                                                
                                                            </ul>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Certification/Licence Number :</strong>
                                                             <span class="">{{ $pals_licence_num }}</span>                                                  
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Expiry :</strong>
                                                             <span class="">{{ $pals_licence_expiry }}</span>                                                  
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Certification/Licence Image :</strong>
                                                            @if($nrp_file)
                                                            <a href="{{ asset('uploads/'.$pals_file) }}" target="_blank">
                                                                <span class="text-success">View Image</span>
                                                            </a>  
                                                            @else  
                                                            <span class="">No Image</span> 
                                                            @endif                                           
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($educationData->rn_data && $educationData->rn_data != 'null')
                                                    @php 
                                                        $rn_data_ids = json_decode($educationData->rn_data, true); // Decode the acls_data field into an array
                                                        $rnData = json_decode($rn_data_ids['rn_data'], true);
                                                        $rn_licence_num = $rn_data_ids['rn_licence_num'];
                                                        $rn_licence_expiry = $rn_data_ids['rn_licence_expiry'];                                      
                                                        $rn_file = $rn_data_ids['rn_file'];
                                                    @endphp
                                                    
                                                     <div class="col-md-12 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>RN (Registered Nurse) :</strong>
                                                            
                                                            <?php
                                                                $rn_datas = DB::table("professional_certificate_table")
                                                                                ->where("cert_id", "11")
                                                                                ->get();
                                                            ?>
                                                            <ul class="dropdown-list">
                                                                @forelse($rn_datas as $rn_data)
                                                                    @if(is_array($rn_data_ids) && in_array($rn_data->professionalcert_id,$rnData))
                                                                        <li><span class="dropdown-item-custom">{{ $rn_data->name }} , </span></li>
                                                                    @endif
                                                                @empty
                                                                    <li><a href="#" class="dropdown-item-custom">No Data found</a></li>
                                                                @endforelse
                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Certification/Licence Number :</strong>
                                                             <span class="">{{ $rn_licence_num }}</span>                                                  
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Expiry :</strong>
                                                             <span class="">{{ $rn_licence_expiry }}</span>                                                  
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Certification/Licence Image :</strong>
                                                            @if($rn_file)
                                                            <a href="{{ asset('uploads/'.$rn_file) }}" target="_blank">
                                                                <span class="text-success">View Image</span>
                                                            </a>  
                                                            @else  
                                                            <span class="">No Image</span> 
                                                            @endif                                           
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($educationData->np_data && $educationData->np_data != 'null')
                                                    @php 
                                                        $np_data_ids = json_decode($educationData->np_data, true); // Decode the acls_data field into an array
                                                        $npData = json_decode($np_data_ids['np_data'], true);
                                                        $np_licence_num = $np_data_ids['np_licence_num'];
                                                        $np_licence_expiry = $np_data_ids['np_licence_expiry'];                                      
                                                        $np_file = $np_data_ids['np_file'];
                                                    @endphp
                                                    
                                                     <div class="col-md-12 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>NP (Nurse Practioner) / (APRN) Advanced Practice Registered Nurse :</strong>
                                                            
                                                            <?php
                                                                $np_datas = DB::table("professional_certificate_table")
                                                                                ->where("cert_id", "12")
                                                                                ->get();
                                                            ?>
                                                            <ul class="dropdown-list">
                                                                @forelse($np_datas as $np_data)
                                                                    @if(is_array($np_data_ids) && in_array($np_data->professionalcert_id,$npData))
                                                                        <li><span class="dropdown-item-custom">{{ $np_data->name }} , </span></li>
                                                                    @endif
                                                                @empty
                                                                    <li><a href="#" class="dropdown-item-custom">No Data found</a></li>
                                                                @endforelse
                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Certification/Licence Number :</strong>
                                                             <span class="">{{ $np_licence_num }}</span>                                                  
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Expiry :</strong>
                                                             <span class="">{{ $np_licence_expiry }}</span>                                                  
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Certification/Licence Image :</strong>
                                                            @if($rn_file)
                                                            <a href="{{ asset('uploads/'.$np_file) }}" target="_blank">
                                                                <span class="text-success">View Image</span>
                                                            </a>  
                                                            @else  
                                                            <span class="">No Image</span> 
                                                            @endif                                           
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($educationData->cna_data && $educationData->cna_data != 'null')
                                                    @php 
                                                        $cna_data_ids = json_decode($educationData->cna_data, true); // Decode the acls_data field into an array
                                                        $cnaData = json_decode($cna_data_ids['cna_data'], true);
                                                        $cna_licence_num = $cna_data_ids['cna_licence_num'];
                                                        $cna_licence_expiry = $cna_data_ids['cna_licence_expiry'];                                      
                                                        $cna_file = $cna_data_ids['cna_file'];
                                                    @endphp
                                                    
                                                     <div class="col-md-12 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>CNA (Certified Nursing Assistant) / EN (Enrolled Nurse) :</strong>
                                                            
                                                            <?php
                                                                $cna_datas = DB::table("professional_certificate_table")
                                                                                ->where("cert_id", "13")
                                                                                ->get();
                                                            ?>
                                                            <ul class="dropdown-list">
                                                                @forelse($cna_datas as $cna_data)
                                                                    @if(is_array($cna_data_ids) && in_array($cna_data->professionalcert_id,$cnaData))
                                                                        <li><span class="dropdown-item-custom">{{ $cna_data->name }} , </span></li>
                                                                    @endif
                                                                @empty
                                                                    <li><a href="#" class="dropdown-item-custom">No Data found</a></li>
                                                                @endforelse
                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Certification/Licence Number :</strong>
                                                             <span class="">{{ $cna_licence_num }}</span>                                                  
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Expiry :</strong>
                                                             <span class="">{{ $cna_licence_expiry }}</span>                                                  
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Certification/Licence Image :</strong>
                                                            @if($cna_file)
                                                            <a href="{{ asset('uploads/'.$cna_file) }}" target="_blank">
                                                                <span class="text-success">View Image</span>
                                                            </a>  
                                                            @else  
                                                            <span class="">No Image</span> 
                                                            @endif                                           
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($educationData->lpn_data && $educationData->lpn_data != 'null')
                                                    @php 
                                                        $lpn_data_ids = json_decode($educationData->lpn_data, true); // Decode the acls_data field into an array
                                                        $lpnData = json_decode($lpn_data_ids['lpn_data'], true);
                                                        $lpn_licence_num = $lpn_data_ids['lpn_licence_num'];
                                                        $lpn_licence_expiry = $lpn_data_ids['lpn_licence_expiry'];                                      
                                                        $lpn_file = $lpn_data_ids['cna_file'];
                                                    @endphp
                                                    
                                                     <div class="col-md-12 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>LPN (Licensed Practical Nurse) / LVN (Licensed Vocational Nurse) :</strong>
                                                            
                                                            <?php
                                                                $lpn_datas = DB::table("professional_certificate_table")
                                                                                ->where("cert_id", "14")
                                                                                ->get();
                                                            ?>
                                                            <ul class="dropdown-list">
                                                                @forelse($lpn_datas as $lpn_data)
                                                                    @if(is_array($lpn_data_ids) && in_array($lpn_data->professionalcert_id,$lpnData))
                                                                        <li><span class="dropdown-item-custom">{{ $lpn_data->name }} , </span></li>
                                                                    @endif
                                                                @empty
                                                                    <li><a href="#" class="dropdown-item-custom">No Data found</a></li>
                                                                @endforelse
                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Certification/Licence Number :</strong>
                                                             <span class="">{{ $lpn_licence_num }}</span>                                                  
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Expiry :</strong>
                                                             <span class="">{{ $lpn_licence_expiry }}</span>                                                  
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Certification/Licence Image :</strong>
                                                            @if($lpn_file)
                                                            <a href="{{ asset('uploads/'.$lpn_file) }}" target="_blank">
                                                                <span class="text-success">View Image</span>
                                                            </a>  
                                                            @else  
                                                            <span class="">No Image</span> 
                                                            @endif                                           
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($educationData->crna_data && $educationData->crna_data != 'null')
                                                    @php 
                                                        $crna_data_ids = json_decode($educationData->crna_data, true); // Decode the acls_data field into an array
                                                        $crnaData = json_decode($crna_data_ids['crna_data'], true);
                                                        $crna_licence_num = $crna_data_ids['lpn_licence_num'];
                                                        $crna_licence_expiry = $crna_data_ids['lpn_licence_expiry'];                                      
                                                        $crna_file = $crna_data_ids['cna_file'];
                                                    @endphp
                                                    
                                                     <div class="col-md-12 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>CRNA (Certified Registered Nurse Anesthetist) :</strong>
                                                            
                                                            <?php
                                                                $crna_datas = DB::table("professional_certificate_table")
                                                                                ->where("cert_id", "15")
                                                                                ->get();
                                                            ?>
                                                            <ul class="dropdown-list">
                                                                @forelse($crna_datas as $crna_data)
                                                                    @if(is_array($crna_data_ids) && in_array($crna_data->professionalcert_id,$crnaData))
                                                                        <li><span class="dropdown-item-custom">{{ $crna_data->name }} , </span></li>
                                                                    @endif
                                                                @empty
                                                                    <li><a href="#" class="dropdown-item-custom">No Data found</a></li>
                                                                @endforelse
                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Certification/Licence Number :</strong>
                                                             <span class="">{{ $crna_licence_num }}</span>                                                  
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Expiry :</strong>
                                                             <span class="">{{ $crna_licence_expiry }}</span>                                                  
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Certification/Licence Image :</strong>
                                                            @if($crna_file)
                                                            <a href="{{ asset('uploads/'.$crna_file) }}" target="_blank">
                                                                <span class="text-success">View Image</span>
                                                            </a>  
                                                            @else  
                                                            <span class="">No Image</span> 
                                                            @endif                                           
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($educationData->cnm_data && $educationData->cnm_data != 'null')
                                                    @php 
                                                        $cnm_data_ids = json_decode($educationData->cnm_data, true); // Decode the acls_data field into an array
                                                        $cnmData = json_decode($cnm_data_ids['cnm_data'], true);
                                                        $cnm_licence_num = $cnm_data_ids['cnm_licence_num'];
                                                        $cnm_licence_expiry = $cnm_data_ids['cnm_licence_expiry'];                                      
                                                        $cnm_file = $cnm_data_ids['cnm_file'];
                                                    @endphp
                                                    
                                                     <div class="col-md-12 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>CNM (Certified Nurse Midwife) :</strong>
                                                            
                                                            <?php
                                                                $cnm_datas = DB::table("professional_certificate_table")
                                                                                ->where("cert_id", "16")
                                                                                ->get();
                                                            ?>
                                                            <ul class="dropdown-list">
                                                                @forelse($cnm_datas as $cnm_data)
                                                                    @if(is_array($cnm_data_ids) && in_array($cnm_data->professionalcert_id,$cnmData))
                                                                        <li><span class="dropdown-item-custom">{{ $cnm_data->name }} , </span></li>
                                                                    @endif
                                                                @empty
                                                                    <li><a href="#" class="dropdown-item-custom">No Data found</a></li>
                                                                @endforelse
                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Certification/Licence Number :</strong>
                                                             <span class="">{{ $cnm_licence_num }}</span>                                                  
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Expiry :</strong>
                                                             <span class="">{{ $cnm_licence_expiry }}</span>                                                  
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Certification/Licence Image :</strong>
                                                            @if($cnm_file)
                                                            <a href="{{ asset('uploads/'.$cnm_file) }}" target="_blank">
                                                                <span class="text-success">View Image</span>
                                                            </a>  
                                                            @else  
                                                            <span class="">No Image</span> 
                                                            @endif                                           
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($educationData->ons_data && $educationData->ons_data != 'null')
                                                    @php 
                                                        $ons_data_ids = json_decode($educationData->ons_data, true); // Decode the acls_data field into an array
                                                        $onsData = json_decode($ons_data_ids['ons_data'], true);
                                                        $ons_licence_num = $ons_data_ids['ons_licence_num'];
                                                        $ons_licence_expiry = $ons_data_ids['ons_licence_expiry'];                                      
                                                        $ons_file = $ons_data_ids['ons_file'];
                                                    @endphp
                                                    
                                                     <div class="col-md-12 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>ONS/ONCC (Oncology Nursing Society/Oncology Nursing Certification Corporation) :</strong>
                                                            
                                                            <?php
                                                                $ons_datas = DB::table("professional_certificate_table")
                                                                                ->where("cert_id", "17")
                                                                                ->get();
                                                            ?>
                                                            <ul class="dropdown-list">
                                                                @forelse($ons_datas as $ons_data)
                                                                    @if(is_array($ons_data_ids) && in_array($ons_data->professionalcert_id,$onsData))
                                                                        <li><span class="dropdown-item-custom">{{ $ons_data->name }} , </span></li>
                                                                    @endif
                                                                @empty
                                                                    <li><a href="#" class="dropdown-item-custom">No Data found</a></li>
                                                                @endforelse
                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Certification/Licence Number :</strong>
                                                             <span class="">{{ $ons_licence_num }}</span>                                                  
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Expiry :</strong>
                                                             <span class="">{{ $ons_licence_expiry }}</span>                                                  
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Certification/Licence Image :</strong>
                                                            @if($cnm_file)
                                                            <a href="{{ asset('uploads/'.$ons_file) }}" target="_blank">
                                                                <span class="text-success">View Image</span>
                                                            </a>  
                                                            @else  
                                                            <span class="">No Image</span> 
                                                            @endif                                           
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($educationData->msw_data && $educationData->msw_data != 'null')
                                                    @php 
                                                        $msw_data_ids = json_decode($educationData->msw_data, true); // Decode the acls_data field into an array
                                                        $mswData = json_decode($msw_data_ids['msw_data'], true);
                                                        $msw_licence_num = $msw_data_ids['msw_licence_num'];
                                                        $msw_licence_expiry = $msw_data_ids['msw_licence_expiry'];                                      
                                                        $msw_file = $msw_data_ids['msw_file'];
                                                    @endphp
                                                    
                                                     <div class="col-md-12 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>MSW/AiM (Maternity Support Worker/Assistant in Midwifery ) / Midwife Assistant :</strong>
                                                            
                                                            <?php
                                                                $msw_datas = DB::table("professional_certificate_table")
                                                                                ->where("cert_id", "18")
                                                                                ->get();
                                                            ?>
                                                            <ul class="dropdown-list">
                                                                @forelse($msw_datas as $msw_data)
                                                                    @if(is_array($msw_data_ids) && in_array($msw_data->professionalcert_id,$mswData))
                                                                        <li><span class="dropdown-item-custom">{{ $msw_data->name }} , </span></li>
                                                                    @endif
                                                                @empty
                                                                    <li><a href="#" class="dropdown-item-custom">No Data found</a></li>
                                                                @endforelse
                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Certification/Licence Number :</strong>
                                                             <span class="">{{ $msw_licence_num }}</span>                                                  
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Expiry :</strong>
                                                             <span class="">{{ $msw_licence_expiry }}</span>                                                  
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Certification/Licence Image :</strong>
                                                            @if($msw_file)
                                                            <a href="{{ asset('uploads/'.$msw_file) }}" target="_blank">
                                                                <span class="text-success">View Image</span>
                                                            </a>  
                                                            @else  
                                                            <span class="">No Image</span> 
                                                            @endif                                           
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($educationData->ain_data && $educationData->ain_data != 'null')
                                                    @php 
                                                        $ain_data_ids = json_decode($educationData->ain_data, true); // Decode the acls_data field into an array
                                                        $ainData = json_decode($ain_data_ids['ain_data'], true);
                                                        $ain_licence_num = $ain_data_ids['ain_licence_num'];
                                                        $ain_licence_expiry = $ain_data_ids['ain_licence_expiry'];                                      
                                                        $ain_file = $ain_data_ids['ain_file'];
                                                    @endphp
                                                    
                                                     <div class="col-md-12 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>AIN (Assistant in Nursing) / NA (Nurse Associate) / HCA (Healthcare Assistant) :</strong>
                                                            
                                                            <?php
                                                                $ain_datas = DB::table("professional_certificate_table")
                                                                                ->where("cert_id", "19")
                                                                                ->get();
                                                            ?>
                                                            <ul class="dropdown-list">
                                                                @forelse($ain_datas as $ain_data)
                                                                    @if(is_array($ain_data_ids) && in_array($ain_data->professionalcert_id,$ainData))
                                                                        <li><span class="dropdown-item-custom">{{ $ain_data->name }} , </span></li>
                                                                    @endif
                                                                @empty
                                                                    <li><a href="#" class="dropdown-item-custom">No Data found</a></li>
                                                                @endforelse
                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Certification/Licence Number :</strong>
                                                             <span class="">{{ $ain_licence_num }}</span>                                                  
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Expiry :</strong>
                                                             <span class="">{{ $ain_licence_expiry }}</span>                                                  
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Certification/Licence Image :</strong>
                                                            @if($ain_file)
                                                            <a href="{{ asset('uploads/'.$ain_file) }}" target="_blank">
                                                                <span class="text-success">View Image</span>
                                                            </a>  
                                                            @else  
                                                            <span class="">No Image</span> 
                                                            @endif                                           
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($educationData->rpn_data && $educationData->rpn_data != 'null')
                                                    @php 
                                                        $rpn_data_ids = json_decode($educationData->rpn_data, true); // Decode the acls_data field into an array
                                                        $rpnData = json_decode($rpn_data_ids['rpn_data'], true);
                                                        $rpn_licence_num = $rpn_data_ids['rpn_licence_num'];
                                                        $rpn_licence_expiry = $rpn_data_ids['rpn_licence_expiry'];                                      
                                                        $rpn_file = $rpn_data_ids['rpn_file'];
                                                    @endphp
                                                    
                                                     <div class="col-md-12 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>RPN (Registered Practical Nurse) / RGN (Registered General Nurse) :</strong>
                                                            
                                                            <?php
                                                                $rpn_datas = DB::table("professional_certificate_table")
                                                                                ->where("cert_id", "20")
                                                                                ->get();
                                                            ?>
                                                            <ul class="dropdown-list">
                                                                @forelse($rpn_datas as $rpn_data)
                                                                    @if(is_array($rpn_data_ids) && in_array($rpn_data->professionalcert_id,$rpnData))
                                                                        <li><span class="dropdown-item-custom">{{ $rpn_data->name }} , </span></li>
                                                                    @endif
                                                                @empty
                                                                    <li><a href="#" class="dropdown-item-custom">No Data found</a></li>
                                                                @endforelse
                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Certification/Licence Number :</strong>
                                                             <span class="">{{ $rpn_licence_num }}</span>                                                  
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Expiry :</strong>
                                                             <span class="">{{ $rpn_licence_expiry }}</span>                                                  
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Certification/Licence Image :</strong>
                                                            @if($rpn_file)
                                                            <a href="{{ asset('uploads/'.$rpn_file) }}" target="_blank">
                                                                <span class="text-success">View Image</span>
                                                            </a>  
                                                            @else  
                                                            <span class="">No Image</span> 
                                                            @endif                                           
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($educationData->nl_data && $educationData->nl_data != 'null')
                                                    @php 
                                                        $nl_data_ids = json_decode($educationData->nl_data, true); // Decode the acls_data field into an array
                                                        $nlData = json_decode($nl_data_ids['nl_data'], true);
                                                        $nl_licence_num = $nl_data_ids['nl_licence_num'];
                                                        $nl_licence_expiry = $nl_data_ids['nl_licence_expiry'];                                      
                                                        $nl_file = $nl_data_ids['nl_file'];
                                                    @endphp
                                                    
                                                     <div class="col-md-12 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>No License/Certification :</strong>
                                                            
                                                            <?php
                                                                $nl_datas = DB::table("professional_certificate_table")
                                                                                ->where("cert_id", "21")
                                                                                ->get();
                                                            ?>
                                                            <ul class="dropdown-list">
                                                                @forelse($nl_datas as $nl_data)
                                                                    @if(is_array($nl_data_ids) && in_array($nl_data->professionalcert_id,$nlData))
                                                                        <li><span class="dropdown-item-custom">{{ $nl_data->name }} , </span></li>
                                                                    @endif
                                                                @empty
                                                                    <li><a href="#" class="dropdown-item-custom">No Data found</a></li>
                                                                @endforelse
                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Certification/Licence Number :</strong>
                                                             <span class="">{{ $nl_licence_num }}</span>                                                  
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Expiry :</strong>
                                                             <span class="">{{ $nl_licence_expiry }}</span>                                                  
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Certification/Licence Image :</strong>
                                                            @if($nl_file)
                                                            <a href="{{ asset('uploads/'.$nl_file) }}" target="_blank">
                                                                <span class="text-success">View Image</span>
                                                            </a>  
                                                            @else  
                                                            <span class="">No Image</span> 
                                                            @endif                                           
                                                        </div>
                                                    </div>
                                                @endif





                                                @if($educationData->licence_number && $educationData->country &&
                                                $educationData->state && $educationData->expiration_date )
                                                <h4  class="mt-4 fw-bolder fs-6 lh-base d-flex align-items-center">Licenses: </h4>
                                               
                                                <div class="col-md-6 mt-3">
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <strong>licence_number : </strong>
                                                         <span class="">{{ $educationData->licence_number }}</span>   
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mt-3">
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <strong>Country : </strong>
                                                        <span class="">{{$educationData->country}} </span>   
                                                         {{-- <span class="">{{country_name($educationData->country)}} </span>    --}}
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mt-3">
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <strong>State : </strong>
                                                         <span class="">{{ state_name( $educationData->state)}}</span>   
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mt-3">
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <strong>Expiration Date : </strong>
                                                         <span class="">{{ \Carbon\Carbon::parse($educationData->expiration_date)->format('d/m/Y') }}</span>   
                                                    </div>
                                                </div>
                                                @endif
                                                  @if($educationData->training_courses != null )
                                                @php 
                                                    // $training_workshops = json_decode($educationData->training_workshops);
                                                @endphp
                                               
                                                <h4  class="mt-4 fw-bolder fs-6 lh-base d-flex align-items-center">Additional Training :</h4>
                                                {{-- <div class="col-md-6 mt-3">
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <strong>Courses : </strong>
                                                         <ul class="dropdown-list">
                                                            @forelse($training_courses as $key => $value)
                                                                <li><span class="dropdown-item-custom">{{ training_name_by_id($value) }} , </span></li>
                                                            @empty
                                                                <li><a href="#" class="dropdown-item-custom"></a></li>
                                                            @endforelse
                                                        </ul>  
                                                    </div>
                                                </div> --}}
                                                
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
                    <div class="tab-pane p-3" id="navpill-4" role="tabpanel">
                        <div class="row">
                            <div class=" w-100  overflow-hidden">
                                <div class="card-body p-3 px-md-4 pb-0">
                                    <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Experience</h3>
                                </div>
                                <div class="card-body p-3 px-md-4">
                                    <div class="col-md-12">
                                            @if($experienceData)
                                                <div class="row">
                                                    @if(isset($profileData->assistent_level))
                                                    
                                                    @php
                                                    $levels = [
                                                            1 => '1st Year', 2 => '2nd Year', 3 => '3rd Year', 4 => '4th Year', 
                                                            5 => '5th Year', 6 => '6th Year', 7 => '7th Year', 8 => '8th Year', 
                                                            9 => '9th Year', 10 => '10th Year', 11 => '11th Year', 12 => '12th Year', 
                                                            13 => '13th Year', 14 => '14th Year', 15 => '15th Year', 16 => '16th Year', 
                                                            17 => '17th Year', 18 => '18th Year', 19 => '19th Year', 20 => '20th Year', 
                                                            21 => '21st Year', 22 => '22nd Year', 23 => '23rd Year', 24 => '24th Year', 
                                                            25 => '25th Year', 26 => '26th Year', 27 => '27th Year', 28 => '28th Year', 
                                                            29 => '29th Year', 30 => '30th Year'
                                                        ];
                                                        $expre = $levels[$profileData->assistent_level] ?? '30th Year';
                                                    @endphp 
                                                    
                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Total Year of Experience : </strong><span>{{ $expre }}</span>
                                                        </div>
                                                    </div>
                                                    @endif

                                                    <?php
                                                        if(!empty($experienceData)){
                                                        $work_experience_data = json_decode($experienceData->work_experience);
                                                        }else{
                                                        $work_experience_data = "";
                                                        }

                                                    ?>
                                                    
                                                    @if(!empty($work_experience_data))
                                                       <?php
                                                        $i = 1;
                                                        ?>
                                                        @foreach($work_experience_data as $w_data)
                                                         <h4 class="mt-4 fw-bolder fs-6 lh-base d-flex align-items-center ">Previous Employers {{ $i }}: </h4>
                                                        <div class="col-md-6 mt-3">
                                                            <div class="d-flex gap-3 flex-wrap">
                                                                <strong>Names :</strong>
                                                                </strong><span>{{ $w_data->previous_employer_name1 }}</span>
                                                            </div>                
                                                        </div>
                                                        <div class="col-md-6 mt-3">
                                                            <div class="d-flex gap-3 flex-wrap">
                                                                <strong>Position Held : </strong>
                                                                <span>
                                                                    @if($w_data->positions_held1 == "Team Member")
                                                                        Team Member
                                                                    @elseif($w_data->positions_held1 == "Team Leader")
                                                                        Team Leader
                                                                    @elseif($w_data->positions_held1 == "Educator")
                                                                        Educator
                                                                    @elseif($w_data->positions_held1 == "Manager")
                                                                        Manager
                                                                    @elseif($w_data->positions_held1 == "Clinical Specialist")
                                                                        Clinical Specialist
                                                                    @else
                                                                        No position selected
                                                                    @endif
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mt-3">
                                                            <div class="d-flex gap-3 flex-wrap">
                                                                <strong>Employment Start Date : </strong>
                                                                <span>{{ \Carbon\Carbon::parse($w_data->start_date1 )->format('d/m/Y') }}</span>
                                                            </div>
                                                       </div>
                                                       <div class="col-md-6 mt-3">
                                                            <div class="d-flex gap-3 flex-wrap">
                                                                <strong>Employment End Date : </strong>
                                                                <span>{{ \Carbon\Carbon::parse($w_data->end_date1)->format('d/m/Y') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mt-3">
                                                            <div class="d-flex gap-3 flex-wrap">
                                                                <strong>Employment type : </strong>
                                                                <span>
                                                                @if($w_data->employeement_type1 == "Agency")
                                                                    Agency
                                                                @else
                                                                    Staffing Agency
                                                                @endif
                                                                </span>                                                        
                                                            </div>
                                                        </div>

                                                        <h4 class="mt-4 fw-bolder fs-6 lh-base d-flex align-items-center ">Detailed Job Descriptions :</h4>
                                                        <div class="col-md-6 mt-3">
                                                            <div class="d-flex gap-3 flex-wrap">
                                                                <strong>Responsibilities :</strong>
                                                                <textarea  style="resize: none;" id="visa_grant_number" name="visa_grant_number" class="form-control" rows="2" readonly>{{ $w_data->job_responeblities1 }}</textarea>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 mt-3">
                                                            <div class="d-flex gap-3 flex-wrap">
                                                                <strong>Achievements :</strong>
                                                                <textarea  style="resize: none;" id="visa_grant_number" name="visa_grant_number" class="form-control" rows="2" readonly>{{ $w_data->achievements1 }}</textarea>
                                                            </div>
                                                       </div>
                                                        <?php
                                                        $i++;
                                                        ?>
                                                        @endforeach

                                                    @endif

                                                   
                                                    @if(isset($experienceData->skills_compantancies) && $experienceData->skills_compantancies)
                                                     <h4 class="mt-4 fw-bolder fs-6 lh-base d-flex align-items-center">Areas of Expertise :</h4>
                                                     @php $skills_compantancies=json_decode($experienceData->skills_compantancies); @endphp
                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong>Specific skills and competencies : </strong>
                                                            <span>{{ skill_name_by_id($skills_compantancies)}}</span>
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
                                    <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Mandatory Training</h3>
                                </div>
                                <div class="card-body p-3 px-md-4">
                                    <div class="col-md-12">
                                        @if($mandatorytrainingData)
                                        <div class="row">
                                            <h4>Completed training programs</h4>
                                            @if(isset($mandatorytrainingData->start_date) && $mandatorytrainingData->start_date)
                                            <div class="col-md-6 mt-3">
                                                <div class="d-flex gap-3 flex-wrap">
                                                    <strong>Training Start Date : </strong><span>{{ \Carbon\Carbon::parse($mandatorytrainingData->start_date)->format('d/m/Y') }}</span>
                                                </div>
                                            </div>
                                            @endif
                                            @if(isset($mandatorytrainingData->end_date) && $mandatorytrainingData->end_date)
                                            <div class="col-md-6 mt-3">
                                                <div class="d-flex gap-3 flex-wrap">
                                                    <strong>Training End Date : </strong><span>{{ \Carbon\Carbon::parse($mandatorytrainingData->end_date)->format('d/m/Y') }}</span>
                                                </div>
                                            </div>
                                            @endif

                                            @if(isset($mandatorytrainingData->institutions) && $mandatorytrainingData->institutions)
                                            <div class="col-md-6 mt-3">
                                                <div class="d-flex gap-3 flex-wrap">
                                                    <strong>Institution: </strong>
                                                    <span>{{$mandatorytrainingData->institutions}}</span>
                                                </div>
                                            </div>
                                            @endif
                                            @if(isset($mandatorytrainingData->continuing_education) && $mandatorytrainingData->continuing_education)
                                            <div class="col-md-6 mt-3">
                                                <div class="d-flex gap-3 flex-wrap">
                                                    <strong>Mandatory Continuing Education: </strong>
                                                    <span>{{$mandatorytrainingData->continuing_education}}</span>
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
                    <div class="tab-pane p-3" id="navpill-6" role="tabpanel">
                        <div class="row">
                            <div class=" w-100  overflow-hidden">
                                <div class="card-body p-3 px-md-4 pb-0">
                                    <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Vaccinations</h3>
                                </div>
                                <div class="card-body p-3 px-md-4">
                                    <div class="col-md-12">
                                        @if($vaccinationData)
                                        <div class="row">
                                            {{-- <h4>Completed training programs</h4> --}}
                                            @if(isset($vaccinationData->vaccination_records) && $vaccinationData->vaccination_records)
                                            <div class="col-md-12 mt-3">
                                                <div class="d-flex gap-3 flex-wrap">
                                                    <strong>Vaccination Records : </strong>
                                                    <?php $vaccinations = json_decode($vaccinationData->vaccination_records) ;?>
                                                    <ul class="dropdown-list">
                                                        @forelse($vaccinations as $key => $value)
                                                            <li><span class="dropdown-item-custom">{{ vaccination_name_by_id($value) }} , </span></li>
                                                        @empty
                                                            <li><a href="#" class="dropdown-item-custom"></a></li>
                                                        @endforelse
                                                    </ul>
                                            </div>
                                            </div>
                                            @endif
                                            @if(isset($vaccinationData->immunization_status) && $vaccinationData->immunization_status)
                                            <div class="col-md-6 mt-3">
                                                <div class="d-flex gap-3 flex-wrap">
                                                    <strong>Immunization Status : </strong>
                                                     <span>{{$vaccinationData->immunization_status}}</span>
                                                    {{-- <ul class="dropdown-list">
                                                        @forelse($vaccinationData->immunization_status as $key => $value)
                                                            <li><span class="dropdown-item-custom">{{ $value }} , </span></li>
                                                        @empty
                                                            <li><a href="#" class="dropdown-item-custom"></a></li>
                                                        @endforelse
                                                    </ul> --}}
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
                    <div class="tab-pane p-3" id="navpill-7" role="tabpanel">
                        <div class="row">
                            <div class=" w-100  overflow-hidden">
                                <div class="card-body p-3 px-md-4 pb-0">
                                    <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Work Clearances</h3>
                                </div>
                                <div class="card-body p-3 px-md-4">
                                    <div class="col-md-12">
                                            @if($eligibilityToWorkData)
                                                <div class="row">
                                                    <h4 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Eligibility For Work : </h4>
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
                                                            <span>{{country_name_new($eligibilityToWorkData->passport_country_of_Issue)}}</span>
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
                                                    <h4 class="fw-bolder fs-6 lh-base d-flex align-items-center mt-3">Working With Children Check : </h4>
                                                    @if($workingChildrenCheckData)
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

                                                    @else
                                                    <div class="col-md-12">
                                                        <div class="text-center text-danger fs-5">No data found</div>
                                                    </div>
                                                    
                                                    @endif
                                                    <h4 class="fw-bolder fs-6 lh-base d-flex align-items-center mt-3">Police check : </h4>
                                                    @if($policeCheckVerificationData)           
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
                                
                                                     
                                                    @else
                                                    <div class="col-md-12">
                                                        <div class="text-center text-danger fs-5">No data found</div>
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
                    <div class="tab-pane p-3" id="navpill-8" role="tabpanel">
                        <div class="row">
                            <div class=" w-100  overflow-hidden">
                                <div class="card-body p-3 px-md-4 pb-0">
                                    <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Professional Memberships</h3>
                                </div>
                                <div class="card-body p-3 px-md-4">
                                    <div class="col-md-12">
                                         @if($proMembershipData)
                                        <div class="row">
                                            @if(isset($proMembershipData->des_profession_association) && $proMembershipData->des_profession_association)
                                            <?php $data = json_decode($proMembershipData->des_profession_association,true)?>
                                            <div class="col-md-12 mt-3">
                                                <div class="d-flex gap-3 flex-wrap">
                                                    <strong>Professional Associations : </strong>
                                                    <ul class="dropdown-list">
                                                        @forelse($data as $key => $value)
                                                            <li><span class="dropdown-item-custom">{{ $value }} , </span></li>
                                                        @empty
                                                            <li><a href="#" class="dropdown-item-custom"></a></li>
                                                        @endforelse
                                                    </ul> 
                                                </div>
                                            </div>
                                            @endif
                                            @if(isset($proMembershipData->membership_numbers) && $proMembershipData->membership_numbers)
                                            <div class="col-md-6 mt-3">
                                                <div class="d-flex gap-3 flex-wrap">
                                                    <strong>Membership Numbers : </strong><span>{{ $proMembershipData->membership_numbers }}</span>
                                                </div>
                                            </div>
                                            @endif

                                            @if(isset($proMembershipData->membership_status) && $proMembershipData->membership_status)
                                            <div class="col-md-6 mt-3">
                                                <div class="d-flex gap-3 flex-wrap">
                                                    <strong>Status: </strong>
                                                    <span>{{$proMembershipData->membership_status}}</span>
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
                    <div class="tab-pane p-3" id="navpill-9" role="tabpanel">
                        <div class="row">
                            <div class=" w-100  overflow-hidden">
                                <div class="card-body p-3 px-md-4 pb-0">
                                    <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center">Interview and References</h3>
                                </div>
                                <div class="card-body p-3 px-md-4">
                                    <div class="col-md-12">
                                        @if($interviewrefData)
                                        <div class="row">
                                          
                                            @if(isset($interviewrefData->interview_availablity) && $interviewrefData->interview_availablity)
                                            <div class="col-md-6 mt-3">
                                                <div class="d-flex gap-3 flex-wrap">
                                                    <strong>Interview Availability : </strong><span>{{ \Carbon\Carbon::parse($interviewrefData->interview_availablity)->format('d/m/y H:i') }}</span>
                                                </div>
                                            </div>
                                            @endif
                                            @if(isset($interviewrefData->reference_name) && $interviewrefData->reference_name)
                                              <h4 class="mt-4 fw-bolder fs-6 lh-base d-flex align-items-center">Professional References</h4>
                                            <div class="col-md-6 mt-3">
                                                <div class="d-flex gap-3 flex-wrap">
                                                    <strong>Names : </strong><span>{{ $interviewrefData->reference_name }}</span>
                                                </div>
                                            </div>
                                            @endif

                                            @if(isset($interviewrefData->reference_email) && $interviewrefData->reference_email)
                                            <div class="col-md-6 mt-3">
                                                <div class="d-flex gap-3 flex-wrap">
                                                    <strong>Email: </strong>
                                                    <span>{{$interviewrefData->reference_email}}</span>
                                                </div>
                                            </div>
                                            @endif
                                            @if(isset($interviewrefData->contact_country_code) && $interviewrefData->contact_country_code)
                                            <div class="col-md-6 mt-3">
                                                <div class="d-flex gap-3 flex-wrap">
                                                    <strong>Mobile Number : </strong>
                                                    <span>+{{ $interviewrefData->contact_country_code }}{{ " "}}
                                                             {{ $interviewrefData->reference_contact }}</span>
                                                </div>
                                            </div>
                                            @endif  
                                            @if(isset($interviewrefData->reference_relationship) && $interviewrefData->reference_relationship)
                                            <div class="col-md-6 mt-3">
                                                <div class="d-flex gap-3 flex-wrap">
                                                    <strong>Relationship : </strong>
                                                    <span>{{ $interviewrefData->reference_relationship }}</span>
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
                    <div class="tab-pane p-3" id="navpill-10" role="tabpanel">
                        <div class="row">
                            <div class=" w-100  overflow-hidden">
                                <div class="card-body p-3 px-md-4 pb-0">
                                    <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center">Personal Preferences</h3>
                                </div>
                                <div class="card-body p-3 px-md-4">
                                    <div class="col-md-12">
                                        @if($personalprefData)
                                        <div class="row">
                                          
                                            @if(isset($personalprefData->preferred_work_schedule) && $personalprefData->preferred_work_schedule)
                                            <div class="col-md-6 mt-3">
                                                <div class="d-flex gap-3 flex-wrap">
                                                    <strong>Preferred Work Schedule : </strong><span>{{ $personalprefData->preferred_work_schedule }}</span>
                                                </div>
                                            </div>
                                            @endif
                                            @if(isset($personalprefData->country) && $personalprefData->country)
                                              <h4 class="mt-4 fw-bolder fs-6 lh-base d-flex align-items-center">Preferred Work Locations</h4>
                                            <div class="col-md-6 mt-3">
                                                <div class="d-flex gap-3 flex-wrap">
                                                    <strong>Country : </strong><span>{{ country_name($personalprefData->country)}}</span>
                                                </div>
                                            </div>
                                            @endif

                                            @if(isset($personalprefData->state) && $personalprefData->state)
                                            <div class="col-md-6 mt-3">
                                                <div class="d-flex gap-3 flex-wrap">
                                                    <strong>State: </strong>
                                                    <span>{{ state_name($personalprefData->state)}}</span>
                                                </div>
                                            </div>
                                            @endif
                                             
                                            @if(isset($personalprefData->work_environment) && $personalprefData->work_environment)
                                            <div class="col-md-6 mt-3">
                                                <div class="d-flex gap-3 flex-wrap">
                                                    <strong>Work Environment Preferences : </strong>
                                                    <span>{{ $personalprefData->work_environment }}</span>
                                                </div>
                                            </div>
                                            @endif  
                                            @if(isset($personalprefData->shift_preferences) && $personalprefData->shift_preferences)
                                            <div class="col-md-6 mt-3">
                                                <div class="d-flex gap-3 flex-wrap">
                                                    <strong>Shift Preferences : </strong>
                                                    <span>{{ $personalprefData->shift_preferences }}</span>
                                                </div>
                                            </div>
                                            @endif  
                                            @if(isset($personalprefData->specific_facilities) && $personalprefData->specific_facilities)
                                            <div class="col-md-6 mt-3">
                                                <div class="d-flex gap-3 flex-wrap">
                                                    <strong>Specific Facilities : </strong>
                                                    <textarea name="specific_facilities" class="form-control">{{ $personalprefData->specific_facilities }}</textarea>
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
                    <div class="tab-pane p-3" id="navpill-11" role="tabpanel">
                        <div class="row">
                            <div class=" w-100  overflow-hidden">
                                <div class="card-body p-3 px-md-4 pb-0">
                                    <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center">Find Work Preferences</h3>
                                </div>
                                <div class="card-body p-3 px-md-4">
                                    <div class="col-md-12">
                                        @if($findworkData)
                                        <div class="row">
                                          
                                            @if(isset($findworkData->desired_job_role) && $findworkData->desired_job_role)
                                            <?php 
                                              $desired_job_roles = json_decode($findworkData->desired_job_role);
                                            ?>
                                            <div class="col-md-12 mt-3">
                                               
                                                <div class="d-flex gap-3 flex-wrap">
                                                     <strong>Desired Job Role : </strong>
                                                   <ul class="dropdown-list">
                                                        @forelse($desired_job_roles as $key => $desired_job_role)
                                                            <li><span class="dropdown-item-custom">{{ specialty_name_by_id_NEW($desired_job_role) }} , </span></li>
                                                        @empty
                                                            <li><a href="#" class="dropdown-item-custom">No specialties available</a></li>
                                                        @endforelse
                                                  </ul>
                                                </div>
                                            </div>
                                            @endif
                                            

                                            @if(isset($findworkData->benefits_preferences) && $findworkData->benefits_preferences)
                                            <div class="col-md-12 mt-3">
                                                <div class="d-flex gap-3 flex-wrap">
                                                    <strong>Benefits Preferences : </strong>
                                                    <?php 
                                                        $benefits_preferences = json_decode($findworkData->benefits_preferences);
                                                        ?>
                                                    <ul class="dropdown-list">
                                                        @forelse($benefits_preferences as $key => $benefits_prefere)
                                                            <li><span class="dropdown-item-custom">{{ $benefits_prefere }} , </span></li>
                                                        @empty
                                                            <li><a href="#" class="dropdown-item-custom">No specialties available</a></li>
                                                        @endforelse
                                                  </ul>
            
                                                </div>
                                            </div>
                                            @endif  
                                            @if(isset($findworkData->salary_expectations) && $findworkData->salary_expectations)
                                              {{-- <h4 class="mt-4 fw-bolder fs-6 lh-base d-flex align-items-center">Preferred Work Locations</h4> --}}
                                            <div class="col-md-6 mt-3">
                                                <div class="d-flex gap-3 flex-wrap">
                                                    <strong>Salary Expectations : </strong><span>{{ $findworkData->salary_expectations}}</span>
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
            </div>
        </div>

    </div>
@endsection
@section('js')
    <script type="text/javascript"
        src="https://nextjs.webwiders.in/pindrow/public/advertiser/dist/libs/owl.carousel/dist/owl.carousel.min.js">
    </script>
    @include('admin.script');
    <script type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            // cate_1
            $('#cat_1').after(sugical_care);
            $('#sugical_care').after(Operating_Room);
            $('#Operating_Room').after(paediatric_oR);
            $('#paediatric_oR').after(Technician_Nurse);

            // For cat 2
            $('#cat_2').after(Surgical_Obstetrics);

            // For cat 3
            $('#cat_3').after(Neonatal_Care);
            $('#Neonatal_Care').after(Surgical_Preop);
            $('#Surgical_Preop').after(Paediatric_Operating);
            $('#Paediatric_Operating').after(Paediatric_Operating_Scout);
            $('#Paediatric_Operating_Scout').after(Paediatric_Operating_Scrub);
        });
    </script>
@endsection
