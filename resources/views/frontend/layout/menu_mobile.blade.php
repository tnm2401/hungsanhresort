<div class="menumobile">
    <div class="navbar-toogle">
        <i class="fas fa-bars"></i>
    </div>
    <div class="menu_toogle">
        <ul class="list_menu_mobile">

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
            <li class="dropmenumobile">
                <span>+</span>
                @if (session('locale') == 'vi')
                            <a href="{{ route('frontend.slug', 'tat-ca-phong') }}">
                            @else
                                <a href="{{ route('frontend.slug', 'all-room') }}">
                        @endif
                                {{ __('Phòng') }}
                </a>
                <ul class="listdrop_mobile">
                    @foreach ($menu['cateroom'] as $item)
                    <li><a
                            href="{{ route('frontend.slug', $item->translations->slug) }}">{{ $item->translations->name }}</a>
                    </li>
                @endforeach
                </ul>
            </li>
            <li class="dropmenumobile">
                <span>+</span>
                @if (session('locale') == 'vi')
                <a href="{{ route('frontend.slug', 'tat-ca-dich-vu') }}">
                @else
                    <a href="{{ route('frontend.slug', 'all-services') }}">
            @endif
                    {{ __('Dịch vụ') }}
                </a>
                <ul class="listdrop_mobile">
                    @foreach ($menu['services'] as $item)
                    <li><a
                            href="{{ route('frontend.slug', $item->translations->slug) }}">{{ $item->translations->name }}</a>
                    </li>
                @endforeach
                </ul>
            </li>
            <li class="dropmenumobile">
                <span>+</span>
                @if (session('locale') == 'vi')
                                <a href="{{ route('frontend.slug', 'tat-ca-bai-viet') }}">
                                @else
                                    <a href="{{ route('frontend.slug', 'all-post') }}">
                            @endif

                            {{ __('Tin tức') }}
                </a>
                <ul class="listdrop_mobile">
                    @foreach ($menu['post'] as $item)
                                    <li><a
                                            href="{{ route('frontend.slug', $item->translations->slug) }}">{{ $item->translations->name }}</a>
                                    </li>
                                @endforeach
                </ul>
            </li>
            <li class="dropmenumobile">
                <span>+</span>
                @if (session('locale') == 'vi')
                            <a href="{{ route('frontend.slug', 'tat-ca-anh') }}">
                            @else
                                <a href="{{ route('frontend.slug', 'all-gallery') }}">
                            @endif
                                {{ __('Thư viện ảnh') }}
                </a>
                <ul class="listdrop_mobile">
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
            <a>
            </li>

        </ul>

    </div>
    <div class="language">
        @foreach ($language as $lang)

        <a style="color:black" href="{{ route('frontend.locale', ''.$lang->locale.'') }}">
           <span class="{{ $lang->flag }}"></span> </a>
    @endforeach

    </div>
</div>
