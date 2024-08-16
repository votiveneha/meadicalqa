<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"></script>
<script>
 $(document).ready(function() {
 /*------------------------------------------

    --------------------------------------------



    Country Dropdown Change Event

    --------------------------------------------

    --------------------------------------------*/
    $('#nurse_support').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
})

    $(".need_support_btn").click(function(){
      $(".nurse_support_slider").toggle();
    });

    $('#countryI').on('change', function() {

      var idCountry = this.value;

      $("#stateI").html('');

      $.ajax({

        url: "{{url('fetch-provinces')}}",

        type: "POST",

        data: {

          country_id: idCountry,

          _token: '{{csrf_token()}}'

        },

        dataType: 'json',

        success: function(result) {

          $('#stateI').html('<option value=""> Select  State</option>');

          $.each(result.province, function(key, value) {

            $("#stateI").append('<option value="' + value

              .id + '">' + value.name + '</option>');

          });

          $('#cityI').html('<option value=""> Select City </option>');
               
        }

      });
      

    });

    $('#countryLicense').on('change', function() {

      var idCountry = this.value;
      
      $("#stateLicense").html('');

      $.ajax({

        url: "{{url('fetch-provinces')}}",

        type: "POST",

        data: {

          country_id: idCountry,

          _token: '{{csrf_token()}}'

        },

        dataType: 'json',

        success: function(result) {

          $('#stateLicense').html('<option value=""> Select  State</option>');

          $.each(result.province, function(key, value) {

            $("#stateLicense").append('<option value="' + value

              .id + '">' + value.name + '</option>');

          });

          
               
        }

      });
      

    });



    /*------------------------------------------

    --------------------------------------------

    State Dropdown Change Event 

    --------------------------------------------

    --------------------------------------------*/

    $('#stateI').on('change', function() {

      var idState = this.value;

      $("#cityI").html('');

      $.ajax({

        url: "{{url('fetch-ville')}}",

        type: "POST",

        data: {

          province_id: idState,

          _token: '{{csrf_token()}}'

        },

        dataType: 'json',

        success: function(res) {

          $('#cityI').html('<option value=""> Select City </option>');

          $.each(res.ville, function(key, value) {

            $("#cityI").append('<option value="' + value

              .id + '">' + value.name + '</option>');

          });

        }

      });

    });
 $('#categoryI').on('change', function() {

      var categoryI = this.value;

      $("#sub_cateI").html('');

      $.ajax({

        url: "{{url('fetch-sub-cat')}}",

        type: "POST",

        data: {

          category_id: categoryI,

          _token: '{{csrf_token()}}'

        },

        dataType: 'json',

        success: function(res) {
          

          $('#sub_cateI').html('<option value=""> Select Sub category </option>');

          $.each(res.sub_cat, function(key, value) {

            $("#sub_cateI").append('<option value="' + value

              .id + '">' + value.category_name + '</option>');

          });

        }

      });

    });


  });
</script>
<script>
        $('.numbers').keyup(function() {
            this.value = this.value.replace(/[^0-9\.]/g, '');
        });
        $('.licence_number').keyup(function() {
            this.value = this.value.replace(/[^a-zA-Z0-9]/g, '');
        });
    </script>
 <script type="text/javascript">
          $(function() {
  
  var targetDate  = new Date(Date.UTC(2017, 3, 01));
  var now   = new Date();

  window.days = daysBetween(now, targetDate);
  var secondsLeft = secondsDifference(now, targetDate);
  window.hours = Math.floor(secondsLeft / 60 / 60);
  secondsLeft = secondsLeft - (window.hours * 60 * 60);
  window.minutes = Math.floor(secondsLeft / 60 );
  secondsLeft = secondsLeft - (window.minutes * 60);
  console.log(secondsLeft);
  window.seconds = Math.floor(secondsLeft);

  startCountdown();
});
var interval;

function daysBetween( date1, date2 ) {
  //Get 1 day in milliseconds
  var one_day=1000*60*60*24;

  // Convert both dates to milliseconds
  var date1_ms = date1.getTime();
  var date2_ms = date2.getTime();

  // Calculate the difference in milliseconds
  var difference_ms = date2_ms - date1_ms;
    
  // Convert back to days and return
  return Math.round(difference_ms/one_day); 
}

