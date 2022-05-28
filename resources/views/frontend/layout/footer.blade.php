<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <p class="ft-title">{{ $setting->translations->name }}</p>
                        <div class="textwidget">
                            <div class="text-wrapper">
                                <p> <i class="fas fa-map-marker-alt"></i> {{ $setting->translations->address }} </p>
                                <p> <i class="fas fa-phone-volume"></i> {{ $setting->hotline_1 }} </p>
                                <p> <i class="far fa-envelope"></i> {{ $setting->email }} </p>
                                <p> <i class="fas fa-globe"></i> {{ $setting->website }} </p>

                            </div>

                        </div>

                        <ul class="sns-ul clear">
                            <li><a href="{{ $setting->facebook }}" target="_blank" class="square-30fa"><i
                                        class="fa-brands fa-facebook"></i></a></li>
                            <li><a href="{{ $setting->google }}" target="_blank" class="square-30fa"><i
                                        class="fa-brands fa-google"></i></a></li>
                            <li><a href="{{ $setting->instagram }}" target="_blank" class="square-30fa"><i
                                        class="fa-brands fa-instagram"></i></a></li>
                            <li><a href="{{ $setting->youtube }}" target="_blank" class="square-30fa"><i
                                        class="fa-brands fa-youtube"></i></a></li>
                            {{-- <li><a href="" target="_blank" class="square-30fa"><i class="fa-brands fa-linkedin"></i></a></li> --}}
                        </ul>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <p class="ft-title">{{ __('Liên kết nhanh') }}</p>
                        <div class="menu-menufooter-container">
                            <ul id="menu-menufooter" class="menu">
                                @foreach ($menu['cateroom'] as $i)
                                    <li id="" class="menu-item menu-item-type-post_type menu-item-object-page "><a
                                            href="{{ route('frontend.slug', $i->translations->slug) }}">{{ $i->translations->name }}</a>
                                    </li>
                                @endforeach
                                <li id="" class="menu-item menu-item-type-post_type menu-item-object-page "><a
                                        href="{{ route('frontend.slug', session('locale') == 'vi' ? 'lien-he' : 'contact') }}">{{ __('Liên hệ') }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12">

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <p class="ft-title">{{ __('Bản đồ') }}</p>

                {!! $setting->maps !!}
            </div>
            {{-- <div class="col-md-3">
                <p class="ft-title">Facebook</p>
                <!-- <div class="fb-page" data-href="https://www.facebook.com/facebook" data-tabs="timeline" data-width="700" data-height="300px" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/facebook" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/facebook">Meta</a></blockquote></div> -->
                <p></p>

            </div> --}}
        </div>
        <div class="copyright">
            <div class="textwidget">
                <p><a href="https://aib.vn">{{ __('Thiết kế website') }}</a> {{ __('bởi') }} <a
                        href="https://aib.vn">AIB.VN</a></p>

            </div>

        </div>
    </div>
</footer>
<div class="fixed">
    @if (session('order'))
        <div class="cart-widget">
            <span class="noti bounce2" data-toggle="tooltip" data-placement="top" title="Bạn có {{ $order->total_quantity }} phòng chờ xác nhận">
              {{ $order->total_quantity }}
            </span>
            <a href="{{ route('checkout') }}"><i class=" bounce2 fa-solid fa-house-heart"></i></a>
        </div>
    @endif
    {{-- <div class="phone-widget">
        <a href="{{ $setting->href_1 }}"><i class="fas fa-mobile-alt"></i></a>
    </div> --}}
    {{-- <div class="mail-widget">
        <a class="" href="mailto:{{ $setting->email }}"><i class="far fa-envelope"></i> </a>
    </div> --}}
    <div class="totop-widget">
        <a href="#" class="back-top"><i class="fa fa-angle-up"></i> </a>
    </div>
</div>
<div class="chat-nav">
    <ul>
      <li>
        <a href="/lien-he.html" rel="nofollow">
          <i class="ticon-heart"></i>{{ __('Tìm đường') }}
        </a>
      </li>
      <li>
        <a href="{{ $setting->zalo }}" rel="nofollow" target="_blank">
          <i class="ticon-zalo-circle2"></i>{{ __('Chat Zalo') }}
        </a>
      </li>
      <li>
        <a href="{{ $setting->href_1 }}" rel="nofollow" class="call-mobile">
          <div class="call-mobile-style">
            <i class="icon-phone-w" aria-hidden="true"></i>
          </div>
          <span class="btn_phone_txt">{{ __('Gọi điện') }}</span>
        </a>
      </li>
      <li>
        <a href="{{ $setting->facebook }}" rel="nofollow" target="_blank">
          <i class="ticon-zalo-circle3"></i>{{ __("Messenger") }}
        </a>
      </li>
      <li>
        <a href="sms:{{ $setting->href_1 }}" class="chat_animation">
          <i class="ticon-chat-sms" aria-hidden="true" title="{{ __('Nhắn tin SMS') }}"></i> {{ __('Nhắn tin SMS') }}
        </a>
      </li>
    </ul>
  </div>
</div>

@include('frontend.layout.script')



</body>

</html>
