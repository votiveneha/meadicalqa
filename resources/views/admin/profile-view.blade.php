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
                <ul class="nav nav-pills nav-fill mt-4" role="tablist">
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
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#navpill-333" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span>Education and Certifications</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#navpill-444" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span>Experience</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#navpill-555" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span>Financial Details</span>
                        </a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content border mt-2">
                    <div class="tab-pane p-3 active show" id="navpill-111" role="tabpanel">
                        <div class="row">
                            <div class=" w-100  overflow-hidden">
                                <div class="card-body p-3 px-md-4 pb-0">
                                    <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Basic Details</h3>
                                </div>
                                <div class="card-body p-3 px-md-4">
                                    <div class="col-md-12">
                                        <div class="row">
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
                                            
                    
                                            @if ($profileData->specialty != 'null')
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
                                            @endif
                                        </div>
                    
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

                                        @if($profileData)
                                            <div class="row">
                                                
                                                @if ($profileData->nurseType != 'null')
                                                @php $nurseType=json_decode($profileData->nurseType); @endphp
                                                @if (is_array($nurseType))
                                                    <div class="col-md-12 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong> Profession : </strong>
                                                            <ul class="dropdown-list">
                                                                @forelse($nurseType as $key => $ubspecialty)
                                                                    <li><span class="dropdown-item-custom">{{ specialty_name_by_id($ubspecialty) }} , </span></li>
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
                                                        
                                                            $specialtyName = specialty_name_by_id($ubspecialty);
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
                                                                    <li><span class="dropdown-item-custom">{{ specialty_name_by_id($subtype) }} , </span></li>
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
                                                        <span>{{ specialty_name_by_id($ubspecialty) }} , </span>
                                                        @empty
                                                        <span></span>
                                                        @endforelse --}}

                                                        <ul class="dropdown-list">
                                                            @forelse($nurse_prac as $key => $subtype)
                                                                <li><span class="dropdown-item-custom">{{ specialty_name_by_id($subtype) }} , </span></li>
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
                    <div class="tab-pane p-3" id="navpill-333" role="tabpanel">
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
                                                
                                               <h4  class="mt-3">Educational Background</h4>
                                               @if ($profileData->degree != 'null')
                                                @php $degree = json_decode($profileData->degree); @endphp
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
                                                        <ul class="dropdown-list">
                                                            @forelse($certifications as $key => $value)
                                                                <li><span class="dropdown-item-custom">{{ $value }} , </span></li>
                                                            @empty
                                                                <li><a href="#" class="dropdown-item-custom"></a></li>
                                                            @endforelse
                                                        </ul>
                                                    </div>
                                                </div>
                                                @endif
                                                @if($educationData->licence_number && $educationData->country &&
                                                $educationData->state && $educationData->expiration_date )
                                                <h4  class="mt-3">Licenses </h4>
                                               
                                                <div class="col-md-6 mt-3">
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <strong>licence_number : </strong>
                                                         <span class="">{{ $educationData->licence_number }}</span>   
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mt-3">
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <strong>Country : </strong>
                                                         <span class="">{{country_name_new($educationData->country)}} </span>   
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
                                    <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Experience</h3>
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
                                    <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Financial Details</h3>
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
            </div>
        </div>

    </div>
@endsection
@section('js')
    <script type="text/javascript"
        src="https://nextjs.webwiders.in/pindrow/public/advertiser/dist/libs/owl.carousel/dist/owl.carousel.min.js">
    </script>
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
