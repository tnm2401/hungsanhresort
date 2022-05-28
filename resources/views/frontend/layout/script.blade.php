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
          customOkBTN: '{{ __('Đồng ý') }}',
          customClearBTN: '{{ __('Xóa') }}',
          customCancelBTN: '{{ __('HỦY') }}',
          jumpToMinMax: true,
          jumpOverDisabled: true,
          closeOnBlur: false,
          minDate: new Date(),

      })

      const myDatePicker2 = MCDatepicker.create({
          el: '#from-date',
          dateFormat: 'DD-MM-YYYY',
          customOkBTN: '{{ __('Đồng ý') }}',
          customClearBTN: '{{ __('Xóa') }}',
          customCancelBTN: '{{ __('HỦY') }}',
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
              title: 'Bạn có muốn?',
              text: "Xóa phòng này khỏi danh sách thuê !",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Xác nhận!',
              cancelButtonText: 'Hủy'
          }).then((result) => {
              if (result.isConfirmed) {
               setTimeout(function() { // wait for 3 secs(2)
                location.href = url;

                                  }, 2500);
                                  $(".checkbox:checked").each(function() {
                                      $(this).parents("tr").remove();
                                  });
                                  Swal.fire(
                                      'Thành Công',
                                      'Đã xóa phòng khỏi danh sách !',
                                      'success'
                                  )



              } else {
                  Swal.fire(
                      'Đã hủy!',
                      'Chưa xóa gì cả!',
                      'error'
                  )
              }
          })
      });
  </script>
