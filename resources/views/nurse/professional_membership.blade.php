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
                  <h3 class="mt-0 color-brand-1 mb-2">Professional Memberships & Awards</h3>
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
                      <?php
                        if(!empty($professional_membership)){
                          $organization_data = json_decode($professional_membership->organization_data);
                          
                        }else{
                          $organization_data = array(); 
                        }
                        
                        
                        $o_data = (array)$organization_data;
                        $p_memb_arr = array();

                        foreach ($organization_data as $p_memb) {
                          
                          //print_r($p_memb);
                          $p_memb_arr[] = array_search($p_memb, (array)$organization_data);
                          
                        }

                        
                        $p_memb_json = json_encode($p_memb_arr);
                      ?>
                      
                      <input type="hidden" name="org_country" class="org_country" value='<?php echo $p_memb_json; ?>'>
                      <ul id="organization_country" style="display:none;">
                        @if(!empty($organization_country))
                        @foreach($organization_country as $org_country)
                        <li data-value="{{ $org_country->organization_id }}">{{ $org_country->organization_country }}</li>
                        
                        @endforeach
                        @endif
                      </ul>
                      <select class="js-example-basic-multiple addAll_removeAll_btn organization_country" data-list-id="organization_country" name="organization_country[]" multiple="multiple"></select>
                      <span id="reqorganization_country" class="reqError text-danger valley"></span>
                    </div>
                    <div class="show_country_org">
                      <?php
                        $i = 0;
                      ?>
                      @foreach ($p_memb_arr as $p_arr)
                        <?php
                          //print_r($o_data[$p_arr]);
                          $country_name = DB::table("professional_organization")->where("organization_id",$p_arr)->first();
                          $organization_list = DB::table("professional_organization")->where("country_organiztions",'like','%'.$p_arr.',%')->where("sub_organiztions","0")->orderBy('organization_country', 'ASC')->get();
                          $os_data = (array)$o_data[$p_arr];
                          $sub_count_arr = array();

                          foreach ($os_data as $p_memb) {
                            $sub_count_arr[] = array_search($p_memb, $os_data);
                          }
                          
                          
                          $p_memb_json = json_encode($sub_count_arr);
                        ?>
                        <div class="country_whole_div country_whole_div-{{ $p_arr }}" data-name="{{ $p_arr }}">
                        <div class="form-group level-drp organization_country_div organization_country_div-{{ $p_arr }}">
                          <label class="form-label" for="input-1">{{ $country_name->organization_name }}</label>
                          <input type="hidden" name="country_org_list" class="country_org_list country_org_list-{{ $p_arr }}" value='{{ $p_arr }}'>
                          <input type="hidden" name="country_org" class="country_org-{{ $p_arr }}" value='<?php echo $p_memb_json; ?>'>
                          <ul id="country_organization-{{ $p_arr }}" style="display:none;">
                            @if(!empty($organization_list))
                            @foreach($organization_list as $org_list)
                            <li data-value="{{ $org_list->organization_id }}">{{ $org_list->organization_country }}</li>
                            
                            @endforeach
                            @endif
                          </ul>
                          <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="country_organization-{{ $p_arr }}" name="country_organization[{{ $p_arr }}][]" onchange="sub_organization('edit',{{ $p_arr }}, {{ $i+1 }})" multiple="multiple"></select>
                        </div>
                        <div class="show_subcountry_org-{{ $p_arr }}">
                          <?php
                          $j = 0;
                        ?>
                        @foreach ($sub_count_arr as $p_arr1)
                          <?php
                            $country_name = DB::table("professional_organization")->where("organization_id",$p_arr1)->first();
                            $organization_list = DB::table("professional_organization")->where("country_organiztions",$p_arr)->where("sub_organiztions",$p_arr1)->orderBy('organization_country', 'ASC')->get();
                            $oss_data = (array)$os_data[$p_arr1];
                            $subsub_count_arr = array();

                            foreach ($oss_data as $p_memb) {
                              $subsub_count_arr[] = array_search($p_memb, $oss_data);
                            }
                          
                          
                            $p_memb_json = json_encode($subsub_count_arr);
                          ?>
                          <div class="sub_country_div sub_country_div-{{ $p_arr1 }}" data-name="{{ $country_name->organization_country }}">
                          <div class="form-group level-drp o_country_div-{{ $p_arr }} o_subcountry_div-{{ $p_arr1 }} o_subcountry_div-{{ $p_arr1 }} organization_subcountry_div organization_subcountry_div-{{ $p_arr1 }}">
                            <label class="form-label organization_subcountry_label" for="input-1">{{ $country_name->organization_country }}</label>
                            <input type="hidden" name="subcountry_org_list" class="subcountry_org_list subcountry_org_list-{{ $p_arr1 }}" value='{{ $p_arr1 }}'>
                            <input type="hidden" name="subcountry_org" class="subcountry_org-{{ $p_arr1 }}" value='<?php echo $p_memb_json; ?>'>
                            <ul id="subcountry_organization-{{ $p_arr1 }}" style="display:none;">
                              @if(!empty($organization_list))
                              @foreach($organization_list as $org_list)
                              <li data-value="{{ $org_list->organization_id }}">{{ $org_list->organization_country }}</li>
                              
                              @endforeach
                              @endif
                            </ul><select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="subcountry_organization-{{ $p_arr1 }}" id="subcountry_organization_select" name="subcountry_organization[{{ $p_arr }}][{{ $p_arr1 }}][]" onchange="memberships_type('edit','{{ $p_arr }}','{{ $p_arr1 }}',{{ $i+1 }},{{{ $j+1 }}})" multiple="multiple">
                            </select>
                          </div>
                          <div class="show_membership_type-{{ $p_arr }}{{ $p_arr1 }}">
                            <?php
                              $k = 0;  
                            ?>
                            @foreach ($subsub_count_arr as $p_arr2)
                            <?php
                              $membership_type = DB::table("membership_type")->where("submember_id","0")->orderBy('membership_name', 'ASC')->get();
                              $osm_data = (array)$oss_data[$p_arr2];
                              $memb_type_arr = array();

                              foreach ($osm_data as $m_type_arr) {
                                $memb_type_arr[] = array_search($m_type_arr, $osm_data);
                              }
                          
                          
                              $p_memb_json = json_encode($memb_type_arr);
                            ?>
                            <div class="membership_type_div-{{ $p_arr2 }}">
                            <div class="form-group level-drp o_subcountry_div-{{ $p_arr1 }} o_country_div-{{ $p_arr }} membership_type_div membership_type_div-{{ $p_arr2 }}">
                              <label class="form-label membership_type_label" for="input-1">Membership Type({{ $country_name->organization_country }})</label>
                              <input type="hidden" name="subsubcountry_org_list" class="subsubcountry_org_list subsubcountry_org_list-{{ $p_arr2 }}" value='{{ $p_arr2 }}'>
                              <input type="hidden" name="memb_type_input" class="memb_type_input-{{ $p_arr2 }}" value='<?php echo $p_memb_json; ?>'>
                              <ul id="membership_type-{{ $p_arr2 }}" style="display:none;">
                                @if(!empty($membership_type))
                                @foreach($membership_type as $m_type)
                                <li data-value="{{ $m_type->membership_id }}">{{ $m_type->membership_name }}</li>
                                
                                @endforeach
                                @endif
                              </ul><select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="membership_type-{{ $p_arr2 }}" id="subcountry_organization_select" name="membership_type[{{ $p_arr }}][{{ $p_arr1 }}][{{ $p_arr2 }}][]" onchange="submemberships_type('edit','{{ $p_arr }}','{{ $p_arr2 }}','{{ $p_arr1 }}',{{ $i+1 }},{{ $j+1 }},{{ $k+1 }})" multiple="multiple">
                              </select>
                            </div>
                            <div class="show_submembership_type-{{ $p_arr }}{{ $p_arr1 }}{{ $p_arr2 }}">
                              @foreach ($memb_type_arr as $p_arr3)
                              <?php
                                $membership_name = DB::table("membership_type")->where("membership_id",$p_arr3)->first();
                                $submembership_type_list = DB::table("membership_type")->where("submember_id",$p_arr3)->orderBy('membership_name', 'ASC')->get();
                                $ossm_data = (array)$osm_data[$p_arr3];
                                $memb_type_arr = array();
                               
                                foreach ($ossm_data as $m_type_arr) {
                                  $memb_type_arr[] = $m_type_arr;
                                  
                                }

                                
                                $p_memb_json = json_encode($memb_type_arr);
                              ?>
                              <div class="submembership_type_div-{{ $p_arr3 }}-{{ $p_arr3 }}">
                              <div class="form-group level-drp o_membtype_div-{{ $p_arr2 }} o_subcountry_div-{{ $p_arr1 }} o_country_div-{{ $p_arr }} submembership_type_div submembership_type_div-{{ $p_arr3 }}">
                                <label class="form-label submembership_type_label" for="input-1">{{ $membership_name->membership_name }}</label>
                                <input type="hidden" name="submemb_list" class="submemb_list submemb_list-{{ $p_arr3 }}" value='{{ $p_arr3 }}'>
                                <input type="hidden" name="submemb_type_input" class="submemb_type_input-{{ $p_arr }}-{{ $p_arr3 }}" value='<?php echo $p_memb_json; ?>'>
                                <ul id="submembership_type-{{ $p_arr3 }}-{{ $p_arr2 }}" style="display:none;">
                                  @if(!empty($submembership_type_list))
                                  @foreach($submembership_type_list as $msub_type)
                                  <li data-value="{{ $msub_type->membership_id }}">{{ $msub_type->membership_name }}</li>
                                  
                                  @endforeach
                                  @endif
                                </ul><select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="submembership_type-{{ $p_arr3 }}-{{ $p_arr2 }}" id="subcountry_organization_select" name="submembership_type[{{ $p_arr }}][{{ $p_arr1 }}][{{ $p_arr2 }}][{{ $p_arr3 }}][]" multiple="multiple">
                                </select>
                              </div>
                              </div>
                              @endforeach
                            </div>
                            <?php
                              $k++;
                            ?>
                            </div>
                            @endforeach
                          </div>  
                          <?php
                            $j++
                          ?>
                          </div>
                        @endforeach
                        </div>
                        <?php
                          $i++
                        ?>
                        </div>
                      @endforeach
                    </div>
                    
                    <div class="form-group level-drp">
                      <label class="form-label" for="input-1">Organization Name</label>
                      <input type="hidden" name="organization_name" class="organization_name" value="@if(!empty($professional_membership)){{ $professional_membership->des_profession_association }}@endif">
                      <ul id="des_profession_association" style="display:none;">
                        
                        <li data-value="ANA">ANA</li>
                        <li data-value="ENA">ENA</li>

                      </ul>
                      <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="des_profession_association" name="des_profession_association[]" multiple="multiple"></select>
                      <span id="reqorg_name" class="reqError text-danger valley"></span>
                    </div>
                    <div class="form-group level-drp">
                      <label class="form-label" for="input-1">Date Joined</label>
                      <input class="form-control graduation_start_date" type="date" name="date_joined" value="@if(!empty($professional_membership)){{ $professional_membership->date_joined }}@endif" onchange="changeDate(event);">
                      <span id="reqjoined_date" class="reqError text-danger valley"></span>
                    </div>
                    
                    <div class="form-group level-drp">
                      <label class="form-label" for="input-1">Status</label>
                      <select class="form-control" name="prof_membership_status" id="language-picker-select">
                        <option value="">Select Status</option>
                        <option value="Active - Current Member" @if(!empty($professional_membership) && $professional_membership->membership_status == "Active - Current Member") selected @endif>Active - Current Member</option>
                        <option value="Lapsed Member" @if(!empty($professional_membership) && $professional_membership->membership_status == "Lapsed Member") selected @endif>Lapsed Member</option>
                        <option value="Expired Member" @if(!empty($professional_membership) && $professional_membership->membership_status == "Expired Member") selected @endif>Expired Member</option>
                        <option value="Suspended Member" @if(!empty($professional_membership) && $professional_membership->membership_status == "Suspended Member") selected @endif>Suspended Member</option>
                        <option value="Inactive Member" @if(!empty($professional_membership) && $professional_membership->membership_status == "Inactive Member") selected @endif>Inactive Member</option>
                        <option value="Non-Renewed Member" @if(!empty($professional_membership) && $professional_membership->membership_status == "Non-Renewed Member") selected @endif>Non-Renewed Member</option>
                        <option value="Pending Membership Approval" @if(!empty($professional_membership) && $professional_membership->membership_status == "Pending Membership Approval") selected @endif>Pending Membership Approval</option>
                        <option value="Membership Renewal Pending" @if(!empty($professional_membership) && $professional_membership->membership_status == "Membership Renewal Pending") selected @endif>Membership Renewal Pending</option>

                      </select>
                      <span id="reqmembership_status" class="reqError text-danger valley"></span>
                    </div>
                    <div class="form-group level-drp">
                      <label class="form-label" for="input-1">Awards & Recognitions:</label>
                      <?php
                        if(!empty($professional_membership)){
                          $award_data = json_decode($professional_membership->award_recognitions);
                        }else{
                          $award_data = array();
                        }
                        
                        $a_data = (array)$award_data;
                        $awards_recognition_arr = array();

                        foreach ($a_data as $a_reg) {
                          $awards_recognition_arr[] = array_search($a_reg, $a_data);
                        }
                    
                        
                        $awards_recognition_json = json_encode($awards_recognition_arr);
                      ?>      
                      <input type="hidden" name="awards_recognition_input" class="awards_recognition_input" value='<?php echo $awards_recognition_json; ?>'>
                      <ul id="awards_recognitions" style="display:none;">
                        @if(!empty($awards_recognitions))
                        @foreach($awards_recognitions as $a_reg)
                        <li data-value="{{ $a_reg->award_id }}">{{ $a_reg->award_name }}</li>
                        
                        @endforeach
                        @endif
                      </ul>
                      <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="awards_recognitions" name="awards_recognitions[]" multiple="multiple"></select>
                      <span id="reqawards_recognitions" class="reqError text-danger valley"></span>
                    </div>
                    <div class="show_award_reg">
                      @foreach ($awards_recognition_arr as $a_reg_arr)
                        <?php
                          $subawards_recognition = DB::table("awards_recognitions")->where("sub_award_id",$a_reg_arr)->get();
                          
                          $subawards_name = DB::table("awards_recognitions")->where("award_id",$a_reg_arr)->first();
                          $as_data = (array)$a_data[$a_reg_arr];
                          $subawards_recognition_arr = array();

                          foreach ($as_data as $suba_reg) {
                            $subawards_recognition_arr[] = $suba_reg;
                          }
                      
                      
                          $subawards_recognition_json = json_encode(array_unique($subawards_recognition_arr));
                        ?>
                        <div class="form-group level-drp award_div award_country_div-{{ $a_reg_arr }}">
                          <label class="form-label award_label" for="input-1">{{ $subawards_name->award_name }}</label>
                          <input type="hidden" name="sub_award_list" class="subaward_list subaward_list-{{ $a_reg_arr }}" value='<?php echo $a_reg_arr; ?>'>
                          <input type="hidden" name="subawards_recognition_input" class="subawards_recognition_input-{{ $a_reg_arr }}" value='<?php echo $subawards_recognition_json; ?>'>
                          <ul id="award_reg-{{ $a_reg_arr }}" style="display:none;">
                            @if(!empty($subawards_recognition))
                            
                            @foreach($subawards_recognition as $a_reg)
                            <li data-value="{{ $a_reg->award_id }}">{{ $a_reg->award_name }}</li>
                            @endforeach
                            @endif
                          </ul><select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="award_reg-{{ $a_reg_arr }}" id="award_organization_select-{{ $a_reg_arr }}" name="award_organization[{{ $a_reg_arr }}][]" multiple="multiple">
                          </select>
                        </div>     
                      @endforeach
                    </div>
                    <div class="form-group level-drp">
                      <?php
                        $user_id = Auth::guard('nurse_middle')->user()->id
                      ?>
                      <label class="form-label" for="input-1">Upload Evidence</label>
                      <input class="form-control membership_evidence" type="file" name="membership_evidence[]" onchange="changeEvidenceImg('{{ $user_id }}')" multiple="">
                      <div class="memb_evdence">
                        @if(!empty($professional_membership) && $professional_membership->evidence_imgs)
                        <?php
                        $dtran_img = json_decode($professional_membership->evidence_imgs);
                        //print_r($dtran_img);
                        $i = 1;
                        $user_id = Auth::guard('nurse_middle')->user()->id;
                        ?>

                        @if(!empty($dtran_img))
                        @foreach($dtran_img as $tranimg)
                        <div class="trans_img trans_img-{{ $i }}">
                          <a href="{{ url('/public/uploads/education_degree') }}/{{ $tranimg }}" target="_blank"><i class="fa fa-file"></i>{{ $tranimg }}</a>
                          <div class="close_btn close_btn-{{ $i }}" onclick="deleteEvidenceImg('{{ $i }}','{{ $user_id }}','{{ $tranimg }}')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
                        </div>
                        <?php
                        $i++;
                        ?>
                        @endforeach
                        @endif

                        @endif
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
  function changeEvidenceImg(user_id) {
    var files = $('.membership_evidence')[0].files;
    console.log("files", files.length);
    var form_data = "";
    form_data = new FormData();

    for (var i = 0; i < files.length; i++) {
      form_data.append("membership_evidence[]", files[i], files[i]['name']);
    }

    form_data.append("user_id", user_id);
    form_data.append("_token", '{{ csrf_token() }}');

    $.ajax({
      type: "post",
      url: "{{ route('nurse.uploadMembershipImgs') }}",
      cache: false,
      contentType: false,
      processData: false,
      async: true,
      data: form_data,

      success: function(data) {
        var image_array = JSON.parse(data);
        var htmlData = '';
        for (var i = 0; i < image_array.length; i++) {
          console.log("degree_transcript", image_array[i]);
          var img_name = image_array[i];
          console.log("img_name", 'deleteImg(' + (i + 1) + ',' + user_id + ',"' + img_name + '")');
          htmlData += '<div class="trans_img trans_img-' + (i + 1) + '"><a href="{{ url("/public") }}/uploads/education_degree/' + img_name + '" target="_blank"><i class="fa fa-file" aria-hidden="true"></i>' + image_array[i] + '</a><div class="close_btn close_btn-' + i + '" onclick="deleteImg(' + (i + 1) + ',' + user_id + ',\'' + img_name + '\')" style="cursor: pointer;"><i class="fa fa-close" aria-hidden="true"></i></div></div>';
        }
        $(".memb_evdence").html(htmlData);
      }
    });
  }

  function deleteEvidenceImg(i, user_id, img) {
    $.ajax({
      type: "post",
      url: "{{ route('nurse.deleteEvidenceImg') }}",
      data: {
        user_id: user_id,
        img: img,
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

  var $wrapper = $('.show_country_org');

$wrapper.find('.country_whole_div').sort(function (a, b) {
    return +a.dataset.name - +b.dataset.name;
})
.appendTo( $wrapper );

  $('.js-example-basic-multiple[data-list-id="awards_recognitions"]').on('change', function() {
    let selectedValues = $(this).val();
    console.log("selectedValues",selectedValues);
    //$(".show_country_org").empty();

    $(".subaward_list").each(function(i,val){
      var val = $(val).val();
      console.log("val",$(val).val());
      if(selectedValues.includes(val) == false){
        $(".award_country_div-"+val).remove();
        //$(".o_country_div-"+val).remove();
      }
    });
    
    
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
            
              $(".show_award_reg").append('<div class="form-group level-drp award_div award_country_div-'+data1.organization_id+'"><label class="form-label award_label" for="input-1">'+data1.award_name+'</label><input type="hidden" name="subaward_list" class="subaward_list subaward_list-'+data1.organization_id+'" value="'+data1.organization_id+'"><ul id="award_reg-'+data1.organization_id+'" style="display:none;">'+org_text+'</ul><select class="js-example-basic-multiple'+data1.organization_id+' addAll_removeAll_btn" data-list-id="award_reg-'+data1.organization_id+'" id="award_organization_select-'+data1.organization_id+'" name="award_organization['+data1.organization_id+'][]" multiple="multiple"></select></div>');
            
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

    $(".country_org_list").each(function(i,val){
      var val = $(val).val();
      console.log("val",$(val).val());
      if(selectedValues.includes(val) == false){
        $(".country_whole_div-"+val).remove();
        
      }
    });
    
    
    for(var i=0;i<selectedValues.length;i++){
      //alert($(".organization_input-"+selectedValues[i]).val());
      if($(".show_country_org .organization_country_div-"+selectedValues[i]).length < 1 ){
        $.ajax({
          type: "GET",
          url: "{{ url('/nurse/getCountryOrgnizations') }}",
          data: {organization_id:selectedValues[i],id:i},
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
            
              $(".show_country_org").append('<div class="country_whole_div country_whole_div-'+data1.organization_id+'" data-name="'+data1.organization_id+'"><div class="form-group level-drp o_country_div-'+data1.organization_id+' organization_country_div organization_country_div-'+data1.organization_id+'"><label class="form-label organization_country_label" for="input-1">'+data1.country_name+'</label><input type="hidden" name="country_org_list" class="country_org_list country_org_list-'+data1.organization_id+'" value="'+data1.organization_id+'"><ul id="country_organization-'+data1.organization_id+'" style="display:none;">'+org_text+'</ul><select class="js-example-basic-multiple'+data1.organization_id+' addAll_removeAll_btn" data-list-id="country_organization-'+data1.organization_id+'" id="country_organization_select-'+data1.organization_id+'" name="country_organization['+data1.organization_id+'][]" multiple="multiple"></select></div><div class="show_subcountry_org-'+data1.organization_id+'"></div></div>');
            
            
              var $wrapper = $('.show_country_org');

              $wrapper.find('.country_whole_div').sort(function (a, b) {
                  return +a.dataset.name - +b.dataset.name;
              })
              .appendTo( $wrapper );
            
            
            selectTwoFunction(data1.organization_id);
            sub_organization('',data1.organization_id,i);
            
          }
        });
      }
    }
    
        
      });

 
  
  function sub_organization(ed,country_org,k){
    
    
    if(ed == "edit"){
      let selectedValues = $('.js-example-basic-multiple[data-list-id="country_organization-'+country_org+'"]').val();
      console.log("selectedValues",selectedValues);


      $(".show_subcountry_org-"+country_org+" .subcountry_org_list").each(function(i,val){
        var val1 = $(val).val();
        console.log("val",val1);
        if(selectedValues.includes(val1) == false){
          $(".sub_country_div-"+val1).remove();
          
        }
      });
      
      
      
      for(var i=0;i<selectedValues.length;i++){

        

        if($(".show_subcountry_org-"+country_org+" .organization_subcountry_div-"+selectedValues[i]).length < 1){
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
              $(".show_subcountry_org-"+country_org).append('<div class="sub_country_div sub_country_div-'+data1.organization_id+'" data-name="'+data1.country_name+'"><div class="form-group level-drp o_country_div-'+country_org+' o_subcountry_div-'+data1.organization_id+' organization_subcountry_div organization_subcountry_div-'+data1.organization_id+'"><label class="form-label organization_subcountry_label" for="input-1">'+data1.country_name+':</label><ul id="subcountry_organization-'+data1.organization_id+'" style="display:none;">'+org_text+'</ul><input type="hidden" name="subcountry_org_list" class="subcountry_org_list subcountry_org_list-'+data1.organization_id+'" value="'+data1.organization_id+'"><select class="js-example-basic-multiple'+country_org+data1.organization_id+' addAll_removeAll_btn" data-list-id="subcountry_organization-'+data1.organization_id+'" id="subcountry_organization_select" name="subcountry_organization['+country_org+']['+data1.organization_id+'][]" multiple="multiple"></select></div><div class="show_membership_type-'+country_org+data1.organization_id+'"></div></div>');
              
              

              selectTwoFunction(country_org+data1.organization_id);
              
              memberships_type('',country_org,data1.organization_id,k,i);
            }
          });
        }
      }
    }else{

     
    

      $('.js-example-basic-multiple'+country_org+'[data-list-id="country_organization-'+country_org+'"]').on('change', function() {
      
        let selectedValues = $(this).val();
        console.log("selectedValues","hello");

        
        $(".show_subcountry_org-"+country_org+" .subcountry_org_list").each(function(i,val){
          var val1 = $(val).val();
          console.log("val",val1);
          if(selectedValues.includes(val1) == false){
            $(".sub_country_div-"+val1).remove();
            
          }
        });
        

        
        
        
        for(var i=0;i<selectedValues.length;i++){
          
          if($(".show_subcountry_org-"+country_org+" .organization_subcountry_div-"+selectedValues[i]).length < 1){
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
                $(".show_subcountry_org-"+country_org).append('<div class="sub_country_div sub_country_div-'+data1.organization_id+'" data-name="'+data1.country_name+'"><div class="form-group level-drp o_country_div-'+country_org+' ed-o_subcountry_div-'+data1.organization_id+' organization_subcountry_div organization_subcountry_div-'+data1.organization_id+' ed-organization_subcountry_div-'+data1.organization_id+'"><label class="form-label organization_subcountry_label" for="input-1">'+data1.country_name+':</label><input type="hidden" name="subcountry_org_list" class="subcountry_org_list subcountry_org_list-'+data1.organization_id+'" value="'+data1.organization_id+'"><ul id="subcountry_organization-'+data1.organization_id+'" style="display:none;">'+org_text+'</ul><select class="js-example-basic-multiple'+country_org+data1.organization_id+' addAll_removeAll_btn" data-list-id="subcountry_organization-'+data1.organization_id+'" id="subcountry_organization_select" name="subcountry_organization['+country_org+']['+data1.organization_id+'][]" multiple="multiple"></select></div><div class="show_membership_type-'+country_org+data1.organization_id+'"></div></div>');
                
                

                selectTwoFunction(country_org+data1.organization_id);
                
                memberships_type('',country_org,data1.organization_id,k,i);
              }
            });
          }
        }
      });
    }
  }

  function memberships_type(ed,country_org,organization_id,k,l){
    
    if(ed == "edit"){
      let selectedValues = $('.js-example-basic-multiple[data-list-id="subcountry_organization-'+organization_id+'"]').val();
      console.log("selectedValues",selectedValues);
      
      $(".show_membership_type-"+country_org+organization_id+" .subsubcountry_org_list").each(function(i,val){
        var val1 = $(val).val();
        console.log("val",val1);
        if(selectedValues.includes(val1) == false){
          $(".membership_type_div-"+val1).remove();
          
        }
      });
    
      for(var i=0;i<selectedValues.length;i++){
        if($(".show_membership_type-"+country_org+organization_id+" .membership_type_div-"+selectedValues[i]).length < 1){
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
              
              
              $(".show_membership_type-"+country_org+organization_id).append('<div class="form-group level-drp o_country_div-'+country_org+' o_subcountry_div-'+organization_id+' membership_type_div membership_type_div-'+data1.organization_id+'"><label class="form-label membership_type_label" for="input-1">Membership Type('+data1.organization_name+')</label><input type="hidden" name="subsubcountry_org_list" class="subsubcountry_org_list subsubcountry_org_list-'+data1.organization_id+'" value="'+data1.organization_id+'"><ul id="membership_type-'+data1.organization_id+'" style="display:none;">'+membership_text+'</ul><select class="js-example-basic-multiple'+country_org+data1.organization_id+' addAll_removeAll_btn" data-list-id="membership_type-'+data1.organization_id+'" id="subcountry_organization_select" name="membership_type['+k+']['+l+']['+i+'][]" multiple="multiple"></select></div><div class="show_submembership_type-'+country_org+organization_id+data1.organization_id+'"></div>');
              
              var alphabeticallyOrderedDivs = $('.sub_country_div').sort(function(a, b) {
                return String.prototype.localeCompare.call($(a).data('name').toLowerCase(), $(b).data('name').toLowerCase());
              });
            
              var container = $(".show_subcountry_org-"+country_org);
              container.append(alphabeticallyOrderedDivs);
              $('.country_whole_div-'+country_org).append(container);
              selectTwoFunction(country_org+data1.organization_id);
              submemberships_type('',country_org,data1.organization_id,organization_id,k,l,i);
            }
          });
        
        }
      }
    }else{
      $('.js-example-basic-multiple'+country_org+organization_id+'[data-list-id="subcountry_organization-'+organization_id+'"]').on('change', function() {
        let selectedValues = $(this).val();
        console.log("selectedValues",organization_id);

        $(".show_membership_type-"+country_org+organization_id+" .subsubcountry_org_list").each(function(i,val){
        var val1 = $(val).val();
        console.log("val",val1);
        if(selectedValues.includes(val1) == false){
          $(".membership_type_div-"+val1).remove();
          
        }
      });
        

        for(var i=0;i<selectedValues.length;i++){
          if($(".show_membership_type-"+country_org+organization_id+" .membership_type_div-"+selectedValues[i]).length < 1){
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

                $(".show_membership_type-"+country_org+organization_id).append('<div class="membership_type_divs-'+data1.organization_id+'"><div class="form-group level-drp o_country_div-'+country_org+' ed-o_subcountry_div-'+organization_id+' membership_type_div membership_type_div-'+data1.organization_id+' ed-membership_type_div-'+data1.organization_id+'"><label class="form-label membership_type_label" for="input-1">Membership Type('+data1.organization_name+')</label><input type="hidden" name="subsubcountry_org_list" class="subsubcountry_org_list subsubcountry_org_list-'+data1.organization_id+'" value="'+data1.organization_id+'"><ul id="membership_type-'+data1.organization_id+'" style="display:none;">'+membership_text+'</ul><select class="js-example-basic-multiple'+country_org+data1.organization_id+' addAll_removeAll_btn" data-list-id="membership_type-'+data1.organization_id+'" id="subcountry_organization_select" name="membership_type['+country_org+']['+organization_id+']['+data1.organization_id+'][]" multiple="multiple"></select></div><div class="show_submembership_type-'+country_org+organization_id+data1.organization_id+'"></div></div>');
                selectTwoFunction(country_org+data1.organization_id);
                submemberships_type('',country_org,data1.organization_id,organization_id,k,l,i);
              }
            });
          
          }
        }
      });
    }
  }


  function submemberships_type(ed, country_org,organization_id,organization_id1,k,l,m){
    
    if(ed == "edit"){
      let selectedValues = $('.js-example-basic-multiple[data-list-id="membership_type-'+organization_id+'"]').val();
      console.log("selectedValues",selectedValues);
      
      $(".show_submembership_type-"+country_org+organization_id1+organization_id+" .submemb_list").each(function(i,val){
        var val1 = $(val).val();
        console.log("val",val1);
        if(selectedValues.includes(val1) == false){
          $(".submembership_type_div-"+val1).remove();
          
        }
      });

      for(var i=0;i<selectedValues.length;i++){
        if($(".show_submembership_type-"+country_org+organization_id1+organization_id+" .submembership_type_div-"+selectedValues[i]).length < 1){
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
              $(".show_submembership_type-"+country_org+organization_id1+organization_id).append('<div class="form-group level-drp o_country_div-'+country_org+' ed-o_membtype_div-'+organization_id+' submembership_type_div submembership_type_div-'+data1.organization_id+'"><label class="form-label submembership_type_label" for="input-1">'+data1.organization_name+'</label><input type="hidden" name="submemb_list" class="submemb_list submemb_list-'+data1.organization_id+'" value="'+data1.organization_id+'"><ul id="submembership_type-'+data1.organization_id+'-'+organization_id+'" style="display:none;">'+membership_text+'</ul><select class="js-example-basic-multiple'+ountry_org+organization_id1+organization_id+' addAll_removeAll_btn" data-list-id="submembership_type-'+data1.organization_id+'-'+organization_id+'" id="subcountry_organization_select" name="submembership_type['+k+']['+l+']['+m+']['+i+'][]" multiple="multiple"></select></div>');
              selectTwoFunction(ountry_org+organization_id1+organization_id);
              
              
            }
          });
        }
        //$(".show_membership_type").append('<div class="form-group level-drp organization_subcountry_div"><label class="form-label organization_subcountry_label" for="input-1">'+data1.country_name+':</label><ul id="subcountry_organization-'+data1.organization_id+'" style="display:none;">'+org_text+'</ul><select class="js-example-basic-multiple2 addAll_removeAll_btn" data-list-id="subcountry_organization-'+data1.organization_id+'" id="subcountry_organization_select" name="subcountry_organization[]" multiple="multiple"></select></div>');
        
      }
    }else{
      $('.js-example-basic-multiple'+country_org+organization_id+'[data-list-id="membership_type-'+organization_id+'"]').on('change', function() {
        let selectedValues = $(this).val();
        console.log("selectedValues",selectedValues);

        $(".show_submembership_type-"+country_org+organization_id1+organization_id+" .submemb_list").each(function(i,val){
          var val1 = $(val).val();
          console.log("val",val1);
          if(selectedValues.includes(val1) == false){
            $(".submembership_type_div-"+val1).remove();
            
          }
        });
        

        for(var i=0;i<selectedValues.length;i++){
          if($(".show_submembership_type-"+country_org+organization_id1+organization_id+" .submembership_type_div-"+selectedValues[i]).length < 1){
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
                $(".show_submembership_type-"+country_org+organization_id1+organization_id).append('<div class="submembership_type_div-'+country_org+'-'+data1.organization_id+'"><div class="form-group level-drp o_country_div-'+country_org+' ed-o_subcountry_div-'+organization_id1+' ed-o_membtype_div-'+organization_id+' submembership_type_div submembership_type_div-'+data1.organization_id+' ed-submembership_type_div-'+data1.organization_id+'"><label class="form-label submembership_type_label" for="input-1">'+data1.organization_name+'</label><input type="hidden" name="submemb_list" class="submemb_list submemb_list-'+country_org+'-'+data1.organization_id+'" value="'+data1.organization_id+'"><ul id="submembership_type-'+data1.organization_id+'-'+organization_id+'" style="display:none;">'+membership_text+'</ul><select class="js-example-basic-multiple'+country_org+organization_id1+organization_id+' addAll_removeAll_btn" data-list-id="submembership_type-'+data1.organization_id+'-'+organization_id+'" id="subcountry_organization_select" name="submembership_type['+country_org+']['+organization_id1+']['+organization_id+']['+data1.organization_id+'][]" multiple="multiple"></select></div>');
                selectTwoFunction(country_org+organization_id1+organization_id);
                
                
              }
            });
          }
          //$(".show_membership_type").append('<div class="form-group level-drp organization_subcountry_div"><label class="form-label organization_subcountry_label" for="input-1">'+data1.country_name+':</label><ul id="subcountry_organization-'+data1.organization_id+'" style="display:none;">'+org_text+'</ul><select class="js-example-basic-multiple2 addAll_removeAll_btn" data-list-id="subcountry_organization-'+data1.organization_id+'" id="subcountry_organization_select" name="subcountry_organization[]" multiple="multiple"></select></div>');
          
        }
      });
    }
  }
  

  function selectTwoFunction(select_id){
    //alert(select_id);
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
  // if ($(".professional_as").val() != "") {
  //   var professional_as = JSON.parse($(".professional_as").val());
  //   console.log("professional_as", professional_as);
  //   $('.js-example-basic-multiple[data-list-id="des_profession_association"]').select2().val(professional_as).trigger('change');
  // }
  // var org_country = JSON.parse($(".org_country").val());
  // console.log("org_country", org_country);

  // var or_count = [];
  // for(var i=0;i<org_country.length;i++){
  //   or_count.push(org_country[i].organization_country);

  // }
  // console.log("org_country1", or_count);

  if ($(".awards_recognition_input").val() != "") {
    var awards_recognition_input = JSON.parse($(".awards_recognition_input").val());
    $('.js-example-basic-multiple[data-list-id="awards_recognitions"]').select2().val(awards_recognition_input).trigger('change');
    for(var i=0;i<awards_recognition_input.length;i++){
      if ($(".subawards_recognition_input-"+awards_recognition_input[i]).val() != "") {
        var subawards_recognition_input = JSON.parse($(".subawards_recognition_input-"+awards_recognition_input[i]).val());
        $('.js-example-basic-multiple[data-list-id="award_reg-'+awards_recognition_input[i]+'"]').select2().val(subawards_recognition_input).trigger('change');
      }
    }
  }

  // if ($(".subawards_recognition_input").val() != "") {
  //   var awards_recognition_input = JSON.parse($(".awards_recognition_input").val());
  //   $('.js-example-basic-multiple[data-list-id="awards_recognitions"]').select2().val(awards_recognition_input).trigger('change');
  // }

  if ($(".organization_name").val() != "") {
    var organization_name = JSON.parse($(".organization_name").val());
    $('.js-example-basic-multiple[data-list-id="des_profession_association"]').select2().val(organization_name).trigger('change');
  }
 
  if ($(".org_country").val() != "") {
    var org_country = JSON.parse($(".org_country").val());
    $('.js-example-basic-multiple[data-list-id="organization_country"]').select2().val(org_country).trigger('change');
    
    for(var i=0;i<org_country.length;i++){
      if ($(".country_org-"+org_country[i]).val() != "") {
        var suborg_country = JSON.parse($(".country_org-"+org_country[i]).val());
        $('.js-example-basic-multiple[data-list-id="country_organization-'+org_country[i]+'"]').select2().val(suborg_country).trigger('change');
        
        for(var j=0;j<suborg_country.length;j++){
          if ($(".subcountry_org-"+suborg_country[j]).val() != "") {
            var subsuborg_country = JSON.parse($(".subcountry_org-"+suborg_country[j]).val());
            $('.js-example-basic-multiple[data-list-id="subcountry_organization-'+suborg_country[j]+'"]').select2().val(subsuborg_country).trigger('change');
            
            for(var k=0;k<subsuborg_country.length;k++){
              if ($(".memb_type_input-"+subsuborg_country[k]).val() != "") {
                var membership_type = JSON.parse($(".memb_type_input-"+subsuborg_country[k]).val());
                $('.js-example-basic-multiple[data-list-id="membership_type-'+subsuborg_country[k]+'"]').select2().val(membership_type).trigger('change');

                for(var l=0;l<membership_type.length;l++){
                  var submembership_type = JSON.parse($(".submemb_type_input-"+org_country[i]+"-"+membership_type[l]).val());
                  console.log("submembership_type",submembership_type);
                  $('.js-example-basic-multiple[data-list-id="submembership_type-'+membership_type[l]+"-"+subsuborg_country[j]+'"]').select2().val(submembership_type).trigger('change');
                }
              }
            }

          }
        }
      }  
    }
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

  function professional_membership_form() {
    var isValid = true;

    if ($('[name="organization_country[]"]').val() == '') {

      document.getElementById("reqorganization_country").innerHTML = "* Please select the Organization Country";
      isValid = false;

    }

    if ($('[name="des_profession_association[]"]').val() == '') {

      document.getElementById("reqorg_name").innerHTML = "* Please select the Organization Name";
      isValid = false;

    }

    if ($('[name="date_joined"]').val() == '') {

      document.getElementById("reqjoined_date").innerHTML = "* Please select the Joined Date";
      isValid = false;

    }

    if ($('[name="prof_membership_status"]').val() == '') {

      document.getElementById("reqmembership_status").innerHTML = "* Please select the Status";
      isValid = false;

    }

    if ($('[name="awards_recognitions[]"]').val() == '') {

      document.getElementById("reqawards_recognitions").innerHTML = "* Please select the Awards & Recognitions";
      isValid = false;

    }
    
    if (isValid == true) {

      $.ajax({
        url: "{{ route('nurse.updateProfessionalMembership') }}",
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData($('#professional_memb_form')[0]),
        dataType: 'json',
        beforeSend: function() {
          $('#submitProfessionalMembership').prop('disabled', true);
          $('#submitProfessionalMembership').text('Process....');
        },
        success: function(res) {
          $('#submitProfessionalMembership').prop('disabled', false);
          $('#submitProfessionalMembership').text('Update Profile');
          console.log("res.status",res.status);
          if (res.status == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Professional Membership Updated Successfully',
            }).then(function() {
              window.location.href = "{{ route('nurse.professionalMembership') }}?page=professional_membership";
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: res.message,
            })
        }

      },
      error: function(errorss) {
        $('#submitProfessionalMembership').prop('disabled', false);
        $('#submitProfessionalMembership').text('Save Changes');
        console.log("errorss", errorss);
        for (var err in errorss.responseJSON.errors) {
          $("#submitProfessionalMembership").find("[name='" + err + "']").after("<div class='text-danger'>" + errorss.responseJSON.errors[err] + "</div>");
        }
      }
    });
    }
      return false;
  }
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
