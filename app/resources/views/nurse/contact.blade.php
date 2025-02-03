@extends('nurse.layouts.layout')
@section('css')

@section('content')

<main class="main">
  <section class="section-box">
    <div class="breacrumb-cover bg-img-about">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <h2 class="mb-10">Contact Us</h2>
            <p class="font-lg color-text-paragraph-2">Get the latest news, updates and tips</p>
          </div>
          <div class="col-lg-6 text-lg-end">
            <ul class="breadcrumbs mt-40">
              <li><a class="home-icon" href="{{ route('home_main')}}">Home</a></li>
              <li>Contact Us</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="section-box mt-70">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mb-40"><span class="font-md color-brand-2 mt-20 d-inline-block">Contact us</span>
          <h2 class="mt-5 mb-10">Get in touch</h2>
          <p class="font-md color-text-paragraph-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br class="d-none d-lg-block"> Lorem ipsum dolor sit amet, consectetur.</p>
          <form class="contact-form-style mt-30" id="contact-form">
            @csrf
            <div class="row wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
              <div class="col-lg-6 col-md-6">
                <div class="input-style mb-20">
                  <input class="font-sm color-text-paragraph-2" id="name" name="name" placeholder="First name" type="text">
                  <span id="nameErr" class="text-danger"></span>
                </div>
              </div>
              <div class="col-lg-6 col-md-6">
                <div class="input-style mb-20">
                  <input class="font-sm color-text-paragraph-2" id="lastnames" name="lastname" placeholder="Last Name" type="text">
                  <span id="lastnameErr" class="text-danger"></span>
                </div>
              </div>
              <div class="col-lg-6 col-md-6">
                <div class="input-style mb-20">
                  <input class="font-sm color-text-paragraph-2" id="email" name="email" placeholder="Your email" type="email">
                  <span id="emailErr" class="text-danger"></span>
                </div>
              </div>
              <div class="col-lg-2 col-md-1">
                <div class="input-style mb-20">
                  <select name="phone_code" class="form-control">
                    @if ($phoneCode)
                    @foreach ($phoneCode as $code)
                    <option value="{{ $code->id }}">{{ $code->phonecode }}
                    </option>
                    @endforeach
                    @endif
                  </select>
                </div>
              </div>
             
            
            <div class="col-lg-4 col-md-4">
              <div class="input-style mb-20">

                <input class="font-sm color-text-paragraph-2 numbers" id="phone_no" name="phone_no" placeholder="Phone number" type="tel">
                <span id="phone_noErr" class="text-danger"></span>
              </div>
              
            </div>


            <div class="col-lg-12 col-md-12">
              <div class="textarea-style mb-30">
                <textarea class="font-sm color-text-paragraph-2" id="message" name="message" placeholder="Tell us about yourself"></textarea>
                <span id="messageErr" class="text-danger"></span>
              </div>
              <button class="submit btn btn-send-message" type="button" id="signup_btn" onclick="return addContactUs()">Send message</button>
             
            </div>
        </div>
        </form>
        <p class="form-messege"></p>
      </div>
      <div class="col-lg-4 text-center d-none d-lg-block"><img src="{{ asset('nurse/assets/imgs/page/contact/img.png') }}" alt="joxBox"></div>
    </div>
    </div>
  </section>

</main>



@endsection
@section('js')
<!-- <script>
  var swiper = new Swiper(".swiper-group-5", {
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  }); 

<script> -->
  <script>
  function addContactUs() {
    $.ajax({
    url: "{{ route('save-contact') }}",
    type: "POST",
    data: new FormData($('#contact-form')[0]),
    cache: false,
    contentType: false,
    processData: false,
    dataType: 'json',
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    beforeSend: function() {
        $('#signup_btn').prop('disabled', true);
        $('#signup_btn').text('Processing...');
    },
    success: function(res) {
        $('#signup_btn').prop('disabled', false);
        $('#signup_btn').text('Send message');
        $('#contact-form')[0].reset();
        if (res.status == '2') {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: res.message,
            }).then(function() {
                window.location.href = '{{ route("contact") }}';
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: res.message,
            })
        }
    },
    error: function(error) {
        $('#signup_btn').prop('disabled', false);
        $('#signup_btn').text('Send Now');

        var name = document.getElementById("name").value;
        var lastname = document.getElementById("lastnames").value;
        var email = document.getElementById("email").value;
        var message = document.getElementById("message").value;
        var phone_no = document.getElementById("phone_no").value;
        
        if (name == '') {
            $('#nameErr').text(error.responseJSON.errors.name);

        } else {
            $('#nameErr').text('');
        }
        if (lastname == '') {
            $('#lastnameErr').text(error.responseJSON.errors.lastname);

        } else {
            $('#lastnameErr').text('');
        }
        if (email == '') {
            $('#emailErr').text(error.responseJSON.errors.email);

        } else {
            $('#emailErr').text('');
        }
       
        if (message == '') {
            $('#messageErr').text(error.responseJSON.errors.message);

        } else {
            $('#messageErr').text('');
        }
        if (phone_no == '') {
            $('#phone_noErr').text(error.responseJSON.errors.phone_no);

        } else {
            $('#phone_noErr').text('');
        }
    }
});

            return false;
        }
</script> 
@endsection