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
    <?php
    $sessid = ''; // Default value

    if (Session::has('nurseemail')) {
        $email = Session::get('nurseemail');
        $post = DB::table("users")->where('email', $email)->first();
        if ($post) {
            $sessid = $post->id;
        }
    }

    ?>
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
                    <a class="nav-link disabled" data-bs-toggle="tab" href="#tab-1" role="tab"
                        aria-selected="true">
                        <span>Basic Details</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link disabled" data-bs-toggle="tab" href="#tab-2" role="tab" aria-selected="false"
                        tabindex="-1">
                        <span>Setting</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link disabled" data-bs-toggle="tab" href="#tab-3" role="tab" aria-selected="false"
                        tabindex="-1">
                        <span>Profession</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link disabled" data-bs-toggle="tab" href="#tab-4" role="tab" aria-selected="false"
                        tabindex="-1">
                        <span>Education and Certifications</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link disabled" data-bs-toggle="tab" href="#tab-6" role="tab" aria-selected="false"
                        tabindex="-1">
                        <span>Mandatory Training</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="{{ route('admin.exptab', ['tab' => 'tab-7']) }}" tabindex="-1">
                        <span>Experience</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link disabled" data-bs-toggle="tab" href="#navpill-5.1" role="tab" aria-selected="false"
                        tabindex="-1">
                        <span>References</span>
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
                        <span>Professional</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link disabled" data-bs-toggle="tab" href="#navpill-10" role="tab" aria-selected="false"
                        tabindex="-1">
                        <span>Interview</span>
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
                        <span>Job Search & Personal Preferences</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link disabled" data-bs-toggle="tab" href="#navpill-13" role="tab" aria-selected="false"
                        tabindex="-1">
                        <span>Testimonials and Reviews</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link disabled" data-bs-toggle="tab" href="#navpill-14" role="tab" aria-selected="false"
                        tabindex="-1">
                        <span>Additional Information</span>
                    </a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content border mt-2">
                <div class="p-3">
                    <form id="experience_form" method="POST">
                        @csrf
                        <input type="hidden" name="tab" value="tab4">
                        <div class="row">
                            <div class=" w-100  overflow-hidden">
                                <div class="card-body p-3 px-md-4 pb-0">
                                    <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center">Experience</h3>
                                </div>
                                <div class="card-body p-3 px-md-4">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <h6>Please add your full nursing work experience to strengthen your profile and get hired faster. Please keep update as your experience grows:</h6>
                                            <div class="previous_employeers">
                                                <h6 class="emergency_text previous_employeers_head mt-3 fw-bolder fs-6 lh-base d-flex align-items-center">
                                                    Work Experience 1
                                                </h6>

                                                <div class="col-md-12 mt-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="input-1">Type of Nurse?</label>
                                                        <input type="hidden" name="user_id" class="user_id" value="">
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
                                                        <select class="js-example-basic-multiple addAll_removeAll_btn nurse_type_exp nurse_type_exp_1" data-list-id="type-of-nurse-experience" name="nurseType[1][]" id="nurse_type_experience_1" multiple="multiple"></select>
                                                        <span id="reqnurseTypeexpId-1" class="reqError text-danger valley"></span>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mt-3">
                                                    <div class="form-group">
                                                        @php $specialty = specialty();$spcl=$specialty[0]->id;@endphp
                                                        <?php
                                                        $i = 1;
                                                        ?>
                                                        @foreach($specialty as $spl)
                                                        <?php
                                                        $nursing_data = DB::table("practitioner_type")->where('parent', $spl->id)->orderBy('name')->get();
                                                        ?>
                                                        <input type="hidden" name="nursing_result_experience2" class="nursing_result_experience-{{ $i }}" value="{{ $spl->id }}">
                                                        <div class="nursing_data  drp--clr  d-none drpdown-set nursing_exp_{{ $spl->id }}" id="nursing_level_experience-{{ $i }}">
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

                                                <div class="col-md-12 mt-3">
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
                                                </div>

                                                <div class="col-md-12 mt-3">
                                                    <div class="form-group">
                                                        <div class="drp--clr">
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
                                                            <select class="js-example-basic-multiple addAll_removeAll_btn spec_exp spec_exp_1 specialties_experience" data-list-id="specialties_experience" name="specialties_experience[1][]" multiple="multiple"></select>
                                                        </div>
                                                        <span id="reqspecialtiesexp-1" class="reqError text-danger valley"></span>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mt-3">
                                                    <div class="form-group">
                                                        <div class="speciality_boxes result--show">
                                                            <?php
                                                            $l = 1;
                                                            ?>
                                                            @foreach($JobSpecialties as $ptl)
                                                            <?php
                                                            $speciality_data = DB::table("speciality")->where('parent', $ptl->id)->get();
                                                            ?>
                                                            <input type="hidden" name="speciality_result" class="speciality_result_experience-{{ $l }}" value="{{ $ptl->id }}">
                                                            <div class="speciality_data drp--clr drpdown-set d-none speciality_y_{{ $ptl->id }}" id="specility_level_experience-{{ $l }}">
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
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mt-3">
                                                    <div class="form-group">
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
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mt-3">
                                                    <div class="form-group">
                                                        <div class="paediatric_surgical_div_experience">
                                                            <div class="surgicalpad_row_data_experience drp--clr d-none ">
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
                                                    </div>
                                                </div>

                                                <div class="specialty_sub_boxes_experience">
                                                    <div class="col-md-12 mt-3">
                                                        <div class="form-group">
                                                            <?php
                                                            $speciality_surgical_data = DB::table("speciality")->where('parent', '96')->get();
                                                            $w = 1;
                                                            ?>
                                                            @foreach($speciality_surgical_data as $ssd)
                                                            <input type="hidden" name="speciality_result" class="speciality_surgical_result_experience-{{ $w }}" value="{{ $ssd->id }}">
                                                            <div class="surgical_row_experience-{{ $w }} surgicalopcboxes1-{{ $ssd->id }} drp--clr d-none drpdown-set">
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

                                                            </div>
                                                            <?php
                                                            $w++;
                                                            ?>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 mt-3">
                                                        <div class="form-group">
                                                            <?php
                                                            $speciality_surgical_datamater = DB::table("speciality")->where('parent', '233')->get();
                                                            $p = 1;
                                                            ?>
                                                            <div class="surgicalobs_row_experience drp--clr d-none drpdown-set">
                                                                <label class="form-label" for="input-1">Surgical Obstetrics and Gynecology (OB/GYN):</label>
                                                                <ul id="surgicalobs_row_data_experience" style="display:none;">
                                                                    @foreach($speciality_surgical_datamater as $ssd)
                                                                    <li data-value="{{ $ssd->id }}">{{ $ssd->name }}</li>
                                                                    @endforeach
                                                                </ul>
                                                                <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="surgicalobs_row_data_experience" name="surgical_obs_care_exp[1][]" multiple="multiple"></select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 mt-3">
                                                        <div class="form-group">
                                                            <?php
                                                            $speciality_surgical_datamater = DB::table("speciality")->where('parent', '250')->get();

                                                            ?>
                                                            <div class="neonatal_row_experience drp--clr drpdown-set d-none">
                                                                <label class="form-label" for="input-1">Neonatal Care:</label>

                                                                <ul id="neonatal_care_experience" style="display:none;">
                                                                    @foreach($speciality_surgical_datamater as $ssd)
                                                                    <li data-value="{{ $ssd->id }}">{{ $ssd->name }}</li>
                                                                    @endforeach
                                                                </ul>
                                                                <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="neonatal_care_experience" name="neonatal_care_experience[1][]" multiple="multiple"></select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 mt-3">
                                                        <div class="form-group">
                                                            <?php
                                                            $speciality_surgical_datap = DB::table("speciality")->where('parent', '285')->get();
                                                            $q = 1;
                                                            ?>
                                                            @foreach($speciality_surgical_datap as $ssd)
                                                            <input type="hidden" name="speciality_result" class="surgical_rowp_result_experience-{{ $q }}" value="{{ $ssd->id }}">
                                                            <div class="surgical_rowp_experience surgicalpad_row_experience-{{ $ssd->id }} surgical_rowp_experience-{{ $q }} drp--clr d-none drpdown-set">
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
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mt-3">
                                                    <div class="form-group">
                                                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>What is your level of experience?</strong></label>
                                                        <select class="form-control mr-10 select-active" name="assistent_level" id="assistent_level">
                                                            @for($i = 1; $i <= 30; $i++) <option value="{{ $i }}">{{ $i }}{{ $i == 1 ? 'st' : ($i == 2 ? 'nd' : ($i == 3 ? 'rd' : 'th')) }} Year</option>
                                                                @endfor
                                                        </select>
                                                        <span id="experience_error" class="reqError text-danger valley "></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <div class="form-group level-drp">
                                                        <label class="form-label" for="input-1">Position Held</label>
                                                        <select class="form-control pos_held pos_held_1" name="positions_held[1]">
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
                                                        <span id="reqpositionheld-1" class="reqError text-danger valley"></span>

                                                    </div>
                                                </div>

                                                <div class="col-md-12 mt-3">
                                                    <div class="form-group">
                                                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Employment Start Date</strong></label>
                                                        <input class="form-control employeement_start_date_exp employeement_start_date_exp-1" type="date" name="start_date[1]" onchange="changeEmployeementEndDate(1)" onkeydown="return false">
                                                        <span id="reqempsdateexp-1" class="reqError text-danger valley"></span>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mt-3 empl_end_date-1">
                                                    <div class="form-group">
                                                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Employment End Date</strong></label>
                                                        <input class="form-control employeement_end_date_exp employeement_end_date_exp-1" type="date" name="end_date[1]" onkeydown="return false">
                                                        <span id="reqemployeementenddateexp-1" class="reqError text-danger valley"></span>
                                                    </div>
                                                </div>

                                                <div class="present_check mt-3">
                                                    <input class="currently_position currently_position-1" type="checkbox" name="present_box[1]" value="1" onclick="currently_position(1)">I am currently in this position at the moment
                                                </div>

                                                <div class="col-md-12 mt-3">
                                                    <div class="form-group">
                                                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Employment type</strong></label>
                                                        <select class="form-control emp_exp_type emp_exp_type-1" name="employeement_type[1]" onchange="ExpEmpStatus(this.value)">
                                                            <option value="">select</option>
                                                            <option value="Permanent">Permanent</option>
                                                            <option value="Temporary">Temporary</option>
                                                        </select>
                                                        <span id="reqemptype-1" class="reqError text-danger valley"></span>
                                                    </div>
                                                </div>
                                                <div class="exp_permanent" style="display: none;">
                                                    <div class="form-group col-md-12">
                                                        <label class="form-label" for="input-1">Permanent</label>
                                                        <!-- <input class="form-control" type="text" required="" name="fullname" placeholder="Steven Job"> -->
                                                        <select class="form-input mr-10 select-active" name="permanent_status[1]">
                                                            <option value="">Select</option>
                                                            <option value="Full-time">Full-time</option>
                                                            <option value="Part-time">Part-time</option>
                                                            <option value="Agency Nurse/Midwife">Agency Nurse/Midwife</option>
                                                            <option value="Freelance">Freelance</option>
                                                            <option value="Local">Local</option>
                                                            <option value="Volunteer">Volunteer</option>

                                                        </select>
                                                    </div>
                                                    <span id="reqemployee_status" class="reqError text-danger valley"></span>
                                                </div>

                                                <div class="exp_temporary" style="display: none;">
                                                    <div class="form-group col-md-12">
                                                        <label class="form-label" for="input-1">Temporary</label>
                                                        <!-- <input class="form-control" type="text" required="" name="fullname" placeholder="Steven Job"> -->
                                                        <select class="form-input mr-10 select-active" name="temporary_status[1]">
                                                            <option value="">Select</option>
                                                            <option value="Temporary">Temporary</option>
                                                            <option value="Contract">Contract</option>
                                                            <option value="Term Contract">Term Contract</option>
                                                            <option value="Travel">Travel</option>
                                                            <option value="Per Diem">Per Diem</option>
                                                            <option value="Local">Local</option>
                                                            <option value="On-Call">On-Call</option>
                                                            <option value="PRN (Pro Re Nata)">PRN (Pro Re Nata)</option>
                                                            <option value="Casual">Casual</option>
                                                            <option value="Locum tenens (temporary substitute)">Locum tenens (temporary substitute)</option>
                                                            <option value="Agency Nurse/Midwife">Agency Nurse/Midwife</option>
                                                            <option value="Seasonal">Seasonal</option>
                                                            <option value="Freelance">Freelance</option>
                                                            <option value="Internship">Internship</option>
                                                            <option value="Apprenticeship">Apprenticeship</option>
                                                            <option value="Residency">Residency</option>
                                                            <option value="Volunteer">Volunteer</option>
                                                        </select>
                                                    </div>
                                                    <span id="reqemployee_status" class="reqError text-danger valley"></span>
                                                </div>

                                                <h4 class="fw-bolder fs-6 lh-base d-flex align-items-center mt-3">Detailed Job Descriptions</h4>
                                                <div class="col-md-12 mt-3">
                                                    <div class="form-group">
                                                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Responsibilities</strong></label>
                                                        <textarea class="form-control res-exp res-exp-1" name="job_responeblities[1]"></textarea>
                                                        <span id="reqresposiblitiesexp-1" class="reqError text-danger valley"></span>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mt-3">
                                                    <div class="form-group">
                                                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Achievements</strong></label>
                                                        <textarea class="form-control ach_exp ach_exp-1" name="achievements[1]"></textarea>
                                                        <span id="reqachievementsexp-1" class="reqError text-danger valley"></span>
                                                    </div>
                                                </div>


                                                <h4 class="fw-bolder fs-6 lh-base d-flex align-items-center mt-3">Areas of Expertise</h4>


                                                <div class="col-md-12 mt-3">
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
                                                        <select class="js-example-basic-multiple addAll_removeAll_btn spe_skill spe_skill_1" data-list-id="skills_compantancies" name="skills_compantancies[1][]" multiple="multiple"></select>
                                                    </div>
                                                    <span id="reqexpertiseexp-1" class="reqError text-danger valley"></span>
                                                </div>
                                                <div class="skills_compantancies_dropdowns"></div>
                                                <div class="col-md-12 mt-3">
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
                                                        <select class="js-example-basic-multiple addAll_removeAll_btn type_of_evi type_of_evi_1" data-list-id="type_of_evidence" name="type_of_evidence[1][]" multiple="multiple"></select>
                                                        <span id="reqtype_evidenceexp-1" class="reqError text-danger valley"></span>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mt-3">
                                                    <div class="form-group">
                                                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Upload evidence</strong></label>
                                                        <input class="form-control change_evi" type="file" name="upload_evidence[1][]" multiple="" id="1">
                                                        <div class="fileList  fileList_1"></div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="add_new_certification_div awe mb-3 mt-4">
                                                <a style="cursor: pointer;" onclick="add_work_experience()">+ Add another work experience</a>
                                            </div>
                                            <div class="declaration_box">
                                                <input type="checkbox" name="exp_declare_information" class="exp_declare_information" value="1" @if(!empty($firstValue)) @if($firstValue->declaration_status == 1) checked onclick="return false;" @endif @endif>
                                                <label for="declare_information">I declare that the information provided is true and correct</label>
                                                @if(!empty($firstValue->declaration_status) && $firstValue->declaration_status == 1)
                                                <input type="hidden" name="exp_declare_information" value="1">
                                                @endif
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-3">
                                                <button type="submit" class="btn btn-default next-step-56 align-items-center justify-content-between" data-target="#navpill-6">Next</button>
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
    </div>

