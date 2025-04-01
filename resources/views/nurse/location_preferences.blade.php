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

  form#location_preferences_form ul.select2-selection__rendered {
    box-shadow: none;
    max-height: inherit;
    border: none;
    position: relative;
  }
</style>
@endsection

@section('content')
<main class="main">
  <section class="section-box mt-0">
    <div class="">
      <div class="row m-0 profile-wrapper">
        <div class="col-lg-3 col-md-4 col-sm-12 p-0 left_menu">

        @include('nurse.layouts.work_preferences_sidebar')
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

                <div class="tab-pane fade" id="tab-my-profile-setting" style="display: block;opacity:1;">

                    
                    <div class="card shadow-sm border-0 p-4 mt-30">
                      <h3 class="mt-0 color-brand-1 mb-2">International</h3>
                      <div class="work_preferences_text">
                        <p>
                            You are open to international relocation.

    
                        </p>
                        <p>
                            Mediqa currently has connections with a network of facilities in 10 countries, and we are actively working to expand our reach even further. Take advantage of this opportunity to connect with international employers and secure interviews with healthcare facilities abroad.

    
                        </p>
                      </div>  
                      <form id="location_preferences_form" method="POST" onsubmit="return update_location_preferences()">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::guard('nurse_middle')->user()->id }}">

                        <div class="form-group level-drp">
                          <label class="form-label" for="input-1">Countries
                          </label>
                          <?php
                            if(!empty($work_preferences_data)){
                                $countries_data_work = $work_preferences_data->countries;
                                
                            }else{
                                $countries_data_work = ''; 
                            }
                            
                            
                            
                          ?>
                          <input type="hidden" name="country_data" class="country_data" value='<?php echo $countries_data_work; ?>'>
                          <ul id="countries_data" style="display:none;">
                            
                            @if(!empty($countries_data))
                            @foreach($countries_data as $cdata)
                            <li data-value="{{ $cdata->id }}">{{ $cdata->name }}</li>
                            @endforeach
                            <li data-value="Other">Other</li>
                            @endif
                          </ul>
                          <select class="js-example-basic-multiple addAll_removeAll_btn countvalid" data-list-id="countries_data" name="countries[]" multiple></select>
                          <span id='reqcountry_preferences' class='reqError text-danger valley'></span>
                        </div>
                        <?php
                            if(!empty($work_preferences_data) && $work_preferences_data->other_countries != NULL){
                                $countries_data_work_other = $work_preferences_data->other_countries;
                                
                            }else{
                                $countries_data_work_other = ''; 
                            }
                            
                            
                            
                        ?>
                        <div class="form-group level-drp @if(empty($countries_data_work_other)) d-none @endif countries_other_div">
                            <label class="form-label" for="input-1">Other
                            </label>
                            
                          <input type="hidden" name="country_data_other" class="country_data_other" value='<?php echo $countries_data_work_other; ?>'>
                            <ul id="countries_data_other" style="display:none;">
                            
                                @if(!empty($countries_data_other))
                                @foreach($countries_data_other as $cdata_other)
                                <li data-value="{{ $cdata_other->id }}">{{ ucfirst($cdata_other->nicename) }}</li>
                                @endforeach
                                
                                @endif
                            </ul>
                            <select class="js-example-basic-multiple addAll_removeAll_btn othercountvalid" data-list-id="countries_data_other" name="other_countries[]" multiple></select>
                            <span id='reqothercountry_preferences' class='reqError text-danger valley'></span>
                        </div>
                        <div class="box-button mt-15">
                          <button class="btn btn-apply-big font-md font-bold" type="submit" id="submitLocationPreferences">Save Changes</button>
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

    $('.js-example-basic-multiple').select2();

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
    $('.js-example-basic-multiple').each(function() {
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

    if ($(".country_data").val() != "") {
        var countvalid = JSON.parse($(".country_data").val());
        $('.js-example-basic-multiple[data-list-id="countries_data"]').select2().val(countvalid).trigger('change');
    }

    if ($(".countries_other_div").hasClass("d-none") == false) {
        if ($(".country_data_other").val() != "") {
            var othercountvalid = JSON.parse($(".country_data_other").val());
            $('.js-example-basic-multiple[data-list-id="countries_data_other"]').select2().val(othercountvalid).trigger('change');
        }
    }    
</script>
<script type="text/javascript">
    $('.js-example-basic-multiple[data-list-id="countries_data"]').on('change', function() {
        let selectedValues = $(this).val();
        console.log("selectedValues",selectedValues);

        if(selectedValues.includes("Other")){
            $(".countries_other_div").removeClass("d-none");
        }else{
            $('.js-example-basic-multiple[data-list-id="countries_data_other"]').select2().val([]).trigger('change');
            $(".countries_other_div").addClass("d-none");
        }
    });

    function update_location_preferences() {
      var isValid = true;

      if ($(".countvalid").val() == '') {

        document.getElementById("reqcountry_preferences").innerHTML = "* Please select the countries.";
        isValid = false;

      }

      if ($(".countries_other_div").hasClass("d-none") == false && $(".othercountvalid").val() == '') {

        document.getElementById("reqothercountry_preferences").innerHTML = "* Please select the other countries.";
        isValid = false;

      }

      if (isValid == true) {
        $.ajax({
        url: "{{ route('nurse.updateLocationPreferences') }}",
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData($('#location_preferences_form')[0]),
        dataType: 'json',
        beforeSend: function() {
          $('#submitLocationPreferences').prop('disabled', true);
          $('#submitLocationPreferences').text('Process....');
        },
        success: function(res) {
          if (res.status == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Location Preferences Updated Successfully',
            }).then(function() {
              window.location.href = "{{ route('nurse.locationPreferences') }}?page=locationPreferences";
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
          $('#submitLocationPreferences').prop('disabled', false);
          $('#submitLocationPreferences').text('Save Changes');
          console.log("errorss", errorss);
          for (var err in errorss.responseJSON.errors) {
            $("#submitLocationPreferences").find("[name='" + err + "']").after("<div class='text-danger'>" + errorss.responseJSON.errors[err] + "</div>");
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
