<div class="banner">
    <div class="owl-carousel owl-theme owl-loaded owl-drag" id="sliderBanner">
        <div class="owl-stage-outer">
            <div class="owl-stage"
                style="transform: translate3d(-2880px, 0px, 0px); transition: all 0.25s ease 0s; width: 8640px;">
                @foreach ($data['slider'] as $item)
                <div class="owl-item " style="width: 1440px;">
                    <div class="item">
                        <div class="banner__item">
                            <div class="banner__img">
                                <img src="{{ imageUrl('/storage/uploads/slides/'.$item->img,'900','600','100','1') }}" alt="{{ $item->translations->name ?? '' }}">
                            </div>
                            <div class="banner__content">
                                <div class="container">

                                    {{-- <h1 class="title">
                                        <i> {{ $item->translations->name }} </i>
                                    </h1>
                                    <p class="text-banner">

                                    </p> --}}
                                    {{-- <a href="{{ $item->url }}"
                                        class="button button1"><span>{{ __('Xem thêm') }}</span></a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="owl-nav"><button type="button" role="presentation" class="owl-prev"><span
                    aria-label="Previous">‹</span></button><button type="button" role="presentation"
                class="owl-next"><span aria-label="Next">›</span></button></div>
        <div class="owl-dots"><button role="button" class="owl-dot active"><span></span></button><button
                role="button" class="owl-dot"><span></span></button></div>
    </div>
    @include('frontend.home.section_booking')
</div>
