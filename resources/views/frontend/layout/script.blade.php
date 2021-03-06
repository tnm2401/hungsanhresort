  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="{{ asset('frontend') }}/assets/js/jquery-3.5.1.min.js"></script>
  <script src="{{ asset('frontend') }}/assets/js/bootstrap.min.js"></script>

  {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> --}}
  <script src="{{ asset('frontend') }}/assets/js/popper.min.js"></script>


  <script src="{{ asset('frontend') }}/assets/js/jquery-ui.js"></script>
  <script src="{{ asset('frontend') }}/assets/js/owl.carousel.min.js"></script>
  <script src="{{ asset('frontend') }}/assets/js/aos.js"></script>
  <script src="{{ asset('frontend') }}/assets/js/jquery.fancybox.min.js"></script>
  <script src="{{ asset('frontend') }}/assets/js/main.js"></script>
  <script src="{{ asset('frontend') }}/assets/js/slider.js"></script>
  <script src="{{ asset('frontend') }}/assets/datepicker/dist/mc-calendar.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  {{-- <script src="{{ asset('frontend') }}/assets/slick/slick/slick.min.js"></script> --}}


  <!-- galery -->
  <script src="{{ asset('frontend') }}/assets/js/isotope.pkgd.min.js"></script>
  <script src="{{ asset('frontend') }}/assets/js/galery.js"></script>
  <!-- galery -->
  {!! $setting->codebody !!}

  @stack('script')
  <script>
      $('#gallery a').fancybox({
          loop: true,
          buttons: [
              "slideShow",
              "thumbs",
              "zoom",
              "fullScreen",
              "share",
              "close"
          ],

          protect: true,
          transitionEffect: "slide",
      });
      $(document).ready(function() {
          // add all to same gallery
          $("#gallery a").attr("data-fancybox", "mygallery");
          // assign captions and title from alt-attributes of images:
          $("#gallery a").each(function() {
              $(this).attr("data-caption", $(this).find("img").attr("alt"));
              $(this).attr("title", $(this).find("img").attr("alt"));
          });
          // start fancybox:
          $("#gallery a").fancybox();
      });

      AOS.init();

      $(".closetop").click(function() {
          $(".contacthotel").hide();
      });
      $(window).scroll(function() {
          if ($(window).scrollTop() > 36) {
              $("header").css('top', '0');
          } else {
              $("header").css('top', '36px');
          }
      })
  </script>
  <script>
      var tomorrow = new Date();
      tomorrow.setDate(tomorrow.getDate() + 2);
      const myDatePicker = MCDatepicker.create({
          el: '#to-date',
          dateFormat: 'DD-MM-YYYY',
          //   bodyType: 'inline',
          customOkBTN: '{{ __('?????ng ??') }}',
          customClearBTN: '{{ __('X??a') }}',
          customCancelBTN: '{{ __('H???Y') }}',
          jumpToMinMax: true,
          jumpOverDisabled: true,
          closeOnBlur: false,
          minDate: new Date(),

      })

      const myDatePicker2 = MCDatepicker.create({
          el: '#from-date',
          dateFormat: 'DD-MM-YYYY',
          customOkBTN: '{{ __('?????ng ??') }}',
          customClearBTN: '{{ __('X??a') }}',
          customCancelBTN: '{{ __('H???Y') }}',
          jumpToMinMax: true,
          jumpOverDisabled: true,
          closeOnBlur: false,
          minDate: new Date(),

      })
  </script>

  <script>
      $('.del-confirm').click(function(event) {
          var url = $(this).parents("a").prop('href');
          // var name = $(this).data("name");
          event.preventDefault();
          Swal.fire({
              title: 'B???n c?? mu???n?',
              text: "X??a ph??ng n??y kh???i danh s??ch thu?? !",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'X??c nh???n!',
              cancelButtonText: 'H???y'
          }).then((result) => {
              if (result.isConfirmed) {
               setTimeout(function() { // wait for 3 secs(2)
                location.href = url;

                                  }, 2500);
                                  $(".checkbox:checked").each(function() {
                                      $(this).parents("tr").remove();
                                  });
                                  Swal.fire(
                                      'Th??nh C??ng',
                                      '???? x??a ph??ng kh???i danh s??ch !',
                                      'success'
                                  )



              } else {
                  Swal.fire(
                      '???? h???y!',
                      'Ch??a x??a g?? c???!',
                      'error'
                  )
              }
          })
      });
  </script>
