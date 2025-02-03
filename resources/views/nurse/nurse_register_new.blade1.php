@extends('nurse.layouts.layout')
@section('css')
<link rel="stylesheet" 
              href= 
"https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/css/intlTelInput.css" rel="stylesheet" />
<style type="text/css">

  #container {
    /*  max-width: 550px;  */
  }

  .reqError {
    color: red;
  }

  .step-container {
    position: relative;
    text-align: center;
    transform: translateY(-43%);
  }

  .step-circle {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background-color: #fff;
    border: 2px solid #000000;
    line-height: 30px;
    font-weight: bold;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 10px;
    cursor: pointer;
    /* Added cursor pointer */
  }

  .step-line {
    position: absolute;
    top: 16px;
    left: 50px;
    width: calc(100% - 100px);
    height: 2px;
    background-color: #000000;
    z-index: -1;
  }

  #multi-step-form {
    overflow-x: hidden;
  }

  #multi-step-form .step-1:before,
  #multi-step-form .step-2:before {
    display: none;
  }


  .progress-bar {
    display: flex;
    flex-direction: column;
    justify-content: center;
    overflow: hidden;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    background-color: #000000;
    transition: width .6s ease;
  }

  .activ1,
  .activ {
    background: #000;
    color: #fff;
  }


  span.select2.select2-container {
    padding: 5px !important;
    width: 100 !important;
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
      padding-bottom: 3px;
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
</style>
@endsection
@section('content')

<main class="main">
  <section class="pt-100 login-register nurse-reglog">

    <div id="container" class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-5">
          <div class="progress px-1" style="height: 3px;">
            <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
          </div>


          <div class="step-container d-flex justify-content-between">
            <div class="step-circle" onclick="displayStep(1)">1</div>
            <div class="step-circle" onclick="displayStep(2)">2</div>
            <!-- <div class="step-circle" onclick="displayStep(3)">3</div> -->
          </div>
        </div>
      </div>


      <form id="multi-step-form">
        @csrf
        <div class="step step-1">
          <!-- Step 1 form fields here -->
          <div class="row form-block">
            <div class="col-lg-9 col-md-6 col-sm-12 mx-auto">
              <div class="text-center">
                <!-- <p class="font-sm text-brand-2">Register </p> -->
                <h2 class="mt-10 mb-5 text-brand-1 fs_24">In just a few minutes, you will be able to apply for the ideal shift or permanent position</h2>

                <!-- <h2 class="mt-10 mb-5 text-brand-1 fs_24">Tell us about your qualifications</h2> -->

              </div>
              <div class="login-register text-start mt-20" action="#">


              <!-- <div class="form-group drp--clr">
                  <label class="form-label" for="input-1">Type of Nurse?</label>
                  <select class="form-input mr-10 country" name="nurseType[]"
                    multiple="true" id="nurseType"
                    > 
                      @php $specialty = specialty();$spcl=$specialty[0]->id;@endphp
                    @foreach($specialty as $spl)
                    <option value="{{ $spl->id }}">{{ $spl->name }}</option>
                    @endforeach
                  </select> 
                  <!-- <select class="form-input mr-10 select-active" name="nurseType[]" id="nurseType" multiple>
                    @php $specialty = specialty();$spcl=$specialty[0]->id;@endphp
                    @foreach($specialty as $spl)
                    <option value="{{ $spl->id }}">{{ $spl->name }}</option>
                    @endforeach
                 <!-- </select> -->
              <!-- </div> -->
         
         
       <div class="condition_set">   
         <div class="form-group drp--clr">
          <label class="form-label" for="input-1">Type of Nurse?</label>
            <ul id="type-of-nurse" style="display:none;">
              <li data-value="Entry level nursing">Entry level nursing</li>
              <li data-value="Registered Nurses (RNs)">Registered Nurses (RNs)</li>
              <li data-value="Advanced Practice Registered Nurses (APRNs)">Advanced Practice Registered Nurses (APRNs)</li>
            </ul>
          <select class="js-example-basic-multiple" data-list-id="type-of-nurse" name="states[]" multiple="multiple"></select>
         </div>
       </div>

        
       <div class="result--show">
        <div class="form-group drp--clr d-none" id="elnj">
          <label class="form-label" for="input-2">Entry level nursing <br>Jobs</label>
            <ul id="entry-level-nursing" style="display:none;">
              <li data-value="Certified Nursing Assistant (CNAs)">Certified Nursing Assistant (CNAs)</li>
              <li data-value="Certified Nurse-Midwife (CNM)">Certified Nurse-Midwife (CNM)</li>
                      <li data-value="Enrolled Nurse (Ens)">Enrolled Nurse (Ens)</li>
                      <li data-value="Enrolled Nurse (notation)">Enrolled Nurse (notation)</li>
                      <li data-value="Enrolled Nurse (meds)">Enrolled Nurse (meds)</li>
                      <li data-value="Enrolled Nurse  (IVs)">Enrolled Nurse  (IVs)</li>
                      <li data-value="Enrolled Nurse (Student)">Enrolled Nurse (Student)</li>
                      <li data-value="Licensed Practical Nurse (LPNs)">Licensed Practical Nurse (LPNs)</li>
                      <li data-value="Midwife Assistant">Midwife Assistant</li>
                      <li data-value="Midwife Student">Midwife Student</li>
                      <li data-value="Nurse Assistant">Nurse Assistant</li>
                      <li data-value="Temporary Nurse Aide">Temporary Nurse Aide</li>
              <!-- Add more list items as needed -->
            </ul>
          <select class="js-example-basic-multiple" data-list-id="entry-level-nursing" name="states[]" multiple="multiple"></select>
        </div>

        <div class="form-group drp--clr d-none" id="rns">
          <label class="form-label" for="input-3">Registered Nurses (RNs) <br>Jobs</label>
            <ul id="registerd-nurse" style="display:none;">
              <li data-value="Academic Nurse Writer">Academic Nurse Writer</li>
              <li data-value="Addiction/ Substance Abuse Nurse">Addiction/ Substance Abuse Nurse</li>
              <li data-value="Aesthetic/Cosmetic Nurse">Aesthetic/Cosmetic Nurse</li>
              <li data-value="Air Force Nurse">Air Force Nurse</li>
              <li data-value="Allergy/Allergen Immunotherapy Nurse">Allergy/Allergen Immunotherapy Nurse</li>
              <li data-value="Ambulatory Care Nurse">Ambulatory Care Nurse</li>
              <li data-value="Army Nurse">Army Nurse</li>
              <li data-value="Bariatric Nurse">Bariatric Nurse</li>
              <li data-value="Bioterrorism Nurse">Bioterrorism Nurse</li>
              <li data-value="Blood Management Nurse">Blood Management Nurse</li>
              <li data-value="Burn Registered Nurse">Burn Registered Nurse</li>
              <li data-value="Camp Registered Nurse">Camp Registered Nurse</li>
              <li data-value="Cardiac Care Nurse">Cardiac Care Nurse</li>
              <li data-value="Cardiac Catheterization Nurse">Cardiac Catheterization Nurse</li>
              <li data-value="Cardiovascular Intensive Care Unit Nurse">Cardiovascular Intensive Care Unit Nurse</li>
              <li data-value="Case Management Nurse">Case Management Nurse</li>
              <li data-value="Certified Diabetes Educator">Certified Diabetes Educator</li>
              <li data-value="Certified Nursing Assistant (CNA)">Certified Nursing Assistant (CNA)</li>
              <li data-value="Charge Nurse">Charge Nurse</li>
              <li data-value="Chronic Pain Nurse">Chronic Pain Nurse</li>
              <li data-value="Clinical Nurse Instructor">Clinical Nurse Instructor</li>
              <li data-value="Community Health Nurse">Community Health Nurse</li>
              <li data-value="Correctional Nurse">Correctional Nurse</li>
              <li data-value="Crisis Nurse">Crisis Nurse</li>
              <li data-value="Critical Care Transport Nurse">Critical Care Transport Nurse</li>
              <li data-value="Day Infusion Treatments Nurse">Day Infusion Treatments Nurse</li>
              <li data-value="Cruise Ship Nurse">Cruise Ship Nurse</li>
              <li data-value="Dermatology Nurse">Dermatology Nurse</li>
              <li data-value="Developmental Disability Nurse">Developmental Disability Nurse</li>
              <li data-value="Diabetes Nurse">Diabetes Nurse</li>
              <li data-value="Dialysis Nurse">Dialysis Nurse</li>
              <li data-value="Director of Nursing">Director of Nursing</li>
              <li data-value="Disaster Management Nurse">Disaster Management Nurse</li>
              <li data-value="Disney Nurse">Disney Nurse</li>
              <li data-value="Domestic Violence Nurse">Domestic Violence Nurse</li>
              <li data-value="Emergency Room (ER) Nurse">Emergency Room (ER) Nurse</li>
              <li data-value="Endocrine Nurse">Endocrine Nurse</li>
              <li data-value="Endoscopy Nurse">Endoscopy Nurse</li>
              <li data-value="Enterostomy Nurse">Enterostomy Nurse</li>
              <li data-value="Fertility Nurse">Fertility Nurse</li>
              <li data-value="Flight Nurse">Flight Nurse</li>
              <li data-value="Float Pool Nurse">Float Pool Nurse</li>
              <li data-value="Forensic Nurse">Forensic Nurse</li>
              <li data-value="Gastroenterology Nurse">Gastroenterology Nurse</li>
              <li data-value="Genetic Nurse">Genetic Nurse</li>
              <li data-value="General Practice (GP) Nurse">General Practice (GP) Nurse</li>
              <li data-value="Geriatric Nurse">Geriatric Nurse</li>
              <li data-value="Gynecology Nurse">Gynecology Nurse</li>
              <li data-value="Health Assessment Nurse">Health Assessment Nurse</li>
              <li data-value="Health Policy Nurse">Health Policy Nurse</li>
              <li data-value="Hematology Nurse">Hematology Nurse</li>
              <li data-value="HIV/AIDS Nurse">HIV/AIDS Nurse</li>
              <li data-value="Holistic Care Nurse">Holistic Care Nurse</li>
              <li data-value="Home Health Nurse">Home Health Nurse</li>
              <li data-value="Hospice Care Nurse">Hospice Care Nurse</li>
              <li data-value="In vitro Fertilization (IVF) Nurse">In vitro Fertilization (IVF) Nurse</li>
              <li data-value="Infection Control Nurse">Infection Control Nurse</li>
              <li data-value="Informaticists Nurse">Informaticists Nurse</li>
              <li data-value="Infusion Nurse">Infusion Nurse</li>
              <li data-value="Intensive Care Unit (ICU) / Critical Care Nurse">Intensive Care Unit (ICU) / Critical Care Nurse</li>
              <li data-value="International Medicine Nurse">International Medicine Nurse</li>
              <li data-value="Labor and Delivery Nurse">Labor and Delivery Nurse</li>
              <li data-value="Lactation Consultant Nurse">Lactation Consultant Nurse</li>
              <li data-value="Legal Nurse Consultant">Legal Nurse Consultant</li>
              <li data-value="LGBTQ Nurse">LGBTQ Nurse</li>
              <li data-value="Licensed Practical Nurse (LPN)">Licensed Practical Nurse (LPN)</li>
              <li data-value="Long-Term Care Nurse">Long-Term Care Nurse</li>
              <li data-value="Maternity Nurse">Maternity Nurse</li>
              <li data-value="Medical Administration">Medical Administration</li>
              <li data-value="Medical Equipment Manufacturing">Medical Equipment Manufacturing</li>
              <li data-value="Medical-Surgical Nurse">Medical-Surgical Nurse</li>
              <li data-value="Mental Health Nurse">Mental Health Nurse</li>
              <li data-value="Men's Health Nurse">Men's Health Nurse</li>
              <li data-value="Midwife Nurse">Midwife Nurse</li>
              <li data-value="Military Registered Nurse">Military Registered Nurse</li>
              <li data-value="Mother-Baby Nurse">Mother-Baby Nurse</li>
              <li data-value="Neonatal Nurse">Neonatal Nurse</li>
              <li data-value="Neonatal Intensive Care Unit (NICU) Nurse">Neonatal Intensive Care Unit (NICU) Nurse</li>
              <li data-value="Nephrology Nurse">Nephrology Nurse</li>
              <li data-value="Neuro ICU Nurse">Neuro ICU Nurse</li>
              <li data-value="Neurology Nurse">Neurology Nurse</li>
              <li data-value="Neuroscience Nurse">Neuroscience Nurse</li>
              <li data-value="Newborn Nursery Nurse">Newborn Nursery Nurse</li>
              <li data-value="Nurse Administrator">Nurse Administrator</li>
              <li data-value="Nurse Attorney">Nurse Attorney</li>
              <li data-value="Nurse Case Manager">Nurse Case Manager</li>
              <li data-value="Nurse Educator">Nurse Educator</li>
              <li data-value="Nurse Facilitator">Nurse Facilitator</li>
              <li data-value="Nurse Health Coach">Nurse Health Coach</li>
              <li data-value="Nurse Midwife">Nurse Midwife</li>
              <li data-value="Nurse Navigator">Nurse Navigator</li>
              <li data-value="Nurse Recruiter">Nurse Recruiter</li>
              <li data-value="Nurse Writer">Nurse Writer</li>
              <li data-value="Nursing Home Nurse">Nursing Home Nurse</li>
              <li data-value="Nutrition Nurse">Nutrition Nurse</li>
              <li data-value="Obstetric (OB)/ Labor Delivery (L&D) Nurse">Obstetric (OB)/ Labor Delivery (L&D) Nurse</li>
              <li data-value="Occupational Health Nurse">Occupational Health Nurse</li>
              <li data-value="Oncology Nurse">Oncology Nurse</li>
              <li data-value="Operating Room (OR) / Surgical Nurse">Operating Room (OR) / Surgical Nurse</li>
              <li data-value="Ophthalmic Nurse">Ophthalmic Nurse</li>
              <li data-value="Orthopedic Nurse">Orthopedic Nurse</li>
              <li data-value="Ostomy Nurse">Ostomy Nurse</li>
              <li data-value="Otorhinolaryngology Nurse">Otorhinolaryngology Nurse</li>
              <li data-value="Pain Management Nurse">Pain Management Nurse</li>
              <li data-value="Palliative Care Nurse">Palliative Care Nurse</li>
              <li data-value="Parish Registered Nurse">Parish Registered Nurse</li>
              <li data-value="Pediatric Care Nurse">Pediatric Care Nurse</li>
              <li data-value="Pediatric Intensive Care Nurse">Pediatric Intensive Care Nurse</li>
              <li data-value="Perinatal Nurse">Perinatal Nurse</li>
              <li data-value="Perioperative Nurse">Perioperative Nurse</li>
              <li data-value="Pharmaceutical Research Nurse">Pharmaceutical Research Nurse</li>
              <li data-value="Plastic Surgery Nurse">Plastic Surgery Nurse</li>
              <li data-value="Poison Control Registered Nurse">Poison Control Registered Nurse</li>
              <li data-value="Post-Anesthesia Care Unit (PACU) Nurse">Post-Anesthesia Care Unit (PACU) Nurse</li>
              <li data-value="Postpartum Nurse">Postpartum Nurse</li>
              <li data-value="Primary Care Nurse">Primary Care Nurse</li>
              <li data-value="Private Duty Nurse">Private Duty Nurse</li>
              <li data-value="Progressive Care Unit (PCU) Nurse">Progressive Care Unit (PCU) Nurse</li>
              <li data-value="Psychiatric Nurse">Psychiatric Nurse</li>
              <li data-value="Public Health Nurse">Public Health Nurse</li>
              <li data-value="Pulmonary Nurse">Pulmonary Nurse</li>
              <li data-value="Quality Assurance Nurse">Quality Assurance Nurse</li>
              <li data-value="Quality Improvement Nurse">Quality Improvement Nurse</li>
              <li data-value="Radiology Nurse">Radiology Nurse</li>
              <li data-value="Registered Nurse First Assistant (RNFA)">Registered Nurse First Assistant (RNFA)</li>
              <li data-value="Rehabilitation Nurse">Rehabilitation Nurse</li>
              <li data-value="Research Nurse">Research Nurse</li>
              <li data-value="Respiratory Nurse">Respiratory Nurse</li>
              <li data-value="Rheumatology Nurse">Rheumatology Nurse</li>
              <li data-value="RN Case Manager">RN Case Manager</li>
              <li data-value="Rural/Remote Area Health Nurse">Rural/Remote Area Health Nurse</li>
              <li data-value="School Nurse">School Nurse</li>
              <li data-value="Sexual Assault Nurse Examiner (SANE)">Sexual Assault Nurse Examiner (SANE)</li>
              <li data-value="Student Registered Nurse">Student Registered Nurse</li>
              <li data-value="Sub-acute Nurse">Sub-acute Nurse</li>
              <li data-value="Substance Abuse Nurse">Substance Abuse Nurse</li>
              <li data-value="Surgical Nurse">Surgical Nurse</li>
              <li data-value="Teaching Nurse">Teaching Nurse</li>
              <li data-value="Telehealth Nurse">Telehealth Nurse</li>
              <li data-value="Telemetry Nurse">Telemetry Nurse</li>
              <li data-value="Telephone Triage Nurse">Telephone Triage Nurse</li>
              <li data-value="Temporary Nurse Aide">Temporary Nurse Aide</li>
              <li data-value="Toxicology Nurse">Toxicology Nurse</li>
              <li data-value="Transcultural Nurse">Transcultural Nurse</li>
              <li data-value="Transplant Nurse">Transplant Nurse</li>
              <li data-value="Trauma Nurse">Trauma Nurse</li>
              <li data-value="Travel Nurse">Travel Nurse</li>
              <li data-value="Triage Nurse">Triage Nurse</li>
              <li data-value="Urology Nurse">Urology Nurse</li>
              <li data-value="Utilization Management Nurse">Utilization Management Nurse</li>
              <li data-value="Utilization Review Nurse">Utilization Review Nurse</li>
              <li data-value="Vascular Access Nurse">Vascular Access Nurse</li>
              <li data-value="Wound Care Nurse">Wound Care Nurse</li>
              <!-- Add more list items as needed -->
            </ul>
          <select class="js-example-basic-multiple" data-list-id="registerd-nurse" name="states[]" multiple="multiple"></select>
        </div>

        <div class="form-group drp--clr d-none" id="aprn">
          <label class="form-label" for="input-4">Advanced Practice Registered Nurses (APRNs) <br>Jobs</label>
            <ul id="advanced-practice" style="display:none;">
              <li data-value="Academic Nurse Educator">Academic Nurse Educator</li>
              <li data-value="Administrator Nurse">Administrator Nurse</li>
              <li data-value="Nurse Anesthetist (CRNA)">Nurse Anesthetist (CRNA)</li>
              <li data-value="Clinical Nurse Educator">Clinical Nurse Educator</li>
              <li data-value="Midwife Nurse">Midwife Nurse</li>
              <li data-value="Nurse Manager">Nurse Manager</li>
              <li data-value="Nurse Practitioner (NP)">Nurse Practitioner (NP)</li>
              <li data-value="Chief Nursing Officer">Chief Nursing Officer</li>
              <li data-value="Clinical Nurse Specialist">Clinical Nurse Specialist</li>
              <li data-value="Clinical Nurse Leader (CNL)">Clinical Nurse Leader (CNL)</li>
              <!-- Add more list items as needed -->
            </ul>
          <select class="js-example-basic-multiple" data-list-id="advanced-practice" name="states[]" multiple="multiple"></select>
        </div>
       </div>

         
  
  <script>
   $(document).ready(function() {
    function initializeSelect2(selector) {
        $(selector).each(function() {
            var $select = $(this);
            var listId = $select.data('list-id');
            var $list = $('#' + listId);

            $list.find('li').each(function() {
                var value = $(this).data('value');
                var text = $(this).text();
                $select.append(new Option(text, value));
            });

            $select.select2({
                placeholder: 'Select options',
                allowClear: true,
                width: '100%'  // Ensure the dropdown width is 100%
            });

            $select.on('select2:open', function() {
                var $dropdown = $('.select2-container--open .select2-dropdown');
                var searchBoxHtml = `
                    <div class="extra-search-container">
                        <input type="text" class="extra-search-box" placeholder="Search...">
                        <button class="clear-button" type="button">&times;</button>
                    </div>`;

                if ($dropdown.find('.extra-search-container').length === 0) {
                    $dropdown.prepend(searchBoxHtml);
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
    }

    // Initialize all select elements with the common class
    initializeSelect2('.js-example-basic-multiple');
  
  
});
</script>


   
                <span id="reqnurseTypeId" class="reqError valley"></span>

                <!-- <div id="nurse_select">
                  
                  <div class="form-group" id="subspecialtyGroup">
                    <label class="form-label" for="input-1">Types of Nursing Jobs</label>
                    <select class="form-input mr-10" name="nurseTypeJob[]" id="nurseTypeJob" multiple>

                    </select>
                  </div>
                  <span id="reqnurseTypeJobId" class="reqError valley"></span>
                </div> -->

                <div id="nurse_practitioner">
                  <!-- <div id="nurse_select"  style="display: none;"> -->
                  <div class="form-group" id="subspecialtyGroup">
                    <label class="form-label" for="input-1">Nurse Practitioner (NP) sub speciality</label>
                    <select class="form-input mr-10 select-active" name="nurse_practitioner_speciality[]" id="nurse_practitioner_speciality" multiple>

                    </select>
                  </div>
                  <span id="reqnurseTypeJobId" class="reqError valley"></span>
                </div>



                
                <span id="reqassistent_level" class="reqError valley"></span>


                <div class="" id="mid_select">
                  <div class="form-group">
                    <label class="form-label" for="input-1">Specialties</label>
                    <select class="form-input mr-10 specialties" name="specialties[]" id="specialties" multiple>
                    
                      @php $JobSpecialties = JobSpecialties(); @endphp
                      @foreach($JobSpecialties as $ptl)
                      <option value="{{ $ptl->id }}">{{ $ptl->name }}</option>
                      @endforeach
                    </select>
                    <span id="reqspecialties" class="reqError valley"></span>
                  </div>

                  <div class="form-group">
                    <label class="form-label" for="input-1">Sub Specialties</label>
                    <select class="form-input mr-10" name="subSpecialties[]" id="subSpecialties" multiple>
                     
                    </select>
                    <span id="reqsubSpecialties" class="reqError valley"></span>
                  </div>

                  <div class="form-group surgicalSpec">
                    <label class="form-label" for="input-1"> Sub Specialties(<span class="sub_speciality"></span>)</label>
                    <select class="form-input mr-10" name="surgicalsubSpecialties[]" id="surgicalsubSpecialties" multiple>
                     
                    </select>
                    <span id="reqsubSpecialties" class="reqError valley"></span>
                  </div>
                  <div class="form-group surgicalSubSpec">
                    <label class="form-label" for="input-1"> Sub Specialties(<span class="sub_sub_speciality"></span>)</label>
                    <select class="form-input mr-10 select-active" name="surgicalsuboneSpecialties[]" id="surgicalsuboneSpecialties" multiple>
                     
                    </select>
                    <span id="reqsubSpecialties" class="reqError valley"></span>
                  </div>
                  <div class="form-group level-drp">
                    <label class="form-label" for="input-1">What level are you?</label>
                    <!-- <input class="form-control" type="text" required="" name="fullname" placeholder="Steven Job"> -->
                    <select class="form-input mr-10 select-active" name="assistent_level">
                      
                      @for($i = 1; $i <= 30; $i++) <option value="{{ $i }}">{{ $i }}{{ $i == 1 ? 'st' : ($i == 2 ? 'nd' : ($i == 3 ? 'rd' : 'th')) }} Year</option>
                        @endfor
                    </select>
                  </div>
                  <div class="" id="mid_select">
                    <div class="form-group">
                      <label class="form-label" for="input-1">Nurse & Midwife degree</label>
                      <select class="form-input mr-10 select-active" name="degree[]" multiple>
                      
                        @php $nurse_midwife_degree = nurse_midwife_degree(); @endphp
                        @foreach($nurse_midwife_degree as $ptl)
                        <option value="{{ $ptl->id }}">{{ $ptl->name }}</option>
                        @endforeach
                      </select>
                      <span id="reqdegree" class="reqError valley"></span>
                    </div>

                  </div>

                </div>
        
        <div class="step_nxt">
                <div class="d-flex align-items-center justify-content-between">
                  <!-- 
                  <button type="button" class="btn btn-border-brand-2 prev-step">Previous</button> -->

                  <button type="button" class="btn btn-default w-100 next-step">Next</button>
                  <!-- <button type="button" class="btn btn-default next-step">Next</button> -->
                </div>
        </div>
              </div>
            </div>

          </div>

</div>
<div class="step step-2">
            <!-- Step 2 form fields here -->

            <div class="row ">
              <div class="col-lg-5 col-md-6 col-sm-12 mx-auto">
                <div class="text-center">
                  <!-- <p class="font-sm text-brand-2">Register </p> -->
                  <h2 class="mt-10 mb-5 text-brand-1 fs_24">You are moments away from job opportunities</h2>
                </div>

                <div class="login-register text-start mt-20" action="#">
                  
                  <div class="form-group">
                    <label class="form-label" for="input-1"> First Name *</label>
                    <input class="form-control" type="text" required="" name="fullname" id="firstNameI" placeholder="Enter Your First name" onkeydown="return /[a-z]/i.test(event.key)">
                    <span id="reqTxtfirstNameI" class="reqError valley"></span>
                  </div>
                  <div class="form-group">
                    <label class="form-label" for="input-1">Last Name *</label>
                    <input class="form-control" type="text" required="" name="lastname" id="lastNameI" placeholder="Enter Your Last name" onkeydown="return /[a-z]/i.test(event.key)">
                    <span id="reqTxtlastNameI" class="reqError valley"></span>
                  </div>

                  <div class="form-group">
                    <label class="form-label" for="input-2">Email *</label>
                    <input class="form-control" type="email" name="email" id="emailI" onkeyup="emailVerifi()" placeholder="stevenjob@gmail.com">
                    <span id="reqTxtemailI" class="reqError valley"></span>
                  </div>

                  <!-- <div class="form-group">
                    <label class="form-label" for="input-3">Confirm Email *</label>
                    <input class="form-control" type="email" name="confirmEmail" id="confirmEmail" onkeyup="emailVerification()" placeholder="stevenjob@gmail.com">
                    <span id="reqTxtconfirmEmail" class="reqError valley"></span>
                </div> -->
                  <div class="form-group">
                    <label class="form-label" for="input-3">Mobile Number *</label>

                    <div class="row">
                      <!-- <div class="col-md-3">
                        <select name="countryCode" id="countryCode" class="form-control" placeholder="C. Code" aria-label="Default select example">
                          @php $country_phone_code = country_phone_code();@endphp
                          @forelse($country_phone_code as $cpc)
                          @if($cpc->phonecode!='0')
                          <option data-countryCode="GB" value="{{ $cpc->phonecode}}" @if($cpc->name == "Australia") selected @endif>(+{{ $cpc->phonecode}})</option>
                          @endif
                          @empty
                          @endforelse
                        </select>
                      </div> -->
                      <div class="col-md-12">
                        <input type="hidden" name="countryCode" id="countryCode">
                        <input class="form-control numbers" type="text" required="" name="contact" id="contactI" placeholder="1234567890" maxlength="10" pattern="[0-9]{4}">
                        <span id="reqTxtcontactI" class="reqError valley"></span>
                      </div>
                    </div>



                  </div>
                  <div class="form-group">
                    <label class="form-label" for="input-4">Post Code *</label>
                    <input class="form-control numbers" type="text" required="" name="post_code" id="post_codeI" placeholder="123456" maxlength="10">
                    <span id="reqTxtpost_codeI" class="reqError valley"></span>
                  </div>
                  <div class="form-group">
                    <label class="form-label" for="input-4">Password *</label>
                    <input class="form-control" type="password" required="" name="password" id="passwordI" placeholder="********">
                    <span id="reqTxtpasswordI" class="reqError valley"></span>
                  </div>
                  <div class="form-group">
                    <label class="form-label" for="input-4">Confirm Password *</label>
                    <input class="form-control" type="password" required="" id="confirm_passwordI" name="confirm_password" placeholder="********">
                    <span id="reqTxtconfirm_passwordI" class="reqError valley"></span>
                  </div>

                  <!--<div class="login_footer form-group d-flex justify-content-between">-->
                  <!--  <label class="cb-container">-->
                  <!--    <input type="checkbox"><span class="text-small">Agree our terms and policy</span><span class="checkmark"></span>-->
                  <!--  </label><a class='text-muted' href='#'>Lean more</a>-->
                  <!--</div>-->
                </div>

                
        <div class="d-flex align-items-center justify-content-between">
                  <button type="button" class="btn btn-border-brand-2 prev-step">Previous</button>
                  <!--<a type="button" class="btn btn-default" href="email_verification.php">Submit &amp; Register</a>-->
                  <button onclick="dosignup()" class="btn btn-default px-5 py-8  rounded-2 mb-0 submit-btn-120" type="submit"><span class="resetpassword">Submit &amp; Register</span>
                    <div class="spinner-border submit-btn-1" role="status" style="display:none;">
                      <span class="sr-only">Loading...</span>
                    </div>
                  </button>
                </div>
        



              </div>
            </div>



          </div>

          <div class="step step-3">

            <h1>Step 3</h1>


          </div>
</form>


    </div>

  </section>
</main>





@endsection
@section('js')
<script type="text/javascript">
  $(document).ready(function() {
    $('.option1').on('click', function() {
      $('#nurse_select').removeClass('d-none');
    });

    $('.option2').on('click', function() {
      $('#mid_select').removeClass('d-none');
    });
  });
</script>



<script type="text/javascript">
  var currentStep = 1;
  var updateProgressBar;


  $(document).ready(function() {
    $('#multi-step-form').find('.step').slice(1).hide();

    $(".next-step").click(function() {


      if (currentStep == 1) {
        
        if (validateForm() == false) {
          return false;
        } 

        currentStep++;
        $(".step-" + currentStep).addClass("animate__animated animate__fadeOutLeft");

        setTimeout(function() {
          $(".step").removeClass("animate__animated animate__fadeOutLeft").hide();
          $(".step-" + currentStep).show().addClass("animate__animated animate__fadeInRight");
          updateProgressBar();
        }, 500);
      }
    });

    $(".prev-step").click(function() {
      if (currentStep > 1) {
        $(".step-" + currentStep).addClass("animate__animated animate__fadeOutRight");
        currentStep--;
        setTimeout(function() {
          $(".step").removeClass("animate__animated animate__fadeOutRight").hide();
          $(".step-" + currentStep).show().addClass("animate__animated animate__fadeInLeft");
          updateProgressBar();
        }, 500);
      }
    });

    updateProgressBar = function() {
      var progressPercentage = ((currentStep - 1) / 2) * 100;
      $(".progress-bar").css("width", progressPercentage + "%");
    }
  });
</script>
<script>
  function validate(step_no) {

  }
</script>
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
</script>
<script>
  function validateForm() {
    var isValid = true;
    $('.reqError ').html("");
    $('[name="nurseType[]"]').next('.text-danger').remove();

    $('[name="nurseTypeJob[]"]').next('.text-danger').remove();

    $('[name="assistent_level"]').next('.text-danger').remove();
    $('[name="specialties[]"]').next('.text-danger').remove();
    $('[name="subSpecialties[]"]').next('.text-danger').remove();


    // Validate nurseType select
    if ($('[name="nurseType[]"]').val() == '') {
      document.getElementById("reqnurseTypeId").innerHTML = "* Please select one or more Type of nurse";
      isValid = false;
    }
    if ($('#nurse_select').css('display') !== 'none') {
      // Validate nurseTypeJob select nurseTypeJob
      if ($('[name="nurseTypeJob[]"]').val() == '') {
        document.getElementById("reqnurseTypeJobId").innerHTML = "* Please select one or more Type of Nursing Jobs";
        isValid = false;

      }

    }
    // Validate assistant level select
    if ($('[name="assistent_level"]').val() == '') {
      document.getElementById("reqassistent_level").innerHTML = "*  Please select on what level are you ?";
      isValid = false;
    }

    // Validate  Specialties type select
    if ($('[name="specialties[]"]').val() == '') {
      document.getElementById("reqspecialties").innerHTML = "* Please select one or more specialties.";
      isValid = false;
    }
    // Validate sub Specialties type select
    if ($('[name="subSpecialties[]"]').val() == '') {
      document.getElementById("reqsubSpecialties").innerHTML = "* Please select one or more sub-Specialties.";
      isValid = false;
    }

    // Validate  NURSE & MIDWIFE DEGREE type select
    if ($('[name="degree[]"]').val() == '') {
      document.getElementById("reqdegree").innerHTML = "* Please select one or more degree.";
      isValid = false;
    }
    return isValid;
  }
</script>
<script>
  function emailVerifi() {
    var mail = document.getElementById('emailI').value;


    $.ajax({
      type: 'POST',
      url: "{{route('nurse.mail-exist')}}",
      data: {
        "email": mail,
      },
      dataType: 'JSON',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(resp) {
        if (resp.status == 1) {
          document.getElementById("reqTxtemailI").innerHTML = "*" + resp.message;
          //  $('#emailI').val('');
          $('#nexres').prop('disabled', true);


        }
        if (resp.status == 0) {
          document.getElementById("reqTxtemailI").innerHTML = "";
          $('#nexres').prop('disabled', false);
        }
      }
    });

    return false;

  }
</script>
<script>
  function dosignup() {

    event.preventDefault();

    $(".valley").html("");

    $('.submit-btn-120').prop('disabled', true);

    $('.submit-btn-1').show();

    $('.resetpassword').hide();

    var returnValue;

    var firstNameI = document.getElementById("firstNameI").value;
    var lastNameI = document.getElementById("lastNameI").value;


    var countryCode = document.getElementById("countryCode").value;

    var contactI = document.getElementById("contactI").value;



    var post_codeI = document.getElementById("post_codeI").value;
    var emailI = document.getElementById("emailI").value;
    //var confirmEmail = document.getElementById("confirmEmail").value;


    var passwordI = document.getElementById("passwordI").value;

    var confirm_passwordI = document.getElementById("confirm_passwordI").value;


    returnValue = true;
    if (emailI.trim() == "") {

      document.getElementById("reqTxtemailI").innerHTML = "* Please enter the Email address.";

      returnValue = false;

    }
    // if (confirmEmail.trim() == "") {

    //   document.getElementById("reqTxtconfirmEmail").innerHTML = "* Please enter the Confirm Email address.";

    //   returnValue = false;

    // }

    



    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

    if (emailI.match(mailformat)) {

      returnValue = true;

    } else {

      document.getElementById("reqTxtemailI").innerHTML = "* Please enter the  Email address.";

      returnValue = false;

    }

   
    if (firstNameI.trim() == "") {

      document.getElementById("reqTxtfirstNameI").innerHTML = "* Please enter the First Name .";

      returnValue = false;

    }
    if (lastNameI.trim() == "") {

      document.getElementById("reqTxtlastNameI").innerHTML = "* Please enter the Last Name .";

      returnValue = false;

    }
    if (post_codeI.trim() == "") {

      document.getElementById("reqTxtpost_codeI").innerHTML = "* Please enter the Post Code .";

      returnValue = false;

    }

    if (countryCode.trim() == "") {
      document.getElementById("reqTxtcountryCode").innerHTML = "*  Select the country code.";
      returnValue = false;
    }


    if (contactI.trim() == "") {

      document.getElementById("reqTxtcontactI").innerHTML = "* Please enter the Phone Number .";

      returnValue = false;

    }









    if (passwordI.trim() == "") {

      document.getElementById("reqTxtpasswordI").innerHTML = "*  Please enter the PasswordI.";

      returnValue = false;

    }

    if (passwordI.length < 6) {

      document.getElementById("reqTxtpasswordI").innerHTML = "*  Your password must be at least 6 characters long";

      returnValue = false;

    }

    if (confirm_passwordI == "") {

      document.getElementById("reqTxtconfirm_passwordI").innerHTML = "* Please Enter the Confirm password.";

      returnValue = false;

    }

    if (passwordI != confirm_passwordI) {

      document.getElementById("reqTxtconfirm_passwordI").innerHTML = "Password And Confirm password did not match.";

      returnValue = false;

    }

    // var emailError = document.getElementById("reqTxtemailI");
    //     var confirmEmailError = document.getElementById("reqTxtconfirmEmail");

    // if (emailI.trim() !== confirmEmail.trim()) {
    //         emailError.textContent = "Emails do not match";
    //         confirmEmailError.textContent = "Emails do not match";
    //         returnValue = false;
    //     } else {
    //         emailError.textContent = "";
    //         confirmEmailError.textContent = "";
    //     }

    if (returnValue == false) {

      $('.submit-btn-120').prop('disabled', false);

      $('.submit-btn-1').hide();

      $('.resetpassword').show();

    }



    if (returnValue == true) {

      let formData = new FormData($('#multi-step-form')[0]);



      $.ajax({

        type: 'POST',

        url: "{{route('nurse.do-nurse-register')}}",

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

              title: 'Registered Successfully',

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



<script type="text/javascript">
  $(document).ready(function() {
    $('#yes').click(function() {
      $('.yes_btn').addClass('activ1').siblings().removeClass('activ');
    });
    $('#no').click(function() {
      $('.no_btn').addClass('activ').siblings().removeClass('activ1');
    });
  });
</script>
 <script src= 
"https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"> 
       </script> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/intlTelInput.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>
<script>
  $(document).ready(function() {
  var phoneInputID = "#contactI";
  var input = document.querySelector(phoneInputID);
  var iti = window.intlTelInput(input, {
    // allowDropdown: false,
    // autoHideDialCode: false,
    // autoPlaceholder: "off",
    // dropdownContainer: document.body,
    // excludeCountries: ["us"],
    formatOnDisplay: true,
    // geoIpLookup: function(callback) {
    //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
    //     var countryCode = (resp && resp.country) ? resp.country : "";
    //     callback(countryCode);
    //   });
    // },
    hiddenInput: "full_number",
    initialCountry: "AU",
    // localizedCountries: { 'de': 'Deutschland' },
    // nationalMode: false,
    // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
    // placeholderNumberType: "MOBILE",
    preferredCountries: ['AU'],
    // separateDialCode: true,
    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.14/js/utils.js"
  });


  $(phoneInputID).on("countrychange", function(event) {

    // Get the selected country data to know which country is selected.
    var selectedCountryData = iti.getSelectedCountryData();
    console.log("selectedCountryData",selectedCountryData.dialCode);
    $("#countryCode").val(selectedCountryData.dialCode);
    //alert($("#contactI").intlTelInput("getSelectedCountryData").dialCode);
    // Get an example number for the selected country to use as placeholder.
    newPlaceholder = intlTelInputUtils.getExampleNumber(selectedCountryData.iso2, true, intlTelInputUtils.numberFormat.INTERNATIONAL),

      // Reset the phone number input.
      iti.setNumber("");

    // Convert placeholder as exploitable mask by replacing all 1-9 numbers with 0s
    mask = newPlaceholder.replace(/[1-9]/g, "0");

    // Apply the new mask for the input
    $(this).mask(mask);
  });


  // When the plugin loads for the first time, we have to trigger the "countrychange" event manually, 
  // but after making sure that the plugin is fully loaded by associating handler to the promise of the 
  // plugin instance.

  iti.promise.then(function() {
    $(phoneInputID).trigger("countrychange");
  });

});
   $(document).ready(function () { 
                //Select2 
                $(".country").select2(); 
                $(".specialties").select2();
                $("#nurseTypeJob").select2();
                $("#subSpecialties").select2();
                $("#surgicalsubSpecialties").select2();
                
                $(".country").change(function () {
                  var selectedValues = $(this).val();
                  if (selectedValues && selectedValues.length > 0) {
                    $.ajax({
                      url: "{{ route('getNurseTypeJobs') }}",
                      type: "POST",
                      data: {
                        nurseTypes: selectedValues,
                        _token: '{{ csrf_token() }}'
                      },
                      dataType: 'json',
                      success: function(response) {
                        $('#nurse_select').show();
                        $('#nurseTypeJob').empty();
                        $.each(response, function(index, job) {
                          $('#nurseTypeJob').append('<option value="' + job.id + '">' + job.name + '</option>');
                        });
                      },
                      error: function(xhr, status, error) {
                        console.error(error);
                      }
                    });
                  } else {
                    $('#nurse_select').hide();
                    $('#nurseTypeJob').empty();
                  }
                });
                $(".surgicalSpec").hide();
                $(".surgicalSubSpec").hide();
                var subSpecialtiesArray = [];
                $("#subSpecialties").change(function () {
                  var selectedValues = $(this).val();
                  if (selectedValues && selectedValues.length > 0) {
                    $.ajax({
                      url: "{{ route('getsurgicalSpeciality') }}",
                      type: "POST",
                      data: {
                        surgical_speciality: selectedValues,
                        _token: '{{ csrf_token() }}'
                      },
                      dataType: 'json',
                      success: function(response) {

                        if(response.length>0){
                          var selectedValuesText = $("#subSpecialties option:selected").text();
                          subSpecialtiesArray.push(selectedValuesText);
                           
                          console.log("selectedValuesText",subSpecialtiesArray.join(","));
                          $(".sub_speciality").text(subSpecialtiesArray);
                          $(".surgicalSpec").show();
                        }
                        $('#surgicalsubSpecialties').empty();
                        $.each(response, function(index, job) {
                          $('#surgicalsubSpecialties').append('<option value="' + job.id + '">' + job.name + '</option>');
                        });
                      },
                      error: function(xhr, status, error) {
                        console.error(error);
                      }
                    });
                  } else {
                    $('#nurse_select').hide();
                    $('#nurseTypeJob').empty();
                  }
                });
                var sub_subSpecialtiesArray = [];
                $("#surgicalsubSpecialties").change(function () {

                  var selectedValues = $(this).val();
                  console.log("selectedValues",selectedValues);
                  if (selectedValues && selectedValues.length > 0) {
                    $.ajax({
                      url: "{{ route('getsurgicalSubSpeciality') }}",
                      type: "POST",
                      data: {
                        surgical_sub_speciality: selectedValues,
                        _token: '{{ csrf_token() }}'
                      },
                      dataType: 'json',
                      success: function(response) {
                        console.log("response",response);
                        if(response.length>0){
                          var selectedValuesText = $("#surgicalsubSpecialties option:selected").text();
                          sub_subSpecialtiesArray.push(selectedValuesText) 
                          console.log("selectedValuesText",sub_subSpecialtiesArray.join(","));
                          $(".sub_sub_speciality").text(sub_subSpecialtiesArray);
                          $(".surgicalSubSpec").show();
                          
                          
                        }
                        $('#surgicalsuboneSpecialties').empty();
                        $.each(response, function(index, job) {
                          $('#surgicalsuboneSpecialties').append('<option value="' + job.id + '">' + job.name + '</option>');
                        });
                      },
                      error: function(xhr, status, error) {
                        console.error(error);
                      }
                    });
                  } else {
                    $('#nurse_select').hide();
                    $('#nurseTypeJob').empty();
                  }
                });
            }); 
 $('#nurse_practitioner').hide(); 
 $("#nurseTypeJob").change(function () {
  var selectedValues = $(this).val();
  $.ajax({
    url: "{{ route('getNursepractitionorSpecialities') }}",
    type: "POST",
    data: {
      nurseTypeSpecialities: selectedValues,
      _token: '{{ csrf_token() }}'
    },
    dataType: 'json',
    success: function(response) {
      if(response.length>0){
        $('#nurse_practitioner').show();
      }
      // $('#nurseTypeJob').empty();
      $.each(response, function(index, job) {
        $('#nurse_practitioner_speciality').append('<option value="' + job.id + '">' + job.name + '</option>');
      });
    },
    error: function(xhr, status, error) {
      console.error(error);
    }
  });
 });
  // $(document).ready(function() {
  //   $('#nurseType').change(function() {
  //     var selectedValues = $(this).val();
  //     if (selectedValues && selectedValues.length > 0) {
  //       $.ajax({
  //         url: "{{ route('getNurseTypeJobs') }}",
  //         type: "POST",
  //         data: {
  //           nurseTypes: selectedValues,
  //           _token: '{{ csrf_token() }}'
  //         },
  //         dataType: 'json',
  //         success: function(response) {
  //           $('#nurse_select').show();
  //           $('#nurseTypeJob').empty();
  //           $.each(response, function(index, job) {
  //             $('#nurseTypeJob').append('<option value="' + job.id + '">' + job.name + '</option>');
  //           });
  //         },
  //         error: function(xhr, status, error) {
  //           console.error(error);
  //         }
  //       });
  //     } else {
  //       $('#nurse_select').hide();
  //       $('#nurseTypeJob').empty();
  //     }
  //   });
  // });
</script>
<script>
  $(document).ready(function() {
    $('#specialties').change(function() {
      var selectedValues = $(this).val();
      $('#subSpecialties').empty(); // Clear sub-specialties dropdown
      if (selectedValues && selectedValues.length > 0) {
        // Make an AJAX request to fetch sub-specialties based on selected specialties
        $.ajax({
          url: "{{ route('getSubSpecialties') }}",
          type: "POST",
          data: {
            specialties: selectedValues,
            // Add CSRF token to the data
            _token: '{{ csrf_token() }}'
          },
          dataType: 'json',
          success: function(response) {
            $.each(response, function(index, subSpecialty) {
              $('#subSpecialties').append('<option value="' + subSpecialty.id + '">' + subSpecialty.name + '</option>');
            });
          },
          error: function(xhr, status, error) {
            console.error(error);
          }
        });
      }
    });
  });
</script>
<script>
    function emailVerification() {
        var email = document.getElementById("emailI").value;
        var confirmEmail = document.getElementById("confirmEmail").value;
        var emailError = document.getElementById("reqTxtemailI");
        var confirmEmailError = document.getElementById("reqTxtconfirmEmail");

        if (email !== confirmEmail) {
            emailError.textContent = "Emails do not match";
            confirmEmailError.textContent = "Emails do not match";
        } else {
            emailError.textContent = "";
            confirmEmailError.textContent = "";
        }
    }
</script>

@endsection