function secondsDifference( date1, date2 ) {
  //Get 1 day in milliseconds
  var one_day=1000*60*60*24;

  // Convert both dates to milliseconds
  var date1_ms = date1.getTime();
  var date2_ms = date2.getTime();
  var difference_ms = date2_ms - date1_ms;
  var difference = difference_ms / one_day; 
  var offset = difference - Math.floor(difference);
  return offset * (60*60*24);
}



function startCountdown() {
  $('#input-container').hide();
  $('#countdown-container').show();
  
  displayValue('#js-days', window.days);
  displayValue('#js-hours', window.hours);
  displayValue('#js-minutes', window.minutes);
  displayValue('#js-seconds', window.seconds);

  interval = setInterval(function() {
    if (window.seconds > 0) {
      window.seconds--;
      displayValue('#js-seconds', window.seconds);
    } else {
      // Seconds is zero - check the minutes
      if (window.minutes > 0) {
        window.minutes--;
        window.seconds = 59;
        updateValues('minutes');
      } else {
        // Minutes is zero, check the hours
        if (window.hours > 0)  {
          window.hours--;
          window.minutes = 59;
          window.seconds = 59;
          updateValues('hours');
        } else {
          // Hours is zero
          window.days--;
          window.hours = 23;
          window.minutes = 59;
          window.seconds = 59;
          updateValues('days');
        }
        // $('#js-countdown').addClass('remove');
        // $('#js-next-container').addClass('bigger');
      }
    }
  }, 1000);
}


function updateValues(context) {
  if (context === 'days') {
    displayValue('#js-days', window.days);
    displayValue('#js-hours', window.hours);
    displayValue('#js-minutes', window.minutes);
    displayValue('#js-seconds', window.seconds);
  } else if (context === 'hours') {
    displayValue('#js-hours', window.hours);
    displayValue('#js-minutes', window.minutes);
    displayValue('#js-seconds', window.seconds);
  } else if (context === 'minutes') {
    displayValue('#js-minutes', window.minutes);
    displayValue('#js-seconds', window.seconds);
  }
}

function displayValue(target, value) {
  var newDigit = $('<span></span>');
  $(newDigit).text(pad(value))
    .addClass('new');
  $(target).prepend(newDigit);
  $(target).find('.current').addClass('old').removeClass('current');
  setTimeout(function() {
    $(target).find('.old').remove();
    $(target).find('.new').addClass('current').removeClass('new');
  }, 900);
}

function pad(number) {
  return ("0" + number).slice(-2);
}

 function preview_image_single_second()

    {

        $('#image_preview_div_single_second').show();

        var total_file = document.getElementById("upload_file_second").files.length;

        for (var i = 0; i < total_file; i++)

        {

            $('#image_preview_single_second').empty().append(
                "<ul><li class='position-relative img-li'><span class='position-absolute close-btn'></span><img src='" +
                URL.createObjectURL(event.target.files[i]) + "' class='rounded-circle' width='100' height='100'></li></ul><br>");

        }
        $('.pervious_image').hide();

    }
        </script>
        
         <script>
             function ChangePassword() {
        $.ajax({
            url: "{{route('nurse.change_password')}}",
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData($('#ChangePassword')[0]),
            dataType: 'json',
            beforeSend: function() {
                $('#signup_btn').prop('disabled', true);
                $('#signup_btn').text('Process...');
            },
            success: function(data) {
                $('#signup_btn').prop('disabled', false);
                $('#signup_btn').text('Change password');
                if (data.status == 1) {

                    Swal.fire({
                        icon: 'success',
                        title: data.message,
                        showDenyButton: false,
                        showCancelButton: false,
                        confirmButtonText: 'Got It',
                        denyButtonText: `Don't save`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    })

                } else {
                    if (data.status == 2) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.message,
                        })
                    } else {
                        $('#old_pass').html(data.message);
                        for (var err in data.validation) {

                            $("#ChangePassword").find("[name='" + err + "']").after("<div  class='label alert-danger' style='color:red;'>" + data.validation[err] + "</div>");
                        }
                    }
                }
            },
            error: function(eror) {
                console.log(eror);
                for (var err in eror.responseJSON.errors) {

                    $("#ChangePassword").find("[name='" + err + "']").after("<div  class='label alert-danger'>" + eror.responseJSON.errors[err] + "</div>");
                }
            }
        });
        return false;
    }
            
        </script>
        <script>
        function upload_profileimage(e) {

                e.preventDefault();
                $('#preloadeer-active').show();
                $('.alert-danger').remove();
                var fileInput = document.getElementById("fileInputs");

                if (fileInput.files.length > 0) {



                        $.ajax({



                                url: '{{route("nurse.user-upload-image")}}',



                                type: 'POST',



                                cache: false,



                                contentType: false,
                                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token in headers
            },



                                processData: false,



                                data: new FormData($('#upload_profileimage')[0]),



                                dataType: 'json',



                                beforeSend: function() {



                                        $('#sub_btn').prop('disabled', true);



                                        $('#php502').html('Uploading ...');







                                },



                                success: function(res) {



                                        $('#sub_btn').prop('disabled', false);







                                        if (res.status == 1) {



                                                window.location.reload();



                                        } else if (res.status == 2) {



                                                for (var err in res.message) {







                                                        $("[name='" + err + "']").after("<div  class='label alert-danger'>" + res.message[err] + "</div>");



                                                }
                                                  $('#preloadeer-active').hide();



                                        }







                                }



                        });



                } else {


  $('#preloadeer-active').hide();
                        return false;



                }



        }