</div>
<div class="modal fade" id="get_new_plice_checkModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-semibold" id="exampleModalLabel">GET NEW POLICE CHECK</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="paydatadata">A Police Check is a requirement for clinical practice in Australia. As this is also your identity check, uPaged can only accept checks via our preferred partner using the link below. The Police Check costs $42.90, and once you have completed 5 uPaged shifts we will reimburse you this cost if you email your invoice to hello@medica.com. HEADS UP: This will take you up to 15 minutes You’ll need 4 identification documents</p>
            </div>
            <!-- <a href="javascript:void(0);" class="btn btn-sm mybtn p-0 px-2 m-0 " data-bs-dismiss="modal" aria-label="Close" type="button">Ok</a>   -->
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
        $('.js-example-basic-multiple').on('select2:open', function() {
            // Adding additional search box
            var searchBoxHtml = `
            <div class="extra-search-container">
                <input type="text" class="extra-search-box" placeholder="Search...">
                <button class="clear-button" type="button">&times;</button>
            </div>`;

            var buttonsHtml = `
            <div class="extra-buttons">
                <button class="select-all-button" type="button">Select All</button>
                <button class="remove-all-button" type="button">Remove All</button>
            </div>`;

            // Remove any existing elements to avoid duplication
            $('.select2-results .extra-search-container').remove();
            $('.select2-results .extra-buttons').remove();

            // Prepend search box and buttons
            $('.select2-results').prepend(buttonsHtml + searchBoxHtml);

            var $searchBox = $('.extra-search-box');
            var $clearButton = $('.clear-button');

            // Handle input event for search box
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

            // Clear button functionality
            $clearButton.on('click', function() {
                $searchBox.val('');
                $searchBox.trigger('input');
            });

            var $dropdown = $('.js-example-basic-multiple'); // Reference the dropdown

            // Handle Select All button
            $('.select-all-button').on('click', function() {
                var allValues = $dropdown.find('option').map(function() {
                    return $(this).val();
                }).get();
                $dropdown.val(allValues).trigger('change');
            });

            // Handle Remove All button
            $('.remove-all-button').on('click', function() {
                $dropdown.val(null).trigger('change');
            });
        });
    });
    // $(document).ready(function() {

    // Add an additional search box to the dropdown
    // $('.js-example-basic-multiple').on('select2:open', function() {
    //     var searchBoxHtml = `
    //     <div class="extra-search-container">
    //         <input type="text" class="extra-search-box" placeholder="Search...">
    //         <button class="clear-button" type="button">&times;</button>
    //     </div>`;

    //     if ($('.select2-results').find('.extra-search-container').length === 0) {
    //         $('.select2-results').prepend(searchBoxHtml);
    //     }

    //     var $searchBox = $('.extra-search-box');
    //     var $clearButton = $('.clear-button');

    //     $searchBox.on('input', function() {

    //         var searchTerm = $(this).val().toLowerCase();
    //         $('.select2-results__option').each(function() {
    //             var text = $(this).text().toLowerCase();
    //             if (text.includes(searchTerm)) {
    //                 $(this).show();
    //             } else {
    //                 $(this).hide();
    //             }
    //         });
    //         $clearButton.toggle($searchBox.val().length > 0);
    //     });

    //     $clearButton.on('click', function() {
    //         $searchBox.val('');
    //         $searchBox.trigger('input');
    //     });
    // });

    // });
</script>

<script>
    $(document).ready(function() {
        // $('.addAll_removeAll_btn').on('select2:open', function() {
        //     var $dropdown = $(this);
        //     // var $dropdown = $(this).data('select2').$dropdown;
        //     var searchBoxHtml = `
        //         <div class="extra-buttons">
        //             <button class="select-all-button" type="button">Select All</button>
        //             <button class="remove-all-button" type="button">Remove All</button>
        //         </div>`;

        //     // Remove any existing extra buttons before adding new ones
        //     $('.select2-results .extra-search-container').remove();
        //     $('.select2-results .extra-buttons').remove();

        //     // Append the new extra buttons and search box
        //     $('.select2-results').prepend(searchBoxHtml);

        //     // Handle Select All button for the current dropdown
        //     $('.select-all-button').on('click', function() {
        //         var $currentDropdown = $dropdown;
        //         var allValues = $currentDropdown.find('option').map(function() {
        //             return $(this).val();
        //         }).get();
        //         $currentDropdown.val(allValues).trigger('change');
        //     });

        //     // Handle Remove All button for the current dropdown
        //     $('.remove-all-button').on('click', function() {
        //         var $currentDropdown = $dropdown;
        //         $currentDropdown.val(null).trigger('change');
        //     });
        // });

    });

    $(document).ready(function() {
        // Initialize Select2 for each select element with class .js-example-basic-multiple
        $('.js-example-basic-multiple').each(function() {
            let listId = $(this).data('list-id');

            let items = [];
            console.log("listId", listId);
            $('#' + listId + ' li').each(function() {
                console.log("value", $(this).data('value'));
                items.push({
                    id: $(this).data('value'),
                    text: $(this).text()
                });
            });
            console.log("items", items);
            $(this).select2({
                data: items
            });
        });
    });
