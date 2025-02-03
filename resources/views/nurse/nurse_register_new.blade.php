@extends('nurse.layouts.layout')
@section('css')
<link rel="stylesheet" 
              href= 
"https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" />
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
    float: left !important;
    margin-right: 5px !important;
    margin-top: 5px !important;
    color: #fff !important;
    padding: 2px 10px 5px !important;
  }

  .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: #fff !important;
    cursor: pointer !important;
    display: inline-block !important;
    font-weight: bold !important;
    margin-right: 10px !important;
    font-size: 20px !important;
  }
</style>
@endsection
@section('content')

<main class="main">
  <section class="pt-100 login-register">

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
          <div class="row ">
            <div class="col-lg-5 col-md-6 col-sm-12 mx-auto">
              <div class="text-center">
                <!-- <p class="font-sm text-brand-2">Register </p> -->
                <h2 class="mt-10 mb-5 text-brand-1 fs_24">In just a few minutes, you will be able to apply for the ideal shift or permanent position</h2>

                <!-- <h2 class="mt-10 mb-5 text-brand-1 fs_24">Tell us about your qualifications</h2> -->

              </div>
              <div class="login-register text-start mt-20" action="#">


                <div class="form-group">
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
                  </select> -->
                </div>
                <span id="reqnurseTypeId" class="reqError valley"></span>

                <div id="nurse_select">
                  <!-- <div id="nurse_select"  style="display: none;"> -->
                  <div class="form-group" id="subspecialtyGroup">
                    <label class="form-label" for="input-1">Types of Nursing Jobs</label>
                    <select class="form-input mr-10" name="nurseTypeJob[]" id="nurseTypeJob" multiple>

                    </select>
                  </div>
                  <span id="reqnurseTypeJobId" class="reqError valley"></span>
                </div>

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
                  <div class="form-group">
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
                      <div class="col-md-3">
                        <select name="countryCode" id="countryCode" class="form-control" placeholder="C. Code" aria-label="Default select example">
                          @php $country_phone_code = country_phone_code();@endphp
                          @forelse($country_phone_code as $cpc)
                          @if($cpc->phonecode!='0')
                          <option data-countryCode="GB" value="{{ $cpc->phonecode}}" @if($cpc->name == "Australia") selected @endif>(+{{ $cpc->phonecode}})</option>
                          @endif
                          @empty
                          <!-- @endforelse -->
                        </select>
                      </div>
                      <div class="col-md-9">
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

      document.getElementById("reqTxtemailI").innerHTML = "* Please enter the email address.";

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

      document.getElementById("reqTxtemailI").innerHTML = "* Please enter the  email address.";

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

    // if (passwordI.length < 8) {

    //   document.getElementById("reqTxtpasswordI").innerHTML = "*  Your password must be at least 8-12 characters long";

    //   returnValue = false;

    // }
    var pattern = /^.*(?=.{8,12})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%&!-_]).*$/;

    if (!pattern.test(passwordI)) {

      document.getElementById("reqTxtpasswordI").innerHTML = "Enter minimum 8-12 chars with atleast 1 number, lower, upper & special(@#$%&!-_&) char.";

      returnValue = false;

    }

    //var str = passwordI;


    for (var i=0; i<passwordI.length; i++) {

      if ( passwordI.indexOf(passwordI[i]) !== passwordI.lastIndexOf(passwordI[i]) ) {
        document.getElementById("reqTxtpasswordI").innerHTML = "characters can not be repeat";
        returnValue = false;
      }
    }
    alert(returnValue);


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
 <script src= 
"https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"> 
       </script> 
<script>
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