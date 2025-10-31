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
            @include("admin.layouts.nurse_view_tabs")
            <div class="tab-content border mt-2">
                <div class="tab-pane p-3 active show" id="navpill-1" role="tabpanel">
                    <div class=" w-100  overflow-hidden">
                        <div class="card-body p-3 px-md-4 pb-0">
                            <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Experience</h3>
                        </div>
                        <div class="card-body p-3 px-md-4">
                            <div class="col-md-12">
                                <div class="row">
                                    
                                    @if(!empty($experienceData))
                                        <?php
                                            $i = 1;
                                        ?>
                                        @foreach($experienceData as $exp_data)
                                        <div class="col-md-12">
                                            <div class="exp_data">
                                                
                                                <h5>Work Experience {{ $i }}</h5>
                                                <?php
                                                    
                                                    
                                                    $facility_type = (array)json_decode($exp_data->facility_workplace_type);

                                                    //print_r($facility_type);

                                                    $p_memb_arr = array();
                                                    $p_memb_arr_name = array();
                                                    if(!empty($facility_type)){
                                                        foreach ($facility_type as $index => $p_memb) {
                                                            $main_facility_name = DB::table("work_enviornment_preferences")->where("prefer_id",$index)->first();
                                                            //print_r($p_memb);
                                                            $p_memb_arr_name[] = $main_facility_name->env_name;
                                                            $p_memb_arr[] = $index;
                                                        }
                                                    }

                                                    
                                                ?>
                                                <div class="facility_details col-md-12">
                                                    <?php
                                                        $get_facility_name = implode(", ",$p_memb_arr_name);    
                                                    ?>
                                                    
                                                    <div class="fac_details">
                                                        <strong>Facility / Workplace Type: </strong>
                                                        <span>{{ $get_facility_name }}</span>
                                                    </div>
                                                    @foreach ($p_memb_arr as $p_arr)
                                                    <?php
                                                        $subface_data = (array)$facility_type[$p_arr];
                                                        
                                                        $environment_name = DB::table("work_enviornment_preferences")->where("prefer_id",$p_arr)->first();
                                                        
                                                        $p_memb_arr = array();
                                                        $p_memb_arr_name = array();
                                                        if (array_key_exists(0, $subface_data)){
                                                            if(!empty($subface_data)){
                                                                foreach ($subface_data as $index => $s_data) {
                                                                    $sub_facility_name = DB::table("work_enviornment_preferences")->where("prefer_id",$s_data)->first();
                                                                    //print_r($p_memb);
                                                                    $p_memb_arr[] = $s_data;
                                                                    $p_memb_arr_name[] = $sub_facility_name->env_name;
                                                                
                                                                }
                                                                $get_subfacility_name = implode(", ",$p_memb_arr_name);
                                                                ?>
                                                                <div class="fac_details">
                                                                    <strong>{{ $environment_name->env_name }}: </strong>
                                                                    <span>{{ $get_subfacility_name }}</span>
                                                                </div>    
                                                                <?php
                                                            }
                                                        }else{
                                                            if(!empty($subface_data)){
                                                                foreach ($subface_data as $index => $s_data) {
                                                                    $sub_facility_name = DB::table("work_enviornment_preferences")->where("prefer_id",$index)->first();
                                                                    //print_r($p_memb);
                                                                    $p_memb_arr[] = $index;
                                                                    $p_memb_arr_name[] = $sub_facility_name->env_name;
                                                                
                                                                }
                                                                $get_subfacility_name = implode(", ",$p_memb_arr_name);
                                                                ?>
                                                                <div class="fac_details">
                                                                    <strong>{{ $environment_name->env_name }}: </strong>
                                                                    <span>{{ $get_subfacility_name }}</span>
                                                                </div>    
                                                                @if(array_key_exists(0, $subface_data) == false)
                                                                @if(!empty($p_memb_arr))
                                                                @foreach ($p_memb_arr as $p_arr1)
                                                                <?php
                                                                    $subface_data1 = $subface_data[$p_arr1];

                                                                    $sub_name_data = array();
                                                                    foreach ($subface_data1 as $subdata) {
                                                                        $sub_facility_name = DB::table("work_enviornment_preferences")->where("prefer_id",$subdata)->first();
                                                                        $sub_name_data[] = $sub_facility_name->env_name;
                                                                    }
                                                                    
                                                                    $environment_name = DB::table("work_enviornment_preferences")->where("prefer_id",$p_arr1)->first();
                                                                    $get_ssubfacility_name = implode(", ",$sub_name_data);
                                                                ?>
                                                                <div class="fac_details">
                                                                    <strong>{{ $environment_name->env_name }}: </strong>
                                                                    <span>{{ $get_ssubfacility_name }}</span>
                                                                </div>  
                                                                @endforeach
                                                                @endif
                                                                @endif
                                                                <?php
                                                                
                                                            }
                                                        }
                                                        
                                                    ?>
                                                    @endforeach
                                                    <div class="fac_details">
                                                        <strong>Facility / Workplace Name:</strong>
                                                        <span>{{ $exp_data->facility_workplace_name }}</span>
                                                    </div>
                                                </div>    
                                                <div class="nurse_details col-md-12 mt-3">
                                                    <div class="fac_details">
                                                        <strong>Type of Nurse:</strong>
                                                        <span>
                                                            <?php
                                                                $nurseType = json_decode($exp_data->nurseType);
                                                                $nurseType_name_arr = array();
                                                                foreach ($nurseType as $nType) {
                                                                    $nurseType_name = DB::table("practitioner_type")->where("id",$nType)->first();
                                                                    $nurseType_name_arr[] = $nurseType_name->name;
                                                                }
                                                                $get_ntype_name = implode(", ",$nurseType_name_arr);

                                                            ?>
                                                            {{ $get_ntype_name }}
                                                        </span>
                                                    </div>
                                                    @if ($exp_data->entry_level_nursing != "null")
                                                    <div class="fac_details">
                                                        <strong>Entry level nursing:</strong>
                                                        <span>
                                                            <?php
                                                                $nurseType = json_decode($exp_data->entry_level_nursing);
                                                                $nurseType_name_arr = array();
                                                                foreach ($nurseType as $nType) {
                                                                    $nurseType_name = DB::table("practitioner_type")->where("id",$nType)->first();
                                                                    $nurseType_name_arr[] = $nurseType_name->name;
                                                                }
                                                                $get_ntype_name = implode(", ",$nurseType_name_arr);

                                                            ?>
                                                            {{ $get_ntype_name }}
                                                        </span>
                                                    </div>    
                                                    @endif
                                                    @if ($exp_data->registered_nurses != "null")
                                                    <div class="fac_details">
                                                        <strong>Registered Nurses (RNs):</strong>
                                                        <span>
                                                            <?php
                                                                $nurseType = json_decode($exp_data->registered_nurses);
                                                                $nurseType_name_arr = array();
                                                                foreach ($nurseType as $nType) {
                                                                    $nurseType_name = DB::table("practitioner_type")->where("id",$nType)->first();
                                                                    $nurseType_name_arr[] = $nurseType_name->name;
                                                                }
                                                                $get_ntype_name = implode(", ",$nurseType_name_arr);

                                                            ?>
                                                            {{ $get_ntype_name }}
                                                        </span>
                                                    </div>    
                                                    @endif
                                                    @if ($exp_data->advanced_practioner != "null")
                                                    <div class="fac_details">
                                                        <strong>Advanced Practice Registered Nurses (APRNs):</strong>
                                                        <span>
                                                            <?php
                                                                $nurseType = json_decode($exp_data->advanced_practioner);
                                                                $nurseType_name_arr = array();
                                                                foreach ($nurseType as $nType) {
                                                                    $nurseType_name = DB::table("practitioner_type")->where("id",$nType)->first();
                                                                    $nurseType_name_arr[] = $nurseType_name->name;
                                                                }
                                                                $get_ntype_name = implode(", ",$nurseType_name_arr);

                                                            ?>
                                                            {{ $get_ntype_name }}
                                                        </span>
                                                    </div>    
                                                    @endif
                                                    @if ($exp_data->nurse_prac != "null")
                                                    <div class="fac_details">
                                                        <strong>Nurse Practitioner (NP):</strong>
                                                        <span>
                                                            <?php
                                                                $nurseType = json_decode($exp_data->nurse_prac);
                                                                $nurseType_name_arr = array();
                                                                foreach ($nurseType as $nType) {
                                                                    $nurseType_name = DB::table("practitioner_type")->where("id",$nType)->first();
                                                                    $nurseType_name_arr[] = $nurseType_name->name;
                                                                }
                                                                $get_ntype_name = implode(", ",$nurseType_name_arr);

                                                            ?>
                                                            {{ $get_ntype_name }}
                                                        </span>
                                                    </div>    
                                                    @endif
                                                </div>
                                                <div class="specialities_details col-md-12 mt-3">
                                                    <div class="fac_details">
                                                        <strong>Specialties:</strong>
                                                        <span>
                                                            <?php
                                                                $specialties = json_decode($exp_data->specialties);
                                                                $nurseType_name_arr = array();
                                                                foreach ($specialties as $nType) {
                                                                    $nurseType_name = DB::table("speciality")->where("id",$nType)->first();
                                                                    $nurseType_name_arr[] = $nurseType_name->name;
                                                                }
                                                                $get_ntype_name = implode(", ",$nurseType_name_arr);

                                                            ?>
                                                            {{ $get_ntype_name }}
                                                        </span>
                                                    </div>
                                                    @if ($exp_data->adults != "null")
                                                    <div class="fac_details">
                                                        <strong>Adults:</strong>
                                                        <span>
                                                            <?php
                                                                $nurseType = json_decode($exp_data->adults);
                                                                $nurseType_name_arr = array();
                                                                foreach ($nurseType as $nType) {
                                                                    $nurseType_name = DB::table("practitioner_type")->where("id",$nType)->first();
                                                                    $nurseType_name_arr[] = $nurseType_name->name;
                                                                }
                                                                $get_ntype_name = implode(", ",$nurseType_name_arr);

                                                            ?>
                                                            {{ $get_ntype_name }}
                                                        </span>
                                                    </div>    
                                                    @endif
                                                    @if ($exp_data->surgical_preoperative != "null")
                                                    <div class="fac_details">
                                                        <strong>Surgical Preoperative and Postoperative Care:</strong>
                                                        <span>
                                                            <?php
                                                                $nurseType = json_decode($exp_data->surgical_preoperative);
                                                                $nurseType_name_arr = array();
                                                                foreach ($nurseType as $nType) {
                                                                    $nurseType_name = DB::table("practitioner_type")->where("id",$nType)->first();
                                                                    $nurseType_name_arr[] = $nurseType_name->name;
                                                                }
                                                                $get_ntype_name = implode(", ",$nurseType_name_arr);

                                                            ?>
                                                            {{ $get_ntype_name }}
                                                        </span>
                                                    </div>    
                                                    @endif
                                                    @if ($exp_data->operating_room != "null")
                                                    <div class="fac_details">
                                                        <strong>Operating Room (OR):</strong>
                                                        <span>
                                                            <?php
                                                                $nurseType = json_decode($exp_data->operating_room);
                                                                $nurseType_name_arr = array();
                                                                foreach ($nurseType as $nType) {
                                                                    $nurseType_name = DB::table("practitioner_type")->where("id",$nType)->first();
                                                                    $nurseType_name_arr[] = $nurseType_name->name;
                                                                }
                                                                $get_ntype_name = implode(", ",$nurseType_name_arr);

                                                            ?>
                                                            {{ $get_ntype_name }}
                                                        </span>
                                                    </div>    
                                                    @endif
                                                    @if ($exp_data->operating_room_scout != "null")
                                                    <div class="fac_details">
                                                        <strong>Operating Room (OR): Scout (Circulating Nurse):</strong>
                                                        <span>
                                                            <?php
                                                                $nurseType = json_decode($exp_data->operating_room_scout);
                                                                $nurseType_name_arr = array();
                                                                foreach ($nurseType as $nType) {
                                                                    $nurseType_name = DB::table("practitioner_type")->where("id",$nType)->first();
                                                                    $nurseType_name_arr[] = $nurseType_name->name;
                                                                }
                                                                $get_ntype_name = implode(", ",$nurseType_name_arr);

                                                            ?>
                                                            {{ $get_ntype_name }}
                                                        </span>
                                                    </div>    
                                                    @endif
                                                    @if ($exp_data->operating_room_scrub != "null")
                                                    <div class="fac_details">
                                                        <strong>Operating Room (OR): Scrub (Technician Nurse):</strong>
                                                        <span>
                                                            <?php
                                                                $nurseType = json_decode($exp_data->operating_room_scrub);
                                                                $nurseType_name_arr = array();
                                                                foreach ($nurseType as $nType) {
                                                                    $nurseType_name = DB::table("practitioner_type")->where("id",$nType)->first();
                                                                    $nurseType_name_arr[] = $nurseType_name->name;
                                                                }
                                                                $get_ntype_name = implode(", ",$nurseType_name_arr);

                                                            ?>
                                                            {{ $get_ntype_name }}
                                                        </span>
                                                    </div>    
                                                    @endif
                                                    @if ($exp_data->maternity != "null")
                                                    <div class="fac_details">
                                                        <strong>Maternity OB/GYN/MFM:</strong>
                                                        <span>
                                                            <?php
                                                                $nurseType = json_decode($exp_data->maternity);
                                                                $nurseType_name_arr = array();
                                                                foreach ($nurseType as $nType) {
                                                                    $nurseType_name = DB::table("practitioner_type")->where("id",$nType)->first();
                                                                    $nurseType_name_arr[] = $nurseType_name->name;
                                                                }
                                                                $get_ntype_name = implode(", ",$nurseType_name_arr);

                                                            ?>
                                                            {{ $get_ntype_name }}
                                                        </span>
                                                    </div>    
                                                    @endif
                                                    {{-- @if ($exp_data->surgical_obstrics_gynacology != "null")
                                                    <div class="fac_details">
                                                        <strong>Surgical Obstetrics and Gynecology (OB/GYN):</strong>
                                                        <span>
                                                            <?php
                                                                $nurseType = json_decode($exp_data->surgical_obstrics_gynacology);
                                                                $nurseType_name_arr = array();
                                                                foreach ($nurseType as $nType) {
                                                                    $nurseType_name = DB::table("practitioner_type")->where("id",$nType)->first();
                                                                    $nurseType_name_arr[] = $nurseType_name->name;
                                                                }
                                                                $get_ntype_name = implode(", ",$nurseType_name_arr);

                                                            ?>
                                                            {{ $get_ntype_name }}
                                                        </span>
                                                    </div>    
                                                    @endif --}}
                                                    @if ($exp_data->paediatrics_neonatal != "null")
                                                    <div class="fac_details">
                                                        <strong>Paediatrics Neonatal Perinatal:</strong>
                                                        <span>
                                                            <?php
                                                                $nurseType = json_decode($exp_data->paediatrics_neonatal);
                                                                $nurseType_name_arr = array();
                                                                foreach ($nurseType as $nType) {
                                                                    $nurseType_name = DB::table("practitioner_type")->where("id",$nType)->first();
                                                                    $nurseType_name_arr[] = $nurseType_name->name;
                                                                }
                                                                $get_ntype_name = implode(", ",$nurseType_name_arr);

                                                            ?>
                                                            {{ $get_ntype_name }}
                                                        </span>
                                                    </div>    
                                                    @endif
                                                    @if ($exp_data->community != "null")
                                                    <div class="fac_details">
                                                        <strong>Community:</strong>
                                                        <span>
                                                            <?php
                                                                $nurseType = json_decode($exp_data->community);
                                                                $nurseType_name_arr = array();
                                                                foreach ($nurseType as $nType) {
                                                                    $nurseType_name = DB::table("practitioner_type")->where("id",$nType)->first();
                                                                    $nurseType_name_arr[] = $nurseType_name->name;
                                                                }
                                                                $get_ntype_name = implode(", ",$nurseType_name_arr);

                                                            ?>
                                                            {{ $get_ntype_name }}
                                                        </span>
                                                    </div>    
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                            $i++;
                                        ?>
                                        @endforeach
                                        
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