</script>

<script>
    //  for add another work exp js
    function add_work_experience() {
        var previous_employeers_head = $(".previous_employeers_head").length;
        previous_employeers_head++;
        $(".previous_employeers").append(`
            <div class="work_exp_${previous_employeers_head}">
            <h6 class="fw-bolder fs-6 lh-base d-flex align-items-center emergency_text previous_employeers_head">Work Experience ${previous_employeers_head}</h6>
            <div class="col-md-12 mt-3">
            <div class="form-group drp--clr">
                <label class="form-label" for="input-1">Type of Nurse?</label>
                <input type="hidden" name="user_id" class="user_id" value="">
                <ul id="type-of-nurse-experience-${previous_employeers_head}" style="display:none;">
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
                <select class="js-example-basic-multiple${previous_employeers_head} addAll_removeAll_btn nurse_type_exp nurse_type_exp_${previous_employeers_head}" data-list-id="type-of-nurse-experience-${previous_employeers_head}" name="nurseType[${previous_employeers_head}][]" id="nurse_type_experience_${previous_employeers_head}" multiple="multiple"></select>
            </div>
            <span id="reqnurseTypeexpId-${previous_employeers_head}" class="reqError text-danger valley"></span>
            </div>
            <div class="col-md-12 mt-3">
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
                        <input type="hidden" name="nursing_result_experience" class="nursing_result_experience-${previous_employeers_head}-{{ $i }}" value="{{ $spl->id }}">
                        <div class="nursing_data form-group drp--clr d-none drpdown-set nursing_expu_{{ $spl->id }}" id="nursing_level_experience1-${previous_employeers_head}-{{ $i }}">
                            <label class="form-label" for="input-2">{{ $spl->name }}</label>
                            <ul id="nursing_entry_experience-${previous_employeers_head}-{{ $i }}" style="display:none;">
                            @foreach($nursing_data as $nd)
                            <li data-value="{{ $nd->id }}">{{ $nd->name }}</li>
                            @endforeach
                            </ul>
                            <select class="js-example-basic-multiple${previous_employeers_head} addAll_removeAll_btn" data-list-id="nursing_entry_experience-${previous_employeers_head}-{{ $i }}" name="nursing_type_{{ $i }}[${previous_employeers_head}][]" multiple="multiple"></select>
                        </div>
                        <?php
                        $i++;
                        ?>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-3">
                <div class="np_submenu_experience_${previous_employeers_head} d-none">
                    <div class="form-group drp--clr">
                        <?php
                        $np_data = DB::table("practitioner_type")->where('parent', '179')->get();
                        ?>
                        <label class="form-label" for="input-1">Nurse Practitioner (NP):</label>
                        <ul id="nurse_practitioner_menu_experience-${previous_employeers_head}" style="display:none;">
                        @foreach($np_data as $nd)
                        <li data-value="{{ $nd->id }}">{{ $nd->name }}</li>
                        @endforeach
                        </ul>
                        <select class="js-example-basic-multiple${previous_employeers_head} addAll_removeAll_btn" data-list-id="nurse_practitioner_menu_experience-${previous_employeers_head}" name="nurse_practitioner_menu_experience[${previous_employeers_head}][]" multiple="multiple"></select>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-3">
             <div class="form-group">
                <div class="condition_set">
                    <div class="form-group drp--clr">
                        <input type="hidden" name="sub_speciality_value" class="sub_speciality_value" value="">
                        <label class="form-label" for="input-1">Specialties</label>
                        <ul id="specialties_experience-${previous_employeers_head}" style="display:none;">
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
                        <select class="js-example-basic-multiple${previous_employeers_head} addAll_removeAll_btn spec_exp spec_exp_${previous_employeers_head}" data-list-id="specialties_experience-${previous_employeers_head}" name="specialties_experience[${previous_employeers_head}][]" multiple="multiple"></select>
                    </div>
                    <span id="reqspecialtiesexp-${previous_employeers_head}" class="reqError text-danger valley"></span>
                </div>
             </div>
            </div>
            <div class="col-md-12 mt-3">
              <div class="form-group">
                <div class="speciality_boxes result--show">
                    <?php
                    $l = 1;
                    ?>
                    @foreach($JobSpecialties as $ptl)
                    <?php
                    $speciality_data = DB::table("speciality")->where('parent', $ptl->id)->get();
                    ?>
                    <input type="hidden" name="speciality_result" class="speciality_result_experience-${previous_employeers_head}-{{ $l }}" value="{{ $ptl->id }}">
                    <div class="speciality_data form-group drp--clr drpdown-set d-none col-md-12 speciality_{{ $ptl->id }}" id="specility_level_experience-${previous_employeers_head}-{{ $l }}">
                        <label class="form-label" for="input-2">{{ $ptl->name }}</label>
                        <ul id="speciality_entry_experience-${previous_employeers_head}-{{ $l }}" style="display:none;">
                        @foreach($speciality_data as $sd)
                        <li data-value="{{ $sd->id }}">{{ $sd->name }}</li>

                        @endforeach
                        </ul>
                        <select class="js-example-basic-multiple${previous_employeers_head} addAll_removeAll_btn" data-list-id="speciality_entry_experience-${previous_employeers_head}-{{ $l }}" name="speciality_entry_experience_{{ $l }}[${previous_employeers_head}][]" multiple="multiple"></select>

                    </div>
                    <?php
                    $l++;
                    ?>
                    @endforeach
                </div>
              </div>
            </div>
            <div class="specialty_entry_one_experience"></div>
            <div class="specialty_entry_two_experience"></div>
            <div class="col-md-12 mt-3">
                <div class="form-group">
                    <div class="paediatric_surgical_div_experience-${previous_employeers_head}">
                        <div class="surgicalpad_row_data_experience-${previous_employeers_head} form-group drp--clr d-none col-md-12">
                            <label class="form-label" for="input-1">Paediatric Surgical Preop. and Postop. Care:
                            </label>
                            <?php
                            $speciality_padsurgicalrow_data = DB::table("speciality")->where('parent', '285')->get();
                            $r = 1;
                            ?>
                            <ul id="surgical_rowpad_box_experience-${previous_employeers_head}" style="display:none;">
                            @foreach($speciality_padsurgicalrow_data as $ssrd)
                            <li data-value="{{ $ssrd->id }}">{{ $ssrd->name }}</li>
                            @endforeach
                            </ul>
                            <select class="js-example-basic-multiple${previous_employeers_head} addAll_removeAll_btn" data-list-id="surgical_rowpad_box_experience-${previous_employeers_head}" name="surgical_rowpad_box_experience[${previous_employeers_head}][]" multiple="multiple"></select>
                        </div>
                    </div>
                </div>
            </div>            
            <div class="specialty_sub_boxes_experience-${previous_employeers_head}">
               <div class="col-md-12 mt-3">
                    <div class="form-group">
                    <?php
                    $speciality_surgical_data = DB::table("speciality")->where('parent', '96')->get();
                    $w = 1;
                    ?>
                    @foreach($speciality_surgical_data as $ssd)
                    <input type="hidden" name="speciality_result" class="speciality_surgical_result_experience-${previous_employeers_head}-{{ $w }}" value="{{ $ssd->id }}">
                    <div class="surgical_row_experience-${previous_employeers_head}-{{ $w }} surgical_sub-${previous_employeers_head}  surgicalopcboxes-{{ $ssd->id }} form-group drp--clr d-none drpdown-set">
                        <label class="form-label" for="input-1">{{ $ssd->name }}</label>
                        <?php
                        $speciality_surgicalsub_data = DB::table("speciality")->where('parent', $ssd->id)->get();
                        ?>
                        <ul id="surgical_operative_care_experience-${previous_employeers_head}-{{ $w }}" style="display:none;">
                        @foreach($speciality_surgicalsub_data as $sssd)
                        <li data-value="{{ $sssd->id }}">{{ $sssd->name }}</li>
                        @endforeach
                        </ul>
                        <select class="js-example-basic-multiple${previous_employeers_head} addAll_removeAll_btn" data-list-id="surgical_operative_care_experience-${previous_employeers_head}-{{ $w }}" name="surgical_operative_care_exp_{{ $w }}[${previous_employeers_head}][]" multiple="multiple"></select>
                        @foreach($speciality_surgicalsub_data as $sssd)


                        <div class="d-none form-group level-drp level_id-{{ $sssd->id }}">
                        <label class="form-label" for="input-1">What is your Level of experience in {{ $sssd->name }}:

                        </label>
                        <!-- <input class="form-control" type="text" required="" name="fullname" placeholder="Steven Job"> -->
                        <select class="form-input mr-10 select-active" name="assistent_level">
                            @for($i = 1; $i <= 30; $i++) <option value="{{ $i }}">{{ $i }}{{ $i == 1 ? 'st' : ($i == 2 ? 'nd' : ($i == 3 ? 'rd' : 'th')) }} Year</option>
                            @endfor
                        </select>
                        </div>

                        @endforeach
                    </div>
                    <?php
                    $w++;
                    ?>

                    @endforeach

                    </div>
                </div>
                <div class="surgical_operative_care_level_experience"></div>
                <div class="surgical_operative_care_level_experience_two"></div>
                <div class="surgical_operative_care_level_experience_three"></div>
                <div class="col-md-12 mt-3">
                    <div class="form-group">
                        <?php
                        $speciality_surgical_datamater = DB::table("speciality")->where('parent', '233')->get();
                        $p = 1;
                        ?>
                        <div class="surgicalobs_row_experience-${previous_employeers_head} drp--clr d-none drpdown-set">
                            <label class="form-label" for="input-1">Surgical Obstetrics and Gynecology (OB/GYN):</label>
                            <ul id="surgicalobs_row_data_experience-${previous_employeers_head}" style="display:none;">
                                @foreach($speciality_surgical_datamater as $ssd)
                                <li data-value="{{ $ssd->id }}">{{ $ssd->name }}</li>
                                @endforeach
                            </ul>
                            <select class="js-example-basic-multiple${previous_employeers_head} addAll_removeAll_btn" data-list-id="surgicalobs_row_data_experience-${previous_employeers_head}" name="surgical_obs_care_exp[${previous_employeers_head}][]" multiple="multiple"></select>
                        </div>
                   </div>
                </div>
                <div class="col-md-12 mt-3">
                    <div class="form-group">
                        <?php
                        $speciality_surgical_datamater = DB::table("speciality")->where('parent', '250')->get();
                        ?>
                        <div class="neonatal_row_experience-${previous_employeers_head} form-group drp--clr drpdown-set d-none col-md-12">
                            <label class="form-label" for="input-1">Neonatal Care:</label>
                            <ul id="neonatal_care_experience-${previous_employeers_head}" style="display:none;">
                            @foreach($speciality_surgical_datamater as $ssd)
                            <li data-value="{{ $ssd->id }}">{{ $ssd->name }}</li>
                            @endforeach
                            </ul>
                            <select class="js-example-basic-multiple${previous_employeers_head} addAll_removeAll_btn" data-list-id="neonatal_care_experience-${previous_employeers_head}" name="neonatal_care_experience[${previous_employeers_head}][]" multiple="multiple"></select>
                        </div>
                    </div>
                    <div class="neonatal_care_experience_level-${previous_employeers_head}"></div>
                </div>
                <div class="col-md-12 mt-3">
                    <div class="form-group">                
                        <?php
                        $speciality_surgical_datap = DB::table("speciality")->where('parent', '285')->get();
                        $q = 1;
                        ?>
                        @foreach($speciality_surgical_datap as $ssd)
                        <input type="hidden" name="speciality_result" class="surgical_rowp_result_experience-${previous_employeers_head}-{{ $q }}" value="{{ $ssd->id }}">
                        <div class="surgical_rowp_experience-${previous_employeers_head} surgicalpad_row_experience-{{ $ssd->id }} surgical_rowp_experience-${previous_employeers_head}-{{ $q }} drp--clr d-none drpdown-set">
                            <label class="form-label" for="input-1">{{ $ssd->name }}</label>
                            <?php
                            $speciality_surgicalsub_data = DB::table("speciality")->where('parent', $ssd->id)->orderBy('name')->get();
                            ?>
                            <ul id="surgical_operative_carep_experience-${previous_employeers_head}-{{ $q }}" style="display:none;">
                                @foreach($speciality_surgicalsub_data as $sssd)
                                <li data-value="{{ $sssd->id }}">{{ $sssd->name }}</li>
                                @endforeach
                            </ul>
                            <select class="js-example-basic-multiple${previous_employeers_head} addAll_removeAll_btn" data-list-id="surgical_operative_carep_experience-${previous_employeers_head}-{{ $q }}" name="surgical_operative_carep_experience_{{ $q }}[${previous_employeers_head}][]" multiple="multiple"></select>
                        </div>
                        <?php
                        $q++;
                        ?>
                        @endforeach
                    </div>
                </div>

                <div class="surgical_operative_carep_level_one"></div>
                <div class="surgical_operative_carep_level_two"></div>
                <div class="surgical_operative_carep_level_three"></div>
            </div>

            <div class="col-md-12 mt-3">
                <div class="form-group">
                    <div class="level-drp">
                        <label class="form-label" for="input-1">What is your Level of experience in this specialty?
                        </label>
                        <select class="form-control mr-10 select-active" name="exper_assistent_level[${previous_employeers_head}]">
                            @for($i = 1; $i <= 30; $i++) <option value="{{ $i }}">{{ $i }}{{ $i == 1 ? 'st' : ($i == 2 ? 'nd' : ($i == 3 ? 'rd' : 'th')) }} Year</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-3">
                <div class="form-group">
                    <div class="level-drp">
                        <label class="form-label" for="positions_held">Position Held</label>
                        <select class="form-control pos_held pos_held_${previous_employeers_head}" name="positions_held[${previous_employeers_head}]" id="positions_held">
                            <option value="">Position Held</option>
                            <option value="Team Member">Team Member</option>
                            <option value="Team Leader">Team Leader</option>
                            <option value="Educator">Educator</option>
                            <option value="Manager">Manager</option>
                            <option value="Clinical Specialist">Clinical Specialist</option>
                        </select>
                        <span id="reqpositionheld-${previous_employeers_head}" class="reqError text-danger valley"></span>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="col-md-6">
                    <div class="form-group level-drp">
                        <label class="form-label" for="start_date_${previous_employeers_head}">Employment Start Date</label>
                        <input class="form-control employeement_start_date_exp employeement_start_date_exp-${previous_employeers_head}" 
                                type="date" 
                                name="start_date[${previous_employeers_head}]" 
                                id="start_date_${previous_employeers_head}" 
                                onchange="changeEmployeementEndDate(${previous_employeers_head})">
                        <span id="reqempsdateexp-${previous_employeers_head}" class="reqError text-danger valley"></span>
                    </div>
                    <div class="declaration_box mt-2 mb-2">
                        <input class="currently_position currently_position-${previous_employeers_head}" type="checkbox" name="present_box[${previous_employeers_head}][]" value="1" onclick="currently_position(${previous_employeers_head})">
                        I am currently in this position at the moment
                    </div>
                </div>
                <div class="col-md-6 empl_end_date-${previous_employeers_head}">
                    <div class="form-group level-drp">
                        <label class="form-label" for="end_date_${previous_employeers_head}">Employment End Date</label>
                        <input class="form-control employeement_end_date_exp employeement_end_date_exp-${previous_employeers_head}" 
                                type="date" 
                                name="end_date[${previous_employeers_head}]" 
                                id="end_date_${previous_employeers_head}">
                        <span id="reqemployeementenddateexp-${previous_employeers_head}" class="reqError text-danger valley"></span>
                    </div>  
                </div>
            </div>
            <div class="">
                <div class="col-md-12">
                    <div class="form-group level-drp">
                        <label class="form-label" for="employment_type">Employment type</label>
                          <select
                                class="form-control emp_exp_type emp_exp_type-${previous_employeers_head}"
                                name="employeement_type[${previous_employeers_head}]"
                                id="employment_type_${previous_employeers_head}"
                                ">
                                <option value="">select</option>
                                <option value="Permanent">Permanent</option>
                                <option value="Temporary">Temporary</option>
                            </select>
                        <span id="reqemptype-${previous_employeers_head}" class="reqError text-danger valley"></span>
                    </div>
                </div>
            </div>
            <div class="exp_permanent_${previous_employeers_head}" style="display: none;" >
                <div class="col-md-12 mt-3">
                    <div class="form-group">
                        <label class="form-label" for="input-1">Permanent</label>
                        <!-- <input class="form-control" type="text" required="" name="fullname" placeholder="Steven Job"> -->
                        <select class="form-control" name="permanent_status[${previous_employeers_head}]">
                        <option value="">Select</option>
                        <option value="Full-time">Full-time</option>
                        <option value="Part-time">Part-time</option>
                        <option value="Agency Nurse/Midwife">Agency Nurse/Midwife</option>
                        <option value="Freelance">Freelance</option>
                        <option value="Local">Local</option>
                        <option value="Volunteer">Volunteer</option>
                        </select>
                    </div>
                    <span id="reqemployee_status" class="reqError text-danger valley"></span>
                </div>
            </div>
            
            <div class="exp_temporary_${previous_employeers_head}" style="display: none; >
                <div class="col-md-12 mt-3">
                    <div class="form-group">
                        <label class="form-label" for="input-1">Temporary</label>               
                        <select class="form-control" name="temporary_status[${previous_employeers_head}]">
                        <option value="">Select</option>
                        <option value="Temporary">Temporary</option>
                        <option value="Contract">Contract</option>
                        <option value="Term Contract">Term Contract</option>
                        <option value="Travel">Travel</option>
                        <option value="Per Diem">Per Diem</option>
                        <option value="Local">Local</option>
                        <option value="On-Call">On-Call</option>
                        <option value="PRN (Pro Re Nata)">PRN (Pro Re Nata)</option>
                        <option value="Casual">Casual</option>
                        <option value="Locum tenens (temporary substitute)">Locum tenens (temporary substitute)</option>
                        <option value="Agency Nurse/Midwife">Agency Nurse/Midwife</option>
                        <option value="Seasonal" >Seasonal</option>
                        <option value="Freelance">Freelance</option>
                        <option value="Internship">Internship</option>
                        <option value="Apprenticeship">Apprenticeship</option>
                        <option value="Residency">Residency</option>
                        <option value="Volunteer">Volunteer</option>
                        </select>
                    </div>
                    <span id="reqemployee_status" class="reqError text-danger valley"></span>
                </div>
            </div>
            <h6 class="emergency_text">Detailed Job Descriptions</h6>
            <div class="col-md-12 mt-3">
                <div class="form-group level-drp">
                    <label class="form-label" for="job_responsibilities">Responsibilities</label>
                    <textarea class="form-control res-exp res-exp-${previous_employeers_head}" name="job_responeblities[${previous_employeers_head}]" id="job_responsibilities"></textarea>
                    <span id="reqresposiblitiesexp-${previous_employeers_head}" class="reqError text-danger valley"></span>
                </div>
            </div>
            <div class="col-md-12 mt-3">
                <div class="form-group level-drp">
                    <label class="form-label" for="achievements">Achievements</label>
                    <textarea class="form-control ach_exp ach_exp-${previous_employeers_head}" name="achievements[${previous_employeers_head}]" id="achievements"></textarea>
                    <span id="reqachievementsexp-${previous_employeers_head}" class="reqError text-danger valley"></span>
                </div>
            </div>
            <h6 class="emergency_text">
            Areas of Expertise
            </h6>
            <div class="col-md-12 mt-3">
                <div class="form-group level-drp">           
                    <label class="form-label" for="input-1">Specific skills and competencies</label>
                    <?php
                    $skills = DB::table("skills")->where("parent_id", "1")->get();
                    ?>
                    <ul id="skills_compantancies-${previous_employeers_head}" style="display:none;">
                        @foreach($skills as $cert)
                        <li data-value="{{ $cert->id }}">{{ $cert->name }}</li>
                        @endforeach
                    </ul>
                    <select class="spe_skill spe_skill_${previous_employeers_head} js-example-basic-multiple${previous_employeers_head} addAll_removeAll_btn" data-list-id="skills_compantancies-${previous_employeers_head}" name="skills_compantancies[${previous_employeers_head}][]" multiple="multiple"></select>
                </div>
                <span id="reqexpertiseexp-${previous_employeers_head}" class="reqError text-danger valley"></span>
            </div>
            <div class="skills_compantancies_dropdowns-${previous_employeers_head}"></div>  
            <div class="col-md-12 mt-3">      
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
                    <select class="type_of_evi type_of_evi_${previous_employeers_head} js-example-basic-multiple${previous_employeers_head} addAll_removeAll_btn" data-list-id="type_of_evidence" name="type_of_evidence[${previous_employeers_head}][]" multiple="multiple"></select>
                    <span id="reqtype_evidenceexp-${previous_employeers_head}" class="reqError text-danger valley"></span>
                </div>
            </div>
             <div class="col-md-12 mt-3">    
                <div class="form-group level-drp">
                    <label class="form-label" for="input-1">Upload evidence</label>

                    <input class="form-control change_evi" type="file" name="upload_evidence[${previous_employeers_head}][]" id="${previous_employeers_head}">
                    <div class="fileList  fileList_${previous_employeers_head}"></div>
                    
                    <!-- <span id="reqachievements" class="reqError text-danger valley"></span> -->
                </div>
            </div>

            <div class="col-md-12">
                    <!-- Add Delete Button -->
                    <div class="add_new_certification_div_2">
                        <a style="cursor: pointer; margin-bottom: 35px !important;" 
                            class="delete-work-experience_${previous_employeers_head}" 
                            data-index="${previous_employeers_head}">
                            - Delete Work Experience
                        </a>
                    </div>
                </div>
            </div>
        `);

        function ExpEmpStatus1(value, id) {
            if (value == "Permanent") {
                $(".exp_permanent_" + id).show();
                $(".exp_temporary_" + id).hide();
            } else {
                if (value == "Temporary") {
                    $(".exp_temporary_" + id).show();
                    $(".exp_permanent_" + id).hide();
                }
            }
        }

        $(document).on('change', '[id=employment_type_' + previous_employeers_head + ']', function() {
            var value = $(this).val();
            ExpEmpStatus1(value, previous_employeers_head);
        });


        $('.js-example-basic-multiple' + previous_employeers_head).each(function() {
            let listId1 = $(this).data('list-id');
            //alert(listId);
            let items1 = [];
            //console.log("listId1", listId1);
            $('#' + listId1 + ' li').each(function() {
                //console.log("value1", $(this).text());
                items1.push({
                    id: $(this).data('value'),
                    text: $(this).text()
                });
            });
            //console.log("items1", items1);
            $(this).select2({
                data: items1
            });
        });

        $(document).ready(function() {
            $('.js-example-basic-multiple' + previous_employeers_head).on('select2:open', function() {
                // Adding additional search box
                var searchBoxHtml = `
                <div class="extra-search-container">
                    <input type="text" class="extra-search-box" placeholder="Search...">
                    <button class="clear-button" type="button">&times;</button>
                </div>`;

                var buttonsHtml = `
                <div class="extra-buttons">
                    <button class="select-all-button" type="button">Select All</button>
                    <button class="remove-all-button" type="button">Remove All</button>
                </div>`;

                // Remove any existing elements to avoid duplication
                $('.select2-results .extra-search-container').remove();
                $('.select2-results .extra-buttons').remove();

                // Prepend search box and buttons
                $('.select2-results').prepend(buttonsHtml + searchBoxHtml);

                var $searchBox = $('.extra-search-box');
                var $clearButton = $('.clear-button');

                // Handle input event for search box
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

                // Clear button functionality
                $clearButton.on('click', function() {
                    $searchBox.val('');
                    $searchBox.trigger('input');
                });

                var $dropdown = $('.js-example-basic-multiple'); // Reference the dropdown

                // Handle Select All button
                $('.select-all-button').on('click', function() {
                    var allValues = $dropdown.find('option').map(function() {
                        return $(this).val();
                    }).get();
                    $dropdown.val(allValues).trigger('change');
                });

                // Handle Remove All button
                $('.remove-all-button').on('click', function() {
                    $dropdown.val(null).trigger('change');
                });
            });
        });

        // $('.js-example-basic-multiple' + previous_employeers_head).on('select2:open', function() {
        //     var searchBoxHtml = `
        //                     <div class="extra-search-container-${previous_employeers_head}">
        //                     <input type="text" class="extra extra-search-box-${previous_employeers_head}" placeholder="Search...">
        //                     <button class="clear-button" type="button">&times;</button>
        //                     </div>`;

        //     if ($('.select2-results').find('.extra-search-container-' + previous_employeers_head).length === 0) {
        //         $('.select2-results').prepend(searchBoxHtml);
        //     }

        //     var $searchBox = $('.extra-search-box' + previous_employeers_head);
        //     var $clearButton = $('.clear-button');

        //     $searchBox.on('input', function() {
        //         var searchTerm = $(this).val().toLowerCase();
        //         $('.select2-results__option').each(function() {
        //             var text = $(this).text().toLowerCase();
        //             if (text.includes(searchTerm)) {
        //                 $(this).show();
        //             } else {
        //                 $(this).hide();
        //             }
        //         });
        //         $clearButton.toggle($searchBox.val().length > 0);
        //     });

        //     $clearButton.on('click', function() {
        //         $searchBox.val('');
        //         $searchBox.trigger('input');
        //     });
        // });

        // Add an additional search box and extra buttons to the dropdown
        // $(".addAll_removeAll_btn").on("select2:open", function() {
        //     var $dropdown = $(this);
        //     var searchBoxHtml = `                    
        //             <div class="extra-buttons">
        //                 <button class="select-all-button" type="button">Select All</button>
        //                 <button class="remove-all-button" type="button">Remove All</button>
        //             </div>`;

        //     // Remove any existing extra buttons before adding new ones
        //     $(".select2-results .extra-search-container-" + previous_employeers_head).remove();
        //     $(".select2-results .extra-buttons").remove();

        //     // Append the new extra buttons and search box
        //     $(".select2-results").prepend(searchBoxHtml);

        //     // Handle Select All button for the current dropdown
        //     $(".select-all-button").on("click", function() {
        //         var $currentDropdown = $dropdown;
        //         var allValues = $currentDropdown
        //             .find("option")
        //             .map(function() {
        //                 return $(this).val();
        //             })
        //             .get();
        //         $currentDropdown.val(allValues).trigger("change");
        //     });

        //     // Handle Remove All button for the current dropdown
        //     $(".remove-all-button").on("click", function() {
        //         var $currentDropdown = $dropdown;
        //         $currentDropdown.val(null).trigger("change");
        //     });
        // });

        $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="type-of-nurse-experience-' + previous_employeers_head + '"]').on('change', function() {
            // Your code here

            let selectedValues = $(this).val();

            var nurse_len = $("#type-of-nurse-experience-" + previous_employeers_head + " li").length;

            //console.log("nurse_len", nurse_len);

            //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

            //console.log("selectedValues", selectedValues);
            //$('.result--show .form-group').addClass('d-none');

            for (var i = 1; i <= nurse_len; i++) {
                var nurse_result_val = $(".nursing_result_experience-" + previous_employeers_head + "-" + i).val();

                if (selectedValues.includes(nurse_result_val)) {
                    $('#nursing_level_experience1-' + previous_employeers_head + '-' + i).removeClass('d-none');
                } else {
                    $('#nursing_level_experience1-' + previous_employeers_head + '-' + i).addClass('d-none');
                    $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="nursing_entry_experience-' + previous_employeers_head + " - " + i + '"]').select2().val(null).trigger('change');
                }
            }

            if (selectedValues.includes("3") == false) {
                $('.np_submenu_experience_' + previous_employeers_head).addClass('d-none');
                //$('.js-example-basic-multiple[data-list-id="nursing_entry-3"]').select2().val(null).trigger('change');
                $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="nurse_practitioner_menu_experience-' + previous_employeers_head + '"]').select2().val(null).trigger('change');
            }
        });

        $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="nursing_entry_experience-' + previous_employeers_head + '-3"]').on('change', function() {
            let selectedValues = $(this).val();
            var nurse_len = $("#type-of-nurse-experience-" + previous_employeers_head + " li").length;
            //console.log("nurse_len", nurse_len);

            //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));
            if (selectedValues.includes("179")) {
                $('.np_submenu_experience_' + previous_employeers_head).removeClass('d-none');
                //console.log("selectedValues", selectedValues);
            } else {
                $('.np_submenu_experience_' + previous_employeers_head).addClass('d-none');
                $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="nurse_practitioner_menu_experience-' + previous_employeers_head + '"]').select2().val(null).trigger('change');
            }
        });

        $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="specialties_experience-' + previous_employeers_head + '"]').on('change', function() {

            let selectedValues = $(this).val();
            var speciality_len = $("#specialties_experience-" + previous_employeers_head + " li").length;

            //console.log("speciality_len", speciality_len);

            //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

            //console.log("selectedValues", selectedValues);
            //$('.result--show .form-group').addClass('d-none');

            for (var k = 1; k <= speciality_len; k++) {
                var speciality_result_val = $(".speciality_result_experience-" + previous_employeers_head + '-' + k).val();
                //alert(speciality_result_val);
                if (selectedValues.includes(speciality_result_val)) {
                    $('#specility_level_experience-' + previous_employeers_head + '-' + k).removeClass('d-none');
                    //$(".sub_speciality_value").val(k);

                } else {
                    $('#specility_level_experience-' + previous_employeers_head + '-' + k).addClass('d-none');
                    $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="speciality_entry_experience-' + previous_employeers_head + '-' + k + '"]').select2().val(null).trigger('change');

                    if (selectedValues.includes("1") == false) {
                        $('.surgical_row_experience-' + previous_employeers_head + k).addClass('d-none');
                        $('.surgical_row_data_experience-' + previous_employeers_head).addClass('d-none');
                        $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="surgical_row_box_experience-' + previous_employeers_head + '"]').select2().val(null).trigger('change');
                    }
                }

            }

            if (selectedValues.includes("2") == false) {
                $('.surgicalobs_row_experience' + previous_employeers_head).addClass('d-none');
                $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="surgicalobs_row_data_experience-' + previous_employeers_head + '"]').select2().val(null).trigger('change');
            }

            if (selectedValues.includes("3") == false) {
                $('.surgicalpad_row_data_experience' + previous_employeers_head).addClass('d-none');
                $('.surgical_rowp_data_experience' + previous_employeers_head).addClass('d-none');
                $('.neonatal_row_experience' + previous_employeers_head).addClass('d-none');
                //$('.js-example-basic-multiple[data-list-id="surgicalobs_row_data"]').select2().val(null).trigger('change');
            }


        });


        $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="speciality_entry_experience-' + previous_employeers_head + '-1"]').on('change', function() {
            let selectedValues = $(this).val();
            var speciality_entry = $("#speciality_entry_experience-" + previous_employeers_head + "-1 li").length;
            //console.log("speciality_entry", speciality_entry);
            // $(".surgical_row").wrapAll("<div class='col-md-12 row surgical_row_data'>");
            $(".surgical_row_data_experience-" + previous_employeers_head + "").insertAfter("#specility_level_experience-" + previous_employeers_head + "-1");
            //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

            //console.log("selectedValues", selectedValues.includes("96"));
            //$('.result--show .form-group').addClass('d-none');

            if (selectedValues.includes("96")) {
                $('.surgical_row_data_experience-' + previous_employeers_head).removeClass('d-none');

            } else {
                $('.surgical_row_data_experience-' + previous_employeers_head).addClass('d-none ');
                $('.surgical_row_data_experience-' + previous_employeers_head).addClass('d-none ');
                $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="surgical_row_box_experience' + previous_employeers_head + '"]').select2().val(null).trigger('change');
            }

            if (selectedValues.includes("96") == false) {
                // $('.surgical_row_experience' + previous_employeers_head).addClass('d-none ');
                $('.surgical_sub' + previous_employeers_head).addClass('d-none ');
                $('.js-example-basic-multiple1[data-list-id="surgical_row_box_experience' + previous_employeers_head + '"]').select2().val(null).trigger('change');
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

        $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="surgical_row_box_experience-' + previous_employeers_head + '"]').on('change', function() {
            let selectedValues = $(this).val();
            var speciality_entry = $("#surgical_row_box_experience-" + previous_employeers_head + " li").length;

            //console.log("surgical_row_data_experience-", previous_employeers_head);
            // $(".surgical_row").wrapAll("<div class='col-md-12 row surgical_row_data'>");
            $(".specialty_sub_boxes_experience-" + previous_employeers_head).insertAfter(".surgical_row_data_experience-" + previous_employeers_head);
            //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

            //console.log("selectedValues", selectedValues);
            //$('.result--show .form-group').addClass('d-none');

            // if(selectedValues.includes("97")){
            //     $('.surgical_row').removeClass('d-none');
            // }else{
            //     $('.surgical_row').addClass('d-none');
            // }

            for (var k = 1; k <= speciality_entry; k++) {
                var speciality_result_val = $(".speciality_surgical_result_experience-" + previous_employeers_head + '-' + k).val();

                if (selectedValues.includes(speciality_result_val)) {
                    $('.surgical_row_experience-' + previous_employeers_head + '-' + k).removeClass('d-none');
                } else {
                    $('.surgical_row_experience-' + previous_employeers_head + '-' + k).addClass('d-none');
                    $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="surgical_operative_care_experience-' + previous_employeers_head + '-' + k + '"]').select2().val(null).trigger('change');
                }
            }
        });

        $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="speciality_entry_experience-' + previous_employeers_head + '-2"]').on('change', function() {
            let selectedValues = $(this).val();

            var speciality_entry = $("#speciality_entry_experience-" + previous_employeers_head + "-2 li").length;

            //console.log("speciality_entry", speciality_entry);
            // $(".surgicalobs_row").wrapAll("<div class='col-md-12 row surgicalobs_row_data'>");
            $(".surgicalobs_row_experience-" + previous_employeers_head).insertAfter("#specility_level_experience-" + previous_employeers_head + "-2");

            //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

            //console.log("selectedValues", selectedValues);
            //$('.result--show .form-group').addClass('d-none');

            if (selectedValues.includes("233")) {
                $('.surgicalobs_row_experience-' + previous_employeers_head).removeClass('d-none');
            } else {
                $('.surgicalobs_row_experience-' + previous_employeers_head).addClass('d-none');
                $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="surgicalobs_row_data_experience-' + previous_employeers_head + '"]').select2().val(null).trigger('change');
            }
        });

        $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="speciality_entry_experience-' + previous_employeers_head + '-3"]').on('change', function() {
            let selectedValues = $(this).val();

            var speciality_entry = $("#speciality_entry_experience-" + previous_employeers_head + "-2 li").length;
            //console.log("speciality_entry", speciality_entry);
            $(".surgical_rowp_experience-" + previous_employeers_head).wrapAll("<div class='col-md-12 row surgical_rowp_data_experience-" + previous_employeers_head + "'>");
            $(".paediatric_surgical_div_experience-" + previous_employeers_head).insertAfter("#specility_level_experience-" + previous_employeers_head + "-3");


            //     $(".neonatal_row").wrapAll("<div class='col-md-12 row neonatal_row_data'>");
            $(".neonatal_row_experience-" + previous_employeers_head).insertAfter("#specility_level_experience-" + previous_employeers_head + "-3");

            //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));


            //$('.result--show .form-group').addClass('d-none');

            if (selectedValues.includes('250')) {
                $('.neonatal_row_experience-' + previous_employeers_head).removeClass('d-none');
            } else {
                $('.neonatal_row_experience-' + previous_employeers_head).addClass('d-none');
                $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="neonatal_care_experience-' + previous_employeers_head + '"]').select2().val(null).trigger('change');
            }

            if (selectedValues.includes('285')) {
                $('.surgicalpad_row_data_experience-' + previous_employeers_head).removeClass('d-none');
            } else {
                $('.surgicalpad_row_data_experience-' + previous_employeers_head).addClass('d-none');
                $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="surgical_rowpad_box_experience-' + previous_employeers_head + '"]').select2().val(null).trigger('change');
            }

            if (selectedValues.includes("285") == false) {
                $('.surgical_rowp_data_experience-' + previous_employeers_head).addClass('d-none');
                $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="surgical_row_box_experience-' + previous_employeers_head + '"]').select2().val(null).trigger('change');
            }

        });

        $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="surgical_rowpad_box_experience-' + previous_employeers_head + '"]').on('change', function() {
            let selectedValues = $(this).val();

            var speciality_entry = $("#surgical_rowpad_box_experience-" + previous_employeers_head + " li").length;
            //console.log("speciality_entry", speciality_entry);
            // $(".surgical_rowp").wrapAll("<div class='col-md-12 row surgical_rowp_data'>");
            $(".surgical_rowp_data_experience-" + previous_employeers_head).insertAfter(".surgicalpad_row_data_experience-" + previous_employeers_head);


            //     $(".neonatal_row").wrapAll("<div class='col-md-12 row neonatal_row_data'>");
            //     $(".neonatal_row_data").insertAfter("#specility_level-3");

            //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

            //$('.result--show .form-group').addClass('d-none');



            for (var k = 1; k <= speciality_entry; k++) {
                var speciality_result_val = $(".surgical_rowp_result_experience-" + previous_employeers_head + '-' + k).val();
                //alert(speciality_result_val);
                if (selectedValues.includes(speciality_result_val)) {
                    $('.surgical_rowp_experience-' + previous_employeers_head + '-' + k).removeClass('d-none');
                } else {
                    $('.surgical_rowp_experience-' + previous_employeers_head + '-' + k).addClass('d-none');
                    $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="surgical_operative_carep_experience-' + previous_employeers_head + '-' + k + '"]').select2().val(null).trigger('change');
                }
            }
        });

        // Event listener for change event on the main dropdown
        $('.js-example-basic-multiple' + previous_employeers_head + `[data-list-id="skills_compantancies-${previous_employeers_head}"]`).on('change', function() {
            // Get selected values from the main dropdown
            let selectedValues = $(this).val();

            // Track existing dropdowns
            let existingDropdowns = [];
            $(`.skills_compantancies_dropdowns-${previous_employeers_head} .js-example-basic-multiple${previous_employeers_head}`).each(function() {
                existingDropdowns.push($(this).data('list-id'));
            });

            // Loop through selected values to add new dropdowns
            selectedValues.forEach(function(value) {
                let dropdownId = `skills_compantancies-${previous_employeers_head}-${value}`;
                if (!existingDropdowns.includes(dropdownId)) {
                    // Fetch submenu data for new IDs
                    $.ajax({
                        type: "POST",
                        url: "{{ url('/admin') }}/getSkillsData",
                        data: {
                            id: value,
                            _token: "{{ csrf_token() }}"
                        },
                        cache: false,
                        success: function(data) {
                            let skills = JSON.parse(data);
                            if (!skills || skills.length === 0) return; // Handle empty data

                            let skills_data = skills.map(skill => `<li data-value="${skill.id}">${skill.name}</li>`).join('');

                            // Create new dropdown HTML
                            let dropdownHtml = `
                        <div class="form-group level-drp">
                            <label class="form-label">${skills[0].parent_name}</label>
                            <ul id="${dropdownId}" style="display:none;">
                                ${skills_data}
                            </ul>
                            <select class="js-example-basic-multiple${previous_employeers_head} addAll_removeAll_btn"
                                    data-list-id="${dropdownId}"
                                    name="sub_skills_compantancies-${skills[0].parent_id}[${previous_employeers_head}][]"
                                    multiple="multiple">
                            </select>
                        </div>
                    `;

                            // Append the new dropdown
                            $(`.skills_compantancies_dropdowns-${previous_employeers_head}`).append(dropdownHtml);

                            // Initialize Select2 for the new dropdown
                            let $newDropdown = $(`[data-list-id="${dropdownId}"]`);
                            let items = skills.map(skill => ({
                                id: skill.id,
                                text: skill.name
                            }));

                            $newDropdown.select2({
                                data: items
                            });
                            initializeSelect22($newDropdown); // Add select all/remove all functionality
                        }
                    });
                }
            });

            // Remove dropdowns for deselected IDs
            $(`.skills_compantancies_dropdowns-${previous_employeers_head} .js-example-basic-multiple${previous_employeers_head}`).each(function() {
                let listId = $(this).data('list-id');
                let id = listId.split('-').pop(); // Extract the ID
                if (!selectedValues.includes(id)) {
                    $(this).closest('.form-group').remove(); // Remove dropdown if not selected
                }
            });
        });

        // Function to initialize Select2 with custom buttons
        function initializeSelect22($dropdown) {
            $dropdown.on('select2:open', function() {
                if (!$('.select2-container .extra-buttons').length) {
                    let searchBoxHtml = `
            <div class="extra-buttons">
                <button class="select-all-button" type="button">Select All</button>
                <button class="remove-all-button" type="button">Remove All</button>
            </div>
            `;

                    $('.select2-results').prepend(searchBoxHtml);

                    // Attach event listeners to the buttons
                    $('.select-all-button').on('click', function() {
                        let allValues = $dropdown.find('option').map(function() {
                            return $(this).val();
                        }).get();
                        $dropdown.val(allValues).trigger('change');
                    });

                    $('.remove-all-button').on('click', function() {
                        $dropdown.val(null).trigger('change');
                    });
                }
            });
        }

        $(document).on('click', '.delete-work-experience_' + previous_employeers_head, function() {
            delete_Exp(previous_employeers_head);
        });

        // Function to delete the work experience section
        function delete_Exp(previous_employeers_head) {
            $(".work_exp_" + previous_employeers_head).remove();
        }

    }

    function currently_position(i) {
        if ($(".currently_position-" + i).prop('checked') == true) {
            $(".empl_end_date-" + i).hide();
        } else {
            $(".empl_end_date-" + i).show();
            $(".employeement_end_date-" + i).val("");
        }
    }

    function currently_position_1(i) {
        if ($(".currently_position-" + i).prop('checked') == true) {
            $(".empl_end_date-" + i).addClass('d-none');
        } else {
            $(".empl_end_date-" + i).removeClass('d-none');
            $(".employeement_end_date-" + i).val("");
        }
    }

    $(document).ready(function() {
        $('.js-example-basic-multiple[data-list-id="type-of-nurse-experience"]').on('change', function() {
            let selectedValues = $(this).val();
            var nurse_len = $("#type-of-nurse-experience li").length;
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

        $('.js-example-basic-multiple[data-list-id="nursing_entry_experience-3"]').on('change', function() {
            let selectedValues = $(this).val();
            //alert("hello");
            var nurse_len = $("#type-of-nurse li").length;
            ////console.log("nurse_len", nurse_len);

            //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));
            if (selectedValues.includes("179")) {
                $('.np_submenu_experience').removeClass('d-none');
                ////console.log("selectedValues", selectedValues);
            } else {
                $('.np_submenu_experience').addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="nurse_practitioner_menu_experience"]').select2().val(null).trigger('change');
            }
        });

        $('.js-example-basic-multiple[data-list-id="specialties_experience"]').on('change', function() {
            let selectedValues = $(this).val();
            var speciality_len = $("#specialties_experience li").length;
            ////console.log("speciality_len", speciality_len);

            //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));
            ////console.log("selectedValues", selectedValues);
            //$('.result--show .form-group').addClass('d-none');

            for (var k = 1; k <= speciality_len; k++) {
                var speciality_result_val = $(".speciality_result_experience-" + k).val();
                //alert(speciality_result_val);
                if (selectedValues.includes(speciality_result_val)) {

                    $('#specility_level_experience-' + k).removeClass('d-none');
                    //$(".sub_speciality_value").val(k);
                    ////console.log('1');
                } else {
                    ////console.log('2');
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
                ////console.log('5');
                $('.surgicalpad_row_data_experience').addClass('d-none');
                $('.surgical_rowp_data_experience').addClass('d-none');
                $('.neonatal_row_experience').addClass('d-none');
                //$('.js-example-basic-multiple[data-list-id="surgicalobs_row_data"]').select2().val(null).trigger('change');
            }


        });

        $('.js-example-basic-multiple[data-list-id="speciality_entry_experience-1"]').on('change', function() {
            let selectedValues = $(this).val();
            //alert("hello");
            var speciality_entry = $("#speciality_entry_experience-1 li").length;
            ////console.log("speciality_entry", speciality_entry);
            // $(".surgical_row").wrapAll("<div class='col-md-12 row surgical_row_data'>");
            $(".surgical_row_data_experience").insertAfter("#specility_level_experience-1");
            //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

            ////console.log("selectedValues", selectedValues.includes("96"));
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
            $(".surgicalobs_row_experience").insertAfter("#specility_level_experience-2");
            if (selectedValues.includes("233")) {
                $('.surgicalobs_row_experience').removeClass('d-none');
            } else {
                $('.surgicalobs_row_experience').addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="surgicalobs_row_data_experience"]').select2().val(null).trigger('change');
            }
        });

        $('.js-example-basic-multiple[data-list-id="surgical_row_box_experience"]').on('change', function() {

            let selectedValues = $(this).val();
            //alert("hello");
            var speciality_entry = $("#surgical_row_box_experience li").length;
            ////console.log("speciality_entry", speciality_entry);
            // $(".surgical_row").wrapAll("<div class='col-md-12 row surgical_row_data'>");
            $(".specialty_sub_boxes_experience").insertAfter(".surgical_row_data_experience");
            //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

            ////console.log("selectedValues", selectedValues);
            //$('.result--show .form-group').addClass('d-none');

            // if(selectedValues.includes("97")){
            //     $('.surgical_row').removeClass('d-none');
            // }else{
            //     $('.surgical_row').addClass('d-none');
            // }

            for (var k = 1; k <= speciality_entry; k++) {
                var speciality_result_val = $(".speciality_surgical_result_experience-" + k).val();
                ////console.log("speciality_result_val", speciality_result_val);
                if (selectedValues.includes(speciality_result_val)) {
                    $('.surgical_row_experience-' + k).removeClass('d-none');
                } else {
                    $('.surgical_row_experience-' + k).addClass('d-none');
                    $('.js-example-basic-multiple[data-list-id="surgical_operative_care_experience-' + k + '"]').select2().val(null).trigger('change');
                }
            }
        });

        $('.js-example-basic-multiple[data-list-id="speciality_entry_experience-3"]').on('change', function() {
            let selectedValues = $(this).val();
            //alert("hello");
            var speciality_entry = $("#speciality_entry_experience-3 li").length;
            $(".surgical_rowp_experience").wrapAll("<div class='col-md-12 row surgical_rowp_data_experience'>");
            $(".paediatric_surgical_div_experience").insertAfter("#specility_level_experience-3");


            //$(".neonatal_row").wrapAll("<div class='col-md-12 row neonatal_row_data'>");
            $(".neonatal_row_experience").insertAfter("#specility_level_experience-3");

            //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

            ////console.log("selectedValues", selectedValues);
            //$('.result--show .form-group').addClass('d-none');

            if (selectedValues.includes('250')) {
                $('.neonatal_row_experience').removeClass('d-none');
            } else {
                $('.neonatal_row_experience').addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="neonatal_care_experience"]').select2().val(null).trigger('change');
            }

            if (selectedValues.includes('285')) {
                $('.surgicalpad_row_data_experience').removeClass('d-none');
            } else {
                $('.surgicalpad_row_data_experience').addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="surgical_rowpad_box_experience"]').select2().val(null).trigger('change');
            }

            if (selectedValues.includes("285") == false) {
                $('.surgical_rowp_data_experience').addClass('d-none');
                // $('.js-example-basic-multiple[data-list-id="surgical_row_box_experience"]').select2().val(null).trigger('change');
            }

        });

        $('.js-example-basic-multiple[data-list-id="surgical_rowpad_box_experience"]').on('change', function() {
            let selectedValues = $(this).val();
            //alert("hello");
            var speciality_entry = $("#surgical_rowpad_box_experience li").length;
            ////console.log("speciality_entry", speciality_entry);
            // $(".surgical_rowp").wrapAll("<div class='col-md-12 row surgical_rowp_data'>");
            $(".surgical_rowp_data_experience").insertAfter(".surgicalpad_row_data_experience");
            for (var k = 1; k <= speciality_entry; k++) {
                var speciality_result_val = $(".surgical_rowp_result_experience-" + k).val();
                //alert(speciality_result_val);
                if (selectedValues.includes(speciality_result_val)) {
                    $('.surgical_rowp_experience-' + k).removeClass('d-none');
                } else {
                    $('.surgical_rowp_experience-' + k).addClass('d-none');
                    $('.js-example-basic-multiple[data-list-id="surgical_operative_carep_experience-' + k + '"]').select2().val(null).trigger('change');
                }
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

            var skillcount = 1;

            // Loop through selected values
            selectedValues.forEach(function(value) {
                // Check if the dropdown for this ID already exists
                if (!existingDropdowns.includes(`skills_compantancies-${value}`)) {
                    // Fetch submenu data for new IDs
                    $.ajax({
                        type: "POST",
                        url: "{{ url('/admin') }}/getSkillsData",
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
                                        name="sub_skills_compantancies-${skills[0].parent_id}[1][]" multiple="multiple">
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
                    count++;
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

                // Check if buttons already exist for this dropdown
                if ($('.extra-buttons').length === 0) {
                    // Create the buttons HTML
                    var searchBoxHtml = `
                <div class="extra-buttons">
                    <button class="select-all-button" type="button">Select All</button>
                    <button class="remove-all-button" type="button">Remove All</button>
                </div>
            `;

                    // Add select all/remove all buttons
                    $('.select2-results').prepend(searchBoxHtml);

                    // Attach event listeners to the buttons
                    $('.select-all-button').off('click').on('click', function() {
                        var allValues = $currentDropdown.find('option').map(function() {
                            return $(this).val();
                        }).get();
                        $currentDropdown.val(allValues).trigger('change');
                    });

                    $('.remove-all-button').off('click').on('click', function() {
                        $currentDropdown.val(null).trigger('change');
                    });
                }
            });
        }
    });
</script>

<script>
    const selectedFilesMap = {}; // This will hold selected files for each input by ID
    let count = 1;
    // Using event delegation to handle 'change' event for multiple inputs
    $(document).on('change', '.change_evi', function(event) {
        const id = this.id; // Get the ID of the input element

        if (!selectedFilesMap[id]) {
            selectedFilesMap[id] = new DataTransfer();
        }

        // Add selected files to the DataTransfer for this input
        Array.from(event.target.files).forEach((file) => {
            selectedFilesMap[id].items.add(file);
            const fileUrl = URL.createObjectURL(file);
            const fileName = file.name;

            // Create preview HTML
            const previewHtml = `
                <div class="trans_img trans_img-${count}" data-file="${fileName}">
                    <a href="${fileUrl}" target="_blank">
                        <i class="fa fa-file"></i> ${fileName}
                    </a>
                    <div class="close_btn" style="cursor: pointer;">
                        <i class="fa fa-close" onclick="deleteevImg(${count}, '${fileName}',${id})"></i>
                    </div>
                </div>
            `;

            $('.fileList_' + id).append(previewHtml);
            count++;
        });

        // Update the file input with the modified FileList for this specific input
        $('#' + id)[0].files = selectedFilesMap[id].files;
        // console.log(selectedFilesMap);
    });


    window.deleteevImg = function(sectionId, fileName, id) {
        // Remove the preview element of the selected file
        $(`.trans_img-${sectionId}`).remove();
        // Get the file input element and update the count
        const inputElement = $('.change_evi');
        const newFileCount = inputElement[0].files.length - 1; // Decrease the count
        $('#' + id)[0].files = new FileListItems([...inputElement[0].files].slice(0, newFileCount));
        console.log(`File ${fileName} deleted from section ${sectionId}`);
    };

    function FileListItems(files) {
        const dataTransfer = new DataTransfer();
        files.forEach(file => dataTransfer.items.add(file));
        return dataTransfer.files;
    }

    // Function to delete the work experience section
    function deletevdiImg(i, user_id, img, imgid) {
        $.ajax({
            type: "post",
            url: "{{route('nurse.deleteEvidence')}}",
            data: {
                user_id: user_id,
                img: img,
                imgid: imgid,
                _token: '{{ csrf_token() }}'
            },
            cache: false,
            success: function(data) {
                if (data == 1) {
                    $(".trans_img-" + i).remove();
                }
            }
        });

    }

    $(document).ready(function() {
        $('#experience_form').on('submit', function(event) {
            event.preventDefault();
            var isValid = true;
            var targetTab = '#navpill-6';

            var a = 1;
            $(".nurse_type_exp").each(function() {
                if ($(".nurse_type_exp_" + a).length > 0) {
                    if ($(".nurse_type_exp_" + a).val() == '') {
                        document.getElementById("reqnurseTypeexpId-" + a).innerHTML = "* Please select the type of nurse";
                        isValid = false;
                    }
                }
                a++;
            });


            var b = 1;
            $(".spec_exp").each(function() {
                if ($(".spec_exp_" + b).length > 0) {
                    if ($(".spec_exp_" + b).val() == '') {
                        document.getElementById("reqspecialtiesexp-" + b).innerHTML = "* Please select the specialties";
                        isValid = false;
                    }
                }
                b++;
            });


            var c = 1;
            $(".pos_held").each(function() {
                if ($(".pos_held_" + c).length > 0) {
                    if ($(".pos_held_" + c).val() == '') {
                        document.getElementById("reqpositionheld-" + c).innerHTML = "* Please select the position held";
                        isValid = false;
                    }
                }
                c++;
            });

            var d = 1;
            $(".employeement_start_date_exp").each(function() {
                if ($(".employeement_start_date_exp-" + d).length > 0) {
                    if ($(".employeement_start_date_exp-" + d).val() == '') {
                        document.getElementById("reqempsdateexp-" + d).innerHTML = "* Please enter the employment start date";
                        isValid = false;
                    }
                }
                d++;
            });

            var e = 1;
            $(".employeement_end_date_exp").each(function() {
                if ($(".employeement_end_date_exp-" + e).length > 0) {
                    if ($(".employeement_end_date_exp-" + e).val() == '') {
                        document.getElementById("reqemployeementenddateexp-" + e).innerHTML = "* Please enter the employment end date";
                        isValid = false;
                    }
                }
                e++;
            });

            var f = 1;
            $(".res-exp").each(function() {
                if ($(".res-exp-" + f).length > 0) {
                    if ($(".res-exp-" + f).val() == '') {
                        document.getElementById("reqresposiblitiesexp-" + f).innerHTML = "* Please enter the responsibilities";
                        isValid = false;
                    }
                }
                f++;
            });

            var g = 1;
            $(".ach_exp").each(function() {
                if ($(".ach_exp-" + g).length > 0) {
                    if ($(".ach_exp-" + g).val() == '') {
                        document.getElementById("reqachievementsexp-" + g).innerHTML = "* Please enter the achievements";
                        isValid = false;
                    }
                }
                g++;
            });


            var h = 1;
            $(".spe_skill").each(function() {
                if ($(".spe_skill_" + h).length > 0) {
                    if ($(".spe_skill_" + h).val() == '') {
                        document.getElementById("reqexpertiseexp-" + h).innerHTML = "* Please select the specific skills and competencies";
                        isValid = false;
                    }
                }
                h++;
            });

            var i = 1;
            $(".spe_skill").each(function() {
                if ($(".spe_skill_" + i).length > 0) {
                    if ($(".spe_skill_" + i).val() == '') {
                        document.getElementById("reqexpertiseexp-" + i).innerHTML = "* Please select the specific skills and competencies";
                        isValid = false;
                    }
                }
                i++;
            });


            var j = 1;
            $(".type_of_evi").each(function() {
                if ($(".type_of_evi_" + j).length > 0) {
                    if ($(".type_of_evi_" + j).val() == '') {
                        document.getElementById("reqtype_evidenceexp-" + j).innerHTML = "* Please select the type of evidence";
                        isValid = false;
                    }
                }
                j++;
            });


            var k = 1;
            $(".emp_exp_type").each(function() {
                if ($(".emp_exp_type-" + k).length > 0) {
                    if ($(".emp_exp_type-" + k).val() == '') {
                        document.getElementById("reqemptype-" + k).innerHTML = "* Please select the employment type";
                        isValid = false;
                    }
                }
                k++;
            });

            if (isValid == true) {
                $.ajax({
                    url: "{{ route('admin.exp-data') }}",
                    type: "POST",
                    data: new FormData($('#experience_form')[0]),
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
                                window.location.href = "{{ route('admin.add_nurse', ['tab' => 'navpill-5.1']) }}";

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
                        // if(targetTab ==  '#navpill-2'){
                        if (error.responseJSON.errors) {
                            if (error.responseJSON.errors.previous_employer_name) {
                                $('#previous_employer_name_error').text(error.responseJSON.errors.previous_employer_name[0]);
                            } else {
                                $('#previous_employer_name_error').text('');
                            }

                            if (error.responseJSON.errors.positions_held) {
                                $('#positions_held_error').text(error.responseJSON.errors.positions_held[0]);
                            } else {
                                $('#positions_held_error').text('');
                            }

                            if (error.responseJSON.errors.start_date) {
                                $('#start_date_error').text(error.responseJSON.errors.start_date[0]);
                            } else {
                                $('#start_date_error').text('');
                            }

                            if (error.responseJSON.errors.end_date) {
                                $('#end_date_error').text(error.responseJSON.errors.end_date[0]);
                            } else {
                                $('#end_date_error').text('');
                            }

                            if (error.responseJSON.errors.job_responeblities) {
                                $('#job_responeblities_error').text(error.responseJSON.errors.job_responeblities[0]);
                            } else {
                                $('#job_responeblities_error').text('');
                            }


                            if (error.responseJSON.errors.achievements) {
                                $('#achievements_error').text(error.responseJSON.errors.achievements[0]);
                            } else {
                                $('#achievements_error').text('');
                            }

                            if (error.responseJSON.errors.skills_compantancies) {
                                $('#skills_compantancies_error').text(error.responseJSON.errors.skills_compantancies[0]);
                            } else {
                                $('#skills_compantancies_error').text('');
                            }

                            if (error.responseJSON.errors.present_box) {
                                $('#present_box_error').text(error.responseJSON.errors.present_box[0]);
                            } else {
                                $('#present_box_error').text('');
                            }

                            // }                        
                        }
                    }
                });

            }

        })
    });

    // function ExpEmpStatus1(value, id) {
    //     if (value == "Permanent") {
    //         $(".exp_permanent_" + id).show();
    //         $(".exp_temporary_" + id).hide();
    //     } else {
    //         if (value == "Temporary") {
    //             $(".exp_temporary_" + id).show();
    //             $(".exp_permanent_" + id).hide();
    //         }
    //     }
    // }

    // $(document).on('change', '[id=employment_type_' + previous_employeers_head + ']', function() {
    //     var value = $(this).val();
    //     ExpEmpStatus1(value, previous_employeers_head);
    // });

    function ExpEmpStatus(value) {
        if (value == "Permanent") {
            $(".exp_permanent").show();
            $(".exp_temporary").hide();
        } else {
            if (value == "Temporary") {
                $(".exp_temporary").show();
                $(".exp_permanent").hide();
            }
        }
    }
</script>
@endsection