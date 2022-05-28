@extends('frontend.layout.master')
@section('content')

    <main>
        <div class="banner_share">
            <img src="{{ asset('storage') }}/uploads/pages/{{ $page->img }}" alt="">
            <div class="container">
                <div class="title">
                    <h2>{{ $page->translations->name }}</h2>
                </div>
            </div>
        </div>


        {{-- <div class="map">
            <div class="container mb-5">
               {{ $setting->map }}
            </div>
        </div> --}}

        <div class="contact">
            <div class="container">
                <div style="background: url('{{ asset('storage') }}/uploads/pages/{{ $page->img }}') no-repeat;" class="conatact__banner">
                    <div style="color:white" class="contact__content">
                        {!! $page->translations->content !!}
                        {{-- <a href="#" class="button" id="showForm">{{ __('Click vào đây ') }}</a> --}}
                    </div>
                    <form action="{{ route('backend.contactform.store') }}" method="POST" accept-charset="utf-8">
                        @csrf
                        @if ($errors->any())
              <div id="error_contact" class="alert alert-danger" style="display: none">
                <ul style="padding-left: 0px;">
                  @foreach ($errors->all() as $error)
                  <li style="line-height: 32px;">{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
              @endif
                        <div class="contact__form active">
                            <div class="row">

                                <div class="col col-12 col-md-4">
                                    <div class="form-group">

                                        <input type="text" class="form-control" name="name"
                                           required placeholder="{{ __('Tên của bạn') }}">

                                    </div>
                                </div>
                                <div class="col col-12 col-md-4">
                                    <div class="form-group">

                                        <input type="text" class="form-control" name="email"
                                          required  placeholder="{{ __('Email của bạn') }}">

                                    </div>
                                </div>
                                <div class="col col-12 col-md-4">
                                    <div class="form-group">

                                        <input type="text" class="form-control" name="phone"
                                           required placeholder="{{ __('SĐT của bạn') }}">

                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">

                                        <input type="text" class="form-control" name="subject"
                                          required  placeholder="{{ __('Tiêu đề') }}">

                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">

                                        <textarea class="form-control" name="contactcontent"  rows="5" required placeholder="{{ __('Nội dung') }}"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-12" style="padding-bottom: 10px;">
                                      <input class="form-control" name="captcha" id="captcha" placeholder="Captcha" type="text"  />
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-6 refereshrecapcha" style="padding-bottom: 10px;">
                                      {!! captcha_img('flat') !!}
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                      <a href="javascript:void(0)" onclick="refreshCaptcha()"><i class="fa-solid fa-arrows-rotate"></i></a>
                                    </div>
                                  </div>
                                </div>
                                  <div class="col-12">
                                    <div class="mt-md-5 mt-1 text-center">
                                        <button style="border:none" type="submit"  class="book-room-now2 ">{{ __('Gửi') }} </button>
                                        <!-- <a href="#" class="button">Send Message</a> -->
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
                <div class="conatact__bottom">
                    <div class="row">
                        <div class="col col-12 col-md-4 col-lg-4">
                            <div class="box-center">
                                <i class="fa-solid fa-location-dot"></i>
                                <p class="text-hig">{{ __('Chúng tôi ở đâu ?') }}</p>
                               {{ $setting->translations->address }}
                            </div>
                        </div>
                        <div class="col col-12 col-md-4 col-lg-4">
                            <div class="box-center">
                                <i class="fa-solid fa-phone"></i>
                                <p class="text-hig">{{ __('Gọi cho chúng tôi') }}</p>
                               {{ $setting->hotline_1 }}
                            </div>
                        </div>
                        <div class="col col-12 col-md-4 col-lg-4">
                            <div class="box-center">
                                <i class="fa-solid fa-envelope"></i>
                                <p class="text-hig">{{ __('Email') }}</p>
                                {{ $setting->email }}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('style')
<style>

.contact__form.active {
    display: block;
    animation: 1s ease-in-out 0s 1 normal none running backInDown;
}
    .form-control {
        display: block;
        width: 100%;
        height: calc(1.5em + .75rem + 2px);
        padding: .375rem .75rem;
        font-size: 1.5rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }

    @media (prefers-reduced-motion:reduce) {
        .form-control {
            transition: none;
        }
    }

    .form-control::-ms-expand {
        background-color: transparent;
        border: 0;
    }

    .form-control:focus {
        color: #495057;
        background-color: #fff;
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 .2rem rgba(0, 123, 255, .25);
    }

    .form-control::-webkit-input-placeholder {
        color: #6c757d;
        opacity: 1;
    }

    .form-control::-moz-placeholder {
        color: #6c757d;
        opacity: 1;
    }

    .form-control:-ms-input-placeholder {
        color: #6c757d;
        opacity: 1;
    }

    .form-control::-ms-input-placeholder {
        color: #6c757d;
        opacity: 1;
    }

    .form-control::placeholder {
        color: #6c757d;
        opacity: 1;
    }

    .form-control:disabled {
        background-color: #e9ecef;
        opacity: 1;
    }

    textarea.form-control {
        height: auto;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .mt-1 {
        margin-top: .25rem !important;
    }

    @media (min-width:768px) {
        .mt-md-5 {
            margin-top: 3rem !important;
        }
    }


    a.button {
        text-decoration: none;
        padding: 8px 17px;
        background: transparent;
        border: 1px solid #ddd;
        color: #fff;
        position: relative;
        font-size: 18px;
        transition: .5s;
    }

    a.button:hover {
        color: #222;
        background: #fff;
    }


    h2.titleC {
        font-weight: 600;
        font-family: "Playfair Display", serif;
        color: #fff;
    }

    .contact {
        position: relative;
        margin: 0 auto;
    }

    .conatact__banner {
        background: #3d5e29;
        padding: 50px 40px;
        /* background: url(https://eaglehotel.webhotel.vn/files/images/slide/bg.png) no-repeat; */
        background-size: cover;
        background-position: 100% 100%;
    }

    .contact__content {
        text-align: center;
    }

    .contact__content .textC {
        color: #fff;
        margin-bottom: 50px;
    }

    .text-hig {
        color: #000;
        font-weight: 600;
    }

    .conatact__bottom {
        background: #EEEEEE;
        padding: 20px 0;
    }

    .conatact__bottom .box-center {
        text-align: center;
        margin-bottom: 15px;
    }

    .conatact__bottom .box-center img {
        height: 20px;
        margin-bottom: 10px;
    }

    .contact__form {
        margin-top: 40px;
        display: none;
    }

    /* @media (max-width:575px) {
        .contact {
            width: 100%;
        }

        .conatact__banner {
            margin-top: 0px;
        }
    } */



</style>
@endpush

@push('script')
<script>
    function refreshCaptcha() {
        $.ajax({
            url: "{{ route('refereshcapcha') }}",
            type: "get",
            dataType: "html",
            success: function (json) {
                $(".refereshrecapcha").html(json);
            },
            error: function (data) {
                alert("Try Again.");
            },
        });
    }
</script>
<script>
    var has_errors = {{ $errors->count() > 0 ? 'true' : 'false' }};
    if (has_errors) {
      Swal.fire({
        title: '{{ __('error') }}...!',
        icon: 'error',
        html: jQuery('#error_contact').html(),
        showCloseButton: true,
      });
    }
</script>
<script>
    $(function () {
$("#showForm").on("click",function (e){
e.preventDefault();
$(".contact__form").toggleClass("active");
});
});
</script>
@endpush
