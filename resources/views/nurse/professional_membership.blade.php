@extends('nurse.layouts.layout')

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/css/intlTelInput.css" rel="stylesheet" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ url('/public') }}/nurse/assets/css/jquery.ui.datepicker.monthyearpicker.css">
<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.5.1/uicons-regular-rounded/css/uicons-regular-rounded.css'>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

<style type="text/css">
  .hide_profile_image {
    display: none !important;
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
    padding-bottom: 2px;
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
</style>
@endsection

@section('content')
<main class="main">
  <section class="section-box mt-0">
    <div class="">
      <div class="row m-0 profile-wrapper">
        <div class="col-lg-3 col-md-4 col-sm-12 p-0 left_menu">

        @include('nurse.sidebar_profile')
        </div>
        <div class="col-lg-9 col-md-8 col-sm-12 col-12 right_content">
          <div class="content-single content_profile">
            @if(!email_verified())
            <div class="container-fluid">
              <div class="alert alert-warning mt-2" role="alert">
                <span class="d-flex align-items-center justify-content-center "><img src="{{ asset('nurse/assets/imgs/info.png') }}" width="25px;" alt="info" class="mx-2"> Thank you for signing up with us. To get full access, please verify your email first. If you didn't receive the email, <a href="javascript:void(0);" class="link-opacity-100 mx-1" style="color: black;text-decoration-line: underline;
                  text-decoration-style: straight;" onclick="return resendEmailLink()"><b> click here to resend it.</b></a></span>
              </div>
            </div>
            @endif
            @if(!account_verified())
            <div class="container-fluid">
              <div class="alert alert-warning mt-2" role="alert">
                <span class="d-flex align-items-center justify-content-center "><img src="{{ asset('nurse/assets/imgs/info.png') }}" width="25px;" alt="info" class="mx-2">Thank you for verifying your email!<br>Please complete your profile, and once approved, you will be able to apply for jobs and make your profile visible.
                </span>
              </div>
            </div>
            @endif
            @if(!email_verified())
            <div class="alert alert-success mt-2" role="alert">
              <span class="d-flex align-items-center justify-content-center ">Please verify your email first to access your account </span>
            </div>
            @endif

            <div class="tab-content">
                <?php $user_id=''; $i = 0;?>

              <div class="tab-pane fade" id="tab-professional-membership" >

                <div class="card shadow-sm border-0 p-4 mt-30">
                  <h3 class="mt-0 color-brand-1 mb-2">Professional Memberships</h3>
                  <div class="professional_membership_text">
                    <p>
                      List any professional memberships or affiliations relevant to your nursing or midwifery career, such as associations, councils, organizations or societies.

                    </p>
                    <p>
                      Membership in these associations not only demonstrates your commitment to ethical standards and professional regulations but may also be mandatory or highly preferred for certain specialized roles—adding credibility and trust to your profile for potential employers.

                    </p>
                  </div>
                  <?php
                  $MembershipData = DB::table("professional_membership")->where("user_id", Auth::guard('nurse_middle')->user()->id)->first();
                  ?>
                  <form id="professional_memb_form" method="POST" onsubmit="return professional_membership_form()">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::guard('nurse_middle')->user()->id }}">
                    <div class="form-group level-drp">
                      <label class="form-label" for="input-1">Organization Country:</label>
                      
                      <input type="hidden" name="professional_as" class="professional_as" value="@if(!empty($MembershipData)){{ $MembershipData->des_profession_association }}@endif">
                      <ul id="organization_country" style="display:none;">
                        @if(!empty($organization_country))
                        @foreach($organization_country as $org_country)
                        <li data-value="{{ $org_country->organization_id }}">{{ $org_country->organization_country }}</li>
                        
                        @endforeach
                        @endif
                      </ul>
                      <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="organization_country" name="organization_country[]" multiple="multiple"></select>
                      <span id="reqprofessassociation" class="reqError text-danger valley"></span>
                    </div>
                    <div class="show_country_org"></div>
                    
                    <div class="form-group level-drp">
                      <label class="form-label" for="input-1">Organization Name</label>

                      <input type="hidden" name="professional_as" class="professional_as" value="@if(!empty($MembershipData)){{ $MembershipData->des_profession_association }}@endif">
                      <ul id="des_profession_association" style="display:none;">
                        
                        <li data-value="ANA">ANA</li>
                        <li data-value="ENA">ENA</li>

                      </ul>
                      <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="des_profession_association" name="des_profession_association[]" multiple="multiple"></select>
                      <span id="reqprofessassociation" class="reqError text-danger valley"></span>
                    </div>
                    <div class="form-group level-drp">
                      <label class="form-label" for="input-1">Date Joined</label>
                      <input class="form-control graduation_start_date" type="date" name="graduation_start_date" value="@if(!empty($educationData)){{ $educationData->graduate_start_date }}@endif" onchange="changeDate(event);">
                      <span id="reqstartdate" class="reqError text-danger valley"></span>
                    </div>
                    
                    <div class="form-group level-drp">
                      <label class="form-label" for="input-1">Status</label>
                      <select class="form-control" name="prof_membership_status" id="language-picker-select">
                        <option value="">Select Status</option>
                        <option value="Active - Current Member" @if(!empty($MembershipData) && $MembershipData->membership_status == "Active - Current Member") selected @endif>Active - Current Member</option>
                        <option value="Lapsed Member" @if(!empty($MembershipData) && $MembershipData->membership_status == "Lapsed Member") selected @endif>Lapsed Member</option>
                        <option value="Expired Member" @if(!empty($MembershipData) && $MembershipData->membership_status == "Expired Member") selected @endif>Expired Member</option>
                        <option value="Suspended Member" @if(!empty($MembershipData) && $MembershipData->membership_status == "Suspended Member") selected @endif>Suspended Member</option>
                        <option value="Inactive Member" @if(!empty($MembershipData) && $MembershipData->membership_status == "Inactive Member") selected @endif>Inactive Member</option>
                        <option value="Non-Renewed Member" @if(!empty($MembershipData) && $MembershipData->membership_status == "Non-Renewed Member") selected @endif>Non-Renewed Member</option>
                        <option value="Pending Membership Approval" @if(!empty($MembershipData) && $MembershipData->membership_status == "Pending Membership Approval") selected @endif>Pending Membership Approval</option>
                        <option value="Membership Renewal Pending" @if(!empty($MembershipData) && $MembershipData->membership_status == "Membership Renewal Pending") selected @endif>Membership Renewal Pending</option>

                      </select>
                      <span id="reqmemberstatus" class="reqError text-danger valley"></span>
                    </div>
                    <div class="form-group level-drp">
                      <label class="form-label" for="input-1">Awards & Recognitions:</label>

                      <input type="hidden" name="professional_as" class="professional_as" value="@if(!empty($MembershipData)){{ $MembershipData->des_profession_association }}@endif">
                      <ul id="awards_recognitions" style="display:none;">
                        @if(!empty($awards_recognitions))
                        @foreach($awards_recognitions as $a_reg)
                        <li data-value="{{ $a_reg->award_id }}">{{ $a_reg->award_name }}</li>
                        
                        @endforeach
                        @endif
                      </ul>
                      <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="awards_recognitions" name="des_profession_association[]" multiple="multiple"></select>
                      <span id="reqprofessassociation" class="reqError text-danger valley"></span>
                    </div>
                    <div class="show_award_reg"></div>
                    <div class="form-group level-drp">
                      <label class="form-label" for="input-1">Upload Evidence</label>
                      <input class="form-control degree_transcript" type="file" name="degree_transcript[]" onchange="changeImg('173')" multiple="">
                      <div class="degree_transcript_imgs"></div>
                      <span id="reqdegreetranscript" class="reqError text-danger valley"></span>
                    </div>
                    <div class="box-button mt-15">
                      <button class="btn btn-apply-big font-md font-bold" type="submit" id="submitProfessionalMembership">Save Changes</button>
                    </div>
                  </form>
                </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/intlTelInput.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>