</script>
<script>
 function editedprofile() {
    $('#EditProfile').find('.text-danger').hide();
    
    $.ajax({
      url: "{{ route('nurse.updateProfile') }}",
      type: "POST",
      cache: false,
      contentType: false,
      processData: false,
      data: new FormData($('#EditProfile')[0]),
      dataType: 'json',
      beforeSend: function() {
        $('#submitfrm').prop('disabled', true);
        $('#submitfrm').text('Process....');
      },
      success: function(res) {
        $('#submitfrm').prop('disabled', false);
        $('#submitfrm').text('Update Profile');
        if (res.status == '2') {
          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Profile Updated Successfully',
          }).then(function() {
            window.location.href = "{{ route('nurse.my-profile') }}";
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
        $('#submitfrm').prop('disabled', false);
        $('#submitfrm').text('Submit');
        for (var err in errorss.responseJSON.errors) {
          $("#EditProfile").find("[name='" + err + "']").after("<div class='text-danger'>" + errorss.responseJSON.errors[err] + "</div>");
        }
      }
    });
    return false;
  }
  function myFunction1() {
    event.preventDefault();
    var isValid = true;
    if ($('[name="nurseType[]"]').val() == '') {
      document.getElementById("reqnurseTypeId").innerHTML = "* Please select one or more Type of nurse";
      isValid = false;
    }

    if ($('[name="specialties[]"]').val() == '') {
      document.getElementById("reqspecialties").innerHTML = "* Please select one or more specialties.";
      isValid = false;
    }

    if ($('[name="degree[]"]').val() == '') {
      document.getElementById("reqdegree").innerHTML = "* Please select degree.";
      isValid = false;
    }

    if ($('[name="bio"]').val() == '') {
      document.getElementById("reqprofessional_bio").innerHTML = "* Please enter the bio.";
      isValid = false;
    }

    if ($('[name="employee_status"]').val() == '') {
      document.getElementById("reqemployee_status").innerHTML = "* Please select the employee status.";
      isValid = false;
    }

    if(isValid == true){
      $.ajax({
        url: "{{ route('nurse.updateProfession') }}",
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData($('#profession_form')[0]),
        dataType: 'json',
        beforeSend: function() {
          $('#submitProfession').prop('disabled', true);
          $('#submitProfession').text('Process....');
        },
        success: function(res) {
          $('#submitProfession').prop('disabled', false);
          $('#submitProfession').text('Update Profile');

          if (res.status == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Professional Information Updated Successfully',
            }).then(function() {
              window.location.href = "{{ route('nurse.my-profile') }}?page=profession";
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
          $('#submitProfession').prop('disabled', false);
          $('#submitProfession').text('Submit');
          for (var err in errorss.responseJSON.errors) {
            $("#submitProfession").find("[name='" + err + "']").after("<div class='text-danger'>" + errorss.responseJSON.errors[err] + "</div>");
          }
        }
      });
    }
    return false;
  }
  function educert() {
    $('#educert_form').find('.text-danger').hide();
    $.ajax({
      url: "{{ route('nurse.updateEducation') }}",
      type: "POST",
      cache: false,
      contentType: false,
      processData: false,
      data: new FormData($('#educert_form')[0]),
      dataType: 'json',
      beforeSend: function() {
        $('#submitEducation').prop('disabled', true);
        $('#submitEducation').text('Process....');
      },
      success: function(res) {
        $('#submitEducation').prop('disabled', false);
        $('#submitEducation').text('Update Profile');

        if (res.status == '1') {
          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Education Information Updated Successfully',
          }).then(function() {
            window.location.href = "{{ route('nurse.my-profile') }}?page=educert";
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
        $('#submitEducation').prop('disabled', false);
        $('#submitEducation').text('Submit');
        console.log("errorss",errorss);
        for (var err in errorss.responseJSON.errors) {
          $("#submitEducation").find("[name='" + err + "']").after("<div class='text-danger'>" + errorss.responseJSON.errors[err] + "</div>");
        }
      }
    });
    return false;
  }
  function updateExperience() {
    $('#experience_form').find('.text-danger').hide();
    $.ajax({
      url: "{{ route('nurse.updateExperience') }}",
      type: "POST",
      cache: false,
      contentType: false,
      processData: false,
      data: new FormData($('#experience_form')[0]),
      dataType: 'json',
      beforeSend: function() {
        $('#submitExperience').prop('disabled', true);
        $('#submitExperience').text('Process....');
      },
      success: function(res) {
        $('#submitExperience').prop('disabled', false);
        $('#submitExperience').text('Update Profile');

        if (res.status == '1') {
          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Experience Information Updated Successfully',
          }).then(function() {
            window.location.href = "{{ route('nurse.my-profile') }}?page=experience_info";
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
        $('#submitExperience').prop('disabled', false);
        $('#submitExperience').text('Submit');
        console.log("errorss",errorss);
        for (var err in errorss.responseJSON.errors) {
          $("#submitExperience").find("[name='" + err + "']").after("<div class='text-danger'>" + errorss.responseJSON.errors[err] + "</div>");
        }
      }
    });
    return false;
  }
  </script>
<!-- =================================

    Change password  Script

    ================================== --><script>
  function ChangePassword() {
    $('#ChangePassword').find('.text-danger').hide();
    $.ajax({
      url: "{{ route('nurse.changepassword') }}",
      type: "POST",
      cache: false,
      contentType: false,
      processData: false,
      data: new FormData($('#ChangePassword')[0]),
      dataType: 'json',
      beforeSend: function() {
        $('#signup_btn').prop('disabled', true);
        $('#signup_btn').text('Process...');
      },
      success: function(data) {
        $('#signup_btn').prop('disabled', false);
        $('#signup_btn').text('Update');
        if (data.status == 2) {
          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Password Changed Successfully',
          }).then(function() {
            window.location.href = "{{ route('nurse.my-profile') }}";
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: data.message,
          });
        }
      },
      error: function(eror) {
        $('#signup_btn').prop('disabled', false);
        $('#signup_btn').text('Update Password');
        console.log(eror);
        for (var err in eror.responseJSON.errors) {
          console.log(eror.responseJSON.errors[err]);
          if(eror.responseJSON.errors[err] == "The password field is required."){
            $("#ChangePassword").find("[name='" + err + "']").after("<div class='text-danger'>The new password is required.</div>");
          }else{
            if(eror.responseJSON.errors[err] == "The password confirmation field is required."){
              $("#ChangePassword").find("[name='" + err + "']").after("<div class='text-danger'>The confirm new password is required.</div>");
            }else{
              $("#ChangePassword").find("[name='" + err + "']").after("<div class='text-danger'>" + eror.responseJSON.errors[err] + "</div>");
            }
            
          }
          
        }
      }
    });
    return false;
  }
  
</script>

<script>
function coming_soon() {
 
  $('#commingsoonModel').modal('show');
}
function get_new_plice_check() {
 
  $('#get_new_plice_checkModel').modal('show');
}
</script>
        <script>
   
  

</script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

