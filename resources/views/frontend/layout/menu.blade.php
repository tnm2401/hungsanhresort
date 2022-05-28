<header>
    <div class="header" id="header">
        <div class="container">
            <div class="nav_header">
                <div class="nav-top">
                    <div class="nav-top__right">
                        <a href="tel: {{ $setting->hotline_1 }}">
                            <i class="fas fa-phone"></i> {{ $setting->hotline_1 }}
                        </a>
                        <a href="{{ $setting->hotline_1 }}">
                            <i class="far fa-envelope"></i> {{ $setting->email }}
                        </a>

                    </div>

                </div>
            </div>
            <div class="nav_menu">
                <div class="menu_left">
                    <ul class="listmenu">
                        <li><a href="{{ route('frontend.home.index') }}">{{ __('Trang chủ') }}</a></li>
                        <li>
                            @if (session('locale') == 'vi')
                                <a href="{{ route('frontend.slug', 'gioi-thieu') }}">
                                @else
                                    <a href="{{ route('frontend.slug', 'about-us') }}">
                            @endif
                            {{ __('Giới thiệu') }}
                            </a>

                        </li>
                        <li>
                            @if (session('locale') == 'vi')
                            <a href="{{ route('frontend.slug', 'tat-ca-phong') }}">
                            @else
                                <a href="{{ route('frontend.slug', 'all-room') }}">
                        @endif
                                {{ __('Phòng') }}
                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a>
                            <ul class="sub_menu">
                                @foreach ($menu['cateroom'] as $item)
                                    <li><a
                                            href="{{ route('frontend.slug', $item->translations->slug) }}">{{ $item->translations->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li>
                            @if (session('locale') == 'vi')
                            <a href="{{ route('frontend.slug', 'tat-ca-dich-vu') }}">
                            @else
                                <a href="{{ route('frontend.slug', 'all-services') }}">
                        @endif
                                {{ __('Dịch vụ') }}
                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a>
                            <ul class="sub_menu">
                                @foreach ($menu['services'] as $item)
                                    <li><a
                                            href="{{ route('frontend.slug', $item->translations->slug) }}">{{ $item->translations->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>

                    </ul>
                </div>
                <div class="logo_header" style="overflow: hidden;">
                    <a href="{{ route('frontend.home.index') }}">
                        <img src="{{ asset('storage') }}/uploads/setting/{{$setting->logoindex}}" alt="">
                    </a>
                </div>
                <div class="logo_header active" style="overflow: hidden;">
                    <a href="{{ route('frontend.home.index') }}">
                        <img src="{{ asset('storage') }}/uploads/setting/{{ $setting->logoindex }}" alt="">
                    </a>
                </div>
                <div class="menu_right">
                    <ul class="listmenu">
                        <li>
                            @if (session('locale') == 'vi')
                                <a href="{{ route('frontend.slug', 'tat-ca-bai-viet') }}">
                                @else
                                    <a href="{{ route('frontend.slug', 'all-post') }}">
                            @endif

                            {{ __('Tin tức') }}
                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a>
                            <ul class="sub_menu">
                                @foreach ($menu['post'] as $item)
                                    <li><a
                                            href="{{ route('frontend.slug', $item->translations->slug) }}">{{ $item->translations->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li>
                            @if (session('locale') == 'vi')
                            <a href="{{ route('frontend.slug', 'tat-ca-anh') }}">
                            @else
                                <a href="{{ route('frontend.slug', 'all-gallery') }}">
                            @endif
                                {{ __('Thư viện ảnh') }}
                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a>
                            <ul class="sub_menu">
                                @foreach ($menu['gallery'] as $i)
                                    <li><a
                                            href="{{ route('frontend.slug', $i->translations->slug ?? '') }}">{{ $i->translations->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li>
                            @if (session('locale') == 'vi')
                                <a href="{{ route('frontend.slug', 'lien-he') }}">
                                @else
                                    <a href="{{ route('frontend.slug', 'contact') }}">
                            @endif
                            {{ __('Liên Hệ') }}
                            </a>
                        </li>
                        <li>
                            @foreach ($language as $l)
                                @if ($l->locale != session('locale'))
                                    <a href="{{ route('frontend.locale', '' . $l->locale . '') }}">{{ __($l->name) }}
                                        <span class="{{ $l->flag }}"></span></a>
                                @endif
                            @endforeach
                        </li>
                    </ul>
                </div>


                @include('frontend.layout.menu_mobile')

            </div>
        </div>
    </div>


</header>