<script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
<script src="{{ url('/public') }}/nurse/assets/js/jquery.ui.datepicker.monthyearpicker.js"></script>
@include('nurse.front_profile_js');
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js">
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

  $('.js-example-basic-multiple[data-list-id="awards_recognitions"]').on('change', function() {
    let selectedValues = $(this).val();
    console.log("selectedValues",selectedValues);
    //$(".show_country_org").empty();
    
    
    for(var i=0;i<selectedValues.length;i++){
      //alert($(".organization_input-"+selectedValues[i]).val());
      if($(".show_award_reg .award_country_div-"+selectedValues[i]).length < 1){
        $.ajax({
          type: "GET",
          url: "{{ url('/nurse/getawardsRecognitions') }}",
          data: {award_id:selectedValues[i]},
          cache: false,
          success: function(data){
            var data1 = JSON.parse(data);
            
            console.log("data1",data1);
            
            var org_text = "";
            for(var j=0;j<data1.award.length;j++){
              //console.log("data",data1.country_organiztions[j].organization_id);
              org_text += "<li data-value='"+data1.award[j].award_id+"'>"+data1.award[j].award_name+"</li>"; 
              // $(".organization_country_div").removeClass("d-none");
              // $("#country_organization").append("<li data-value="+data1.country_organiztions[j].organization_id+">"+data1.country_organiztions[j].organization_country+"</li>");
              // $("#country_organization_select").append("<option value="+data1.country_organiztions[j].organization_id+">"+data1.country_organiztions[j].organization_country+"</option>");
            }
            //alert($(".organization_country_div-"+data1.organization_id).length);
            
              $(".show_award_reg").append('<div class="form-group level-drp award_div award_country_div-'+data1.organization_id+'"><label class="form-label award_label" for="input-1">'+data1.award_name+'</label><ul id="award_reg-'+data1.organization_id+'" style="display:none;">'+org_text+'</ul><select class="js-example-basic-multiple'+data1.organization_id+' addAll_removeAll_btn" data-list-id="award_reg-'+data1.organization_id+'" id="award_organization_select-'+data1.organization_id+'" name="award_organization'+data1.organization_id+'[]" multiple="multiple"></select></div>');
            
            selectTwoFunction(data1.organization_id);
            
          }
        });
      }
    }
  });
  
  $('.js-example-basic-multiple[data-list-id="organization_country"]').on('change', function() {
    let selectedValues = $(this).val();
    console.log("selectedValues",selectedValues);
    //$(".show_country_org").empty();
    
    
    for(var i=0;i<selectedValues.length;i++){
      //alert($(".organization_input-"+selectedValues[i]).val());
      if($(".show_country_org .organization_country_div-"+selectedValues[i]).length < 1){
        $.ajax({
          type: "GET",
          url: "{{ url('/nurse/getCountryOrgnizations') }}",
          data: {organization_id:selectedValues[i]},
          cache: false,
          success: function(data){
            var data1 = JSON.parse(data);
            
            console.log("data1",data1);
            
            var org_text = "";
            for(var j=0;j<data1.country_organiztions.length;j++){
              //console.log("data",data1.country_organiztions[j].organization_id);
              org_text += "<li data-value='"+data1.country_organiztions[j].organization_id+"'>"+data1.country_organiztions[j].organization_country+"</li>"; 
              // $(".organization_country_div").removeClass("d-none");
              // $("#country_organization").append("<li data-value="+data1.country_organiztions[j].organization_id+">"+data1.country_organiztions[j].organization_country+"</li>");
              // $("#country_organization_select").append("<option value="+data1.country_organiztions[j].organization_id+">"+data1.country_organiztions[j].organization_country+"</option>");
            }
            //alert($(".organization_country_div-"+data1.organization_id).length);
            
              $(".show_country_org").append('<div class="form-group level-drp organization_country_div organization_country_div-'+data1.organization_id+'"><label class="form-label organization_country_label" for="input-1">'+data1.country_name+'</label><ul id="country_organization-'+data1.organization_id+'" style="display:none;">'+org_text+'</ul><select class="js-example-basic-multiple'+data1.organization_id+' addAll_removeAll_btn" data-list-id="country_organization-'+data1.organization_id+'" id="country_organization_select-'+data1.organization_id+'" name="country_organization'+data1.organization_id+'[]" multiple="multiple"></select></div><div class="show_subcountry_org-'+data1.organization_id+'"></div>');
            
            
              
            
            
            selectTwoFunction(data1.organization_id);
            sub_organization(data1.organization_id);
          }
        });
      }
    }
    
  });

  function sub_organization(country_org){
    
    $('.js-example-basic-multiple'+country_org+'[data-list-id="country_organization-'+country_org+'"]').on('change', function() {
      
      let selectedValues = $(this).val();
      console.log("selectedValues",selectedValues);
      
      
      for(var i=0;i<selectedValues.length;i++){
        if($(".show_subcountry_org-"+country_org+" .organization_country_div-"+selectedValues[i]).length < 1){
          $.ajax({
            type: "GET",
            url: "{{ url('/nurse/getCountrySubOrgnizations') }}",
            data: {organization_id:selectedValues[i],country_org_id:country_org},
            cache: false,
            success: function(data){
              var data1 = JSON.parse(data);
              
              console.log("data1",data1);
              
              var org_text = "";
              for(var j=0;j<data1.country_organiztions.length;j++){
                
                org_text += "<li data-value='"+data1.country_organiztions[j].organization_id+"'>"+data1.country_organiztions[j].organization_country+"</li>"; 
                
              }
              $(".show_subcountry_org-"+country_org).append('<div class="form-group level-drp organization_subcountry_div organization_subcountry_div-'+data1.organization_id+'"><label class="form-label organization_subcountry_label" for="input-1">'+data1.country_name+':</label><ul id="subcountry_organization-'+data1.organization_id+'" style="display:none;">'+org_text+'</ul><select class="js-example-basic-multiple'+data1.organization_id+' addAll_removeAll_btn" data-list-id="subcountry_organization-'+data1.organization_id+'" id="subcountry_organization_select" name="subcountry_organization[]" multiple="multiple"></select></div><div class="show_membership_type-'+data1.organization_id+'"></div>');
              selectTwoFunction(data1.organization_id);
              membership_type(data1.organization_id);
            }
          });
        }
      }
    });
  }

  function membership_type(organization_id){
    
    $('.js-example-basic-multiple'+organization_id+'[data-list-id="subcountry_organization-'+organization_id+'"]').on('change', function() {
      let selectedValues = $(this).val();
      console.log("selectedValues",selectedValues);
      

      for(var i=0;i<selectedValues.length;i++){
        if($(".show_membership_type-"+organization_id+" .membership_type_div-"+selectedValues[i]).length < 1){
          $.ajax({
            type: "GET",
            url: "{{ url('/nurse/getMembershipData') }}",
            data: {organization_id:selectedValues[i]},
            cache: false,
            success: function(data){
              var data1 = JSON.parse(data);
              
              console.log("data1",data1);
              
              var membership_text = "";
              for(var j=0;j<data1.membership_type.length;j++){
                
                membership_text += "<li data-value='"+data1.membership_type[j].membership_id+"'>"+data1.membership_type[j].membership_name+"</li>"; 
                
              }
              $(".show_membership_type-"+organization_id).append('<div class="form-group level-drp membership_type_div membership_type_div-'+data1.organization_id+'"><label class="form-label membership_type_label" for="input-1">Membership Type('+data1.organization_name+')</label><ul id="membership_type-'+data1.organization_id+'" style="display:none;">'+membership_text+'</ul><select class="js-example-basic-multiple'+data1.organization_id+' addAll_removeAll_btn" data-list-id="membership_type-'+data1.organization_id+'" id="subcountry_organization_select" name="subcountry_organization[]" multiple="multiple"></select></div><div class="show_submembership_type-'+data1.organization_id+'"></div>');
              selectTwoFunction(data1.organization_id);
              submembership_type(data1.organization_id,organization_id);
            }
          });
        
        }
      }
    });
    
  }


  function submembership_type(organization_id,organization_id1){
    $('.js-example-basic-multiple'+organization_id+'[data-list-id="membership_type-'+organization_id+'"]').on('change', function() {
      let selectedValues = $(this).val();
      console.log("selectedValues",selectedValues);
      

      for(var i=0;i<selectedValues.length;i++){
        if($(".show_submembership_type-"+organization_id+" .submembership_type_div-"+selectedValues[i]).length < 1){
          $.ajax({
            type: "GET",
            url: "{{ url('/nurse/getSubMembershipData') }}",
            data: {organization_id:selectedValues[i]},
            cache: false,
            success: function(data){
              var data1 = JSON.parse(data);
              
              console.log("data1",organization_id);
              
              var membership_text = "";
              for(var j=0;j<data1.membership_type.length;j++){
                
                membership_text += "<li data-value='"+data1.membership_type[j].membership_id+"'>"+data1.membership_type[j].membership_name+"</li>"; 
                
              }
              $(".show_submembership_type-"+organization_id).append('<div class="form-group level-drp submembership_type_div submembership_type_div-'+data1.organization_id+'"><label class="form-label submembership_type_label" for="input-1">'+data1.organization_name+'</label><ul id="submembership_type-'+data1.organization_id+'-'+organization_id+'" style="display:none;">'+membership_text+'</ul><select class="js-example-basic-multiple'+organization_id1+data1.organization_id+' addAll_removeAll_btn" data-list-id="submembership_type-'+data1.organization_id+'-'+organization_id+'" id="subcountry_organization_select" name="subcountry_organization[]" multiple="multiple"></select></div>');
              selectTwoFunction(organization_id1+data1.organization_id);
              
              
            }
          });
        }
        //$(".show_membership_type").append('<div class="form-group level-drp organization_subcountry_div"><label class="form-label organization_subcountry_label" for="input-1">'+data1.country_name+':</label><ul id="subcountry_organization-'+data1.organization_id+'" style="display:none;">'+org_text+'</ul><select class="js-example-basic-multiple2 addAll_removeAll_btn" data-list-id="subcountry_organization-'+data1.organization_id+'" id="subcountry_organization_select" name="subcountry_organization[]" multiple="multiple"></select></div>');
        
      }
    });
  }
  

  function selectTwoFunction(select_id){
    
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
    $('.js-example-basic-multiple'+select_id).on('select2:open', function() {
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

            $('.js-example-basic-multiple'+select_id).select2();

            // Dynamically add the clear button
            const clearButton = $('<span class="clear-btn">✖</span>');
            $('.select2-container').append(clearButton);

            // Handle the visibility of the clear button
            function toggleClearButton() {

                const selectedOptions = $('.js-example-basic-multiple'+select_id).val();
                if (selectedOptions && selectedOptions.length > 0) {
                    clearButton.show();
                } else {
                    clearButton.hide();
                }
            }

            // Attach change event to select2
            $('.js-example-basic-multiple'+select_id).on('change', toggleClearButton);

            // Clear button click event
            clearButton.click(function() {

                $('.js-example-basic-multiple'+select_id).val(null).trigger('change');
                toggleClearButton();
            });

            // Initial check
            toggleClearButton();
            $('.js-example-basic-multiple'+select_id).each(function() {
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
          }
</script>



<script type="text/javascript">
  $('.js-example-basic-multiple').each(function() {
    let listId = $(this).data('list-id');
    let items = [];
    console.log("listId1", listId);
    $('#' + listId + ' li').each(function() {
      console.log("value1", $(this).text());
      items.push({
        id: $(this).data('value'),
        text: $(this).text()
      });
    });
    console.log("items1", items);
    $(this).select2({
      data: items
    });
  });

  // $('.js-example-basic-multiple[data-list-id="organization_country"]').select2().val([1,2]).trigger('change');
  // $('.js-example-basic-multiple2[data-list-id="country_organization-2"]').select2().val([14,15]).trigger('change');
  if ($(".professional_as").val() != "") {
    var professional_as = JSON.parse($(".professional_as").val());
    console.log("professional_as", professional_as);
    $('.js-example-basic-multiple[data-list-id="des_profession_association"]').select2().val(professional_as).trigger('change');
  }


  $("#tab-professional-membership").insertAfter("#tab-educert");
  $("#tab-vaccination").insertAfter("#tab-educert");

  // Function to initialize Select2 for dynamically created select elements
  function initializeSelect2($dropdown) {
    $dropdown.on('select2:open', function() {
      var $currentDropdown = $(this);
      var searchBoxHtml = `
      <div class="extra-buttons">
        <button class="select-all-button" type="button">Select All</button>
        <button class="remove-all-button" type="button">Remove All</button>
      </div>`;

      // Add select all/remove all buttons
      $('.select2-results').prepend(searchBoxHtml);

      $('.select-all-button').on('click', function() {
        var allValues = $currentDropdown.find('option').map(function() {
          return $(this).val();
        }).get();
        $currentDropdown.val(allValues).trigger('change');
      });

      $('.remove-all-button').on('click', function() {
        $currentDropdown.val(null).trigger('change');
      });
    });
  }

  var url_string = window.location.href;
  var url = new URL(url_string);
  var c = url.searchParams.get("page");
  if (c == "professional_membership") {

    $(".tab-pane").hide();
    $("#tab-professional-membership").css("opacity", "1");
    $("#tab-professional-membership").show();
    $(".profile_tabs").removeClass("active");
    $("#professional_membership").addClass("active");

  }

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

<script>
  jQuery(document).ready(function() {

    var el;
    var options;
    var canvas;
    var span;
    var ctx;
    var radius;

    var createCanvasVariable = function(id) { // get canvas
      el = document.getElementById(id);
    };

    var createAllVariables = function() {
      options = {
        percent: el.getAttribute('data-percent') || 25,
        size: el.getAttribute('data-size') || 165,
        lineWidth: el.getAttribute('data-line') || 10,
        rotate: el.getAttribute('data-rotate') || 0,
        color: el.getAttribute('data-color')
      };

      canvas = document.createElement('canvas');
      span = document.createElement('span');
      span.textContent = options.percent + '%';

      if (typeof(G_vmlCanvasManager) !== 'undefined') {
        G_vmlCanvasManager.initElement(canvas);
      }

      ctx = canvas.getContext('2d');
      canvas.width = canvas.height = options.size;

      el.appendChild(span);
      el.appendChild(canvas);

      ctx.translate(options.size / 2, options.size / 2); // change center
      ctx.rotate((-1 / 2 + options.rotate / 180) * Math.PI); // rotate -90 deg

      radius = (options.size - options.lineWidth) / 2;
    };
    var drawCircle = function(color, lineWidth, percent) {
      percent = Math.min(Math.max(0, percent || 1), 1);
      ctx.beginPath();
      ctx.arc(0, 0, radius, 0, Math.PI * 2 * percent, false);
      ctx.strokeStyle = color;
      ctx.lineCap = 'square'; // butt, round or square
      ctx.lineWidth = lineWidth;
      ctx.stroke();
    };
    var drawNewGraph = function(id) {
      el = document.getElementById(id);
      createAllVariables();
      drawCircle('#efefef', options.lineWidth, 100 / 100);
      drawCircle(options.color, options.lineWidth, options.percent / 100);
    };
    drawNewGraph('graph1');
  });

</script>

@endsection
