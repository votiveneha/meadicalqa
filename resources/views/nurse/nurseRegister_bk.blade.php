@extends('nurse.layouts.layout')
@section('css')
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
    padding-bottom: 0px;
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

  .step-2 input {
    border: 1px solid #dedddd !important;
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
            <div class="step-circle first_step registration_progress" onclick="displayStep(1)">1</div>
            <div class="step-circle second_step" onclick="displayStep(2)">2</div>
            <!-- <div class="step-circle" onclick="displayStep(3)">3</div> -->
          </div>
        </div>
      </div>


      <form id="multi-step-form">
        @csrf
        <div class="step step-1">
          <!-- Step 1 form fields here -->
          <div class="row form-block">
            <div class="col-lg-12 col-md-6 col-sm-12 mx-auto">
              <div class="text-center">
                <!-- <p class="font-sm text-brand-2">Register </p> -->
                <h2 class="mt-10 mb-5 text-brand-1 fs_24">Please select your level and specialties<br>
                  You can select multiple options</h2>

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
                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="type-of-nurse" name="nurseType[]" multiple="multiple" id="nurse_type_one"></select>
                    <span id="reqnurseTypeId" class="reqError valley"></span>
                  </div>
                </div>

                <div class="result--show ">
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
                      <input type="hidden" name="nursing_result" class="nursing_result-{{ $i }}" value="{{ $spl->id }}">
                      <div class="nursing_data form-group drp--clr d-none col-md-4 drpdown-set nursing_{{ $spl->id }}" id="nursing_level-{{ $i }}">
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
                    <span id="reqspecialties" class="reqError valley"></span>
                  </div>
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
                  <div class="speciality_data form-group drp--clr d-none drpdown-set col-md-6 speciality_{{ $ptl->id }}" id="specility_level-{{ $l }}">
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
                  <div class="surgical_row surgical_row-{{ $w }} form-group drp--clr drpdown-set d-none col-md-4">
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
                  <div class="surgical_rowp surgical_rowp-{{ $q }} form-group drp--clr drpdown-set d-none col-md-4">
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
                  <select class="form-input mr-10 select-active assistent_level" name="assistent_level" id="assistent_level">

                    @for($i = 1; $i <= 30; $i++) <option value="{{ $i }}">{{ $i }}{{ $i == 1 ? 'st' : ($i == 2 ? 'nd' : ($i == 3 ? 'rd' : 'th')) }} Year</option>
                      @endfor
                  </select>
                  <span id="reqassistent_level" class="reqError valley"></span>
                </div>
                <div class="" id="mid_select">
                  <div class="form-group">
                    <!-- <label class="form-label" for="input-1">Nurse & Midwife degree</label>
                      <select class="form-input mr-10 select-active" name="degree[]" multiple>
                        <?php
                        $nurse_midwife_degree = DB::table("degree")->where('status', '1')->orderBy('name')->get();
                        ?>
                        
                        @foreach($nurse_midwife_degree as $ptl)
                        <option value="{{ $ptl->id }}">{{ $ptl->name }}</option>
                        @endforeach
                      </select>
                      <span id="reqdegree" class="reqError valley"></span> -->
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
                    <span id="reqdegree" class="reqError valley"></span>
                  </div>

                </div>





                <!-- Add All button & Remove all button code start -->
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

                <script>
                  $(document).ready(function() {
                    // Initialize Select2
                    $('.js-example-basic-multiple').select2();

                    //$('#nurse_type_one').select2().val(['1','2']).trigger('change');
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
                </script>

                <script>
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
                    var nurse_array = [];

                    //   var get_nurese_array = localStorage.getItem("type_of_nurse");
                    // console.log("get_nurese_array1",JSON.parse(get_nurese_array));
                    // $('.js-example-basic-multiple[data-list-id="type-of-nurse"]').val(JSON.parse(get_nurese_array)).trigger('change');
                    // if(get_nurese_array != ""){
                    //   var nurse_type_list = $('.js-example-basic-multiple[data-list-id="type-of-nurse"]').select2("data");
                    //   for(var x=0;x<nurse_type_list.length;x++){
                    //     $(".nursing_"+nurse_type_list[x].id).removeClass('d-none');
                    //   }
                    // }
                    // var nursing_type_data_one = localStorage.getItem("nursing_type_data-1");
                    // var nursing_type_data_two = localStorage.getItem("nursing_type_data-2");
                    // var nursing_type_data_three = localStorage.getItem("nursing_type_data-3");

                    // if(nursing_type_data_one != ""){
                    //   $('.js-example-basic-multiple[data-list-id="nursing_entry-1"]').val(JSON.parse(nursing_type_data_one)).trigger('change');
                    // }

                    // if(nursing_type_data_two != ""){
                    //   $('.js-example-basic-multiple[data-list-id="nursing_entry-2"]').val(JSON.parse(nursing_type_data_two)).trigger('change');
                    // }

                    // if(nursing_type_data_three != ""){
                    //   $('.js-example-basic-multiple[data-list-id="nursing_entry-3"]').val(JSON.parse(nursing_type_data_three)).trigger('change');
                    // }

                    // var specialities_type_list = $('.js-example-basic-multiple[data-list-id="specialties"]').select2("data");
                    // for(var x=0;x<specialities_type_list.length;x++){
                    //   $(".nursing_"+specialities_type_list[x].id).removeClass('d-none');
                    // }

                    // if(nursing_type_data_three){
                    //   if(nursing_type_data_three.includes("179")){
                    //     var np_data = localStorage.getItem("np_array");
                    //     $(".np_submenu").removeClass('d-none');
                    //     $('.js-example-basic-multiple[data-list-id="nurse_practitioner_menu"]').val(JSON.parse(np_data)).trigger('change');
                    //   }
                    // }
                    // var get_specialities_array = localStorage.getItem("specialities_array");
                    // console.log("specialities_array",JSON.parse(get_specialities_array));
                    // $('.js-example-basic-multiple[data-list-id="specialties"]').val(JSON.parse(get_specialities_array)).trigger('change');

                    // var speciality_type_list = $('.js-example-basic-multiple[data-list-id="specialties"]').select2("data");
                    // for(var x=0;x<speciality_type_list.length;x++){
                    //   $(".speciality_"+speciality_type_list[x].id).removeClass('d-none');
                    // }

                    // var speciality_type_data_one = localStorage.getItem("speciality_type_array-1");
                    // var speciality_type_data_two = localStorage.getItem("speciality_type_array-2");
                    // var speciality_type_data_three = localStorage.getItem("speciality_type_array-3");
                    // var speciality_type_data_four = localStorage.getItem("speciality_type_array-4");
                    // $('.js-example-basic-multiple[data-list-id="speciality_entry-1"]').val(JSON.parse(speciality_type_data_one)).trigger('change');
                    // $('.js-example-basic-multiple[data-list-id="speciality_entry-2"]').val(JSON.parse(speciality_type_data_two)).trigger('change');
                    // $('.js-example-basic-multiple[data-list-id="speciality_entry-3"]').val(JSON.parse(speciality_type_data_three)).trigger('change');
                    // $('.js-example-basic-multiple[data-list-id="speciality_entry-4"]').val(JSON.parse(speciality_type_data_four)).trigger('change');

                    // if(speciality_type_data_one){
                    //   if(speciality_type_data_one.includes("96")){
                    //     $(".surgical_row_data").removeClass('d-none');
                    //     var surgicaladults_data = localStorage.getItem("surgicaladults_array");
                    //     $('.js-example-basic-multiple[data-list-id="surgical_row_box"]').val(JSON.parse(surgicaladults_data)).trigger('change');

                    //     var surgicalop_one = localStorage.getItem("surgicaladults_type_array-1");
                    //     var surgicalop_two = localStorage.getItem("surgicaladults_type_array-2");
                    //     var surgicalop_three = localStorage.getItem("surgicaladults_type_array-3");

                    //     if(surgicalop_one != ""){
                    //       $(".surgical_row-1").removeClass('d-none');
                    //       $('.js-example-basic-multiple[data-list-id="surgical_operative_care-1"]').val(JSON.parse(surgicalop_one)).trigger('change');
                    //     }
                    //     if(surgicalop_two != ""){
                    //       $(".surgical_row-2").removeClass('d-none');
                    //       $('.js-example-basic-multiple[data-list-id="surgical_operative_care-2"]').val(JSON.parse(surgicalop_two)).trigger('change');
                    //     }
                    //     if(surgicalop_three != ""){
                    //       $(".surgical_row-3").removeClass('d-none');
                    //       $('.js-example-basic-multiple[data-list-id="surgical_operative_care-3"]').val(JSON.parse(surgicalop_three)).trigger('change');
                    //     }
                    //   }
                    // }
                    // if(speciality_type_data_two){
                    //   if(speciality_type_data_two.includes("233")){
                    //     $(".surgicalobs_row").removeClass('d-none');
                    //     var surgicalobs_care = localStorage.getItem("mater_array");
                    //     $('.js-example-basic-multiple[data-list-id="surgical_obs_care"]').val(JSON.parse(surgicalobs_care)).trigger('change');
                    //   }
                    // }
                    // if(speciality_type_data_three){
                    //   if(speciality_type_data_three.includes("250")){
                    //     $(".neonatal_row").removeClass('d-none');
                    //     var neonatal_care = localStorage.getItem("neonatal_array");
                    //     $('.js-example-basic-multiple[data-list-id="neonatal_care"]').val(JSON.parse(neonatal_care)).trigger('change');
                    //   }
                    // }
                    // if(speciality_type_data_three){
                    //   if(speciality_type_data_three.includes("285")){
                    //     $(".surgicalpad_row_data").removeClass('d-none');
                    //     var surgicalpad_row_data = localStorage.getItem("padsurgical_array");
                    //     $('.js-example-basic-multiple[data-list-id="surgical_rowpad_box"]').val(JSON.parse(surgicalpad_row_data)).trigger('change');

                    //     var surgicalpad_one = localStorage.getItem("surgicalpad_type_array-1");
                    //     var surgicalpad_two = localStorage.getItem("surgicalpad_type_array-2");
                    //     var surgicalpad_three = localStorage.getItem("surgicalpad_type_array-3");

                    //     if(surgicalpad_one != ""){
                    //       $(".surgical_rowp-1").removeClass('d-none');
                    //       $('.js-example-basic-multiple[data-list-id="surgical_operative_carep-1"]').val(JSON.parse(surgicalpad_one)).trigger('change');
                    //     }
                    //     if(surgicalpad_two != ""){
                    //       $(".surgical_rowp-2").removeClass('d-none');
                    //       $('.js-example-basic-multiple[data-list-id="surgical_operative_carep-2"]').val(JSON.parse(surgicalpad_two)).trigger('change');
                    //     }
                    //     if(surgicalpad_three != ""){
                    //       $(".surgical_rowp-3").removeClass('d-none');
                    //       $('.js-example-basic-multiple[data-list-id="surgical_operative_carep-3"]').val(JSON.parse(surgicalpad_three)).trigger('change');
                    //     }
                    //   }
                    // }
                    // var nurse_degree_array = localStorage.getItem("nurse_degree_array");
                    // $('.js-example-basic-multiple[data-list-id="nurse_degree"]').val(JSON.parse(nurse_degree_array)).trigger('change');

                    // var level_length = $("#assistent_level option").length;
                    // console.log("level_length",level_length);
                    // var get_assistent_level = localStorage.getItem("assistent_level");
                    // console.log("get_assistent_level",get_assistent_level);
                    // $('#assistent_level').val(get_assistent_level);
                    // $("#assistent_level option").each(function(i,val){
                    //     console.log("assistent_level",$(val).attr("value"));
                    //     // if($(val).attr("value") == get_assistent_level){

                    //     //   $("#assistent_level option").attr("selected");
                    //     // }
                    //     var value = $(val).attr("value");
                    //     var text = $(val).text();
                    //     //$("#assistent_level").empty();

                    //     $('#assistent_level option[value='+get_assistent_level+']').attr('selected','selected');

                    // });



                  });
                </script>

















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
            <div class="col-lg-12 col-md-6 col-sm-12 mx-auto">
              <div class="text-center">
                <!-- <p class="font-sm text-brand-2">Register </p> -->
                <h2 class="mt-10 mb-5 text-brand-1 fs_24">You are moments away from job opportunities</h2>
              </div>

              <div class="login-register text-start mt-20" action="#">

                <div class="form-group">
                  <label class="form-label" for="input-1"> First Name *</label>
                  <input class="form-control" type="text" required="" name="fullname" id="firstNameI" placeholder="" onkeydown="return /[a-z]/i.test(event.key)">
                  <span id="reqTxtfirstNameI" class="reqError valley"></span>
                </div>
                <div class="form-group">
                  <label class="form-label" for="input-1">Last Name *</label>
                  <input class="form-control" type="text" required="" name="lastname" id="lastNameI" placeholder="" onkeydown="return /[a-z]/i.test(event.key)">
                  <span id="reqTxtlastNameI" class="reqError valley"></span>
                </div>

                <div class="form-group">
                  <label class="form-label" for="input-2">Email *</label>
                  <input class="form-control" type="email" name="email" id="emailI" onkeyup="emailVerifi()" placeholder="">
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
                    <div class="col-md-12 mob-adj">
                      <input type="hidden" name="countryCode" id="countryCode">
                      <input type="hidden" name="countryiso" id="country_iso">
                      <input class="form-control numbers" type="text" required="" name="contact" id="contactI" placeholder="" maxlength="10" pattern="[0-9]{4}">
                      <span id="reqTxtcontactI" class="reqError valley"></span>
                    </div>
                  </div>



                </div>
                <div class="form-group">
                  <label class="form-label" for="input-4">Post Code *</label>
                  <input class="form-control numbers" type="text" required="" name="post_code" id="post_codeI" placeholder="" maxlength="10">
                  <span id="reqTxtpost_codeI" class="reqError valley"></span>
                </div>
                <div class="form-group">
                  <label class="form-label" for="input-4">Password *</label>
                  <input class="form-control" type="password" required="" name="password" id="passwordI" placeholder="">
                  <span id="reqTxtpasswordI" class="reqError valley"></span>
                </div>
                <div class="form-group">
                  <label class="form-label" for="input-4">Confirm Password *</label>
                  <input class="form-control" type="password" required="" id="confirm_passwordI" name="confirm_password" placeholder="">
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
    var nurse_array = [];
    $(".next-step").click(function() {



      if (currentStep == 1) {

        if (validateForm() == false) {
          return false;
        }
        window.scrollTo(0, 0);
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
        window.scrollTo(0, 0);
        $(".first_step").addClass("registration_progress");
        $(".second_step").removeClass("registration_progress");
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

    if (isValid == true) {

      // var nurse_type = $('.js-example-basic-multiple[data-list-id="type-of-nurse"]').select2("data");
      // var nurse_array = [];
      // for(var i=0;i<nurse_type.length;i++){
      //   nurse_array.push(nurse_type[i].id);
      // }

      // localStorage.setItem("type_of_nurse", JSON.stringify(nurse_array));



      // var nursing_length = $(".nursing_data").length;

      // for(var j=1;j<=nursing_length;j++){
      //   if($(".nursing_level-"+j).hasClass("d-none") == false){
      //     var nurse_type_entry = $('.js-example-basic-multiple[data-list-id="nursing_entry-'+j+'"]').select2("data");
      //     var nursing_type_array = [];
      //     for(var i=0;i<nurse_type_entry.length;i++){
      //       nursing_type_array.push(nurse_type_entry[i].id);
      //     }
      //     console.log("nurse_type_entry-"+j,nurse_type_entry);
      //     localStorage.setItem("nursing_type_data-"+j, JSON.stringify(nursing_type_array));
      //   }
      // }

      // var advp_data = localStorage.getItem("nursing_type_data-3");

      // var advp_data_array = JSON.parse(advp_data);

      // if(advp_data_array.includes("179")){

      //   var nurseparc_data = $('.js-example-basic-multiple[data-list-id="nurse_practitioner_menu"]').select2("data");
      //   console.log("nurseparc_data",nurseparc_data);
      //   var np_array = [];
      //   for(var i=0;i<nurseparc_data.length;i++){
      //     np_array.push(nurseparc_data[i].id);
      //   }
      //   localStorage.setItem("np_array", JSON.stringify(np_array));
      // }

      // var specialities = $('.js-example-basic-multiple[data-list-id="specialties"]').select2("data");
      // var specialities_array = [];
      // for(var i=0;i<specialities.length;i++){
      //   specialities_array.push(specialities[i].id);
      // }

      // localStorage.setItem("specialities_array", JSON.stringify(specialities_array));

      // var speciality_length = $(".speciality_data").length;

      // for(var j=1;j<=speciality_length;j++){
      //   if($(".specility_level-"+j).hasClass("d-none") == false){
      //     var speciality_entry = $('.js-example-basic-multiple[data-list-id="speciality_entry-'+j+'"]').select2("data");
      //     var speciality_type_array = [];
      //     for(var i=0;i<speciality_entry.length;i++){
      //       speciality_type_array.push(speciality_entry[i].id);
      //     }
      //     console.log("speciality_type_array-"+j,speciality_type_array);
      //     localStorage.setItem("speciality_type_array-"+j, JSON.stringify(speciality_type_array));
      //   }
      // }

      // var adults_data = localStorage.getItem("speciality_type_array-1");

      // var adults_data_array = JSON.parse(adults_data);

      // if(adults_data_array.includes("96")){

      //   var surgicaladults_data = $('.js-example-basic-multiple[data-list-id="surgical_row_box"]').select2("data");
      //   console.log("surgicaladults_data",surgicaladults_data);
      //   var surgicaladults_array = [];
      //   for(var i=0;i<surgicaladults_data.length;i++){
      //     surgicaladults_array.push(surgicaladults_data[i].id);
      //   }
      //   localStorage.setItem("surgicaladults_array", JSON.stringify(surgicaladults_array));

      //   var surgical_length = $(".surgical_row").length;

      //   for(var j=1;j<=surgical_length;j++){
      //     if($(".surgical_row-"+j).hasClass("d-none") == false){
      //       var surgicaladults_entry = $('.js-example-basic-multiple[data-list-id="surgical_operative_care-'+j+'"]').select2("data");
      //       var surgicaladults_type_array = [];
      //       for(var i=0;i<surgicaladults_entry.length;i++){
      //         surgicaladults_type_array.push(surgicaladults_entry[i].id);
      //       }
      //       console.log("surgicaladults_type_array-"+j,surgicaladults_type_array);
      //       localStorage.setItem("surgicaladults_type_array-"+j, JSON.stringify(surgicaladults_type_array));
      //     }
      //   }
      // }

      // var maternity_data = localStorage.getItem("speciality_type_array-2");

      // var maternity_data_array = JSON.parse(maternity_data);

      // if(maternity_data_array.includes("233")){
      //   var mater_data = $('.js-example-basic-multiple[data-list-id="surgical_obs_care"]').select2("data");
      //   console.log("surgical_obs_care",surgical_obs_care);
      //   var mater_array = [];
      //   for(var i=0;i<mater_data.length;i++){
      //     mater_array.push(mater_data[i].id);
      //   }
      //   localStorage.setItem("mater_array", JSON.stringify(mater_array));
      // }

      // var padneo_data = localStorage.getItem("speciality_type_array-3");

      // var padneo_data_array = JSON.parse(padneo_data);

      // if(padneo_data_array.includes("250")){
      //   var neonatal_care_data = $('.js-example-basic-multiple[data-list-id="neonatal_care"]').select2("data");
      //   console.log("neonatal_care_data",neonatal_care_data);
      //   var neonatal_array = [];
      //   for(var i=0;i<neonatal_care_data.length;i++){
      //     neonatal_array.push(neonatal_care_data[i].id);
      //   }
      //   localStorage.setItem("neonatal_array", JSON.stringify(neonatal_array));
      // }

      // if(padneo_data_array.includes("285")){
      //   var padsurgical_data = $('.js-example-basic-multiple[data-list-id="surgical_rowpad_box"]').select2("data");
      //   console.log("surgical_rowpad_box",padsurgical_data);
      //   var padsurgical_array = [];
      //   for(var i=0;i<padsurgical_data.length;i++){
      //     padsurgical_array.push(padsurgical_data[i].id);
      //   }
      //   localStorage.setItem("padsurgical_array", JSON.stringify(padsurgical_array));
      //   var padsurgical_length = $(".surgical_rowp").length;

      //   for(var j=1;j<=padsurgical_length;j++){
      //     if($(".surgical_rowp-"+j).hasClass("d-none") == false){
      //       var surgicalpad_entry = $('.js-example-basic-multiple[data-list-id="surgical_operative_carep-'+j+'"]').select2("data");
      //       var surgicalpad_type_array = [];
      //       for(var i=0;i<surgicalpad_entry.length;i++){
      //         surgicalpad_type_array.push(surgicalpad_entry[i].id);
      //       }
      //       console.log("surgicalpad_type_array-"+j,surgicalpad_type_array);
      //       localStorage.setItem("surgicalpad_type_array-"+j, JSON.stringify(surgicalpad_type_array));
      //     }
      //   }
      // }

      // var assistent_level = $("[name='assistent_level']").val();

      // localStorage.setItem("assistent_level", assistent_level);

      // var nurse_degree = $('.js-example-basic-multiple[data-list-id="nurse_degree"]').select2("data");
      // var nurse_degree_array = [];
      // for(var i=0;i<nurse_degree.length;i++){
      //   nurse_degree_array.push(nurse_degree[i].id);
      // }

      // localStorage.setItem("nurse_degree_array", JSON.stringify(nurse_degree_array));




      $(".first_step").removeClass("registration_progress");
      $(".second_step").addClass("registration_progress");
    }



    return isValid;
  }

  //$('#nurse_type_one').val([1,2]).trigger('change');
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









    if (passwordI == "") {

      document.getElementById("reqTxtpasswordI").innerHTML = "*  Please enter the PasswordI.";

      returnValue = false;

    }



    var pattern = /^.*(?=.{7,12})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%&!-_]).*$/;

    if (!pattern.test(passwordI)) {

      document.getElementById("reqTxtpasswordI").innerHTML = "Password length should be 7 Characters with atleast 1 number, lower, upper & special(@#$%&!-_&) characters.";

      returnValue = false;

    }

    // for (var i=0; i<passwordI.length; i++) {

    //   if ( passwordI.indexOf(passwordI[i]) !== passwordI.lastIndexOf(passwordI[i]) ) {
    //     document.getElementById("reqTxtpasswordI").innerHTML = "Characters can not be repeat";
    //     returnValue = false;
    //   }
    // }

    if (confirm_passwordI == "") {

      document.getElementById("reqTxtconfirm_passwordI").innerHTML = "* Please Enter the Confirm password.";

      returnValue = false;

    }

    if (passwordI != confirm_passwordI) {

      document.getElementById("reqTxtconfirm_passwordI").innerHTML = "Password and Confirm password do not match.";

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/intlTelInput.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>
<script>
  //$("#nurse_type_one").val('1').trigger('change');

  $("#nurse_type_one").select2().val(1).trigger('change');
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
      utilsScript: ""
    });


    $(phoneInputID).on("countrychange", function(event) {

      // Get the selected country data to know which country is selected.
      var selectedCountryData = iti.getSelectedCountryData();
      console.log("selectedCountryData", selectedCountryData.dialCode);
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

    iti.promise.then(function() {
      $(phoneInputID).trigger("countrychange");
    });

  });
  $(document).ready(function() {
    //Select2 
    $(".country").select2();
    $(".specialties").select2();
    $("#nurseTypeJob").select2();
    $("#subSpecialties").select2();
    $("#surgicalsubSpecialties").select2();

    $(".country").change(function() {
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
    $("#subSpecialties").change(function() {
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

            if (response.length > 0) {
              var selectedValuesText = $("#subSpecialties option:selected").text();
              subSpecialtiesArray.push(selectedValuesText);

              console.log("selectedValuesText", subSpecialtiesArray.join(","));
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
    $("#surgicalsubSpecialties").change(function() {

      var selectedValues = $(this).val();
      console.log("selectedValues", selectedValues);
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
            console.log("response", response);
            if (response.length > 0) {
              var selectedValuesText = $("#surgicalsubSpecialties option:selected").text();
              sub_subSpecialtiesArray.push(selectedValuesText)
              console.log("selectedValuesText", sub_subSpecialtiesArray.join(","));
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
  $("#nurseTypeJob").change(function() {
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
        if (response.length > 0) {
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